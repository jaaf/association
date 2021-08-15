
<div class="container ml-auto mr-auto p-2  ">
        <div class="border-white border-2 rounded-md p-2 text-center text-2xl mt-4 text-white">
            Historique de l'année {{ $year }}
        </div>
        <div class="container border-2 rounded-md border-white text-white mt-4 p-3 italic ">
            @if (count($posts)>0)
            <ul class="list-disc">
            @foreach ($posts as $post)
                 

                     
                               <li class="ml-5">
                    <a href="{{ route('post.show', ['id' => $post->id]) }}">
                        {{ $post->title }}</a>
                    </li>
            @endforeach
        </ul> 
        @else
            <h3>Il n'y a aucun récit pour l'année {{ $year }}</h3>
            @endif
        </div>
    </div>
