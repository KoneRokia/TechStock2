<!-- Bouton menu (mobile uniquement) -->
<div class="md:hidden p-4 m-0 bg-blue-900 text-white justify-between items-center -translate-y-1">
  <span class="font-bold">Menu</span>
  <button id="sidebarToggle" class="text-2xl focus:outline-none">☰</button>
</div>

<!-- Overlay (mobile) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar"
  class="fixed md:static left-0 top-0 md:top-auto z-50 w-16 md:w-64 min-h-screen -translate-y-1
          text-white bg-blue-900 shadow-lg transform -translate-x-full md:translate-x-0
         transition-transform duration-300">

  <nav class="space-y-1 md:space-y-1">
    <div class="relative">
      <!-- Bordure arrondie supérieure -->
      @if(request()->routeIs('dashboard'))
      <div class="hidden md:block absolute -top-6 right-0 ">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('dashboard') }}" aria-label="Tableau de bord" title="Tableau de bord"
         class="group w-full flex items-center justify-center md:justify-start
                p-2 transition
                {{ request()->routeIs('dashboard') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">🏠</span>
        <span class="hidden md:inline ml-2 text-xl">Tableau de bord</span>
      </a>

      <!-- Bordure arrondie inférieure -->
      @if(request()->routeIs('dashboard'))
      <div class="hidden md:block absolute -bottom-6 right-0 ">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('equipements.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('equipements.index') }}" aria-label="Équipements" title="Équipements"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('equipements.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">🛠️</span>
        <span class="hidden md:inline ml-2 text-xl">Équipements</span>
      </a>

      @if(request()->routeIs('equipements.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('maintenances.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('maintenances.index') }}" aria-label="Maintenances" title="Maintenances"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('maintenances.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">⚙️</span>
        <span class="hidden md:inline ml-2 text-xl">Maintenances</span>
      </a>

      @if(request()->routeIs('maintenances.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('historiques.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('historiques.index') }}" aria-label="Historique" title="Historique"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('historiques.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">📜</span>
        <span class="hidden md:inline ml-2 text-xl">Historique</span>
      </a>

      @if(request()->routeIs('historiques.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('rapports.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('rapports.index') }}" aria-label="Rapports" title="Rapports"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('rapports.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">📑</span>
        <span class="hidden md:inline ml-2 text-xl">Rapports</span>
      </a>

      @if(request()->routeIs('rapports.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('users.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('users.index') }}" aria-label="Utilisateurs" title="Utilisateurs"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('users.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">👥</span>
        <span class="hidden md:inline ml-2 text-xl">Utilisateurs</span>
      </a>

      @if(request()->routeIs('users.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('employes.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('employes.index') }}" aria-label="Employés" title="Employés"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('employes.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">🧑</span>
        <span class="hidden md:inline ml-2 text-xl">Employés</span>
      </a>

      @if(request()->routeIs('employes.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('logiciels.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('logiciels.index') }}" aria-label="Logiciels" title="Logiciels"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('logiciels.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">🖥️</span>
        <span class="hidden md:inline ml-2 text-xl">Logiciels</span>
      </a>

      @if(request()->routeIs('logiciels.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>

    <div class="relative">
      @if(request()->routeIs('licences.index'))
      <div class="hidden md:block absolute -top-6 right-0">
        <div class="absolute bottom-0 right-0 w-full h-full bg-[#F3F3F3] rounded-bl-full"></div>
      </div>
      @endif

      <a href="{{ route('licences.index') }}" aria-label="Licences" title="Licences"
         class="group w-full flex items-center justify-center md:justify-start
                p-3 transition
                {{ request()->routeIs('licences.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-blue-600' }}">
        <span class="text-2xl">🔑</span>
        <span class="hidden md:inline ml-2 text-xl">Licences</span>
      </a>

      @if(request()->routeIs('licences.index'))
      <div class="hidden md:block absolute -bottom-6 right-0">
        <div class="absolute top-0 right-0 w-full h-full bg-[#F3F3F3] rounded-tl-full"></div>
      </div>
      @endif
    </div>
  </nav>
</aside>

<!-- Script -->
<script>
  const sidebar = document.getElementById('sidebar');
  const toggleButton = document.getElementById('sidebarToggle');
  const overlay = document.getElementById('overlay');

  if (toggleButton) {
    toggleButton.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    });
  }

  if (overlay) {
    overlay.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    });
  }

  document.querySelectorAll('#sidebar a').forEach(a => {
    a.addEventListener('click', () => {
      if (window.matchMedia('(max-width: 767px)').matches) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      }
    });
  });
</script>