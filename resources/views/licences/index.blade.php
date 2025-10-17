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
                    <button 
                        onclick="openAddLicenceModal()" 
                        class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">
                        Ajouter une licence
                    </button>
                @endif <br> <br>

             <h2 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des licences</h2>

             <div class="overflow-y-auto max-h-[500px] border rounded-lg">
                <!-- Affichage des licences -->
            <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                <thead>
                    <tr class="text-[#585858] bg-[#D9D9D9]">
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Clé de licence</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Type</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Nombre d'utilisateurs</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Date d'expiration</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>État</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Logiciels associés</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
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

                                <!-- Bouton Voir -->
                                <button 
                                    onclick="openShowModal({{ $licence->id }})" 
                                    class="text-green-500">
                                    <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">
                                </button>

                                <!-- Bouton Modifier -->
                                
                                <button class="btn-open-edit-licence text-blue-500"
                                    data-id="{{ $licence->id }}"
                                    data-cle="{{ $licence->cle_licence }}"
                                    data-type="{{ $licence->type }}"
                                    data-nombre="{{ $licence->nombre_utilisateurs }}"
                                    data-date_expiration="{{ $licence->date_expiration }}"
                                    data-etat="{{ $licence->etat }}"
                                    data-logiciel_id="{{ $licence->logiciels->first()->id ?? '' }}"
                                    @if(auth()->user()->role !== 'admin' && auth()->user()->role !== 'editeur')
                                        disabled
                                        title="Seuls l'admin et l'éditeur peuvent modifier."
                                    @endif>
                                    <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                                </button>


                                <!-- Bouton Supprimer accessible uniquement aux admins -->
                                <form action="{{ route('licences.destroy', $licence->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette licence ?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
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
                    <!-- Modal d'ajout de licence -->
            <div id="addLicenceModal" class="fixed inset-0 hidden items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">

                    <!-- Bouton de fermeture -->
                    <button 
                        onclick="closeAddLicenceModal()" 
                        class="absolute top-2 right-2 text-gray-600 hover:text-red-500">
                        <i class="fas fa-times"></i>
                    </button>

                    <h2 class="text-2xl font-bold mb-4 text-center text-[#1FB19E]">Ajouter une Licence</h2>

                    <form action="{{ route('licences.store') }}" method="POST" class="space-y-4">
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

                        <div>
                            <label class="block font-semibold">Clé de Licence</label>
                            <input type="text" name="cle_licence" class="w-full p-2 border rounded" required>
                        </div>

                        <div>
                            <label class="block font-semibold">Type</label>
                            <select name="type" class="w-full p-2 border rounded" required>
                                <option value="abonnement">Abonnement</option>
                                <option value="perpétuel">Perpétuel</option>
                                <option value="annuel">Annuel</option>
                                <option value="trimestriel">Trimestriel</option>
                                <option value="mensuel">Mensuel</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold">Date d’Expiration</label>
                            <input type="date" name="date_expiration" class="w-full p-2 border rounded">
                        </div>

                        <div>
                            <label class="block font-semibold">Sélectionner les logiciels</label>
                            <select name="logiciel_ids[]" multiple class="w-full p-2 border rounded">
                                @foreach($logiciels as $logiciel)
                                    <option value="{{ $logiciel->id }}">{{ $logiciel->nom }} ({{ $logiciel->version }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold">Nombre d’utilisateurs</label>
                            <input type="text" name="nombre_utilisateurs" class="w-full p-2 border rounded">
                        </div>

                        <div>
                            <label class="block font-semibold">État</label>
                            <select name="etat" class="w-full p-2 border rounded">
                                <option value="active">Active</option>
                                <option value="expirée">Expirée</option>
                                <option value="bientôt expirée">Bientôt expirée</option>
                            </select>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="bg-[#3A5DA8] text-white px-4 py-2 rounded ">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Modal de visualisation -->
            <div id="showModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">

                        <!-- Bouton Fermer -->
                        <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeShowModal()">×</button>

                        <h2 class="text-2xl font-bold text-[#1FB19E] mb-4">Détails de la licence</h2>

                        <div id="showModalContent" class="space-y-3 text-gray-700">
                            <p>Chargement...</p>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button onclick="closeShowModal()" class="px-4 py-2 bg-[#1FB19E] text-white rounded-lg hover:bg-gray-500">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Modal de modification -->
        <div id="editLicenceModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50">
            <div class="flex justify-center items-center min-h-screen">
                <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem;">
                    <h2 class="text-xl text-[#1FB19E] mb-4 text-center">Modifier la licence</h2>

                    <div id="editErrors" class="mb-4 hidden p-3 bg-red-100 border border-red-300 text-red-700 rounded"></div>

                    <form id="editLicenceForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Clé licence</label>
                            <input type="text" id="edit_cle" name="cle_licence" class="w-full border border-gray-300 rounded p-2" required>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Type</label>
                            <select id="edit_type" name="type" class="w-full border border-gray-300 rounded p-2" required>
                                <option value="abonnement">Abonnement</option>
                                <option value="perpétuel">Perpétuel</option>
                                <option value="annuel">Annuel</option>
                                <option value="trimestriel">Trimestriel</option>
                                <option value="mensuel">Mensuel</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nombre d'utilisateurs</label>
                            <input type="text" id="edit_nombre" name="nombre_utilisateurs" class="w-full border border-gray-300 rounded p-2" required>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Date d’expiration</label>
                            <input type="date" id="edit_date_expiration" name="date_expiration" class="w-full border border-gray-300 rounded p-2" required>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">État</label>
                            <select id="edit_etat" name="etat" class="w-full border border-gray-300 rounded p-2">
                                <option value="active">Active</option>
                                <option value="expirée">Expirée</option>
                                <option value="bientôt expirée">Bientôt expirée</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Logiciel</label>
                            <select id="edit_logiciel_id" name="logiciel_id" class="w-full border border-gray-300 rounded p-2" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($logiciels as $logiciel)
                                    <option value="{{ $logiciel->id }}">{{ $logiciel->nom }} ({{ $logiciel->version }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-between mt-6">
                            <button type="button" id="btn-close-edit" class="bg-[#1FB19E] text-white px-4 py-2 rounded">Annuler</button>
                            <button type="submit" class="bg-[#3A5DA8] text-white px-4 py-2 rounded">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        </main>
    </div>

            <!-- Script d'ajout de licence -->
            <script>
                const addLicenceModal = document.getElementById('addLicenceModal');

                function openAddLicenceModal() {
                    addLicenceModal.classList.remove('hidden');
                    addLicenceModal.classList.add('flex');
                }

                function closeAddLicenceModal() {
                    addLicenceModal.classList.add('hidden');
                    addLicenceModal.classList.remove('flex');
                }

                // Fermer le modal si on clique en dehors du contenu
                addLicenceModal.addEventListener('click', (e) => {
                    if (e.target === addLicenceModal) {
                        closeAddLicenceModal();
                    }
                });

                    @if ($errors->any())
                        openAddLogicielModal();
                    @endif
            </script>

                <!-- Script de visualisation -->
            <script>
                function openShowModal(id) {
                    const modal = document.getElementById('showModal');
                    modal.classList.remove('hidden');

                    const content = document.getElementById('showModalContent');
                    content.innerHTML = "<p class='text-center text-gray-500'>Chargement...</p>";

                    // Appel AJAX pour récupérer les détails de la licence
                    fetch(`/licences/${id}`)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const details = doc.querySelector('.max-w-4xl'); // le bloc principal du show
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

                <!-- Script de Modification -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const modal = document.getElementById('editLicenceModal');
                        const openButtons = document.querySelectorAll('.btn-open-edit-licence');
                        const closeBtn = document.getElementById('btn-close-edit');
                        const form = document.getElementById('editLicenceForm');
                        const errorsDiv = document.getElementById('editErrors');

                        openButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                const id = button.dataset.id;
                                form.action = `/licences/${id}`; // Assure-toi que c'est bien ta route update
                                document.getElementById('edit_id').value = id;
                                document.getElementById('edit_cle').value = button.dataset.cle;
                                document.getElementById('edit_type').value = button.dataset.type;
                                document.getElementById('edit_nombre').value = button.dataset.nombre;
                                document.getElementById('edit_date_expiration').value = button.dataset.date_expiration;
                                document.getElementById('edit_etat').value = button.dataset.etat;
                                document.getElementById('edit_logiciel_id').value = button.dataset.logiciel_id;

                                errorsDiv.classList.add('hidden');
                                errorsDiv.innerHTML = '';

                                modal.classList.remove('hidden');
                            });
                        });

                        closeBtn.addEventListener('click', () => {
                            modal.classList.add('hidden');
                        });

                        modal.addEventListener('click', e => {
                            if(e.target === modal) modal.classList.add('hidden');
                        });

                        form.addEventListener('submit', function(e) {
                            // si tu veux soumettre normalement sans ajax, supprime cette partie
                            // pour fetch, tu peux garder et gérer les erreurs
                        });
                    });
            
            </script>



        
</body>
    </html>
</x-app-layout>

