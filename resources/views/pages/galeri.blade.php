@extends('layouts.app')
@section('title', 'Galeri Dokumentasi')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Rekam jejak</span>
    <h2 class="section-title">Jurnal Kegiatan KKN</h2>
  </div>
  <p class="muted">Perjalanan KKN Cibuaya 2026 di Desa Pajaten, hari demi hari. Ketuk foto untuk memperbesar.</p>

  @if($months->count() > 1)
  <div class="filter-row" id="filterRow">
    <button class="filter-chip active" data-f="semua" onclick="setFilter(this)">Semua</button>
    @foreach($months as $m)
      <button class="filter-chip" data-f="{{ $m }}" onclick="setFilter(this)">{{ $m }}</button>
    @endforeach
  </div>
  @endif

  <div class="jurnal" id="jurnalList">
    @forelse($albums as $al)
      <div class="jr-item" data-f="{{ $al->tanggal->translatedFormat('F') }}">
        <div class="jr-side">
          <span class="jr-day">D{{ $al->hari }}</span>
          @unless($loop->last)<span class="jr-line"></span>@endunless
        </div>
        <div class="jr-card">
          <span class="jr-date">Hari ke-{{ $al->hari }} · {{ $al->tanggal->translatedFormat('j F Y') }}</span>
          <h3 class="jr-title">{{ $al->judul }}</h3>
          @if($al->cerita)<p class="jr-story">{{ $al->cerita }}</p>@endif
          @if($al->photos->count())
            <div class="jr-photos">
              @foreach($al->photos as $p)
                <img class="jr-ph" src="{{ $p->url }}" alt="{{ $p->caption }}" loading="lazy" data-cap="{{ $p->caption }}">
              @endforeach
            </div>
          @endif
          @if($al->instagram_url)
            <a class="jr-ig" href="{{ $al->instagram_url }}" target="_blank" rel="noopener">📷 Lihat post Instagram</a>
          @endif
        </div>
      </div>
    @empty
      <div class="card muted">Belum ada album kegiatan. Pengurus dapat membuatnya lewat panel admin → Album Kegiatan, lalu menautkan foto-fotonya.</div>
    @endforelse
  </div>

  @if($photos->count())
  <div class="section-head">
    <span class="eyebrow">Arsip lepas</span>
    <h2 class="section-title" style="font-size:1.15rem">Dokumentasi Lainnya</h2>
  </div>
  <div class="galeri-grid" id="galeriGrid">
    @foreach ($photos as $f)
      <div class="foto-card" data-f="{{ $f->bulan }}">
        <img class="jr-ph" src="{{ $f->url }}" alt="{{ $f->caption }}" loading="lazy" data-cap="{{ $f->caption }}">
        <div class="cap">{{ $f->caption }}<small>{{ $f->label }}</small></div>
      </div>
    @endforeach
  </div>
  @endif

  <p class="hint admin-only" style="margin-top:14px">🖼️ Kelola album &amp; foto lewat <a href="/admin">Panel Pengurus</a> → Album Kegiatan / Photos.</p>

  <div class="btn-row">
    <a class="btn-link drive-btn" href="https://drive.google.com/drive/folders/1rPKo7NtkP8UnnkeLtajiRxPkfGhHwrb9" target="_blank" rel="noopener">🗂️ Buka Arsip Google Drive</a>
    <a class="btn-link ig-btn" href="https://www.instagram.com/kkncibuaya2026_" target="_blank" rel="noopener">📷 Lihat di Instagram</a>
  </div>
  <p class="hint">Catatan: folder Drive bersifat internal tim — butuh izin akses akun untuk membukanya.</p>

  <div class="lightbox" id="lightbox" onclick="closeLightbox()" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
    <img id="lbImg" src="" alt="">
    <p id="lbCap"></p>
  </div>
@endsection

@push('scripts')
<script src="{{ asset('js/galeri.js') }}"></script>
@endpush
