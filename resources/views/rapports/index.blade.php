<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class=" flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 md:p-10 bg-[#F3F3F3]">
            <div class="container mx-auto px-2 sm:px-4">

<div class="container">
    
         @php
                $userRole = auth()->user()->role;
         @endphp

            <!-- Bouton Ajouter un rapport -->
            @if ($userRole === 'admin' || $userRole === 'editeur')
                <button
                    class="inline-block mb-4 px-4 py-2 text-white bg-[#3A5DA8] rounded-lg hover:bg-[#2e4a85] transition"
                    onclick="openAddModal()">
                    Ajouter un rapport
                </button>
            @endif

    <h1 class="mb-4 text-xl sm:text-2xl font-bold text-[#1FB19E]">Liste des rapports</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="overflow-y-auto max-h-[500px] border rounded-lg">
        <table class="w-full  text-sm sm:text-base md:text-lg border border-collapse table-auto rounded-lg bg-[#D9D9D9] " style="font-size:15px">
            <thead class="sticky top-0 bg-[#67b09d] text-white">

            <tr class="text-[#585858] bg-[#D9D9D9]">
                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                    <span>Type</span>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                </th>
                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                    <span>Description</span>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                </th>
                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                    <span>Titre</span>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                </th>
                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                    <span>Date</span>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                </th>
                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                    <span>Nom</span>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                </th>
                <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                    <span>Équipement</span>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                </th>
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
                        <!-- Bouton Voir -->
                            <button 
                                onclick="openShowModal({{ $rapport->id }})" 
                                class="text-green-500">
                                <img src="{{ asset('images/Group 8.png') }}" alt="Voir" class="w-5 h-5 inline-block">
                            </button>

                         <!-- Bouton Modifier pour tous les utilisateurs -->
                       @if (auth()->user()->role === 'admin' || auth()->user()->role === 'editeur')
                            <button class="text-blue-500"
                                onclick="openEditModal(
                                    {{ $rapport->id }},
                                    '{{ $rapport->titre }}',
                                    '{{ $rapport->description }}',
                                    '{{ $rapport->date_generation }}',
                                    '{{ $rapport->equipement_id }}'
                                )">
                                <img src="{{ asset('images/Group 7.png') }}" alt="Modifier" class="w-5 h-5 inline-block">
                            </button>
                        @endif


                        <!-- Formulaire Supprimer avec restriction d'action -->
                        <form action="{{ route('rapports.destroy', $rapport) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?')" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <!-- Bouton Supprimer avec restriction d'action -->
                            <button type="submit"
                                    class=""
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
                {{ $rapports->links() }}
     </div>

            <!-- Modal Ajouter -->
            <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
                <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative flex">
                    <div class="bg-white w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                        <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeAddModal()">×</button>
                        <form action="{{ route('rapports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <h2 class="text-center text-[#1FB19E] mt-4 text-xl font-bold">Ajouter un rapport</h2>
                            <input type="text" name="titre" placeholder="Titre" class="w-full p-2 border rounded-md" required>
                            <textarea name="description" placeholder="Description" class="w-full p-2 border rounded-md" required></textarea>
                            <input type="text" name="type" placeholder="Type" class="w-full p-2 border rounded-md" required>
                            <input type="date" name="date_generation" value="{{ old('date_generation') }}" class="w-full p-2 border rounded-md" required>
                            <select name="equipement_id" class="w-full p-2 border rounded-md" required>
                                @foreach($equipements as $equipement)
                                    <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                                @endforeach
                            </select>
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 text-white bg-[#3A5DA8] rounded-lg">Enregistrer</button>
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

                    <h2 class="text-2xl font-bold text-[#1FB19E] mb-4">Détails du Raport</h2>

                    <div id="showModalContent" class="space-y-3 text-gray-700">
                    <!-- Les informations seront chargées ici -->
                    <p>Chargement...</p>
                    </div>

                    <div class="flex justify-end mt-6">
                    <button onclick="closeShowModal()" class="px-4 py-2 bg-[#1FB19E]  text-white rounded-lg hover:bg-[#1FB19E] ">Fermer</button>
                    </div>
                </div>

                </div>
                
            </div>



              <!-- Modal de modification -->
    
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
            <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative flex">
            <div class="bg-white w-full max-w-2xl p-6 relative overflow-y-auto max-h-[90vh]" style="border-radius: 1.6rem">
                <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-2xl" onclick="closeEditModal()">×</button>

                <form id="editForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <h2 class="text-center text-[#1FB19E] mt-4 text-xl font-bold">Modifier le rapport</h2>

                    <div>
                        <label class="block text-gray-700">Titre</label>
                        <input type="text" name="titre" id="edit_titre" class="w-full p-2 border rounded-md" required>
                    </div>

                    <div>
                        <label class="block text-gray-700">Description</label>
                        <textarea name="description" id="edit_description" class="w-full p-2 border rounded-md" required></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700">Date de génération</label>
                        <input type="date" name="date_generation" id="edit_date" class="w-full p-2 border rounded-md" required>
                    </div>

                    <div>
                        <label class="block text-gray-700">Équipement</label>
                        <select name="equipement_id" id="edit_equipement" class="w-full p-2 border rounded-md" required>
                            @foreach($equipements as $equipement)
                                <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 text-white bg-[#3A5DA8] rounded-lg">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        </main>

</div>
            <!-- Script d'ajout du rapport -->
                <script>
                    function openAddModal() {
                        const modal = document.getElementById('addModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }

                    function closeAddModal() {
                        const modal = document.getElementById('addModal');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                </script>

                 <!-- Script de pop pup de détaille Rapport -->
        <script>
            function openShowModal(id) {
                // Afficher le modal
                const modal = document.getElementById('showModal');
                modal.classList.remove('hidden');

                // Cibler le conteneur du contenu
                const content = document.getElementById('showModalContent');
                content.innerHTML = "<p class='text-center text-gray-500'>Chargement...</p>";

                // Requête AJAX pour récupérer les infos du rapport
                fetch(`/rapports/${id}`)
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


             <!-- Script de modification -->
            <script>
                function openEditModal(id, titre, description, date_generation, equipement_id) {
                    const modal = document.getElementById('editModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    document.getElementById('edit_titre').value = titre;
                    document.getElementById('edit_description').value = description;
                    document.getElementById('edit_date').value = date_generation;
                    document.getElementById('edit_equipement').value = equipement_id;

                    const form = document.getElementById('editForm');
                    form.action = `/rapports/${id}`;
                }

                function closeEditModal() {
                    const modal = document.getElementById('editModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>


</x-app-layout>































