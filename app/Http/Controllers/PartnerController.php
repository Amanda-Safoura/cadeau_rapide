<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function index()
    {
        $categories = PartnerCategory::all();
        $partners = Partner::where('suspended', false)
            ->orderBy('name')
            ->paginate(20);
        $groupedPartners = $partners->groupBy(function ($partner) {
            return strtoupper(substr($partner->name, 0, 1));
        });

        return view('new_client_site.pages.partners.all', compact('categories', 'groupedPartners', 'partners'));
    }

    public function index_popularity_sorting()
    {
        $categories = PartnerCategory::all();
        $partners = Partner::where('suspended', false)
            ->withCount('giftCards')
            ->orderBy('gift_cards_count', 'desc')
            ->paginate(20);
        return view('new_client_site.pages.partners.all_popularity_sorting', compact('categories', 'partners'));
    }

    public function resultByLetter($letter)
    {
        $partners = Partner::where('suspended', false)
            ->where('name', 'like', "{$letter}%")
            ->paginate(9);
        $categories = PartnerCategory::all();

        return view('new_client_site.pages.partners.alphabetical_result', compact('partners', 'categories', 'letter'));
    }

    public function category(Request $request, $name)
    {
        $category = PartnerCategory::where('name', $name)->firstOrFail();

        if ($request->input('sortBy') !== 'popularity') $partners = Partner::where('suspended', false)
            ->where('category_id', $category->id)
            ->paginate(9);
        else $partners = Partner::where('suspended', false)
            ->withCount('giftCards')
            ->orderBy('gift_cards_count', 'desc')
            ->paginate(9);

        $categories = PartnerCategory::all();

        return view('new_client_site.pages.category', compact('partners', 'categories', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $categoryId = $request->input('category'); // Récupère l'ID de la catégorie s'il est fourni

        $partners = Partner::where(function ($query) use ($keyword, $categoryId) {
            // Filtrer par mot-clé
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('tags', 'like', "%{$keyword}%")
                ->orWhereHas('category', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });

            // Filtrer par catégorie si un ID de catégorie est fourni
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }
        })
            ->where('suspended', false) // Toujours filtrer pour exclure les partenaires suspendus
            ->paginate(9);

        $categories = PartnerCategory::all();

        return view('new_client_site.pages.partners.search', compact('partners', 'categories', 'keyword', 'categoryId'));
    }


    public function profile($slug)
    {
        $partner = Partner::where('suspended', false)
            ->where('slug', $slug)
            ->firstOrFail();
        $categories = PartnerCategory::all();

        return view('new_client_site.pages.partner_show', compact('partner', 'categories'));
    }

    public function orderingPage($slug)
    {
        $partner = Partner::where('slug', $slug)->firstOrFail();
        $categories = PartnerCategory::all();
        $shippings = Shipping::all();

        $settings = DB::table('gift_card_settings')->first();
        $customization_fee = $settings ? $settings->customization_fee : 0;

        return view('new_client_site.pages.ordering_page', compact('partner', 'categories', 'shippings', 'customization_fee'));
    }
}
