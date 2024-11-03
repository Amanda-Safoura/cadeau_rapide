<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gift_card_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('customization_fee')->default(0); // Montant fixe pour personnalisation
            $table->integer('validity_duration')->unsigned()->nullable(); // Durée de validité du chèque cadeau en mois
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_card_settings');
    }
};
