<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

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
        return view('backoffice.pages.gift_card.show', compact('gift_card'));
    }

    public function generateGiftCard()
    {
        // Configurer Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Générer le contenu HTML pour le chèque cadeau
        $html = view('to_generate.gift_card')->render(); // Assurez-vous d'avoir une vue `gift_card.blade.php`

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // (Optionnel) Configurer le format en paysage
        $dompdf->setPaper('A4', 'landscape');

        // Rendre le PDF
        $dompdf->render();

        // Téléchargement du PDF
        return $dompdf->stream('cheque_cadeau.pdf', ['Attachment' => true]);
    }
}
