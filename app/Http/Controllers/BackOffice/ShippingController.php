<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingRequest;
use App\Http\Requests\UpdateShippingRequest;
use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\Shipping;
use Illuminate\Http\Request;

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
            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a créé une nouvelle adresse de livraison pour la commande #{$validated_inputs['gift_card_id']}.",
                'color' => 'primary', // couleur de la notification
                'icon' => 'fas fa-map-marker-alt', // icône pour la notification
            ]);


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
            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a modifié l'adresse de livraison pour la commande #{$shipping->gift_card_id}.",
                'color' => 'warning', // couleur de la notification
                'icon' => 'fas fa-edit', // icône pour la notification
            ]);


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
    public function destroy(Shipping $shipping, Request $request)
    {
        if ($shipping->delete()) {
            // Récupérer l'admin qui a effectué la suppression
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a supprimé l'adresse de livraison pour la commande #{$shipping->gift_card_id}.",
                'color' => 'danger', // couleur de la notification
                'icon' => 'fas fa-trash', // icône pour la notification
            ]);


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
