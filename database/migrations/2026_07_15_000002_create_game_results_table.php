<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_results', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);                     // identitas responden
            $table->unsignedTinyInteger('usia')->nullable();
            $table->string('asal', 120)->nullable();         // dusun / RT / sekolah
            $table->enum('jenis', ['game', 'quiz']);
            $table->unsignedSmallInteger('skor');
            $table->unsignedTinyInteger('benar');
            $table->unsignedTinyInteger('total_soal');
            $table->json('detail')->nullable();              // rincian jawaban per soal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_results');
    }
};
