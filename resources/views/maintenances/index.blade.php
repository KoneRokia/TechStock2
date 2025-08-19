<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-gray-100">
        <div class="container">
            <h2 class="mb-4 text-2xl font-bold">Gestion des maintenances</h2> <br><br>

            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
            <a href="{{ route('maintenances.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded">➕ Ajouter</a>
        @endif <br> <br>

            <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto" style="font-size:20px">
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
                        <td class="px-4 py-2 border">{{ $maintenance->cout }} </td>
                        <td class="text px-4 py-2 border-{{ $maintenance->etat == 'terminé' ? 'green' : ($maintenance->etat == 'en cours' ? 'yellow' : 'red') }}">
                            {{ ucfirst($maintenance->etat) }}
                        </td>
                        <td>{{ $maintenance->user->name ?? 'N/A' }}</td>
                        <td>{{ $maintenance->equipement->nom ?? 'N/A' }}</td>
                        <td>

                            <a href="{{ route('maintenances.show', $maintenance) }}" class="text-green-500">👁️</a>


                            <!-- Bouton Modifier pour tous les utilisateurs -->
                            <a href="{{ route('maintenances.edit', $maintenance->id) }}"
                               class="text-blue-500"
                               @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                   onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier.');"
                               @endif>
                                ✏️
                            </a>

                            <!-- Bouton Supprimer pour tous les utilisateurs -->
                            <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')" style="display:inline;">
                                @csrf
                                @csrf
                                @method('DELETE')

                                <!-- Si l'utilisateur n'est pas admin, le bouton est désactivé avec un message d'alerte -->
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
</x-app-layout>
