<?php

namespace Database\Factories;

use App\Models\PartnerCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerCategoryFactory extends Factory
{
    protected $model = PartnerCategory::class;

    public function definition()
    {
        return [
            'icon' => $this->faker->imageUrl(),
            'name' => $this->faker->word,
            'short_description' => $this->faker->sentence,
        ];
    }
}
