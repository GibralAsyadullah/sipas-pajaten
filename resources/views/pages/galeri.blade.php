@extends('layouts.app')
@section('title', 'Galeri Dokumentasi')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Rekam jejak</span>
    <h2 class="section-title">Galeri Dokumentasi</h2>
  </div>
  <p class="muted">Perjalanan KKN Cibuaya 2026 dari pembekalan sampai pelaksanaan di desa. Arsip lengkap tersimpan di Google Drive tim.</p>

  <div class="filter-row" id="filterRow">
    <button class="filter-chip active" data-f="semua" onclick="setFilter(this)">Semua</button>
    <button class="filter-chip" data-f="Juni" onclick="setFilter(this)">Juni 2026</button>
    <button class="filter-chip" data-f="Juli" onclick="setFilter(this)">Juli 2026</button>
  </div>

  <div class="galeri-grid" id="galeriGrid">
    @forelse ($photos as $f)
      <div class="foto-card" data-f="{{ $f->bulan }}">
        <img src="{{ $f->url }}" alt="{{ $f->caption }}" loading="lazy">
        <div class="cap">{{ $f->caption }}<small>{{ $f->label }}</small></div>
      </div>
    @empty
      <div class="card muted" style="grid-column:1/-1">Belum ada foto.</div>
    @endforelse
  </div>

  <div class="section-head">
    <span class="eyebrow">Tambah arsip</span>
    <h2 class="section-title" style="font-size:1.15rem">Tambah Foto</h2>
  </div>
  <p class="hint admin-only">🖼️ Unggah / hapus foto lewat <a href="/admin">Panel Pengurus</a>.</p>

  <div class="btn-row">
    <a class="btn-link drive-btn" href="https://drive.google.com/drive/folders/1rPKo7NtkP8UnnkeLtajiRxPkfGhHwrb9" target="_blank" rel="noopener">🗂️ Buka Arsip Google Drive</a>
    <a class="btn-link ig-btn" href="https://www.instagram.com/kkncibuaya2026_" target="_blank" rel="noopener">📷 Lihat di Instagram</a>
  </div>
  <p class="hint">Catatan: folder Drive bersifat internal tim — butuh izin akses akun untuk membukanya.</p>
@endsection

@push('scripts')
<script src="{{ asset('js/galeri.js') }}"></script>
@endpush
