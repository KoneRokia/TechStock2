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
           
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-user"></i> Total Employés</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalEmployes ?? '' }}</p>
                    {{-- <p>{{ $totalEmployes ?? 'Donnée non disponible' }}</p> --}}
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-server "></i> Total Équipements</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalEquipements  ?? ''}}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-green-500 fas fa-check-circle"></i> Équipements Actifs</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $equipementsActifs ?? '' }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-red-500 fas fa-exclamation-triangle"></i> Équipements en Panne</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $equipementsEnPanne ?? '' }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-yellow-500 fas fa-ban"></i> Équipements Hors Service</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $equipementsHorsService ?? ''}}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-tools"></i> Total Maintenances</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalMaintenances ?? ''}}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-green-500 fas fa-sync-alt"></i> Maintenances en Cours</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $maintenancesEnCours ?? '' }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-red-500 fas fa-check-double"></i> Maintenances Terminées</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $maintenancesTerminees ?? ''}}</p>
                </div>
                            <!-- Maintenances en attente -->
                <div class="p-6 bg-white rounded-lg shadow-md mt-4">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-yellow-500 fas fa-hourglass-start"></i> Maintenances En Attente</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $maintenancesEnAttente ?? '' }}</p>
                </div>

                <!-- Maintenances annulées -->
                <div class="p-6 bg-white rounded-lg shadow-md mt-4">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-gray-500 fas fa-times-circle"></i> Maintenances Annulées</h3>
                    <p class="text-3xl font-bold text-gray-500">{{ $maintenancesAnnulees ?? '' }}</p>
                </div>

                <!-- Maintenances reportées -->
                <div class="p-6 bg-white rounded-lg shadow-md mt-4">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-blue-500 fas fa-calendar-alt"></i> Maintenances Reportées</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $maintenancesReporte ?? '' }}</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"><i class="text-cyan-500 fas fa-key"></i> Total Licences </h3>
                    <p class="text-3xl font-bold text-cyan-500">{{ $totalLicences ?? ''}}</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700"> <i class="text-purple-500 fas fa-laptop-code"></i> Total Logiciels</h3>
                    <p class="text-3xl font-bold text-purple-500">{{ $totalLogiciels ?? ''}}</p>
                </div>

            </div>
        </main>
        
    </div>

</body>
    </html>
</x-app-layout>

