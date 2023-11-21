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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('link')->default('');
            $table->json('img');
            $table->unsignedBigInteger('price')->default(0);
            $table->boolean('situation')->default(true);
            $table->json('properties');
            $table->foreignId('mainproduct_id');
            $table->foreignId('shop_id');
            $table->timestamps();

            $table->foreign('mainproduct_id')->on('mainproducts')->references('id')->cascadeOnDelete();
            $table->foreign('shop_id')->on('shops')->references('id')->cascadeOnDelete();
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
