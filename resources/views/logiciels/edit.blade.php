<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex">
        <!-- Sidebar -->
         @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-100" >
            <div class="container w-1/2 max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md ">

            <div class="container">
                <h1 class="mb-4 text-3xl font-semibold">Modifier le logiciel : {{ $logiciel->nom }}</h1>

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

                <div class="p-4 rounded-lg" style="background-color:#f5f5f8">

                <!-- Formulaire de modification du logiciel -->
                <form action="{{ route('logiciels.update', $logiciel->id) }}" method="POST" class="p-6 bg-white rounded shadow-md">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nom" class="block font-semibold">Nom du logiciel</label>
                        <input type="text" name="nom" class="w-full p-2 border rounded" value="{{ old('nom', $logiciel->nom) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="version" class="block font-semibold">Version</label>
                        <input type="text" name="version" class="w-full p-2 border rounded" value="{{ old('version', $logiciel->version) }}">
                    </div>

                    <div class="mb-4">
                        <label for="date_achat" class="block font-semibold">Date d'achat</label>
                        <input type="date" name="date_achat" class="w-full p-2 border rounded" value="{{ old('date_achat', $logiciel->date_achat) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="date_expiration" class="block font-semibold">Date d'expiration</label>
                        <input type="date" name="date_expiration" class="w-full p-2 border rounded" value="{{ old('date_expiration', $logiciel->date_expiration) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="block font-semibold">Type</label>
                        <select name="type" class="w-full p-2 border rounded" required>
                            <option value="abonnement" {{ $logiciel->type == 'abonnement' ? 'selected' : '' }}>Abonnement</option>
                            <option value="perpétuel" {{ $logiciel->type == 'perpétuel' ? 'selected' : '' }}>Perpétuel</option>
                            <option value="annuel" {{ $logiciel->type == 'annuel' ? 'selected' : '' }}>Annuel</option>
                            <option value="trimestriel" {{ $logiciel->type == 'trimestriel' ? 'selected' : '' }}>Trimestriel</option>
                            <option value="mensuel" {{ $logiciel->type == 'mensuel' ? 'selected' : '' }}>Mensuel</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="éditeur" class="block font-semibold">Éditeur</label>
                        <input type="text" name="éditeur" class="w-full p-2 border rounded" value="{{ old('éditeur', $logiciel->éditeur) }}">
                    </div>

                    <!-- Sélection des employés associés -->
                    <div class="mb-4">
                        <label for="employes" class="block font-semibold">Employés associés</label>
                        <select name="employes[]" class="w-full p-2 border rounded" multiple>
                            @foreach($employes as $employe)
                                <option value="{{ $employe->id }}" {{ in_array($employe->id, old('employes', $logiciel->employes->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $employe->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sélection des licences associées -->
                    <div class="mb-4">
                        <label for="licences" class="block font-semibold">Licences associées</label>
                        <select name="licences[]" class="w-full p-2 border rounded" multiple>
                            @foreach($licences as $licence)
                                <option value="{{ $licence->id }}" {{ in_array($licence->id, old('licences', $logiciel->licences->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $licence->cle_licence }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="p-2 text-white bg-blue-500 rounded ">Mettre à jour le logiciel</button>
                    </div>
                </form>
                </div>
            </div>
        </main>
    </div>

</x-app-layout>
