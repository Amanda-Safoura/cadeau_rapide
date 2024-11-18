<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMessageController extends Controller
{
    public function index()
    {
        $datas = UserMessage::all();
        return view('backoffice.pages.user_message.index', compact('datas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('client.contact')
                ->withErrors($validator)
                ->withInput();
        }

        $user_message = UserMessage::create($validator->validated());

        // Récupérer l'utilisateur qui a effectué la soumission
        $userName = $user_message->name;

        // Création du log personnalisé avec l'auteur de la soumission (utilisateur)
        CustomLog::create([
            'content' => "L'utilisateur {$userName} a soumis un message via le formulaire de contact. Sujet: {$request->input('subject')}",
            'color' => 'primary', // couleur de la notification
            'icon' => 'fas fa-comment', // icône pour la notification
        ]);

        return redirect()->back()->with('message', "Nous répondrons le plus rapidement possible à votre message.");
    }

    public function changeReadStatus(Request $request)
    {
        $instance = UserMessage::findOrFail($request->input('id'));
        $instance->read = $request->input('read') == 'true' ? 1 : 0;
        $instance->save();

        // Récupérer l'admin qui a effectué la modification
        $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

        // Création du log personnalisé avec l'auteur de la modification (admin)
        CustomLog::create([
            'content' => "L'admin {$adminName} a marqué le message de l'utilisateur #{$instance->name} comme " . ($instance->read ? 'lu' : 'non lu') . ".",
            'color' => 'warning', // couleur de la notification
            'icon' => 'fas fa-envelope-open', // icône pour la notification
        ]);


        return response()->json();
    }
}
