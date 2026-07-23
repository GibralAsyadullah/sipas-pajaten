{{-- Kartu papan informasi lingkungan. Dipakai di Beranda & Lokasi.
     $ringkas = true  -> versi beranda (ada tombol ke halaman Lokasi) --}}
<div class="papan-card reveal">
  <img class="papan-foto" src="{{ asset('img/profil/papan-informasi.jpg') }}"
       alt="Papan informasi kayu bertuliskan “Berapa Lama Sampahmu Terurai?” di halaman Kantor Kepala Desa Pajaten" loading="lazy">
  <div class="papan-body">
    <b class="papan-q">Berapa lama sampahmu terurai?</b>
    <ol class="papan-list">
      <li>
        <span class="pl-ic">🧊</span>
        <span class="pl-txt"><b>Styrofoam</b><span class="pl-dur never">Tidak terurai</span></span>
      </li>
      <li>
        <span class="pl-ic">🍶</span>
        <span class="pl-txt"><b>Botol plastik</b><span class="pl-dur">500 tahun</span></span>
      </li>
      <li>
        <span class="pl-ic">🥫</span>
        <span class="pl-txt"><b>Kaleng</b><span class="pl-dur">200 tahun</span></span>
      </li>
      <li>
        <span class="pl-ic">🥛</span>
        <span class="pl-txt"><b>Kemasan susu kotak</b><span class="pl-dur">20 tahun</span></span>
      </li>
      <li>
        <span class="pl-ic">🛍️</span>
        <span class="pl-txt"><b>Plastik kemasan</b><span class="pl-dur">10–20 tahun</span></span>
      </li>
    </ol>
    @if (!empty($ringkas))
      <button class="btn-ghost" style="align-self:flex-start" onclick="gotoTab('lokasi')">📍 Lihat lokasinya</button>
    @else
      <span class="papan-foot">📍 Halaman Kantor Kepala Desa Pajaten · KKN-UBP Karawang 2026</span>
    @endif
  </div>
</div>
