<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        // Types de modèles de mails à gérer
        $defaultTemplates = [
            'En attente de traitement' => 'Modèle par défaut pour les emails en attente de traitement.',
            'En cours' => 'Modèle par défaut pour les emails en cours de traitement.',
            'Livré' => 'Modèle par défaut pour les emails livrés.',
        ];

        // Vérifier et initialiser les modèles manquants
        foreach ($defaultTemplates as $type => $defaultContent) {
            EmailTemplate::firstOrCreate(
                ['type' => $type],
                ['content' => $defaultContent]
            );
        }

        // Récupérer tous les modèles existants
        $templates = EmailTemplate::all();

        return view('backoffice.pages.email_templates.index', compact('templates'));
    }

    public function edit($id)
    {
        $template = EmailTemplate::findOrFail($id);
        return view('backoffice.pages.email_templates.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = EmailTemplate::findOrFail($id);

        // Nettoyer les lignes vides inutiles
        $content = trim($request->input('content'));
        if ($content === '<p><br></p>' || $content === '') {
            $content = null; // Ou un contenu par défaut
        }

        $template->update([
            'content' => $content,
        ]);

        // Récupérer l'admin qui a effectué la modification
        $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

        // Création du log personnalisé avec l'auteur de la modification (admin)
        CustomLog::create([
            'content' => "L'admin {$adminName} a modifié le template : {ucfirst($template->type)}.",
            'color' => 'info', // couleur de la notification
            'icon' => 'fas fa-edit', // icône pour la notification
        ]);

        return redirect()->route('dashboard.email_templates.index')->with('message', 'Modèle {$template->type} mis à jour avec succès.');
    }
}
