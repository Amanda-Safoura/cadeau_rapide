<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    public function index()
    {
        $datas = GiftCard::all();
        return view('backoffice.pages.gift_card.index', compact('datas'));
    }

    public function show($id)
    {
        $gift_card = GiftCard::with('paymentInfo')->findOrFail($id);
        return view('backoffice.pages.gift_card.show', compact('gift_card'));
    }
}
