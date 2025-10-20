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
                <button onclick="openAddLogicielModal()" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg hover:bg-[#2e4a85] transition">
                    Ajouter un Logiciel
                </button>
            @endif


              <h1 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des Logiciels</h1>

            <div class="overflow-y-auto max-h-[500px] border rounded-lg">
            <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
            <thead>
                    <tr class="text-[#585858] bg-[#D9D9D9]">
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Nom</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Version</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Licence Associées</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Employés utilisant ce logiciel</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>

                         <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Editeur</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
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
                            <td class="px-4 py-2 border">{{ $logiciel->editeur }}</td>

                        <td class="px-4 py-2 border">

                           <!-- Bouton Voir -->
                        <button 
                            onclick="openShowLogicielModal({{ $logiciel->id }})" 
                            class="text-green-500">
                            <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">
                        </button>



                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                                <!-- Bouton Modifier -->
                               <button onclick="openEditLogicielModal({{ $logiciel->id }})" class="text-blue-500" title="Modifier">
                                    <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                                </button>

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
                                        <img src="{{ asset('images/Group 10.png') }}" alt="Supprimer" class="w-5 h-5 inline-block">
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

        </div>

           <!-- Modal d'ajout de logiciel -->
            <div id="addLogicielModal" 
                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                    <h2 class="text-xl  mb-4 text-green-500">Ajouter un Logiciel</h2>

                    <!-- Bouton fermer -->
                    <button onclick="closeAddLogicielModal()" 
                            class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times"></i>
                    </button>

                    <form action="{{ route('logiciels.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4">
                            <input type="text" name="nom" placeholder="Nom du Logiciel" required class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <input type="text" name="version" placeholder="Version" class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <input type="text" name="editeur" placeholder="Éditeur" class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Type</label>
                            <select name="type" class="w-full p-2 border rounded-md">
                                <option value="abonnement">Abonnement</option>
                                <option value="perpétuel">Perpétuel</option>
                                <option value="mensuel">Mensuel</option>
                                <option value="trimestriel">Trimestriel</option>
                                <option value="annuel">Annuel</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Date d'achat</label>
                            <input type="date" name="date_achat" class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Licence associée</label>
                            <select name="licence_id" class="w-full p-2 border rounded-md">
                                <option value="">Aucune</option>
                                @foreach($licences as $licence)
                                    <option value="{{ $licence->id }}">{{ $licence->cle_licence }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Attribuer à des employés</label>
                            <select name="employe_ids[]" multiple class="w-full p-2 border rounded-md">
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->id }}">{{ $employe->nom }} {{ $employe->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeAddLogicielModal()" 
                                    class="px-4 py-2 bg-[#1FB19E] text-white rounded-lg ">
                                Annuler
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-[#3A5DA8] text-white rounded-lg">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Détails Logiciel -->
            <div id="showLogicielModal" 
                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative">
                    <h2 class="text-xl font-bold mb-4">Détails du Logiciel</h2>

                    <!-- Bouton fermer -->
                    <button onclick="closeShowLogicielModal()" 
                            class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="space-y-2">
                        <p><strong>Nom :</strong> <span id="show_nom"></span></p>
                        <p><strong>Version :</strong> <span id="show_version"></span></p>
                        <p><strong>Éditeur :</strong> <span id="show_editeur"></span></p>
                        <p><strong>Type :</strong> <span id="show_type"></span></p>
                        <p><strong>Date d'achat :</strong> <span id="show_date_achat"></span></p>
                        <p><strong>Licence associée :</strong> <span id="show_licences"></span></p>
                        <p><strong>Employés assignés :</strong> <span id="show_employes"></span></p>
                    </div>
                </div>
            </div>


            <!-- Modal de modification -->
            <div id="editLogicielModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative flex">
                    <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                    
                    <h2 class="text-xl font-bold mb-4 text-[#1FB19E] ">Modifier un Logiciel</h2>

                    <!-- Bouton fermer -->
                    <button onclick="closeEditLogicielModal()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times"></i>
                    </button>

                    <form id="editLogicielForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Nom du Logiciel</label>
                            <input type="text" id="edit_nom" name="nom" required class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Version</label>
                            <input type="text" id="edit_version" name="version" class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Éditeur</label>
                            <input type="text" id="edit_editeur" name="editeur" class="w-full p-2 border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Type</label>
                            <select id="edit_type" name="type" class="w-full p-2 border rounded-md">
                                <option value="abonnement">Abonnement</option>
                                <option value="perpétuel">Perpétuel</option>
                                <option value="mensuel">Mensuel</option>
                                <option value="trimestriel">Trimestriel</option>
                                <option value="annuel">Annuel</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Date d'achat</label>
                            <input type="date" id="edit_date_achat" name="date_achat" class="w-full p-2 border rounded-md">
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeEditLogicielModal()" class="px-4 py-2 bg-[#1FB19E]  text-white rounded-lg hover:bg-[#1FB19E] ">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-[#3A5DA8] text-white rounded-lg ">Mettre à jour</button>
                        </div>
                    </form>
                    </div>
                            
                </div>
                
            </div>

        </div>      
    </main>

            <!-- Script d'ajout de logiciel -->
            <script>
                function openAddLogicielModal() {
                    const modal = document.getElementById('addLogicielModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeAddLogicielModal() {
                    const modal = document.getElementById('addLogicielModal');
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }
            </script>

            <!-- Script de visualisation -->
            <script>
                function openShowLogicielModal(id) {
                    const modal = document.getElementById('showLogicielModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    // Charger les données du logiciel
                    fetch(`/logiciels/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('show_nom').textContent = data.nom;
                            document.getElementById('show_version').textContent = data.version;
                            document.getElementById('show_editeur').textContent = data.editeur;
                            document.getElementById('show_type').textContent = data.type;
                            document.getElementById('show_date_achat').textContent = data.date_achat;
                            document.getElementById('show_licences').textContent = 
                                data.licences.length > 0 ? data.licences.map(l => l.cle_licence).join(', ') : 'Aucune';
                            document.getElementById('show_employes').textContent = 
                                data.employes.length > 0 ? data.employes.map(e => e.nom).join(', ') : 'Aucun';
                        });
                }

                function closeShowLogicielModal() {
                    const modal = document.getElementById('showLogicielModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>

                <!-- Script de modification d logiciel -->
                <script>
                   function openEditLogicielModal(id) {
                        const modal = document.getElementById('editLogicielModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');

                        fetch(`/logiciels/${id}/data`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('edit_nom').value = data.nom || '';
                                document.getElementById('edit_version').value = data.version || '';
                                document.getElementById('edit_editeur').value = data.éditeur || '';
                                document.getElementById('edit_type').value = data.type || '';
                                document.getElementById('edit_date_achat').value = data.date_achat || '';

                                // Action du formulaire
                                document.getElementById('editLogicielForm').action = `/logiciels/${id}`;
                            })
                            .catch(error => console.error('Erreur lors du chargement :', error));
                    }


                    function closeEditLogicielModal() {
                        const modal = document.getElementById('editLogicielModal');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                </script>

                <script>
                @if ($errors->any())
                    openAddLogicielModal();
                @endif
            </script>



</div>
</x-app-layout>
