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
    public function handle(Request $request, Closure $next)
    {
         $user = auth()->user();
        // Si l'utilisateur est connecté ET qu'il doit changer son MDP
     if ($user && $user->must_change_password && $user->role !== 'admin')  {
        if (!$request->is('password/change*') ) {
            return redirect()->route('password.change')
                             ->with('info', 'Pour votre sécurité, changez votre mot de passe.');
        }
     }
        return $next($request);
    
    }
}