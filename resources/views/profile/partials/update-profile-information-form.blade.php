<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informations sur le profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettez à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"  enctype="multipart/form-data">
        @csrf
        @method('patch')


          <!-- Photo de profil -->
        <div class="flex items-center gap-4">
            <div>
                <x-input-label for="photo" :value="('Photo de profil')" />
                <input id="photo" name="photo" type="file" class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100" accept="image/*" onchange="previewImage(event)">
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>
            <div class="w-20 h-20 rounded-full overflow-hidden border">
                @if($user->photo && file_exists(public_path('storage/' . $user->photo)))
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo de profil" class="object-cover w-full h-full">
                
                @endif
            </div>

        </div>

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

                <!-- Champ pour le Rôle -->
                @if(auth()->user()->role === 'admin')
                <div>
                    <x-input-label for="role" :value="__('Rôle')" />
                    <x-text-input id="role" name="role" type="text" class="block w-full mt-1" :value="old('role', $user->role)" required autocomplete="role" />
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
            @endif


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                        {{ __('Votre adresse mail n\'est pas vérifiée') }}

                        <button form="send-verification" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email .') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Sauvegarder.') }}</p>
            @endif
        </div>
    </form>
</section>
