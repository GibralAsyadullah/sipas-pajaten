@extends('layouts.app')
@section('title', 'Video & Poster Edukasi')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Tonton &amp; pelajari</span>
    <h2 class="section-title">Video Edukasi</h2>
  </div>
  <p class="muted">Tonton video cara memilah sampah dan dokumentasi kegiatan. Tempel link YouTube untuk menambah video <span class="badge-proto">prototype: reset saat reload</span></p>

  <div class="input-row">
    <input type="url" id="videoUrl" placeholder="Tempel link YouTube… (contoh: https://youtu.be/xxxx)" aria-label="Link video YouTube">
    <button class="btn-main" onclick="addVideo()">＋ Tambah</button>
  </div>
  <div class="video-grid" id="videoGrid"></div>

  <div class="section-head">
    <span class="eyebrow">Cetak &amp; sebarkan</span>
    <h2 class="section-title">Poster Kampanye</h2>
  </div>
  <p class="muted">Poster ajakan memilah sampah, siap diunduh sebagai PNG untuk dicetak atau dibagikan ke grup WhatsApp warga.</p>
  <div class="poster-flex">
    <canvas id="posterCanvas" width="600" height="850" aria-label="Pratinjau poster"></canvas>
    <div>
      <button class="btn-main" onclick="downloadPoster()">⬇️ Unduh Poster (PNG)</button>
      <p class="hint" style="max-width:320px">Poster dibuat otomatis oleh sistem. Versi final nanti bisa diganti dengan desain tim dokumentasi.</p>
    </div>
  </div>

  <div class="section-head">
    <span class="eyebrow">Hitung tabunganmu</span>
    <h2 class="section-title">Kalkulator Tabungan Sampah</h2>
  </div>
  <p class="muted lead">Masukkan perkiraan berat (kg) tiap jenis sampah anorganik, lalu lihat perkiraan rupiah yang bisa kamu tabung di Bank Sampah Desa Pajaten.</p>
  <div class="calc-list" id="calcList"></div>
  <div class="calc-total">
    <span class="ct-lbl">Perkiraan tabungan<b id="calcKg">0 kg total</b></span>
    <span class="ct-val" id="calcTotal">Rp 0</span>
  </div>
  <div class="calc-impact">
    <span class="ci-ic">🌍</span>
    <div><b id="calcCo2">± 0 kg CO₂ dicegah</b><span id="calcTree">Isi beratnya untuk lihat dampak lingkunganmu.</span></div>
  </div>
  <div class="calc-actions">
    <button class="btn-ghost" onclick="resetCalc()">↺ Reset</button>
  </div>
  <p class="calc-note">* Harga &amp; dampak hanya perkiraan edukatif. Nilai sebenarnya ditentukan saat penimbangan di Bank Sampah.</p>

  <div class="admin-only">
  <div class="section-head">
    <span class="eyebrow">Penghargaan</span>
    <h2 class="section-title">Terbitkan Sertifikat <span class="admin-tag">🔑 Admin</span></h2>
  </div>
  <p class="muted lead">Fitur pengurus: masukkan nama peserta untuk menerbitkan sertifikat digital <b>Sahabat Lingkungan Desa Pajaten</b> — bisa diunduh &amp; dibagikan.</p>
  <div class="input-row">
    <input id="certName" type="text" maxlength="28" placeholder="Nama peserta…" aria-label="Nama untuk sertifikat">
    <button class="btn-main" onclick="makeCert()">🏅 Buat Sertifikat</button>
  </div>
  <canvas id="certCanvas" width="900" height="640" aria-label="Pratinjau sertifikat"></canvas>
  <div class="calc-actions">
    <button class="btn-ghost" id="certDownload" onclick="downloadCert()" disabled>⬇️ Unduh Sertifikat (PNG)</button>
  </div>
  </div>

  <div class="section-head">
    <span class="eyebrow">Praktik di rumah</span>
    <h2 class="section-title">Panduan DIY Olah Sampah</h2>
  </div>
  <p class="muted lead">Langkah sederhana mengolah sampah jadi barang berguna. Ketuk untuk membuka.</p>
  <div class="diy-list">
    <details class="diy">
      <summary><span class="diy-ic">🌱</span> Membuat Kompos Sederhana</summary>
      <div class="diy-body">
        <div class="diy-mat">Bahan: wadah/ember berlubang, sampah organik, daun kering, tanah.</div>
        <ol>
          <li>Lubangi dasar ember untuk sirkulasi udara, lapisi dengan tanah/daun kering.</li>
          <li>Masukkan sampah organik (sisa sayur, kulit buah). Hindari daging, tulang, dan minyak.</li>
          <li>Setiap menambah sampah basah, tutup dengan daun kering (imbangi coklat &amp; hijau).</li>
          <li>Aduk 3–4 hari sekali, jaga tetap lembap (tidak becek, tidak kering).</li>
          <li>Setelah 3–6 minggu, kompos matang: gelap, gembur, berbau seperti tanah.</li>
        </ol>
      </div>
    </details>
    <details class="diy">
      <summary><span class="diy-ic">🍋</span> Eco-Enzyme dari Kulit Buah</summary>
      <div class="diy-body">
        <div class="diy-mat">Takaran: 1 gula merah : 3 kulit buah : 10 air.</div>
        <ol>
          <li>Larutkan gula merah dalam air di wadah plastik besar.</li>
          <li>Masukkan potongan kulit buah, sisakan ruang udara ± 1/5 wadah.</li>
          <li>Tutup rapat. Minggu pertama, buka sebentar tiap hari untuk buang gas.</li>
          <li>Fermentasi 3 bulan di tempat teduh, aduk sesekali.</li>
          <li>Saring — cairannya jadi <b>pembersih lantai alami pengganti pembersih kimia</b> &amp; pupuk; ampasnya untuk kompos.</li>
        </ol>
      </div>
    </details>
    <details class="diy">
      <summary><span class="diy-ic">🧪</span> Pupuk Organik Cair (POC)</summary>
      <div class="diy-body">
        <div class="diy-mat">Bahan: galon bekas, sampah sayur, air cucian beras, EM4, gula.</div>
        <ol>
          <li>Cacah kecil sampah sayur &amp; kulit buah, masukkan ke galon.</li>
          <li>Tambahkan air cucian beras, larutan EM4, dan sedikit gula sebagai starter.</li>
          <li>Tutup rapat, kocok sebentar tiap 2 hari untuk buang gas.</li>
          <li>Fermentasi ± 2 minggu; letakkan jauh dari pemukiman karena berbau.</li>
          <li>Encerkan 1:10 dengan air sebelum disiramkan ke tanaman.</li>
        </ol>
      </div>
    </details>
    <details class="diy">
      <summary><span class="diy-ic">✂️</span> Kerajinan dari Botol Plastik</summary>
      <div class="diy-body">
        <div class="diy-mat">Bahan: botol plastik bekas, gunting/cutter, cat &amp; tali.</div>
        <ol>
          <li>Cuci bersih dan keringkan botol.</li>
          <li>Potong sesuai pola: pot gantung, celengan, vas, atau tempat pensil.</li>
          <li>Haluskan tepi bekas potongan agar tidak tajam.</li>
          <li>Hias dengan cat, tali, atau kertas warna.</li>
          <li>Manfaatkan sebagai pot tanaman gantung atau wadah di rumah/sekolah.</li>
        </ol>
      </div>
    </details>
    <details class="diy">
      <summary><span class="diy-ic">🫧</span> Beralih ke Detergen Ramah Lingkungan</summary>
      <div class="diy-body">
        <div class="diy-mat">Kenapa: fosfat &amp; busa berlebih merusak ekosistem air dan membuat got menjadi bau.</div>
        <ol>
          <li>Pilih detergen berlabel <b>bebas fosfat (phosphate-free)</b> dan <b>minim busa</b>.</li>
          <li>Gunakan takaran secukupnya — busa banyak bukan berarti lebih bersih.</li>
          <li>Jangan buang air cucian langsung ke saluran terbuka/sungai; alirkan ke resapan.</li>
          <li>Untuk noda ringan, coba pembersih alami: eco-enzyme, cuka, atau baking soda.</li>
          <li>Ajak tetangga beralih bersama — got yang sehat dimulai dari satu RT.</li>
        </ol>
      </div>
    </details>
    <details class="diy">
      <summary><span class="diy-ic">🧱</span> Membuat Ecobrick dari Sampah Plastik</summary>
      <div class="diy-body">
        <div class="diy-mat">Bahan: botol plastik ukuran seragam, plastik bekas bersih &amp; kering, tongkat pemadat.</div>
        <ol>
          <li>Cuci dan keringkan semua plastik bekas (bungkus, kresek, sachet) — wajib kering agar tidak berjamur.</li>
          <li>Gunting kecil-kecil, lalu masukkan ke botol sedikit demi sedikit.</li>
          <li>Padatkan dengan tongkat sampai botol keras (± 0,3 gram per ml — botol 600 ml ≈ 200 gram).</li>
          <li>Tutup rapat. Ecobrick siap dirangkai jadi kursi, meja, atau bahan bangunan sederhana.</li>
          <li>Satu ecobrick "mengunci" ratusan plastik agar tidak berakhir dibakar atau ke sungai.</li>
        </ol>
      </div>
    </details>
  </div>

  <div class="section-head">
    <span class="eyebrow">Tanya jawab</span>
    <h2 class="section-title">Pertanyaan Umum (FAQ)</h2>
  </div>
  <div class="diy-list">
    <details class="diy"><summary><span class="diy-ic">❓</span> Apa itu Bank Sampah?</summary><div class="diy-body"><p>Tempat menabung sampah anorganik. Sampahmu ditimbang, dicatat, lalu nilainya masuk ke buku tabungan yang bisa dicairkan menjadi uang.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">♻️</span> Sampah apa saja yang diterima?</summary><div class="diy-body"><p>Sampah anorganik dalam kondisi bersih &amp; kering: botol plastik, kardus, kaleng, kertas, dan logam. Lihat daftar lengkapnya di menu Pilah.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">🧺</span> Apakah harus memilah dulu di rumah?</summary><div class="diy-body"><p>Ya. Pisahkan organik &amp; anorganik dari rumah agar prosesnya cepat dan sampah anorganik lebih bernilai jual.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">📅</span> Kapan Bank Sampah beroperasi penuh?</summary><div class="diy-body"><p>Ditargetkan mulai Agustus 2026, bertahap sesuai kesiapan warga & sarana.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">🙋</span> Bagaimana cara ikut serta?</summary><div class="diy-body"><p>Datang ke Kantor Kepala Desa Pajaten, atau hubungi mahasiswa KKN saat sosialisasi &amp; kunjungan (sowan) ke rumah warga.</p></div></details>
  </div>
@endsection

@push('scripts')
<script src="{{ asset('js/paparan.js') }}"></script>
@endpush
