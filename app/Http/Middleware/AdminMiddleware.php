<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {

          $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // pas connecté
        }



        if ($user->role !== 'admin') {
              return $next($request);

        }

         // Tu peux choisir un 403 ou rediriger ailleurs
            abort(403, 'Accès réservé aux administrateurs.');
    }
}
