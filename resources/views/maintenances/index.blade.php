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
            <h1 class="mb-4 text-2xl font-semibold">Liste des équipements</h1>
            <a href="{{ route('equipements.create') }}" class="p-2 mb-4 text-white bg-blue-600 rounded">Ajouter un équipement</a>

            <table class="w-full overflow-hidden bg-white rounded-lg shadow-md table-auto mt-4">
                <thead>
                    <tr class="text-white bg-blue-900">
                        <th class="px-4 py-2 border">Nom</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Date d'achat</th>
                        <th class="px-4 py-2 border">Caractéristiques</th>
                        <th class="px-4 py-2 border">Coût</th>
                        <th class="px-4 py-2 border">Photo</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipements as $equipement)
                        <tr class="border-b hover:bg-gray-200">
                            <td class="px-4 py-2 border">{{ $equipement->nom }}</td>
                            <td class="px-4 py-2 border">{{ $equipement->type }}</td>
                            <td class="px-4 py-2 border">{{ $equipement->date_achat }}</td>
                            <td class="px-4 py-2 border">{{ $equipement->caracteristique }}</td>
                            <td class="px-4 py-2 border">{{ $equipement->cout }}</td>
                            <td class="px-4 py-2 border">
                                <img src="{{ asset('photos_equipements/' . $equipement->photo_equip) }}" alt="Image de l'équipement" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-4 py-2 border flex space-x-2">
                                <a href="{{ route('equipements.edit', $equipement->id) }}" class="p-2 text-white bg-yellow-500 rounded">Modifier</a>
                                <form action="{{ route('equipements.destroy', $equipement->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-white bg-red-500 rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
