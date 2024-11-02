<?php

namespace App;

use App\Models\PaymentInfo;
use Exception;

class CustomHelpers
{
    public static function extractLines(string $inputText): array
    {
        // Transformation du texte en tableau, chaque ligne devenant un élément
        $inputTextArray = explode("\n", $inputText);

        // Filtrage des lignes vides ou contenant uniquement des espaces
        $lines = array_filter(array_map('trim', $inputTextArray), function ($line) {
            return !empty($line);
        });

        return array_values($lines); // Réinitialisation des clés du tableau
    }

    public static function getPaymentStatus(PaymentInfo $paymentInfo)
    {
        $reference = $paymentInfo->reference ?? '';
        $url = "https://api.feexpay.me/api/transactions/public/single/status/$reference";

        $ch = curl_init($url);
        if ($ch === false) {
            throw new Exception('Erreur lors de l\'initialisation de la session cURL');
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('FEEXPAY_TOKEN_KEY_API'),
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception("Erreur cURL : $error");
        }

        curl_close($ch);

        $responseData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
        }

        // Mettre à jour le statut et sauvegarder
        if (isset($responseData['status'])) {
            $paymentInfo->status = $responseData['status'];
            $paymentInfo->save();
        }
    }
}
