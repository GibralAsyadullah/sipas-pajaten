<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        Photo::create(['src'=>'img/galeri/foto-01.jpg','caption'=>'Foto bersama di Gedung Rektorat UBP Karawang','bulan'=>'Juni','label'=>'Juni 2026 · Pembekalan']);
        Photo::create(['src'=>'img/galeri/foto-02.jpg','caption'=>'Kantor Kepala Desa Pajaten — titik Bank Sampah','bulan'=>'Juli','label'=>'Juli 2026 · Survey lokasi']);
    }
}
