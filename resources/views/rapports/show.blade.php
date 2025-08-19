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
                    <h2 class="mb-4 text-2xl font-bold">{{ $rapport->titre }}</h2>
                    <p class="mb-2 text-gray-700"><strong>Type :</strong> {{  $rapport->type}}</p>
                    <p class="mb-2 text-gray-700"><strong>Description :</strong> {{ $rapport->description }}</p>
                    <p class="text-gray-700"><strong>Date de génération :</strong> {{ $rapport->date_generation }}</p>

                    @if($rapport->fichier)
                        <div class="mt-4">
                            <p class="font-semibold">📂 Fichier du rapport :</p>
                            <a href="{{ asset('storage/' . $rapport->fichier) }}" target="_blank" class="text-blue-500 underline">
                                📄 Voir le fichier
                            </a>

                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('rapports.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Retour</a>
                    </div>
                </div>
            </div>
        </main>

    </div>

</x-app-layout>
