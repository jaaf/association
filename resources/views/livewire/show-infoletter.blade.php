<div class="container ml-auto mr-auto p-10 text-white">

    <div class="button-line flex flex-row">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="closeModalPopover()" type="button" data-toggle="tooltip" title="Retourner à la liste" 
            class="button-cancel text-gray-50 text-4xl mr-7 fa fa-arrow-left fa-xs">
           
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="sendToMe({{$infoletter_id}},'12')" type="button" class="button-cancel">
                Envoyer à moi-même
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="sendToCA({{$infoletter_id}})" type="button" class="button-cancel">
                Envoyer au CA
            </button>
        </span> 
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="sendToManagers({{$infoletter_id}})" type="button" class="button-cancel">
                Envoyer aux managers
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="sendToAll({{$infoletter_id}})" type="button" class="button-cancel">
                Envoyer à tous
            </button>
        </span>
    </div>
    This is show info-letter {{$infoletter_id}}

</div>