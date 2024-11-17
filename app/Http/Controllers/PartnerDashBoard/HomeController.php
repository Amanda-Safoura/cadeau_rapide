<?php

namespace App\Http\Controllers\PartnerDashBoard;

use App\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePartnerProfileRequest;
use App\Models\GiftCard;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\PartnerMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function overview(Request $request)
    {
        $partnerId = $request->cookie('partner_id'); // Identifie le partenaire connecté.

        // Cartes - Indicateurs clés
        $totalOrders = GiftCard::where('partner_id', $partnerId)->count();
        $totalRevenue = GiftCard::where('partner_id', $partnerId)
            ->whereHas('paymentInfo', fn($query) => $query->where('status', 'SUCCESSFUL'))
            ->sum('total_amount');
        $deliveredOrders = GiftCard::where('partner_id', $partnerId)
            ->where('shipping_status', 'delivered')
            ->count();
        $pendingOrders = GiftCard::where('partner_id', $partnerId)
            ->where('shipping_status', 'pending')
            ->count();

        // Graphique - Commandes par mois
        $ordersByMonth = GiftCard::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('partner_id', $partnerId)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(fn($item) => [date('F', mktime(0, 0, 0, $item->month, 1)) => $item->count]);

        // Commandes récentes
        $recentOrders = GiftCard::where('partner_id', $partnerId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get(['id', 'client_name', 'amount', 'shipping_status', 'created_at']);

        return view('partner_backoffice.pages.overview', compact(
            'totalOrders',
            'totalRevenue',
            'deliveredOrders',
            'pendingOrders',
            'ordersByMonth',
            'recentOrders'
        ));
    }

    public function salesStatistics()
    {
        // Total des ventes
        $totalSales = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->where('status', 'SUCCESSFUL');
        })->count();

        // Revenu total généré
        $totalRevenue = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->where('status', 'SUCCESSFUL');
        })->sum('total_amount');

        // Montant moyen des chèques cadeaux
        $averageAmount = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->where('status', 'SUCCESSFUL');
        })->avg('total_amount');

        // Statistiques par statut de livraison
        $ordersByShippingStatus = GiftCard::select('shipping_status', DB::raw('count(*) as total'))
            ->whereHas('paymentInfo', function ($query) {
                $query->where('status', 'SUCCESSFUL');
            })
            ->groupBy('shipping_status')
            ->get();

        // Statistiques par mois
        $monthlySales = GiftCard::whereHas('paymentInfo', function ($query) {
            $query->where('status', 'SUCCESSFUL');
        })
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total_sales'), DB::raw('sum(total_amount) as total_revenue'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Convertir le numéro du mois en nom du mois
        $monthlySales = $monthlySales->map(function ($sale) {
            $sale->month_name = Carbon::create()->month($sale->month)->format('F'); // "January", "February", etc.
            return $sale;
        });

        return view('partner_backoffice.pages.sales_statistics', compact('totalSales', 'totalRevenue', 'averageAmount', 'ordersByShippingStatus', 'monthlySales'));
    }


    public function gift_card_index(Request $request)
    {
        $datas = GiftCard::where('partner_id', $request->cookie('partner_id'))->get();
        return view('partner_backoffice.pages.gift_card.index', compact('datas'));
    }

    public function gift_card_show(Request $request, $id)
    {
        $gift_card = GiftCard::with('paymentInfo')->findOrFail($id);

        if ($gift_card->partner_id != $request->cookie('partner_id'))
            return abort(404);

        $payment = $gift_card->paymentInfo;
        if (!$payment->status && $payment->payment_network) {
            CustomHelpers::getPaymentStatus($payment);
        }

        return view('partner_backoffice.pages.gift_card.show', compact('gift_card'));
    }


    public function gift_card_mark_as_used(Request $request, $id)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $instance = Partner::whereEmail($email)
            ->first();

        if ($instance && Hash::check($password, $instance->password)) {
            $gift_card = GiftCard::findOrFail($id);
            $gift_card->used = true;
            $gift_card->save();

            return view('new_client_site.pages.check_validity.is_invalid')->with('message', 'Le chèque cadeau vient d\'être marqué comme utilisé.');
        }

        return redirect()->back()->with(['message' => 'Identifiants incorrects']);
    }



    public function cash_entries(Request $request)
    {
        // Récupérer le partenaire
        $partner = Partner::findOrFail($request->cookie('partner_id'));

        // Récupérer les chèques cadeaux associés au partenaire avec statut "SUCCESSFUL"
        $giftCards = GiftCard::with(['paymentInfo'])
            ->where('partner_id', $request->cookie('partner_id'))
            ->where('used', true)
            ->whereHas('paymentInfo', function ($query) {
                $query->where('status', 'SUCCESSFUL');
            })
            ->get();

        // Calcul des informations résumées
        $summary = $giftCards->map(function ($giftCard) use ($partner) {
            return [
                'amount' => $giftCard->amount,
                'commission_rate' => $partner->commission_percent,
                'commission' => ($giftCard->amount * $partner->commission_percent) / 100,
                'delivery_date' => $giftCard->delivery_date->format('d/m/Y'),
            ];
        });

        // Statistiques globales pour ce partenaire
        $totalAmount = $giftCards->sum('amount');
        $totalCommission = $giftCards->sum(function ($giftCard) use ($partner) {
            return ($giftCard->amount * $partner->commission_percent) / 100;
        });
        $totalSold = $giftCards->count();

        return view('partner_backoffice.pages.finance.cash_entries', [
            'partner' => $partner,
            'summary' => $summary,
            'totalAmount' => $totalAmount,
            'totalCommission' => $totalCommission,
            'totalSold' => $totalSold,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function profile_edit(Request $request)
    {
        $partner = Partner::findOrFail($request->cookie('partner_id'));
        $partner_categories = PartnerCategory::all();

        return view('partner_backoffice.pages.auth.profile', compact('partner', 'partner_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function profile_update(UpdatePartnerProfileRequest $request)
    {
        $validated_inputs = $request->validationData();
        $validated_inputs['offers'] = $request->input('offers');
        $partner = Partner::findOrFail($validated_inputs['id']);

        $picture_1_old_file_path = '';
        $picture_2_old_file_path = '';
        $picture_3_old_file_path = '';
        $picture_4_old_file_path = '';
        $validated_inputs['picture_1'] = $partner->picture_1;
        $validated_inputs['picture_2'] = $partner->picture_2;
        $validated_inputs['picture_3'] = $partner->picture_3;
        $validated_inputs['picture_4'] = $partner->picture_4;

        if ($request->hasFile('picture_1')) {
            $picture_1_old_file_path = public_path($partner->picture_1);

            $picture_1_file = $request->file('picture_1');
            $validated_inputs['picture_1'] =
                $picture_1_file->store('Partners')
                ?? $validated_inputs['picture_1'];
        }

        if ($request->hasFile('picture_2')) {
            $picture_2_old_file_path = public_path($partner->picture_2);

            $picture_2_file = $request->file('picture_2');
            $validated_inputs['picture_2'] =
                $picture_2_file->store('Partners')
                ?? $validated_inputs['picture_2'];
        }


        if ($request->hasFile('picture_3')) {
            $picture_3_old_file_path = public_path($partner->picture_3);

            $picture_3_file = $request->file('picture_3');
            $validated_inputs['picture_3'] =
                $picture_3_file->store('Partners')
                ?? $validated_inputs['picture_3'];
        }

        if ($request->hasFile('picture_4')) {
            $picture_4_old_file_path = public_path($partner->picture_4);

            $picture_4_file = $request->file('picture_4');
            $validated_inputs['picture_4'] =
                $picture_4_file->store('Partners')
                ?? $validated_inputs['picture_4'];
        }


        if ($partner->update($validated_inputs)) {
            if ($request->hasFile('picture_4') && File::exists($picture_4_old_file_path))
                File::delete($picture_4_old_file_path);

            if ($request->hasFile('picture_3') && File::exists($picture_1_old_file_path))
                File::delete($picture_3_old_file_path);


            if ($request->hasFile('picture_2') && File::exists($picture_2_old_file_path))
                File::delete($picture_2_old_file_path);

            if ($request->hasFile('picture_1') && File::exists($picture_1_old_file_path))
                File::delete($picture_1_old_file_path);


            return response()->json([
                'message' => 'Votre profil a bien été édité',
            ], 200);
        } else {

            foreach ([$validated_inputs['picture_4'], $validated_inputs['picture_3'], $validated_inputs['picture_2'], $validated_inputs['picture_1']] as $file_path) {
                $uploaded_file_path = public_path($file_path);
                if (File::exists($uploaded_file_path)) {
                    File::delete($uploaded_file_path);
                }
            }
            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function suspense(Request $request)
    {
        $partner = Partner::findOrFail($request->input('id'));
        $partner->suspended = $request->input('suspended') == 'true' ? 1 : 0;
        $partner->save();

        return response()->json();
    }


    public function message_index(Request $request)
    {
        $datas = PartnerMessage::where('partner_id', $request->cookie('partner_id'))->get();
        return view('partner_backoffice.pages.contact_admin', compact('datas'));
    }

    public function message_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('partner.panel.message.index')
                ->withErrors($validator)
                ->withInput();
        }

        PartnerMessage::create(array_merge(
            $validator->validated(),
            ['partner_id' => $request->cookie('partner_id')]
        ));
        return redirect()->back()->with('message', "Votre message a bien été transféré aux admins.");
    }
}
