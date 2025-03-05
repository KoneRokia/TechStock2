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
                 <h1 class="mb-4 text-2xl font-bold">Ajouter un rapport</h1>

                <form action="{{ route('rapports.store') }}" method="POST" enctype="multipart/form-data"   class="bg-white p-6 rounded shadow-md">
                    @csrf
                     <div class="mb-4">
                        <label class="block text-sm font-bold">Titre</label>
                        <input type="text" name="titre" class="w-full p-2 border rounded" required>
                    </div>
                     <div class="mb-4">
                        <label class="block text-sm font-bold">Description</label>
                        <textarea name="description" class="w-full p-2 border rounded" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold">Type</label>
                        <input type="text" name="type" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="date_generation" class="block text-gray-700">Date de génération</label>
                        <input type="date" id="date_generation" name="date_generation" value="{{ old('date_generation') }}" required class="w-full p-2 border border-gray-300 rounded">
                    </div>

                       <label for="equipement_id">Équipement :</label>
                    <select name="equipement_id" id="equipement_id" required>
                        @foreach($equipements as $equipement)
                            <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                        @endforeach
                    </select> <br><br>

                     {{-- <div class="mb-4">
                        <label class="block text-sm font-bold">Fichier (optionnel)</label>
                        <input type="file" name="fichier" class="w-full p-2 border rounded">
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
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
