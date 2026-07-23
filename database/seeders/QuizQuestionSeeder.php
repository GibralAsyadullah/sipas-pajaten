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
            [
                'pertanyaan' => 'Minyak jelantah sisa menggoreng sebaiknya diapakan?',
                'opsi'       => ['Disiram ke got atau saluran air', 'Dikumpulkan di botol tertutup lalu disetor/dijual', 'Dibuang ke kebun', 'Dicampur ke kompos'],
                'jawaban'    => 1,
                'penjelasan' => 'Satu liter jelantah dapat mencemari ribuan liter air bersih — kumpulkan di botol tertutup, jangan dibuang ke got.',
            ],
            [
                'pertanyaan' => 'Kenapa membakar jerami setelah panen sebaiknya dihindari?',
                'opsi'       => ['Membuat tanah jadi terlalu subur', 'Mencemari udara & memicu ISPA, padahal jerami berharga untuk tanah', 'Membuat padi tumbuh terlalu cepat', 'Tidak ada alasannya'],
                'jawaban'    => 1,
                'penjelasan' => 'Asapnya memicu gangguan pernapasan, sementara jerami sebenarnya bernilai tinggi sebagai kompos, mulsa, atau media tanam.',
            ],
            [
                'pertanyaan' => 'Ban bekas yang dibiarkan terbuka di halaman berbahaya karena?',
                'opsi'       => ['Menampung air hujan dan jadi sarang nyamuk DBD', 'Menarik petir', 'Membuat tanah tandus', 'Mengundang burung'],
                'jawaban'    => 0,
                'penjelasan' => 'Air yang menggenang di dalam ban jadi tempat berkembang biak nyamuk DBD — simpan telungkup atau manfaatkan jadi pot.',
            ],
            [
                'pertanyaan' => 'Kaca atau beling pecah sebaiknya dibuang dengan cara?',
                'opsi'       => ['Langsung dimasukkan kantong kresek', 'Dibungkus kertas/kardus tebal dan diberi label', 'Dibuang ke saluran air', 'Dibakar bersama sampah lain'],
                'jawaban'    => 1,
                'penjelasan' => 'Kaca pecah tanpa pembungkus melukai petugas sampah — bungkus tebal dan beri tulisan penanda.',
            ],
            [
                'pertanyaan' => 'Kulit singkong sebaiknya direbus dulu sebelum jadi pakan ternak karena?',
                'opsi'       => ['Supaya lebih wangi', 'Mengandung sianida alami saat mentah', 'Supaya lebih berat', 'Supaya tahan lama'],
                'jawaban'    => 1,
                'penjelasan' => 'Kulit singkong mentah mengandung sianida alami; direbus dulu agar aman untuk ternak.',
            ],
            [
                'pertanyaan' => 'Powerbank atau baterai HP rusak tidak boleh ditusuk maupun dibakar karena?',
                'opsi'       => ['Baunya menyengat', 'Bisa meledak dan memicu kebakaran', 'Harganya jadi turun', 'Warnanya memudar'],
                'jawaban'    => 1,
                'penjelasan' => 'Baterai lithium yang rusak bisa terbakar atau meledak — serahkan utuh ke dropbox B3 atau toko elektronik.',
            ],
            [
                'pertanyaan' => 'Kemasan pestisida bekas yang sudah kosong sebaiknya?',
                'opsi'       => ['Dipakai ulang untuk wadah air minum', 'Dibilas 3x, dirusak, lalu diserahkan ke fasilitas B3', 'Dibakar di pematang', 'Dibuang ke saluran irigasi'],
                'jawaban'    => 1,
                'penjelasan' => 'Sisa bahan aktif tetap menempel; kemasannya wajib dirusak agar tidak dipakai ulang sebagai wadah pangan.',
            ],
            [
                'pertanyaan' => 'Puntung rokok termasuk sampah yang bermasalah karena?',
                'opsi'       => ['Cepat terurai dalam sehari', 'Mengandung mikroplastik dan jadi sampah terbanyak di dunia', 'Menyuburkan tanah', 'Bisa dijadikan kompos'],
                'jawaban'    => 1,
                'penjelasan' => 'Filter rokok berbahan serat plastik, butuh 10–12 tahun terurai, dan jadi sampah paling banyak ditemukan di dunia.',
            ],
        ];

        foreach ($data as $i => $row) {
            QuizQuestion::create($row + ['urutan' => $i + 1]);
        }
    }
}
