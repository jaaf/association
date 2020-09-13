@extends('layouts.bare')

@section('content')
<div class="container mt-4 my-content">
    <h1> Modification d'une info-lettre</h1>
        <h2>Créer une nouvelle lettre</h2>
		 @include ('infoletters.inc.directive')
        {!! Form::open(['action' => 'InfoletterController@update','method'=>'PUT']) !!}
            {{Form::hidden('id',$infoletter->id)}}
            <div class="col-md-12">
                {{Form::label('title','Titre de la lettre')}}
                {{ Form::text('title',$infoletter->title,['class'=>'form-control'])}}
            </div>
            <div class="col-md-12">
                {{Form::label('body','Corps de l\'article')}}
                {{ Form::textarea('body',$infoletter->body,['class'=>'form-control', 'id'=>"body"])}} 
                 
            </div>
            {{Form::submit('Enregistrer',['class'=>'btn btn-primary'])}}
	    {!! Form::close() !!}

	</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $( document ).ready(function() { 
        CKEDITOR.replace( 'body' );
       
    });
</script>
@endsection
