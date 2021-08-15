<div class="container ml-auto mr-auto p-10">



    <div class="flex flex-row   post-option-background">

        <div class="flex flex-col mr-2 form-field-title">
            <label for="postCategory" class="form-field-title">Catégorie</label>
            <select class="form-field" id="enquiry_for" wire:model="category">
                <option value="Undefined">Indéfinie</option>
                <option value="Annoncements">Annonce</option>
                <option value="Narratives">Récit</option>
                <option value="Page">Page</option>
            </select>
        </div>

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postTitle" class="form-field-title">Titre</label>
            <input type="text" class="form-field" id="postTitle" placeholder="" wire:model="title">
            @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>



    </div>
    <div class="flex flex-row   sub-group ">

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postBegDate" class="form-field-title">Date de début d\'événement</label>
            <input wire:model="beg_date" type="date" id="postBegDate" class="form-field" />
        </div>

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postEndDate" class="form-field-title">Date de fin d\'événement</label>
            <input wire:model="end_date" type="date" id="postEndDate" class="form-field" />
        </div>

        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postCloseDate" class="form-field-title">Date de fin des inscriptions</label>
            <input wire:model="close_date" type="date" id="postCloseDate" class="form-field" />
        </div>


        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postDiaporamaDir" class="form-field-title">Dossier du diaporama</label>
            <input type="text" class="form-field" id="postDiaporamaDir" placeholder="" wire:model="diaporama_dir">
            @error('diaporama_dir') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

    </div>
    <div class="flex flex-col mt-2 mb-2 sub-group">
        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postReceiveRegistration" class="form-field-title">Accepte les inscriptions</label>
            <select class="custom-select border-0 shadow-none form-field" id="postReceiveRegistration"
                wire:model="receive_registration">
                <option value=0>Non</option>
                <option value=1>Oui</option>
            </select>
        </div>
        @if ($receive_registration != 0)
       
            <div class="flex flex-row mt-2 mb-2 ">
                <div class="flex flex-col flex-auto mr-2 form-field-title">
                    <label for="postOptional1" class="form-field-title">Champ facultatif 1</label>
                    <input type="text" class="form-field" id="postOptional1" placeholder="" wire:model="optional1">
                    @error('optional1') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="flex flex-col flex-auto mr-2 form-field-title">
                    <label for="postOptional2" class="form-field-title">Champ facultatif 2</label>
                    <input type="text" class="form-field" id="postOptional2" placeholder="" wire:model="optional2">
                    @error('optional2') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="flex flex-row mt-2 mb-2 ">
                <div class="flex flex-col flex-auto mr-2 form-field-title">
                    <label for="postDirective" class="form-field-title">Directive pour les inscriptions</label>
                    <textarea class="form-field w-full" id="postDirective" wire:model="inscription_directive"
                        placeholder="Saisissez le texte de la directive ici"></textarea>
                    @error('inscription_directive') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
        @endif

    </div>
    <div class="flex flex-row flex-auto mb-3 ">

    </div> 
    <div class="flex flex-row flex-auto mb-3 ">
        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postAbstract" class="form-field-title">Résumé</label>
            <textarea class="form-field w-full" id="postAbstract" wire:model="abstract"
                placeholder="Saisissez l\'article ici'"></textarea>
            @error('abstract') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="flex flex-row flex-auto mb-3 ">
        <div class="flex flex-col flex-auto mr-2 form-field-title">
            <label for="postBody" class="form-field-title">Corps de l'article</label>
            <textarea class="form-field w-full" id="postBody" rows='10' wire:model="body"
                placeholder="Saisissez l\'article ici'"></textarea>
            @error('body') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="button-line flex flex-row">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="button-register">
                Enregistrer l'article
            </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModalPopover()" type="button" class="button-cancel">
                Abandonner
            </button>
        </span>
    </div>

</div>
