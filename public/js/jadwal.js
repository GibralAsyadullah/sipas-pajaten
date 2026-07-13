/* jadwal.js */
/* ===== NOTES ===== */
const notes=[];
function addNote(){
  const inp=$('noteText');
  const v=inp.value.trim();
  if(!v)return;
  notes.unshift({t:v,d:new Date().toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long'})});
  inp.value='';
  renderNotes();
}
function renderNotes(){
  const box=$('notesList');
  if(!notes.length){box.innerHTML='<p class="muted" style="margin-top:10px">Belum ada catatan. Tulis dokumentasi singkat kegiatan hari ini di atas.</p>';return;}
  box.innerHTML='';
  notes.forEach((n,i)=>{
    const d=document.createElement('div');
    d.className='note';
    d.innerHTML='<span>📌</span><span><b style="font-size:.72rem;color:var(--ink-soft)">'+n.d+'</b><br>'+escapeHtml(n.t)+'</span>';
    const del=document.createElement('button');
    del.textContent='✕';del.setAttribute('aria-label','Hapus catatan');
    del.onclick=()=>{notes.splice(i,1);renderNotes();};
    d.appendChild(del);
    box.appendChild(d);
  });
}
renderNotes();
$('noteText').addEventListener('keydown',e=>{if(e.key==='Enter')addNote()});

/* ===== TIMELINE JADWAL ===== */
const JADWAL=[
  {d:'Juni 2026',t:'Pembekalan & Pelepasan KKN',s:'Rangkaian pembekalan (pre test, materi, post test) dan pelepasan resmi di kampus UBP Karawang.',st:'done',ic:'🎓'},
  {d:'Selasa, 7 Juli',t:'Rapat Koordinasi Proker',s:'Pembahasan 5 program utama bersama perangkat desa & tokoh masyarakat di Posko.',st:'done',ic:'📋'},
  {d:'Rabu, 8 Juli · 08.00',t:'Pembukaan Resmi KKN',s:'Seremoni perkenalan mahasiswa di Kantor Desa, dilanjut rapat koordinasi desa.',st:'done',ic:'🎤'},
  {d:'Kamis, 9 Juli',t:'Pendampingan Gorol Gabungan 6 Desa',s:'Kerja bakti gabungan — mahasiswa KKN & Tim P2WKSS mendampingi penuh.',st:'done',ic:'🤝'},
  {d:'Setiap Jumat',t:'Jumat Bersih (Jumsih)',s:'Kebersihan rutin terkoordinasi di wilayah empat dusun Desa Pajaten.',st:'ongoing',ic:'🧹'},
  {d:'Agustus 2026',t:'Peresmian Bank Sampah & Maggot',s:'Target operasional penuh sistem Bank Sampah dan pengelolaan maggot oleh desa.',st:'upcoming',ic:'🏦'},
];
function renderJadwal(){
  const box=$('timeline');if(!box)return;
  const mark={done:'✓',ongoing:'●',upcoming:'○'},lbl={done:'Selesai',ongoing:'Rutin',upcoming:'Akan datang'};
  box.innerHTML=JADWAL.map((j,i)=>
    '<div class="tl-item '+j.st+' reveal" style="transition-delay:'+(i*70)+'ms"><div class="tl-dot">'+mark[j.st]+'</div>'+
    '<div class="tl-card"><div class="tl-head"><span class="tl-date">📅 '+j.d+'</span><span class="tl-badge '+j.st+'">'+lbl[j.st]+'</span></div>'+
    '<b><span class="tl-ic">'+j.ic+'</span>'+j.t+'</b><span class="tl-desc">'+j.s+'</span></div></div>'
  ).join('');
  const total=JADWAL.filter(j=>j.st!=='ongoing').length;
  const done=JADWAL.filter(j=>j.st==='done').length;
  const pct=Math.round(done/total*100);
  $('jDone').textContent=done+' dari '+total+' agenda utama selesai';
  const ring=$('jRing');
  const o=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){
    if(ring)ring.style.setProperty('--p',(pct*3.6)+'deg');
    animatePct($('jPct'),pct);o.disconnect();
  }})});
  if(ring)o.observe(ring);
}
renderJadwal();

