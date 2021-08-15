<div class="container my-post my-content ">
    <div class="w-full border border-2px border-white rounded-lg p-2 mb-4 text-center">
        <span class="text-white  text-2xl">Laissez-nous un message</span>
    </div>

    <div class="light">
        <p>Si vous avez du mal à lire le captcha (dispositif anti-robot), n'hésitez pas à le rafraîchir autant de fois
            que nécessaire pour n'avoir aucun doute.</p>

    </div>



    <form wire:submit.prevent="sendMessage">
        @csrf
        <div class=" form-group flex flex-col flex-auto mr-2  ">
            <label for="firstname" class="form-field-title">Prénom</label>
            <input wire:model="firstname" type="text" class="form-field w-1/2" id="firstname" placeholder="">
            @error('firstname') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>


        <div class=" form-group flex flex-col flex-auto mr-2  ">
            <label for="familyname" class="form-field-title">Nom</label>
            <input wire:model="familyname" type="text" class="form-field w-1/2" id="familyname" placeholder="">
            @error('familyname') <span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class=" form-group flex flex-col flex-auto mr-2  ">
            <label for="email" class="form-field-title">Adresse électronique</label>
            <input wire:model="email" type="text" class="form-field w-1/2" id="email" placeholder="">
            @error('email') <span class="text-red-500">{{ $message }} text</span>@enderror
        </div>



        <div class="form-group ">
            <label for="body" class=" form-field-title text-md-right">{{ 'Votre message' }}</label>

            <div class="col-md-10">

                <textarea wire:model="body" id=bodye" name="body" cols="80" rows="10" class="form-field name=" body"
                    value="{{ old('body') }}" required>{{ old('body') }}</textarea>
                @error('body') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>

<div class="button-line flex flex-row">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="button-register">
                Enregistrer
            </button>
        </span>
       
    </div>


    </form>


</div>
