<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">
                <!-- Ajouter un équipement Section -->
                <h1 class="mb-4 text-2xl font-semibold">Liste des équipements</h1> <br>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                <a href="{{ route('equipements.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">Ajouter un équipement</a>
                @endif <br> <br>


                <div class="flex items-center space-x-2">
                    <input type="text" id="searchNumeroSerie" placeholder="Rechercher par numéro de série" class="p-2 border rounded"   value="{{ request()->input('numero_serie') }}">
                    <button id="btnSearch" class="p-2 text-white bg-blue-600 rounded">Rechercher</button>
                </div> <br>


                <div id="equipementsList">
                    <!-- La liste des équipements sera affichée ici -->
                </div>

                <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">
                <table  class="w-full border border-collapse border-gray-300 table-auto" style="font-size:15px">
                    <thead class="sticky top-0 bg-[#67b09d] text-white">
                        <tr class="text-white bg-blue-900">
                        </th>
                             <th class="px-4 py-2 border">Nom</th>
                            <th class="px-4 py-2 border">Type</th>
                            <th class="px-4 py-2 border">Date d'achat</th>
                            <th class="px-4 py-2 border">Caractéristiques</th>
                            <th class="px-4 py-2 border">Coût</th>
                            {{-- <th class="px-4 py-2 border">Utilisateur</th> --}}
                            <th class="px-4 py-2 border">Photo</th>
                            <th class="px-4 py-2 border">Actions</th> <!-- Nouvelle colonne pour les actions -->
                        </tr>
                    </thead>
                    <tbody id="equipementsTableBody">
                        @foreach($equipements as $equipement)
                            <tr class="border-b hover:bg-gray-200">
                                <td class="px-4 py-2 border">{{ $equipement->nom }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->type }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->date_achat }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->caracteristique }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->cout }}</td>
                                {{-- <td class="p-2 border">{{ $equipement->user->name }}</td> --}}
                                <td class="px-4 py-2 border">
                                    <img src="{{ asset('storage/' . $equipement->photo_equip) }}" 
                                        alt="Photo de l'équipement" 
                                        class="object-cover w-16 h-16 rounded">
                                </td>


                                <td class="px-4 py-2 text-center border">
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('equipements.show', $equipement) }}" class="text-green-500">👁️</a>

                                    <!-- Bouton Modifier pour l'admin et l'éditeur uniquement -->
                                    <a href="{{ route('equipements.edit', $equipement->id) }}"
                                       class="text-blue-600 hover:text-blue-800"
                                       title="Modifier"
                                       @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                           onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier cet équipement.');"
                                       @endif>
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Formulaire Supprimer pour l'admin uniquement -->
                                    <form action="{{ route('equipements.supprimer', $equipement->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')"
                                          style="display:inline;">
                                        @csrf
                                        @method('PUT') <!-- Utilisation de PUT car ta route attend PUT -->

                                        <button type="submit"
                                                class="ml-4 text-red-600 hover:text-red-800"
                                                title="Supprimer"
                                                style="border: none; background: none;"
                                                @if(auth()->user()->role !== 'admin')
                                                    onclick="event.preventDefault(); alert('Seul l\'admin peut supprimer cet équipement.');"
                                                @endif>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                <script>
                    $(document).ready(function () {
                        $('#btnSearch').on('click', function () {
                            let numeroSerie = $('#searchNumeroSerie').val();
                            console.log("Numéro de série saisi :", numeroSerie); // Vérification

                            if (!numeroSerie) {
                                alert("Veuillez entrer un numéro de série !");
                                return;
                            }

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "/equipements/filter",  // Assure-toi que la route est correcte
                                type: "POST",
                                data: { numero_serie: numeroSerie },
                                success: function (response) {
                                    console.log("Réponse reçue :", response); // Vérification

                                    let tableBody = $('#equipementsTableBody');
                                    tableBody.empty();


                                    if (response.length > 0) {
                                        response.forEach(equipement => {
                                            let row = `<tr>
                                                <td class="px-4 py-2 border">${equipement.nom}</td>
                                                <td class="px-4 py-2 border">${equipement.type}</td>
                                                <td class="px-4 py-2 border">${equipement.numero_serie}</td>
                                                <td class="px-4 py-2 border">${equipement.caracteristique}</td>
                                            </tr>`;
                                            tableBody.append(row);
                                        });
                                    } else {
                                        tableBody.append(`<tr><td colspan="4" class="px-4 py-2 text-center border">Aucun équipement trouvé</td></tr>`);
                                    }
                                },
                                error: function (error) {
                                    console.log("Erreur AJAX :", error);
                                    alert("Erreur lors de la recherche !");
                                }
                            });
                        });
                    });

                </script>


            </div>
        </main>

    </div>

</x-app-layout>
