@extends('layouts.app')
@section('title', 'Galeri Dokumentasi')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Rekam jejak</span>
    <h2 class="section-title">Jurnal Kegiatan KKN</h2>
  </div>
  <p class="muted">Perjalanan KKN Cibuaya 2026 di Desa Pajaten, hari demi hari. Ketuk foto untuk memperbesar.</p>

  @php
    $hitungBulan = fn ($m) => $albums->filter(fn ($a) => $a->tanggal->translatedFormat('F') === $m)->count()
        + $photos->where('bulan', $m)->count();
  @endphp
  <div class="galeri-tools">
    <div class="filter-row" id="filterRow">
      <button class="filter-chip active" data-f="semua" onclick="setFilter(this)">Semua <span class="cnt">{{ $albums->count() + $photos->count() }}</span></button>
      @foreach($months as $m)
        <button class="filter-chip" data-f="{{ $m }}" onclick="setFilter(this)">{{ $m }} <span class="cnt">{{ $hitungBulan($m) }}</span></button>
      @endforeach
    </div>
    <div class="view-toggle" role="group" aria-label="Mode tampilan galeri">
      <button class="vt-btn active" data-v="timeline" onclick="setView(this)">📜 Timeline</button>
      <button class="vt-btn" data-v="grid" onclick="setView(this)">🔲 Grid</button>
    </div>
  </div>

  <div id="timelineView">
  <div class="jurnal" id="jurnalList">
    @forelse($albums as $al)
      <div class="jr-item" data-f="{{ $al->tanggal->translatedFormat('F') }}">
        <div class="jr-side">
          <span class="jr-day">{{ $al->hari ? 'D'.$al->hari : 'Pra' }}</span>
          @unless($loop->last)<span class="jr-line"></span>@endunless
        </div>
        <div class="jr-card">
          <span class="jr-date">{{ $al->hari ? 'Hari ke-'.$al->hari : 'Pra-KKN' }} · {{ $al->tanggal->translatedFormat('j F Y') }}</span>
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
  </div>

  <div class="galeri-grid hidden" id="gridView">
    @foreach($albums as $al)
      @foreach($al->photos as $p)
        <div class="foto-card" data-f="{{ $al->tanggal->translatedFormat('F') }}">
          <img class="jr-ph" src="{{ $p->url }}" alt="{{ $p->caption }}" loading="lazy" data-cap="{{ $p->caption }}">
          <div class="cap">{{ $p->caption ?: $al->judul }}<small>{{ $al->hari ? 'Hari ke-'.$al->hari : 'Pra-KKN' }} · {{ $al->tanggal->translatedFormat('j M Y') }}</small></div>
        </div>
      @endforeach
    @endforeach
    @foreach ($photos as $f)
      <div class="foto-card" data-f="{{ $f->bulan }}">
        <img class="jr-ph" src="{{ $f->url }}" alt="{{ $f->caption }}" loading="lazy" data-cap="{{ $f->caption }}">
        <div class="cap">{{ $f->caption }}<small>{{ $f->label }}</small></div>
      </div>
    @endforeach
  </div>

  @if($igFeed->count())
    <div class="section-head">
      <span class="eyebrow">Kolase</span>
      <h2 class="section-title">Feed Instagram &#64;kkncibuaya2026_</h2>
    </div>
    <p class="muted">Rekam jejak kegiatan dalam desain feed Instagram — ketuk post untuk memperbesar.</p>
    <div class="ig-kolase">
      @foreach($igFeed as $p)
        <img class="jr-ph{{ $loop->index >= 9 ? ' ig-hide' : '' }}" src="{{ $p->url }}" alt="{{ $p->caption }}" loading="lazy" data-cap="{{ $p->caption }}">
      @endforeach
    </div>
    @if($igFeed->count() > 9)
      <div class="btn-row" style="margin-top:10px">
        <button class="btn-ghost" data-open="0" data-total="{{ $igFeed->count() }}" onclick="toggleIgAll(this)">⬇ Tampilkan semua {{ $igFeed->count() }} post</button>
      </div>
    @endif
  @endif

  <div class="btn-row">
    <a class="btn-link ig-btn" href="https://www.instagram.com/kkncibuaya2026_" target="_blank" rel="noopener">📷 Lihat di Instagram</a>
  </div>

@endsection

@push('scripts')
<script src="@aset('js/galeri.js')"></script>
@endpush
