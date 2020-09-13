
        
        @foreach ($stickies as $sticky)
           <div class="my-rubric">
            <h2>{{$sticky->title}}</h2>
			{!!Markdown($sticky->abstract, ['config' => 'default']) !!}
			<div class=" my-bottom-link">
			<a href="/posts/{{$sticky->id}}">Lire la suite</a>
			</div>
		</div>
        @endforeach
    