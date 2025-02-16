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
        Schema::create('pivot_kategori_rating_pendengar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendengar_id');
            $table->foreign('pendengar_id')->references('id')->on('pendengar');
            $table->unsignedBigInteger('kategori_rating_id');
            $table->foreign('kategori_rating_id')->references('id')->on('master_kategori_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kategori_rating_pendengar');
    }
};
