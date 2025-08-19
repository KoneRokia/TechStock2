<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >

            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">

                    <h2 class="mb-4 text-3xl font-bold">Modifier la Licence</h2>

                    <div class="p-4 rounded-lg" style="background-color:#f6f6fa">
                    <form action="{{ route('licences.update', $licence->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="block text-2xl font-medium text-black">Clé de licence :</label>
                            <input type="text" name="cle_licence"  class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('cle_licence', $licence->cle_licence) }}" required>
                        </div> <br>

                        <div class="mb-4">
                            <label for="type" class="block text-2xl font-medium text-black">Type</label>
                            <select name="type"  class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                                <option value="abonnement" {{ old('type', $licence->type) == 'abonnement' ? 'selected' : '' }}>Abonnement</option>
                                <option value="perpétuel" {{ old('type', $licence->type) == 'perpétuel' ? 'selected' : '' }}>Perpétuel</option>
                                <option value="annuel" {{ old('type', $licence->type) == 'annuel' ? 'selected' : '' }}>Annuel</option>
                                <option value="trimestriel" {{ old('type', $licence->type) == 'trimestriel' ? 'selected' : '' }}>Trimestriel</option>
                                <option value="mensuel" {{ old('type', $licence->type) == 'mensuel' ? 'selected' : '' }}>Mensuel</option>
                            </select>
                        </div> <br>


                        <div class="form-group">
                            <label class="block text-2xl font-medium text-black">Nombre d'utilisateurs :</label>
                            <input type="number" name="nombre_utilisateurs"  class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('nombre_utilisateurs', $licence->nombre_utilisateurs) }}" required>
                        </div> <br>

                        <div class="form-group">
                            <label class="block text-2xl font-medium text-black">Date d'expiration :</label>
                            <input type="date" name="date_expiration"  class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" value="{{ old('date_expiration', $licence->date_expiration) }}" required>
                        </div> <br>

                        <div class="form-group">
                            <label class="block text-2xl font-medium text-black">État :</label>
                            <select name="etat"  class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control">
                                <option value="active" {{ old('etat', $licence->etat) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expirée" {{ old('etat', $licence->etat) == 'expirée' ? 'selected' : '' }}>Expirée</option>
                                <option value="bientôt expirée" {{ old('etat', $licence->etat) == 'bientôt expirée' ? 'selected' : '' }}>Bientôt expirée</option>
                            </select> <br>
                        </div> <br>

                        <div class="form-group">
                            <label for="logiciel_id" class="block text-2xl font-medium text-black">Logiciel :</label>
                            <select name="logiciel_id"   class=" w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-control" required>
                                @foreach($logiciels as $logiciel)
                                    <option value="{{ $logiciel->id }}" {{ old('logiciel_id', $licence->logiciels->first()->id ?? '') == $logiciel->id ? 'selected' : '' }}>
                                        {{ $logiciel->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div> <br>

                        <button type="submit" class="p-2 bg-blue-500 btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
                </div>
        </main>
    </div>

</x-app-layout>

