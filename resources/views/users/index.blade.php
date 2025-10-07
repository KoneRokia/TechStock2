<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-[#F3F3F3]">
        <div class="container p-6 mx-auto">

                @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.create') }}" class="p-2 mb-4 text-white bg-[#3A5DA8] rounded-lg">➕ Ajouter un utilisateur</a>
    @endif <br><br>

         <h2 class="mb-4 text-xl font-bold text-[#1FB19E]">Liste des Utilisateurs</h2>
     
            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">
                <thead>
                    <tr class= "text-[#585858] bg-[#D9D9D9]">
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nom</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Email</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Statut</th>
                        <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">
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

