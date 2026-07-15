<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_albums', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 180);
            $table->date('tanggal');
            $table->text('cerita')->nullable();              // ringkasan kegiatan (boleh salin caption IG)
            $table->string('instagram_url', 255)->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->foreignId('album_id')->nullable()->after('id')
                ->constrained('gallery_albums')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('album_id');
        });
        Schema::dropIfExists('gallery_albums');
    }
};
