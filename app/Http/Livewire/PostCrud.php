<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PostCrud extends Component
{
    use AuthorizesRequests;
    public $posts, $title, $abstract, $body, $category, $diaporama_dir, $end_date,
        $beg_date, $receive_registration, $optional1, $optional2, $sticky, $author_id, $inscription_directive,
        $close_date, $post_id,
        $page_title = 'Liste des articles';


    public $isModalOpen = 0;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        if (Gate::allows('isAdmin')){
            $this->posts = Post::orderBy('id', 'desc')->get();
        } else 
        if (Gate::allows('isAtLeastWriter')){
            $this->posts=Post::where('author_id',auth()->user()->id)->orderBy('id','desc')->get();
        } else{
            abort(403);
        }
        

        return view('livewire.post-crud')->layout('layouts.diapo');
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->page_title = "Liste des articles";
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {

        $this->page_title = 'Création d\'un nouvel article';
        $this->title = '';
        $this->abstract = '';
        $this->category = 'Undefined';
        $this->body = '';
        $this->diaporama_dir = '';
        $this->end_date = Carbon::now();
        $this->beg_date = Carbon::now();
        $this->receive_registration = '0';
        $this->optional1 = '';
        $this->optional2 = '';
        $this->sticky = '0';
        $this->author_id = auth()->user()->id;
        $this->inscription_directive = 'Directive';
        $this->close_date = Carbon::now();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'abstract' => 'required',
            'body' => 'required'
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'abstract' => $this->abstract,
            'body' => $this->body,
            'category' => $this->category,
            'diaporama_dir' => $this->diaporama_dir,
            'end_date' => $this->end_date,
            'beg_date' => $this->beg_date,
            'receive_registration' => $this->receive_registration,
            'optional1' => $this->optional1,
            'optional2' => $this->optional2,
            'sticky' => $this->sticky,
            'author_id' => $this->author_id,
            'inscription_directive' => $this->inscription_directive,
            'close_date' => $this->close_date
        ]);

        session()->flash('message', $this->post_id ? 'Article mis à jour' : 'Article créé.');

        $this->closeModalPopover();
    }

    public function edit($id)
    {

        $post = Post::findOrFail($id);
        //$this->authorize('update', $post);
        $response = Gate::inspect('update', $post);
        if ($response->allowed()) {
            $this->page_title = "Modification d'un article";
            $this->post_id = $id;
            $this->title = $post->title;
            $this->abstract = $post->abstract;
            $this->body = $post->body;
            $this->category = $post->category;
            $this->diaporama_dir = $post->diaporama_dir;
            $this->end_date = $post->end_date;
            $this->beg_date = $post->beg_date;
            $this->receive_registration = $post->receive_registration;
            $this->optional1 = $post->optional1;
            $this->optional2 = $post->optional2;
            $this->sticky = $post->sticky;

            $this->author_id = $post->author_id;
            $this->inscription_directive = $post->inscription_directive;
            $this->close_date = $post->close_date;
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
        $post = Post::find($id);
       // $this->authorize('delete', $post);
        $response = Gate::inspect('update', $post);
        if ($response->allowed()) {
            $post->delete();
            $this->alert('success', "L'article intitulé ".$post->title." a bien été supprimé.", [
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
}
