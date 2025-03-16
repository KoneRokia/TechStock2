<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;  


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = auth()->user();

    // Validation des champs existants + photo
    $rules = [
        'name'  => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // Ajout de la validation de l'image
    ];

    if ($user->role === 'admin') {
        $rules['role'] = ['required', 'string', 'max:255'];
    }

    $data = $request->validate($rules);

    // Mise à jour des informations de base
    $user->fill($data);

    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        // Sauvegarder la nouvelle photo
        $photoPath = $request->file('photo')->store('photos', 'public');
        $user->photo = $photoPath;
    }

    // Réinitialiser la vérification de l'email si changé
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return back()->with('status', 'Profil mis à jour avec succès.');
}
    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }




    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Vérifier si le mot de passe est correct
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect.']);
        }

        // Modifier l'email en ajoutant un suffixe unique (évite les conflits en cas de recréation du compte)
        $newEmail = $user->email . '_' . time();

        // Mettre à jour les informations dans la base de données
        DB::table('users')->where('id', $user->id)->update([
            'statut' => 'supprimer',
            'email' => $newEmail
        ]);

        // Déconnecter l'utilisateur
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('register')->with('status', 'Compte supprimé avec succès.');
    }

    public function softDelete(Request $request)
    {
        $user = $request->user();

        // Générer un nouvel email unique
        $newEmail = $user->email . '_' . time();

        // Mettre à jour le statut et l'email
        $user->update([
            'statut' => 'supprimer',
            'email' => $newEmail
        ]);

        // Déconnecter et invalider la session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('register')->with('status', 'Votre compte a été désactivé.');
    }



     // Désactivation du compte par l'utilisateur
     public function deactivate(Request $request)
     {
         $user = Auth::user();

         // Vérification du mot de passe
         if (!Hash::check($request->password, $user->password)) {
             return back()->withErrors(['password' => 'Mot de passe incorrect.']);
         }

         // Modifier le statut en "desactif"
         $user->update(['statut' => 'desactif']);

         // Déconnecter l'utilisateur et invalider la session
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();

         return redirect('/')->with('status', 'Votre compte a été désactivé.');
     }

     // Réactivation du compte par l'admin
     public function activate($id)
    {
        $user = User::findOrFail($id);

        if ($user->statut === 'desactif') {
            $user->statut = 'actif';
            $user->save();

            return response()->json([
                'message' => "Le compte de {$user->name} a été activé avec succès.",
                'statut' => $user->statut
            ]);
        }

        return response()->json([
            'message' => "Le compte est déjà actif."
        ], 400);
    }

}
