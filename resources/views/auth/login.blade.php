<x-guest-layout>
    <div class="flex items-center justify-center ">
        <x-input-label for="itechstock" :value="__('iTechStock')" style="font-size:2.2rem ; font-family:arial,sans-serif. font-bold ; color:#2d3061" class=""  />
        <img src="/build/assets/logoilimiGroup.png" alt="Logo" class="w-12 h-12" style="width: 130px; heith:130px; margin-left:90px">
    </div>
    <br>
    <div class="p-4 rounded-lg" style="background-color:#485ea4		 ">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}"  id="loginForm">
        @csrf
        <div class="text-center">
            <x-input-label for="connexion" :value="__('Connexion')" style="font-size:1.5rem" class="text-white"  />

        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-white" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" style="color:white">
                    {{ __('Mot de passe oublier?') }}
                </a>
            @endif

            <x-primary-button id="loginButton" class="ms-4" style="background-color:#f3f4f8 ; color:black">
                {{ __('Se connecter') }}
            </x-primary-button>

            <div id="loading" style="display:none; color: black; font-size: 14px;">Chargement...</div>
        </div>
    </form>
<!--Nom de l'application en bas-->
<script>
            document.getElementById("loginForm").addEventListener("submit", function(event) {
    var button = document.getElementById('loginButton');
    var loading = document.getElementById('loading');

    // Désactiver le bouton et afficher le chargement
    button.disabled = true;
    loading.style.display = 'block';
});

</script>

</x-guest-layout>
