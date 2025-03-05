<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Equipement;
use App\Models\User;

class RapportController extends Controller
{
    // Afficher la liste des rapports
    public function index()
    {
        $rapports = Rapport::latest()->paginate(10);
        return view('rapports.index', compact('rapports'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $equipements = Equipement::all();
        return view('rapports.create', compact('equipements'));
    }

    // Enregistrer un nouveau rapport
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_generation' => 'required|date',
            'equipement_id' => 'required|exists:equipements,id',
            // 'fichier' => 'nullable|mimes:pdf,doc,docx,xlsx|max:2048'
        ]);


        // $fichierPath = null;
        // if ($request->hasFile('fichier')) {
        //     $fichierPath = $request->file('fichier')->store('rapports');
        // }

        Rapport::create([
            'type' => $request->type,
        'titre' => $request->titre,
        'description' => $request->description,
        'date_generation' => $request->date_generation,
        'equipement_id' => $request->equipement_id,
        'user_id' => Auth::id(), // ID de l'utilisateur connecté
        // 'fichier' => $fichierPath,
        ]);

        return redirect()->route('rapports.index')->with('success', 'Rapport ajouté avec succès.');
    }

    // Afficher un rapport spécifique
    public function show(Rapport $rapport)
    {
        return view('rapports.show', compact('rapport'));
    }

    // Afficher le formulaire de modification
    public function edit(Rapport $rapport)
    {
        $equipements = Equipement::all();
        return view('rapports.edit', compact('rapport', 'equipements'));

    }

    // Mettre à jour un rapport
    public function update(Request $request, Rapport $rapport)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'date_generation' => 'required|date',
        'equipement_id' => 'required|exists:equipements,id',
    ]);

    $rapport->update([
        'titre' => $request->titre,
        'description' => $request->description,
        'date_generation' => $request->date_generation,
        'equipement_id' => $request->equipement_id,
    ]);

    return redirect()->route('rapports.index')->with('success', 'Rapport mis à jour avec succès.');
}


    //exportation du rapport
        public function exportPDF()
    {
        $rapports = Rapport::all();
        $pdf = Pdf::loadView('rapports.pdf', compact('rapports'));
        return $pdf->download('rapports.pdf');
    }

    // Supprimer un rapport
    public function destroy(Rapport $rapport)
    {
        if ($rapport->fichier) {
            Storage::delete($rapport->fichier);
        }
        $rapport->delete();

        return redirect()->route('rapports.index')->with('success', 'Rapport supprimé avec succès.');
    }



}
