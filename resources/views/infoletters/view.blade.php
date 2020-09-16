@extends('layouts.bare')


@section('content')

<div class="container mt-4 my-content">
	<div id='messages'>

	</div>	
 

	<div class="d-flex">
	<a href="/infoletters" class="my-button">Retourner à la liste</a>
					<a href="{{route('infoletter.edit',['id'=>$infoletter->id,'method'=>'PUT'])}}" class="my-button">Modifier</a>
					
			
				<div>
				    {{--below a form with a submit button that will be intercepted by the java script at the bottom of page--}}   
					{{--The script will trigger ajax requests / one per user--}}
					{!! Form::open([]) !!}
						<div class="row post-option-background">
							<div class="col-md-12" >
								{{ Form::hidden('infoletter_id', $infoletter->id) }}{{--permetra de retrouver title et body--}}
								{{ Form::hidden('users', $users )}}{{--permetra de boucler dans jquery--}}
							
							</div>
						</div>
						{{Form::submit('Envoyer a tous',['class'=>'my-button btn  btn-submit btn-to-all','id'=>'btn-to-all'])}}

					{!! Form::close() !!}
				</div>
				<div>
				    {{--below a form with a submit button that will be intercepted by the java script at the bottom of page--}}   
					{{--The script will trigger ajax requests / one per user--}}
					{!! Form::open([]) !!}
						<div class="row post-option-background">
							<div class="col-md-12" >
								{{ Form::hidden('infoletter_id', $infoletter->id) }}{{--permetra de retrouver title et body--}}
								{{ Form::hidden('users', $users )}}{{--permetra de boucler dans jquery--}}
							
							</div>
						</div>
						{{Form::submit('Envoyer au CA',['class'=>'my-button btn  btn-submit btn-to-CA','id'=>'btn-to-CA'])}}

					{!! Form::close() !!}
				</div>
				<div>
				    {{--below a form with a submit button that will be intercepted by the java script at the bottom of page--}}   
					{{--The script will trigger ajax requests / one per user--}}
					{!! Form::open([]) !!}
						<div class="row post-option-background">
							<div class="col-md-12" >
								{{ Form::hidden('infoletter_id', $infoletter->id) }}{{--permetra de retrouver title et body--}}
								{{ Form::hidden('users', $users )}}{{--permetra de boucler dans jquery--}}
							
							</div>
						</div>
						{{Form::submit('Envoyer aux managers',['class'=>'my-button btn  btn-submit btn-to-MNG','id'=>'btn-to-MNG'])}}

					{!! Form::close() !!}
				</div>
				<div>
				    {{--below a form with a submit button that will be intercepted by the java script at the bottom of page--}}   
					{{--The script will trigger ajax requests / one per user--}}
					{!! Form::open([]) !!}
						<div class="row post-option-background">
							<div class="col-md-12" >
								{{ Form::hidden('infoletter_id', $infoletter->id) }}{{--permetra de retrouver title et body--}}
								{{ Form::hidden('user_id',  Auth::user()->id )}}
							
							</div>
						</div>
						{{Form::submit('Envoyer à moi-même (test)',['class'=>'my-button btn  btn-submit btn-to-me','id'=>'btn-to-me'])}}

					{!! Form::close() !!}
				</div>	

	</div>

</div>	
				
<div class="container mt-4 my-content">	
	
	

	<div class="my-post-body">
		<h3 style="color:white;">Objet : {{$infoletter->title}}</h3>
		<hr style="border-top:2px solid lightblue;">
		{!!html_entity_decode($emailview)!!}
		
	</div>		
</div>	

<script type="text/javascript">
	$( document ).ready(function() {
		//$('#messages').append('<h1> Le java scirpt fonctionne</h1>');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				
			}
		});

		$('#btn-to-all').click(function(e){	
			e.preventDefault();
			var infoletter_id = $("input[name=infoletter_id]").val();
			var users = $("input[name=users]").val();
			parsed_users=JSON.parse(users);
			var i=0;
			var url='{{ url('infoletters/sendToOne') }}';
			delay=0;
			for (i=0; i<parsed_users.length;i++){
				$.ajax({
					type:'POST',
					url:url,
					data:{user_id:parsed_users[i].id,infoletter_id:infoletter_id,delay:delay},
					dataType: 'json',
					success:function(data){
						$('#messages').prepend('<div class="comments-message" style="margin-bottom:15px;padding:5px;background-color: green; color: white; margin-top:5px;">'+data['success']+'!.</div>');
					}
				});
                delay=delay+3;
			}	
		});
		$('#btn-to-CA').click(function(e){	
			e.preventDefault();
			var CAMembers=[23,1,4,12,55,19,7,17,18,10,25,5,24];
			var infoletter_id = $("input[name=infoletter_id]").val();
			var users = $("input[name=users]").val();
			parsed_users=JSON.parse(users);
			var i=0;
			var url='{{ url('infoletters/sendToOne') }}';
			delay=0;
			for (i=0; i<parsed_users.length;i++){
				if(CAMembers.includes(parsed_users[i].id)){
					$.ajax({
						type:'POST',
						url:url,
						data:{user_id:parsed_users[i].id,infoletter_id:infoletter_id,delay:delay},
						dataType: 'json',
						success:function(data){
							$('#messages').prepend('<div class="comments-message" style="margin-bottom:15px;padding:5px;background-color: green; color: white; margin-top:5px;">'+data['success']+'!.</div>');
						}
					});
                delay=delay+3;

				}
			}	
		});
		$('#btn-to-MNG').click(function(e){	
			e.preventDefault();
			var CAMembers=[1,69,2];//1 admin, 2 jaaf, 4 sylvie, 7 mayou, 69 marchand (fake)
			var infoletter_id = $("input[name=infoletter_id]").val();
			var users = $("input[name=users]").val();
			parsed_users=JSON.parse(users);
			var i=0;
			var url='{{ url('infoletters/sendToOne') }}';
			delay=0;
			for (i=0; i<parsed_users.length;i++){
				if(CAMembers.includes(parsed_users[i].id)){
					$.ajax({
						type:'POST',
						url:url,
						data:{user_id:parsed_users[i].id,infoletter_id:infoletter_id,delay:delay},
						dataType: 'json',
						success:function(data){
							$('#messages').prepend('<div class="comments-message" style="margin-bottom:15px;padding:5px;background-color: green; color: white; margin-top:5px;">'+data['success']+'!.</div>');
						}
					});
                delay=delay+3;

				}
			}	
		});
		$('#btn-to-me').click(function(e){	
			$('#messages').prepend('<div class="comments-message" style="margin-bottom:15px;padding:5px;background-color: green; color: white; margin-top:5px;">Le script fonctionne.</div>');
			e.preventDefault();
			var infoletter_id = $("input[name=infoletter_id]").val();
			var user_id = $("input[name=user_id]").val();
			var url='{{ url('infoletters/sendToOne') }}';
			$.ajax({
					type:'POST',
					url:url,
					data:{user_id:user_id,infoletter_id:infoletter_id},
					dataType: 'json',
					success:function(data){
						$('#messages').prepend('<div class="comments-message" style="margin-bottom:15px;padding:5px;background-color: green; color: white; margin-top:5px;">'+data['success']+'!.</div>');
					}
				});
				
		});

		
	});
	</script>


@endsection

