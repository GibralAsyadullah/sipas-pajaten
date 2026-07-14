@extends('layouts.app')
@section('title', 'Jadwal & Catatan')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Agenda</span>
    <h2 class="section-title">Jadwal Kegiatan</h2>
  </div>
  <p class="muted lead">Perjalanan kegiatan KKN Cibuaya 2026 di Desa Pajaten — dari pembekalan hingga peresmian Bank Sampah.</p>

  <div class="jsum reveal">
    <div class="jsum-ring" id="jRing" data-pct="{{ $jPct }}"><span id="jPct">0%</span></div>
    <div class="jsum-txt"><b>{{ $jDone }} dari {{ $jTotal }} agenda utama selesai</b><span>Terus pantau perkembangan program.</span></div>
  </div>

  <div class="timeline" id="timeline">
    @foreach ($schedules as $i => $j)
      @php
        $mark = ['done' => '✓', 'ongoing' => '●', 'upcoming' => '○'][$j->status];
        $stLbl = ['done' => 'Selesai', 'ongoing' => 'Rutin', 'upcoming' => 'Akan datang'][$j->status];
      @endphp
      <div class="tl-item {{ $j->status }} reveal" style="transition-delay:{{ $i * 70 }}ms">
        <div class="tl-dot">{{ $mark }}</div>
        <div class="tl-card">
          <div class="tl-head"><span class="tl-date">📅 {{ $j->periode }}</span><span class="tl-badge {{ $j->status }}">{{ $stLbl }}</span></div>
          <b><span class="tl-ic">{{ $j->ikon }}</span>{{ $j->judul }}</b><span class="tl-desc">{{ $j->deskripsi }}</span>
        </div>
      </div>
    @endforeach
  </div>

  <div class="section-head">
    <span class="eyebrow">Buku harian</span>
    <h2 class="section-title">Catatan Kegiatan</h2>
  </div>
  <p class="muted">Catat kegiatan harianmu di sini — tersimpan permanen di database.</p>
  <p class="hint admin-only" id="catatan">✍️ Tambah / hapus catatan lewat <a href="/admin">Panel Pengurus</a>.</p>
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
