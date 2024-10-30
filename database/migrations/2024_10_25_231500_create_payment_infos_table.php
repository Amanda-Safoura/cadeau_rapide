<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('gift_card_id')->unsigned();
            $table->foreign('gift_card_id')->references('id')->on('gift_cards');

            $table->string('payment_phone', 20)->nullable();
            $table->string('payment_network', 50)->nullable();
            $table->string('payment_otp')->nullable();
            $table->string('cardType', 50)->nullable(); // Peut être VISA, MASTERCARD, etc.
            $table->string('firstNameCard', 255)->nullable();
            $table->string('lastNameCard', 255)->nullable();
            $table->string('emailCard', 255)->nullable();
            $table->string('countryCard', 100)->nullable();
            $table->string('addressCard', 500)->nullable();
            $table->string('districtCard', 100)->nullable();
            $table->string('status')->nullable();
            $table->string('reference')->nullable();
            $table->enum('currency', ['XOF', 'USD', 'EUR'])->nullable();
            $table->timestamps(); // Inclut `created_at` et `updated_at` pour garder une trace du paiement.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_infos');
    }
}
