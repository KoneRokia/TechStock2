<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="container mx-auto">

                <div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-2xl font-bold">{{ $equipement->nom }}</h2>
                    <p class="mb-2 text-gray-700"><strong>Type :</strong> {{  $equipement->type}}</p>
                    <p class="mb-2 text-gray-700"><strong>Coût :</strong> {{$equipement->cout }}</p>
                    <p class="mb-2 text-gray-700"><strong>État :</strong> {{ $equipement->etat }}</p>
                    <p class="mb-2 text-gray-700"><strong>Date d'achat :</strong> {{ $equipement->date_achat }}</p>
                    <p class="mb-2 text-gray-700"><strong>Numéro de série :</strong> {{ $equipement->numero_serie }}</p>
                    <p class="mb-2 text-gray-700"><strong>Marque :</strong> {{ $equipement->marque }}</p>
                    <p class="mb-2 text-gray-700"><strong>Code Barre :</strong> {{ $equipement->code_barre }}</p>
                    <p class="text-gray-700"><strong>Caractéristiques :</strong> {{ $equipement->caracteristique }}</p>
                    <td class="px-4 py-2 border">
                        <img src="{{ asset('storage/' . $equipement->photo_equip) }}" alt="Image de l'équipement" class="object-cover w-16 h-16 rounded">
                    </td>

                        <!-- <div class="mt-6">
                            <a href="{{ route('equipements.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Retour</a>
                        </div> -->
                </div>
            </div>
        </main>

    </div>

</x-app-layout>
