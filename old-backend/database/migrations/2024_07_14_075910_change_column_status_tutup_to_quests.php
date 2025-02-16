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
        Schema::table('komentar_quest', function (Blueprint $table) {
            $table->dropColumn('status_tutup');
        });
        Schema::table('quests', function (Blueprint $table) {
            $table->boolean('status_tutup')->after('hadiah')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentar_quest', function (Blueprint $table) {
            $table->boolean('status_tutup')->after('status_terbaik');
        });
        Schema::table('quests', function (Blueprint $table) {
            $table->dropColumn('status_tutup');
        });
    }
};
