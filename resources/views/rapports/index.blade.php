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

<div class="container">
    <h1 class="mb-4 text-2xl font-bold">Gestion des rapports</h1> <br><br>
    <a href="{{ route('rapports.create') }}" class="px-4 py-2 mb-3 text-white bg-blue-500 rounded btn btn-primary">Ajouter un rapport</a> <br><br>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">

    <table class="w-full border border-collapse border-gray-300 table-auto" style="font-size:20px">
        <thead class="sticky top-0 bg-[#67b09d] text-white">

            <tr class="text-white bg-blue-900">
                <th class="p-2 border">Type</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Titre</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Nom</th>
                <th class="p-2 border">Equipement</th>
                <th class="p-2 border">Actions</th>
            </tr>
            {{-- <th class="p-2 border">Fichier</th> --}}
        </thead>
        <tbody>
            @foreach($rapports as $rapport)
            <tr>
                <td class="p-2 border">{{ $rapport->type }}</td>
                 <td class="p-2 border">{{ Str::limit($rapport->description, 50) }}</td>
                  <td>{{ $rapport->titre }}</td>
                 <td class="p-2 border">{{ $rapport->date_generation }}</td>
                 <td class="p-2 border">{{ $rapport->user->name }}</td> <!-- Nom de l'utilisateur -->
                  <td class="p-2 border">{{ $rapport->equipement->nom }}</td>
                  {{-- <td class="p-2 border">
                    @if($rapport->fichier)
                        <a href="{{ Storage::url($rapport->fichier) }}" target="_blank" class="text-blue-500">📂 Voir</a>

                    @endif
                </td> --}}
                <td class="p-2 border">
                    <!-- Bouton Voir (accessible à tous) -->
                    <a href="{{ route('rapports.show', $rapport) }}" class="text-green-500">👁️ Voir</a>

                    <!-- Bouton Modifier avec restriction d'action -->
                    <a href="{{ route('rapports.edit', $rapport) }}"
                       class="text-yellow-500"
                       @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                           onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier.');"
                       @endif>
                        ✏️ Modifier
                    </a>

                    <!-- Formulaire Supprimer avec restriction d'action -->
                    <form action="{{ route('rapports.destroy', $rapport) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?')" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <!-- Bouton Supprimer avec restriction d'action -->
                        <button type="submit"
                                class="text-red-500"
                                @if(auth()->user()->role !== 'admin')
                                    onclick="event.preventDefault(); alert('Seul l\'admin peut supprimer.');"
                                @endif>
                            🗑️ Supprimer
                        </button>
                    </form>
                </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{ $rapports->links() }}
            </div>
        </main>

    </div>

</x-app-layout>































