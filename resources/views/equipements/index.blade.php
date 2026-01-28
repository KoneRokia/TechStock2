<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 bg-[#3A5DA8] -translate-y-1">
            <div class="bg-[#F3F3F3] h-[750px] rounded-bl-[50px] mt-[3px]">
            <div class="container mx-auto p-8">
                <!-- Ajouter un équipement Section -->
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                    <button id="btn-open-add" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">Ajouter un équipement</button>
                @endif


                <div class="relative w-[400px]">
                    <input type="text" id="searchNumeroSerie" placeholder="Rechercher par numéro de série" value="{{ request()->input('numero_serie') }}"  class="w-full pl-10 pr-4 py-2 border rounded-lg border-[#3A5DA8] focus:outline-none focus:ring-2 focus:ring-[#3A5DA8]"
>
                <button id="btnSearch" class="absolute right-3 top-1/2 -translate-y-1/2">
                        <img src="{{ asset('images/Frame 5.png') }}" alt="Recherche" class="w-3 h-4">
                 </button>               
                 </div> <br>


                <h1 class="mb-4 text-xl font-semibold text-[#1FB19E]">Liste des équipements</h1>

                <div id="equipementsList">
                    <!-- La liste des équipements sera affichée ici -->
                </div>

                <div class="overflow-y-auto max-h-[500px] border rounded-lg">
                <table  class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                    <thead class="sticky top-0 bg-[#D9D9D9] text-white">
                        <tr class="text-[#585858] bg-[#D9D9D9]">
                            <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Nom</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                            </th>
                            <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Type</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                            </th>
                            <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Date d'achat</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                            </th>
                            <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Caractéristique</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                            </th>
                            <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Coût</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                            </th>
                            {{-- <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Utilisateur</th> --}}
                             <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Photo</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                            </th>
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
                                        class=" w-16 h-16 rounded">
                                </td>


                                <td class="px-4 py-2 text-center border">
                                    <!-- Bouton Voir -->
                                    <button 
                                        onclick="openShowModal({{ $equipement->id }})" 
                                        class="text-green-500">
                                        <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">
                                    </button>


                                    <!-- Bouton Modifier pour l'admin et l'éditeur uniquement -->
                                   <button 
                                         onclick='openEditModal(
                                                {{ $equipement->id }},
                                                @json($equipement->nom),
                                                @json($equipement->type),
                                                @json(\Carbon\Carbon::parse($equipement->date_achat)->format("Y-m-d")),
                                                @json($equipement->caracteristique),
                                                @json($equipement->cout),
                                                @json($equipement->etat),
                                                @json($equipement->numero_serie),
                                                @json($equipement->marque)
                                            )'
                                        class="text-blue-600 hover:text-blue-800"
                                        title="Modifier">
                                        <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                                    </button>


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

            <!-- Script de recherche d'équipement -->
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
                                url: "/equipements/filter",  
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


            <!-- Modal Ajouter un équipement -->
            <div id="addEquipementModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50">
                <div class="flex justify-center items-center min-h-screen">
                    <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative overflow-y-auto max-h-[90vh]">
                        <h2 class="text-xl text-[#1FB19E] mb-4 text-center">Ajouter un nouvel équipement</h2>

                        <!-- Affichage des erreurs -->
                        <div id="addErrors" class="mb-4 hidden p-3 bg-red-100 border border-red-300 text-red-700 rounded"></div>

                        <form action="{{ route('equipements.store') }}" method="POST" enctype="multipart/form-data" id="addEquipementForm">
                            @csrf

                            <div class="mb-4">
                                <input type="text" name="nom" placeholder="Nom de l'équipement" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Type d'équipement</label>
                                <select name="type" class="w-full border border-gray-300 rounded p-2" required>
                                    <option value="">-- Sélectionner --</option>
                                    <option value="Ordinateur">Ordinateur</option>
                                    <option value="Imprimante">Imprimante</option>
                                    <option value="Serveur">Serveur</option>
                                    <option value="Switch">Switch</option>
                                    <option value="Routeur">Routeur</option>
                                    <option value="Écran">Écran</option>
                                    <option value="Souris">Souris</option>
                                    <option value="Téléphone">Téléphone</option>
                                    <option value="Télévision">Télévision</option>
                                    <option value="Rallonge">Rallonge</option>
                                    <option value="Adaptateur">Adaptateur</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <input type="text" name="cout" placeholder="Coût" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">État</label>
                                <select name="etat" class="w-full border border-gray-300 rounded p-2" required>
                                    <option value="actif">Actif</option>
                                    <option value="en panne">En panne</option>
                                    <option value="hors service">Hors service</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Date d'achat</label>
                                <input type="date" name="date_achat" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-4">
                                <input type="text" name="code_barre" placeholder="Code Barre" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-4">
                                <input type="text" name="numero_serie" placeholder="Numéro de série" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-4">
                                <input type="text" name="marque" placeholder="Marque" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700"></label>
                                <textarea name="caracteristique" placeholder="Caractéristiques" class="w-full border border-gray-300 rounded p-2" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Photo</label>
                                <input type="file" name="photo_equip" class="w-full border border-gray-300 rounded p-2">
                            </div>

                            <div class="flex justify-between mt-6">
                                <button type="button" id="btn-close-add" class="bg-[#1FB19E] text-white px-4 py-2 rounded">Annuler</button>
                                <button type="submit" class="bg-[#3A5DA8] text-white px-4 py-2 rounded">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL DE MODIFICATION -->
            <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white shadow-lg w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">

                <!-- Bouton fermer -->
                <button class="absolute top-3 right-3 text-[#1FB19E] hover:text-gray-800 text-2xl" onclick="closeEditModal()">×</button>

                <form id="editForm" method="POST" enctype="multipart/form-data">
                    <div class="text-center text-[#1FB19E] mt-8">
                        <x-input-label for="inscription" :value="__('Modifier l’équipement')" style="font-size: 16px;" class=" text-right text-[#1FB19E]"  />
                    </div>

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium">Nom</label>
                        <input type="text" name="nom" id="editNom" class="w-full border p-2 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Type</label>

                        <select name="type" id="editType" class="w-full border p-2 rounded-lg" required>
                            <option value="">-- Sélectionner un type --</option>
                            <option value="Ordinateur">Ordinateur</option>
                            <option value="Imprimante">Imprimante</option>
                            <option value="Routeur">Routeur</option>
                            <option value="Switch">Switch</option>
                            <option value="Serveur">Serveur</option>
                            <option value="Écran">Écran</option>
                            <option value="Téléphone">Téléphone</option>
                            <option value="Télévision">Télévision</option>
                            <option value="Rallonge">Rallonge</option>
                            <option value="Adaptateur">Adaptateur</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Coût</label>
                        <input type="text" name="cout" id="editCout" class="w-full border p-2 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">État</label>

                        <select name="etat" id="editEtat" class="w-full border p-2 rounded-lg" required>
                            <option value="">-- Sélectionner l’état --</option>
                            <option value="actif">Actif</option>
                            <option value="en panne">En panne</option>
                            <option value="hors service">Hors service</option>
                        </select>
                    </div>


                    <div>
                        <label class="block text-gray-700 font-medium">Date d'achat</label>
                        <input type="date" name="date_achat" id="editDateAchat" class="w-full border p-2 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Numéro de série</label>
                        <input type="text" name="numero_serie" id="editNumeroSerie" class="w-full border p-2 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Marque</label>
                        <input type="text" name="marque" id="editMarque" class="w-full border p-2 rounded-lg">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium">Caractéristiques</label>
                        <textarea name="caracteristique" id="editCaracteristique" class="w-full border p-2 rounded-lg" rows="3"></textarea>
                    </div>
                    </div>

                    <div class="mt-4">
                    <label class="block text-gray-700 font-medium">Photo</label>
                    <input type="file" name="photo_equip" class="w-full border p-2 rounded-lg">
                    </div>

                    <div class="flex justify-end mt-6 space-x-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-[#1FB19E] text-white rounded-lg">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-[#3A5DA8] text-white rounded-lg ">Mettre à jour</button>
                    </div>
                </form>

                </div>
            </div>
            </div>



            <!-- Modal de visualisation -->
            <div id="showModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
                <div class="flex items-center justify-center min-h-screen"> 
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">

                    <!-- Bouton fermer -->
                    <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeShowModal()">×</button>

                    <h2 class="text-2xl font-bold text-[#1FB19E] mb-4">Détails de l’équipement</h2>

                    <div id="showModalContent" class="space-y-3 text-gray-700">
                    <!-- Les informations seront chargées ici -->
                    <p>Chargement...</p>
                    </div>

                    <div class="flex justify-end mt-6">
                    <button onclick="closeShowModal()" class="px-4 py-2 bg-[#1FB19E] text-white rounded-lg ">Fermer</button>
                    </div>
                </div>

                </div>
                
            </div>

            </div>

        </main>


                    <!-- Script d'ajout -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('addEquipementModal');
                const openBtn = document.getElementById('btn-open-add');
                const closeBtn = document.getElementById('btn-close-add');
                const errorsDiv = document.getElementById('addErrors');

                openBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    errorsDiv.classList.add('hidden');
                    errorsDiv.innerHTML = '';
                });

                closeBtn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });

                modal.addEventListener('click', e => {
                    if(e.target === modal) modal.classList.add('hidden');
                });
            });
        </script>

        <!-- Script du pop pop du formulaire de modification -->
        <script>
            // Fonction pour ouvrir le modal et remplir les champs
            function openEditModal(id, nom, type, dateAchat, caracteristique, cout, etat, numeroSerie, marque) {
                const modal = document.getElementById('editModal');
                const form = document.getElementById('editForm');

                modal.classList.remove('hidden'); //  Affiche le modal

                // Remplir les champs du formulaire
                document.getElementById('editNom').value = nom;
                document.getElementById('editType').value = type;
                document.getElementById('editDateAchat').value = dateAchat;
                document.getElementById('editCaracteristique').value = caracteristique;
                document.getElementById('editCout').value = cout;
                document.getElementById('editEtat').value = etat;
                document.getElementById('editNumeroSerie').value = numeroSerie;
                document.getElementById('editMarque').value = marque;

                // Définir l’action du formulaire
                form.action = `/equipements/${id}`;
            }

            // Fonction pour fermer le modal
            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            //  Fermer automatiquement le modal après soumission
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('editForm');
                form.addEventListener('submit', function () {
                closeEditModal();
                });
            });
        </script>



            <!-- Script de pop pup de détaille d'équipement -->
        <script>
            function openShowModal(id) {
                // Afficher le modal
                const modal = document.getElementById('showModal');
                modal.classList.remove('hidden');

                // Cibler le conteneur du contenu
                const content = document.getElementById('showModalContent');
                content.innerHTML = "<p class='text-center text-gray-500'>Chargement...</p>";

                // Requête AJAX pour récupérer les infos de l’équipement
                fetch(`/equipements/${id}`)
                    .then(response => response.text())
                    .then(html => {
                        // Extraire seulement le contenu utile (le bloc de détails)
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const details = doc.querySelector('.max-w-4xl');
                        content.innerHTML = details ? details.innerHTML : "<p>Impossible de charger les données.</p>";
                    })
                    .catch(() => {
                        content.innerHTML = "<p class='text-red-500 text-center'>Erreur de chargement.</p>";
                    });
            }

            function closeShowModal() {
                document.getElementById('showModal').classList.add('hidden');
            }
        </script>



    </div>

</x-app-layout>
