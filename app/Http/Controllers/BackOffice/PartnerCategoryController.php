<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerCategoryRequest;
use App\Http\Requests\UpdatePartnerCategoryRequest;
use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\PartnerCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PartnerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backoffice.pages.partner_category.index');
    }

    public function fetch_resource()
    {
        return response()->json(['data' => PartnerCategory::all()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerCategoryRequest $request)
    {
        $newest = PartnerCategory::create($request->validated());
        if ($newest) {

            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a créé une nouvelle catégorie de partenaire : {$newest->name}.",
                'color' => 'primary', // couleur de la notification
                'icon' => 'fas fa-tag', // icône pour la notification
            ]);


            return response()->json(['message' => 'Catégorie créé avec succès'], 200);
        } else {
            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PartnerCategory $partner_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartnerCategory $partner_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerCategoryRequest $request, PartnerCategory $partner_category)
    {
        if ($partner_category->update($request->validated())) {

            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a modifié la catégorie de partenaire : {$partner_category->name}.",
                'color' => 'warning', // couleur de la notification
                'icon' => 'fas fa-edit', // icône pour la notification
            ]);


            return response()->json([
                'message' => 'Catégorie modifié avec succès',
            ], 200);
        } else {
            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $categoryId)
    {
        $category = PartnerCategory::findOrFail($categoryId);

        try {
            // Vérifiez si des partenaires sont liés à cette catégorie
            if ($category->partners()->exists()) {
                return redirect()->back()->withErrors([
                    'error' => 'Impossible de supprimer cette catégorie car des partenaires y sont associés.'
                ]);
            }

            // Supprime la catégorie
            $category->delete();

            return redirect()->route('partner_categories.index')
                ->with('success', 'La catégorie a été supprimée avec succès.');
        } catch (Exception $e) {
            // En cas d'erreur
            return redirect()->back()->withErrors([
                'error' => 'Une erreur est survenue lors de la suppression : ' . $e->getMessage()
            ]);
        }
    }
}
