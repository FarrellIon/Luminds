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
        Schema::table('report_konsultasi', function (Blueprint $table) {
            $table->renameColumn('konsultasi_id', 'pesanan_konsultasi_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_konsultasi', function (Blueprint $table) {
            $table->renameColumn('pesanan_konsultasi_id', 'pesanan_konsultasi_id');
        });
    }
};
