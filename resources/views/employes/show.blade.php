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
                    <h2 class="mb-4 text-2xl font-bold">{{ $employe->nom }}</h2>
                    <p class="mb-2 text-gray-700"><strong>Prénom :</strong> {{  $employe->prenom}}</p>
                    <p class="mb-2 text-gray-700"><strong>Téléphone  :</strong> {{ $employe->telephone }}</p>
                    <p class="text-gray-700"><strong>Email  :</strong> {{ $employe->email }}</p>
                    <p class="mb-2 text-gray-700"><strong>Date d'embauche :</strong> {{  $employe->date_embauche}}</p>
                    <p class="mb-2 text-gray-700"><strong>Équipements :</strong>
                        @foreach($employe->equipements as $equipement)
                        <span class="badge badge-primary">{{ $equipement->nom }}</span>
                    @endforeach</p>


                    <div class="mt-6">
                        <a href="{{ route('employes.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Retour</a>
                    </div>
                </div>
            </div>
        </main>

    </div>

</x-app-layout>
