<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::create(['emoji'=>'🍘','nama'=>'Opak Ketan "Sumber Rasa"','deskripsi'=>'Produk khas & unggulan Desa Pajaten. Kerupuk ketan tradisional turun-temurun lebih dari 30 tahun — dari menumbuk ketan, mencetak, menjemur, hingga memanggang di atas bara. Desa Pajaten dikenal sebagai penghasil opak.','tag'=>'Unggulan']);
        Umkm::create(['emoji'=>'🌾','nama'=>'Pertanian Padi & Sawah','deskripsi'=>'Mayoritas warga bertani padi, didukung jaringan irigasi desa.']);
        Umkm::create(['emoji'=>'🧵','nama'=>'Konveksi & Jahit','deskripsi'=>'Usaha jahit dan obras rumahan warga.']);
        Umkm::create(['emoji'=>'🐐','nama'=>'Peternakan Warga','deskripsi'=>'Budidaya ternak sebagai sumber penghidupan warga.']);
        Umkm::create(['emoji'=>'🍢','nama'=>'Olahan Pangan PKK / PEKKA','deskripsi'=>'Produk olahan ibu-ibu PKK & Perempuan Kepala Keluarga, didorong lewat program P2WKSS 2026.']);
    }
}
