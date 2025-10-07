<x-guest-layout>
    <div class=" ">
        <img src="{{ asset('images/iTechSTOCK.png') }}" alt="Logo" class="h-12" style=" margin-left:10px">
    </div>
    <br>
    <div  class="p-4 rounded-lg">
        <div class="text-center text-[#3A5DA8]">
            <x-input-label for="Rénitialisez votre mot de passe" :value="__('Rénitialisez votre mot de passe')" style="font-size:16px; color: #3A5DA8;" class=" text-right"  />

        </div> <br>

    <div class="mb-4 text-sm text-gray-600" style="color: black">
        {{ __('Vous avez oublié votre mot de passe ? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="E-mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 " >
            <x-primary-button style="background-color: #3A5DA8; color:white"   >
                {{ __('Lien de rénitialisation du mot de passe par e-mail') }}
            </x-primary-button>
        </div>

        
             <div class="flex justify-center mt-6   bottom-10">
                <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-7">
            </div>
    </form>
</div>
</x-guest-layout>
