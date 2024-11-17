<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\CustomLog;
use App\Models\GiftCard;
use App\Models\Partner;
use App\Models\PaymentInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function overviewStats()
    {
        // Statistiques sur les utilisateurs
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();
        $mostActiveUsers = User::withCount('giftCards')->orderByDesc('gift_cards_count')->limit(5)->get();
        $unusedGiftCardsCount = GiftCard::where('used', false)->count();
        $userRetentionRate = $this->calculateUserRetentionRate();

        // Statistiques sur les paiements
        $paymentMethods = PaymentInfo::select('payment_network', DB::raw('count(*) as total'))
            ->groupBy('payment_network')
            ->get();
        $paymentSuccessRate = PaymentInfo::where('status', 'SUCCESSFUL')->count() / PaymentInfo::count() * 100;
        $paymentVolumeByCurrency = PaymentInfo::join('gift_cards', 'payment_infos.gift_card_id', '=', 'gift_cards.id')
            ->select('payment_infos.currency', DB::raw('SUM(gift_cards.total_amount) as total'))
            ->groupBy('payment_infos.currency')
            ->get();


        // Statistiques sur les livraisons
        $deliveryByRegion = GiftCard::select('shipping_zone', DB::raw('count(*) as total'))
            ->groupBy('shipping_zone')
            ->get();

        // Partenaires suspendus
        $suspendedPartners = Partner::where('suspended', true)->count();

        // Produits/services populaires
        $topProducts = GiftCard::select('partner_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('partner_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();

        return view('backoffice.pages.home', compact(
            'newUsersThisMonth',
            'mostActiveUsers',
            'unusedGiftCardsCount',
            'userRetentionRate',
            'paymentMethods',
            'paymentSuccessRate',
            'paymentVolumeByCurrency',
            'deliveryByRegion',
            'suspendedPartners',
            'topProducts'
        ));
    }

    public function showActivities()
    {
        // Récupérer les logs d'activités avec pagination
        $activities = CustomLog::latest()->paginate(20); // Vous pouvez ajuster la pagination si nécessaire
        return view('backoffice.pages.logs', compact('activities'));
    }


    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:logs,id',
            'read' => 'required|in:true,false',
        ]);

        CustomLog::whereIn('id', $validated['ids'])->update(['read' => $validated['read'] === 'true']);
        return response()->json(['message' => 'Le statut des activités a été mis à jour avec succès.']);
    }



    // Calcul du taux de rétention
    private function calculateUserRetentionRate()
    {
        $totalUsers = User::count();
        $returningUsers = User::whereHas('giftCards', function ($query) {
            $query->where('used', true);
        })->count();

        return ($returningUsers / $totalUsers) * 100;
    }
}
