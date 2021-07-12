@extends('layouts.bare')

@section('content')
	<div class="container mt-4 my-content">
		<h1>Liste des adhérents</h1>
		<div class="button-line">
			<div class="button-link">
			<a href="{{route('adherent.create')}}" class="my-button-link ">Ajouter un adhérent</a>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>N°</th>
					<th>Prénom</th>
					<th>Nom</th>
                    <th>Commune</th>
                    <th>À jour cotisation</th>
                    <th>Enregistré</th>
                    <th>Email</th>
                    <th>Téléphone</th>
					<th>Actions</th>
				</tr>

			</thead>
			<tbody>
				@foreach ($adherents as $adherent)
					<tr>
						<td>{{$loop->index+1}}</td>
						<td>{{ $adherent->firstname }}</td>
						<td>{{ $adherent->familyname }}</td>
                        <td>{{ $adherent->city }}</td>
                        <td>{{ $adherent->cotisation}}</td>
                        <td>{{ $adherent->registered}}</td>
                        <td>{{ $adherent->email}}</td>
                        <td>{{ $adherent->phone}}</td>
						<td>
							<div style="display:flex">
								<div class="like-form-submit-button">
									<a href="{{route('adherent.edit',['id'=>$adherent->id])}}">
									<span data-toggle="tooltip" title="Modifier" class="my-icons fas fa-edit fa-xs"></span>
									</a>
								</div>	
								{!!Form::open(['action'=>['AdherentController@destroy',$adherent->id],'method'=>'POST', 'onsubmit' => 'return ConfirmDelete()'])!!}
									{{Form::hidden('_method','DELETE')}}
									{{Form::button('<a class="my-icons-aqua fas fa-trash-alt fa-xs"></a>',['type'=>'submit','class'=>'my-icons btn btn-submit'])}}
								{!!Form::close()!!} 
						</div>			
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection