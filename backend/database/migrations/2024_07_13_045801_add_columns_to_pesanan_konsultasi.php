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
        Schema::table('pesanan_konsultasi', function (Blueprint $table) {
            $table->dropColumn('harga');
            $table->enum('status', ['menunggu_approval', 'menunggu_jadwal', 'sedang_berlangsung', 'selesai', 'sudah_rating'])->after('pendengar_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan_konsultasi', function (Blueprint $table) {
            $table->integer('harga')->after('pendengar_id');
            $table->dropColumn('status');
        });
    }
};
