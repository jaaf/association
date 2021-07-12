<div class="my-rubric">
		<h2>
			Agenda
		</h2>

		<div class="accordion" id="accordionExample">
        @if (count($events)>0)
			@foreach($events as $event)
				<div class="card my-accordion-card z-depth-0 bordered">
					<div class="card-header" id="heading{{ $loop->index }}">
						<h5 class="mb-0">
							<button class="btn btn-link my-accordion-button" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
								{{ $loop->index+1 }}
								-
								{{ $event->title }}
							</button>
						</h5>
					</div>
					<div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionExample">
						<div class="card-body my-accordion-card-body">
							{{ $event->abstract }}
							<div class="my-accordion-link">
								<a href="posts/{{$event->id}}">
									<hr/>
									<span class="my-accordion-link-span">Lire l'article</span>
								</a>
							</div>
							@if ($event->receive_registration== 1 )
								<div class="my-accordion-link">
									<a href="/registrations/{{$event->id}}">
										<hr/>
										<span class="my-accordion-link-span">S'inscrire à cet événement</span>
									</a>
								</div>
							@endif 
							
						</div>
					</div>
				</div>
			@endforeach
        @else 
           <p style="color:lightblue; font-size: 1.5em;">Il n'y a rien à l'agenda</p>
        @endif    
		</div>

	</div>