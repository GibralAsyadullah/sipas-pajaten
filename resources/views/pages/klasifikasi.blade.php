@extends('layouts.app')
@section('title', 'Klasifikasi Sampah')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Panduan pilah</span>
    <h2 class="section-title">Barang Ini Masuk Mana?</h2>
  </div>
  <p class="muted">Ketik nama barangnya — langsung ketahuan golongannya dan harus diapakan.</p>

  <input class="search" id="searchKlas" placeholder="🔍 Barang apa yang mau kamu buang? mis. baterai, kulit pisang…" oninput="renderKlas()" aria-label="Cari klasifikasi barang">

  <div class="quick-flow" aria-label="Alur cepat menentukan kategori">
    <p class="qf-title">Tidak ketemu? Jawab 3 pertanyaan ini:</p>
    <div class="qf-grid">
      <button class="qf-card o" onclick="setKlasFilterTo('organik')">
        <b>1. Cepat busuk / sisa makhluk hidup?</b>
        <span>→ 🍃 Organik (tempat hijau)</span>
      </button>
      <button class="qf-card a" onclick="setKlasFilterTo('anorganik')">
        <b>2. Kering, tidak membusuk &amp; tidak beracun?</b>
        <span>→ 🧴 Anorganik (kuning) — bisa ditabung!</span>
      </button>
      <button class="qf-card b" onclick="setKlasFilterTo('b3')">
        <b>3. Beracun? Baterai, obat, oli, elektronik?</b>
        <span>→ ☢️ B3 (tempat merah)</span>
      </button>
    </div>
  </div>

  <div class="bin-guide" id="binGuide" aria-label="Saring menurut kategori">
    <button class="bin-g green" data-k="organik" onclick="toggleKlasFilter(this)">
      <span class="bg-ic">🍃</span><b>Hijau</b><span>Organik</span><span class="cnt" id="cntOrg"></span>
    </button>
    <button class="bin-g yellow" data-k="anorganik" onclick="toggleKlasFilter(this)">
      <span class="bg-ic">🧴</span><b>Kuning</b><span>Anorganik</span><span class="cnt" id="cntAno"></span>
    </button>
    <button class="bin-g red" data-k="b3" onclick="toggleKlasFilter(this)">
      <span class="bg-ic">☢️</span><b>Merah</b><span>B3</span><span class="cnt" id="cntB3"></span>
    </button>
  </div>
  <p class="klas-count" id="klasCount" aria-live="polite"></p>

  <div class="filter-panel">
    <div class="fp-row">
      <span class="filter-label">🗂️ Sumber sampah</span>
      <div class="filter-row filter-sumber">
        <button class="filter-chip active" data-s="semua" onclick="setSumberFilter(this)">Semua</button>
        <button class="filter-chip" data-s="rumah" onclick="setSumberFilter(this)">🏠 Rumah Tangga</button>
        <button class="filter-chip" data-s="kebun" onclick="setSumberFilter(this)">🌿 Kebun &amp; Halaman</button>
        <button class="filter-chip" data-s="tani" onclick="setSumberFilter(this)">🌾 Sawah &amp; Ternak</button>
        <button class="filter-chip" data-s="usaha" onclick="setSumberFilter(this)">🏪 Warung &amp; Pasar</button>
        <button class="filter-chip" data-s="bengkel" onclick="setSumberFilter(this)">🔧 Elektronik &amp; Bengkel</button>
      </div>
    </div>
    <div class="fp-row fp-sort">
      <span class="filter-label">↕️ Urutkan</span>
      <select id="klasSort" class="klas-sort" onchange="renderKlas()" aria-label="Urutkan daftar">
        <option value="default">Urutan bawaan</option>
        <option value="az">Nama A–Z</option>
        <option value="za">Nama Z–A</option>
      </select>
    </div>
  </div>

  <div class="klas-grid" id="klasGrid">
    <div class="klas-col o" id="colOrganik">
      <h3>🍃 Organik <span style="font-weight:500;font-size:.78rem;opacity:.75">→ kompos / pakan maggot</span></h3>
      <div id="listOrganik"></div>
    </div>
    <div class="klas-col a" id="colAnorganik">
      <h3>🧴 Anorganik <span class="klas-arrow">→</span>
        <a class="klas-chip" href="#alur-tabung" onclick="jumpTo('alur-tabung');return false">🏦 Bank Sampah</a>
      </h3>
      <div id="listAnorganik"></div>
    </div>
    <div class="klas-col b" id="colB3">
      <h3>☢️ B3 <span style="font-weight:500;font-size:.78rem;opacity:.75">→ fasilitas khusus</span></h3>
      <div id="listB3"></div>
    </div>
  </div>
  <p class="hint" id="klasEmpty" style="display:none">Tidak ada barang yang cocok dengan pencarian. Coba kata kunci lain, atau pakai alur 3 pertanyaan di atas.</p>

  <div class="section-head" id="alur-tabung">
    <span class="eyebrow">Setelah dipilah</span>
    <h2 class="section-title">Dari Pilahan Jadi Tabungan 💰</h2>
  </div>
  <p class="muted">Sampah <b>botol plastik &amp; gelas/cup kemasan</b> yang sudah kamu pilah bisa ditabung ke Bank Sampah desa. Begini alurnya:</p>
  <div class="alurbs">
    <div class="alurbs-step"><span class="as-num">1</span><span class="as-ic">🏠</span><b>Pilah di Rumah</b><span>Pisahkan botol plastik &amp; gelas/cup kemasan. Sampah organik diolah jadi kompos &amp; pakan maggot.</span></div>
    <div class="alurbs-step"><span class="as-num">2</span><span class="as-ic">🤝</span><b>Setor ke RT / Kadus</b><span>Sampah dikoordinasikan lewat RT &amp; Kepala Dusun — tidak perlu bawa sendiri ke desa.</span></div>
    <div class="alurbs-step"><span class="as-num">3</span><span class="as-ic">⚖️</span><b>Timbang &amp; Catat</b><span>Di titik kumpul desa, sampah ditimbang lalu dicatat di buku fisik dan sistem digital.</span></div>
    <div class="alurbs-step"><span class="as-num">4</span><span class="as-ic">🚛</span><b>Diangkut Pengepul</b><span>Setiap hari <b>Kamis</b>, pengepul mengangkut sampah yang terkumpul di desa.</span></div>
    <div class="alurbs-step"><span class="as-num">5</span><span class="as-ic">💰</span><b>Tabungan Cair</b><span>Capai target setoran <b>5 kg per dusun</b>, tabungan sampahmu bisa dicairkan.</span></div>
  </div>
  <div class="alur-note">
    <div class="an ok"><b>✅ Diterima Bank Sampah</b><span>Hanya <b>botol plastik</b> dan <b>gelas/cup kemasan</b> — bersih &amp; kering.</span></div>
    <div class="an no"><b>🚫 Tidak diterima</b><span>Pampers / popok sekali pakai — tangani terpisah sebagai residu.</span></div>
  </div>

  <div class="b3-warn" id="b3info">
    <span class="bw-ic">⚠️</span>
    <div>
      <b>Penting soal sampah B3</b>
      <p>Jangan dicampur, dibakar, atau dibuang ke tanah/saluran air. Kumpulkan terpisah dalam wadah tertutup, lalu serahkan ke <b>dropbox B3</b>, <b>puskesmas/apotek</b> (obat), atau <b>pengepul resmi</b> (aki, oli, elektronik).</p>
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{ asset('js/klasifikasi.js') }}"></script>
@endpush
