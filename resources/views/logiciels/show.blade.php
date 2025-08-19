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
                    <h2 class="mb-4 text-2xl font-bold">{{ $logiciel->nom }}</h2>
                    <p class="mb-2 text-gray-700"><strong>Version :</strong> {{ $logiciel->version}}</p>
                    <p class="mb-2 text-gray-700"><strong>Éditeur :</strong> {{ $logiciel->editeur }}</p>
                    <p class="text-gray-700"><strong>Type :</strong> {{ $logiciel->type }}</p>
                    <p class="text-gray-700"><strong>Date d'Achat :</strong> {{ $logiciel->date_achat }}</p>
                    <p class="text-gray-700"><strong>Licence associée :</strong>
                        @if($logiciel->licences->isNotEmpty())
                        {{ $logiciel->licences->pluck('cle_licence')->join(', ') }}
                    @else
                        Aucune licence
                    @endif</p>

                    <p class="text-gray-700"><strong>Attribuer à des employés :</strong> @if($logiciel->employes->isNotEmpty())
                                {{ $logiciel->employes->pluck('nom')->join(', ') }}
                            @else
                                Aucun employé assigné
                            @endif
                        </p>

                    <div class="mt-6">

                        <a href="{{ route('logiciels.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Retour</a>
                    </div>
                </div>
            </div>
        </main>

    </div>

</x-app-layout>
