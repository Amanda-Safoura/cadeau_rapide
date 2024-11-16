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
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partners');

            // Étape 1 : Informations du Chèque Cadeau
            $table->bigInteger('amount')->unsigned(); // Montant du chèque cadeau
            $table->text('personal_message')->nullable(); // Message personnel

            // Étape 2 : Détails du Client
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');

            // Étape 3 : Bénéficiaire
            $table->boolean('is_client_beneficiary')->default(true);
            $table->string('beneficiary_name')->nullable();
            $table->string('beneficiary_email')->nullable();
            $table->string('beneficiary_phone')->nullable();

            // Étape 4 : Personnalisation
            $table->boolean('is_customized')->default(false); // Booléen pour personnalisation
            $table->integer('customization_fee')->default(0); // Montant fixe pour personnalisation

            // Étape 5 : Choix de Livraison
            $table->text('delivery_address');
            $table->date('delivery_date');
            $table->string('delivery_contact', 20)->nullable();

            // Étape 2 : Détails du Client
            $table->bigInteger('shipping_id')->unsigned()->nullable();
            $table->foreign('shipping_id')->references('id')->on('shippings');

            $table->boolean('sent')->nullable()->default(false);
            $table->integer('validity_duration')->unsigned()->nullable();
            $table->enum('shipping_status', ['awaiting processing','pending', 'delivered'])->default('awaiting processing');
            $table->string('shipping_zone')->default('N/A');
            $table->integer('shipping_price')->default(0);


            // Étape 6 : Récapitulatif
            $table->bigInteger('total_amount')->unsigned(); // Montant total
            $table->boolean('used')->default(false);

            // Étape 7 : Paiement
            $table->bigInteger('payment_info_id', false, true)->nullable()->unique(); // Numéro de transaction

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};
