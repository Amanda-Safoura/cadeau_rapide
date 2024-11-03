<?php

namespace App\Console\Commands;

use App\Http\Controllers\BackOffice\GiftCardController;
use App\Models\GiftCard;
use Illuminate\Console\Command;

class SendGiftCardThroughMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gift-card:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie les chèques cadeau en PDF pour les paiements approuvés';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Récupère les commandes approuvées qui n'ont pas encore reçu le chèque
        $gift_cards = GiftCard::where('sent', false)->with('paymentInfo')->get();

        $giftCardController = new GiftCardController;
        foreach ($gift_cards as $order) {
            if ($order->paymentInfo->status == 'SUCCESSFUL')
                $giftCardController->generateAndSendGiftCard($order->id);
        }
    }
}
