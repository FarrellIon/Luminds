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
        Schema::create('pekerjaan_pendengar', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pendengar_id');
            $table->foreign('pendengar_id')->references('id')->on('pendengar');
            $table->string('nama');
            $table->string('perusahaan');
            $table->integer('tahun_mulai');
            $table->integer('tahun_selesai');
            $table->boolean('status_current');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaan_pendengar');
    }
};
