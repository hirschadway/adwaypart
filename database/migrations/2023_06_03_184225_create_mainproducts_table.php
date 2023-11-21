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
        Schema::create('mainproducts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productcategory_id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('link')->default('');
            $table->json('img');
            $table->json('properties');
            $table->timestamps();
            
            $table->foreign('productcategory_id')->on('productcategories')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mainproducts');
    }
};
