<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Si l'utilisateur est connecté et tente d'accéder à login/register
        if (Auth::check() && ($request->routeIs('show.login') || $request->routeIs('show.register'))) {
            $response = redirect()->route('articles.liste_articles');

            // Empêche le navigateur de mettre en cache la page
            return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                            ->header('Pragma', 'no-cache')
                            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        }

        $response = $next($request);

        // Pour toutes les pages login/register, on empêche le cache
        if ($request->routeIs('show.login') || $request->routeIs('show.register')) {
            $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                     ->header('Pragma', 'no-cache')
                     ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        }

        return $response;
    }
}
