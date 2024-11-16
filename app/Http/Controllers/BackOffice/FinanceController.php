<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use App\Models\Partner;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function cash_entries()
    {
        // Récupère tous les partenaires avec leurs cartes cadeaux et leurs catégories
        $partners = Partner::with(['giftCards', 'category'])->get();

        // Calcul des totaux globaux pour livraison, personnalisation et prix des cartes cadeaux
        $total_delivery_revenue = $partners->reduce(function ($carry, $partner) {
            return $carry + $partner->giftCards->sum('shipping_price');
        }, 0);

        $total_customization_revenue = $partners->reduce(function ($carry, $partner) {
            return $carry + $partner->giftCards->where('is_customized', true)->sum('customization_fee');
        }, 0);

        $total_price_gift_card = $partners->reduce(function ($carry, $partner) {
            return $carry + $partner->giftCards->sum('amount');
        }, 0);

        // Calcul des revenus par partenaire et tri par montant des cartes cadeaux
        $partners_with_revenue_datas = $partners->map(function ($partner) {
            return [
                'id' => $partner->id,
                'name' => $partner->name,
                'category_id' => $partner->category->id,
                'category_name' => $partner->category->name,
                'delivery_revenue' => $partner->giftCards->sum('shipping_price'),
                'customization_revenue' => $partner->giftCards->where('is_customized', true)->sum('customization_fee'),
                'price_gift_card' => $partner->giftCards->sum('amount'),
                'commission' => $partner->giftCards->sum('amount') * $partner->commission_percent / 100
            ];
        })->sortByDesc('price_gift_card'); // Tri en ordre décroissant par montant des cartes cadeaux

        // Calcul des revenus totaux par catégorie et tri par montant des cartes cadeaux
        $category_revenues = $partners_with_revenue_datas
            ->groupBy('category_id')
            ->map(function ($partners, $category_id) {
                return [
                    'category_id' => $category_id,
                    'category_name' => $partners->first()['category_name'],
                    'total_delivery_revenue' => $partners->sum('delivery_revenue'),
                    'total_customization_revenue' => $partners->sum('customization_revenue'),
                    'total_price_gift_card' => $partners->sum('price_gift_card')
                ];
            })
            ->sortByDesc('total_price_gift_card'); // Tri en ordre décroissant par montant des cartes cadeaux pour les catégories


        return view('backoffice.pages.finance.cash_entries', compact(
            'total_delivery_revenue',
            'total_customization_revenue',
            'total_price_gift_card',
            'partners_with_revenue_datas',
            'category_revenues'
        ));
    }


    public function card_payment_to_validate()
    {
        $datas = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->whereNull('payment_network');
        })->with('paymentInfo')->get();
        return view('backoffice.pages.finance.card_payment_to_validate', compact('datas'));
    }

    public function change_payment_status(Request $request)
    {
        $request->validate([
            'gift_card_id' => 'required|numeric|exists:gift_cards,id',
            'newStatus' => 'required|string|in:SUCCESSFUL,FAILED',
        ]);
        
        $gift_card = GiftCard::findOrFail($request->input('gift_card_id'));
        
        $paymentInfo = $gift_card->paymentInfo;
        $paymentInfo->status = $request->input('newStatus');
        $paymentInfo->save();

        return response()->json();
    }
}
