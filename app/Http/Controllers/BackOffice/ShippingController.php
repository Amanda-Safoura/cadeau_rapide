<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingRequest;
use App\Http\Requests\UpdateShippingRequest;
use App\Models\Shipping;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backoffice.pages.shipping.index');
    }

    public function fetch_resource()
    {
        return response()->json(['data' => Shipping::all()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backoffice.pages.shipping.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRequest $request)
    {
        $validated_inputs = $request->validated();

        $newest = Shipping::create($validated_inputs);
        if ($newest) {
            return response()->json(['message' => 'Adresse de livraison créé avec succès'], 200);
        } else {
            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
        $validated_inputs = $request->validated();

        if ($shipping->update($validated_inputs)) {
            return response()->json([
                'message' => 'Adresse de livraison modifié avec succès',
            ], 200);
        } else {

            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipping $shipping)
    {

        if ($shipping->delete()) {
            return response()->json([
                'message' => 'Adresse de livraison supprimé avec succès',
            ], 200);
        } else {

            return response()->json([
                'message' => 'Une erreur est survenue',
            ], 500);
        }
    }
}
