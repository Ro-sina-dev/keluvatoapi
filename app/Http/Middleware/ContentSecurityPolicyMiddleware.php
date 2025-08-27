<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Désactiver complètement CSP en supprimant tous les en-têtes
        $response->headers->remove('Content-Security-Policy');
        $response->headers->remove('Content-Security-Policy-Report-Only');
        $response->headers->remove('X-Content-Security-Policy');
        $response->headers->remove('X-WebKit-CSP');
        
        // Ne pas définir d'en-tête CSP du tout pour éviter les restrictions
        
        return $response;
    }
}
