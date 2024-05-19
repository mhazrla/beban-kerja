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
        Schema::create('analisis_beban_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('bk_id');
            $table->string('user_id');
            $table->string('output');
            $table->string('volume');
            $table->string('time_allocated');
            $table->string('daily_volume')->nullable();
            $table->string('daily_time')->nullable();
            $table->string('daily_used')->nullable();
            $table->string('fte')->nullable();
            $table->string('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_beban_kerja');
    }
};
