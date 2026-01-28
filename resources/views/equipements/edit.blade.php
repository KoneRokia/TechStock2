<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >

            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h1 class="mb-4 text-3xl font-semibold">Modifier équipement</h1>

                <!-- Formulaire d'ajout -->
                <div class="p-4 rounded-lg" style="background-color:#f6f6fa">


                    <form action="{{ route('equipements.update', $equipement->id) }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded shadow-md">
                        @csrf
                        @method('PUT')

                        <div class="flex gap-4 mb-4">

                        <!-- Nom -->
                        <div class="w-1/2 form-group">
                            <label for="nom" class="block text-2xl font-medium text-black">Nom</label>
                            <input type="text" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" id="nom" name="nom" value="{{ old('nom', $equipement->nom) }}"  required>
                        </div> <br>

                        <!-- Type -->
                        <div class="w-1/2 form-group">
                            <label for="type" class="block text-2xl font-medium text-black">Type</label>
                            <select id="type" name="type" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                                <option value="">-- Sélectionner un type --</option>
                                <option value="Ordinateur" {{ old('type', $equipement->type) == 'Ordinateur' ? 'selected' : '' }}>Ordinateur</option>
                                <option value="Imprimante" {{ old('type', $equipement->type) == 'Imprimante' ? 'selected' : '' }}>Imprimante</option>
                                <option value="Routeur" {{ old('type', $equipement->type) == 'Routeur' ? 'selected' : '' }}>Routeur</option>
                                <option value="Switch" {{ old('type', $equipement->type) == 'Switch' ? 'selected' : '' }}>Switch</option>
                                <option value="Serveur" {{ old('type', $equipement->type) == 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                 <option value="Routeur" {{ old('type', $equipement->type) == 'Écran' ? 'selected' : '' }}>Écran/option>
                                <option value="Switch" {{ old('type', $equipement->type) == 'Téléphone<' ? 'selected' : '' }}>Téléphone<</option>
                                <option value="Serveur" {{ old('type', $equipement->type) == 'Télévision ? 'selected' : '' }}>Télévision</option>
                                <option value="Serveur" {{ old('type', $equipement->type) == 'Rallong ? 'selected' : '' }}>Rallong</option>
                                <option value="Serveur" {{ old('type', $equipement->type) == 'Adaptateur ? 'selected' : '' }}>Adaptateur</option>
                                <option value="Autre" {{ old('type', $equipement->type) == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>

                    </div>
                    

                        <!-- Coût -->
                        <div class="mb-4">
                            <label for="cout" class="block text-2xl font-medium text-black">Coût</label>
                            <input type="text" name="cout" id="cout" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div> <br>

                        <!-- État -->
                        <div class="mb-4">
                            <label for="etat" class="block text-2xl font-medium text-black">État</label>

                            <select
                                name="etat"
                                id="etat"
                                class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            >
                                <option value="">-- Sélectionner l’état --</option>

                                <option value="actif"
                                    {{ old('etat', $equipement->etat) === 'actif' ? 'selected' : '' }}>
                                    Actif
                                </option>

                                <option value="en panne"
                                    {{ old('etat', $equipement->etat) === 'en panne' ? 'selected' : '' }}>
                                    En panne
                                </option>

                                <option value="hors service"
                                    {{ old('etat', $equipement->etat) === 'hors service' ? 'selected' : '' }}>
                                    Hors service
                                </option>
                            </select>
                        </div>


                        <!-- Date d'achat -->
                        <div class="form-group">
                            <label for="date_achat" class="block text-2xl font-medium text-black">Date d'achat</label>
                            <input type="date"  id="date_achat" name="date_achat" value="{{ old('date_achat', $equipement->date_achat) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                        </div> <br>

                        <div class="flex gap-4 mb-4">
                        <!-- Numéro de série -->
                        <div class="w-1/2 form-group">
                            <label for="numero_serie" class="block text-2xl font-medium text-black">Numéro de série</label>
                            <input type="text"  id="numero_serie" name="numero_serie" value="{{ old('numero_serie', $equipement->numero_serie) }} " class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                        </div> <br>



                        <!-- Marque -->
                        <div class="w-1/2 form-group">
                            <label for="marque" class="block text-2xl font-medium text-black">Marque</label>
                            <input type="text"  id="marque" name="marque" value="{{ old('marque', $equipement->marque) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                        </div> <br>
                    </div>

                        <div class="form-group">
                            <label for="code_barre" class="block text-2xl font-medium text-black">Code Barre</label>
                            <input type="text" name="code_barre" id="code_barre" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>




                        <!-- Caractéristiques -->
                        <div class="form-group" >
                            <label for="caracteristique" class="block text-2xl font-medium text-black">Caractéristiques</label>
                            <textarea  id="caracteristique" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" name="caracteristique" rows="4">{{ old('caracteristique', $equipement->caracteristique) }}</textarea>
                        </div> <br>

                        <!-- Photo d'équipement -->
                        <div class="form-group">
                            <label for="photo_equip" class="block text-2xl font-medium text-black">Photo de l'équipement</label>
                             <input type="file" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" id="photo_equip" name="photo_equip">
                        </div> <br>

                        <button type="submit" class="p-2 text-black transition duration-300 bg-white rounded-md w-80px hover:bg-blue-700">
                            Mettre à jour</button>
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
