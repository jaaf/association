@foreach ($stickies as $sticky)
    <div class=" sticky text-white border-2 border-white rounded-lg p-3 mb-4">
        <h2>{{ $sticky->title }}</h2>
        {!! Markdown::parse($sticky->abstract, ['config' => 'default']) !!}
        <div class=" my-bottom-link">
            <a href="/posts/{{ $sticky->id }}">Lire la suite</a>
        </div>
    </div>
@endforeach
