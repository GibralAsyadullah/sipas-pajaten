/* lokasi.js */
/* ===== PETA INTERAKTIF ===== */
const MAP_SRC={
  desa:'https://maps.google.com/maps?q=-6.0510658,107.3447465&z=17&hl=id&output=embed',
  posko:'https://maps.google.com/maps?q=-6.052482,107.346781&z=17&hl=id&output=embed',
  both:'https://maps.google.com/maps?q=-6.051774,107.345764&z=16&hl=id&output=embed'
};
function switchMap(btn){
  document.querySelectorAll('.mt-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  const f=document.getElementById('gmap');
  if(f)f.src=MAP_SRC[btn.dataset.loc]||MAP_SRC.desa;
}
(function(){
  const f=document.getElementById('gmap'),fb=document.getElementById('mapFallback');
  if(f&&fb){f.addEventListener('load',()=>{fb.style.display='none'});}
})();

/* ===== LAPOR SAMPAH ===== */
function getReports(){try{return JSON.parse(loadP('sipas-reports')||'[]')}catch(e){return[]}}
function saveReportLocal(loc,desc){
  const arr=getReports();
  arr.unshift({id:Date.now(),loc,desc,d:Date.now(),status:'baru'});
  saveP('sipas-reports',JSON.stringify(arr.slice(0,50)));
  renderReportsAdmin();
}
function sendReport(mode){
  const loc=($('repLoc').value||'').trim();
  const desc=($('repDesc').value||'').trim();
  const msg=$('repMsg');
  if(!loc){msg.style.color='var(--danger)';msg.textContent='⚠️ Isi dulu lokasi tumpukan sampahnya, ya.';return;}
  const tgl=new Date().toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'});
  const text='🗑️ *LAPORAN TUMPUKAN SAMPAH*\nDesa Pajaten, Cibuaya\n\n📍 Lokasi: '+loc+'\n📝 Keterangan: '+(desc||'-')+'\n🗓️ '+tgl+'\n\n(Dikirim via SIPAS Pajaten)';
  saveReportLocal(loc,desc);
  msg.style.color='var(--pine-2)';
  if(mode==='wa'){
    window.open('https://wa.me/?text='+encodeURIComponent(text),'_blank');
    msg.textContent='📲 Membuka WhatsApp… laporan juga tersimpan untuk tim.';
  }else{
    msg.textContent='✅ Laporan tersimpan & diteruskan ke tim. Terima kasih!';
  }
  $('repLoc').value='';$('repDesc').value='';
}
function setReportStatus(id,st){
  const arr=getReports();const r=arr.find(x=>x.id===id);if(r)r.status=st;
  saveP('sipas-reports',JSON.stringify(arr));renderReportsAdmin();
}
function delReport(id){
  saveP('sipas-reports',JSON.stringify(getReports().filter(x=>x.id!==id)));renderReportsAdmin();
}
function renderReportsAdmin(){
  const box=$('repList');if(!box)return;
  const arr=getReports();
  if(!arr.length){box.innerHTML='<div class="rep-empty">Belum ada laporan masuk.</div>';return;}
  const lbl={baru:'Baru',diproses:'Diproses',selesai:'Selesai'};
  box.innerHTML=arr.map(r=>{
    const ds=new Date(r.d).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'});
    const next=r.status==='baru'?'diproses':r.status==='diproses'?'selesai':'baru';
    const nextLbl=r.status==='baru'?'▶ Proses':r.status==='diproses'?'✓ Selesai':'↺ Buka';
    return '<div class="rep-item '+r.status+'"><span class="ri-loc">📍 '+escapeHtml(r.loc)+'</span>'+
      (r.desc?'<span class="ri-desc">'+escapeHtml(r.desc)+'</span>':'')+
      '<div class="ri-meta"><span class="ri-status">'+lbl[r.status]+'</span><span>🗓️ '+ds+'</span>'+
      '<span class="ri-act"><button onclick="setReportStatus('+r.id+',\''+next+'\')">'+nextLbl+'</button>'+
      '<button onclick="delReport('+r.id+')">🗑️</button></span></div></div>';
  }).join('');
}

