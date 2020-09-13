@extends('layouts.app')
 @section('content')
 <div class="container my-post ">
     <h1>Récits de l'année {{$year}}</h1>
 <div class="container mt-4 my-post-body">
	@foreach ($posts as $post)
   
        <div class="my-page-link">
        <a href="{{route('posts.show',['post'=>$post->id])}}">
				{{$post->title}}</a>
        </div>
    @endforeach
</div>
</div>
@endsection
	

