<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et possède le rôle "admin"
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Sinon, retourne une erreur 403
        abort(403, 'Accès non autorisé.');
    }
}
