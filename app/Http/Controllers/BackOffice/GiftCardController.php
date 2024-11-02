<?php

namespace App\Http\Controllers\BackOffice;

use App\CustomHelpers;
use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
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

    public function generateAndSendGiftCard(int $id)
    {
        $gift_card = GiftCard::with('partner')->findOrFail($id);

        if ($gift_card->paymentInfo->status == 'SUCCESSFUL') {

            // Configuration de Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true); // Permettre les ressources externes
            $dompdf = new Dompdf($options);

            // Génération du contenu HTML et du PDF
            $html = view('to_generate.gift_card', compact('gift_card'))->render();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A5', 'landscape');
            $dompdf->render();

            // Stocker le fichier PDF temporairement
            $pdfContent = $dompdf->output();
            $fileName = "Chèque Cadeau N° $gift_card->id.pdf";
            $tempPath = "temp/$fileName";
            Storage::disk('public')->put($tempPath, $pdfContent);

            // Envoyer l'email avec le PDF en pièce jointe
            Mail::send('mails.gift_card', compact('gift_card'), function ($message) use ($gift_card, $tempPath) {
                $message->to('destinataire@example.com') // Remplacez par l'adresse email du destinataire
                    ->subject("Votre chèque cadeau")
                    ->attach(Storage::path($tempPath), [
                        'as' => "Chèque Cadeau N° {$gift_card->id}.pdf",
                        'mime' => 'application/pdf',
                    ]);
            });

            // Supprimer le fichier temporaire après l'envoi de l'email
            Storage::delete($tempPath);
        } else {
            return redirect()->back()->with('message', 'Le chèque cadeau n\'a pas été payée');
        }
    }
}
