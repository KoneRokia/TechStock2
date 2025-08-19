 <x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                 <h1 class="mb-4 text-2xl font-bold">Ajouter un rapport</h1>

                 <div class="p-4 rounded-lg" style="background-color:#f5f5f8">

                <form action="{{ route('rapports.store') }}" method="POST" enctype="multipart/form-data"   class="p-6 bg-white rounded shadow-md">
                    @csrf
                     <div class="mb-4">
                        <label class="block text-sm font-bold">Titre</label>
                        <input type="text" name="titre" class="w-full p-2 border rounded" required>
                    </div>
                     <div class="mb-4">
                        <label class="block text-sm font-bold">Description</label>
                        <textarea name="description" class="w-full p-2 border rounded" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold">Type</label>
                        <input type="text" name="type" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="date_generation" class="block text-gray-700">Date de génération</label>
                        <input type="date" id="date_generation" name="date_generation" value="{{ old('date_generation') }}" required class="w-full p-2 border border-gray-300 rounded">
                    </div>

                       <label for="equipement_id">Équipement :</label>
                    <select name="equipement_id" id="equipement_id" required>
                        @foreach($equipements as $equipement)
                            <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                        @endforeach
                    </select> <br><br>

                     {{-- <div class="mb-4">
                        <label class="block text-sm font-bold">Fichier (optionnel)</label>
                        <input type="file" name="fichier" class="w-full p-2 border rounded">
                    </div> --}}

                    <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500 btn btn-primary">Enregistrer</button>
                </form>
                </div>
            </div>

                        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </main>
    </div>

</x-app-layout>
