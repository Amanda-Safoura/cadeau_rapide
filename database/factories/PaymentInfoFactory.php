<?php

namespace Database\Factories;

use App\Models\PaymentInfo;
use App\Models\GiftCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentInfoFactory extends Factory
{
    protected $model = PaymentInfo::class;

    public function definition()
    {
        return [
            'gift_card_id' => GiftCard::factory(),
            'payment_phone' => $this->faker->phoneNumber,
            'payment_network' => $this->faker->word,
            'payment_otp' => $this->faker->word,
            'cardType' => $this->faker->word,
            'firstNameCard' => $this->faker->firstName,
            'lastNameCard' => $this->faker->lastName,
            'emailCard' => $this->faker->email,
            'countryCard' => $this->faker->country,
            'addressCard' => $this->faker->address,
            'districtCard' => $this->faker->word,
            'status' => $this->faker->word,
            'reference' => $this->faker->uuid,
            'currency' => $this->faker->randomElement(['XOF', 'USD', 'EUR']),
        ];
    }
}
