<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen p-6 text-white bg-blue-900 shadow-lg" style="margin-top:-1px">
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 text-xl hover:bg-blue-600" >
                    <span>🏠</span> <span>Tableau de bord</span>
                </a><br>
                <a href="{{ route('equipements.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🛠️</span> <span>Équipements</span>
                </a><br>
                <a href="{{ route('maintenances.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>⚙️</span> <span>Maintenances</span>
                </a><br>
                {{-- <a href="{{ route('statistiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📊</span> <span>Gestion des statistiques</span>
                </a> --}}
                <a href="{{ route('historiques.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>📜</span> <span>Historique</span>
                </a><br>

                <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>📑</span> <span>Rapports</span>
                 </a><br>
                 <a href="{{ route('users.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Utilisateurs</span>
                </a>
                <a href="{{ route('employes.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🧑</span> <span>Employés</span>
                </a><br>
                <a href="{{ route('logiciels.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🖥️</span> <span>Logiciels</span>
                </a><br>

                <a href="{{ route('licences.index') }}" class="flex items-center p-2 space-x-2 text-xl rounded hover:bg-blue-600">
                    <span>🔑</span> <span>Licences</span>
                </a><br>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >
            <!-- Ajouter un équipement Section -->
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h1 class="mb-4 text-3xl font-semibold">Modifier la maintenance</h1>

                <!-- Formulaire d'ajout -->
                <div class="p-4 rounded-lg" style="background-color:#e7e7f8">


                    <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST" class="p-6 bg-white rounded shadow-md">
                        @csrf
                        @method('PUT')


                        <!-- Date de la maintenance -->
                        <label for="date">Date</label>
                        <input type="date" name="date" value="{{ old('date', $maintenance->date) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                                <label for="type">Type de maintenance</label>
                                <select name="type" id="type" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">-- Sélectionner un type --</option>
                                    <option value="Préventive" {{ old('type', $maintenance->type) == 'Préventive' ? 'selected' : '' }}>Préventive</option>
                                    <option value="Curative" {{ old('type', $maintenance->type) == 'Curative' ? 'selected' : '' }}>Curative</option>
                                    <option value="Corrective" {{ old('type', $maintenance->type) == 'Corrective' ? 'selected' : '' }}>Corrective</option>
                                    <option value="Évolutive" {{ old('type', $maintenance->type) == 'Évolutive' ? 'selected' : '' }}>Évolutive</option>
                                </select>

                        <!-- Coût de la maintenance -->
                        <div class="mb-4">
                            <label for="cout" class="block text-2xl font-medium text-black">Coût</label>
                            <input type="text" name="cout" id="cout" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <!-- État de la maintenance -->
                        <label class="block text-2xl font-medium">État de la maintenance :</label>
                        <select name="etat" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-- Sélectionner un état --</option>
                            <option value="en cours" {{ old('etat', $maintenance->etat) == 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminé" {{ old('etat', $maintenance->etat) == 'terminé' ? 'selected' : '' }}>Terminé</option>
                            <option value="en attente" {{ old('etat', $maintenance->etat) == 'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="annulé" {{ old('etat', $maintenance->etat) == 'annulé' ? 'selected' : '' }}>Annulé</option>
                            <option value="reporté" {{ old('etat', $maintenance->etat) == 'reporté' ? 'selected' : '' }}>Reporté</option>
                        </select>
                        <br><br>


                        <!-- Utilisateur assigné -->
                        <label for="user_id">Technicien</label>
                        <select name="user_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $maintenance->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Équipement concerné -->
                        <label for="equipement_id">Équipement</label>
                        <select name="equipement_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            @foreach($equipements as $equipement)
                                <option value="{{ $equipement->id }}" {{ old('equipement_id', $maintenance->equipement_id) == $equipement->id ? 'selected' : '' }}>
                                    {{ $equipement->nom }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500">Modifier</button>
                    </form>

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
