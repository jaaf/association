@extends('layouts.bare')

@section('content')
<div class="container  container-admin mt-4 my-content">
	<h1>Liste des lettres d'information</h1>
    <div class="button-line">
         <div class="button-link">
         <a href= "{{route('infoletter.create')}}">Ajouter une lettre</a>
         </div>
    </div>
	<table class="table table-stripped infoletter-list-preview">
		<thead>
			<tr>
                <th>Id</th>
				<th>Titre</th>
                <th>Contenu</th>
                

				<th>Actions</th>
			</tr>

		</thead>
        <tbody>
        {@foreach($infoletters as $infoletter)
            <tr>
                <td>{{ $infoletter->id }}</td>
                <td>{{ $infoletter->title }}</td>
                <td>{!! $infoletter->body !!}</td>{{--interprète le html--}}
                <td>
                    <div style="display:flex;">
                      
                    {!!Form::open(['action'=>['InfoletterController@view',$infoletter->id],'method'=>'GET'])!!}
                            {{Form::button('<a class="my-icons-aqua fas fa-paper-plane fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!}
                        {!!Form::open(['action'=>['InfoletterController@edit',$infoletter->id],'method'=>'GET'])!!}
                            {{Form::button('<a class="my-icons-aqua fas fa-edit fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!}

                       {!!Form::open(['action'=>['InfoletterController@destroy',$infoletter->id],'method'=>'POST', 'onsubmit' => 'return ConfirmDelete()'])!!}
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
