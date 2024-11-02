<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardShipping extends Model
{
    use HasFactory;

    protected $fillable = ['gift_card_id'];

    protected $guard = ['status', 'validity_duration', 'start_date'];
}
