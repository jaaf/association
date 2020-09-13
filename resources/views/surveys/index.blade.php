@extends('layouts.bare')

@section('content')
<div class="container mt-4 my-content">
	<h1>Liste des enquêtes</h1>
    <div class="button-line">
         <div class="button-link">
         <a href= "{{route('survey.create')}}">Ajouter une enquête</a>
         </div>
      
    </div>
	<table class="table table-stripped">
		<thead>
			<tr>
                <th>Id</th>
				<th>Titre</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Ordre aléatoire</th>
                <th>Anonyme</th>
                <th>Montre les votes</th>
                

				<th>Actions</th>
			</tr>

		</thead>
        <tbody>
        @foreach($surveys as $survey)
            <tr>
                <td>{{ $survey->id }}</td>
                <td>{{ $survey->title }}</td>
                <td>{{\Carbon\Carbon::parse($survey->date_beg)->translatedFormat('l jS F Y')}}</td>
                <td>{{\Carbon\Carbon::parse($survey->date_fin)->translatedFormat('l jS F Y')}}</td>
                <td>{{ $survey->is_random }}</td>
                <td>{{ $survey->anonymous }}</td>
                <td>{{ $survey->show_vote }}</td>
                <td>
                    <div style="display:flex;">
                      
                    {!!Form::open(['action'=>['SurveyController@view',$survey->id],'method'=>'GET'])!!}
                            {{Form::button('<a class="my-icons-aqua fas fa-paper-plane fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!}
                        {!!Form::open(['action'=>['SurveyController@edit',$survey->id],'method'=>'GET'])!!}
                            {{Form::button('<a class="my-icons-aqua fas fa-edit fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!}

                       {!!Form::open(['action'=>['SurveyController@destroy',$survey->id],'method'=>'POST', 'onsubmit' => 'return ConfirmDelete()'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::button('<a class="my-icons-aqua fas fa-trash-alt fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!} 
                        </div>
                </td>
            </tr>
        @endforeach
        </tbody>



	</table>
</div>

@endsection