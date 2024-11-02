<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'personal_message',
        'user_id',
        'client_name',
        'client_email',
        'client_phone',
        'is_client_beneficiary',
        'beneficiary_name',
        'beneficiary_email',
        'beneficiary_phone',
        'is_customized',
        'customization_fee',
        'requires_delivery',
        'delivery_address',
        'delivery_date',
        'shipping_id',
        'total_amount',
        'partner_id',
        'payment_info_id'
    ];

    /**
     * Récupérer le partenaire associé à la GiftCard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Récupérer le client/utilisateur ayant commandé la GiftCard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the shipping that owns the GiftCard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }


    /**
     * Get the PaymentInfo associated with the GiftCard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentInfo(): BelongsTo
    {
        return $this->belongsTo(PaymentInfo::class);
    }


    /**
     * Récupérer les informations relatives à la livraison de la GiftCard
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function giftCardShipping(): HasOne
    {
        return $this->hasOne(GiftCardShipping::class);
    }
}
