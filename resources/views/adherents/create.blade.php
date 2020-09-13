@extends('layouts.bare')

@section('content')



<div class="container mt-4 my-content">
    <h2>Enregistrer un nouvel adhérent</h2>
    
    
	
	{!! Form::open(['action' => 'AdherentController@store','method'=>'POST']) !!}



   

        <div class="col-md-12 my-input-group">
			{{Form::label('firstname','Prénom')}}
			{{Form::text('firstname','',['class'=>'form-control'])}} 
        </div>
        <div class="col-md-12 my-input-group">
			{{Form::label('familyname','Nom')}}
			{{Form::text('familyname','',['class'=>'form-control'])}} 
        </div>
		<div class="col-md-12 my-input-group" >
            {{Form::label('city','Commune')}}
			{{ Form::text('city','',['class'=>'form-control'])}}
		</div>
		<div class="col-md-12 my-input-group">
			{{Form::label('email','Email')}}
            {{ Form::text('email','',['class'=>'form-control'])}}
        </div>
        <div class="col-md-12 my-input-group">
			{{Form::label('phone','Téléphone')}}
            {{ Form::text('phone','',['class'=>'form-control'])}}
        </div>
        <div class="col-md-12 my-input-group">
			{{Form::label('cotisation','À jour de cotisation')}}
			{{Form::select('cotisation', ['Non'=>'---','Non' => 'Non','Oui' => 'Oui'])}}
        </div>
        <div class="col-md-12 my-input-group ">
			{{Form::label('Enregistré sur site')}}
			{{Form::select('registered', ['0'=>'---','1' => 'Non','2' => 'Oui'])}}
        </div>
		

    {{Form::submit('Enregistrer',['class'=>'btn btn-primary my-button '])}}


	{!! Form::close() !!}
</div>
@endsection


