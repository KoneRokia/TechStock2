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
                <h1 class="mb-4 text-3xl font-semibold">Modifier équipement</h1>

                <!-- Formulaire d'ajout -->
                <div class="p-4 rounded-lg" style="background-color:#f6f6fa">


                    <form action="{{ route('equipements.update', $equipement->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
                        @csrf
                        @method('PUT')

                        <div class="flex gap-4 mb-4">

                        <!-- Nom -->
                        <div class="form-group w-1/2">
                            <label for="nom" class="block text-2xl font-medium text-black">Nom</label>
                            <input type="text" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" id="nom" name="nom" value="{{ old('nom', $equipement->nom) }}"  required>
                        </div> <br>

                        <!-- Type -->
                        <div class="form-group w-1/2">
                            <label for="type" class="block text-2xl font-medium text-black">Type</label>
                            <input type="text"  id="type" name="type" value="{{ old('type', $equipement->type) }}"class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500   form-control" required>
                        </div> <br>

                    </div>

                        <!-- Coût -->
                        <div class="form-group">
                            <label for="cout" class="block text-2xl font-medium text-black">Coût</label>
                            <input type="number"  id="cout" name="cout" value="{{ old('cout', $equipement->cout) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500   form-control" required>
                        </div> <br>

                        <!-- État -->
                        <div class="form-group">
                            <label for="etat" class="block text-2xl font-medium text-black">État</label>
                            <input type="text"  id="etat" name="etat" value="{{ old('etat', $equipement->etat) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500   form-control" required>
                        </div> <br>

                        <!-- Date d'achat -->
                        <div class="form-group">
                            <label for="date_achat" class="block text-2xl font-medium text-black">Date d'achat</label>
                            <input type="date"  id="date_achat" name="date_achat" value="{{ old('date_achat', $equipement->date_achat) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500   form-control" required>
                        </div> <br>

                        <div class="flex gap-4 mb-4">

                        <!-- Numéro de série -->
                        <div class="form-group w-1/2">
                            <label for="numero_serie" class="block text-2xl font-medium text-black">Numéro de série</label>
                            <input type="text"  id="numero_serie" name="numero_serie" value="{{ old('numero_serie', $equipement->numero_serie) }} " class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500   form-control" required>
                        </div> <br>

                        <!-- Marque -->
                        <div class="form-group w-1/2">
                            <label for="marque" class="block text-2xl font-medium text-black">Marque</label>
                            <input type="text"  id="marque" name="marque" value="{{ old('marque', $equipement->marque) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500   form-control" required>
                        </div> <br>

                        </div>

                        <!-- Caractéristiques -->
                        <div class="form-group" >
                            <label for="caracteristique" class="block text-2xl font-medium text-black">Caractéristiques</label>
                            <textarea  id="caracteristique" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" name="caracteristique" rows="4">{{ old('caracteristique', $equipement->caracteristique) }}</textarea>
                        </div> <br>

                        <!-- Photo d'équipement -->
                        <div class="form-group">
                            <label for="photo_equip" class="block text-2xl font-medium text-black">Photo de l'équipement</label>
                             <input type="file" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" id="photo_equip" name="photo_equip">
                        </div> <br>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>


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
