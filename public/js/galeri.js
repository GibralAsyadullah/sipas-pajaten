/* galeri.js — filter foto per bulan (foto dirender server) */
function setFilter(btn){
  document.querySelectorAll('.filter-chip').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  const f=btn.dataset.f;
  document.querySelectorAll('#galeriGrid .foto-card').forEach(c=>{
    c.style.display=(f==='semua'||c.dataset.f===f)?'':'none';
  });
}
