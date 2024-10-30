<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\PartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:partner_categories,name',
        ]);

        if ($validator->fails())
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();


        $newest = PartnerCategory::create(['name' => $validator->validated()['name']]);
        if ($newest) {
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
    public function update(Request $request, PartnerCategory $partner_category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:partner_categories,name',
        ]);

        if ($validator->fails())
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();


        if ($partner_category->update(['name' => $validator->validated()['name']])) {
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
    public function destroy(PartnerCategory $partner)
    {
        //
    }
}
