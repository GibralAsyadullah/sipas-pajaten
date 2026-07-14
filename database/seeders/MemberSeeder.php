<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama'=>'Gibral','peran'=>'Teknik Informatika'],
            ['nama'=>'Nama Anggota','peran'=>'Ketua Kelompok'],
            ['nama'=>'Nama Anggota','peran'=>'Sekretaris'],
            ['nama'=>'Nama Anggota','peran'=>'Bendahara'],
        ];
        foreach ($data as $i => $row) {
            Member::create($row + ['urutan' => $i + 1]);
        }
    }
}
