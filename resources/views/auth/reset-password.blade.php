<x-guest-layout>
    <div class="flex items-center justify-center ">
        <x-input-label for="itechstock" :value="__('iTechStock')" style="font-size:2.2rem ; font-family:arial,sans-serif. font-bold ; color:#2d3061" class=""  />
        <img src="{{ asset('images/logoilimiGroup.jpg') }}" alt="Logo" class="h-12" style="heith:130px; margin-left:90px">
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
            <x-primary-button id="resetPasswordButton">
                {{ __('Réinitialiser le mot de passe') }}
            </x-primary-button>
        </div>

        <div id="loading" style="display:none; color: black; font-size: 14px;">Chargement...</div>
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
