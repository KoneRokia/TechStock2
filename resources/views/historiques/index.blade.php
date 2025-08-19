
<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">
                <div class="container">
                    <h2 class="mb-4 text-2xl font-semibold">Historique des équipements</h2><br><br>

                    <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">
                        <table  class="w-full border border-collapse border-gray-300 table-auto" style="font-size:15px">

                            <thead class="sticky top-0 bg-[#67b09d] text-white">

                                <tr class="text-white bg-blue-900">
                                <th class="px-4 py-2 border">Équipement</th>
                                <th class="px-4 py-2 border">Numéro de série</th>
                                <th class="px-4 py-2 border">Ancien utilisateur</th>
                                <th class="px-4 py-2 border">Nouveau utilisateur</th>
                                <th class="px-4 py-2 border">Date de passation</th>
                                <th class="px-4 py-2 border">Temps d'utilisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historiques as $historique)
                            <tr class="border-b hover:bg-gray-200">

                                    <td class="px-4 py-2 border">{{ $historique->equipement->nom }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->equipement->numero_serie }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->ancienUtilisateur->nom ?? 'Aucun' }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->nouveauUtilisateur->nom ?? 'Aucun' }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->date_passation }}</td>
                                    <td class="px-4 py-2 border">{{ $historique->temps_utilisation ?? 'Non défini' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
        </main>

    </div>

</x-app-layout>
