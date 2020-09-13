@extends('layouts.bare')

@section('content')
<div class="container mt-4 my-content">
    <h1> Préparation d'une enquête</h1>
        <h2>Créer une nouvelle enquête</h2>
		{!! Form::open(['action' => 'SurveyController@store','method'=>'POST']) !!}
            <div class="col-md-12">
                {{Form::label('title','Titre de l\'enquête')}}
                {{ Form::text('title','',['class'=>'form-control'])}}
            </div>
            <div class="col-md-2">
			    {{Form::label('date_beg','Date de début')}}
			    {{Form::Date('date_beg',\Carbon\Carbon::now())}}
            </div>
            <div class="col-md-2">
                {{Form::label('date_end','Date de fin')}}
                {{Form::Date('date_end',\Carbon\Carbon::now())}}
            </div>
            <div class="col-md-2">
                {{Form::label('is_random','Ordre aléatoire')}}
                {{Form::select('is_random', [false => 'Non',true => 'Oui'])}}
            </div>
            <div class="col-md-2">
                {{Form::label('anonymous','Est anonyme')}}
                {{Form::select('anonymous', [false => 'Non',true => 'Oui'])}}
            </div>
            <div class="col-md-2">
                {{Form::label('show_vote','Montre les votes')}}
                {{Form::select('show_vote', [false => 'Non',true => 'Oui'])}}
            </div>
            {{Form::submit('Enregistrer',['class'=>'btn btn-primary'])}}
	    {!! Form::close() !!}

	</div>

@endsection