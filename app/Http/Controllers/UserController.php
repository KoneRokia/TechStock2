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
            'statut' => 'required|in:actif,dexactif,supprimer',
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

        return back()->with('success', "Le compte de {$user->name} a été activé.");
    }

    // Désactiver un compte utilisateur
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->statut = 'desactif';
        $user->save();

        return back()->with('success', "Le compte de {$user->name} a été désactivé.");
    }
}
