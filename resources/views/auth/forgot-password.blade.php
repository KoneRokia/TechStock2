<x-guest-layout>
    <div class="flex items-center justify-center ">
        <x-input-label for="itechstock" :value="__('iTechStock')" style="font-size:2.2rem ; font-family:arial,sans-serif. font-bold ; color:#2d3061" class=""  />
        <img src="/build/assets/logoilimiGroup.png" alt="Logo" class="w-12 h-12" style="width: 130px; heith:130px; margin-left:90px">
    </div>
    <br>
    <div  class="p-4 rounded-lg" style="background-color:#485ea4">

    <div class="mb-4 text-sm text-gray-600" style="color: white">
        {{ __('Vous avez oublié votre mot de passe ? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 " >
            <x-primary-button style="background-color:#f3f4f8 ; color:black"   >
                {{ __('Lien de rénitialisation du mot de passe par e-mail') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-guest-layout>
