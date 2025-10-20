
<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 bg-[#3A5DA8] -translate-y-1">
            <div class="bg-[#F3F3F3] h-[700px] rounded-bl-[50px] mt-[3px]">
                <div class="container p-8">

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                    <button
                        class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg"
                        onclick="openAddEmployeeModal()">
                        Ajouter un employé
                    </button>
                @endif


                    <h1 class="mb-4 text-2xl font-semibold text-[#1FB19E]">Liste des employés</h1>

                <div class="overflow-y-auto max-h-[500px] border rounded-lg">
                    <!-- Affichage des employés -->
                <table  class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                        <thead class="sticky top-0 bg-[#67b09d] text-white">
                            <tr class="text-[#585858] bg-[#D9D9D9]">
                                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                    <span>Nom</span>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                                </th>
                                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                    <span>Prénom</span>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                                </th>
                                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                    <span>Coût</span>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                                </th>
                                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                    <span>Date d'embauche</span>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                                </th>
                                {{-- <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Utilisateur</th> --}}
                                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                    <span>Équipements</span>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                                </th>
                                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                    <span>Action</span>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                                </th>
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
                                   <!-- Bouton Voir -->
                                <button 
                                    onclick="openShowModal({{ $employe->id }})"
                                    class="text-green-500">
                                    <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">
                                </button>

                                <!-- Bouton de modificaion -->

                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                                        <button
                                            class="text-blue-500"
                                            onclick="openEditEmployeeModal(
                                                {{ $employe->id }},
                                                '{{ $employe->nom }}',
                                                '{{ $employe->prenom }}',
                                                '{{ $employe->email }}',
                                                '{{ $employe->telephone }}',
                                                '{{ $employe->poste }}',
                                                '{{ $employe->date_embauche }}'
                                            )">
                                            <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                                        </button>
                                    @endif


                                    <!-- Bouton Désactiver -->
                                    <form action="{{ route('employes.toggle', $employe->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')

                                        @if ($employe->statut === 'actif')
                                            <button type="submit"
                                                    class="text-orange-500 hover:text-orange-700"
                                                    onclick="return confirm('Voulez-vous vraiment désactiver cet employé ?');">
                                               <img src="{{ asset('images/desatif.png') }}" alt="desativer" class="w-5 h-5 inline-block">
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="text-green-500 hover:text-green-700"
                                                    onclick="return confirm('Voulez-vous vraiment activer cet employé ?');">
                                                <img src="{{ asset('images/actif.png') }}" alt="activer" class="w-5 h-5 inline-block">
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
                                            <img src="{{ asset('images/Group 10.png') }}" alt="Supprimer" class="w-5 h-5 inline-block">
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


                <!-- Modal Ajouter Employé -->
                <div id="addEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                    <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative flex">
                        <div class="bg-white w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                            <!-- Bouton fermer -->
                            <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeAddEmployeeModal()">×</button>

                            <!-- Formulaire d'ajout -->
                            <form action="{{ route('employes.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <h2 class="text-center text-[#1FB19E] mt-4 text-xl font-bold">Ajouter un nouvel employé</h2>

                                <input type="text" name="nom" placeholder="Nom" class="w-full p-2 border rounded-md" required value="{{ old('nom') }}">
                                <input type="text" name="prenom" placeholder="Prénom" class="w-full p-2 border rounded-md" required value="{{ old('prenom') }}">
                                <input type="text" name="telephone" placeholder="Téléphone" class="w-full p-2 border rounded-md" value="{{ old('telephone') }}">
                                <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded-md" value="{{ old('email') }}">
                                <input type="text" name="poste" placeholder="Poste" class="w-full p-2 border rounded-md" value="{{ old('poste') }}">
                                <input type="date" name="date_embauche" class="w-full p-2 border rounded-md" value="{{ old('date_embauche') }}">
                                
                                <select name="equipement_id[]" class="w-full p-2 border rounded-md" multiple>
                                    @foreach($equipements as $equipement)
                                        <option value="{{ $equipement->id }}">{{ $equipement->nom }} ({{ $equipement->numero_serie }})</option>
                                    @endforeach
                                </select>

                                <div class="flex justify-end">
                                    <button type="submit" class="px-4 py-2 text-white bg-[#3A5DA8] rounded-lg">Créer l'employé</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Modal Détails Employé -->
            <div id="showModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-2xl shadow-lg w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]">
                
                        <!-- Bouton fermer -->
                        <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeShowModal()">×</button>

                        <h2 class="text-2xl font-bold text-[#1FB19E] mb-4">Détails de l’employé</h2>

                        <!-- Contenu dynamique -->
                        <div id="showModalContent" class="space-y-3 text-gray-700">
                        <p>Chargement...</p>
                        </div>

                        <div class="flex justify-end mt-6">
                        <button onclick="closeShowModal()" class="px-4 py-2 bg-[#1FB19E]  text-white rounded-lg hover:[#1FB19E] ">Fermer</button>
                        </div>
                    </div>

                </div>
            
            </div>


            <!-- Modal Modifier Employé -->
            <div id="editEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative flex">
                    <div class="bg-white w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                        <!-- Bouton fermer -->
                        <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeEditEmployeeModal()">×</button>

                        <!-- Formulaire de modification -->
                        <form id="editEmployeeForm" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <h2 class="text-center text-[#1FB19E] mt-4 text-xl font-bold">Modifier l'employé</h2>

                            <input type="text" name="nom" id="edit_nom" placeholder="Nom" class="w-full p-2 border rounded-md" required>
                            <input type="text" name="prenom" id="edit_prenom" placeholder="Prénom" class="w-full p-2 border rounded-md" required>
                            <input type="email" name="email" id="edit_email" placeholder="Email" class="w-full p-2 border rounded-md" required>
                            <input type="text" name="telephone" id="edit_telephone" placeholder="Téléphone" class="w-full p-2 border rounded-md">
                            <input type="text" name="poste" id="edit_poste" placeholder="Poste" class="w-full p-2 border rounded-md">
                            <input type="date" name="date_embauche" id="edit_date_embauche" class="w-full p-2 border rounded-md" required>

                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 text-white bg-[#3A5DA8] rounded-lg">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </main>


            <!-- Script d'ajouter Employé -->
            <script>
                function openAddEmployeeModal() {
                    const modal = document.getElementById('addEmployeeModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeAddEmployeeModal() {
                    const modal = document.getElementById('addEmployeeModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>


        <!-- Script de visualisation d'employé -->
                <script>
                    function openShowModal(id) {
                        const modal = document.getElementById('showModal');
                        const content = document.getElementById('showModalContent');

                        // Affiche le modal
                        modal.classList.remove('hidden');

                        // Affiche un message de chargement
                        content.innerHTML = '<p>Chargement...</p>';

                        // Requête AJAX pour récupérer les infos de l’employé
                        fetch(`/employes/${id}`)
                            .then(response => response.text())
                            .then(html => {
                                // Injecter le contenu récupéré dans le modal
                                content.innerHTML = html;
                            })
                            .catch(error => {
                                content.innerHTML = `<p class="text-red-500">Erreur de chargement</p>`;
                                console.error(error);
                            });
                    }

                    function closeShowModal() {
                        document.getElementById('showModal').classList.add('hidden');
                    }
                </script>

                    <!-- Script de modification d'employé -->
                    <script>
                        function openEditEmployeeModal(id, nom, prenom, email, telephone, poste, date_embauche) {
                            const modal = document.getElementById('editEmployeeModal');
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');

                            // Préremplir les champs
                            document.getElementById('edit_nom').value = nom;
                            document.getElementById('edit_prenom').value = prenom;
                            document.getElementById('edit_email').value = email;
                            document.getElementById('edit_telephone').value = telephone;
                            document.getElementById('edit_poste').value = poste;
                            document.getElementById('edit_date_embauche').value = date_embauche;

                            // Mettre à jour l'action du formulaire
                            const form = document.getElementById('editEmployeeForm');
                            form.action = `/employes/${id}`;
                        }

                        function closeEditEmployeeModal() {
                            const modal = document.getElementById('editEmployeeModal');
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                        }
                    </script>



    </div>

</x-app-layout>
