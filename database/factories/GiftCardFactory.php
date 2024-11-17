<?php

namespace Database\Factories;

use App\Models\GiftCard;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiftCardFactory extends Factory
{
    protected $model = GiftCard::class;

    public function definition()
    {
        return [
            'partner_id' => Partner::factory(),
            'amount' => $this->faker->numberBetween(10, 500),
            'personal_message' => $this->faker->sentence,
            'user_id' => User::factory(),
            'client_name' => $this->faker->name,
            'client_email' => $this->faker->unique()->safeEmail,
            'client_phone' => $this->faker->phoneNumber,
            'is_client_beneficiary' => $this->faker->boolean,
            'beneficiary_name' => $this->faker->name,
            'beneficiary_email' => $this->faker->unique()->safeEmail,
            'beneficiary_phone' => $this->faker->phoneNumber,
            'is_customized' => $this->faker->boolean,
            'customization_fee' => $this->faker->numberBetween(0, 100),
            'delivery_address' => $this->faker->address,
            'delivery_date' => $this->faker->date(),
            'delivery_contact' => $this->faker->phoneNumber,
            'sent' => $this->faker->boolean,
            'validity_duration' => $this->faker->numberBetween(1, 365),
            'shipping_status' => 'awaiting processing',
            'shipping_zone' => 'N/A',
            'shipping_price' => $this->faker->numberBetween(0, 50),
            'total_amount' => $this->faker->numberBetween(10, 500),
            'used' => $this->faker->boolean,
            'payment_info_id' => null, // Set to null if no payment info is provided
        ];
    }
}
