<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >
            <!-- Ajouter un équipement Section -->
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h1 class="mb-4 text-3xl font-semibold">Ajouter un nouvel équipement</h1>

                <!-- Formulaire d'ajout -->
                <div class="p-4 rounded-lg" style="background-color:#f5f5f8">


                <form action="{{ route('equipements.store') }}" method="POST" enctype="multipart/form-data"  class="bg-white p-6 rounded shadow-md" >
                    @csrf

                    <div class="mb-4" >
                        <label for="nom" class="block text-2xl font-medium text-black">Nom de l'équipement</label>
                        <input type="text" name="nom" id="nom" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    {{-- <div class="mb-4">
                        <label for="nom_utilisateur" class="block text-2xl font-medium text-black">Utilisateur affecté</label>
                        <input type="text" name="nom_utilisateur" id="nom_utilisateur" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div> --}}


                    <div class="form-group">
                        <label for="type" class="block text-2xl font-medium text-black">Type d'équipement</label>
                        <select name="type" id="type" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-- Sélectionner un type --</option>
                            <option value="Ordinateur">Ordinateur</option>
                            <option value="Imprimante">Imprimante</option>
                            <option value="Serveur">Serveur</option>
                            <option value="Switch">Switch</option>
                            <option value="Routeur">Routeur</option>
                            <option value="Ecran">Ecran</option>
                            <option value="Souris">Souris</option>
                            <option value="Telephone">Téléphone</option>
                            <option value="Television">Télévision</option>
                            <option value="Rallonge">Rallonge</option>
                            <option value="Adaptateur">Adaptateur</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>  <br>

                    <div class="mb-4">
                        <label for="cout" class="block text-2xl font-medium text-black">Coût</label>
                        <input type="text" name="cout" id="cout" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="etat" class="block text-2xl font-medium text-black">État</label>
                        <select name="etat" id="etat" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="actif">Actif</option>
                            <option value="en panne">En panne</option>
                            <option value="hors service">Hors service</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="date_achat" class="block text-2xl font-medium text-black" >Date d'achat</label>
                        <input type="date" name="date_achat" id="date_achat" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-3">
                        <label for="code_barre" class="block text-2xl font-medium text-black">Code Barre</label>
                        <input type="text" name="code_barre" id="code_barre" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>


                    <div class="mb-4">
                        <label for="numero_serie" class="block text-2xl font-medium text-black">Numéro de série</label>
                        <input type="text" name="numero_serie" id="numero_serie" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="marque" class="block text-2xl font-medium text-black">Marque</label>
                        <input type="text" name="marque" id="marque" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="caracteristique" class="block text-2xl font-medium text-black">Caractéristiques</label>
                        <textarea name="caracteristique" id="caracteristique" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="photo_equip" class="block text-2xl font-medium text-black">Photo </label>
                        <input type="file" name="photo_equip" id="photo_equip" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="p-2 text-black transition duration-300 bg-white rounded-md w-80px hover:bg-blue-700">
                        Ajouter l'équipement
                    </button>
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
