<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;

class CommentController extends Controller
{
     /**
     * Create a new comment instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');#seuls les membres ont accès aux commentaires
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if ($request->ajax()){
            $this->validate($request, [
            'content'=>'required',
            'post_id'=>'required',
            'agent_id'=>'required'
            ]);
            $comment=new Comment();
            $comment->post_id=$request->post_id;
            $comment->agent_id=$request->agent_id;
            $comment->content=$request->content;
            $comment->status=1;
            $comment->save();
            return response()->json(['content'=>$request->content]);
        } else{
            return 'request is not ajax';
        }
    }
}
