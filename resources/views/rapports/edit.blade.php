<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">
                <h2 class="mb-4 text-2xl font-bold">Modifier le rapport</h2> <br>
                <div class="p-4 rounded-lg" style="background-color:#f5f5f8">

                <form action="{{ route('rapports.update', $rapport->id) }}" method="POST" class="p-6 bg-white rounded shadow-md">
                    @csrf
                    @method('PUT')
                        <div>
                    <label for="titre" class="block text-2xl font-medium">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre', $rapport->titre) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                </div> <br>

                     <div>
                    <label for="description" class="block text-2xl font-medium">Description</label>
                    <textarea name="description" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>{{ old('description', $rapport->description) }}</textarea>
                    </div><br>

                    <div>
                    <label for="date_generation" class="block text-2xl font-medium">Date de génération</label>
                    <input type="date" name="date_generation" value="{{ old('date_generation', $rapport->date_generation) }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                    </div><br>

                     <div>
                    <label for="equipement_id" class="block text-2xl font-medium">Équipement</label>
                    <select name="equipement_id" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                        @foreach($equipements as $equipement)
                            <option value="{{ $equipement->id }}" {{ $rapport->equipement_id == $equipement->id ? 'selected' : '' }}>
                                {{ $equipement->nom }}
                            </option>
                        @endforeach
                    </select>
                </div> <br>
                    <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500">Mettre à jour</button>
                </form>
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
