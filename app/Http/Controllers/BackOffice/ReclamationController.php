<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\CustomLog;
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
        // Création de la réclamation
        Reclamation::create([
            'user_id' => auth()->user()->id,
            'gift_card_id' => $request->input('gift_card_id'),
            'message' => $request->input('message')
        ]);

        // Récupérer l'utilisateur qui a effectué la réclamation
        $userName = auth()->user()->name;

        // Création du log personnalisé avec l'auteur de la modification (utilisateur)
        CustomLog::create([
            'content' => "L'utilisateur {$userName} a soumis une réclamation concernant la chèque cadeau #{$request->input('gift_card_id')}.",
            'color' => 'info', // couleur de la notification
            'icon' => 'fas fa-exclamation-circle', // icône pour la notification
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
