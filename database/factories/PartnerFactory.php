<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\PartnerCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'category_id' => PartnerCategory::factory(),
            'picture_1' => $this->faker->imageUrl(),
            'picture_2' => $this->faker->imageUrl(),
            'picture_3' => $this->faker->imageUrl(),
            'picture_4' => $this->faker->imageUrl(),
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'phone_number' => $this->faker->numerify('+###-###-####'),
            'email' => $this->faker->unique()->safeEmail,
            'adress' => $this->faker->address,
            'offers' => $this->faker->text,
            'tags' => $this->faker->words(3, true),
            'min_amount' => $this->faker->numberBetween(10, 1000),
            'commission_percent' => $this->faker->numberBetween(1, 100),
            'suspended' => $this->faker->boolean,
        ];
    }
}
