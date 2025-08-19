<x-app-layout>


    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord - TechStock</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    </head>

    <body class="bg-gray-100">

        <div class="flex">
            <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-100">
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">

                <h1 class="text-2xl font-bold mb-4">Affecter des équipements à {{ $employe->nom }} {{ $employe->prenom }}</h1> <br>

                <div class="container">
                    {{-- <h2 class="text-xl font-bold mb-4">Affecter un équipement à {{ $employe->nom }}</h2> --}}

                    <form action="{{ route('employes.affecter-equipements', $employe->id) }}" method="POST">
                        @csrf

                        <label for="equipements" class="w-8 text-xl">Sélectionnez les équipements :</label>
                        <select name="equipements[]" multiple class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500  form-control" multiple>
                            @foreach($equipements as $equipement)
                                <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="mt-3 px-4 py-2 bg-green-500 text-black rounded">
                            ✅ Valider l'affectation
                        </button>
                    </form>
                </div>
                                <!-- Affichage des erreurs de validation -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </main>
    </div>

</body>
    </html>
</x-app-layout>

































