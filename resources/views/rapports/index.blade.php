<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-[#F3F3F3]">
            <div class="container mx-auto">

<div class="container">
    
    <a href="{{ route('rapports.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">Ajouter un rapport</a> <br><br>

    <h1 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des rapports</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">

    <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
        <thead class="sticky top-0 bg-[#67b09d] text-white">

            <tr class="text-[#585858] bg-[#D9D9D9]">
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Type</th>
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Description</th>
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Titre</th>
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]r">Date</th>
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nom</th>
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Equipement</th>
                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Actions</th>
            </tr>
            {{-- <th class="p-2 border">Fichier</th> --}}
        </thead>
        <tbody>
            @foreach($rapports as $rapport)
            <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
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































