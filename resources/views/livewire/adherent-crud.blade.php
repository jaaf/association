<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('This is the header') }}
    </h2>
</x-slot>

<div class="  w-full 2xl:w-11/12 3xl:w-10/12 text-white min-h-screen ml-auto mr-auto p-10">
    <div class="page-title ">{{$page_title}}</div>
    <div class="button-line flex flex-row">
        @if ($isModalOpen)
            @include('livewire.create-adherent')
        @else
            <div>
                <button wire:click="create()" class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Ajouter
                    un adhérent</button>
            </div>
    </div>

    @if (count($adherents) > 0)
        <table class="w-full table-fixed admin-stripped-table">
            <thead>
                <tr class="w-full">
                    <th class=" min-w-min">Id</th>
                    <th class="w-1/12">Prénom</th>
                    <th class="w-1/12">Nom</th>
                    <th class="w-2/12">Commune</th>
                    <th class="min-w-min">Enregistré</th>
                    <th class="min-w-min">Cotisation</th>
                    <th class="w-2/12">Email</th>
                    <th class="w-1/12">Téléphone</th>
                    <th class="">Actions</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($adherents as $adherent)
                    <tr>
                        <td>{{ $adherent->id }}</td>
                        <td>{{ $adherent->firstname }}</td>
                        <td>{{ $adherent->familyname }}</td>
                        <td>{{ $adherent->city }}</td>
                        <td>{{ $adherent->registered }}</td>
                        <td @php if ($adherent->cotisation==='Payée'){ echo ("style='color:white;'");}else{echo("style='color:red;'");}@endphp >{{ $adherent->cotisation }}</td>
                        <td>{{ $adherent->email }}</td>
                        <td>{{ $adherent->phone }}</td>
                        <td>
                            <div style="display:flex">
                                <button wire:click="edit({{ $adherent->id }})" class="  fontawesome-icon"><span
                                        data-toggle="tooltip" title="Modifier"
                                        class=" fa fa-edit fa-xs "></span></button>
                                <button
                                    wire:click="$emit('openModal','livewire-modal',{{ json_encode(['type' => 'L\'adhérent', 'ident' => $adherent->id]) }})"
                                    class=" fontawesome-icon"><span data-toggle="tooltip" title="Supprimer"
                                        class=" fa fa-trash fa-xs "></span></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>,
    @else
        <p>Il n'y a aucun adhérent enregistré.</p>
    @endif
    @endif