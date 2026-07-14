<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('periode', 60);
            $table->string('judul', 120);
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['done', 'ongoing', 'upcoming'])->default('upcoming');
            $table->string('ikon', 8)->default('📌');
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
