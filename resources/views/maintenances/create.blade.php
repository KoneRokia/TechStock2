<x-app-layout>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



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
    <main class="flex-1 p-10 bg-gray-100">
        <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
            <h2 class="mb-4 text-3xl font-bold">Ajouter une maintenance</h2> <br>

            <form action="{{ route('maintenances.store') }}" method="POST"  class="bg-white p-6 rounded shadow-md">
                @csrf
                <label class="block text-2xl font-medium" >Date :</label>
                <input type="date" name="date" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required> <br><br>

                <label class="block text-2xl font-medium">Type :</label>
                <input type="text" name="type"  class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required> <br> <br>

                <label class="block text-2xl font-medium">Coût :</label>
                <input type="number" name="cout" step="0.01" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required> <br> <br>

                <label class="block text-2xl font-medium">État :</label>
                <select name="etat"class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                </select> <br> <br>

                <label class="block text-2xl font-medium">Technicien :</label>
                <select name="user_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>  <br> <br>

                <label class="block text-2xl font-medium">Équipement :</label>
                <select name="equipement_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @foreach($equipements as $equipement)
                        <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                    @endforeach
                </select> <br> <br>

                <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500">Enregistrer</button>
            </form>
        </div>
    </main>
</div>
</x-app-layout>
