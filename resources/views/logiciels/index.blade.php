<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-gray-100">
        <div class="container">

        <h1 class="mb-4 text-2xl font-bold">Liste des Logiciels</h1>

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
            <a href="{{ route('logiciels.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">➕ Ajouter un Logiciel</a>
        @endif <br> <br>

        <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto" style="font-size:20px">
            <thead>
                    <tr class="text-white bg-blue-900">
                        <th class="px-4 py-2 border">Nom</th>
                        <th class="px-4 py-2 border">Version</th>
                        <th class="px-4 py-2 border">Licences associées</th>
                        <th class="px-4 py-2 border">Employés utilisant ce logiciel</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>


            </thead>
            <tbody>
                @foreach($logiciels as $logiciel)
                    <tr>
                        <td class="px-4 py-2 border">{{ $logiciel->nom }}</td>
                        <td class="px-4 py-2 border">{{ $logiciel->version }}</td>
                        <td class="px-4 py-2 border">
                            @if($logiciel->licences->isNotEmpty())
                                {{ $logiciel->licences->pluck('cle_licence')->join(', ') }}
                            @else
                                Aucune licence
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            @if($logiciel->employes->isNotEmpty())
                                {{ $logiciel->employes->pluck('nom')->join(', ') }}
                            @else
                                Aucun employé assigné
                            @endif
                        </td>

                        <td class="px-4 py-2 border">

                            <a href="{{ route('logiciels.show', $logiciel) }}" class="text-green-500">👁️</a>


                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                                <!-- Bouton Modifier -->
                                <a href="{{ route('logiciels.edit', $logiciel->id) }}"
                                   class="text-blue-500"
                                   title="Modifier">
                                    📝
                                </a>
                            @else
                                <span class="text-gray-400 cursor-not-allowed" title="Accès restreint">🚫</span>
                            @endif

                            @if(auth()->user()->role === 'admin')
                                <!-- Bouton Supprimer -->
                                <form action="{{ route('logiciels.destroy', $logiciel->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce logiciel ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500" title="Supprimer">
                                        🗑️
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 cursor-not-allowed" title="Seul l'admin peut supprimer">🚫</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        </div>
    </main>
</div>
</x-app-layout>
