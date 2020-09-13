@extends('layouts.bare')

@section('content')
    <div class="my-bottom-link">
        <a href="/posts/{{$post_id }}">
            Retourner à l'article
        </a>
    </div>
 <div class="light container">
        <p>Pour arrêter le défilement des images, placez le pointeur de la souris sur l'image.</p>
        <p>À l'inverse, pour laisser défiler les images, retirez le pointeur de la souris de l'image.</p>

        </div>
    <div id="option" class="carousel carousel-fade container " data-ride="carousel" data-interval="5000">

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($images as $image)
                    
               
                    @if ($loop->first)
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{$base_dir}}/{{$image}}" alt="First slide"/>
                        </div>

                    @else
                        <div class="carousel-item ">
                            <img class="d-block w-100" src="{{$base_dir}}/{{$image}}" alt="First slide"/>
                        </div>
                    @endif
                @endforeach
               

            </div>
        </div>
        
    </div>
   
@endsection