<?php

namespace App\Http\Livewire;


use App\Models\Post;
use App\Models\Comment;
use App\Models\Adherent;
use App\Models\Infoletter;
use App\Models\Registration;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LivewireModal extends ModalComponent
{
    use AuthorizesRequests;
    public $type;
    public $ident;

    public function mount($type, $ident)
    {
        $this->type = $type;
        $this->ident = $ident;
    }
    public function render()
    {
        return view('livewire.livewire-modal');
    }

    public function deleteComment()
    {
        $this->closeModal();
        $comment = Comment::find($this->ident);
        $response = Gate::inspect('delete', $comment);
        if ($response->allowed()) {
            $comment->delete();
            $this->message('success', 'Pas de problème ! Le commentaire a bien été supprimé.');
        } else {
            $this->message('error', $response->message());
        }
    }



    public function deletePost()
    {
        $this->closeModal();
        $post = Post::find($this->ident);
        // $this->authorize('delete',$post);
        $response = Gate::inspect('delete', $post);
        if ($response->allowed()) {
            $post->delete();
            $this->message('success', 'L\'article intitulé « ' . $post->title . ' » a bien été supprimé.');
            $this->emitTo('post-crud', 'refreshComponent');
        } else {
            $this->message('error', $response->message());
        }
    }

    public function deleteRegistration()
    {
        $this->closeModal();
        $registration = Registration::find($this->ident);
        //$this->authorize('delete', $registration);
        $response = Gate::inspect('delete', $registration);
        if ($response->allowed()) {
            $registration->delete();
            $this->message('success', 'Pas de problème ! L\'inscription de ' . $registration->firstname . ' ' . $registration->familyname . '  a bien été annulée.');
            $this->emitTo('registration-crud', 'refreshComponent');
        } else {
            $this->message('error', $response->message());
        }
    }

    public function deleteAdherent()
    {
        $this->closeModal();
        $adherent = Adherent::find($this->ident);
        //$this->authorize('delete', $registration);
        $response = Gate::inspect('delete', $adherent);
        if ($response->allowed()) {
            $adherent->delete();
            $this->message('success', 'Pas de problème ! L\'inscription de l\'adhérent ' . $adherent->firstname . ' ' . $adherent->familyname . '  a été annulée.');
            $this->emitTo('adherent-crud', 'refreshComponent');
        } else {
            $this->message('error', $response->message());
        }
    }

    public function deleteInfoletter()
    {
        $this->closeModal();
        $infoletter = Infoletter::find($this->ident);
        //$this->authorize('delete', $registration);
        $response = Gate::inspect('delete', $infoletter);
        if ($response->allowed()) {
            $infoletter->delete();
            $this->message('success', 'Pas de problème ! L\'info-lettre a bien été supprimée.');

            $this->emitTo('infoletter-crud', 'refreshComponent');
        } else {
            $this->message('error', $response->message());
        }
    }

    public function deleteFolder(){
        $this->closeModal();
        $this->emitTo('upload-photo',"deleteFolder",$this->ident);
    }

    public function deleteImage(){
        $this->closeModal();
        $this->emitTo('upload-photo','deleteImage',$this->ident);
    }

    private function message($mode, $message)
    {
        $this->alert($mode, $message, [
            'position' =>  'center',
            'timer' =>  5000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false
        ]);
    }
}
