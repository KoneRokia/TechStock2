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
                <a href="{{ route('statistiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📊</span> <span>Gestion des statistiques</span>
                </a>
                <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📑</span> <span>Gestion des rapports</span>
                </a>
                <a href="{{ route('utilisateurs.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Gestion des utilisateurs</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">
                <!-- Ajouter un équipement Section -->
                <h1 class="mb-4 text-2xl font-semibold">Liste des équipements</h1> <br>
                <a href="{{ route('equipements.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">Ajouter un équipement</a>
                <br><br>

                <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto">
                    <thead>
                        <tr class="text-white bg-blue-900">
                            <th class="px-4 py-2 border">Nom</th>
                            <th class="px-4 py-2 border">Type</th>
                            <th class="px-4 py-2 border">Date d'achat</th>
                            <th class="px-4 py-2 border">Caractéristiques</th>
                            <th class="px-4 py-2 border">Coût</th>
                            <th class="px-4 py-2 border">Photo</th>
                            <th class="px-4 py-2 border">Actions</th> <!-- Nouvelle colonne pour les actions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipements as $equipement)
                            <tr class="border-b hover:bg-gray-200">
                                <td class="px-4 py-2 border">{{ $equipement->nom }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->type }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->date_achat }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->caracteristique }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->cout }}</td>
                                <td class="px-4 py-2 border">
                                    <img src="{{ asset('storage/' . $equipement->photo_equip) }}" alt="Image de l'équipement" class="object-cover w-16 h-16 rounded">
                                </td>

                                <td class="px-4 py-2 text-center border">
                                    <a href="{{ route('equipements.edit', $equipement->id) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('equipements.destroy', $equipement->id) }}" class="ml-4 text-red-600 hover:text-red-800" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

    </div>

</x-app-layout>
