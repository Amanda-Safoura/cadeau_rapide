<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\PartnerCategory::factory()->count(5)->create();
        \App\Models\Partner::factory()->count(10)->create();
        \App\Models\GiftCard::factory()->count(20)->create();
        \App\Models\PaymentInfo::factory()->count(20)->create();
        \App\Models\Shipping::factory()->count(5)->create();
    }
}
