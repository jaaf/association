<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('This is the header') }}
    </h2>
</x-slot>

<div class="container m-auto p-20">
    <div class="page-title ">{{$page_title}}</div>
    <div class="">
        @if ($isModalOpen)
            @include('livewire.create-post')
        @else
            <div>
                <button wire:click="create()" class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter
                    un article</button>
            </div>
    </div>

    @if (count($posts) > 0)
        <table class="w-full table-fixed admin-stripped-table m-auto">
            <thead class=" w-full ">
                <tr class="w-full">
                    <th class="">Id</th>
                    <th class="w-6/12">Titre</th>
                    <th class="w-3/12">Catégorie</th>
                    <th class="w-1/12">Épinglé</th>

                    <th class="w-1/12">Actions</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->sticky }}</td>
                        <td>
                            <div style="display:flex">
                                <div class="like-form-submit-button"><a href="/post/{{$post->id}}">
								
									<span data-toggle="tooltip" title="Voir en front-end" class=" fontawesome-icon my-icons fa fa-eye fa-xs "></span>
								</a></div>
                                <button wire:click="edit({{ $post->id }})" class="  fontawesome-icon"><span
                                        data-toggle="tooltip" title="Modifier"
                                        class=" fa fa-edit fa-xs "></span></button>
                                <button
                                    wire:click="$emit('openModal','livewire-modal',{{ json_encode(['type' => 'L article', 'ident' => $post->id]) }})"
                                    class=" fontawesome-icon"><span data-toggle="tooltip" title="Supprimer"
                                        class=" fa fa-trash fa-xs "></span></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>,
    @else
        <p>Il n'y a aucun article</p>
    @endif
    @endif