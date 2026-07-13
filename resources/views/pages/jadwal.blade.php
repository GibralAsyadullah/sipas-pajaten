@extends('layouts.app')
@section('title', 'Jadwal & Catatan')
@section('content')
  <div class="section-head">
    <span class="eyebrow">Agenda</span>
    <h2 class="section-title">Jadwal Kegiatan</h2>
  </div>
  <p class="muted lead">Perjalanan kegiatan KKN Cibuaya 2026 di Desa Pajaten — dari pembekalan hingga peresmian Bank Sampah.</p>

  <div class="jsum reveal">
    <div class="jsum-ring" id="jRing"><span id="jPct">0%</span></div>
    <div class="jsum-txt"><b id="jDone">0 dari 0 agenda selesai</b><span>Terus pantau perkembangan program.</span></div>
  </div>

  <div class="timeline" id="timeline"></div>

  <div class="section-head">
    <span class="eyebrow">Buku harian</span>
    <h2 class="section-title">Catatan Kegiatan <span class="badge-proto">prototype: sementara</span></h2>
  </div>
  <p class="muted">Catat kegiatan harianmu di sini (tersimpan sementara selama sesi).</p>
  <div class="input-row">
    <input id="noteText" placeholder="Tulis catatan kegiatan hari ini…" aria-label="Catatan baru">
    <button class="btn-main" onclick="addNote()">Simpan</button>
  </div>
  <div class="notes-list" id="notesList"></div>
@endsection

@push('scripts')
<script src="{{ asset('js/jadwal.js') }}"></script>
@endpush
