<x-guest-layout>
    <div class=" ">
        <img src="{{ asset('images/iTechSTOCK.png') }}" alt="Logo" class="h-12" style=" margin-left:10px">
    </div>

<div class="p-4 rounded-xl">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
 
    <form method="POST" action="{{ route('login') }}"  id="loginForm">
        @csrf
        <div class="text-center text-[#3A5DA8] mb-2">
            <x-input-label for="connexion" :value="__('Connexion')" style="font-size: 20px; color: #3A5DA8;" class=" text-right"  />

        </div>
        <!-- Email Address -->
        <div>
            <!-- <x-input-label for="email" :value="__('Email')" class="text-black" /> -->
            <x-text-input id="email" class="block mt-1 w-full text-[#989898]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="E-mail"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <!-- <x-input-label for="password" :value="__('Mot de passe')" class="text-black"/> -->

            <x-text-input id="password" class="block mt-1 w-full text-[#989898]"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Mot de passe" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('password.request') }}" style="color: #3A5DA8;">
                  {{ __('Mot de passe oublié?') }}
                </a>
            @endif

            <x-primary-button id="loginButton" style="background-color:#3A5DA8 ; color:black" class="ms-4 ">
             <span class="text-white"> {{ __('Se connecter') }}</span>   
            </x-primary-button>

            <div id="loading" style="display:none; color: black; font-size: 14px;"></div>
        </div>

            <div class="mt-4 text-center">
                <a href="{{route('register')}}" class="text-sm text-[#3A5DA8]"> Pas encore de compte? Créez-en un 
                </a>
            </div>
        <div class="flex justify-center mt-6   bottom-10">
                <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-7">
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
        
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded">
            {{ session('error') }}
        </div>
    @endif
    

</x-guest-layout>