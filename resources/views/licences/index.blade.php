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
             @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-[#F3F3F3]">
            <div class="container">
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
            <a href="{{ route('licences.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">Ajouter une licence</a>
        @endif <br> <br>

             <h2 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des licences</h2>

            <!-- Affichage des licences -->
            <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                <thead>
                    <tr class="text-[#585858] bg-[#D9D9D9]">
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Clé de licence</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Type</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nombre d'utilisateurs</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Date d'expiration</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">État</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Logiciels associés</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licences as $licence)
                        <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
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

                            <td class="px-4 py-2 text-center border">

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

