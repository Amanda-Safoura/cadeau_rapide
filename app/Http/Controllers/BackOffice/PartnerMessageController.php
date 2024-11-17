<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\PartnerMessage;
use Illuminate\Http\Request;

class PartnerMessageController extends Controller
{
    public function index()
    {
        $datas = PartnerMessage::with('partner')->get();
        return view('backoffice.pages.partner_message.index', compact('datas'));
    }

    public function changeReadStatus(Request $request)
    {
        $instance = PartnerMessage::findOrFail($request->input('id'));
        $instance->read = $request->input('read') == 'true' ? 1 : 0;
        $instance->save();

        // Récupérer l'admin qui a effectué la modification
        $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

        // Création du log personnalisé avec l'auteur de la modification (admin)
        CustomLog::create([
            'content' => "L'admin {$adminName} a marqué le message du partenaire #{$instance->partner->name} comme " . ($instance->read ? 'lu' : 'non lu') . ".",
            'color' => 'info', // couleur de la notification
            'icon' => 'fas fa-envelope-open', // icône pour la notification
        ]);

        return response()->json();
    }
}
