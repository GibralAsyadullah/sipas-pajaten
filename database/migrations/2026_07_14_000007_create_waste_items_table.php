<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waste_items', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 80);
            $table->string('emoji', 8)->default('🗑️');
            $table->enum('kategori', ['organik', 'anorganik', 'b3']);
            $table->string('saran', 160);                 // saran penanganan
            $table->string('waktu_urai', 60)->nullable(); // estimasi waktu terurai
            $table->text('fakta')->nullable();            // fakta menarik
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waste_items');
    }
};
