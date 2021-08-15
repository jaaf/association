<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Registration;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegistrationCrud extends Component
{

    use AuthorizesRequests;
    public $registrations, $registration_id, $firstname, $familyname, $city, $optional1, $optional2, $remark, $agent_id;
    public $page_title;
    public $post;
    public $matches=[], $matches2=[];

    public $isModalOpen = 0;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
        $this->registrations = Registration::where('post_id', $this->post->id)->orderBy('created_at')->get();
        $this->page_title = $this->post->title . " – Liste des inscriptions";
    }

    public function render()
    {
        $this->registrations = Registration::orderBy('id', 'desc')->get();
        return view('livewire.registration-crud');
    }

    public function create()
    {
        //$this->authorize('create',Registration::class);
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->page_title = $this->post->title . " – Liste des inscriptions";
        $this->isModalOpen = false;
    }
    private function resetCreateForm()
    {
        $this->registration_id=null;
        $this->page_title = 'Nouvelle inscription';
        $this->firstname = '';
        $this->familyname = '';
        $this->city = '';
        $this->optional1 = ''; //le contenu du champ, pas son titre
        $this->optional2 = ''; //le contenu du champ, pas son titre
        $this->remark = '';
        $this->directive = $this->post->directive;
        $this->post_id = $this->post->id;
        $this->agent_id = auth()->user()->id;
    }

    public function edit($id)
    {

        $registration = Registration::findOrFail($id);
        //$this->authorize('update', $registration);
        $response = Gate::inspect('update', $registration);
        if ($response->allowed()) {
            $this->page_title = "Modification d'une inscription";
            $this->registration_id = $id;
            $this->firstname = $registration->firstname;
            $this->familyname = $registration->familyname;
            $this->city = $registration->city;
            $this->optional1 = $registration->optional1; //le contenu du champ, pas son titre
            $this->optional2 = $registration->optional2; //le contenu du champ, pas son titre
            $this->remark = $registration->remark;
            $this->directive = $this->post->directive;
            $this->post_id = $this->post->id;
            $this->agent_id = auth()->user()->id;
            $this->openModalPopover();
        } else {
            $this->alert('error', $response->message());
        }
    }

    public function store()
    {
        $this->validate([
            'firstname' => 'required',
            'familyname' => 'required',
            'city' => 'required',
            'agent_id' => 'required'
        ]);

        Registration::updateOrCreate(['id' => $this->registration_id], [
            'firstname' => $this->firstname,
            'familyname' => $this->familyname,
            'city' => $this->city,
            'optional1' => $this->optional1,
            'optional2' => $this->optional2,
            'remark' => $this->remark,
            'post_id' => $this->post->id,
            'agent_id' => $this->agent_id,

        ]);
        //we don't use flash because there is no page change
        $this->alert('success', $this->registration_id
         ? 'Inscription de '. $this->firstname.' '.$this->familyname.'  mise à jour !' 
         : 'Inscription de '. $this->firstname.' '.$this->familyname.' enregistrée !', [
                'position' =>  'center',
                'timer' =>  5000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        
            

        $this->closeModalPopover();
    }
}
