/* galeri.js — filter per bulan (album + foto lepas) & lightbox */
function setFilter(btn){
  document.querySelectorAll('.filter-chip').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  const f=btn.dataset.f;
  document.querySelectorAll('.jr-item, #galeriGrid .foto-card').forEach(c=>{
    c.style.display=(f==='semua'||c.dataset.f===f)?'':'none';
  });
}

/* ---- lightbox foto ---- */
function openLightbox(src,cap){
  document.getElementById('lbImg').src=src;
  document.getElementById('lbCap').textContent=cap||'';
  document.getElementById('lightbox').classList.add('show');
  document.body.style.overflow='hidden';
}
function closeLightbox(){
  document.getElementById('lightbox').classList.remove('show');
  document.body.style.overflow='';
}
document.addEventListener('click',e=>{
  const img=e.target.closest('.jr-ph');
  if(img)openLightbox(img.src,img.dataset.cap);
});
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeLightbox()});
