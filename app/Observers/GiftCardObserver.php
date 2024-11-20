<?php

namespace App\Observers;

use App\Models\EmailTemplate;
use App\Models\GiftCard;
use Illuminate\Support\Facades\Mail;

class GiftCardObserver
{
    /**
     * Handle the GiftCard "created" event.
     */
    public function created(GiftCard $giftCard)
    {
        // Si le statut est défini dès la création
        if ($giftCard->shipping_status) {
            $this->handleShippingStatusChange($giftCard);
        }
    }

    /**
     * Handle the GiftCard "updated" event.
     */
    public function updated(GiftCard $giftCard)
    {
        // Si le statut a changé lors de la mise à jour
        if ($giftCard->isDirty('shipping_status')) {
            $this->handleShippingStatusChange($giftCard);
        }
    }

    /**
     * Gère le changement de statut et l'envoi de l'e-mail.
     */
    private function handleShippingStatusChange(GiftCard $giftCard)
    {
        $recipient = $giftCard->is_client_beneficiary ? $giftCard->client_email : $giftCard->beneficiary_email;
        $template = EmailTemplate::where('type', $giftCard->getTranslatedShippingStatus())->first();

        $data = [
            'name' =>  $giftCard->is_client_beneficiary ? $giftCard->client_name : $giftCard->beneficiary_name,
            'giftCard' => $giftCard,
            'mail_content' => $template->content ?? 'Le statut de votre commande pour le chèque cadeau #' . $giftCard->id . ' a été modifié. Elle est à présent `' . $giftCard->getTranslatedShippingStatus() . '`',
        ];

        // Envoi d'un e-mail
        Mail::send("mails.gift_cards_shipping", $data, function ($message) use ($recipient, $giftCard) {
            $message->to($recipient)->subject('Mise à jour de votre commande de chèque cadeau #' . $giftCard->id);
        });
    }
}
