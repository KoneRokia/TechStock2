<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {Fortify::authenticateUsing(function (Request $request) {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return null;
        }

        // Vérifier si le compte est supprimé
        if ($user->statut === 'supprimer') {
            return null; // Refuser la connexion
        }

        return $user;
    });
}

}
