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
        Schema::table('pivot_kategori_rating_pendengar', function (Blueprint $table) {
            $table->unsignedBigInteger('pesanan_konsultasi_id')->after('id');
            $table->foreign('pesanan_konsultasi_id')->references('id')->on('pesanan_konsultasi');
        });

        Schema::table('pivot_rating_pendengar', function (Blueprint $table) {
            $table->unsignedBigInteger('pesanan_konsultasi_id')->after('id');
            $table->foreign('pesanan_konsultasi_id')->references('id')->on('pesanan_konsultasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pivot_kategori_rating_pendengar', function (Blueprint $table) {
            $table->dropForeign(['pesanan_konsultasi_id']);
            $table->dropColumn('pesanan_konsultasi_id');
        });

        Schema::table('pivot_rating_pendengar', function (Blueprint $table) {
            $table->dropForeign(['pesanan_konsultasi_id']);
            $table->dropColumn('pesanan_konsultasi_id');
        });
    }
};
