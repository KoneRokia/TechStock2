
<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="fflex-1 p-10 bg-[#F3F3F3]">
            <div class="container mx-auto">
                <div class="container">
                    <h2 class="mb-4 text-xl font-semibold text-[#1FB19E]">Historique des équipements</h2>

                    <div class="overflow-y-auto max-h-[500px] border rounded-lg shadow-md">
                        <table  class="w-full border border-collapse table-auto rounded-lg bg-[#D9D9D9]" style="font-size:15px">

                            <thead class="sticky top-0 bg-[#67b09d] text-white">

                                <tr class="text-[#585858] bg-[#D9D9D9]">
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Équipement</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Numéro de série</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Ancien utilisateur</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Nouveau utilisateur</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Date de passation</th>
                                <th class="px-4 py-2 border rounded-lg border-[#D9D9D9]">Temps d'utilisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historiques as $historique)
                            <tr class="border-b odd:bg-[#F3F3F3] even:bg-[#EBEBEB] text-[#585858]">

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
