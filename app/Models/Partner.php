<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'short_description',
        'description',
        'phone_number',
        'email',
        'adress',
        'offers',
        'tags',
        'min_amount',
        'commission_percent',
        'picture_1',
        'picture_2',
        'picture_3',
        'picture_4',
    ];

    /**
     * Get all of the gift_card for the Partner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function giftCards(): HasMany
    {
        return $this->hasMany(GiftCard::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id', 'id');
    }


    /**
     * Interact with the partner's tags.
     */
    protected function tags(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                $tags = '';

                $separate_sections = explode(',', $value);
                foreach ($separate_sections as $key => $tag) {
                    $tags .= trim($tag);
                    if ($key + 1  != count($separate_sections)) $tags  .= ', ';
                }
                return $tags;
            },
        );
    }
}
