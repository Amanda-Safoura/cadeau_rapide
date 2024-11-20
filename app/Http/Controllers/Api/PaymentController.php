<?php

namespace App\Http\Controllers\Api;

use App\Events\NewFeexPayPaymentPayloadEvent;
use App\Http\Controllers\Controller;
use App\Models\PaymentInfo;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handle_webhook(Request $request)
    {
        if ($payment = PaymentInfo::where('reference', $request->input('reference'))->firstOrFail()) {
            $payment->status = $request->input('status');
            $payment->save();

            $statusMessage = '';
            switch ($payment->status) {
                case 'SUCCESSFUL':
                    $statusMessage = 'a bien été reçu.';
                    break;

                case 'FAILED':
                    $statusMessage = 'a échoué. Veuillez réésayer.';
                    break;

                default:
                    $statusMessage = 'est en cours d\'évaluation.';
                    break;
            }


            $gift_card = $payment->giftCard;

            $message = 'Votre paiement pour un chèque cadeau d\'une valeur de ' . $gift_card->amount . ' XOF pour ' . ($gift_card->is_client_beneficiary ? 'vous-même' : '' . $gift_card->beneficiary_name) . ' ' . $statusMessage . '<br>Demande effectué à ' . $gift_card->created_at->format('d F Y');

            NewFeexPayPaymentPayloadEvent::dispatch($message);
        }

        return response();
    }
}
