<div class="container ml-auto mr-auto p-10">



    <div class="flex flex-col  post-option-background">

        <div class="flex flex-col flex-auto mr-2   form-field-title">
            <label for="adherentFirstname" class="form-field-title">Prénom</label>
            <input type="text" class="form-field" id="adherentFirstname" placeholder="" wire:model="firstname">
            @error('firstname') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="flex flex-col flex-auto mr-2  form-field-title">
            <label for="adherentFamilyname" class="form-field-title">Nom</label>
            <input type="text" class="form-field" id="adherentFamilyname" placeholder="" wire:model="familyname">
            @error('familyname') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="adherentCity" class="form-field-title">Commume</label>
            <input type="text" class="form-field" id="adherentCity" placeholder="" wire:model="city">
            @error('city') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="flex flex-col mr-2  form-field-title">
            <label for="adherentRegistered" class="form-field-title">Enregistré</label>
            <select class="form-field" id="adherentRegistered" wire:model="registered">
                <option value="Undefined">–––</option>
                <option value="Non">Non</option>
                <option value="Oui">Oui</option>
            </select>
        </div>
        <div class="flex flex-col mr-2  form-field-title">
            <label for="adherentCotisation" class="form-field-title">État cotisation</label>
            <select class="form-field" id="adherentCotisation" wire:model="cotisation">
                <option value="Undefined">–––</option>
                <option value="Attendue">Attendue</option>
                <option value="Payée">Payée</option>
            </select>
        </div>

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="adherentEmail" class="form-field-title">Adresse électronique</label>
            <input type="text" class="form-field" id="adherentEmail" placeholder="" wire:model="email">
            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="adherentPhone" class="form-field-title">Téléphone</label>
            <input type="text" class="form-field" id="adherentPhone" placeholder="" wire:model="phone">
            @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

    </div>
  

    <div class="button-line flex flex-row">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="button-register">
                Enregistrer l'adhérent
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModalPopover()" type="button" class="button-cancel">
                Abandonner
            </button>
        </span>
    </div>

</div>
