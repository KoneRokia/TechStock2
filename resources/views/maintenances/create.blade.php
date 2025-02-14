@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen p-6 text-white bg-blue-900 shadow-lg">
        <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 space-x-2 text-2xl hover:bg-blue-600">
                <span>🏠</span> <span>Tableau de bord</span>
            </a>
            <a href="{{ route('equipements.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                <span>🛠️</span> <span>Gestion des équipements</span>
            </a>
            <a href="{{ route('maintenances.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                <span>⚙️</span> <span>Gestion des maintenances</span>
            </a>
            <a href="{{ route('statistiques.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                <span>📊</span> <span>Gestion des statistiques</span>
            </a>
            <a href="{{ route('rapports.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                <span>📑</span> <span>Gestion des rapports</span>
            </a>
            <a href="{{ route('utilisateurs.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                <span>👥</span> <span>Gestion des utilisateurs</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Ajouter une maintenance</h2>

            <form action="{{ route('maintenances.store') }}" method="POST">
                @csrf
                <label>Date :</label>
                <input type="date" name="date" required class="border p-2">

                <label>Type :</label>
                <input type="text" name="type" required class="border p-2">

                <label>Coût :</label>
                <input type="number" name="cout" step="0.01" required class="border p-2">

                <label>État :</label>
                <select name="etat" required>
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                    <option value="annulé">Annulé</option>
                </select>

                <label>Technicien :</label>
                <select name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                <label>Équipement :</label>
                <select name="equipement_id" required>
                    @foreach($equipements as $equipement)
                        <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-2">Enregistrer</button>
            </form>
        </div>
    </main>
</div>
@endsection
