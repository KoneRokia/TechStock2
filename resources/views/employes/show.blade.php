<div>
  <h3 class="text-xl font-semibold mb-2">{{ $employe->nom }} {{ $employe->prenom }}</h3>
  <p><strong>Téléphone :</strong> {{ $employe->telephone }}</p>
  <p><strong>Email :</strong> {{ $employe->email }}</p>
  <p><strong>Date d'embauche :</strong> {{ $employe->date_embauche }}</p>
  <p><strong>Équipements :</strong></p>
  <ul class="list-disc list-inside">
      @foreach($employe->equipements as $equipement)
          <li>{{ $equipement->nom }}</li>
      @endforeach
  </ul>
</div>
