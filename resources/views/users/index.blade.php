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
             </a>
             <a href="{{ route('users.index') }}" class="flex items-center p-2 space-x-2 text-2xl rounded hover:bg-blue-600">
                <span>👥</span> <span>Liste des utilisateurs</span>
            </a>
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
        <div class="container p-6 mx-auto">
            <h2 class="mb-4 text-2xl font-bold">Liste des Utilisateurs</h2>

            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border border-collapse border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Nom</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Statut</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border">
                            <td class="p-2 border">{{ $user->name }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">
                                @if($user->statut === 'actif')
                                    <span class="text-green-600">Actif</span>
                                @else
                                    <span class="text-red-600">Désactivé</span>
                                @endif
                                <td class="p-2 border">
                                    @if ($user->statut === 'actif')
                                        <form action="{{ route('profile.deactivate', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded">Désactiver</button>
                                        </form>
                                    @else
                                        @if(auth()->user()->role === 'admin')
                                            <form action="{{ route('profile.activate', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="px-3 py-1 text-white bg-blue-500 rounded">Activer</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
</x-app-layout>

