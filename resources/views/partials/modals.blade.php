<!-- ===== MODAL DETAIL KLASIFIKASI ===== -->
<div class="modal-overlay" id="klasModal" role="dialog" aria-modal="true" aria-labelledby="mTitle" onclick="if(event.target===this)closeKlasModal()">
  <div class="modal">
    <div class="grab"></div>
    <div class="modal-hero">
      <div class="modal-emoji" id="mEmoji">🍌</div>
      <div>
        <h3 id="mTitle">Kulit pisang</h3>
        <span class="jenis" id="mJenis">🍃 Organik</span>
      </div>
    </div>
    <div class="modal-info">
      <div class="info-block"><span class="bic">♻️</span><div><b>Cara mengolah</b><span id="mCara">—</span></div></div>
      <div class="info-block"><span class="bic">⏳</span><div><b>Lama terurai di alam</b><span id="mUrai">—</span></div></div>
      <div class="info-block fact"><span class="bic">💡</span><div><b>Tahukah kamu?</b><span id="mFakta">—</span></div></div>
    </div>
    <button class="modal-close" onclick="closeKlasModal()">Mengerti! 👍</button>
  </div>
</div>

<!-- ===== PENCARIAN GLOBAL ===== -->
<div class="search-overlay" id="searchOverlay" role="dialog" aria-modal="true" aria-label="Pencarian" onclick="if(event.target===this)closeSearch()">
  <div class="search-panel">
    <div class="search-bar">
      <span class="sb-ic">🔍</span>
      <input id="globalSearch" type="text" placeholder="Cari sampah, program, jadwal, lokasi…" oninput="runSearch()" autocomplete="off" aria-label="Kotak pencarian">
      <button class="sb-close" onclick="closeSearch()" aria-label="Tutup pencarian">✕</button>
    </div>
    <div class="search-body" id="searchBody"></div>
  </div>
</div>

<!-- ===== PENGATURAN ===== -->
<div class="modal-overlay" id="setOverlay" role="dialog" aria-modal="true" aria-label="Pengaturan" onclick="if(event.target===this)closeSettings()">
  <div class="modal">
    <div class="grab"></div>
    <h3 style="font-family:var(--font-serif);font-weight:600;font-size:1.3rem;margin-bottom:4px">⚙️ Pengaturan</h3>
    <p class="muted" style="font-size:.82rem;margin-bottom:8px">Sesuaikan tampilan agar nyaman dibaca.</p>
    <div class="set-row">
      <span class="set-ic">🌙</span>
      <span class="set-lbl"><b>Mode Gelap</b><small>Nyaman di mata saat malam</small></span>
      <label class="switch"><input type="checkbox" id="darkToggle" onchange="toggleDark()" aria-label="Mode gelap"><span class="track"></span></label>
    </div>
    <div class="set-row">
      <span class="set-ic">🔤</span>
      <span class="set-lbl"><b>Ukuran Teks</b><small>Perbesar untuk mudah dibaca</small></span>
      <div class="fs-btns" id="fsBtns">
        <button data-fs="sm" onclick="setFont('sm',this)">A</button>
        <button data-fs="" class="active" onclick="setFont('',this)">A</button>
        <button data-fs="lg" onclick="setFont('lg',this)">A</button>
      </div>
    </div>
    <div class="set-links">
      <a class="btn-link ig-btn" href="https://www.instagram.com/kkncibuaya2026_" target="_blank" rel="noopener">📷 Instagram</a>
      <a class="btn-link drive-btn" href="https://drive.google.com/drive/folders/1rPKo7NtkP8UnnkeLtajiRxPkfGhHwrb9" target="_blank" rel="noopener">🗂️ Drive</a>
    </div>
    <button class="btn-main" style="width:100%;margin-top:10px" onclick="shareApp()">🔗 Bagikan Aplikasi</button>
    <div id="shareMsg" style="text-align:center;font-size:.78rem;color:var(--pine-2);font-weight:700;margin-top:8px;min-height:16px"></div>
    <button class="modal-close" onclick="closeSettings()">Selesai</button>
  </div>
</div>

<button class="to-top" id="toTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Kembali ke atas">↑</button>

