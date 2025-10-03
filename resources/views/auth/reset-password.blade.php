<x-guest-layout>
   <div class=" ">
        <img src="{{ asset('images/iTechSTOCK.png') }}" alt="Logo" class="h-12" style=" margin-left:10px">
    </div> <br>

         <div class="text-center text-[#3A5DA8]">
            <x-input-label for="reinitialisation de mot de passe" :value="__('Rénitialisation du mot de passe')" style="font-size: 16px; color: #3A5DA8;" class=" text-right"  />

        </div>
    <form method="POST" action="{{ route('password.store') }}"  id="resetPasswordForm">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="resetPasswordButton" style="background-color:#3A5DA8">
                {{ __('Réinitialiser le mot de passe') }}
            </x-primary-button>
        </div>

        <div id="loading" style="display:none; color: black; font-size: 14px;">Chargement...</div>

        <div class="flex justify-center mt-6   bottom-10">
                <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-7">
        </div>
    </form>

    <script>
        document.getElementById("resetPasswordForm").addEventListener("submit", function(event) {
    var button = document.getElementById('resetPasswordButton');
    var loading = document.getElementById('loading');

    // Désactiver le bouton et afficher l'indicateur de chargement
    button.disabled = true;
    loading.style.display = 'block';
    });

    </script>
</x-guest-layout>
