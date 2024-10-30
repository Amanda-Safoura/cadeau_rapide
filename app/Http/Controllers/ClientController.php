<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerCategory;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function home()
    {
        $categories = PartnerCategory::all();
        $partners = Partner::with('category')->get();
        $topPartners = Partner::withCount('giftCards')
            ->orderBy('gift_cards_count', 'desc')
            ->take(10)
            ->get();

        return view('new_client_site.pages.home', compact('categories', 'partners', 'topPartners'));
    }
}
