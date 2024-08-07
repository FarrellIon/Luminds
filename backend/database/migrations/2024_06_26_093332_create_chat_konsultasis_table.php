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
        Schema::create('chat_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konsultasi_id');
            $table->foreign('konsultasi_id')->references('id')->on('konsultasi');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('pendengar_id')->nullable();
            $table->foreign('pendengar_id')->references('id')->on('pendengar');
            $table->string('chat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_konsultasi');
    }
};
