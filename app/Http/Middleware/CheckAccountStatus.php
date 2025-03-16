<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->statut === 'supprimer') {
            Auth::logout();
            return redirect()->route('register')->with('error', 'Votre compte est désactivé. Veuillez contacter un administrateur.');
        }

        if (Auth::check() && Auth::user()->statut === 'desactif') {
            Auth::logout(); // Déconnexion immédiate
            return redirect()->route('login')->withErrors(['email' => 'Votre compte est désactivé. Contactez un administrateur.']);
        }


        return $next($request);
    }

}
