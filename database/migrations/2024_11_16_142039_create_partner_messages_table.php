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
        Schema::create('partner_messages', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');

            $table->string('subject')->nullable();
            $table->string('message');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_messages');
    }
};
