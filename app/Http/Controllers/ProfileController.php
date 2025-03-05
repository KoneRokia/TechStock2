<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');


        // Règles de validation de base
    $rules = [
        'name'  => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        // Ajoute d'autres règles si nécessaire
    ];

    // Si l'utilisateur connecté est admin, on valide le champ 'role'
    if (auth()->user()->role === 'admin') {
        $rules['role'] = ['required', 'string', 'max:255'];
    }

    $data = $request->validate($rules);

    $user = auth()->user();

    // Mise à jour des informations de base
    $user->name  = $data['name'];
    $user->email = $data['email'];

    // Mise à jour du rôle uniquement si l'utilisateur connecté est admin
    if (auth()->user()->role === 'admin' && isset($data['role'])) {
        $user->role = $data['role'];
    }

    $user->save();

    return back()->with('status', 'Profil mis à jour avec succès.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
