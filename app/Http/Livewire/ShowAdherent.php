<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Adherent;

class ShowAdherent extends Component
{ 
    public $adherents;
    
    public function render()
   
    {

        $this->adherents = Adherent::orderBy('id', 'desc')->get();
        return view('livewire.show-adherent');
    }
}
