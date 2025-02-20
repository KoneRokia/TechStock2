
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
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">
                <div class="container">
                    <h1 class="mb-4 text-2xl font-semibold">Liste des employés</h1> <br><br>

                    <a href="{{ route('employes.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">Ajouter un employé</a>
                <br><br>

                    <!-- Affichage des employés -->
                    <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto">
                        <thead>
                            <tr class="text-white bg-blue-900">
                                <th class="px-4 py-2 border">Nom</th>
                                <th class="px-4 py-2 border">Prénom</th>
                                <th class="px-4 py-2 border">Poste</th>
                                <th class="px-4 py-2 border">Date d'embauche</th>
                                <th class="px-4 py-2 border">Équipements</th>
                                <th class="px-4 py-2 border">Action</th>
                                <th class="px-4 py-2 border">Affectation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employes as $employe)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $employe->nom }}</td>
                                    <td class="px-4 py-2 border">{{ $employe->prenom }}</td>
                                    <td class="px-4 py-2 border">{{ $employe->poste }}</td>
                                    <td class="px-4 py-2 border">{{ $employe->date_embauche }}</td>
                                    <td class="px-4 py-2 border">
                                        @foreach($employe->equipements as $equipement)
                                            <span class="badge badge-primary">{{ $equipement->nom }}</span>
                                        @endforeach

                                    <td class="px-4 py-2 text-center border">
                                        <a href="{{ route('employes.edit', $employe->id) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('employes.destroy', $employe->id) }}" class="ml-4 text-red-600 hover:text-red-800" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employe ?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('employes.affectation', $employe->id) }}"
                                           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                                            🏷️ Affecter un équipement
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                             <!-- Affichage des erreurs de validation -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

        </main>

    </div>

</x-app-layout>
