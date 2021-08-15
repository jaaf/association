<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Foundation\Auth\User;

class ShowPost extends Component
{
    public $post;
    public $page_title;
    public $author;


    public function mount($id){
        //$id is implicitly the route param
        $this->post=Post::find($id);
        $this->page_tile=$this->post->title;
        $this->author=User::find($this->post->author_id);

    }

    public function render()
    {
        return view('livewire.show-post');
    }
}