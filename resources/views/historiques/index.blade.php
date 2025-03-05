
<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


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
                <a href="{{ route('logiciels.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🖥️</span> <span>Gestion des logiciels</span>
                </a>

                <a href="{{ route('licences.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🔑</span> <span>Gestion des licences</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">
                <div class="container">
                    <h2 class="mb-4 text-2xl font-semibold">Historique des équipements</h2><br><br>

                    <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto">

                        <thead>
                            <tr class="text-white bg-blue-900">
                                <th class="px-4 py-2 border">Équipement</th>
                                <th class="px-4 py-2 border">Numéro de série</th>
                                <th class="px-4 py-2 border">Ancien utilisateur</th>
                                <th class="px-4 py-2 border">Nouveau utilisateur</th>
                                <th class="px-4 py-2 border">Date de passation</th>
                                <th class="px-4 py-2 border">Temps d'utilisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historiques as $historique)
                            <tr class="border-b hover:bg-gray-200">

                                    <td class="px-4 py-2 border">{{ $historique->equipement->nom }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->equipement->numero_serie }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->ancienUtilisateur->nom ?? 'Aucun' }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->nouveauUtilisateur->nom }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->date_passation }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->temps_utilisation ?? 'Non défini' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </main>

    </div>

</x-app-layout>
