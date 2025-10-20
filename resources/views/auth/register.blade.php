<x-guest-layout>
    <!-- Logo du haut -->
    <div class="">
        <img src="{{ asset('images/iTechSTOCK.png') }}" alt="Logo" class="h-12">
    </div>

    <!-- Formulaire -->
    <div class=" rounded-xl p-96 max-w-md ">

        <form method="POST" action="{{ route('register', [], true) }}" id="registerForm">
            @csrf

            <!-- Titre -->
           <div class="text-center text-[#3A5DA8] mb-2">
            <x-input-label for="inscription" :value="__('Inscription')" style="font-size: 20px;; color: #3A5DA8;" class=" text-right"  />
        </div>

            <!-- Nom -->
            <div class="mb-4">
                <x-text-input id="name" class="block w-full border border-gray-300 rounded-md p-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#3A5DA8]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nom" />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <x-text-input id="prenom" class="block w-full border border-gray-300 rounded-md p-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#3A5DA8]" type="text" name="prenom" :value="old('prenom')" required autocomplete="given-name" placeholder="Prénom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Rôle -->
            <div class="mb-4">
                <select id="role" name="role" class="block w-full border border-gray-300 rounded-md p-3 bg-white text-sm text-gray-700 focus:ring-2 focus:ring-[#3A5DA8]" required>
                    <option value="">-- Sélectionner un rôle --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="technicien" {{ old('role') == 'technicien' ? 'selected' : '' }}>Technicien</option>
                    <option value="editeur" {{ old('role') == 'editeur' ? 'selected' : '' }}>Éditeur</option>
                    <option value="utilisateur" {{ old('role') == 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-text-input id="email" class="block w-full border border-gray-300 rounded-md p-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#3A5DA8]" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="E-mail" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <x-text-input id="password" class="block w-full border border-gray-300 rounded-md p-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#3A5DA8]" type="password" name="password" required autocomplete="new-password" placeholder="Mot de passe" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-4">
                <x-text-input id="password_confirmation" class="block w-full border border-gray-300 rounded-md p-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#3A5DA8]" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation du mot de passe" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Lien + bouton -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-[#3A5DA8] hover:underline">
                    Vous avez déjà un compte ?
                </a>

                 <x-primary-button id="registerButton" class="ms-4" style="background-color: #3A5DA8;">
                {{ __('S\'inscrire') }}
            </x-primary-button>
            </div>

            <!-- Chargement -->
            <div id="loading" class="text-sm text-gray-700 mt-3" style="display:none;">
                Inscription en cours...
            </div>

            <!-- Logo bas -->
            <div class="flex justify-center mt-8">
                <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-6">
            </div>
        </form>

        <!-- Affichage erreurs globales -->
        @if ($errors->any())
            <div class="mt-4 bg-red-100 text-red-700 border border-red-300 rounded p-3">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Script chargement -->
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            const button = document.getElementById('registerButton');
            const loading = document.getElementById('loading');
            button.disabled = true;
            loading.style.display = 'block';
        });
    </script>
</x-guest-layout>
