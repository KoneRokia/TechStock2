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
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h2 class="mb-4 text-2xl font-bold">Modifier le rapport</h2> <br>
                <form action="{{ route('rapports.update', $rapport->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
                    @csrf
                    @method('PUT')
                        <div>
                    <label for="titre" class="block text-2xl font-medium">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre', $rapport->titre) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" required>
                </div> <br>

                     <div>
                    <label for="description" class="block text-2xl font-medium">Description</label>
                    <textarea name="description" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" required>{{ old('description', $rapport->description) }}</textarea>
                    </div><br>

                    <div>
                    <label for="date_generation" class="block text-2xl font-medium">Date de génération</label>
                    <input type="date" name="date_generation" value="{{ old('date_generation', $rapport->date_generation) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" required>
                    </div><br>

                     <div>
                    <label for="equipement_id" class="block text-2xl font-medium">Équipement</label>
                    <select name="equipement_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" required>
                        @foreach($equipements as $equipement)
                            <option value="{{ $equipement->id }}" {{ $rapport->equipement_id == $equipement->id ? 'selected' : '' }}>
                                {{ $equipement->nom }}
                            </option>
                        @endforeach
                    </select>
                </div> <br>
                    <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500">Mettre à jour</button>
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
