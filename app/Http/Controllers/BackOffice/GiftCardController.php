<?php

namespace App\Http\Controllers\BackOffice;

use App\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\GiftCard;
use Dompdf\Dompdf;
use Dompdf\Options;
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
        $gift_card = GiftCard::with('paymentInfo')->findOrFail($id);

        if ($gift_card->paymentInfo->status == 'SUCCESSFUL') {
            // Configuration de Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);

            // Génération du contenu HTML et du PDF
            $partnerPicturePath = Storage::disk('public')->path($gift_card->partner->picture_1);
            $partnerPictureBase64 =
                'data:image/' .
                pathinfo($partnerPicturePath, PATHINFO_EXTENSION) .
                ';base64,' .
                base64_encode(file_get_contents($partnerPicturePath));

            $html = view('to_generate.gift_card', compact('gift_card', 'partnerPictureBase64'))->render();

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Enregistrer le fichier PDF
            $output = $dompdf->output();
            $filename = "Chèque_Cadeau_$gift_card->id.pdf";
            file_put_contents(storage_path("app/public/$filename"), $output);

            return response()->download(storage_path("app/public/$filename"));
        } else {
            return redirect()->back()->with('message', 'Le chèque cadeau n\'a pas été payée');
        }
    }


    public function generateAndSendGiftCard(int $id)
    {
        $gift_card = GiftCard::with('partner')->findOrFail($id);

        // Configuration de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Permettre les ressources externes
        $dompdf = new Dompdf($options);

        // Génération du contenu HTML et du PDF
        $html = view('to_generate.gift_card', compact('gift_card'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stocker le fichier PDF temporairement
        $pdfContent = $dompdf->output();
        $fileName = "Chèque Cadeau N° $gift_card->id.pdf";
        $tempPath = "temp/$fileName";
        Storage::disk('public')->put($tempPath, $pdfContent);

        // Envoyer l'email avec le PDF en pièce jointe
        Mail::send('mails.gift_card', compact('gift_card'), function ($message) use ($gift_card, $tempPath) {
            $message->to($gift_card->is_client_beneficiary
                ? $gift_card->client_email
                : $gift_card->beneficiary_email) // Adresse email du destinataire
                ->subject("Votre chèque cadeau")
                ->attach(Storage::path($tempPath), [
                    'as' => "Chèque Cadeau N° {$gift_card->id}.pdf",
                    'mime' => 'application/pdf',
                ]);
        });

        $gift_card->sent = true;
        $gift_card->save();

        // Supprimer le fichier temporaire après l'envoi de l'email
        Storage::delete($tempPath);
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
