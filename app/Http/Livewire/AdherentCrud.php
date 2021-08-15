<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Adherent;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AdherentCrud extends Component
{
    use AuthorizesRequests;
    public $adherents, $firstname, $familyname, $city, $cotisation, $registered, $email,
        $phone, $adherent_id;

    public $page_title = 'Liste des adhérents';
 

    public $isModalOpen = 0;    
    
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        
           $this->adherents = Adherent::orderBy('id', 'desc')->get();

        return view('livewire.adherent-crud')->layout('layouts.diapo'); 
    

        
    }

    public function create()
    {
        $this->authorize('create', Adherent::class);
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->page_title = "Liste des adhérents";
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {

        $this->page_title = 'Inscription d\'un nouvel adhérent';
        $this->firstname= '';
        $this->familyname = '';
        $this->city = '';
        $this->cotisation = '';
        $this->registerd = '';
        $this->email = '';
        $this->phone= '';
    }

    public function store()
    {
        $this->validate([
            'firstname' => 'required',
            'familyname' => 'required',
            'city' => 'required',
            'cotisation'=>'required',
            'registered'=>'',
            'email'=>'',
            'phone'=>''
        ]);

        Adherent::updateOrCreate(['id' => $this->adherent_id], [
            'firstname' => $this->firstname,
            'familyname' => $this->familyname,
            'city' => $this->city,
            'registered' => $this->registered,
            'cotisation' => $this->cotisation,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', $this->adherent_id ? 'Adhérent mis à jour' : 'Adhérent créé.');

        $this->closeModalPopover();
    }

    public function edit($id)
    {

        $adherent = Adherent::findOrFail($id);
        //$this->authorize('update', $adherent);
        $response = Gate::inspect('update', $adherent);
        if ($response->allowed()) {
            $this->page_title = "Modification d'un article";
            $this->adherent_id = $id;
            $this->firstname = $adherent->firstname;
            $this->familyname = $adherent->familyname;
            $this->city= $adherent->city;
            $this->registered = $adherent->registered;
            $this->cotisation = $adherent->cotisation;
            $this->email = $adherent->email;
            $this->phone= $adherent->phone;

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
        $adherent = Adherent::find($id);
       // $this->authorize('delete', $adherent);
        $response = Gate::inspect('update', $adherent);
        if ($response->allowed()) {
            $adherent->delete();
            $this->alert('success', "L'adhérent ".$adherent->firstname.' '.$adherent->familyname." a bien été supprimé.", [
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
