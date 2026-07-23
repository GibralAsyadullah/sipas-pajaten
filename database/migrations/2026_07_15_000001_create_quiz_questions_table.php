<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->json('opsi');                          // daftar pilihan jawaban
            $table->unsignedTinyInteger('jawaban');        // index opsi yang benar (mulai 0)
            $table->text('penjelasan')->nullable();        // ditampilkan setelah menjawab
            $table->boolean('aktif')->default(true);       // nonaktifkan tanpa menghapus
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
