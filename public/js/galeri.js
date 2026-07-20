/* galeri.js — filter per bulan (album + foto lepas), mode tampilan & lightbox */
function setFilter(btn){
  document.querySelectorAll('.filter-chip').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  const f=btn.dataset.f;
  document.querySelectorAll('.jr-item, .foto-card').forEach(c=>{
    c.style.display=(f==='semua'||c.dataset.f===f)?'':'none';
  });
}

/* ---- mode tampilan: timeline (jurnal) vs grid (semua foto) ---- */
function setView(btn){
  document.querySelectorAll('.vt-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  const grid=btn.dataset.v==='grid';
  document.getElementById('timelineView').classList.toggle('hidden',grid);
  document.getElementById('gridView').classList.toggle('hidden',!grid);
}

/* lightbox foto kini global — lihat app.js */

/* ---- kolase feed IG: tampilkan 9 dulu, sisanya di balik tombol ---- */
function toggleIgAll(btn){
  const buka=btn.dataset.open!=='1';
  document.querySelectorAll('.ig-kolase .ig-hide').forEach(el=>el.classList.toggle('show',buka));
  btn.dataset.open=buka?'1':'0';
  btn.textContent=buka?'⬆ Sembunyikan':'⬇ Tampilkan semua '+btn.dataset.total+' post';
}
