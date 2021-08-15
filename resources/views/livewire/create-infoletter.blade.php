<div class="container ml-auto mr-auto p-10">



    <div class="flex flex-col  post-option-background">

        <div class="flex flex-col flex-auto mr-2   form-field-title">
            <label for="infoletterTitle" class="form-field-title">Titre</label>
            <input type="text" class="form-field" id="infoletterFirstname" placeholder="" wire:model="title">
            @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="flex flex-row flex-auto mb-3 ">
            <div class="flex flex-col flex-auto mr-2 form-field-title">
                <label for="infoletterBody" class="form-field-title">Corps de l'info-lettre</label>
                <textarea class="form-field w-full" id="infoletterBody" rows='10' wire:model="body"
                    placeholder="Saisissez le texte ici"></textarea>
                @error('body') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>



    </div>


    <div class="button-line flex flex-row">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="button-register">
                Enregistrer l'info-lettre
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModalPopover()" type="button" class="button-cancel">
                Abandonner
            </button>
        </span>
    </div>

</div>
