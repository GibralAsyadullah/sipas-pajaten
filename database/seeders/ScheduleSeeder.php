<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['periode'=>'Juni 2026','judul'=>'Pembekalan & Pelepasan KKN','deskripsi'=>'Rangkaian pembekalan (pre test, materi, post test) dan pelepasan resmi di kampus UBP Karawang.','status'=>'done','ikon'=>'🎓'],
            ['periode'=>'Selasa, 7 Juli','judul'=>'Rapat Koordinasi Proker','deskripsi'=>'Pembahasan 5 program utama bersama perangkat desa & tokoh masyarakat di Posko.','status'=>'done','ikon'=>'📋'],
            ['periode'=>'Rabu, 8 Juli · 08.00','judul'=>'Pembukaan Resmi KKN','deskripsi'=>'Seremoni perkenalan mahasiswa di Kantor Desa, dilanjut rapat koordinasi desa.','status'=>'done','ikon'=>'🎤'],
            ['periode'=>'Kamis, 9 Juli','judul'=>'Pendampingan Gorol Gabungan 6 Desa','deskripsi'=>'Kerja bakti gabungan — mahasiswa KKN & Tim P2WKSS mendampingi penuh.','status'=>'done','ikon'=>'🤝'],
            ['periode'=>'Setiap Jumat','judul'=>'Jumat Bersih (Jumsih)','deskripsi'=>'Kebersihan rutin terkoordinasi di wilayah empat dusun Desa Pajaten.','status'=>'ongoing','ikon'=>'🧹'],
            ['periode'=>'Agustus 2026','judul'=>'Peresmian Bank Sampah & Maggot','deskripsi'=>'Target operasional penuh sistem Bank Sampah dan pengelolaan maggot oleh desa.','status'=>'upcoming','ikon'=>'🏦'],
        ];
        foreach ($data as $i => $row) {
            Schedule::create($row + ['urutan' => $i + 1]);
        }
    }
}
