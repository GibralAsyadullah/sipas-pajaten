@extends('layouts.app')
@section('title', 'Jadwal & Catatan')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Agenda</span>
    <h2 class="section-title">Jadwal Kegiatan</h2>
  </div>
  <p class="muted lead">Rundown KKN Cibuaya 2026 di Desa Pajaten, 8 Juli — 8 Agustus 2026.</p>

  <div class="jsum reveal">
    <div class="jsum-ring" id="jRing" data-pct="{{ $jPct }}"><span id="jPct">0%</span></div>
    <div class="jsum-txt"><b>{{ $jDone }} dari {{ $jTotal }} agenda selesai</b><span>Terus pantau perkembangan program.</span></div>
  </div>

  <div class="jcal-wrap reveal">
    @foreach ($kalender as $bulan)
      <div class="jcal">
        <div class="jcal-head">🗓️ {{ $bulan['label'] }}</div>
        <div class="jcal-grid">
          @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dow)
            <span class="jcal-dow">{{ $dow }}</span>
          @endforeach
          @foreach ($bulan['hari'] as $h)
            @php $cls = ($h['bulanIni'] ? '' : ' out').($h['tanggal']->isToday() ? ' today' : ''); @endphp
            @if ($h['agenda']->isNotEmpty())
              <button type="button" class="jcal-day has{{ $cls }}"
                data-t="{{ $h['tanggal']->toDateString() }}"
                data-label="{{ $h['tanggal']->translatedFormat('l, j F Y') }}"
                title="{{ $h['agenda']->pluck('judul')->implode(' · ') }}"
                aria-label="{{ $h['tanggal']->translatedFormat('j F') }}: {{ $h['agenda']->pluck('judul')->implode(', ') }}"
                onclick="pickDay(this)">
                {{ $h['tanggal']->day }}<i aria-hidden="true"></i>
              </button>
            @else
              <span class="jcal-day{{ $cls }}">{{ $h['tanggal']->day }}</span>
            @endif
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
  <p class="hint">💡 Tanggal hijau punya agenda — ketuk untuk melihat agenda hari itu saja, ketuk lagi untuk menampilkan semua.</p>
  <p class="hint jsel" id="jSelInfo" hidden>📌 Menampilkan agenda <b></b><button type="button" class="jsel-clear" onclick="clearDaySel()">✕ Tampilkan semua</button></p>

  @php
    $semuaAgenda = $pekan->flatMap(fn ($p) => $p['agenda']);
    $nOngoing  = $semuaAgenda->where('status', 'ongoing')->count();
    $nUpcoming = $semuaAgenda->where('status', 'upcoming')->count();
  @endphp
  <div class="filter-row" id="jFilter" role="group" aria-label="Saring agenda menurut status">
    <button class="filter-chip active" data-st="semua" onclick="setJadwalFilter(this)">Semua <span class="cnt">{{ $jTotal }}</span></button>
    <button class="filter-chip" data-st="done" onclick="setJadwalFilter(this)">✓ Selesai <span class="cnt">{{ $jDone }}</span></button>
    <button class="filter-chip" data-st="ongoing" onclick="setJadwalFilter(this)">● Berlangsung <span class="cnt">{{ $nOngoing }}</span></button>
    <button class="filter-chip" data-st="upcoming" onclick="setJadwalFilter(this)">○ Akan datang <span class="cnt">{{ $nUpcoming }}</span></button>
  </div>

  @foreach ($pekan as $p)
    <section class="wk reveal">
      <div class="wk-head">
        <h3 class="wk-title">{{ $p['label'] }}</h3>
        <span class="wk-range">{{ $p['rentang'] }}</span>
        <span class="wk-count">{{ $p['agenda']->count() ?: 'Belum ada' }} agenda</span>
      </div>

      @if ($p['agenda']->isEmpty())
        <p class="wk-empty">Agenda pekan ini belum ditetapkan dalam rundown.</p>
      @else
        <div class="timeline">
          @foreach ($p['agenda'] as $i => $j)
            @php
              $mark  = ['done' => '✓', 'ongoing' => '●', 'upcoming' => '○'][$j->status];
              $stLbl = ['done' => 'Selesai', 'ongoing' => 'Berlangsung', 'upcoming' => 'Akan datang'][$j->status];
            @endphp
            <div class="tl-item {{ $j->status }} reveal" id="agenda-{{ $j->id }}" data-tanggal="{{ $j->tanggal?->toDateString() }}" style="transition-delay:{{ $i * 60 }}ms">
              <div class="tl-dot">{{ $mark }}</div>
              <div class="tl-card">
                <div class="tl-head">
                  <span class="tl-date">📅 {{ $j->label_waktu }}</span>
                  <span class="tl-badge {{ $j->status }}">{{ $stLbl }}</span>
                </div>
                <b><span class="tl-ic">{{ $j->ikon }}</span>{{ $j->judul }}</b>
                @if ($j->tempat)
                  <span class="tl-place">📍 {{ $j->tempat }}</span>
                @endif
                @if ($j->deskripsi)
                  <span class="tl-desc">{{ $j->deskripsi }}</span>
                @endif
                @if ($j->hasil)
                  <div class="tl-hasil"><b>Hasil yang dicapai</b><span>{{ $j->hasil }}</span></div>
                @endif
                @if ($j->foto_urls)
                  <div class="tl-fotos n{{ count($j->foto_urls) }}">
                    @foreach ($j->foto_urls as $fu)
                      <img class="tl-foto" src="{{ $fu }}" alt="Dokumentasi: {{ $j->judul }}" data-cap="{{ $j->judul }}" loading="lazy">
                    @endforeach
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </section>
  @endforeach

  <div class="section-head">
    <span class="eyebrow">Buku harian</span>
    <h2 class="section-title">Catatan Kegiatan</h2>
  </div>
  <p class="muted">Dokumentasi singkat kegiatan tim dari hari ke hari.</p>
  <div class="notes-list" id="notesList">
    @forelse ($notes as $n)
      <div class="note"><span>📌</span><span><b style="font-size:.72rem;color:var(--ink-soft)">{{ $n->created_at->translatedFormat('l, j F') }}</b><br>{{ $n->isi }}</span>
      </div>
    @empty
      <p class="muted" style="margin-top:10px">Belum ada catatan. Tulis dokumentasi singkat kegiatan hari ini di atas.</p>
    @endforelse
  </div>
@endsection

@push('scripts')
<script src="{{ asset('js/jadwal.js') }}"></script>
@endpush
