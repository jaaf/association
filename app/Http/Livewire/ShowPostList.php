<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPostList extends Component
{
    public $posts;
    public $year;

    //$year is the route parameter
    public function mount($year){
        $this->year=$year;
        $cat = 'narratives-' . $year;
        $this->posts = Post::where('category',$cat)->get();
 

    }
    public function render()
    {
        return view('livewire.show-post-list');
    }
}
