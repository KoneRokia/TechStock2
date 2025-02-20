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
        <div class="container">
            <h2 class="mb-4 text-2xl font-bold">Gestion des maintenances</h2> <br><br>

            <a href="{{ route('maintenances.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded">➕ Ajouter</a> <br><br>

            <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto">
                <thead>
                    <tr class="text-white bg-blue-900">
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Coût</th>
                        <th class="px-4 py-2 border">État</th>
                        <th class="px-4 py-2 border">Technicien</th>
                        <th class="px-4 py-2 border">Équipement</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $maintenance)
                    <tr class="border-b hover:bg-gray-200">
                        <td class="px-4 py-2 border">{{ $maintenance->date }}</td>
                        <td class="px-4 py-2 border">{{ $maintenance->type }}</td>
                        <td class="px-4 py-2 border">{{ number_format($maintenance->cout, 2) }} €</td>
                        <td class="text px-4 py-2 border-{{ $maintenance->etat == 'terminé' ? 'green' : ($maintenance->etat == 'en cours' ? 'yellow' : 'red') }}">
                            {{ ucfirst($maintenance->etat) }}
                        </td>
                        <td>{{ $maintenance->user->name ?? 'N/A' }}</td>
                        <td>{{ $maintenance->equipement->nom ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="text-blue-500">✏️</a>
                            <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
</x-app-layout>
