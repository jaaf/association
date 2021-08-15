<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;

class Diaporama extends Component
{
protected $listeners = ['refreshComponent' => '$refresh'];

    public $w,$h,$dir,$images, $base_dir,$post_id,$facteur;

    public function mount($post_id,$dir){
        $this->dir=str_replace('-','/',$dir);
        $dirToScan= '../public/storage/photos/'.$dir;
        $this->base_dir =  '/storage/photos/'.$dir;
       
        $this->images=scandir($dirToScan);
        array_shift($this->images);//skip . and ..
        array_shift($this->images);
        $this->h=800;
        $this->w=1200;
        $this->facteur=1;
    }
    
  
    public function render(Request $request)
    {
      
        return view('livewire.diaporama')->layout('layouts.diapo');
    }
}
