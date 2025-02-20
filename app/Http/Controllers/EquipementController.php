<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Carbon\Carbon;


class EquipementController extends Controller
{
    // Afficher la liste des équipements
    public function index()
    {
        // Récupérer tous les équipements
        $equipements = Equipement::all(); // Tu peux ajouter des options de pagination si nécessaire

        return view('equipements.index', compact('equipements'));
    }

    // Afficher le formulaire pour ajouter un nouvel équipement
    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
    return view('equipements.create', compact('users'));
    }

    // Enregistrer un nouvel équipement
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'cout' => 'required|string|max:255',
        'etat' => 'required|in:actif,en panne,hors service',
        'date_achat' => 'required|date',
        'user_id' => 'required|exists:users,id',
        'nom_utilisateur' => 'required|string|max:255',
        'numero_serie' => 'required|string|unique:equipements,numero_serie',
        'marque' => 'required|string|max:255',
        'caracteristique' => 'required|string',
        'photo_equip' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        // dd($request->all());


        // Gestion de l'upload de la photo
         if ($request->hasFile('photo_equip')) {
        $photoPath = $request->file('photo_equip')->store('photos_equipements', 'public');
         }

         else {
        $photoPath = null;
         }

        // Créer un nouvel équipement dans la base de données
        Equipement::create([
            'nom' => $request->nom,
            'type' => $request->type,
            'cout' => $request->cout,
            'etat' => $request->etat,
            'date_achat' => $request->date_achat,
            'user_id' => $request->user_id,
            'nom_utilisateur' => $request->nom_utilisateur,
            'numero_serie' => $request->numero_serie,
            'marque' => $request->marque,
            'caracteristique' => $request->caracteristique,
            'photo_equip' => $photoPath,
        ]);

        // Rediriger vers la liste des équipements
        return redirect()->route('equipements.index')->with('success', 'Équipement ajouté avec succès.');
    }
}
