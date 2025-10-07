
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

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                <a href="{{ route('employes.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">Ajouter un employé</a>
                @endif <br> <br>

                    <h1 class="mb-4 text-2xl font-semibold text-[#1FB19E]">Liste des employés</h1>

                <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">

                    <!-- Affichage des employés -->
                    <table  class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                        <thead class="sticky top-0 bg-[#67b09d] text-white">
                            <tr class="text-[#585858] bg-[#D9D9D9]">
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nom</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Prénom</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Poste</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Date d'embauche</th>
                                {{-- <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Utilisateur</th> --}}
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Équipements</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Action</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Affectation</th>
                            </tr>
                        </thead>
                        <tbody>

                  @foreach($employes as $employe)
                            <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
                                <td class="px-4 py-2 border">{{ $employe->nom }}</td>
                                <td class="px-4 py-2 border">{{ $employe->prenom }}</td>
                                <td class="px-4 py-2 border">{{ $employe->poste }}</td>
                                <td class="px-4 py-2 border">{{ $employe->date_embauche }}</td>
                                <td class="px-4 py-2 border">
                                    @foreach($employe->equipements as $equipement)
                                        <span class="badge badge-primary">{{ $equipement->nom }}</span>
                                    @endforeach
                                </td class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('employes.show', $employe) }}" class="text-green-500">👁️</a>
                                    <a href="{{ route('employes.edit', $employe->id) }}" class="text-blue-500"
                                       @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                           onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier.');"
                                       @endif>
                                        ✏️
                                    </a>

                                    <!-- Bouton Désactiver -->
                                    <form action="{{ route('employes.toggle', $employe->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')

                                        @if ($employe->statut === 'actif')
                                            <button type="submit"
                                                    class="text-orange-500 hover:text-orange-700"
                                                    onclick="return confirm('Voulez-vous vraiment désactiver cet employé ?');">
                                                🔴
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="text-green-500 hover:text-green-700"
                                                    onclick="return confirm('Voulez-vous vraiment activer cet employé ?');">
                                                🟢 Activer
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('employes.supprimer', $employe->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-red-500"
                                                @if(auth()->user()->role !== 'admin')
                                                    onclick="event.preventDefault(); alert('Seul l\'admin peut supprimer.');"
                                                @endif>
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('employes.affectation', $employe->id) }}"
                                           class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                            🏷️ Affecter un équipement
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                             <!-- Affichage des erreurs de validation -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

        </main>

    </div>

</x-app-layout>
