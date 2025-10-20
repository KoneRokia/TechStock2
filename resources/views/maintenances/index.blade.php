<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 bg-[#3A5DA8] -translate-y-1">
        <div class="bg-[#F3F3F3] h-[750px] rounded-bl-[50px] mt-[3px]">
            <div class="container p-8">

            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                <button id="btn-open-add-maintenance" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">
                    Ajouter une maintenance
                </button>
             @endif
            <h2 class="mb-4 text-xl font-bold text-[#1FB19E]">Listes des maintenances</h2>

            <div class="overflow-y-auto max-h-[500px] border rounded-lg">
                <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                <thead>
                    <tr class="text-[#585858] bg-[#D9D9D9]">
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Date</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Type</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Coût</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>État</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Technicien</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                                <span>Équipement</span>
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
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

                                     <!-- Bouton Voir -->
                                    <button 
                                        onclick="openShowModal({{ $maintenance->id }})" 
                                        class="text-green-500">
                                        <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">
                                    </button>

                            <!-- Bouton Modifier pour tous les utilisateurs -->
                                @php
                                    $userRole = auth()->user()->role;
                                @endphp

                                @if ($userRole === 'admin' || $userRole === 'editeur')
                                    <!-- Bouton Modifier visible uniquement pour admin et éditeur -->
                                    <button 
                                        class="text-blue-500"
                                        onclick="openEditModal({{ $maintenance->id }}, '{{ $maintenance->date }}', '{{ $maintenance->type }}', '{{ $maintenance->cout }}', '{{ $maintenance->etat }}', '{{ $maintenance->user_id }}', '{{ $maintenance->equipement_id }}')">
                                        <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                                    </button>
                                @else
                                    <!-- Bouton visible mais désactivé pour les autres rôles -->
                                    <button 
                                        class="text-gray-400 cursor-not-allowed"
                                        onclick="event.preventDefault(); alert('Seuls l\'admin et l\'éditeur peuvent modifier.');">
                                        <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block opacity-50">
                                    </button>
                                @endif


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
                                            <img src="{{ asset('images/Group 10.png') }}" alt="Supprimer" class="w-5 h-5 inline-block">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>


        </div>

        <!-- Modal Ajouter Maintenance -->
<div id="addMaintenanceModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-semibold text-[#1FB19E] mb-4 text-center">Ajouter une maintenance</h2>

            <!-- Affichage des erreurs -->
            <div id="addMaintenanceErrors" class="mb-4 hidden p-3 bg-red-100 border border-red-300 text-red-700 rounded"></div>

            <form action="{{ route('maintenances.store') }}" method="POST" id="addMaintenanceForm">
                @csrf

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Type de maintenance</label>
                    <select name="type" class="w-full border border-gray-300 rounded p-2" required>
                        <option value="">-- Sélectionner un type --</option>
                        <option value="Préventive">Préventive</option>
                        <option value="Curative">Curative</option>
                        <option value="Corrective">Corrective</option>
                        <option value="Évolutive">Évolutive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Coût</label>
                    <input type="text" name="cout" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">État</label>
                    <select name="etat" class="w-full border border-gray-300 rounded p-2" required>
                        <option value="en cours">En cours</option>
                        <option value="terminé">Terminé</option>
                        <option value="en attente">En attente</option>
                        <option value="annulé">Annulé</option>
                        <option value="reporté">Reporté</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Technicien</label>
                    <select name="user_id" class="w-full border border-gray-300 rounded p-2" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Équipement</label>
                    <select name="equipement_id" class="w-full border border-gray-300 rounded p-2" required>
                        @foreach($equipements as $equipement)
                            <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" id="btn-close-add-maintenance" class="bg-[#1FB19E] text-white px-4 py-2 rounded">Annuler</button>
                    <button type="submit" class="bg-[#3A5DA8] text-white px-4 py-2 rounded">Enregistrer</button>
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
                    <button class="absolute top-3 right-3 [#1FB19E] text-2xl" onclick="closeShowModal()">×</button>

                    <h2 class="text-2xl font-bold text-[#1FB19E] mb-4">Détails de la maintenance</h2>

                    <div id="showModalContent" class="space-y-3 text-gray-700">
                        <p class="text-center text-gray-500">Chargement...</p>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button onclick="closeShowModal()" class="px-4 py-2 bg-[#1FB19E] text-white rounded-lg ">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>

                <!-- Modal de modification -->
    
        <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
            <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative flex">
            
            <!-- Contenu du formulaire -->
            <div class="bg-white w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                
                <!-- Bouton fermer -->
                <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeEditModal()">×</button>


                <form id="editForm" method="POST" class="space-y-4">
                        <div class="text-center text-[#1FB19E] mt-8">
                            <x-input-label for="inscription" :value="__('Modifier la maintenance')" style="font-size: 16px;" class=" text-right text-[#1FB19E]"  />
                        </div>
                    @csrf
                    @method('PUT')

                    <!-- Date -->
                    <div>
                        <label class="block text-gray-700">Date</label>
                        <input type="date" name="date" id="edit_date" class="w-full p-2 border rounded-md" required>
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-gray-700">Type</label>
                        <select name="type" id="edit_type" class="w-full p-2 border rounded-md" required>
                            <option value="Préventive">Préventive</option>
                            <option value="Curative">Curative</option>
                            <option value="Corrective">Corrective</option>
                            <option value="Évolutive">Évolutive</option>
                        </select>
                    </div>

                    <!-- Coût -->
                    <div>
                        <label class="block text-gray-700">Coût</label>
                        <input type="text" name="cout" id="edit_cout" class="w-full p-2 border rounded-md" required>
                    </div>

                    <!-- État -->
                    <div>
                        <label class="block text-gray-700">État</label>
                        <select name="etat" id="edit_etat" class="w-full p-2 border rounded-md" required>
                            <option value="en cours">En cours</option>
                            <option value="terminé">Terminé</option>
                            <option value="en attente">En attente</option>
                            <option value="annulé">Annulé</option>
                            <option value="reporté">Reporté</option>
                        </select>
                    </div>

                    <!-- Technicien -->
                    <div>
                        <label class="block text-gray-700">Technicien</label>
                        <select name="user_id" id="edit_user" class="w-full p-2 border rounded-md" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Équipement -->
                    <div>
                        <label class="block text-gray-700">Équipement</label>
                        <select name="equipement_id" id="edit_equipement" class="w-full p-2 border rounded-md" required>
                            @foreach($equipements as $equipement)
                                <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 text-white bg-[#3A5DA8] rounded-lg ">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </main>

        <!-- Script d'ajout -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('addMaintenanceModal');
                const openBtn = document.getElementById('btn-open-add-maintenance');
                const closeBtn = document.getElementById('btn-close-add-maintenance');
                const errorsDiv = document.getElementById('addMaintenanceErrors');

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

                   <!-- Script de pop pup de détaille de maintenance -->
        <script>
            function openShowModal(id) {
                const modal = document.getElementById('showModal');
                const content = document.getElementById('showModalContent');
                modal.classList.remove('hidden');
                content.innerHTML = "<p class='text-center text-gray-500'>Chargement...</p>";

                fetch(`/maintenances/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        content.innerHTML = `
                            <p><strong>Équipement :</strong> ${data.equipement}</p>
                            <p><strong>Type :</strong> ${data.type}</p>
                            <p><strong>Coût :</strong> ${data.cout}</p>
                            <p><strong>Date :</strong> ${data.date}</p>
                            <p><strong>État :</strong> ${data.etat}</p>
                            <p><strong>Technicien :</strong> ${data.technicien}</p>
                        `;
                    })
                    .catch(() => {
                        content.innerHTML = "<p class='text-red-500 text-center'>Erreur de chargement.</p>";
                    });
            }

            function closeShowModal() {
                document.getElementById('showModal').classList.add('hidden');
            }
        </script>

        <!-- Script de modification -->
            <script>
                function openEditModal(id, date, type, cout, etat, user_id, equipement_id) {
                    // Ouvrir le modal
                    const modal = document.getElementById('editModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    // Pré-remplir les champs
                    document.getElementById('edit_date').value = date;
                    document.getElementById('edit_type').value = type;
                    document.getElementById('edit_cout').value = cout;
                    document.getElementById('edit_etat').value = etat;
                    document.getElementById('edit_user').value = user_id;
                    document.getElementById('edit_equipement').value = equipement_id;

                    // Mettre à jour l’action du formulaire
                    const form = document.getElementById('editForm');
                    form.action = `/maintenances/${id}`;
                }

                function closeEditModal() {
                    const modal = document.getElementById('editModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>

                
</div>
</x-app-layout>
