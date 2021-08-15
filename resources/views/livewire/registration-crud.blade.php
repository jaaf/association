<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('This is the header') }}
    </h2>
</x-slot>

<div class="container ml-auto mr-auto p-10">
    <div class="page-title ">{{$page_title}}</div>
    <div class="button-line flex flex-row">
        @if ($isModalOpen)
            @include('livewire.create-registration')
        @else
            <div>
                <button wire:click="create()" class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Inscrire une personne</button>
            </div>
    </div>

    @if (count($registrations) > 0)
        <table class="w-full table-fixed stripped-table">
            <thead>
                <tr class="w-full">
                    <th class="w-1/12">Id</th>
                    <th class="w-2/12">Prénom</th>
                    <th class="w-2/12">Nom</th>
                    <th class="w-2/12">Ville ou village</th>
                    @if($post->optional1!='')<th class="">{{$post->optional1}}</th>@endif 
                    @if($post->optional2!='')<th class="w-1/12">{{$post->optional2}}</th>@endif
                    <th class="w-1/12">Actions</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>
                        <td>{{ $registration->id }}</td>
                        <td>{{ $registration->firstname }}</td>
                        <td>{{ $registration->familyname }}</td>
                        <td>{{ $registration->city}}</td
                        >@if($post->optional1!='')<td>{{$registration->optional1}}</td>@endif 
                        @if($post->optional2!='')<td>{{$registration->optional2}}</td>@endif
                        <td>
                            <div style="display:flex">
                                <button wire:click="edit({{ $registration->id }})" class="  fontawesome-icon"><span
                                        data-toggle="tooltip" title="Modifier"
                                        class=" fa fa-edit fa-xs "></span></button>
                                <button
                                    wire:click="$emit('openModal','livewire-modal',{{ json_encode(['type' => "L'inscription", 'ident' => $registration->id]) }})"
                                    class=" fontawesome-icon"><span data-toggle="tooltip" title="Supprimer"
                                        class=" fa fa-trash fa-xs "></span></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>,
    @else
        <p>Il n'y a aucune personne inscrite pour le moment</p>
    @endif
    @endif