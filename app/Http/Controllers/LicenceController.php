<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Logiciel;
use Illuminate\Http\Request;
use App\Notifications\LicenceRenewalNotification;
use Carbon\Carbon;


class LicenceController extends Controller
{
    public function index()
{
    $licences = Licence::with('logiciels')->get();
    $logiciels = Logiciel::all();
    return view('licences.index', compact('licences', 'logiciels'));
}

    public function create()
    {
        // Créer une nouvelle licence
        $logiciels = Logiciel::all(); // Pour afficher tous les logiciels associés
        return view('licences.create', compact('logiciels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cle_licence' => 'required|unique:licences',
            'type' => 'required',
            'nombre_utilisateurs' => 'nullable|string|max:255',
            'date_expiration' => 'nullable|date',
            'logiciel_ids' => 'required|array', // Doit être un tableau d'IDs
            'logiciel_ids.*' => 'exists:logiciels,id', // Chaque ID doit exister
            'etat' => 'required|in:active,expirée,bientôt expirée',
        ]);

        $licence = Licence::create($request->except('logiciel_ids'));
        $licence->logiciels()->sync($request->logiciel_ids);

        return redirect()->route('licences.index')->with('success', 'Licence ajoutée avec succès!');
    }


   public function show($id)
{
    $licence = Licence::with('logiciels')->findOrFail($id);

    if (request()->expectsJson()) {
        return response()->json($licence);
    }

    return view('licences.show', compact('licence'));
}


    public function edit($id)
    {
        $licence = Licence::findOrFail($id);
        $logiciels = Logiciel::all(); // Récupère tous les logiciels

        return view('licences.edit', compact('licence', 'logiciels'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if (!in_array($user->role, ['admin','editeur'])) {
            abort(403);
        }

        $request->validate([
        'cle_licence' => 'required|string',
        'type' => 'required|string',
        'nombre_utilisateurs' => 'required|integer',
        'date_expiration' => 'nullable|date',
        'etat' => 'required|string',
        'logiciel_id' => 'required|exists:logiciels,id',
        ]);
        // Trouver et mettre à jour la licence
        $licence = Licence::findOrFail($id);
        $licence->update([
            'cle_licence' => $request->cle_licence,
            'type' => $request->type,
            'nombre_utilisateurs' => $request->nombre_utilisateurs,
            'date_expiration' => $request->date_expiration,
            'etat' => $request->etat,
        ]);

        // Associer la licence au logiciel via la table pivot
        $licence->logiciels()->sync([$request->logiciel_id]);

        return redirect()->route('licences.index')->with('success', 'Licence mise à jour avec succès');
    
}

    public function destroy($id)
    {
        // Supprimer une licence
        $licence = Licence::findOrFail($id);
        $licence->delete();

        return redirect()->route('licences.index')->with('success', 'Licence supprimée avec succès!');
    }

    public function checkLicencesExpiringSoon()
{
    $licences = Licence::whereDate('date_expiration', '<=', Carbon::now()->addDays(7))->get();

    foreach ($licences as $licence) {
        // Envoie une notification à l'administrateur (ou un groupe d'utilisateurs)
        $users = User::where('role', 'admin')->get();
        foreach ($users as $user) {
            $user->notify(new LicenceRenewalNotification($licence));
        }
    }

    return "Notifications envoyées !";
}
}
