@extends('layouts.app')
@section('content')
    <div class="container my-post ">
        <h1>Récits de l'année {{ $year }}</h1>
        <div class="container mt-4 my-post-body">
            @if (count($posts)>0)
            @foreach ($posts as $post)

                <div class="my-page-link">
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                        {{ $post->title }}</a>
                </div>
            @endforeach
        @else
            <h3>Il n'y a aucun récit pour l'année {{ $year }}</h3>
            @endif
        </div>
    </div>
@endsection
