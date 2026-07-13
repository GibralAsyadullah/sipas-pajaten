<nav class="tabbar" aria-label="Navigasi utama">
  <a class="tab {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span class="ic">🏠</span>Beranda</a>
  <a class="tab {{ request()->routeIs('lokasi') ? 'active' : '' }}" href="{{ route('lokasi') }}"><span class="ic">📍</span>Lokasi</a>
  <a class="tab {{ request()->routeIs('game') ? 'active' : '' }}" href="{{ route('game') }}"><span class="ic">🎮</span>Game</a>
  <a class="tab {{ request()->routeIs('paparan') ? 'active' : '' }}" href="{{ route('paparan') }}"><span class="ic">📺</span>Edukasi</a>
  <a class="tab {{ request()->routeIs('klasifikasi') ? 'active' : '' }}" href="{{ route('klasifikasi') }}"><span class="ic">🗂️</span>Pilah</a>
  <a class="tab {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}"><span class="ic">📸</span>Galeri</a>
  <a class="tab {{ request()->routeIs('jadwal') ? 'active' : '' }}" href="{{ route('jadwal') }}"><span class="ic">🗓️</span>Jadwal</a>
  <a class="tab {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}"><span class="ic">ℹ️</span>Tentang</a>
</nav>
