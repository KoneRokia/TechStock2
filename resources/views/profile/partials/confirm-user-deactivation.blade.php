<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" style="font-size:25px">
            {{ __('Désactiver le compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Une fois votre compte désactivé, vous ne pourrez plus y accéder. Avant de désactiver votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <!-- Bouton pour ouvrir le modal de confirmation -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deactivation')"
    >
        {{ __('Désactiver le compte') }}
    </x-danger-button>

    <!-- Modal de confirmation de désactivation -->
    <x-modal name="confirm-user-deactivation" :show="$errors->userDeactivation->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.deactivate') }}" class="p-6">
            @csrf
            @method('put') <!-- Utilisez la méthode PUT pour une mise à jour -->

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Êtes-vous sûr de vouloir désactiver votre compte ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Une fois votre compte désactivé, vous ne pourrez plus y accéder. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez désactiver votre compte.') }}
            </p>

            <div class="mt-6">
                <!-- Champ de saisie pour le mot de passe -->
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <!-- Affichage des erreurs de validation pour le mot de passe -->
                <x-input-error :messages="$errors->userDeactivation->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <!-- Bouton Annuler -->
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('ANNULER') }}
                </x-secondary-button>

                <!-- Bouton Désactiver le compte -->
                <x-danger-button class="ms-3">
                    {{ __('DÉSACTIVER LE COMPTE') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
