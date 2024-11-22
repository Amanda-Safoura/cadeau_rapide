<?php

namespace App\Http\Controllers\Api;

use App\Events\NewFeexPaymentPayloadEvent;
use App\Http\Controllers\BackOffice\GiftCardController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\CustomLog;
use App\Models\GiftCard;
use App\Models\Partner;
use App\Models\PaymentInfo;
use Feexpay\FeexpayPhp\FeexpayClass;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function storeGiftCard(StoreOrderRequest $request)
    {
        $new_gift_card = null;
        $new_payment_info = null;
        if ($new_gift_card = GiftCard::create($request->only(
            'user_id',
            'amount',
            'personal_message',
            'client_name',
            'client_email',
            'client_phone',
            'is_client_beneficiary',
            'beneficiary_name',
            'beneficiary_email',
            'beneficiary_phone',
            'is_customized',
            'customization_fee',
            'delivery_address',
            'delivery_date',
            'delivery_contact',
            'validity_duration',
            'shipping_zone',
            'shipping_price',
            'partner_id',
            'total_amount'
        ))) {

            // Récupérer l'utilisateur qui a effectué la commande
            $userName = auth()->user()->name;

            // Log de création de la chèque cadeau par l'utilisateur
            CustomLog::create([
                'content' => "L'utilisateur {$userName} a créé un nouveau chèque cadeau pour un montant de {$new_gift_card->amount}.",
                'color' => 'info',
                'icon' => 'fas fa-gift',
            ]);
            $infos_from_request = $request->only(
                'payment_phone',
                'payment_network',
                'payment_otp',
                'cardType',
                'firstNameCard,',
                'lastNameCard',
                'emailCard',
                'countryCard',
                'addressCard',
                'districtCard',
                'currency',
            );

            if ($new_payment_info = PaymentInfo::create(array_merge($infos_from_request, ['gift_card_id' => $new_gift_card->id]))) {

                $new_gift_card->payment_info_id = $new_payment_info->id;
                $new_gift_card->save();

                $partner = Partner::findOrFail($new_gift_card->partner_id);
                // Initialiser le SDK
                $skeleton = new FeexpayClass(env('FEEXPAY_SHOP_ID'), env('FEEXPAY_TOKEN_KEY_API'), route('client.partner.ordering_page', ['slug' => $partner->slug]), "LIVE", "");

                // Déterminer le mode de paiement
                $network = $new_payment_info->payment_network;
                $amount = $new_gift_card->amount;
                $phone = $new_payment_info->payment_phone;
                $otp = $new_payment_info->payment_network === 'ORANGE SN' ? $new_payment_info->payment_otp : '';


                if ($network)
                    // Log pour le réseau de paiement
                    CustomLog::create([
                        'content' => "L'utilisateur {$userName} a lancé un paiement de {$amount} via {$network}.",
                        'color' => 'primary',
                        'icon' => 'fas fa-wallet',
                    ]);
                else
                    // Log pour le réseau de paiement
                    CustomLog::create([
                        'content' => "L'utilisateur {$userName} a lancé un paiement de {$amount} par carte bancaire.",
                        'color' => 'primary',
                        'icon' => 'fas fa-credit-card',
                    ]);


                // Traitement du paiement mobile
                if (in_array($network, ['MTN', 'MOOV', 'MOOV TG', 'TOGOCOM TG', 'ORANGE SN', 'MTN CI'])) {
                    $response = $skeleton->paiementLocal($amount, $phone, $network, $new_gift_card->client_name, $new_gift_card->client_email, '', '', $otp);

                    $new_payment_info->reference = $response;
                    $new_payment_info->save();

                    return redirect()->back()->with('message', 'Veuillez consulter votre téléphone. Une requête de paiement vient d\'être émise. <br><br><span class="text-danger">P.S: Assurez-vous d\'avoir suffisamment de fonds. Auquel cas, vous ne recevrez pas de requête de paiement.</span>');
                }
                // Traitement du paiement web
                elseif (in_array($network, ['FREE SN', 'ORANGE CI', 'MOOV CI', 'WAVE CI', 'MOOV BF', 'ORANGE BF'])) {
                    $response = $skeleton->requestToPayWeb($amount, $phone, $network, $new_gift_card->client_name, $new_gift_card->client_email, 'cancel_url', 'return_url');
                    $reference = $response["reference"];

                    $new_payment_info->reference = $reference;
                    $new_payment_info->save();

                    return redirect($response['payment_url']);
                }
                // Traitement du paiement par carte bancaire
                elseif ($request->has('card_number')) {
                    $responseCard = $skeleton->paiementCard($amount, $phone, $new_payment_info->cardType, $new_payment_info->firstNameCard, $new_payment_info->lastNameCard,  $new_payment_info->emailCard, $new_payment_info->countryCard, $new_payment_info->addressCard, $new_payment_info->districtCard, $new_payment_info->currency, 'callback_info_url', '');
                    $redirectUrl = $responseCard["url"];

                    if (isset($redirectUrl)) {
                        return redirect()->to($redirectUrl);
                    }
                    return redirect()->back()->with('message', 'Erreur lors du traitement du paiement par carte.');
                }
                // Si aucun mode de paiement valide n'est trouvé
                else {
                    return redirect()->back()->with('message', 'Veuillez vérifier vos informations de paiement.');
                }
            }
        }

        return redirect()->back()->with('message', 'Erreur lors du traitement de la commande.');
    }


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

            $message = 'Votre paiement pour un chèque cadeau d\'une valeur de ' . number_format($gift_card->amount, '0', '', ' ') . ' XOF pour ' . ($gift_card->is_client_beneficiary ? 'vous-même' : '' . $gift_card->beneficiary_name) . ' ' . $statusMessage . '<br>Demande effectuée le ' . $gift_card->created_at->format('d F Y');

            NewFeexPaymentPayloadEvent::dispatch($message, $gift_card->user->id);

            if ($payment->status == 'SUCCESSFUL') {
                $giftCardController = new GiftCardController;
                $giftCardController->generateAndSendGiftCard($gift_card->id);
            }
        }

        return response()->json();
    }
}
