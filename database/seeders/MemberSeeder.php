<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Susunan tim KKN Desa Pajaten: 1 Dosen Pembimbing Lapangan + 20 mahasiswa.
     * Urutan mengikuti struktur kepanitiaan: DPL, pengurus inti, lalu per divisi.
     * Prodi sesuai data master LPPM.
     */
    public function run(): void
    {
        $data = [
            ['Wanta, S.E., M.M.',                 'Dosen Pembimbing Lapangan', null],

            ['Asep Jamal Maulana',                'Ketua',      'Teknik Industri'],
            ['Gibral Asyadullah',                 'Wakil Ketua', 'Teknik Informatika'],
            ['Dewi Kartika Sundari',              'Sekretaris', 'Teknik Industri'],
            ['Siti Nurul Pratiwi',                'Bendahara',  'Manajemen'],
            ['Salsabila Hikmatu Sadiah',          'Bendahara',  'Farmasi'],

            ['Nabila Muzdalipah',                 'Divisi Logistik & Konsumsi', 'Manajemen'],
            ['Sefi Aulia',                        'Divisi Logistik & Konsumsi', 'Akuntansi'],
            ['Nayla Azzahra Munadi',              'Divisi Logistik & Konsumsi', 'Psikologi'],
            ['Gloria Victoria Angelina',          'Divisi Logistik & Konsumsi', 'Ilmu Hukum'],

            ['Neng Atu Alawiyah',                 'Divisi Humas', 'Manajemen'],
            ['Lyana Aurelia',                     'Divisi Humas', 'Manajemen'],
            ['Angga Praba Subekti',               'Divisi Humas', 'Pendidikan Pancasila dan Kewarganegaraan'],
            ['Muhammad Ihsan Yafi',               'Divisi Humas', 'Sistem Informasi'],

            ['Rafi Dwi Saputra',                  'Divisi PDD', 'Teknik Informatika'],
            ['Salwa Nayla Khairunnisa',           'Divisi PDD', 'Teknik Informatika'],
            ['Dewi Ratnasari',                    'Divisi PDD', 'Pendidikan Guru Sekolah Dasar'],

            ['Aryudana Muhidin',                  'Divisi Acara', 'Psikologi'],
            ['Dinar Ropiah',                      'Divisi Acara', 'Farmasi'],
            ['Diva Charysma Aura Putri Pangestu', 'Divisi Acara', 'Psikologi'],

            ['Dika Alholik',                      'Anggota', 'Teknik Mesin'],
        ];

        foreach ($data as $i => [$nama, $peran, $prodi]) {
            Member::updateOrCreate(
                ['nama' => $nama],
                ['peran' => $peran, 'prodi' => $prodi, 'urutan' => $i + 1],
            );
        }
    }
}
