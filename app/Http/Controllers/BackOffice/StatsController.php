<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\GiftCard;
use Illuminate\Http\Request;


class StatsController extends Controller
{
    public function getSalesStats(Request $request)
    {
        // Définir la période par défaut ou récupérer celle de la requête
        $startDate = Carbon::parse($request->input('start_date', now()->startOfMonth())); // Utiliser Carbon::parse() pour garantir que c'est un objet Carbon
        $endDate = Carbon::parse($request->input('end_date', now())); // Idem pour la date de fin

        // Récupérer les ventes réussies dans la période
        $sales = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->where('status', 'SUCCESSFUL');
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Calcul des statistiques
        $totalOrders = $sales->count();
        $totalRevenue = $sales->sum('total_amount'); // Montant total (total_amount = amount + shipping_price + customization_fee)
        $averageAmount = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0; // Montant moyen des chèques cadeaux

        // Retourner les statistiques à la vue
        return view('backoffice.pages.stats.sales_stats', compact('totalOrders', 'totalRevenue', 'averageAmount', 'startDate', 'endDate'));
    }

    public function getSalesByCategory(Request $request)
    {
        // Définir la période par défaut ou récupérer celle de la requête
        $startDate = Carbon::parse($request->input('start_date', now()->startOfMonth())); // Utiliser Carbon::parse() pour garantir que c'est un objet Carbon
        $endDate = Carbon::parse($request->input('end_date', now())); // Idem pour la date de fin

        // Récupérer les ventes réussies par catégorie de partenaire
        $salesByCategory = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->where('status', 'SUCCESSFUL');
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('partner.category') // Associer chaque vente à son partenaire et sa catégorie
            ->get()
            ->groupBy(function ($sale) {
                return $sale->partner->category->name; // Regrouper par nom de la catégorie
            });

        // Calculer les statistiques par catégorie
        $categoriesStats = [];
        foreach ($salesByCategory as $category => $sales) {
            $totalOrders = $sales->count();
            $totalRevenue = $sales->sum('total_amount'); // Montant total des ventes dans cette catégorie
            $averageAmount = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0; // Montant moyen des chèques cadeaux

            $categoriesStats[] = [
                'category' => $category,
                'totalOrders' => $totalOrders,
                'totalRevenue' => $totalRevenue,
                'averageAmount' => $averageAmount,
            ];
        }

        // Retourner les statistiques par catégorie à la vue
        return view('backoffice.pages.stats.sales_by_category', compact('categoriesStats', 'startDate', 'endDate'));
    }

    public function customizationsReport(Request $request)
    {
        // Récupérer les dates de début et de fin si elles sont passées via la requête, sinon définir la période par défaut (par exemple, le mois précédent)
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());

        // Récupérer les données des personnalisations (chiffres de ventes personnalisées)
        $customizationsStats = GiftCard::where('is_customized', true)
            ->whereHas('paymentInfo', function ($query) {
                $query->where('status', 'SUCCESSFUL');
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(id) as total_customized, SUM(total_amount) as total_revenue')
            ->first();

        // Si pas de données, définir des valeurs par défaut
        if (!$customizationsStats) {
            $customizationsStats = [
                'total_customized' => 0,
                'total_revenue' => 0,
            ];
        }

        // Passer les données à la vue
        return view('backoffice.pages.stats.reports_customizations', compact('customizationsStats', 'startDate', 'endDate'));
    }
}
