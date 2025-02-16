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
        Schema::table('master_kategori_quest', function (Blueprint $table) {
            $table->unsignedBigInteger('input_by')->after('color_code');
            $table->foreign('input_by')->references('id')->on('admin');
        });

        Schema::table('master_kategori_rating', function (Blueprint $table) {
            $table->unsignedBigInteger('input_by')->after('nama');
            $table->foreign('input_by')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_kategori_quest', function (Blueprint $table) {
            $table->dropForeign(['input_by']);
            $table->dropColumn('input_by');
        });

        Schema::table('master_kategori_rating', function (Blueprint $table) {
            $table->dropForeign(['input_by']);
            $table->dropColumn('input_by');
        });
    }
};
