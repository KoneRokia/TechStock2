<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">

                <h1 class="text-2xl font-bold mb-4">Ajouter un utilisateur</h1>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST" class="p-6 bg-white rounded shadow-md">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Nom</label>
                        <input type="text" name="name" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Prénom</label>
                        <input type="text" name="prenom" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Mot de passe</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                    </div>

                 <div class="mb-4">
                    <label class="block mb-1">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                </div>

                    <div class="mb-4">
                        <label class="block mb-1">Rôle</label>
                        <select name="role" class="w-full border rounded p-2" required>
                            <option value="utilisateur">Utilisateur</option>
                            <option value="technicien">Technicien</option>
                            <option value="editeur">Éditeur</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Statut</label>
                        <select name="statut" class="w-full border rounded p-2" required>
                            <option value="actif">Actif</option>
                            <option value="desactif">Désactivé</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500 rounded">Enregistrer</button>
                </form>

            </div>
        </main>
    </div>
</x-app-layout>
