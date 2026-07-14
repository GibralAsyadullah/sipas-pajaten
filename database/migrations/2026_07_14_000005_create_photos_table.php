<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('src');                 // 'img/galeri/..' (bawaan) atau 'storage/galeri/..' (upload)
            $table->string('caption', 160)->default('Dokumentasi kegiatan');
            $table->string('bulan', 20)->nullable();      // filter: Juni / Juli
            $table->string('label', 60)->nullable();      // teks kecil, mis. 'Juli 2026 · Survey lokasi'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
