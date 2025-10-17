<!-- Bouton menu (mobile uniquement) -->
<div class="md:hidden p-4 m-0 bg-blue-900 text-white justify-between items-center ">
  <span class="font-bold">Menu</span>
  <button id="sidebarToggle" class="text-2xl focus:outline-none">☰</button>
</div>

<!-- Overlay (mobile) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar"
  class="fixed md:static left-0 top-0 md:top-auto z-50 w-16 md:w-64 min-h-screen -translate-y-[5px]
          text-white bg-[#3A5DA8]  transform -translate-x-full md:translate-x-0
         transition-transform duration-300">

  <nav class="space-y-1 md:space-y-1">

    <!-- Tableau de bord -->
    <a href="{{ route('dashboard') }}" aria-label="Tableau de bord" title="Tableau de bord"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('dashboard') ? 'bg-[#F3F3F3]  text-blue-900 font-semibold rounded-l-full translate-y-1' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">🏠</span>
      <span class="hidden md:inline ml-4 text-lg -translate-y-1 font-normal">ACCUEIL</span>
    </a>

    <!-- Équipements -->
    <a href="{{ route('equipements.index') }}" aria-label="Équipements" title="Équipements"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('equipements.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">🛠️</span>
      <span class="hidden md:inline ml-4 text-lg font-normal">ÉQUIPEMENTS</span>
    </a>

    <!-- Maintenances -->
    <a href="{{ route('maintenances.index') }}" aria-label="Maintenances" title="Maintenances"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('maintenances.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">⚙️</span>
      <span class="hidden md:inline ml-4 text-lg font-normal">MAINTENANCES</span>
    </a>

    <!-- Historique -->
    <a href="{{ route('historiques.index') }}" aria-label="Historique" title="Historique"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('historiques.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">📜</span>
      <span class="hidden md:inline ml-3 text-lg font-normal">HISTORIQUES</span>
    </a>

    <!-- Rapports -->
    <a href="{{ route('rapports.index') }}" aria-label="Rapports" title="Rapports"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('rapports.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">📑</span>
      <span class="hidden md:inline ml-3 text-lg font-normal">RAPPORTS</span>
    </a>

    <!-- Utilisateurs -->
    <a href="{{ route('users.index') }}" aria-label="Utilisateurs" title="Utilisateurs"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('users.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">👥</span>
      <span class="hidden md:inline ml-3 text-lg font-normal">UTILISATEURS</span>
    </a>

    <!-- Employés -->
    <a href="{{ route('employes.index') }}" aria-label="Employés" title="Employés"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('employes.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">🧑</span>
      <span class="hidden md:inline ml-3 text-lg font-normal">EMPLOYÉS</span>
    </a>

    <!-- Logiciels -->
    <a href="{{ route('logiciels.index') }}" aria-label="Logiciels" title="Logiciels"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('logiciels.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">🖥️</span>
      <span class="hidden md:inline ml-3 text-lg font-normal">LOGICIELS</span>
    </a>

    <!-- Licences -->
    <a href="{{ route('licences.index') }}" aria-label="Licences" title="Licences"
       class="group w-full flex items-center justify-center md:justify-start
              p-4 transition
              {{ request()->routeIs('licences.index') ? 'bg-[#F3F3F3] text-blue-900 font-semibold rounded-l-full' : 'rounded-xl hover:bg-[#1FB19E]' }}">
      <span class="text-xl">🔑</span>
      <span class="hidden md:inline ml-3 text-lg font-normal">LICENCES</span>
    </a>

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
