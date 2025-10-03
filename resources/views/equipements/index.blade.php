<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-[#F3F3F3]">
            <div class="container mx-auto">
                <!-- Ajouter un équipement Section -->
                <h1 class="mb-4 text-2xl font-semibold">Liste des équipements</h1> <br>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                <a href="{{ route('equipements.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">Ajouter un équipement</a>
                @endif <br> <br>


                <div class="relative w-[400px]">
                    <input type="text" id="searchNumeroSerie" placeholder="Rechercher par numéro de série" value="{{ request()->input('numero_serie') }}"  class="w-full pl-10 pr-4 py-2 border rounded-lg border-[#3A5DA8] focus:outline-none focus:ring-2 focus:ring-[#3A5DA8]"
>
                <button id="btnSearch" class="absolute right-3 top-1/2 -translate-y-1/2">
                        <img src="{{ asset('images/Frame 5.png') }}" alt="Recherche" class="w-3 h-4">
                 </button>               
                 </div> <br>


                <div id="equipementsList">
                    <!-- La liste des équipements sera affichée ici -->
                </div>

                <div class="overflow-y-auto max-h-[500px] border rounded-lg">
                <table  class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                    <thead class="sticky top-0 bg-[#D9D9D9] text-white">
                        <tr class="text-[#585858] bg-[#D9D9D9]">
                             <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nom</th>
                            <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Type</th>
                            <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Date d'achat</th>
                            <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Caractéristiques</th>
                            <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Coût</th>
                            {{-- <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Utilisateur</th> --}}
                            <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Photo</th>
                            <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Actions</th> 
                        </tr>
                    </thead>
                    <tbody id="equipementsTableBody">
                        @foreach($equipements as $equipement)
                            <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
                                <td class="px-2 py-2 border">{{ $equipement->nom }}</td>
                                <td class="px-2 py-2 border">{{ $equipement->type }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->date_achat }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->caracteristique }}</td>
                                <td class="px-4 py-2 border">{{ $equipement->cout }}</td>
                                {{-- <td class="p-2 border">{{ $equipement->user->name }}</td> --}}
                                <td class="px-4 py-2 border">
                                    <img src="{{ asset('storage/' . $equipement->photo_equip) }}" 
                                        alt="Photo de l'équipement" 
                                        class=" w-7 h-7 rounded">
                                </td>


                                <td class="px-4 py-2 text-center border">
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('equipements.show', $equipement) }}" class="text-green-500">
                                            <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">

                                    </a>

                                    <!-- Bouton Modifier pour l'admin et l'éditeur uniquement -->
                                    <a href="{{ route('equipements.edit', $equipement->id) }}"
                                       class="text-blue-600 hover:text-blue-800"
                                       title="Modifier"
                                       @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                           onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier cet équipement.');"
                                       @endif>
                                            <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                                    </a>

                                    <!-- Formulaire Supprimer pour l'admin uniquement -->
                                    <form action="{{ route('equipements.supprimer', $equipement->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')"
                                          style="display:inline;">
                                        @csrf
                                        @method('PUT') <!-- Utilisation de PUT car ta route attend PUT -->

                                        <button type="submit"
                                                class=" text-red-600 hover:text-red-800"
                                                title="Supprimer"
                                                style="border: none; background: none;"
                                                @if(auth()->user()->role !== 'admin')
                                                    onclick="event.preventDefault(); alert('Seul l\'admin peut supprimer cet équipement.');"
                                                @endif>
                                            <img src="{{ asset('images/Group 10.png') }}" alt="Supprimer" class="w-5 h-5 inline-block">
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
            <!-- <br> <br>
            <div class="flex justify-center items-center">
             <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-6">
            </div> -->
        </main>

    </div>

</x-app-layout>
