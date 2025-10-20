<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 bg-[#3A5DA8] -translate-y-1">
        <div class="bg-[#F3F3F3] h-[700px] rounded-bl-[50px] mt-[3px]">
        <div class="container p-8 mx-auto">

                @if(auth()->user()->role === 'admin')
                    <button id="btn-open-add-user" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">
                        Ajouter un utilisateur
                    </button>
                @endif

         <h2 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des Utilisateurs</h2>
     
            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif
           <div class="overflow-y-auto max-h-[500px] border rounded-lg">
            <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                <thead>
                    <tr class= "text-[#585858] bg-[#D9D9D9]">
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Nom</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Email</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="relative px-4 py-2 border border-[#D9D9D9] border-r-0 rounded-lg">
                            <span>Statut</span>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-2 rounded-full bg-[#989898] p-1 w-1 h-1"></div>
                        </th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
                            <td class="p-2 border">{{ $user->name }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">
                             @if($user->statut === 'actif')
                                 <span class="text-green-600">Actif</span>
                            @else
                                 <span class="text-red-600">Désactivé</span>
                             @endif
                        <td class="p-2 border">
                    @if ($user->statut === 'actif')
                        <form action="{{ route('users.deactivate', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded">
                                <img src="{{ asset('images/desatif.png') }}" alt="desativer" class="w-5 h-5 inline-block">
                            </button>
                        </form>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('users.activate', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1 text-white rounded bg-white">
                                   <img src="{{ asset('images/actif.png') }}" alt="activer" class="w-5 h-5 inline-block">
                                </button>
                            </form>
                        @endif
                    @endif
                    </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

           </div>
            
        </div>
                <!-- Modal Ajouter Utilisateur -->
            <div id="addUserModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50">
                <div class="flex justify-center items-center min-h-screen">
                    <div class="bg-white rounded-2xl p-6 w-full max-w-2xl relative overflow-y-auto max-h-[90vh]">
                        <h2 class="text-xl font-semibold text-[#1FB19E] mb-4 text-center">Ajouter un utilisateur</h2>

                        <!-- Affichage des erreurs -->
                        <div id="addUserErrors" class="mb-4 hidden p-3 bg-red-100 border border-red-300 text-red-700 rounded"></div>

                        <form action="{{ route('users.store') }}" method="POST" id="addUserForm">
                            @csrf

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="name" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Prénom</label>
                                <input type="text" name="prenom" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                                <input type="password" name="password" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Confirmation du mot de passe</label>
                                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded p-2" required>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Rôle</label>
                                <select name="role" class="w-full border border-gray-300 rounded p-2" required>
                                    <option value="utilisateur">Utilisateur</option>
                                    <option value="technicien">Technicien</option>
                                    <option value="editeur">Éditeur</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Statut</label>
                                <select name="statut" class="w-full border border-gray-300 rounded p-2" required>
                                    <option value="actif">Actif</option>
                                    <option value="desactif">Désactivé</option>
                                </select>
                            </div>

                            <div class="flex justify-between mt-6">
                                <button type="button" id="btn-close-add-user" class="bg-[#1FB19E] text-white px-4 py-2 rounded">Annuler</button>
                                <button type="submit" class="bg-[#3A5DA8]  text-white px-4 py-2 rounded">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
                <!-- Script Modal -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const modal = document.getElementById('addUserModal');
                        const openBtn = document.getElementById('btn-open-add-user');
                        const closeBtn = document.getElementById('btn-close-add-user');
                        const errorsDiv = document.getElementById('addUserErrors');

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
</div>
</x-app-layout>

