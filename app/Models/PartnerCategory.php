<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    /**
     * Get all of the partners for the PartnerCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class, 'category_id');
    }
}
