/* tentang.js */
/* ===== ANGGOTA TIM ===== */
const DEFAULT_TEAM=[
  {n:'Gibral',r:'Teknik Informatika'},
  {n:'Nama Anggota',r:'Ketua Kelompok'},
  {n:'Nama Anggota',r:'Sekretaris'},
  {n:'Nama Anggota',r:'Bendahara'},
];
function getTeam(){try{const t=loadP('sipas-team');return t?JSON.parse(t):DEFAULT_TEAM.slice();}catch(e){return DEFAULT_TEAM.slice();}}
function saveTeam(a){saveP('sipas-team',JSON.stringify(a));}
function renderTeam(){
  const box=$('teamGrid');if(!box)return;
  const team=getTeam();
  if(!team.length){box.innerHTML='<div class="team-empty">Belum ada data anggota. Tambahkan lewat mode admin.</div>';return;}
  box.innerHTML=team.map((m,i)=>{
    const initial=((m.n||'?').trim().charAt(0)||'?').toUpperCase();
    return '<div class="team-card"><button class="tc-del admin-only" onclick="delMember('+i+')" aria-label="Hapus anggota">✕</button>'+
      '<div class="team-av">'+initial+'</div><div class="tc-name">'+escapeHtml(m.n)+'</div><div class="tc-role">'+escapeHtml(m.r)+'</div></div>';
  }).join('');
}
function addMember(){
  const n=($('tmName').value||'').trim(), r=($('tmRole').value||'').trim();
  if(!n){alert('Isi nama anggota terlebih dahulu.');return;}
  const t=getTeam();t.push({n,r:r||'Anggota'});saveTeam(t);renderTeam();
  $('tmName').value='';$('tmRole').value='';
}
function delMember(i){const t=getTeam();t.splice(i,1);saveTeam(t);renderTeam();}
renderTeam();

/* ===== UMKM & POTENSI DESA ===== */
const DEFAULT_UMKM=[
  {e:'🍘',n:'Opak Ketan "Sumber Rasa"',d:'Produk khas & unggulan Desa Pajaten. Kerupuk ketan tradisional turun-temurun lebih dari 30 tahun — dari menumbuk ketan, mencetak, menjemur, hingga memanggang di atas bara. Desa Pajaten dikenal sebagai penghasil opak.',tag:'Unggulan'},
  {e:'🌾',n:'Pertanian Padi & Sawah',d:'Mayoritas warga bertani padi, didukung jaringan irigasi desa.'},
  {e:'🧵',n:'Konveksi & Jahit',d:'Usaha jahit dan obras rumahan warga.'},
  {e:'🐐',n:'Peternakan Warga',d:'Budidaya ternak sebagai sumber penghidupan warga.'},
  {e:'🍢',n:'Olahan Pangan PKK / PEKKA',d:'Produk olahan ibu-ibu PKK & Perempuan Kepala Keluarga, didorong lewat program P2WKSS 2026.'},
];
function getUmkm(){try{const t=loadP('sipas-umkm');return t?JSON.parse(t):DEFAULT_UMKM.slice();}catch(e){return DEFAULT_UMKM.slice();}}
function saveUmkm(a){saveP('sipas-umkm',JSON.stringify(a));}
function renderUmkm(){
  const box=$('umkmList');if(!box)return;
  const list=getUmkm();
  if(!list.length){box.innerHTML='<div class="team-empty">Belum ada data UMKM. Tambahkan lewat mode admin.</div>';return;}
  box.innerHTML=list.map((u,i)=>
    '<div class="umkm-item'+(u.tag?' hl':'')+'"><button class="um-del admin-only" onclick="delUmkm('+i+')" aria-label="Hapus UMKM">✕</button>'+
    '<span class="um-ic">'+(u.e||'🏪')+'</span><div><b>'+escapeHtml(u.n)+'</b>'+(u.d?'<p>'+escapeHtml(u.d)+'</p>':'')+
    (u.tag?'<span class="um-tag">'+escapeHtml(u.tag)+'</span>':'')+'</div></div>'
  ).join('');
}
function addUmkm(){
  const n=($('umName').value||'').trim(), d=($('umDesc').value||'').trim();
  if(!n){alert('Isi nama UMKM terlebih dahulu.');return;}
  const list=getUmkm();list.push({e:'🏪',n,d});saveUmkm(list);renderUmkm();
  $('umName').value='';$('umDesc').value='';
}
function delUmkm(i){const list=getUmkm();list.splice(i,1);saveUmkm(list);renderUmkm();}
renderUmkm();
