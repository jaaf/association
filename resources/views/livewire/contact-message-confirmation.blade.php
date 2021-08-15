{{--This view is displayed after a guest has clicked the message send confirmation link in the mail addressed to they.
    It is rendered from the ContactMessageConfirmation livewire component--}}
    
<div class="text-white">

    <p class="text-xl">Vous avez posté un message sur notre site.</p>
    @if ($message)
        <p>Ce message est le suivant. Vous pouvez encore le modifier.</p>

        <form action="wire:submit.prevent='sendMessage'"></form>
        <div class="flex flex-row flex-auto mb-3 ">
            <div class="flex flex-col flex-auto mr-2 form-group">
                <label for="infoletterBody" class="form-field-title">Contenu de votre message</label>
                <textarea class="form-field w-full" id="content" rows='10' wire:model="content"
                    placeholder="Saisissez le texte ici"></textarea>
                @error('content') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>
        @if ($button_visible)
            <div class="form-group flex flex-row">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="sendMessage()" type="button" class="button-register">
                        Je confirme cet envoi
                    </button>
                </span>

            </div>
        @endif


    @else
        <p>Malheureusement ce message n'a pas été conservé, soit parce que son délai de conservation a été dépassé, soit
            parce que vous l'avez déja confirmé (envoyé).</p>
        <p>Nous vous rappelons que vous disposez de 24 heures pour confirmer tout message posté sur notre site.</p>
        <p>N'hésitez pas à refaire une tentative, en n'oubliant pas de confirmer son envoi en répondant au courriel qui
            vous a été envoyé.</p>

    @endif
</div>
