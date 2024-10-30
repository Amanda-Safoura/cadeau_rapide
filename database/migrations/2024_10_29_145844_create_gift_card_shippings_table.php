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
        Schema::create('gift_card_shippings', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('gift_card_id')->unsigned();
            $table->foreign('gift_card_id')->references('id')->on('gift_cards')->onDelete('cascade');

            $table->enum('status', ['awaiting processing','pending', 'delivered'])->default('awaiting processing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_card_shippings');
    }
};
