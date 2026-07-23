@extends('layouts.app')
@section('title', 'Masuk Pengurus')
@section('content')
<div class="card" style="max-width:420px;margin:24px auto">
  <div class="section-head">
    <h2>🔑 Masuk Pengurus</h2>
    <p class="muted">Khusus tim KKN & pengurus desa untuk mengelola laporan, galeri, jadwal, anggota, dan UMKM.</p>
  </div>

  @error('email')<p class="hint flash-err">⚠️ {{ $message }}</p>@enderror

  <form method="POST" action="{{ route('login.attempt') }}" class="report-form" style="margin-top:10px">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" placeholder="📧 Email pengurus" aria-label="Email" required autofocus>
    <input type="password" name="password" placeholder="🔒 Kata sandi" aria-label="Kata sandi" required>
    <label style="display:flex;align-items:center;gap:8px;font-size:.8rem;color:var(--ink-soft)">
      <input type="checkbox" name="remember" value="1" style="width:auto"> Tetap masuk di perangkat ini
    </label>
    <button class="btn-main" type="submit" style="width:100%">Masuk</button>
  </form>

  <p class="hint" style="margin-top:12px"><a href="{{ route('dashboard') }}">← Kembali ke beranda</a></p>
</div>
@endsection
