<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,technicien,utilisateur,editeur'],
        ]);

        // Définir le statut par défaut
        $statut = 'desactif';

        // Si c'est un admin et qu'il n'existe encore aucun admin => actif
        if ($request->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount === 0) {
                $statut = 'actif';
            }
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'statut' => $statut,
        ]);

        event(new Registered($user));

        // Redirection vers login sans connexion automatique
        return redirect()->route('login')->with('success', 'Compte créé avec succès. Veuillez vous connecter.');
    }
}
