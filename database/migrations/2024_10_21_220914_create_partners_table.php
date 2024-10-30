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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->bigInteger('category_id', false, true);
            $table->foreign('category_id')->references('id')->on('partner_categories')->onDelete('cascade');

            $table->string('picture_1');
            $table->string('picture_2')->nullable();
            $table->string('picture_3')->nullable();
            $table->string('picture_4')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description');
            $table->string('phone_number', 15);
            $table->string('email')->unique();
            $table->string('adress')->nullable();
            $table->text('offers');
            $table->string('tags')->nullable();
            $table->integer('min_amount')->unsigned();
            $table->smallInteger('commission_percent');
            $table->boolean('suspended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
