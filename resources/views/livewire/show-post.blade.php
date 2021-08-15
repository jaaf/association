<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('This is the header') }}
    </h2>
</x-slot>
<div class="container ml-auto mr-auto pt-2  ">
    <div class="page-title">
        <h1>{{ $post->title }}</h1>
    </div>
    <div class="my-post-body">

        {!! Markdown::parse($post->body) !!}
        <div class="my-bottom-link">
            @if ($post->diaporama_dir)
                @php
                    $dir =  $post->diaporama_dir;
                @endphp

                <a href="/diaporama/show/{{ $post->id }}/{{ $dir }}">
                    Visualisez le diaporama
                </a>
            @endif
        </div>
        <div class="my-bottom-link">

            @if ($post->receive_registration == '1')
                @if (\Carbon\Carbon::parse($post->close_date) >= \Carbon\Carbon::now())
                    <a href="/registrations/{{ $post->id }}">
                        S'inscrire à cet événement
                    </a>
                @else
                    @can('isAtLeastManager')
                        @if ($post->receive_registration == '1')
                            <a href="/registrations/{{ $post->id }}">
                                Voir les inscriptions
                            </a>
                        @endif
                    @endcan
                @endif
            @endif

        </div>
        <div class="post-footer">
            Article écrit par {{ $author->name }} le
            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('l jS F Y') }} à
            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('h:m') }}
        </div>

    </div>
    <div>
        <livewire:post-comment :post=$post />

        <?php \Carbon\Carbon::setLocale('fr'); ?>
    </div>

</div>
