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
        Schema::create('categorizedproducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price')->default(0);
            $table->boolean('situation')->default(true);
            $table->foreignId('product_id');
            $table->foreignId('kalagroup_id');
            $table->timestamps();
            $table->unique(['product_id','kalagroup_id']);
            $table->foreign('product_id')->on('products')->references('id')->cascadeOnDelete();
            $table->foreign('kalagroup_id')->on('kalagroups')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorizedproducts');
    }
};
