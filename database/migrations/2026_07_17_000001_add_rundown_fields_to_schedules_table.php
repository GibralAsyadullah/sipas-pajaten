<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->unsignedTinyInteger('minggu')->default(1)->after('id');   // 1..4 = minggu KKN, 5 = pekan penutupan
            $table->date('tanggal')->nullable()->after('minggu');
            $table->string('jam', 20)->nullable()->after('tanggal');          // '09:00' atau '16:30 - 17:30'
            $table->string('tempat', 120)->nullable()->after('judul');
            $table->text('hasil')->nullable()->after('deskripsi');            // 'Hasil Yang Dicapai' dari jurnal harian
            $table->string('foto')->nullable()->after('hasil');               // dokumentasi, diisi menyusul
        });

        // 'periode' kini hanya cadangan untuk agenda tanpa tanggal pasti (mis. 'Setiap Jumat').
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('periode', 60)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['minggu', 'tanggal', 'jam', 'tempat', 'hasil', 'foto']);
        });
    }
};
