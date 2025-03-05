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
            <div class="container">
                <h2 class="mb-4 text-2xl font-bold">Gestion des licences</h2> <br><br>
            <a href="{{ route('licences.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">Ajouter une licence</a>
            <br> <br>

            <!-- Affichage des licences -->
            <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto">
                <thead>
                    <tr class="text-white bg-blue-900">
                        <th class="px-4 py-2 border">Clé de licence</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Nombre d'utilisateurs</th>
                        <th class="px-4 py-2 border">Date d'expiration</th>
                        <th class="px-4 py-2 border">État</th>
                        <th class="px-4 py-2 border">Logiciels associés</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licences as $licence)
                        <tr>
                            <td class="px-4 py-2 border">{{ $licence->cle_licence }}</td>
                            <td class="px-4 py-2 border">{{ $licence->type }}</td>
                            <td class="px-4 py-2 border">{{ $licence->nombre_utilisateurs }}</td>
                            <td class="px-4 py-2 border">{{ $licence->date_expiration }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($licence->etat) }}</td>
                            <td class="px-4 py-2 border">
                                @if($licence->logiciels && $licence->logiciels->isNotEmpty())
                                    {{ $licence->logiciels->pluck('nom')->join(', ') }}
                                @else
                                    Non défini
                                @endif
                            </td>

                            <td class="px-4 py-2 border text-center">

                                <a href="{{ route('licences.show', $licence) }}" class="text-green-500">👁️</a>


                                <!-- Bouton Modifier accessible uniquement aux admins et éditeurs -->
                                <a href="{{ route('licences.edit', $licence->id) }}"
                                   class="text-blue-500"
                                   @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                       onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier.');"
                                   @endif>
                                    ✏️
                                </a>

                                <!-- Bouton Supprimer accessible uniquement aux admins -->
                                <form action="{{ route('licences.destroy', $licence->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette licence ?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500"
                                            @if(auth()->user()->role !== 'admin')
                                                onclick="event.preventDefault(); alert('Seul l\'admin peut supprimer.');"
                                            @endif>
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </main>
    </div>

</body>
    </html>
</x-app-layout>

