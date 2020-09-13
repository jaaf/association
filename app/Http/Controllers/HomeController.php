<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        #$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stickies=Post::where('sticky','1')->orderBy('created_at', 'desc')->get();
        $events=Post::where('category','annoncements')->where('end_date','>', now())->orderBy('beg_date','asc')->get();
        
        return view('home.home',compact('stickies','events'));
    }
}
