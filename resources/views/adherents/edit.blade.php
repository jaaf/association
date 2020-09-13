@extends('layouts.bare')

@section('content')



<div class="container mt-4 my-content">
    <h2>Mettre à jour un adhérent</h2>
    
    
	
	{!! Form::open(['action' => 'AdherentController@update','method'=>'PUT']) !!}



         {{Form::hidden('id',$adherent->id)}}
        <div class="col-md-12 my-input-group">
			{{Form::label('firstname','Prénom')}}
			{{Form::text('firstname',$adherent->firstname,['class'=>'form-control'])}} 
        </div>
        <div class="col-md-12 my-input-group">
			{{Form::label('familyname','Nom')}}
			{{Form::text('familyname',$adherent->familyname,['class'=>'form-control'])}} 
        </div>
		<div class="col-md-12 my-input-group" >
            {{Form::label('city','Commune')}}
			{{ Form::text('city',$adherent->city,['class'=>'form-control'])}}
		</div>
		<div class="col-md-12 my-input-group">
			{{Form::label('email','Email')}}
            {{ Form::text('email',$adherent->email,['class'=>'form-control'])}}
        </div>
        <div class="col-md-12 my-input-group">
			{{Form::label('phone','Téléphone')}}
            {{ Form::text('phone',$adherent->phone,['class'=>'form-control'])}}
        </div>
        <div class="col-md-12 my-input-group">
			{{Form::label('cotisation','À jour de cotisation')}}
			{{Form::select('cotisation',['Non'=>'---','Non' => 'Non','Oui' => 'Oui'], $adherent->cotisation)}}
        </div>
        <div class="col-md-12 my-input-group ">
			{{Form::label('Enregistré sur site')}}
			{{Form::select('registered', ['0'=>'---','1' => 'Non','2' => 'Oui'],$adherent->registered)}}
        </div>
		

    {{Form::submit('Mettre à juur',['class'=>'btn btn-primary my-button '])}}


	{!! Form::close() !!}
</div>
@endsection
