<?php

namespace App\Http\Controllers;

use App\Models\Logiciel;
use App\Models\Licence;
use App\Models\Employe;
use Illuminate\Http\Request;

class LogicielController extends Controller
{
    public function index()
    {
        // Afficher tous les logiciels
        $logiciels = Logiciel::all();
        $licences = Licence::all();
        $employes = Employe::all();

        return view('logiciels.index', compact('logiciels', 'licences', 'employes'));
    }

    public function create()
{
    $licences = Licence::all();
    $employes = Employe::all();
    return view('logiciels.create', compact('licences', 'employes'));
}


public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255|unique:logiciels',
        'version' => 'required|string|max:255',
        'editeur' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'licence_ids' => 'nullable|array',
        'licence_ids.*' => 'exists:licences,id',
        'employe_ids' => 'nullable|array',
        'employe_ids.*' => 'exists:employes,id',
    ]);

    $logiciel = Logiciel::create($request->except(['licence_ids', 'employe_ids']));

    if ($request->has('licence_ids')) {
        $logiciel->licences()->sync($request->licence_ids);
    }

    if ($request->has('employe_ids')) {
        $logiciel->employes()->sync($request->employe_ids);
    }

    return redirect()->route('logiciels.index')->with('success', 'Logiciel ajouté avec succès !');
}


   public function show($id)
{
    $logiciel = Logiciel::with(['licences', 'employes'])->findOrFail($id);

    return response()->json([
        'nom' => $logiciel->nom,
        'version' => $logiciel->version,
        'editeur' => $logiciel->editeur, // attention pas d'accent dans le JSON
        'type' => $logiciel->type,
        'date_achat' => $logiciel->date_achat,
        'licences' => $logiciel->licences,
        'employes' => $logiciel->employes,
    ]);
}



    public function edit($id)
    {
        // Récupérer le logiciel à modifier
        $logiciel = Logiciel::findOrFail($id);

        // Récupérer les licences et les employés associés à ce logiciel
        $licences = Licence::all(); // Liste de toutes les licences
        $employes = Employe::all(); // Liste de tous les employés

        // Retourner la vue avec les données
        return view('logiciels.edit', compact('logiciel', 'licences', 'employes'));
    }


    public function update(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'nom' => 'required|string|max:255',
        'version' => 'nullable|string|max:255',
        'date_achat' => 'required|date',
        'date_expiration' => 'required|date',
        'type' => 'required|string|max:255',
        'editeur' => 'nullable|string|max:255',
        'employes' => 'nullable|array', // Array d'employés à associer
        'licences' => 'nullable|array', // Array de licences à associer
    ]);

    // Trouver le logiciel à mettre à jour
    $logiciel = Logiciel::findOrFail($id);

    // Mettre à jour les informations du logiciel
    $logiciel->update([
        'nom' => $request->nom,
        'version' => $request->version,
        'date_achat' => $request->date_achat,
        'date_expiration' => $request->date_expiration,
        'type' => $request->type,
        'editeur' => $request->editeur,
    ]);

    // Gérer les relations many-to-many : ajouter/supprimer les employés et licences
    if ($request->has('employes')) {
        $logiciel->employes()->sync($request->employes); // Lier les employés au logiciel
    }

    if ($request->has('licences')) {
        $logiciel->licences()->sync($request->licences); // Lier les licences au logiciel
    }

    return redirect()->route('logiciels.index')->with('success', 'Logiciel mis à jour avec succès');
}



    public function destroy($id)
    {
        // Supprimer un logiciel
        $logiciel = Logiciel::findOrFail($id);
        $logiciel->delete();

        return redirect()->route('logiciels.index')->with('success', 'Logiciel supprimé avec succès!');
    }

    public function affecterLogicielEmploye($employeId, $logicielId)
    {
        $employe = Employe::findOrFail($employeId);
        $logiciel = Logiciel::findOrFail($logicielId);

        // Affecter le logiciel à l'employé
        $employe->logiciels()->attach($logicielId);  // Enregistrement dans la table pivot

        // Ajouter l'historique de l'affectation
        $employe->historiques()->create([
            'logiciel_id' => $logicielId,
            'action' => 'affectation'
        ]);

        return redirect()->route('logiciels.index')->with('success', 'Logiciel affecté à l\'employé avec succès!');
    }

        public function getLogicielData($id)
    {
        $logiciel = Logiciel::findOrFail($id);
        return response()->json($logiciel);
    }

 


}
