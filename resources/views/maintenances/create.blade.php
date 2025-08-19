<x-app-layout>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



<div class="flex">
    <!-- Sidebar -->
     @include('layouts.sidebar')
    <!-- Main Content -->
    <main class="flex-1 p-10 bg-gray-100">
        <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
            <h2 class="mb-4 text-3xl font-bold">Ajouter une maintenance</h2> <br>
            <div class="p-4 rounded-lg" style="background-color:#f5f5f8">

            <form action="{{ route('maintenances.store') }}" method="POST"  class="p-6 bg-white rounded shadow-md">
                @csrf
                <label class="block text-2xl font-medium" >Date :</label>
                <input type="date" name="date" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required> <br><br>

                <div class="mb-3">
                    <label for="type" class="form-label">Type de maintenance</label>
                    <select name="type" id="type" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Sélectionner un type --</option>
                        <option value="Préventive">Préventive</option>
                        <option value="Curative">Curative</option>
                        <option value="Corrective">Corrective</option>
                        <option value="Évolutive">Évolutive</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="cout" class="block text-2xl font-medium text-black">Coût</label>
                    <input type="text" name="cout" id="cout" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <label class="block text-2xl font-medium">État :</label>
                <select name="etat"class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                    <option value="terminé">En attente</option>
                    <option value="terminé">Annulé</option>
                    <option value="terminé">Reporté</option>

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
    </main>
</div>
</x-app-layout>
