@extends ('layouts.app')

@section('content')
<div class="container mt-4 my-content">
<h1>{{$post->title}}</h1>
<h2> Liste des personnes inscrites </h2>
<div class="container mt-4">
    <div class="button-line">
         <div class="button-link">
             <a href="/registrations/create/{{$post->id}}"  class="my-button-link ">Inscrire une personne</a>
         </div>
         @can('isAtLeastManager')
             <div class="button-link">
             <a href=""  class="my-button-link ">Recevoir la liste par courriel</a>
         </div>
         @endcan
          
         <div class="button-link">
             <a href={{  route('home') }}  class="my-button-link ">Abandonner et retourner à l'accueil</a>
         </div>
    </div>
  
	<table class="table table-striped ">
		<thead>
			<tr>
            <th>N°</th>
				<th>Prénom</th>
				<th>Nom de famille</th>
                <th>Ville ou village</th>
                <th>Observations</th>
               <th>Inscription par </th>  
               
                <th>Actions</th>

			</tr>

		</thead>
        <tbody>
        @foreach($registrations as $registration)
          
            <tr>
            <td>{{$loop->index+1}}</td>
                <td>{{ $registration->firstname }}</td>
                <td>{{ $registration->familyname }}</td>
                <td>{{ $registration->city }}</td>
                <td>{{ $registration->remark }}</td>
                <td>{{ $registration->agent->firstname}} {{$registration->agent->familyname}}</td>
            

                <td style="width:10%;">
                @Auth
                    @can('isAtLeastManager')
                        <?php $hasRights=true; ?>
                    @else 
                        <?php $hasRights=false; ?>
                    @endcan
                    @if(Auth::user()->id== $registration->agent->id or $hasRights)
                       <div style="display:flex;">
                        {!!Form::open(['action'=>['RegistrationController@edit',$registration->id],'method'=>'GET'])!!}
                            {{Form::button('<a class="my-icons-aqua fas fa-edit fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!}

                       {!!Form::open(['action'=>['RegistrationController@destroy',$registration->id],'method'=>'POST', 'onsubmit' => 'return ConfirmDelete()'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::button('<a class="my-icons-aqua fas fa-trash-alt fa-xs"></a>',['type'=>'submit','class'=>'btn btn-submit'])}}
                        {!!Form::close()!!} 
                        </div>
        
                        
                    @endif
                @endAuth
                </td>
            </tr>
        @endforeach
        </tbody>



	</table>
</div>
</div>
<script>

  function ConfirmDelete()
  {
  var x = confirm("Voulez-vous vraiment annuler cette inscription ?");
  if (x)
    return true;
  else
    return false;
  }

</script>
@endsection