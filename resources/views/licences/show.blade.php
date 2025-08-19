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
                    <h2 class="mb-4 text-2xl font-bold">{{ $licence->cle_licence  }}</h2>
                    <p class="mb-2 text-gray-700"><strong>Type :</strong> {{  $licence->type}}</p>
                    <p class="mb-2 text-gray-700"><strong>Date d'Expiration :</strong> {{$licence->date_expiration }}</p>
                    <p class="text-gray-700"><strong>Nombre d'Utilisateurs :</strong> {{ $licence->nombre_utilisateurs}}</p>
                    <p class="text-gray-700"><strong>État :</strong> {{ ucfirst($licence->etat) }}</p>
                    <p class="text-gray-700"><strong>Logiciels associés :</strong>  @if($licence->logiciels && $licence->logiciels->isNotEmpty())
                        {{ $licence->logiciels->pluck('nom')->join(', ') }}
                    @else
                        Non défini
                    @endif</p>

                    <div class="mt-6">
                        <a href="{{ route('licences.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Retour</a>
                    </div>
                </div>
            </div>
        </main>

    </div>

</x-app-layout>
