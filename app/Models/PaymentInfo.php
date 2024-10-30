<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
