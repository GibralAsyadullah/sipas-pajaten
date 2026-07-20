<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

/**
 * Sumber data:
 *  - Rundown KKN Desa Pajaten, Kec. Cibuaya, Karawang (8 Juli - 8 Agustus 2026)
 *  - Jurnal Kegiatan Harian Minggu ke-1 (tempat + hasil yang dicapai)
 *
 * Minggu 4 dan pekan penutupan sengaja kosong: rundown belum mengisi agendanya.
 */
class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // ---------- Minggu 1: 8 - 14 Juli 2026 ----------
            [
                'minggu' => 1, 'tanggal' => '2026-07-08', 'jam' => '08:00', 'ikon' => '🎓',
                'judul' => 'Pelepasan KKN di Universitas Buana Perjuangan Karawang',
                'tempat' => 'Kampus UBP Karawang',
                'deskripsi' => 'Pelepasan resmi peserta KKN oleh pihak universitas.',
                'hasil' => 'Peserta KKN resmi dilepas oleh Universitas.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-08', 'jam' => '08:00', 'ikon' => '🎤',
                'judul' => 'Pembukaan KKN di Desa Pajaten',
                'tempat' => 'Kantor Desa Pajaten',
                'deskripsi' => 'Penerimaan peserta KKN oleh Pemerintah Desa Pajaten.',
                'hasil' => 'Peserta KKN diterima oleh Pemerintah Desa Pajaten. Terjalin koordinasi awal dengan pihak desa mengenai pelaksanaan KKN.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-09', 'jam' => '10:00', 'ikon' => '🤝',
                'judul' => 'Berkunjung ke kediaman Ketua RT',
                'tempat' => 'Rumah Ketua RT',
                'deskripsi' => 'Silaturahmi sekaligus permohonan izin pelaksanaan program kerja.',
                'hasil' => 'Terjalin silaturahmi dan komunikasi dengan Pak RT. Diperoleh izin dan dukungan untuk pelaksanaan program kerja KKN di wilayah setempat.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-09', 'jam' => '17:00', 'ikon' => '🤝',
                'judul' => 'Berkunjung ke kediaman Wakil Ketua RT & Kepala Dusun',
                'tempat' => 'Rumah Wakil Ketua RT & Kepala Dusun',
                'deskripsi' => 'Lanjutan perizinan wilayah kepada Wakil Ketua RT dan Kepala Dusun.',
                'hasil' => 'Terjalin silaturahmi dengan Wakil Ketua RT serta Kepala Dusun, disertai dukungan untuk pelaksanaan program kerja KKN.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-10', 'jam' => '07:00', 'ikon' => '🧹',
                'judul' => "Jumsih (Jum'at Bersih)",
                'tempat' => 'Sekitar Kantor Desa Pajaten',
                'deskripsi' => 'Kerja bakti kebersihan bersama warga di lingkungan Kantor Desa.',
                'hasil' => 'Lingkungan sekitar Kantor Desa menjadi lebih bersih serta meningkatkan semangat gotong royong dan kepedulian terhadap kebersihan lingkungan.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-11', 'jam' => '19:00', 'ikon' => '📋',
                'judul' => 'Rapat evaluasi kegiatan',
                'tempat' => 'Posko KKN',
                'deskripsi' => 'Evaluasi minggu pertama sekaligus menyusun jadwal program kerja berikutnya.',
                'hasil' => 'Tersusunnya hasil evaluasi minggu pertama serta jadwal pelaksanaan program kerja untuk minggu berikutnya.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-12', 'jam' => '16:00', 'ikon' => '🏡',
                'judul' => 'Sowan ke kediaman Kepala Desa',
                'tempat' => 'Rumah Kepala Desa Pajaten',
                'deskripsi' => 'Pembahasan program kerja, salah satunya Bank Sampah.',
                'hasil' => 'Mendapatkan masukan dan arahan dari Kepala Desa mengenai pelaksanaan program kerja khususnya Program Bank Sampah serta dukungan untuk pelaksanaannya.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-13', 'jam' => '15:00', 'ikon' => '🔍',
                'judul' => 'Survei lokasi pengepul sampah',
                'tempat' => 'Tempat pengepul sampah di Desa Pajaten',
                'deskripsi' => 'Menggali mekanisme pengelolaan dan penjualan sampah sebagai bahan perencanaan Bank Sampah.',
                'hasil' => 'Diperoleh informasi mengenai mekanisme pengelolaan dan penjualan sampah kepada pengepul sebagai bahan perencanaan Program Bank Sampah.',
                'status' => 'done',
            ],
            [
                'minggu' => 1, 'tanggal' => '2026-07-14', 'jam' => '15:00', 'ikon' => '🏦',
                'judul' => 'Koordinasi dengan pihak kecamatan mengenai Bank Sampah',
                'tempat' => 'Kantor Desa Pajaten',
                'deskripsi' => 'Rapat bersama unsur pemerintahan membahas jalannya program Bank Sampah.',
                'hasil' => 'Terjalinnya kesepakatan awal dan koordinasi dengan unsur pemerintahan desa terkait pelaksanaan Program Bank Sampah serta langkah tindak lanjut yang akan dilakukan.',
                'status' => 'done',
            ],

            // ---------- Minggu 2: 15 - 21 Juli 2026 ----------
            [
                'minggu' => 2, 'tanggal' => '2026-07-15', 'jam' => '09:00', 'ikon' => '📋',
                'judul' => 'Rapat minggon di Kantor Desa',
                'tempat' => 'Kantor Desa Pajaten',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-15', 'jam' => '10:30', 'ikon' => '🏛️',
                'judul' => 'Berkunjung ke Kecamatan Cibuaya',
                'tempat' => 'Kantor Kecamatan Cibuaya',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-15', 'jam' => '14:30', 'ikon' => '🪧',
                'judul' => 'Pembuatan papan informasi sampah (tahap awal)',
                'tempat' => 'Posko KKN',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-15', 'jam' => '16:30 - 17:30', 'ikon' => '🤸',
                'judul' => 'Senam bersama Ibu-ibu & Ibu Kepala Desa',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-16', 'jam' => '09:00', 'ikon' => '🏫',
                'judul' => 'Pencarian informasi Proker PGSD & Psikologi di SDN Pajaten III',
                'tempat' => 'SDN Pajaten III',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-16', 'jam' => '09:00', 'ikon' => '🪧',
                'judul' => 'Penyelesaian pembuatan papan informasi',
                'tempat' => 'Posko KKN',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-16', 'jam' => '16:30', 'ikon' => '🏦',
                'judul' => 'Pembuatan Bank Sampah (tahap awal)',
                'status' => 'done',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-17', 'jam' => '07:00', 'ikon' => '🧹',
                'judul' => "Jumsih (Jum'at Bersih)",
                'status' => 'ongoing',
            ],
            [
                'minggu' => 2, 'tanggal' => '2026-07-17', 'ikon' => '🪧',
                'judul' => 'Pemasangan papan informasi sampah di depan Kantor Desa',
                'tempat' => 'Kantor Desa Pajaten',
                'status' => 'ongoing',
            ],

            // ---------- Minggu 3: 22 - 28 Juli 2026 ----------
            [
                'minggu' => 3, 'tanggal' => '2026-07-22', 'jam' => '07:00', 'ikon' => '🎒',
                'judul' => 'Proker PGSD & Psikologi',
                'status' => 'upcoming',
            ],
        ];

        foreach ($data as $i => $row) {
            Schedule::create($row + ['urutan' => $i + 1]);
        }
    }
}
