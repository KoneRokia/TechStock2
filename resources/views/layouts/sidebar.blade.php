<!-- Bouton menu (mobile uniquement) -->
<div class="md:hidden p-4 bg-blue-900 text-white flex justify-between items-center">
    <span class="font-bold">Menu</span>
    <button id="sidebarToggle" class="text-2xl focus:outline-none">☰</button>
</div>

<!-- Sidebar -->
<aside id="sidebar"
    class="fixed md:static left-0 top-0 md:top-auto z-40 w-64 min-h-screen p-6 text-white bg-blue-900 shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300">
    <nav class="space-y-4">
        <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>🏠</span> <span>Tableau de bord</span>
        </a>
        <a href="{{ route('equipements.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>🛠️</span> <span>Équipements</span>
        </a>
        <a href="{{ route('maintenances.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>⚙️</span> <span>Maintenances</span>
        </a>
        <a href="{{ route('historiques.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>📜</span> <span>Historique</span>
        </a>
        <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>📑</span> <span>Rapports</span>
        </a>
        <a href="{{ route('users.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>👥</span> <span>Utilisateurs</span>
        </a>
        <a href="{{ route('employes.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>🧑</span> <span>Employés</span>
        </a>
        <a href="{{ route('logiciels.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>🖥️</span> <span>Logiciels</span>
        </a>
        <a href="{{ route('licences.index') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600">
            <span>🔑</span> <span>Licences</span>
        </a>
    </nav>
</aside>

<!-- Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('sidebarToggle');

    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }
</script>
