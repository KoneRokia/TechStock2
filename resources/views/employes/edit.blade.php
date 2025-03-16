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
                 </a>
                 <a href="{{ route('users.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                    <span>👥</span> <span>Liste des utilisateurs</span>
                </a>
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

            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h1 class="mb-4 text-3xl font-semibold">Modifier l'employé: {{ $employe->nom }}</h1>

                <div class="p-4 rounded-lg" style="background-color:#f6f6fa">

                <form action="{{ route('employes.update', $employe->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nom" class="block text-2xl font-medium text-black">Nom</label>
                        <input type="text" class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  id="nom" name="nom" value="{{ old('nom', $employe->nom) }}" required>
                    </div> <br>

                    <div class="form-group">
                        <label for="prenom" class="block text-2xl font-medium text-black">Prénom</label>
                        <input type="text" class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  id="prenom" name="prenom" value="{{ old('prenom', $employe->prenom) }}" required>
                    </div> <br>

                    <div class="form-group">
                        <label for="email" class="block text-2xl font-medium text-black">Email</label>
                        <input type="email" class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  id="email" name="email" value="{{ old('email', $employe->email) }}" required>
                    </div> <br>

                    <div class="form-group">
                        <label for="telephone" class="block text-2xl font-medium text-black">Téléphone</label>
                        <input type="text" class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  id="telephone" name="telephone" value="{{ old('telephone', $employe->telephone) }}">
                    </div> <br>

                    <div class="form-group">
                        <label for="poste" class="block text-2xl font-medium text-black">Poste</label>
                        <input type="text" class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  id="poste" name="poste" value="{{ old('poste', $employe->poste) }}">
                    </div> <br>

                    <div class="form-group">
                        <label for="date_embauche" class="block text-2xl font-medium text-black">Date d'embauche</label>
                        <input type="date" class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control"  id="date_embauche" name="date_embauche" value="{{ old('date_embauche', $employe->date_embauche) }}" required>
                    </div> <br>

                    <button type="submit" class="px-4 py-2  text-black transition duration-300 bg-white rounded-md w-80px hover:bg-blue-700 text-2xl">Mettre à jour</button>
                </form>
            </div>
            </div>
            </div>

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

