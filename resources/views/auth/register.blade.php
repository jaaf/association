<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="text-2xl text-black">
                Formulaire de création de compte
            </div>
        </x-slot>

        <div class="text-indigo-500 mb-3">Pour créer un compte, remplissez le formulaire ci-dessous. 
            Pensez à choisir un mot de passe solide comprenant des lettres minuscules et majuscules, des chiffres et des caractères non alphanumériques.</div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Firstname -->
            <div>
                <x-label for="firstname" :value="__('Firstname')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
            </div>
            <!-- Familyame -->
            <div>
                <x-label for="familyname" :value="__('familyname')" />

                <x-input id="familyname" class="block mt-1 w-full" type="text" name="familyname" :value="old('familyname')" required autofocus />
            </div> 
            
            <!-- City -->
            <div>
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>