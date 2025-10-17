<nav x-data="{ open: false }" class="bg-[#3A5DA8] border-b border-gray-100 p-6 ">
  <div class="max-w-8xl mx-auto  lg:px-8">
    <div class="flex justify-between h-16 items-center">

   <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 sm:space-x-20">
    <img src="{{ asset('images/iTechSTOCK 1.png') }}" alt="Logo" class="w-20 h-10 object-contain" />
    <h1 class="hidden sm:block text-lg text-white cursor-pointer font-semibold">TABLEAU DE BORD</h1>
</a>


      <!-- Notifications (desktop) -->
      <div class="hidden sm:flex items-center space-x-6">
        <a href="{{ route('notifications.index') }}" class="relative flex items-center text-white hover:text-gray-900">
          <i class="fa fa-bell text-xl"></i>
          <!-- <span class="ml-1 hidden sm:inline">Notifications</span> -->
          @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 -mt-1 -mr-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
              {{ auth()->user()->unreadNotifications->count() }}
            </span>
          @endif
        </a>

        <!-- Profile Dropdown -->
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="flex items-center text-sm font-medium text-white f:text-gray-400 hover:text-white f:hover:text-gray-300 focus:outline-none">
              <div>{{ Auth::user()->name }}</div>
              <svg class="ml-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Se déconnecter</x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Mobile menu button -->
      <div class="sm:hidden flex items-center">
        <button @click="open = !open" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 rounded-md">
          <svg class="w-6 h-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="w-6 h-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div x-show="open" class="sm:hidden bg-white border-t border-gray-200 f:bg-gray-700 f:border-gray-600">
    <div class="pt-2 pb-3 space-y-1">
      <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 f:text-gray-300 f:hover:bg-gray-600">Tableau de bord</a>
      <a href="{{ route('notifications.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 f:text-gray-300 f:hover:bg-gray-600">Notifications</a>
    </div>

    <div class="pt-4 pb-1 border-t border-gray-200 f:border-gray-600">
      <div class="px-4">
        <div class="text-base font-medium text-gray-800 f:text-gray-200">{{ Auth::user()->name }}</div>
        <div class="text-sm font-medium text-gray-500 f:text-gray-400">{{ Auth::user()->email }}</div>
      </div>
      <div class="mt-3 space-y-1">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 f:text-gray-300 f:hover:bg-gray-600">Profil</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 f:text-gray-300 f:hover:bg-gray-600">Se déconnecter</button>
        </form>
      </div>
    </div>
  </div>
</nav>
