<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $datas = User::whereHas('giftCards')->with('giftCards')->get();
        return view('backoffice.pages.customer.index', compact('datas'));
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);
        $datas = $customer->giftCards;
        return view('backoffice.pages.customer.show', compact('customer', 'datas'));
    }
}