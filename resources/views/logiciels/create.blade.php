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
        <main class="flex-1 p-10 bg-gray-100" >
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">

                    <div class="container">
                        <h1 class="text-2xl font-bold mb-4">Ajouter un Logiciel</h1>

                        <div class="p-4 rounded-lg" style="background-color:#f6f6fa">


                        <form action="{{ route('logiciels.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
                            @csrf
                            <label for="nom" class="block text-2xl font-medium text-black">Nom du Logiciel</label>
                            <input type="text" name="nom" required  class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                             <br>

                            <label for="version" class="block text-2xl font-medium text-black">Version</label>
                            <input type="text" name="version"  class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                            <br>

                            <label for="éditeur" class="block text-2xl font-medium text-black">Éditeur</label>
                            <input type="text" name="éditeur"  class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                            <br>

                            <label for="type" class="block text-2xl font-medium text-black">Type</label>
                            <select name="type"  class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                                <option value="abonnement">Abonnement</option>
                                <option value="perpétuel">Perpétuel</option>
                                <option value="mensue">Mensuel</option>
                                <option value="trimestrie">Trimestriel</option>
                                <option value="annuel">Annuel</option>
                            </select> <br>

                            <label for="date_achat" class="block text-2xl font-medium text-black">Date d'Achat</label>
                            <input type="date" name="date_achat" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                             <br>

                            <label for="licence_id" class="block text-2xl font-medium text-black">Licence associée</label>
                            <select name="licence_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                                <option value="">Aucune</option>
                                @foreach($licences as $licence)
                                    <option value="{{ $licence->id }}">{{ $licence->cle_licence }}</option>
                                @endforeach
                            </select> <br>

                            <div class="mb-4">
                                <label for="employe_ids" class="block text-2xl font-medium text-black">Attribuer à des employés :</label>
                                <select name="employe_ids[]" id="employe_ids" multiple class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" >
                                    @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}">{{ $employe->nom }} {{ $employe->prenom }}</option>
                                    @endforeach
                                </select>
                            </div> <br>


                            <button type="submit" class="p-2 text-black transition duration-300 bg-white rounded-md w-80px hover:bg-blue-700">Enregistrer</button>
                        </form>
                    </div>
                    </div>

            </div>
        </main>
    </div>
    </x-app-layout>
