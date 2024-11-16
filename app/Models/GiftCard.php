<?php

namespace App\Models;

use Carbon\Carbon;
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
        'delivery_address',
        'delivery_date',
        'delivery_contact',
        'shipping_id',
        'shipping_status',
        'shipping_zone',
        'shipping_price',
        'sent',
        'validity_duration',
        'total_amount',
        'used',
        'partner_id',
        'payment_info_id'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery_date' => 'datetime',
    ];


    // Accessor pour obtenir la date d'expiration
    public function getExpirationDateAttribute()
    {
        $start_date = $this->delivery_date;
        return Carbon::parse($start_date)->addMonths($this->validity_duration);
    }

    // Méthode pour vérifier si la date d'expiration n'est pas passée
    public function isNotExpired()
    {
        return $this->expiration_date->isFuture(); // Retourne true si la date est dans le futur
    }

    public function isValid(): bool
    {
        return $this->isNotExpired() && $this->paymentInfo->status === "SUCCESSFUL" && !$this->used;
    }

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
}
