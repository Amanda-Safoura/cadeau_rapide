<?php

namespace App\Http\Controllers\BackOffice;

use App\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomLog;
use PDF;
use App\Models\GiftCard;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class GiftCardController extends Controller
{
    public function index()
    {
        $datas = GiftCard::all();
        return view('backoffice.pages.gift_card.index', compact('datas'));
    }

    public function show($id)
    {
        $gift_card = GiftCard::with('paymentInfo')->findOrFail($id);

        $payment = $gift_card->paymentInfo;
        if (!$payment->status && $payment->payment_network) {
            CustomHelpers::getPaymentStatus($payment);
        }

        return view('backoffice.pages.gift_card.show', compact('gift_card'));
    }

    public function to_deliver()
    {
        $datas = GiftCard::with('paymentInfo')->get();
        return view('backoffice.pages.gift_card.to_deliver', compact('datas'));
    }

    public function change_delivery_status(Request $request)
    {
        $request->validate([
            'orderId' => 'required|numeric|exists:gift_cards,id',
            'newStatus' => 'required|in:awaiting processing,pending,delivered',
        ]);

        $gift_card = GiftCard::findOrFail($request->input('orderId'));
        $gift_card->shipping_status = $request->input('newStatus');
        $gift_card->save();

        // Récupérer l'admin qui a effectué la modification
        $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;
        $statutLivraison = $gift_card->getTranslatedShippingStatus();

        // Création du log personnalisé avec l'auteur de la modification (admin)
        CustomLog::create([
            'content' => "L'admin {$adminName} a modifié le statut de livraison du chèque cadeau #{$gift_card->id} à : {$statutLivraison}.",
            'color' => 'warning', // couleur de la notification
            'icon' => 'fas fa-truck', // icône pour la notification
        ]);

        return response()->json();
    }


    public function check(int $gift_card_id)
    {
        $gift_card = GiftCard::find($gift_card_id);

        if ($gift_card) {
            $payment = $gift_card->paymentInfo;
            if (!$payment->status && $payment->payment_network) {
                CustomHelpers::getPaymentStatus($payment);
            }

            if ($gift_card->isValid())
                return view('new_client_site.pages.check_validity.is_valid', ['gift_card' => $gift_card]);
        }


        return view('new_client_site.pages.check_validity.is_invalid');
    }


    public function generateGiftCard(int $id)
    {
        // Récupérer le chèque cadeau avec ses informations de paiement
        $gift_card = GiftCard::with('paymentInfo')->findOrFail($id);

        // Vérifier si le paiement a été effectué avec succès
        if ($gift_card->paymentInfo->status == 'SUCCESSFUL') {

            $options = new QROptions([
                'scale' => 1,
                'imageBase64' => true
            ]);

            $qrCode = new QRCode($options);
            $qrCodeBase64 = $qrCode->render(route('client.gift_card.check', ['gift_card_id' => $gift_card->id]));

            // Chargement de la vue et génération du PDF
            $pdf = PDF::loadView('to_generate.gift_card', compact('gift_card', 'qrCodeBase64'))
                ->setPaper('a4', 'landscape'); // Désactiver les avertissements

            // Retourner le fichier PDF en téléchargement
            return $pdf->download("Chèque_Cadeau_{$gift_card->id}.pdf");
        } else {
            // Rediriger avec un message si le paiement n'est pas réussi
            return redirect()->back()->with('message', 'Le chèque cadeau n\'a pas été payé');
        }
    }


    public function generateAndSendGiftCard(int $id)
    {
        $gift_card = GiftCard::with('partner')->findOrFail($id);

        $options = new QROptions([
            'scale' => 1,
            'imageBase64' => true
        ]);

        $qrCode = new QRCode($options);
        $qrCodeBase64 = $qrCode->render(route('client.gift_card.check', ['gift_card_id' => $gift_card->id]));

        // Générer le PDF
        $pdfContent = PDF::loadView('to_generate.gift_card', compact('gift_card', 'qrCodeBase64'))
            ->setPaper('a4', 'landscape')
            ->output();

        // Déterminer l'adresse email du destinataire
        $email = $gift_card->is_client_beneficiary
            ? $gift_card->client_email
            : $gift_card->beneficiary_email;

        // Vérifier si l'email est valide
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Adresse email invalide pour le chèque cadeau N° {$gift_card->id}");
        }

        try {
            // Envoyer l'email avec le PDF
            Mail::send('mails.gift_card', compact('gift_card'), function ($message) use ($email, $pdfContent, $gift_card) {
                $message->to($email)
                    ->subject("Votre chèque cadeau")
                    ->attachData($pdfContent, "Chèque Cadeau N° {$gift_card->id}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
            });

            // Mettre à jour le statut du chèque cadeau
            $gift_card->sent = true;
            $gift_card->save();
        } catch (Exception $e) {
            CustomLog::error("Erreur lors de l'envoi du chèque cadeau : " . $e->getMessage());
            throw $e;
        }
    }


    public function settings()
    {
        $settings = DB::table('gift_card_settings')->first();
        return view('backoffice.pages.gift_card.settings', compact('settings'));
    }

    public function update_settings(Request $request)
    {
        $request->validate([
            'customization_fee' => 'required|numeric|min:0',
            'validity_duration' => 'required|numeric|min:1',
        ]);

        $settings = DB::table('gift_card_settings')->first();

        if ($settings) {
            // Mettre à jour les réglages existants
            DB::table('gift_card_settings')->update($request->only('customization_fee', 'validity_duration'));


            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a mis à jour les réglages des chèques cadeaux.",
                'color' => 'warning', // couleur de la notification
                'icon' => 'fas fa-cogs', // icône pour la notification
            ]);
        } else {
            // Insérer les nouveaux réglages
            DB::table('gift_card_settings')->insert($request->only('customization_fee', 'validity_duration'));
        }
        return redirect()->route('dashboard.gift_card.settings');
    }
}
