<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public $stickies;
    public $events;

    public function mount(){
        $this->stickies=Post::where('sticky','1')->orderBy('id','desc')->get();
        $this->events=Post::where('category','annoncements')->where('end_date','>', now())->orderBy('beg_date','asc')->get();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
