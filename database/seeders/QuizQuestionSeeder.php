<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

/**
 * Bank soal Quiz Pengetahuan — bisa ditambah/diubah lewat panel admin.
 * Kolom jawaban = index opsi yang benar (mulai dari 0).
 */
class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        QuizQuestion::truncate();

        $data = [
            [
                'pertanyaan' => 'Sampah organik paling cocok diolah menjadi apa di Desa Pajaten?',
                'opsi'       => ['Dibakar di pekarangan', 'Kompos, POC, atau pakan maggot', 'Dibuang ke irigasi', 'Ditimbun di kantong plastik'],
                'jawaban'    => 1,
                'penjelasan' => 'Sampah organik cepat terurai dan kaya nutrisi, cocok jadi kompos, POC, atau pakan maggot.',
            ],
            [
                'pertanyaan' => 'Ke mana sampah anorganik seperti botol plastik sebaiknya disalurkan?',
                'opsi'       => ['Bank Sampah di Kantor Kepala Desa', 'Dibakar bersama daun kering', 'Saluran irigasi', 'Dipendam di kebun'],
                'jawaban'    => 0,
                'penjelasan' => 'Sampah anorganik ditabung ke Bank Sampah agar bernilai, bukan dibakar atau dibuang.',
            ],
            [
                'pertanyaan' => 'Apa keuntungan menabung sampah di Bank Sampah?',
                'opsi'       => ['Tidak ada untungnya', 'Sampah ditimbang dan jadi tabungan uang', 'Dapat hadiah motor', 'Sampah dibuang lebih jauh'],
                'jawaban'    => 1,
                'penjelasan' => 'Sampah ditimbang, dicatat, lalu nilainya masuk ke buku tabunganmu.',
            ],
            [
                'pertanyaan' => 'Eceng gondok dari irigasi bisa dimanfaatkan menjadi?',
                'opsi'       => ['Pakan ternak setelah dicacah', 'Bahan bakar kompor', 'Pengganti pupuk kimia langsung', 'Tidak bisa dimanfaatkan'],
                'jawaban'    => 0,
                'penjelasan' => 'Eceng gondok dicacah lalu dicampur keong sawah menjadi pakan ternak murah.',
            ],
            [
                'pertanyaan' => 'Mengapa membuang sampah ke irigasi dilarang?',
                'opsi'       => ['Airnya jadi lebih jernih', 'Menyumbat aliran dan memicu banjir', 'Ikan jadi lebih banyak', 'Sampah cepat terurai di air'],
                'jawaban'    => 1,
                'penjelasan' => 'Sampah menyumbat aliran air irigasi sehingga berisiko memicu banjir.',
            ],
            [
                'pertanyaan' => 'Tempat sampah untuk sampah organik umumnya berwarna?',
                'opsi'       => ['Merah', 'Kuning', 'Hijau', 'Biru'],
                'jawaban'    => 2,
                'penjelasan' => 'Hijau menandakan sampah organik yang mudah terurai; kuning untuk anorganik.',
            ],
            [
                'pertanyaan' => 'Maggot (belatung BSF) diberi makan dari?',
                'opsi'       => ['Sampah plastik', 'Sisa makanan & sampah organik', 'Kaca dan logam', 'Kertas kering'],
                'jawaban'    => 1,
                'penjelasan' => 'Maggot memakan sampah organik dan tumbuh jadi pakan ternak bergizi.',
            ],
            [
                'pertanyaan' => 'Apa kepanjangan dari prinsip 3R?',
                'opsi'       => ['Reduce, Reuse, Recycle', 'Read, Run, Rest', 'Reduce, Repeat, Return', 'Reuse, Rinse, Repeat'],
                'jawaban'    => 0,
                'penjelasan' => '3R = Reduce (kurangi), Reuse (pakai ulang), Recycle (daur ulang).',
            ],
            [
                'pertanyaan' => 'POC yang dibuat warga berasal dari?',
                'opsi'       => ['Botol plastik dilelehkan', 'Fermentasi sampah sayur & kulit buah', 'Air irigasi kotor', 'Abu pembakaran sampah'],
                'jawaban'    => 1,
                'penjelasan' => 'POC (Pupuk Organik Cair) dibuat dari fermentasi sampah organik dengan EM4 atau air cucian beras.',
            ],
            [
                'pertanyaan' => 'Sampah mana yang biasanya bernilai jual paling tinggi di Bank Sampah?',
                'opsi'       => ['Daun kering', 'Kaleng/logam aluminium', 'Sisa makanan', 'Kulit pisang'],
                'jawaban'    => 1,
                'penjelasan' => 'Logam seperti aluminium punya harga jual tinggi dibanding sampah lain.',
            ],
            [
                'pertanyaan' => 'Baterai bekas, lampu, dan obat kadaluarsa termasuk jenis sampah?',
                'opsi'       => ['Organik', 'Anorganik biasa', 'B3 (Bahan Berbahaya & Beracun)', 'Bisa dibakar saja'],
                'jawaban'    => 2,
                'penjelasan' => 'Semuanya mengandung zat berbahaya, jadi tergolong B3 dan wajib ditangani khusus.',
            ],
            [
                'pertanyaan' => 'Bagaimana cara benar menangani sampah B3 seperti baterai bekas?',
                'opsi'       => ['Dibuang ke tempat sampah biasa', 'Dibakar agar cepat habis', 'Dikumpulkan terpisah & diserahkan ke fasilitas khusus', 'Dikubur di kebun'],
                'jawaban'    => 2,
                'penjelasan' => 'Sampah B3 dikumpulkan terpisah lalu diserahkan ke dropbox B3/pengepul resmi agar tidak mencemari.',
            ],
            [
                'pertanyaan' => 'Bagaimana sistem penyetoran sampah di Bank Sampah Desa Pajaten?',
                'opsi'       => ['Per kelompok dusun, kira-kira seminggu sekali', 'Perorangan setiap hari', 'Setahun sekali saat panen', 'Lewat pos ke kecamatan'],
                'jawaban'    => 0,
                'penjelasan' => 'Setoran dikoordinasikan per kelompok dusun (bukan perorangan) sekitar seminggu sekali, dengan target 5 kg plastik per kelompok.',
            ],
            [
                'pertanyaan' => 'Kalau setoran kelompokmu minggu ini baru 3 kg (belum sampai 5 kg), apa yang terjadi?',
                'opsi'       => ['Hangus dan tidak dihitung', 'Dicatat dan diakumulasikan ke minggu berikutnya', 'Harus bayar denda', 'Dikembalikan ke warga'],
                'jawaban'    => 1,
                'penjelasan' => 'Setoran yang belum mencapai target tidak hangus — tercatat dan diakumulasikan ke minggu berikutnya.',
            ],
            [
                'pertanyaan' => 'Supaya sampah plastikmu dihargai lebih tinggi di Bank Sampah, sebaiknya?',
                'opsi'       => ['Disetor tercampur apa adanya', 'Dibasahi supaya lebih berat', 'Dipilah sendiri: botol & gelas dipisah, bersih, tanpa label', 'Dibakar sebagian'],
                'jawaban'    => 2,
                'penjelasan' => 'Sampah campur dihargai dengan patokan terendah; yang dipilah sendiri, bersih, dan tanpa label dihargai lebih tinggi.',
            ],
            [
                'pertanyaan' => 'Hasil timbangan sampahmu di Bank Sampah dicatat di mana?',
                'opsi'       => ['Hanya diingat petugas', 'Buku tabungan fisik dan pencatatan digital berbasis web', 'Ditulis di papan pengumuman saja', 'Tidak dicatat'],
                'jawaban'    => 1,
                'penjelasan' => 'Pencatatan dilakukan ganda: buku tabungan fisik milik warga dan pencatatan digital yang dipegang pihak desa sebagai cadangan.',
            ],
        ];

        foreach ($data as $i => $row) {
            QuizQuestion::create($row + ['urutan' => $i + 1]);
        }
    }
}
