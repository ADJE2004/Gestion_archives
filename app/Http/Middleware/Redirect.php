<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Redirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
        $role = Auth::user()->role;
        $currentRouteName = $request->route()->getName();

        // On définit la route cible selon le rôle
        $targetRoute = match($role) {
            'admin' => 'admin.dashboard',
            'chef'  => 'chef.dashboard',
            default => 'agent.dashboard',
        };
        if ($targetRoute && $currentRouteName !== $targetRoute) {
            return redirect()->route($targetRoute);
        }
    }

    return $next($request);
    }
}
