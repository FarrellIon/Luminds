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
        Schema::create('komentar_quest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quest_id');
            $table->foreign('quest_id')->references('id')->on('quests');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('komentar');
            $table->boolean('status_terbaik');
            $table->boolean('status_tutup');
            $table->integer('max_partisipan')->nullable();
            $table->integer('hadiah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_quest');
    }
};
