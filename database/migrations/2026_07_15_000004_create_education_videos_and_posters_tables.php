<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_videos', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('youtube_url', 255);
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('gambar');                       // path file di disk public
            $table->string('keterangan', 255)->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posters');
        Schema::dropIfExists('education_videos');
    }
};
