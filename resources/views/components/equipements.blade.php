<div class="container">
    <h1 class="text-2xl mb-4">Liste des équipements</h1>

    <a href="{{ route('equipements.create') }}" class="bg-blue-600 text-white p-2 rounded mb-4">Ajouter un équipement</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Modèle</th>
                <th class="border px-4 py-2">Date d'achat</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{ $slot }} <!-- C'est ici que le contenu dynamique sera injecté -->
        </tbody>
    </table>
</div>
