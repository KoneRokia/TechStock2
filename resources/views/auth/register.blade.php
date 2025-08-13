<x-guest-layout>
    <div class="flex items-center justify-center ">
        <x-input-label for="itechstock" :value="__('iTechStock')" style="font-size:2.2rem ; font-family:arial,sans-serif. font-bold ; color:#2d3061"  />
        <img src="{{ asset('images/logoilimiGroup.jpg') }}" alt="Logo" class="h-12" style="heith:130px; margin-left:90px"> <br>
    </div> <br> 

    <div class="p-4 rounded-lg" style="background-color:#485ea4">

    <form method="POST" action="{{ route('register', [], true) }}" id="registerForm">
        @csrf
        <div class="text-center">
            <x-input-label for="inscription" :value="__('Inscription')" style="font-size:1.5rem" class="text-white"  />

        </div> <br><br>

        <!-- Name -->
        <div>
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nom" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Prenom -->
        <div>
            <x-text-input id="prenom" class="block w-full mt-1" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" placeholder="Prénom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Rôle -->
    <div class="mt-4">
    <select id="role" name="role" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        <option value="">-- Sélectionner un rôle --</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="technicien" {{ old('role') == 'technicien' ? 'selected' : '' }}>Technicien</option>
        <option value="editeur" {{ old('role') == 'editeur' ? 'selected' : '' }}>Éditeur</option>
        <option value="utilisateur" {{ old('role') == 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
    </select>
    <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="E-mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password"  placeholder="Mot de passe" />

            <x-input-error :messages="$errors->get('password')" class="mt-2"  />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation mot de passe" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm underline rounded-md text-white-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login')  }}" style="color:#f3f4f8">
                {{ __('Vous avez déjà un Compte?') }}
            </a>

            <x-primary-button id="registerButton" class="ms-4" style="background-color:#f3f4f8 ; color:black">
                {{ __('S\'inscrire') }}
            </x-primary-button>

            <div id="loading" style="display:none; color: black; font-size: 14px;">Chargement...</div>

    </form>

    <script>

document.getElementById("registerForm").addEventListener("submit", function(event) {
    var button = document.getElementById('registerButton');
    var loading = document.getElementById('loading');

    // Désactiver le bouton et afficher l'indicateur de chargement
    button.disabled = true;
    loading.style.display = 'block';
});

    </script>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


<!--Nom de l'application en bas-->

</div>
</x-guest-layout>

