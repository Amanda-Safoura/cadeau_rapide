<?php

namespace Database\Factories;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingFactory extends Factory
{
    protected $model = Shipping::class;

    public function definition()
    {
        return [
            'zone' => $this->faker->word,
            'price' => $this->faker->numberBetween(1, 100),
        ];
    }
}
