<x-app-layout>
    

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 f:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 f:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="flex space-x-6">
                <div class="flex-1 p-4 bg-white shadow sm:p-8 f:bg-gray-800 sm:rounded-lg">
                    @include('profile.partials.delete-user-form')
                </div>

                 <!-- Section de désactivation de compte -->
                 <div class="flex-1 p-4 bg-white shadow sm:p-8 f:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.confirm-user-deactivation')
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white shadow sm:p-8 f:bg-gray-800 sm:rounded-lg">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class=" px-4 py-2 font-bold text-white transition bg-red-500 rounded-lg hover:bg-red-600">
                        Déconnexion
                    </button>
                </form>
    </div>
        </div>
    </div>
</x-app-layout>
