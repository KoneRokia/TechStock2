
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
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h1 class="mb-4 text-3xl font-semibold">Ajouter un nouvel employé</h1> <br>

                <div class="p-4 rounded-lg" style="background-color:#f5f5f8">

                <!-- Formulaire de création d'employé -->
                <form action="{{ route('employes.store') }}" method="POST"  class="p-6 bg-white rounded shadow-md">
                    @csrf

                    <div class="form-group">
                        <label for="nom"  class="block text-2xl font-medium text-black">Nom :</label>
                        <input type="text" name="nom" id="nom" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('nom') }}  ">
                    </div>

                    <div class="form-group">
                        <label for="prenom"  class="block text-2xl font-medium text-black">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  value="{{ old('prenom') }}">
                    </div>
                    <div class="form-group"  class="block text-2xl font-medium text-black">
                        <label for="telephone"  class="block text-2xl font-medium text-black">Téléphone :</label>
                        <input type="text" name="telephone" id="telephone" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('telephone') }}">
                    </div>

                    <div class="form-group">
                        <label for="email"  class="block text-2xl font-medium text-black">Email :</label>
                        <input type="text" name="email" id="email" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('email') }}">
                    </div>


                    <div class="form-group" >
                        <label for="poste"  class="block text-2xl font-medium text-black">Poste :</label>
                        <input type="text" name="poste" id="poste" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('poste') }}">
                    </div>

                    <div class="form-group">
                        <label for="date_embauche"  class="block text-2xl font-medium text-black">Date d'embauche :</label>
                        <input type="date" name="date_embauche" id="date_embauche" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('date_embauche') }}">
                    </div>

                    {{-- <div class="form-group">
                        <label for="user_id"  class="block text-2xl font-medium text-black">Utilisateur :</label>
                        <select name="user_id" id="user_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="equipement_id"  class="block text-2xl font-medium text-black">Équipements :</label>
                        <select name="equipement_id[]" id="equipement_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" multiple>
                            @foreach($equipements as $equipement)
                                <option value="{{ $equipement->id }}">{{ $equipement->nom }} ({{ $equipement->numero_serie }})</option>
                            @endforeach
                        </select>
                    </div> <br>

                    <button type="submit" class="px-4 py-2 text-2xl text-black transition duration-300 bg-white rounded-md w-80px hover:bg-blue-700">Créer l'employé</button>
                </form>
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
            </div>
        </main>
    </div>

</x-app-layout>
