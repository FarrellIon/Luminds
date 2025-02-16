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
        Schema::create('jadwal_tersedia_pendengar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendengar_id');
            $table->foreign('pendengar_id')->references('id')->on('pendengar');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_tersedia_pendengar');
    }
};
