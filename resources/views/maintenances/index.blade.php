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
            <a href="{{ route('maintenances.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">Ajouter une maintenance</a>
        @endif <br> <br>
            <h2 class="mb-4 text-xl font-bold text-[#1FB19E]">Listes des maintenances</h2>

            <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                <thead>
                    <tr class="text-[#585858] bg-[#D9D9D9]">
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Date</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Type</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Coût</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">État</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Technicien</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Équipement</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $maintenance)
                    <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
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
