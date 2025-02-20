<x-app-layout>


    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord - TechStock</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    </head>

    <body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen p-6 text-white bg-blue-900 shadow-lg" style="margin-top:-1px">
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 text-2xl hover:bg-blue-600" >
                    <span>🏠</span> <span>Tableau de bord</span>
                </a>
                <a href="{{ route('equipements.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🛠️</span> <span>Gestion des équipements</span>
                </a>
                <a href="{{ route('maintenances.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>⚙️</span> <span>Gestion des maintenances</span>
                </a>
                {{-- <a href="{{ route('statistiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📊</span> <span>Gestion des statistiques</span>
                </a> --}}
                <a href="{{ route('historiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📜</span> <span>Gestion de l'historique</span>
                </a>

                <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📑</span> <span>Gestion des rapports</span>
                {{-- </a>
                <a href="{{ route('utilisateurs.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Gestion des utilisateurs</span>
                </a> --}}
                <a href="{{ route('employes.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🧑‍💼</span> <span>Gestion des employés</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-user"></i> Total Employés</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalEmployes }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-server "></i> Total Équipements</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalEquipements }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-green-500 fas fa-check-circle"></i> Équipements Actifs</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $equipementsActifs }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-red-500 fas fa-exclamation-triangle"></i> Équipements en Panne</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $equipementsEnPanne }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-yellow-500 fas fa-ban"></i> Équipements Hors Service</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $equipementsHorsService }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-tools"></i> Total Maintenances</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalMaintenances }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-green-500 fas fa-sync-alt"></i> Maintenances en Cours</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $maintenancesEnCours }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-red-500 fas fa-check-double"></i> Maintenances Terminées</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $maintenancesTerminees }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-file-alt"></i> Total Rapports</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalRapports }}</p>
                </div>
            </div>
        </main>
    </div>

</body>
    </html>
</x-app-layout>

