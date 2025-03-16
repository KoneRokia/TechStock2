
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
                 </a>
                 <a href="{{ route('users.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Liste des utilisateurs</span>
                </a>
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
                    <h1 class="mb-4 text-2xl font-semibold">Liste des employés</h1> <br><br>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                <a href="{{ route('employes.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">Ajouter un employé</a>
                @endif <br> <br>


                <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">

                    <!-- Affichage des employés -->
                    <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto" style="font-size:20px">
                        <thead class="sticky top-0 bg-[#67b09d] text-white">
                            <tr class="text-white bg-blue-900">
                                <th class="px-4 py-2 border">Nom</th>
                                <th class="px-4 py-2 border">Prénom</th>
                                <th class="px-4 py-2 border">Poste</th>
                                <th class="px-4 py-2 border">Date d'embauche</th>
                                {{-- <th class="px-4 py-2 border">Utilisateur</th> --}}
                                <th class="px-4 py-2 border">Équipements</th>
                                <th class="px-4 py-2 border">Action</th>
                                <th class="py-2 border px-">Affectation</th>
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
                                </td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('employes.show', $employe) }}" class="text-green-500">👁️</a>
                                    <a href="{{ route('employes.edit', $employe->id) }}" class="text-blue-500"
                                       @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                           onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier.');"
                                       @endif>
                                        ✏️
                                    </a>

                                    <!-- Bouton Désactiver -->
                                    <form action="{{ route('employes.toggle', $employe->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')

                                        @if ($employe->statut === 'actif')
                                            <button type="submit"
                                                    class="text-orange-500 hover:text-orange-700"
                                                    onclick="return confirm('Voulez-vous vraiment désactiver cet employé ?');">
                                                🔴
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="text-green-500 hover:text-green-700"
                                                    onclick="return confirm('Voulez-vous vraiment activer cet employé ?');">
                                                🟢 Activer
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('employes.supprimer', $employe->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-red-500"
                                                @if(auth()->user()->role !== 'admin')
                                                    onclick="event.preventDefault(); alert('Seul l\'admin peut supprimer.');"
                                                @endif>
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('employes.affectation', $employe->id) }}"
                                           class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                            🏷️ Affecter un équipement
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
