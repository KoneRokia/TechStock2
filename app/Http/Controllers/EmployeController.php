<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Historique;

class EmployeController extends Controller
{
    /**
     * Affiche la liste des employés.
     */
    public function index()
    {
         // Récupère tous les employés, avec leurs équipements si nécessaire
        $employes = Employe::with('equipements')->get();
        $equipements = Equipement::all();

        // Passe les données à la vue
    return view('employes.index', compact('employes', 'equipements'));
    }

    /**
     * Affiche le formulaire de création d'un employé.
     */
    public function create()
{
    $equipements = Equipement::all(); // Récupère tous les équipements
    $users = User::all(); // Récupérer tous les utilisateurs

    return view('employes.create', compact('equipements', 'users'));
}

    /**
     * Enregistre un nouvel employé.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'date_embauche' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'equipement_id' => 'array', // Optionnel et doit être un tableau
            'equipement_id.*' => 'exists:equipements,id' // Chaque ID doit exister dans la table `equipements`
        ]);

        // Création de l'employé
        $employe = Employe::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'prenom' => $request->prenom,
            'poste' => $request->poste,
            'date_embauche' => $request->date_embauche,
            'user_id' => auth()->id(), // L'utilisateur qui a créé cet employé
        ]);

        // Associer les équipements si le formulaire contient des équipements
        if ($request->filled('equipement_id')) {
            $employe->equipements()->attach($request->equipement_id);
        }

        return redirect()->route('employes.index')->with('success', 'Employé ajouté avec succès');
    }

    public function affecterEquipements(Request $request, Employe $employe)
    {
        $request->validate([
            'equipements' => 'array',
            'equipements.*' => 'exists:equipements,id',
        ]);

        foreach ($request->equipements as $equipement_id) {
            $equipement = Equipement::findOrFail($equipement_id);

            // Trouver l'ancien utilisateur de l'équipement
            $dernierHistorique = Historique::where('equipement_id', $equipement_id)
                ->orderBy('date_passation', 'desc')
                ->first();

            $ancien_utilisateur_id = $dernierHistorique ? $dernierHistorique->nouveau_utilisateur_id : null;

            // Calcul du temps d'utilisation
            $temps_utilisation = $dernierHistorique ? now()->diffInDays($dernierHistorique->date_passation) : null;

            // Enregistrement dans l'historique
            Historique::create([
                'equipement_id' => $equipement_id,
                'ancien_utilisateur_id' => $ancien_utilisateur_id,
                'nouveau_utilisateur_id' => $employe->id,
                'date_passation' => now(),
                'temps_utilisation' => $temps_utilisation,
            ]);

            // Associer l'équipement à l'employé
            $employe->equipements()->syncWithoutDetaching($equipement_id);
        }

        return redirect()->route('employes.index')->with('success', 'Équipements affectés avec succès.');
    }

        public function showAffectationForm(Employe $employe)
    {
        $equipements = Equipement::all();
        return view('employes.affectation', compact('employe', 'equipements'));
    }

}




