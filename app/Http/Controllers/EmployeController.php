<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Equipement;
use App\Models\User;
use App\Models\Historique;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    /**
     * Affiche la liste des employés.
     */
    public function index()
    {
        // Récupérer uniquement les employés qui ne sont pas supprimés
        $employes = Employe::where('statut', '!=', 'supprimer')->get();
         // Récupérer les employés actifs
        $employes = Employe::where('statut', 'actif')->get();
        
        return view('employes.index', compact('employes'));
    }


    /**
     * Affiche le formulaire de création d'un employé.
     */
    public function create()
{
    $equipements = Equipement::all(); // Récupère tous les équipements
    // $users = User::all(); // Récupérer tous les utilisateurs
    $employes = Employe::all();

    return view('employes.create', compact('equipements', 'employes'));
}
// compact('equipements', 'users'));
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
            // 'user_id' => 'required|exists:users,id',
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

            // Vérifier si l'ancien utilisateur existe dans la table employes
            if ($ancien_utilisateur_id && !Employe::find($ancien_utilisateur_id)) {

                // Si l'utilisateur n'existe pas, mettre ancien_utilisateur_id à null
                $ancien_utilisateur_id = null;
            }

            // Calcul du temps d'utilisation
            $temps_utilisation = $dernierHistorique ? now()->diffInDays($dernierHistorique->date_passation) : null;

            // Enregistrement dans l'historique
            Historique::create([
                'equipement_id' => $equipement_id,
                'numero_serie' => $equipement->numero_serie,
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
        //suppression

    public function edit($id)
    {
        // Trouve l'employé par son ID
        $employe = Employe::findOrFail($id);

        // Renvoie la vue d'édition avec l'employé à modifier
        return view('employes.edit', compact('employe'));
    }



    public function update(Request $request, $id)
    {
        // Valider les données reçues
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email,' . $id,
            'telephone' => 'nullable|string|max:20',
            'poste' => 'nullable|string|max:255',
            'date_embauche' => 'required|date',
        ]);

        // Trouver l'employé par ID
        $employe = Employe::findOrFail($id);

        // Mettre à jour les informations de l'employé
        $employe->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'poste' => $request->poste,
            'date_embauche' => $request->date_embauche,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $employe = Employe::findOrFail($id);  // Trouver l'employé par son ID
        $employe->delete();  // Supprimer l'employé

        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }


        // Afficher un rapport spécifique
        public function show(Employe $employe)
        {
            return view('employes.show', compact('employe'));
        }




    // Supprimer manuellement les relations dans la table historique lorsque l'employé est supprimé
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($employe) {
            // Mettre à null la colonne 'nouveau_utilisateur_id' dans la table historique
            $employe->historiquesNouveaux()->update(['nouveau_utilisateur_id' => null]);
        });
    }


    //Suppression physique d'employé

        public function supprimer($id)
    {
        // Vérification si l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('employes.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer.');
        }

        // Trouver l'employé
        $employe = Employe::findOrFail($id);

        // Marquer l'employé comme supprimé (au lieu de le supprimer définitivement)
        $employe->statut = 'supprimer';
        $employe->save();

        return redirect()->route('employes.index')->with('success', 'L\'employé a été marqué comme supprimé.');
    }

    public function toggleStatut($id)
    {
        // Vérifier si l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('employes.index')->with('error', 'Seul l\'admin peut activer/désactiver un employé.');
        }

        // Récupérer l'employé
        $employe = Employe::findOrFail($id);

        // Basculer le statut entre 'actif' et 'inactif'
        $employe->statut = ($employe->statut === 'actif') ? 'desactif' : 'actif';
        $employe->save();

        // Retourner avec un message de succès
        return redirect()->route('employes.index')->with('success', 'Statut de l\'employé mis à jour avec succès.');
    }





}




