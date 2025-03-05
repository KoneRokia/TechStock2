<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen p-6 text-white bg-blue-900 shadow-lg" style="margin-top:-1px">
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 text-2xl hover:bg-blue-600" >
                    <span>🏠</span> <span>Tableau de bord</span>
                </a>
                <a href="{{ route('equipements.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🛠️</span> <span>Gestion des équipements</span>
                </a>
                <a href="{{ route('maintenances.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>⚙️</span> <span>Gestion des maintenances</span>
                </a>
                {{-- <a href="{{ route('statistiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📊</span> <span>Gestion des statistiques</span>
                </a> --}}
                <a href="{{ route('historiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📜</span> <span>Gestion de l'historique</span>
                </a>

                <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>📑</span> <span>Gestion des rapports</span>
                {{-- </a>
                <a href="{{ route('utilisateurs.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Gestion des utilisateurs</span>
                </a> --}}
                <a href="{{ route('employes.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🧑‍💼</span> <span>Gestion des employés</span>
                </a>
                <a href="{{ route('logiciels.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🖥️</span> <span>Gestion des logiciels</span>
                </a>

                <a href="{{ route('licences.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>🔑</span> <span>Gestion des licences</span>
                </a>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >
            <!-- Ajouter un équipement Section -->
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h1 class="mb-4 text-3xl font-semibold">Modifier la maintenance</h1>

                <!-- Formulaire d'ajout -->
                <div class="p-4 rounded-lg" style="background-color:#babaf7">


                    <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <!-- Date de la maintenance -->
                        <label for="date">Date</label>
                        <input type="date" name="date" value="{{ old('date', $maintenance->date) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                        <!-- Type de maintenance -->
                        <label for="type">Type</label>
                        <input type="text" name="type" value="{{ old('type', $maintenance->type) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                        <!-- Coût de la maintenance -->
                        <label for="cout">Coût</label>
                        <input type="number" name="cout" value="{{ old('cout', $maintenance->cout) }}" min="0" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                        <!-- État de la maintenance -->
                        <label for="etat">État</label>
                        <select name="etat" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="en cours" {{ old('etat', $maintenance->etat) == 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminé" {{ old('etat', $maintenance->etat) == 'terminé' ? 'selected' : '' }}>Terminé</option>
                            <option value="annulé" {{ old('etat', $maintenance->etat) == 'annulé' ? 'selected' : '' }}>Annulé</option>
                        </select>

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

                        <button type="submit">Modifier</button>
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
