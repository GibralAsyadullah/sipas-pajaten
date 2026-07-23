/* jadwal.js — pilih tanggal di kalender, filter status agenda + animasi ring (data dirender server) */

/* ---- pilih satu tanggal di kalender: tampilkan agenda hari itu saja ---- */
function pickDay(btn){
  if(btn.classList.contains('selected')){clearDaySel();return;}
  document.querySelectorAll('.jcal-day.selected').forEach(b=>b.classList.remove('selected'));
  btn.classList.add('selected');
  /* filter status kembali ke "Semua" agar tidak saling tumpang */
  document.querySelectorAll('#jFilter .filter-chip').forEach(c=>c.classList.toggle('active',c.dataset.st==='semua'));
  let pertama=null;
  document.querySelectorAll('.tl-item').forEach(it=>{
    const cocok=it.dataset.tanggal===btn.dataset.t;
    it.style.display=cocok?'':'none';
    if(cocok&&!pertama)pertama=it;
  });
  document.querySelectorAll('.wk').forEach(w=>{
    const ada=[...w.querySelectorAll('.tl-item')].some(it=>it.style.display!=='none');
    w.style.display=ada?'':'none';
  });
  const info=document.getElementById('jSelInfo');
  if(info){info.querySelector('b').textContent=btn.dataset.label;info.hidden=false;}
  if(pertama)pertama.scrollIntoView({behavior:'smooth',block:'center'});
}
function clearDaySel(){
  document.querySelectorAll('.jcal-day.selected').forEach(b=>b.classList.remove('selected'));
  const info=document.getElementById('jSelInfo');if(info)info.hidden=true;
  document.querySelectorAll('.tl-item').forEach(it=>it.style.display='');
  document.querySelectorAll('.wk').forEach(w=>w.style.display='');
  document.querySelectorAll('#jFilter .filter-chip').forEach(c=>c.classList.toggle('active',c.dataset.st==='semua'));
}

function setJadwalFilter(btn){
  /* memilih status membatalkan pilihan tanggal */
  document.querySelectorAll('.jcal-day.selected').forEach(b=>b.classList.remove('selected'));
  const info=document.getElementById('jSelInfo');if(info)info.hidden=true;
  document.querySelectorAll('#jFilter .filter-chip').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  const f=btn.dataset.st;
  document.querySelectorAll('.tl-item').forEach(it=>{
    it.style.display=(f==='semua'||it.classList.contains(f))?'':'none';
  });
  /* pekan tanpa agenda yang cocok ikut disembunyikan agar daftar ringkas */
  document.querySelectorAll('.wk').forEach(w=>{
    const ada=[...w.querySelectorAll('.tl-item')].some(it=>it.style.display!=='none');
    w.style.display=(f==='semua'||ada)?'':'none';
  });
}

(function(){
  const ring=document.getElementById('jRing');
  if(!ring)return;
  const pct=parseInt(ring.dataset.pct||'0',10)||0;
  const o=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){
    ring.style.setProperty('--p',(pct*3.6)+'deg');
    animatePct(document.getElementById('jPct'),pct);o.disconnect();
  }})});
  o.observe(ring);
})();
