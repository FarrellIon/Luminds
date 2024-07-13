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
            $table->datetime('waktu_konsultasi')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan_konsultasi', function (Blueprint $table) {
            $table->dropColumn('waktu_konsultasi');
        });
    }
};
