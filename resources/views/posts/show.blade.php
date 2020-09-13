@extends('layouts.app')
@section('content')
<div class="container my-post my-content ">
		<h1>{{ $post->title }}</h1>
		<div class="my-post-body">

			{!!Markdown($post->body, ['config' => 'default']) !!}
			<div class="my-bottom-link">
				@if($post->diaporama_dir)
                     @php
				     $dir=str_replace('/','-',$post->diaporama_dir);
					 @endphp

					<a href="/diaporama/show/{{$post->id}}/{{$dir}}">
						Visualisez le diaporama
					</a>
				@endif
			</div>
			<div class="my-bottom-link">
			    
				@if ($post->receive_registration == '1') 
				   @if (\Carbon\Carbon::parse($post->close_date) >= \Carbon\Carbon::now())
						<a href="/registrations/{{$post->id}}">
							S'inscrire à cet événement
						</a>
				    @else
						@can('isAtLeastManager')
							@if ($post->receive_registration == '1') 
								<a href="/registrations/{{$post->id}}">
									Voir les inscriptions
								</a>
							@endif
						@endcan
					@endif
				@endif

			</div>

		</div>
		<div>
		@include('posts.inc.comments')
		<?php \Carbon\Carbon::setLocale('fr');?>
		Article écrit par {{$author->name}} le {{\Carbon\Carbon::parse($post->created_at)->translatedFormat('l jS F Y')}} à {{\Carbon\Carbon::parse($post->created_at)->translatedFormat('h:m') }}
		</div>
        </div>
@endsection