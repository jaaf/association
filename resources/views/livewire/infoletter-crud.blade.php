<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('This is the header') }}
    </h2>
</x-slot>

<div class="container ml-auto mr-auto p-10 min-h-screen">
    <div class="page-title ">{{ $page_title }}</div>
    <div class="button-line flex flex-row">
        @if ($isModalOpen)
            @if ($showMode)
                @include('livewire.show-infoletter')
            @else
                @include('livewire.create-infoletter')
            @endif
        @else
            <div>
                <button wire:click="create()" class="button-cancel text-white font-bold py-2 px-4 rounded my-3">Ajouter
                    une info-lettre</button>
            </div>
    </div>

    @if (count($infoletters) > 0)
        <table class="w-full table-fixed admin-stripped-table">
            <thead>
                <tr class="w-full">
                    <th class=" w-1/12">Id</th>
                    <th class=" w-10/12">Titre</th>
                    <th class=" w-1/12">Actions</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($infoletters as $infoletter)
                    <tr>
                        <td>{{ $infoletter->id }}</td>
                        <td>{{ $infoletter->title }}</td>
                        <td>
                            <div style="display:flex">
                                <button wire:click="show({{ $infoletter->id }})" class="  fontawesome-icon"><span
                                        data-toggle="tooltip" title="Voir"
                                        class=" fa fa-paper-plane fa-xs "></span></button>
                                <button wire:click="edit({{ $infoletter->id }})" class="  fontawesome-icon"><span
                                        data-toggle="tooltip" title="Modifier"
                                        class=" fa fa-edit fa-xs "></span></button>
                                <button
                                    wire:click="$emit('openModal','livewire-modal',{{ json_encode(['type' => 'L\'infolettre', 'ident' => $infoletter->id]) }})"
                                    class=" fontawesome-icon"><span data-toggle="tooltip" title="Supprimer"
                                        class=" fa fa-trash fa-xs "></span></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>,
    @else
        <p>Il n'y a aucune info-lettre</p>
    @endif
    @endif
