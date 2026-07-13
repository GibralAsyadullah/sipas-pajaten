@extends('layouts.app')
@section('title', 'Klasifikasi Sampah')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Panduan pilah</span>
    <h2 class="section-title">Daftar Klasifikasi Sampah</h2>
  </div>
  <p class="muted">Cari nama barang untuk tahu masuk golongan mana, plus saran pengolahannya di program KKN Pajaten.</p>

  <div class="bin-guide" aria-label="Panduan warna tempat sampah">
    <div class="bin-g green"><span class="bg-ic">🍃</span><b>Hijau</b><span>Organik</span></div>
    <div class="bin-g yellow"><span class="bg-ic">🧴</span><b>Kuning</b><span>Anorganik</span></div>
    <div class="bin-g red"><span class="bg-ic">☢️</span><b>Merah</b><span>B3</span></div>
  </div>

  <input class="search" id="searchKlas" placeholder="🔍 Cari barang… misal: botol, baterai, kardus" oninput="renderKlas()" aria-label="Cari klasifikasi barang">

  <div class="filter-row">
    <button class="filter-chip active" data-k="semua" onclick="setKlasFilter(this)">Semua <span class="cnt" id="cntSemua"></span></button>
    <button class="filter-chip" data-k="organik" onclick="setKlasFilter(this)">🍃 Organik <span class="cnt" id="cntOrg"></span></button>
    <button class="filter-chip" data-k="anorganik" onclick="setKlasFilter(this)">🧴 Anorganik <span class="cnt" id="cntAno"></span></button>
    <button class="filter-chip" data-k="b3" onclick="setKlasFilter(this)">☢️ B3 <span class="cnt" id="cntB3"></span></button>
  </div>

  <div class="klas-grid" id="klasGrid">
    <div class="klas-col o" id="colOrganik">
      <h3>🍃 Organik <span style="font-weight:500;font-size:.78rem;opacity:.75">→ kompos / maggot / POC</span></h3>
      <div id="listOrganik"></div>
    </div>
    <div class="klas-col a" id="colAnorganik">
      <h3>🧴 Anorganik <span style="font-weight:500;font-size:.78rem;opacity:.75">→ Bank Sampah</span></h3>
      <div id="listAnorganik"></div>
    </div>
    <div class="klas-col b" id="colB3">
      <h3>☢️ B3 <span style="font-weight:500;font-size:.78rem;opacity:.75">→ fasilitas khusus</span></h3>
      <div id="listB3"></div>
    </div>
  </div>
  <p class="hint" id="klasEmpty" style="display:none">Tidak ada barang yang cocok dengan pencarian. Coba kata kunci lain.</p>

  <div class="b3-warn">
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
