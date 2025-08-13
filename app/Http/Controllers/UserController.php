<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateStatut(Request $request, User $user)
    {
        // Vérifie que l'utilisateur connecté est admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }

        // Validation
        $data = $request->validate([
            'statut' => 'required|in:actif,desactif,supprimer',
        ]);

        // Met à jour le statut
        $user->statut = $data['statut'];
        $user->save();

        return redirect()->back()->with('status', "Le statut de l'utilisateur a été mis à jour en : {$data['statut']}.");
    }

    // Afficher la liste des utilisateurs
    public function index()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('users.index', compact('users'));
    }

    // Activer un compte utilisateur
   public function activate($id)
{
    $user = User::findOrFail($id);
    $user->statut = 'actif';
    $user->save();

    return redirect()->route('users.index')->with('success', "Le compte de {$user->name} a été activé avec succès.");
}

    // Désactiver un compte utilisateur
       public function deactivate($id)
{
    $user = User::findOrFail($id);
    $user->statut = 'desactif';
    $user->save();

    return redirect()->route('users.index')->with('success', "Le compte de {$user->name} a été désactivé.");
}


        public function create()
    {
        // Seulement accessible aux admins
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }
        return view('users.create');
    }

    public function store(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Accès non autorisé.');
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'role' => 'required|in:admin,technicien,utilisateur,editeur',
        // Pas besoin de valider 'statut' car tu le forces dans le code
    ]);

    // Si c'est le premier admin, il est actif, sinon désactivé
    if ($validated['role'] === 'admin' && User::where('role', 'admin')->count() === 0) {
        $validated['statut'] = 'actif';
    } else {
        $validated['statut'] = 'desactif';
    }

    // Hashage du mot de passe
    $validated['password'] = bcrypt($validated['password']);

    // Création de l'utilisateur avec les données validées
    User::create($validated);

    return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
}

// Désactiver son propre compte
public function deactivateSelf(Request $request)
{
    $user = auth()->user();
    $user->statut = 'desactif';
    $user->save();

    auth()->logout();

    return redirect()->route('login')->with('success', 'Votre compte a été désactivé.');
}



}
