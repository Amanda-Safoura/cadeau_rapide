<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
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
        $request->validate([
            'content' => 'required|string',
        ]);

        $template = EmailTemplate::findOrFail($id);
        $template->update([
            'content' => $request->content,
        ]);

        return redirect()->route('dashboard.email_templates.index')->with('success', 'Modèle mis à jour avec succès.');
    }
}
