<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



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
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">

            <h1 class="text-2xl font-bold mb-4">Ajouter une Licence</h1>

            <div class="p-4 rounded-lg" style="background-color:#f6f6fa">
            <form action="{{ route('licences.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
                @csrf

                <!-- Clé de Licence -->
                <div class="mb-4">
                    <label for="cle_licence" class="block font-semibold">Clé de Licence</label>
                    <input type="text" name="cle_licence" class="w-full p-2 border rounded" required>
                    @error('cle_licence')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                </div>

                <!-- Type de Licence -->
                <div class="mb-4">
                    <label for="type" class="block font-semibold">Type</label>
                    <select name="type" class="w-full p-2 border rounded" required>
                        <option value="abonnement">Abonnement</option>
                        <option value="perpétuel">Perpétuel</option>
                        <option value="annuel">Annuel</option>
                        <option value="trimestriel">Trimestriel</option>
                        <option value="mensuel">Mensuel</option>
                    </select>
                </div>

                <!-- Date d'expiration -->
                <div class="mb-4">
                    <label for="date_expiration" class="block font-semibold">Date d'Expiration</label>
                    <input type="date" name="date_expiration" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                </div>

                <div class="mb-4">
                    <label for="logiciel_ids" class="block text-gray-700">Sélectionner les logiciels :</label>
                    <select name="logiciel_ids[]" id="logiciel_ids" multiple class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                        @foreach($logiciels as $logiciel)
                            <option value="{{ $logiciel->id }}">{{ $logiciel->nom }} ({{ $logiciel->version }})</option>
                        @endforeach
                    </select>
                </div>



                <!-- Nombre d'utilisateurs -->
                <div class="mb-4">
                    <label for="nombre_utilisateurs" class="block font-semibold">Nombre d'Utilisateurs</label>
                    <input type="number" name="nombre_utilisateurs" class="w-full p-2 border rounded">
                </div>

                <!-- État de la licence -->
                <div class="mb-4">
                    <label for="etat" class="block font-semibold">État</label>
                    <select name="etat" class="w-full p-2 border rounded">
                        <option value="active">Active</option>
                        <option value="expirée">Expirée</option>
                        <option value="bientôt expirée">Bientôt expirée</option>
                    </select>
                </div>

                {{-- <!-- Fournisseur -->
                <div class="mb-4">
                    <label for="fournisseur" class="block font-semibold">Fournisseur</label>
                    <input type="text" name="fournisseur" class="w-full p-2 border rounded">
                </div> --}}

                <!-- Bouton Soumettre -->
                <button type="submit" class="bg-blue-600 text-white p-2 rounded">Enregistrer</button>
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
            </div>
        </main>
    </div>
    </x-app-layout>
