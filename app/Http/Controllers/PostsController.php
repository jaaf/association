<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Gate;
use Auth;
use App\User;


use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); #seuls les membres ont accès aux articles
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        #the user should be at least a writer 
        if (Gate::denies('isAtLeastWriter', auth()->user())) {
            abort(403);
        }
        #managers can see everything
        if (Gate::allows('isAtLeastManager', $user)) {
            $posts = Post::orderBy('created_at', 'desc')->paginate(25);
        } else {
            #but any writer can see only their own posts
            $posts = Post::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(25);
        }
        return view('posts.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('isAdmin', auth()->user()) and Gate::denies('isManager') and Gate::denies('isWriter')) {
            abort(403);
        }
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('isAtLeastWriter', auth()->user())) {
            abort(403);
        }
        $this->validate($request, [
            'title' => 'required',
            'abstract' => 'required',
            'body' => 'required'
        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->abstract = $request->input('abstract');
        $post->body = $request->input('body');
        $post->author_id = auth()->user()->id;
        $post->category = $request->input('category');
        $post->beg_date = $request->input('beg_date');
        $post->end_date = $request->input('end_date');
        $post->close_date = $request->input('close_date');
        $post->sticky = $request->input('sticky');
        $post->diaporama_dir = $request->input('diaporama_dir');
        $post->receive_registration = $request->input('receive_registration');
        $post->inscription_directive = $request->input('inscription_directive');
        $post->save();
        return redirect('/posts')->with('success', 'Article enregistré !');
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxStoreComment(Request $request, $post_id)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'content' => 'required',
                'agent_id' => 'required'
            ]);
            return response()->json(['success' => 'Got Simple Ajax Request.']);
        } else {
            return response()->json(['test' => 'request is not ajax', 'contenu' => $request->input('content')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $author = User::find($post->author_id);
        $comments = Comment::where('post_id', $id)->orderBy('Created_at', 'desc')->get();
        #$post->body=Markdown::convertToHtml($post->body);
        return view('posts.show', compact('post', 'author', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $author = User::find($post->author_id);
        if (auth()->user()->id == $author->id or Gate::allows('isAdmin')) {
            return view('posts.edit', compact('post', 'author'));
        } else {
            abort(403);//forbiden
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        $author = $post->author; //belongsTo relationship 
        #only admin can update others posts
        if ($user != $author and Gate::denies('isAdmin')) {
            abort(403);//forbiden
        }
        $this->validate($request, [
            'title' => 'required',
            'abstract' => 'required',
            'body' => 'required'
        ]);
        $post->title = $request->input('title');
        $post->abstract = $request->input('abstract');
        $post->body = $request->input('body');
        #no change to author id
        $post->category = $request->input('category');
        $post->beg_date = $request->input('beg_date');
        $post->end_date = $request->input('end_date');
        $post->close_date = $request->input('close_date');
        $post->sticky = $request->input('sticky');
        $post->diaporama_dir = $request->input('diaporama_dir');
        $post->receive_registration = $request->input('receive_registration');
        $post->inscription_directive = $request->input('inscription_directive');

        $post->save();
        return redirect('/posts')->with('success', 'Article mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post = Post::find($post);
        $user = auth()->user();;
        $author = $post->author; //belongsTo relationship 
        #only admin can destroy others posts
        if ($user != $author and Gate::denies('isAdmin')) {
            abort(403);//forbiden
        }
        $post->delete();
        return redirect('/posts/')->with('success', 'Article supprimé');
    }

    /**
     * @Route("/post/shownarratives/{year}", name="post.shownarratives")
     */
    public function narratives($year)
    {
    
        $value = 'narratives-' . $year;
        $posts = Post::where('category',$value)->get();

        return view('posts.narratives',compact('posts','year'));
    }
}
