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
        Schema::table('pendengar', function (Blueprint $table) {
            $table->enum('tipe_layanan', ['konsultasi', 'story_sharing', 'webinar'])->after('identifier');
            $table->integer('harga_per_layanan')->after('tipe_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendengar', function (Blueprint $table) {
            $table->dropColumn('tipe_layanan');
            $table->dropColumn('harga_per_layanan');
        });
    }
};
