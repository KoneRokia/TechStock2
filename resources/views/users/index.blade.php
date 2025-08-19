<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-gray-100">
        <div class="container p-6 mx-auto">
            <h2 class="mb-4 text-2xl font-bold">Liste des Utilisateurs</h2>

                @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded">➕ Ajouter un utilisateur</a>
    @endif <br><br>


            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border border-collapse border-gray-300">
                <thead>
                    <tr class= "bg-blue-900">
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
                        <form action="{{ route('users.deactivate', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded">Désactiver</button>
                        </form>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('users.activate', $user->id) }}" method="POST">
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

