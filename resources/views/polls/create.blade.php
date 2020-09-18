@extends('layouts.bare')

@section('content')


    @php
    $options=[];
    $options['']='----------------------';
    @endphp

    @foreach ($surveys as $survey)

        @php
        $options[$survey->id]=$survey->title;
        @endphp


    @endforeach

    @php
    print_r($options);
    @endphp

    <div class="container mt-4 my-content">
        <h1> Préparation d'une enquête</h1>
        <h2>Créer une nouveau questionnaire</h2>
        {!! Form::open(['action' => 'PollController@store', 'method' => 'POST']) !!}
        <div class="col-md-12">
            {{ Form::label('question', 'Intitulé de la question') }}
            {{ Form::text('question', '', ['class' => 'form-control']) }}

        </div>
        <div class="col-md-12">
            {{ Form::label('rank', 'Numéro d\'ordre de la question') }}
            {{ Form::text('rank', '', ['class' => 'form-control']) }}

        </div>

        <div class="col-md-12">
            {{ Form::label('survey_id', 'Enquête de rattachement') }}
            {{ Form::select('survey_id', $options) }}

        </div>
        <div class="col-md-2">
            {{ Form::label('is_random', 'Ordre aléatoire') }}
            {{ Form::select('is_random', [false => 'Non', true => 'Oui']) }}
        </div>
        <div class="col-md-2">
            {{ Form::label('allow_multiple', 'Est anonyme') }}
            {{ Form::select('allow_multiple', [false => 'Non', true => 'Oui']) }}
        </div>
        <div class="col-md-2">
            {{ Form::label('show_vote', 'Montre les votes') }}
            {{ Form::select('show_vote', [false => 'Non', true => 'Oui']) }}
        </div>

        {{ Form::submit('Enregistrer', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

    </div>

@endsection
