<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-[#F3F3F3]">
        <div class="container">


        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
            <a href="{{ route('logiciels.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">➕ Ajouter un Logiciel</a>
        @endif <br> <br>

              <h1 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des Logiciels</h1>


        <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
            <thead>
                    <tr class="text-[#585858] bg-[#D9D9D9]">
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nom</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Version</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Licences associées</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Employés utilisant ce logiciel</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Actions</th>
                    </tr>


            </thead>
            <tbody>
                @foreach($logiciels as $logiciel)
                    <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
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
