@extends('layouts.app')
@section('title', 'Edukasi & Alur Program')
@section('content')
  <div class="section-head" id="konsep-3r">
    <span class="eyebrow">Konsep dasar</span>
    <h2 class="section-title">Prinsip 3R: Reduce, Reuse, Recycle</h2>
  </div>
  <p class="muted lead">Seluruh program pengelolaan sampah KKN 2026 berpijak pada satu konsep: <b>3R</b>. Intinya menangani sampah <b>sejak dari sumbernya</b> — bukan menunggu menumpuk lalu dibuang. Urutannya penting: kurangi dulu, kalau tidak bisa pakai ulang, kalau tidak bisa baru daur ulang.</p>
  <div class="r3-grid">
    <div class="r3-card reduce">
      <span class="r3-badge">1 · Paling utama</span>
      <span class="r3-ic">🚯</span>
      <b>Reduce <span>— Kurangi</span></b>
      <p>Menekan jumlah sampah sebelum terlanjur ada. Sampah yang tidak pernah dibuat tidak perlu diurus siapa pun.</p>
      <ul class="r3-list">
        <li>Bawa tas belanja sendiri, tolak kantong kresek</li>
        <li>Pakai botol minum isi ulang, hindari gelas sekali pakai</li>
        <li>Beli ukuran besar daripada banyak kemasan sachet</li>
      </ul>
    </div>
    <div class="r3-card reuse">
      <span class="r3-badge">2 · Sebelum dibuang</span>
      <span class="r3-ic">🔁</span>
      <b>Reuse <span>— Pakai Ulang</span></b>
      <p>Memakai kembali barang dalam bentuk aslinya, tanpa proses pabrik. Cara paling murah memperpanjang umur barang.</p>
      <ul class="r3-list">
        <li>Galon &amp; botol bekas jadi media budidaya maggot atau POC</li>
        <li>Kaleng &amp; ember bekas jadi pot tanaman</li>
        <li>Kantong plastik dipakai berkali-kali selagi masih layak</li>
      </ul>
    </div>
    <div class="r3-card recycle">
      <span class="r3-badge">3 · Jalan terakhir</span>
      <span class="r3-ic">♻️</span>
      <b>Recycle <span>— Daur Ulang</span></b>
      <p>Mengolah sampah jadi barang baru. Di sinilah <b>Bank Sampah</b> berperan: sampahmu didaur ulang, kamu dapat tabungan.</p>
      <ul class="r3-list">
        <li>Botol plastik &amp; gelas/cup kemasan ditabung ke Bank Sampah desa</li>
        <li>Sampah organik jadi kompos, eco-enzyme, atau pakan maggot</li>
        <li>Plastik bekas diolah jadi produk kerajinan bernilai jual</li>
      </ul>
    </div>
  </div>
  <div class="info-block fact" style="margin-top:12px">
    <span class="bic">💡</span>
    <div><b>Kenapa urutannya tidak boleh dibalik?</b><span>Daur ulang tetap butuh energi, air, dan biaya angkut. Karena itu <b>Reduce</b> selalu didahulukan — paling murah, paling ringan bagi lingkungan. Recycle adalah pilihan terakhir, bukan yang pertama.</span></div>
  </div>

  <div class="section-head" id="alur-bank-sampah">
    <span class="eyebrow">Program utama</span>
    <h2 class="section-title">Alur Bank Sampah Desa Pajaten</h2>
  </div>
  <p class="muted lead">Bank Sampah adalah kolaborasi warga, perangkat desa, kecamatan, dan mahasiswa KKN: menanamkan disiplin memilah sampah sekaligus memberi <b>nilai ekonomi</b> bagi warga. Program dimulai sebagai <b>uji coba skala kecil</b> dulu — setelah berhasil, pengembangannya dilanjutkan oleh pihak desa.</p>

  <div class="stat-row">
    <div class="stat"><b>5</b><span>Dusun peserta uji coba</span></div>
    <div class="stat"><b>±10</b><span>Warga perwakilan tiap dusun</span></div>
    <div class="stat"><b>5 kg</b><span>Target setoran plastik per kelompok / minggu</span></div>
  </div>

  <div class="acc-flow">
    <details class="acc-item" open>
      <summary><span class="acc-num">1</span><b>🏠 Kumpulkan &amp; pilah dari rumah</b><span class="acc-chev">⌄</span></summary>
      <p>Kumpulkan sampah plastik — terutama <b>botol</b> dan <b>gelas/cup kemasan</b>. Pastikan <b>bersih, kering, dan labelnya dilepas</b> agar nilai jualnya lebih tinggi. Sisa makanan &amp; sampah organik dipisahkan (lihat alur organik di bawah).</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">2</span><b>👥 Setor lewat kelompok dusun</b><span class="acc-chev">⌄</span></summary>
      <p>Penyetoran dilakukan <b>per kelompok dusun</b> (bukan perorangan), kira-kira <b>seminggu sekali</b>. Untuk dusun yang jauh, pengangkutan kolektif dibantu Kepala Dusun / Linmas agar warga tidak terbebani ongkos.</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">3</span><b>⚖️ Timbang di Bank Sampah Kantor Desa</b><span class="acc-chev">⌄</span></summary>
      <p>Sampah ditimbang di unit Bank Sampah yang dipusatkan di Kantor Desa. Penimbangan <b>disaksikan langsung oleh pemilik sampah</b> demi transparansi. Setelah ditimbang, sampah dipilah ke rak/sekat botol dan gelas.</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">4</span><b>📒 Dicatat ganda: buku &amp; digital</b><span class="acc-chev">⌄</span></summary>
      <p>Hasil timbangan dicatat di <b>buku tabungan fisik</b> milik warga dan <b>pencatatan digital berbasis web</b> yang dipegang pihak desa sebagai data cadangan. Pencatatan dikoordinasikan lewat ketua kelompok tiap dusun.</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">5</span><b>🐷 Menabung &amp; akumulasi</b><span class="acc-chev">⌄</span></summary>
      <p>Penukaran dihitung <b>per 5 kg</b>. Kalau minggu ini belum sampai target (misal baru 3 kg), tidak hangus — otomatis <b>diakumulasikan ke minggu berikutnya</b>.</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">6</span><b>💵 Cairkan tabungan</b><span class="acc-chev">⌄</span></summary>
      <p>Setelah tabungan mencapai target minimal, nilainya bisa <b>dicairkan menjadi uang atau sembako</b>. Sampah lalu disalurkan desa ke pengepul besar.</p>
    </details>
  </div>

  <div class="section-head" id="alur-organik">
    <span class="eyebrow">Sampah organik</span>
    <h2 class="section-title">Alur Sampah Organik → Maggot &amp; Kompos</h2>
  </div>
  <p class="muted">Sampah organik tidak ditabung ke Bank Sampah, tapi diolah agar tidak berakhir di sungai.</p>
  <div class="acc-flow">
    <details class="acc-item" open>
      <summary><span class="acc-num">1</span><b>🥬 Pisahkan sisa dapur</b><span class="acc-chev">⌄</span></summary>
      <p>Sisa makanan, sayur, dan kulit buah dikumpulkan terpisah dari plastik.</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">2</span><b>🪱 Jadikan pakan maggot (BSF)</b><span class="acc-chev">⌄</span></summary>
      <p>Sampah organik menjadi pakan budidaya maggot. Media awalnya cukup <b>galon/botol bekas</b> secara swadaya di tiap dusun — tidak perlu kandang mahal. Maggot yang dipanen bernilai jual sebagai pakan ternak.</p>
    </details>
    <details class="acc-item">
      <summary><span class="acc-num">3</span><b>🌱 Atau olah sendiri di rumah</b><span class="acc-chev">⌄</span></summary>
      <p>Bisa juga dijadikan <b>kompos, eco-enzyme, atau POC</b> — ikuti panduan langkah demi langkah di bagian <b>Panduan DIY</b> di bawah halaman ini.</p>
    </details>
  </div>
  <div class="info-block fact" style="margin-top:12px">
    <span class="bic">🚫</span>
    <div><b>Ingat</b><span>Membuang sampah ke sungai/irigasi dilarang — menyumbat aliran dan memicu banjir. Edukasi dasar hukumnya disampaikan tim mahasiswa saat sosialisasi.</span></div>
  </div>

  <div class="section-head">
    <span class="eyebrow">Waspada di rumah</span>
    <h2 class="section-title">Bahaya Limbah Rumah Tangga</h2>
  </div>
  <p class="muted lead">Limbah rumah tangga yang salah kelola bukan cuma bikin kotor — ia meracuni air, tanah, dan tubuh kita pelan-pelan. Materi ini disusun bersama rekan-rekan <b>Farmasi/Kesehatan</b> dan prodi lain di tim KKN.</p>
  <div class="bahaya-grid">
    <div class="bahaya-card">
      <span class="bc-ic">💊</span>
      <b>Obat kadaluarsa &amp; sisa obat</b>
      <p>Dibuang ke got/tempat sampah begitu saja, zat aktifnya mencemari air dan berisiko <b>disalahgunakan atau termakan anak</b>. Rusak dulu kemasannya, keluarkan isinya, lalu serahkan ke apotek/puskesmas.</p>
    </div>
    <div class="bahaya-card">
      <span class="bc-ic">🛢️</span>
      <b>Minyak jelantah</b>
      <p>Satu liter jelantah bisa mencemari <b>ribuan liter air bersih</b> dan menyumbat saluran. Dipakai menggoreng berulang juga memicu kolesterol &amp; radikal bebas. Tampung di botol tertutup, setor/jual ke pengepul.</p>
    </div>
    <div class="bahaya-card">
      <span class="bc-ic">🔋</span>
      <b>Baterai, lampu, &amp; elektronik bekas</b>
      <p>Mengandung logam berat (merkuri, kadmium, timbal) yang meresap ke tanah &amp; air sumur — memicu <b>gangguan saraf dan ginjal</b>. Kumpulkan terpisah sebagai sampah B3, jangan dibakar atau ditimbun.</p>
    </div>
    <div class="bahaya-card">
      <span class="bc-ic">🫧</span>
      <b>Detergen &amp; pembersih kimia</b>
      <p>Fosfat dan busa berlebih membuat got bau, mematikan ikan, dan menyuburkan gulma air (eutrofikasi). Pilih detergen <b>bebas fosfat</b>, pakai secukupnya, dan jangan buang air cucian langsung ke sungai.</p>
    </div>
    <div class="bahaya-card">
      <span class="bc-ic">🔥</span>
      <b>Membakar sampah plastik</b>
      <p>Asapnya mengandung <b>dioksin</b> — pemicu ISPA, gangguan hormon, hingga kanker — dan justru paling banyak terhirup keluarga sendiri di pekarangan. Kumpulkan plastik untuk ditabung, bukan dibakar.</p>
    </div>
    <div class="bahaya-card">
      <span class="bc-ic">🦟</span>
      <b>Sampah menumpuk &amp; air tergenang</b>
      <p>Jadi sarang nyamuk, lalat, dan tikus — sumber <b>DBD, diare, tifus, dan leptospirosis</b>. Genangan di irigasi yang tersumbat sampah juga memicu banjir. Pilah &amp; setor rutin agar tidak menumpuk.</p>
    </div>
  </div>
  <div class="info-block fact" style="margin-top:12px">
    <span class="bic">⚖️</span>
    <div><b>Dasar hukum</b><span>UU No. 18 Tahun 2008 tentang Pengelolaan Sampah melarang membuang sampah sembarangan dan membakar sampah yang tidak sesuai persyaratan teknis. Edukasi hukumnya disampaikan rekan prodi Hukum; dampak kesehatan oleh Farmasi; motivasi kebiasaan baru oleh Psikologi; dan nilai ekonominya oleh Manajemen.</span></div>
  </div>

  <div class="section-head">
    <span class="eyebrow">Tonton &amp; pelajari</span>
    <h2 class="section-title">Video Edukasi</h2>
  </div>
  <p class="muted">Video cara memilah sampah, sosialisasi, dan dokumentasi kegiatan. Ketuk sampulnya untuk memutar — video baru dimuat saat ditekan supaya hemat kuota. Video dikelola pengurus lewat panel admin.</p>
  <div class="video-grid">
    @forelse($videos as $v)
      @if($v->embed_url)
        {{-- Sampul dulu, iframe baru dimuat saat diketuk (hemat kuota & tak ada kotak putih menunggu). --}}
        <div class="video-card">
          <div class="frame">
            <button type="button" class="frame-play" data-embed="{{ $v->embed_url }}" data-judul="{{ $v->judul }}"
                    aria-label="Putar video {{ $v->judul }}">
              @if($v->thumb_url)
                <img src="{{ $v->thumb_url }}" alt="" onerror="this.remove()">
              @endif
              <span class="fp-play" aria-hidden="true">▶</span>
            </button>
          </div>
          <div class="cap">
            <b>🎬 {{ $v->judul }}</b>
            <a href="{{ $v->watch_url }}" target="_blank" rel="noopener">Buka di {{ $v->provider }} ↗</a>
          </div>
        </div>
      @elseif($v->is_file)
        <div class="video-card">
          <div class="frame"><video src="{{ $v->youtube_url }}" controls playsinline preload="none"></video></div>
          <div class="cap"><b>🎬 {{ $v->judul }}</b></div>
        </div>
      @else
        <div class="video-card">
          <a class="frame frame-link" href="{{ $v->youtube_url }}" target="_blank" rel="noopener"><span>Tonton video</span></a>
          <div class="cap"><b>🎬 {{ $v->judul }}</b></div>
        </div>
      @endif
    @empty
      <div class="card muted" style="grid-column:1/-1">Belum ada video edukasi. Pengurus dapat menambahkannya lewat panel admin → Video Edukasi.</div>
    @endforelse
  </div>

  <div class="section-head">
    <span class="eyebrow">Cetak &amp; sebarkan</span>
    <h2 class="section-title">Poster Kampanye</h2>
  </div>
  <p class="muted">Poster ajakan memilah sampah karya tim dokumentasi — siap diunduh untuk dicetak atau dibagikan ke grup WhatsApp warga.</p>
  <div class="poster-grid">
    @forelse($posters as $p)
      <figure class="poster-card">
        <img src="{{ $p->url }}" alt="{{ $p->judul }}" loading="lazy">
        <figcaption>
          <b>{{ $p->judul }}</b>
          @if($p->keterangan)<span>{{ $p->keterangan }}</span>@endif
          <a class="btn-ghost pc-dl" href="{{ $p->url }}" download>⬇️ Unduh</a>
        </figcaption>
      </figure>
    @empty
      <div class="card muted" style="grid-column:1/-1">Belum ada poster. Pengurus dapat mengunggahnya lewat panel admin → Poster Kampanye.</div>
    @endforelse
  </div>

  <div class="section-head" id="diy">
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
    <details class="diy"><summary><span class="diy-ic">❓</span> Apa itu Bank Sampah?</summary><div class="diy-body"><p>Tempat menabung sampah anorganik yang dipusatkan di Kantor Desa. Sampahmu ditimbang (disaksikan langsung olehmu), dicatat di buku tabungan fisik dan pencatatan digital, lalu nilainya bisa dicairkan menjadi uang atau sembako.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">♻️</span> Sampah apa saja yang diterima?</summary><div class="diy-body"><p>Bank Sampah hanya menerima <b>botol plastik</b> dan <b>gelas/cup kemasan</b> dalam kondisi bersih &amp; kering. Jenis sampah lain tetap perlu dipilah di rumah — panduan lengkapnya ada di menu Pilah.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">🧺</span> Apakah harus memilah dulu di rumah?</summary><div class="diy-body"><p>Tidak wajib — sampah yang <b>belum dipilah pun tetap dibeli</b> oleh pengepul. Tapi memilah dari rumah tetap dianjurkan: penimbangan lebih cepat, dan sampah organik bisa langsung diolah jadi kompos &amp; pakan maggot.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">👥</span> Bagaimana sistem setorannya?</summary><div class="diy-body"><p>Per kelompok dusun (5 dusun, ±10 warga perwakilan tiap dusun pada tahap uji coba), dengan target minimal 5 kg plastik per kelompok tiap minggu. Pembagian kuota di dalam kelompok disepakati bersama anggota dusun masing-masing.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">⚖️</span> Kalau setoran belum sampai 5 kg?</summary><div class="diy-body"><p>Tidak hangus. Beratnya tercatat dan diakumulasikan ke minggu berikutnya sampai mencapai target penukaran.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">🚚</span> Dusun saya jauh dari Kantor Desa, bagaimana?</summary><div class="diy-body"><p>Pengangkutan kolektif seminggu sekali akan dibantu Kepala Dusun / Linmas, jadi warga tidak terbebani ongkos bensin.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">📅</span> Kapan Bank Sampah beroperasi penuh?</summary><div class="diy-body"><p>Uji coba dimulai Juli 2026 diawali sosialisasi &amp; praktik pemilahan. Setelah uji coba berhasil, pengembangan skala penuh dilanjutkan oleh pihak desa.</p></div></details>
    <details class="diy"><summary><span class="diy-ic">🙋</span> Bagaimana cara ikut serta?</summary><div class="diy-body"><p>Hubungi ketua kelompok / kepala dusun masing-masing, datang ke Kantor Kepala Desa Pajaten, atau temui mahasiswa KKN saat sosialisasi &amp; kunjungan ke rumah warga.</p></div></details>
  </div>
@endsection

@push('scripts')
<script>
/* Video rekaman HP itu potret. Sesuaikan tinggi bingkainya biar tidak penuh bilah hitam. */
document.querySelectorAll('.frame-play img').forEach(function (img) {
  var tandai = function () {
    if (img.naturalHeight > img.naturalWidth) {
      img.closest('.video-card').classList.add('is-portrait');
    }
  };
  if (img.complete && img.naturalWidth) { tandai(); } else { img.addEventListener('load', tandai, { once: true }); }
});

/* Sampul video → iframe. Iframe baru dibuat setelah warga menekan tombol putar. */
document.querySelectorAll('.frame-play').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var f = document.createElement('iframe');
    f.src = btn.dataset.embed;
    f.title = btn.dataset.judul || 'Video edukasi';
    f.allow = 'autoplay; encrypted-media; fullscreen';
    f.allowFullscreen = true;
    btn.replaceWith(f);
  }, { once: true });
});
</script>
@endpush
