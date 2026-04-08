<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur est connecté ET qu'il doit changer son MDP
        // ET qu'il n'est pas déjà sur la page de profil ou en train de sauvegarder
    if (auth()->check() && auth()->user()->must_change_password && !$request->routeIs('profile.*')) {
        return redirect()->route('profile.edit')
            ->with('warning', 'Pour votre sécurité, changez votre mot de passe provisoire.');
    }
        return $next($request);
    }
}
