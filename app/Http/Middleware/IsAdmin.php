<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $admin_id = $request->cookie('admin_id');

        // Vérifie si le administrateur existe dans la base de données
        if ($admin_id && Admin::whereKey($admin_id)->exists())
            return $next($request); // Continuer la requête pour les autres routes

        // Redirige vers la page de connexion si aucun administrateur n'est identifié
        return redirect()->route('dashboard.auth.login');
    }
}
