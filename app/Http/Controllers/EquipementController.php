<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Auth;


class EquipementController extends Controller
{
    // Afficher la liste des équipements
    public function index()
    {
        // Récupérer uniquement les équipements actifs
        $equipements = Equipement::where('statut', '!=', 'supprimer')->get();

        return view('equipements.index', compact('equipements'));
    }


    // Afficher le formulaire pour ajouter un nouvel équipement
    public function create()
    {
        // $users = User::all(); // Récupérer tous les utilisateurs
        $equipements = Equipement::all();
    return view('equipements.create', compact('equipements'));
    }
    // compact('users'))
    // Enregistrer un nouvel équipement
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|in:Ordinateur,Imprimante,Serveur,Switch,Routeur,Autre',
        'cout' => 'required|string|max:255',
        'etat' => 'required|in:actif,en panne,hors service',
        'date_achat' => 'required|date',
        // 'user_id' => 'required|exists:users,id',
        // 'nom_utilisateur' => 'required|string|max:255',
        'numero_serie' => 'required|string|unique:equipements,numero_serie',
        'marque' => 'required|string|max:255',
        'caracteristique' => 'required|string',
        'photo_equip' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'code_barre' => 'nullable|string|unique:equipements,code_barre',


        ]);
        // dd($request->all());


        // Gestion de l'upload de la photo
         if ($request->hasFile('photo_equip')) {
        $photoPath = $request->file('photo_equip')->store('photos_equipements', 'public');
         }

         else {
        $photoPath = null;
         }

         $codeBarre = $request->code_barre ?? Str::random(10); // Générer un code-barres unique si vide


        // Créer un nouvel équipement dans la base de données
        Equipement::create([
            'nom' => $request->nom,
            'type' => $request->type,
            'cout' => $request->cout,
            'etat' => $request->etat,
            'date_achat' => $request->date_achat,
            // 'user_id' => $request->user_id,
            'user_id' => Auth::id(),
            'nom_utilisateur' => $request->nom_utilisateur,
            'numero_serie' => $request->numero_serie,
            'marque' => $request->marque,
            'caracteristique' => $request->caracteristique,
            'photo_equip' => $photoPath,
            'code_barre' => $codeBarre,

        ]);

        // Rediriger vers la liste des équipements
        return redirect()->route('equipements.index')->with('success', 'Équipement ajouté avec succès.');
    }

    // //Suppression

    // public function destroy($id)
    // {
    //     try {
    //         $equipement = Equipement::find($id);

    //         if (!$equipement) {
    //             return redirect()->back()->with('error', 'Équipement introuvable.');
    //         }

    //         $equipement->delete();

    //         return redirect()->back()->with('success', 'Équipement supprimé avec succès.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    //     }
    // }


        // Modification

        public function edit($id)
    {
        $equipement = Equipement::find($id);
        if (!$equipement) {
            return redirect()->route('equipements.index')->with('error', 'Équipement non trouvé.');
        }

        return view('equipements.edit', compact('equipement'));
    }


// Mise à jour avec la fonction update

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'cout' => 'required|string|max:255',
        'etat' => 'required|string|max:255',
        'date_achat' => 'required|date',
        'numero_serie' => 'required|string|max:255',
        'marque' => 'required|string|max:255',
        'caracteristique' => 'nullable|string',
        'photo_equip' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
    ]);

    $equipement = Equipement::find($id);

    if (!$equipement) {
        return redirect()->route('equipements.index')->with('error', 'Équipement non trouvé.');
    }

    // Gestion de la photo
    if ($request->hasFile('photo_equip')) {
        // Supprimer l'ancienne photo si elle existe
        if ($equipement->photo_equip) {
            Storage::delete('public/' . $equipement->photo_equip);
        }

        // Enregistrer la nouvelle photo
        $photoPath = $request->file('photo_equip')->store('photos_equipements', 'public');
    } else {
        // Si aucune nouvelle photo, garder l'ancienne
        $photoPath = $equipement->photo_equip;
    }

    // Mise à jour de l'équipement avec la nouvelle photo
    $equipement->update([
        'nom' => $request->nom,
        'type' => $request->type,
        'cout' => $request->cout,
        'etat' => $request->etat,
        'date_achat' => $request->date_achat,
        'user_id' => Auth::id(),
        'numero_serie' => $request->numero_serie,
        'marque' => $request->marque,
        'caracteristique' => $request->caracteristique,
        'photo_equip' => $photoPath,
    ]);

    return redirect()->route('equipements.index')->with('success', 'Équipement mis à jour avec succès.');
}
    // Afficher un equipement spécifique
    public function show(Equipement $equipement)
    {
        return view('equipements.show', compact('equipement'));
    }


    // Suppression physique d'equipement

    public function supprimer($id)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('equipements.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer.');
        }

        $equipement = Equipement::findOrFail($id);
        $equipement->statut = 'supprimer';
        $equipement->save();

        return redirect()->route('equipements.index')->with('success', 'L\'équipement a été marqué comme supprimé.');
    }



    public function filterEquipements(Request $request)
    {
        // Vérifier si le numéro de série est fourni
        $numero_serie = $request->input('numero_serie');

        // Rechercher les équipements avec ce numéro de série (en utilisant un "like" pour une recherche partielle)
        $equipements = Equipement::where('numero_serie', 'like', '%' . $numero_serie . '%')->get();

        // Retourner les équipements sous forme de JSON
        return response()->json($equipements);
    }




}
