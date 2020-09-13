@extends('layouts.bare')

@section('content')



<div class="container mt-4 my-content">
	<h2>Modifier un article</h2>
	{{$author->id}}
	
	{!! Form::open(['action' => ['PostsController@update',$post->id],'method'=>'PUT']) !!}

	<div class="row  post-option-background">
		<div class="col-md-2">
			{{Form::label('category','Catégorie')}}
			{{Form::select('category', ['undefined' => 'Sans', 'Annoncements' => 'Annonce','Narratives' =>'Récit','Pages'=>'Page'],$post->category)}}
		</div>
		<div class="col-md-10">
            {{Form::label('title','Titre')}}
			{{ Form::text('title',$post->title,['class'=>'form-control', 'placeholder' =>'Title'])}}
		</div>

	</div>
	<div class="row post-option-background">

		<div class="col-md-2" >
            {{Form::label('beg_date','Date de début événement')}}
			{{Form::Date('beg_date',\Carbon\Carbon::parse($post->beg_date)->locale('fr_FR'),['class'=>'form-control'])}}
			
		</div>
		<div class="col-md-2">
			{{Form::label('end_date','Date de fin événement')}}
			{{Form::Date('end_date',\Carbon\Carbon::parse($post->end_date)->format('Y-m-d'),['class'=>'form-control'])}}
		</div>
		<div class="col-md-2">
			{{Form::label('close_date','Date de fin des inscriptions')}}
			{{Form::Date('close_date',\Carbon\Carbon::parse($post->close_date)->format('Y-m-d'),['class'=>'form-control'])}}
		</div>
		<div class="col-md-2">
			{{Form::label('receive_registration','Accepte des inscriptions')}}
			{{Form::select('receive_registration', ['0' => 'Non','1' => 'Oui'],$post->receive_registration)}}
        </div>
		<div class="col-md-4">
			{{Form::label('diaporama_dir','Dossier du diaporama')}}
			{{ Form::text('diaporama_dir',$post->diaporama_dir,['class'=>'form-control'])}}
		</div>
	</div>
    <div class="row post-option-background">

		<div class="col-md-12" >
            {{Form::label('abstract','Résumé')}}
			{{ Form::textarea('abstract',$post->abstract,['class'=>'form-control'])}}
		</div>
		<div class="col-md-12">
			{{Form::label('body','Corps de l\'article')}}
            {{ Form::textarea('body',$post->body,['class'=>'form-control'])}}
		</div>
		
	</div>
    {{Form::submit('Enregistrer',['class'=>'btn btn-primary'])}}


	{!! Form::close() !!}

</div>
@endsection