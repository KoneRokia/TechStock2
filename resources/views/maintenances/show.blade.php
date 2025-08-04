<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen p-6 text-white bg-blue-900 shadow-lg" style="margin-top:-1px">
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600" >
                    <span>🏠</span> <span>Tableau de bord</span>
                </a><br>
                <a href="{{ route('equipements.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🛠️</span> <span>Équipements</span>
                </a><br>
                <a href="{{ route('maintenances.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>⚙️</span> <span>Maintenances</span>
                </a><br>
                {{-- <a href="{{ route('statistiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📊</span> <span>Gestion des statistiques</span>
                </a> --}}
                <a href="{{ route('historiques.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>📜</span> <span>Historique</span>
                </a><br>

                <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>📑</span> <span>Rapports</span>
                 </a><br>
                 <a href="{{ route('users.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Utilisateurs</span>
                </a>
                <a href="{{ route('employes.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🧑</span> <span>Employés</span>
                </a><br>
                <a href="{{ route('logiciels.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🖥️</span> <span>Logiciels</span>
                </a><br>

                <a href="{{ route('licences.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🔑</span> <span>Licences</span>
                </a><br>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">

                <div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-2xl font-bold">{{ $maintenance->equipement->nom ?? 'N/A' }}</h2>
                    <p class="mb-2 text-gray-700"><strong>Type :</strong> {{  $maintenance->type}}</p>
                    <p class="mb-2 text-gray-700"><strong>Coût :</strong> {{ $maintenance->cout }}</p>
                    <p class="text-gray-700"><strong>Date :</strong> {{ $maintenance->date}}</p>
                    <p class="text-gray-700"><strong>Etat :</strong> {{ $maintenance->etat}}</p>
                    <p class="text-gray-700"><strong>Technicien :</strong> {{ $maintenance->user->name ?? 'N/A' }}</p>



                    <div class="mt-6">
                        <a href="{{ route('rapports.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Retour</a>
                    </div>
                </div>
            </div>
        </main>

    </div>

</x-app-layout>
