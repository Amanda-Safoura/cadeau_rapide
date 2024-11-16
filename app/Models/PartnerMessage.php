<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'subject',
        'message',
        'read'
    ];

    /**
     * Get the partner that owns the PartnerMessage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
