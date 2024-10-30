<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\PaymentInfo;
use Illuminate\Http\Request;

class CronJobController extends Controller
{
    public function getPaymentStatus()
    {
        foreach (
            PaymentInfo::whereNotNull('payment_network')
                ->whereNotIn('status', ['FAILED', 'SUCCESSFUL']) as $payment
        ) {

            // Définir l'URL avec la référence
            $reference = $payment->reference;
            $url = "https://api.feexpay.me/api/transactions/public/single/status/$reference";

            // Initialiser la session cURL
            $ch = curl_init($url);

            // Définir les options de la requête
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . env('FEEXPAY_TOKEN_KEY_API'),
                'Content-Type: application/json'
            ]);

            // Exécuter la requête et récupérer la réponse
            $response = curl_exec($ch);

            // Vérifier les erreurs
            if (curl_errno($ch)) {
                /* $result = [
                    'result' => 'Erreur cURL : ' . curl_error($ch),
                    'codeStatus' => 500
                ]; */
            } else {
                $payment->status = $response['status'];
                //$result = ['result' => $response, 'codeStatus' => 200];
            }

            // Fermer la session cURL
            curl_close($ch);
        }
    }
}
