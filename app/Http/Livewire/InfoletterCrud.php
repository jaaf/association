<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Infoletter;
use App\Jobs\SendInfoletterJob;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class InfoletterCrud extends Component
{
    use AuthorizesRequests;
    public $infoletters, $title, $body, $author_id,$infoletter_id;

    public $page_title = 'Liste des info-lettres';
 

    public $isModalOpen = 0;    
    public $showMode=false;
    
    protected $listeners = ['refreshComponent' => '$refresh','deleteFolder'=>'deleteFolder'];

    public function mount(){
        $this->author_id=auth()->user()->id;
    }
    public function render()
    {
        
        if (Gate::allows('isAdmin')){
            $this->infoletters = Infoletter::orderBy('id', 'desc')->get();
        } else 
        if (Gate::allows('isAtLeastWriter')){
            $this->infoletters = Infoletter::where('author_id',auth()->user()->id)->orderBy('id','desc')->get();
        } else{
            abort(403);
        }
        return view('livewire.infoletter-crud')->layout('layouts.diapo'); 
    }

    public function create()
    {
        $this->authorize('create', Infoletter::class);
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->page_title = "Liste des info-lettres";
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {

        $this->page_title = 'Inscription d\'un nouvel adhérent';
        $this->title= '';
        $this->body = '';
        $this->author_id=auth()->user()->id;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Infoletter::updateOrCreate(['id' => $this->infoletter_id], [
            'title' => $this->title,
            'body' => $this->body,
            'author_id'=>$this->author_id
        ]);

        session()->flash('message', $this->infoletter_id ? 'Info-lettre mise à jour' : 'Info-lettre créée.');

        $this->closeModalPopover();
    }
    public function show($id){
        $infoletter = Infoletter::findOrFail($id);
        $this->infoletter_id=$id;
        $this->showMode=true;
        $this->openModalPopover();
    }

    public function edit($id)
    {
        $this->showMode=false;
        $infoletter = Infoletter::findOrFail($id);
        //$this->authorize('update', $infoletter);
        $response = Gate::inspect('update', $infoletter);
        if ($response->allowed()) {
            $this->page_title = "Modification d'une info-lettre";
            $this->infoletter_id = $id;
            $this->title = $infoletter->title;
            $this->body = $infoletter->body;
            $this->author_id=$this->author_id;

            $this->openModalPopover();
            
        } else{
            $this->alert('failure', $response->message(), [
                'position' =>  'center',
                'timer' =>  5000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }

    public function delete($id)
    {
        $infoletter = Infoletter::find($id);
       // $this->authorize('delete', $infoletter);
        $response = Gate::inspect('update', $infoletter);
        if ($response->allowed()) {
            $infoletter->delete();
            $this->alert('success', "L'info-lettre a bien été supprimée.", [
                'position' =>  'center',
                'timer' =>  5000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,]);
        
        } else{
            $this->alert('failure', $response->message(), [
                'position' =>  'center',
                'timer' =>  5000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }

    public function sendToMe($id,$delay){
        $infoletter=Infoletter::find($id);
        $user=auth()->user();
        $sender=auth()->user();
        $details=[
            'title'=> $infoletter->title,
            'body'=>$infoletter->body,
            'sender'=> $sender,
            'user'=>$user
        ];
        $job=(new SendInfoletterJob($details))->delay($delay);
        
                $minutes = intval(($delay % 3600) / 60);
                $secondes = intval((($delay % 3600) % 60)); 
                dispatch($job);
        $this->message('success','Envoi de l\'info-lettre programmé pour '. $user->firstname . ' ' . $user->familyname . '
        . L\'envoi aura lieu dans ' . $minutes . ' minutes et ' . $secondes . ' secondes.');    
    
    }

    public function sendToManagers($id){      
        $increm=15;
        $message='Un envoi de cette infolettre a été programmé toutes les '.$increm. ' secondes pour ';
        $infoletter=Infoletter::find($id);  
        $sender=auth()->user();
        $details=[
            'title'=> $infoletter->title,
            'body'=>$infoletter->body,
            'sender'=> $sender,
        ];
        $users=User::where('role','manager')->get();
        $delay=0;
        foreach ($users as $user){
            $details['user']=$user;
            $job=(new SendInfoletterJob($details))->delay($delay); 
                dispatch($job);
            $delay=$delay+$increm;    
            $message=$message. ' <p>'.$user->email.'</p>';
        }
         $details=[
            'title'=>'Récapitulatif des envois de la lettre',
            'body'=>$message,
             'sender'=>auth()->user(),
            'user'=>auth()->user()

        ];
        $job=(new SendInfoletterJob($details))->delay($delay+$increm); 
        dispatch($job);
        $this->message('success',$message);
        //$this->closeModalPopover();
    }
     public function sendToCA($id){
        $increm=15;
        $message='Un envoi de cette infolettre a été programmé toutes les '.$increm. ' secondes pour ';
        $infoletter=Infoletter::find($id);  
        $sender=auth()->user();
        $details=[
            'title'=> $infoletter->title,
            'body'=>$infoletter->body,
            'sender'=> $sender,
        ];
        $users=User::where('role','manager')->orWhere('role','CA')->get();
        $delay=0;
        foreach ($users as $user){
            $details['user']=$user;
            $job=(new SendInfoletterJob($details))->delay($delay); 
                dispatch($job);
            $delay=$delay+$increm;  

            $message=$message. ' <p>'.$user->firstname.' '.$user->familyname.' <span style="color:green;">'.$user->email.'</span></p>';
            
        }
        $details=[
            'title'=>'Récapitulatif des envois de la lettre',
            'body'=>$message,
             'sender'=>auth()->user(),
            'user'=>auth()->user()

        ];
        $job=(new SendInfoletterJob($details))->delay($delay+$increm); 
        dispatch($job);
        $this->message('success',$message);
    }

    public function sendToAll($id){    
        $increm=15;
        $message='Un envoi de cette infolettre a été programmé toutes les '.$increm. ' secondes pour ';
        $infoletter=Infoletter::find($id);  
        $sender=auth()->user();
        $details=[
            'title'=> $infoletter->title,
            'body'=>$infoletter->body,
            'sender'=> $sender,
        ];
        $users=User::all();
        $delay=0;
        foreach ($users as $user){
            $details['user']=$user;
            $job=(new SendInfoletterJob($details))->delay($delay); 
                dispatch($job);
            $delay=$delay+$increm;    
            $message=$message. ' <p>'.$user->email.'</p>';
        }
         $details=[
            'title'=>'Récapitulatif des envois de la lettre',
            'body'=>$message,
             'sender'=>auth()->user(),
            'user'=>auth()->user()

        ];
        $job=(new SendInfoletterJob($details))->delay($delay+$increm); 
        dispatch($job);
        $this->message('success',$message);
    }

    private function message($mode,$message){
        $this->alert($mode, $message, [
                'position' =>  'center',
                'timer' =>  '',
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  true,
            ]);
    }
}
