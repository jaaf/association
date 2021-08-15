<div class="delete-modal">
    <div class="modal-title">
        <h2>Confirmation de suppression</h2>
    </div>
    <i class="fa fa-exclamation-triangle modal-danger"></i>
    <div class="modal-text">
        <p> Vous êtes sur le point de supprimer {{ $type }} {{ $ident }}.</p>
        <p>Voulez-vous vraiment le faire ? La suppression sera définitive et irréversible !</p>
    </div>
    <div Class="modal-button-line flex flex-row">
        <button class="modal-cancel-button" wire:click='$emit("closeModal")'>Abandonner</button>
        @if ($type === 'Le commentaire')
            <button class="modal-delete-button" wire:click='deleteComment'>Supprimer le commentaire</button>
        @else @if ($type === 'L article')
                <button class="modal-delete-button" wire:click='deletePost'>Supprimer l'article</button>
            @else @if ($type === 'L\'infolettre')
                    <button class="modal-delete-button" wire:click='deleteInfoletter'>Supprimer l'info-lettre</button>
                @else @if ($type === 'L\'adhérent')
                        <button class="modal-delete-button" wire:click='deleteAdherent'>Supprimer l'adhérent</button>
                    @else @if ($type === 'Le dossier')
                        <button class="modal-delete-button" wire:click='deleteFolder'>Supprimer le dossier</button>
                        @else @if ($type==='L\'image')
                            <button class="modal-delete-button" wire:click='deleteImage'>Supprimer l'image</button>
                        @endif
                    @endif

                    @endif
                @endif


            @endif

        @endif


      

    </div>



</div>
