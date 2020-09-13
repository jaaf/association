	<div class="container comments comments-wrap" >
		<h2 class="comments-title">Commentaires des adhérents</h2>
		<div class="comment-form">
				<div class="comment-invite">
					Laissez un commentaire ici
				</div>
				{!! Form::open([]) !!}
					<div class="row post-option-background">
						<div class="col-md-12" >
						    {{ Form::hidden('post_id', $post->id) }}
							{{ Form::hidden('agent_id', auth()->user()->id) }}
							 {{ Form::textarea('content','',['id'=>'content','rows'=>2,'class'=>'form-control'])}}
						</div>
					</div>
					{{Form::submit('Enregistrer',['class'=>'btn btn-primary btn-submit'])}}

				{!! Form::close() !!}

		</div>
		<div id="commentaires">
			@foreach ($comments as $comment)
				<div class="comment-header">
					Posté par
					{!! \App\User::find($comment->agent_id)->firstname; !!}
					{!! \App\User::find($comment->agent_id)->familyname; !!}
					
					le
					<?php \Carbon\Carbon::setLocale('fr');?>
					{{\Carbon\Carbon::parse($comment->created_at)->translatedFormat('l jS F Y')}}
				</div>
				<div class="comment-body">
					{{$comment->content}}
				</div>
			@endforeach
		</div>
		@auth
			
		@endauth
		@guest
			<div class="comment-invite">
				Connectez-vous pour laisser un commentaire
			</div>
		@endguest
	</div>

	<script type="text/javascript">
	$( document ).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				
			}
		});

		$(".btn-submit").click(function(e){	
			e.preventDefault();
			var post_id = $("input[name=post_id]").val();
			var agent_id = $("input[name=agent_id]").val();
			var content = $("#content").val();
			console.log('the content is '+content);
            console.log('post_id is : '+post_id+', agent_id is : '+agent_id+' and content is : '+content);
			var url='{{ url('comments') }}';
			console.log(url);
			$.ajax({
			    type:'POST',
			    url:url,
                data:{post_id:post_id, agent_id:agent_id, content:content},
                dataType: 'json',
			    success:function(data){
					 
					 $("#commentaires").prepend("<div class='comment-header'> Posté par moi, il y a peu.</div><div class='comment-body'>"+data['content']+"</div>");
					 console.log(data['success']);
					 $('.comments-wrap').prepend('<div class="comments-message" style="padding:5px;background-color: green; color: white; margin-top:5px;">Merci votre nouveau commentaire a été ajouté à la liste.</div>');
					 $('.comments-message').hide().fadeIn(3000);
					 }
			});
			console.log('reaching end of click function');
			$('#content').val('');
			
		});
	});
	</script>

