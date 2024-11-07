<?php

namespace App\Http\Middleware;

use App\Models\Partner;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPartner
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
        $partner_id = $request->cookie('partner_id');

        // Vérifie si le partenaire existe dans la base de données
        if ($partner_id && Partner::whereKey($partner_id)->exists()) {
            // Redirige vers le tableau de bord si le partenaire est déjà authentifié
            if ($request->routeIs(['partner.auth.login', 'partner.auth.login_page'])) {
                return redirect()->route('partner.panel.global_stats');
            }

            return $next($request); // Continuer la requête pour les autres routes
        }

        // Redirige vers la page de connexion si aucun partenaire n'est identifié
        return redirect()->route('partner.auth.login');
    }
}
