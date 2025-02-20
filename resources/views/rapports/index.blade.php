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
    <h1 class="mb-4 text-2xl font-bold">Gestion des rapports</h1> <br><br>
    <a href="{{ route('rapports.create') }}" class="mb-3 btn btn-primary px-4 py-2 text-white bg-blue-500 rounded">Ajouter un rapport</a> <br><br>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="w-full border border-collapse border-gray-300 table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Type</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Titre</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Nom</th>
                <th class="p-2 border">Equipement</th>
                <th class="p-2 border">Fichier</th>
                <th class="p-2 border">Actions</th>
            </tr>
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
                  <td class="p-2 border">
                    @if($rapport->fichier)
                        <a href="{{ Storage::url($rapport->fichier) }}" target="_blank" class="text-blue-500">📂 Voir</a>
                    @endif
                </td>
                <td class="p-2 border">
                    <a href="{{ route('rapports.show', $rapport) }}" class="text-green-500">👁️ Voir</a>
                    <a href="{{ route('rapports.edit', $rapport) }}" class="text-yellow-500">✏️ Modifier</a>
                    <form action="{{ route('rapports.destroy', $rapport) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $rapports->links() }}
            </div>
        </main>

    </div>

</x-app-layout>































