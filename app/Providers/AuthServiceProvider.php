<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;



// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
{
    // Définition d'une règle Gate pour vérifier si l'utilisateur est actif
    Gate::define('is-active', function ($user) {
        return $user->statut !== 'supprimer';
    });
        // Définition d'une règle Gate pour vérifier si l'utilisateur est actif
        Gate::define('is-active', function (User $user) {
            return $user->statut === 'actif';
        });

        // Vérification du statut de l'utilisateur lors de la connexion
        Auth::viaRequest('custom-auth', function ($request) {
            $user = User::where('email', $request->input('email'))->first(); // 🔹 Récupération correcte de l'utilisateur

            if ($user && $user->statut === 'desactif') {
                Auth::logout(); // 🔹 Déconnexion immédiate
                abort(403, 'Votre compte est désactivé. Contactez un administrateur.');
            }


        return $user;
    });
}
}
