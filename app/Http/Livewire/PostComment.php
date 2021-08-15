<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostComment extends Component

{
use AuthorizesRequests;
public $post;
public $newComment;
public $comments;
private $data;
public $underEdition;
public $underEditionComment;

public function mount(Post $post){
	$this->post=$post;
	$this->comments=Comment::where('post_id', $post->id)->orderBy('Created_at', 'desc')->get(['id','agent_id','content','created_at'])->toArray();
	$this->underEdition='';
	$this->underEditionComment='';

}

public function store(){
	$this->data=Comment::create(['agent_id'=> auth()->user()->id,'post_id'=>$this->post->id,'status'=> "1",'content'=>$this->newComment]);

}

public function addComment(){
	$this->store();
	array_unshift($this->comments,['id'=>$this->data->id,'agent_id'=>auth()->user()->id,'content'=>$this->newComment,'created_at'=>\Carbon\Carbon::now()]);
	$this->newComment="";
}
public function editComment($id){
	$comment=Comment::find($id);
	$this->underEdition=$id;
	$this->underEditionComment=$comment->content;

}

public function updateComment($id){
	$comment=Comment::find($id);
	$comment->content=$this->underEditionComment;
	$comment->save();
	$this->comments=Comment::where('post_id', $this->post->id)->orderBy('Created_at', 'desc')->get(['id','agent_id','content','created_at'])->toArray();
	$this->underEdition='';
	$this->underEditionComment='';
}
public function deleteComment($id){
	$comment=Comment::find($id);
	$this->authorize('delete',$comment );
	$comment->delete();
	$this->comments=Comment::where('post_id', $this->post->id)->orderBy('Created_at', 'desc')->get(['id','agent_id','content','created_at'])->toArray();
}
public function render()
{
	return view('livewire.post-comment');
}
}
