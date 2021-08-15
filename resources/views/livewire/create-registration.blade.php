<div class="container ml-auto mr-auto p-10">
    <div class="directive">
        <div class="directive-title">
           <span class=""></span>Veuillez respecter cette directive s.v.p.
        </div>
         {!! Markdown::parse($post->inscription_directive) !!}
    </div>


    <div class="flex flex-row mt-2 mb-2 post-option-background">

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="registrationFirstName" class="form-field-title">Prénom</label>
            <input type="text" class="form-field" id="registrationFirstName" placeholder="" wire:model="firstname">
            @error('firstname') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

    </div>
    <div class="flex flex-row mt-2 mb-2 post-option-background">

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="registrationFamilyName" class="form-field-title">Nom</label>
            <input type="text" class="form-field" id="registrationFamilyName" placeholder="" wire:model="familyname">
            @error('firstname') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

    </div>
    <div class="flex flex-row mt-2 mb-2 post-option-background">

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="registrationCity" class="form-field-title">Ville ou village</label>
            <input type="text" class="form-field" id="registrationCity" placeholder="" wire:model="city">
            @error('city') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

    </div>
    @if ($post->optional1 != '')

        <div class="flex flex-row mt-2 mb-2 post-option-background">
            @if (true)

                <div class="flex flex-col flex-auto mr-2 form-field-title">
                    <label for="registrationOptional1" class="form-field-title"> {{$post->optional1}}</label>
                    <input type="text" class="form-field" id="registrationOptional1" placeholder=""
                        wire:model="optional1">
                    @error('optional1') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            @endif
        </div>
    @endif

    @if ($post->optional2 != '')
        <div class="flex flex-row mt-2 mb-2 post-option-background">
         
                <div class="flex flex-col flex-auto mr-2 form-field-title">
                    <label for="registrationOptional2" class="form-field-title">{{ $post->optional2}}</label>
                    <input type="text" class="form-field" id="registrationOptional2" placeholder=""
                        wire:model="optional2">
                    @error('optional2') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
         

        </div>
    @endif
    <div class="flex flex-row mt-2 mb-2 post-option-background">

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="registrationRemark" class="form-field-title">Commentaire libre</label>
            <input type="text" class="form-field" id="registrationRemark" placeholder="" wire:model="remark">
            @error('remark') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

    </div>

    <div class="button-line flex flex-row">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="button-register">
                Enregistrer l'inscription
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModalPopover()" type="button" class="button-cancel">
                Abandonner
            </button>
        </span>
    </div>

</div>
