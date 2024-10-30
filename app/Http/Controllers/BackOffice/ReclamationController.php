<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Reclamation;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index()
    {
        $datas = Reclamation::with('user')->get();
        return view('backoffice.pages.reclamation.index', compact('datas'));
    }

    public function store(Request $request)
    {
        Reclamation::create([
            'user_id' => auth()->user()->id,
            'gift_card_id' => $request->input('gift_card_id'),
            'message' => $request->input('message')
        ]);

        return redirect()->back()->with('message', "Nous traiterons le plus rapidement possible votre réclamation.");
    }

    public function changeReadStatus(Request $request)
    {
        $instance = Reclamation::findOrFail($request->input('id'));
        $instance->read = $request->input('read') == 'true' ? 1 : 0;
        $instance->save();
        return response()->json();
    }
}
