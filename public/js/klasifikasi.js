/* klasifikasi.js */
/* ===== KLASIFIKASI ===== */
let klasFilter='semua';
let klasSumber='semua';
const KLAS_LIMIT=8;                       // item awal per kategori sebelum "Tampilkan semua"
const klasShowAll={organik:false,anorganik:false,b3:false};

function setSumberFilter(btn){
  document.querySelectorAll('.filter-sumber .filter-chip[data-s]').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  klasSumber=btn.dataset.s;
  renderKlas();
}
/* kartu warna = tombol filter; ketuk lagi untuk kembali ke semua */
function toggleKlasFilter(btn){
  setKlasFilterTo(klasFilter===btn.dataset.k?'semua':btn.dataset.k);
}
function setKlasFilterTo(k){
  klasFilter=k;
  const guide=document.getElementById('binGuide');
  guide.classList.toggle('filtered',k!=='semua');
  guide.querySelectorAll('.bin-g').forEach(b=>b.classList.toggle('active',b.dataset.k===k));
  renderKlas();
  if(k!=='semua')document.getElementById('klasGrid').scrollIntoView({behavior:'smooth',block:'start'});
}
function showAllKlas(cat){klasShowAll[cat]=true;renderKlas()}

function renderKlas(){
  const q=($('searchKlas').value||'').toLowerCase();
  const grid=$('klasGrid'),colO=$('colOrganik'),colA=$('colAnorganik'),colB=$('colB3');
  const lists={organik:$('listOrganik'),anorganik:$('listAnorganik'),b3:$('listB3')};
  Object.values(lists).forEach(el=>el.innerHTML='');
  let match=ITEMS.filter(it=>it.n.toLowerCase().includes(q)&&(klasSumber==='semua'||(it.r||'rumah')===klasSumber));
  const sortEl=$('klasSort');const mode=sortEl?sortEl.value:'default';
  if(mode==='az')match=match.slice().sort((a,b)=>a.n.localeCompare(b.n,'id'));
  else if(mode==='za')match=match.slice().sort((a,b)=>b.n.localeCompare(a.n,'id'));
  /* pencarian menang atas filter: bila hasil ada tapi bukan di kategori aktif, buka semua kategori */
  if(q&&klasFilter!=='semua'&&match.length&&!match.some(it=>it.t===klasFilter)){
    klasFilter='semua';
    const guide=document.getElementById('binGuide');
    guide.classList.remove('filtered');
    guide.querySelectorAll('.bin-g').forEach(b=>b.classList.remove('active'));
  }
  $('cntOrg').textContent=match.filter(it=>it.t==='organik').length;
  $('cntAno').textContent=match.filter(it=>it.t==='anorganik').length;
  $('cntB3').textContent=match.filter(it=>it.t==='b3').length;
  const shown=klasFilter==='semua'?match.length:match.filter(it=>it.t===klasFilter).length;
  $('klasCount').textContent=q||klasFilter!=='semua'||klasSumber!=='semua'
    ? 'Menampilkan '+shown+' dari '+ITEMS.length+' barang · ketuk kartu warna untuk ganti kategori'
    : ITEMS.length+' barang terdata · ketuk kartu warna untuk melihat satu kategori saja';
  ['organik','anorganik','b3'].forEach(cat=>{
    const items=match.filter(it=>it.t===cat);
    const expand=klasShowAll[cat]||q!=='';   // saat mencari, tampilkan semua hasil
    const slice=expand?items:items.slice(0,KLAS_LIMIT);
    slice.forEach(it=>{
      const idx=ITEMS.indexOf(it);
      const d=document.createElement('div');
      d.className='klas-item';
      d.setAttribute('role','button');d.setAttribute('tabindex','0');
      d.innerHTML='<span class="em">'+it.e+'</span> '+it.n+' <small>'+it.s+'</small><span class="arrow">›</span>';
      d.onclick=()=>openKlasModal(idx);
      d.onkeydown=(e)=>{if(e.key==='Enter'||e.key===' '){e.preventDefault();openKlasModal(idx)}};
      lists[cat].appendChild(d);
    });
    if(!expand&&items.length>slice.length){
      const btn=document.createElement('button');
      btn.className='show-more';
      btn.textContent='▾ Tampilkan semua '+items.length+' barang';
      btn.onclick=()=>showAllKlas(cat);
      lists[cat].appendChild(btn);
    }
    if(!items.length)lists[cat].innerHTML='<p class="muted" style="padding:8px 4px">Tidak ada hasil.</p>';
  });
  grid.classList.toggle('solo',klasFilter!=='semua');
  colO.classList.toggle('hide',klasFilter!=='semua'&&klasFilter!=='organik');
  colA.classList.toggle('hide',klasFilter!=='semua'&&klasFilter!=='anorganik');
  colB.classList.toggle('hide',klasFilter!=='semua'&&klasFilter!=='b3');
  $('klasEmpty').style.display=match.length?'none':'block';
}
renderKlas();

/* ---- modal detail klasifikasi ---- */
function openKlasModal(idx){
  const it=ITEMS[idx];if(!it)return;
  const label={organik:'🍃 Organik',anorganik:'🧴 Anorganik',b3:'☢️ B3 (Berbahaya)'};
  $('mEmoji').textContent=it.e;
  $('mEmoji').className='modal-emoji '+it.t;
  $('mTitle').textContent=it.n;
  const j=$('mJenis');j.className='jenis '+it.t;
  j.textContent=label[it.t]||it.t;
  $('mCara').textContent=it.s;
  $('mUrai').textContent=it.u||'—';
  $('mFakta').textContent=it.f||'—';
  /* langkah lanjutan sesuai kategori */
  const act=$('mActions');
  if(act){
    const pap=(window.SIPAS_URLS&&SIPAS_URLS.paparan)||'/paparan';
    if(it.t==='anorganik'){
      act.innerHTML='<button class="ma-btn main" onclick="closeKlasModal();jumpTo(\'alur-tabung\')">🏦 Cara menabung di Bank Sampah</button>'
        +'<a class="ma-btn" href="'+pap+'#diy">✂️ Ide olah &amp; kerajinan (DIY)</a>';
    }else if(it.t==='organik'){
      act.innerHTML='<a class="ma-btn main" href="'+pap+'#diy">🌱 Cara buat kompos / POC (DIY)</a>'
        +'<a class="ma-btn" href="'+pap+'#alur-organik">🪱 Alur organik → maggot</a>';
    }else{
      act.innerHTML='<button class="ma-btn main" onclick="closeKlasModal();document.getElementById(\'b3info\').scrollIntoView({behavior:\'smooth\',block:\'center\'})">⚠️ Cara aman menangani B3</button>';
    }
  }
  $('klasModal').classList.add('show');
  document.body.style.overflow='hidden';
}
function closeKlasModal(){
  $('klasModal').classList.remove('show');
  document.body.style.overflow='';
}
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeKlasModal()});

/* buka modal dari hasil pencarian lintas halaman (?item=N) */
(function(){
  const p=new URLSearchParams(location.search).get('item');
  if(p!==null){const i=parseInt(p,10);if(!isNaN(i))setTimeout(()=>openKlasModal(i),300);}
})();
