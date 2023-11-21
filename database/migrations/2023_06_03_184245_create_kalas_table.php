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
        Schema::create('kalas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('img');
            $table->json('properties');
            $table->foreignId('product_id');
            $table->timestamps();

            $table->foreign('product_id')->on('products')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalas');
    }
};
