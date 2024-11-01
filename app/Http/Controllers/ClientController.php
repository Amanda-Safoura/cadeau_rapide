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
        $partners = Partner::where('suspended', false)
            ->with('category')->get();
        $topPartners = Partner::where('suspended', false)
            ->withCount('giftCards')
            ->orderBy('gift_cards_count', 'desc')
            ->take(9)
            ->get();

        return view('new_client_site.pages.home', compact('categories', 'partners', 'topPartners'));
    }
}
