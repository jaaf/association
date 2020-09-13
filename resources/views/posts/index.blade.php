@extends('layouts.bare')
@section('content')

<div class="container mt-4 my-content">
		<h1>Liste des articles</h1>
		<div class="button-line">
			<div class="button-link">
				<a href="/posts/create" class="my-button-link ">Ajouter un article </a>
			</div>

		</div>
		@if (count($posts)>0)
		    <table class="table table-stripped">
			    <thead>
				    <tr>
					    <th>Id</th>
					    <th>Titre</th>
					    <th>Catégorie</th>
					    <th>Épinglé</th>

					    <th>Actions</th>
				    </tr>

			    </thead>
			    <tbody>
            
            
				@foreach($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>{{ $post->title }}</td>
						<td>{{ $post->category }}</td>
						<td>{{ $post->sticky }}</td>
						<td>
							<div style="display:flex">
                            
								<div class="like-form-submit-button"><a href="/posts/{{$post->id}}">
								
									<span data-toggle="tooltip" title="Voir en front-end" class="my-icons fas fa-eye fa-xs "></span>
								</a></div>
								
								@if( $user->id = $post->author_id)
								
									<div class="like-form-submit-button"><a href="/posts/{{$post->id}}/edit">
									
										<span data-toggle="tooltip" title="Modifier" class="my-icons fas fa-edit fa-xs "></span>
									</a></div>
									{!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST', 'onsubmit' => 'return ConfirmDelete()'])!!}
									{{Form::hidden('_method','DELETE')}}
									{{Form::button('<a class="my-icons-aqua fas fa-trash-alt fa-xs"></a>',['type'=>'submit','class'=>'my-icons btn btn-submit'])}}
									{!!Form::close()!!} 
								@endif
                            </div>

						</td>
					</tr>
				@endforeach
				
             </tbody>


		</table>,
		{{$posts->links()}}
            @else
            <p>Il n'y a aucun article</p>    
            @endif
			
	
	</div>
@endsection
