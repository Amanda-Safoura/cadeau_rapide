<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'gift_card_id',
        'payment_phone',
        'payment_network',
        'payment_otp',
        'cardType',
        'firstNameCard',
        'lastNameCard',
        'emailCard',
        'countryCard',
        'addressCard',
        'districtCard',
        'currency',
        'status',
        'reference'
    ];


    /**
     * Get the GiftCard associated with the PaymentInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function giftCard(): HasOne
    {
        return $this->hasOne(GiftCard::class);
    }
}
