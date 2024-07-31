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
        Schema::table('pekerjaan_pendengar', function(Blueprint $table) {
            $table->dropColumn('tahun_mulai');
            $table->dropColumn('tahun_selesai');
            $table->date('waktu_mulai')->after('perusahaan');
            $table->date('waktu_selesai')->after('waktu_mulai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pekerjaan_pendengar', function(Blueprint $table) {
            $table->dropColumn('waktu_mulai');
            $table->dropColumn('waktu_selesai');
            $table->integer('tahun_mulai')->after('perusahaan');
            $table->integer('tahun_selesai')->after('tahun_mulai');
        });
    }
};
