<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ubah kolom `jenis` dari enum('game','quiz') menjadi string pendek agar
     * tipe permainan baru (mis. 'benar_salah') bisa disimpan tanpa terganjal
     * batasan enum. Nilai sah tetap dijaga di sisi controller (validasi).
     * Pendekatan string dipilih agar aman lintas MySQL & PostgreSQL.
     */
    public function up(): void
    {
        Schema::table('game_results', function (Blueprint $table) {
            $table->string('jenis', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('game_results', function (Blueprint $table) {
            $table->enum('jenis', ['game', 'quiz'])->change();
        });
    }
};
