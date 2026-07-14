/* klasifikasi.js */
/* ===== KLASIFIKASI ===== */
let klasFilter='semua';
let klasSumber='semua';
function setSumberFilter(btn){
  document.querySelectorAll('.filter-sumber .filter-chip[data-s]').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  klasSumber=btn.dataset.s;
  renderKlas();
}
function setKlasFilter(btn){
  document.querySelectorAll('.filter-row .filter-chip[data-k]').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  klasFilter=btn.dataset.k;
  renderKlas();
}
function renderKlas(){
  const q=($('searchKlas').value||'').toLowerCase();
  const lo=$('listOrganik'),la=$('listAnorganik'),lb=$('listB3');
  const grid=$('klasGrid'),colO=$('colOrganik'),colA=$('colAnorganik'),colB=$('colB3');
  lo.innerHTML='';la.innerHTML='';lb.innerHTML='';
  let match=ITEMS.filter(it=>it.n.toLowerCase().includes(q)&&(klasSumber==='semua'||(it.r||'rumah')===klasSumber));
  const sortEl=$('klasSort');const mode=sortEl?sortEl.value:'default';
  if(mode==='az')match=match.slice().sort((a,b)=>a.n.localeCompare(b.n,'id'));
  else if(mode==='za')match=match.slice().sort((a,b)=>b.n.localeCompare(a.n,'id'));
  $('cntSemua').textContent=match.length;
  $('cntOrg').textContent=match.filter(it=>it.t==='organik').length;
  $('cntAno').textContent=match.filter(it=>it.t==='anorganik').length;
  $('cntB3').textContent=match.filter(it=>it.t==='b3').length;
  match.forEach(it=>{
    const idx=ITEMS.indexOf(it);
    const d=document.createElement('div');
    d.className='klas-item';
    d.setAttribute('role','button');d.setAttribute('tabindex','0');
    d.innerHTML='<span class="em">'+it.e+'</span> '+it.n+' <small>'+it.s+'</small><span class="arrow">›</span>';
    d.onclick=()=>openKlasModal(idx);
    d.onkeydown=(e)=>{if(e.key==='Enter'||e.key===' '){e.preventDefault();openKlasModal(idx)}};
    (it.t==='organik'?lo:it.t==='anorganik'?la:lb).appendChild(d);
  });
  grid.classList.toggle('solo',klasFilter!=='semua');
  colO.classList.toggle('hide',klasFilter!=='semua'&&klasFilter!=='organik');
  colA.classList.toggle('hide',klasFilter!=='semua'&&klasFilter!=='anorganik');
  colB.classList.toggle('hide',klasFilter!=='semua'&&klasFilter!=='b3');
  if(!lo.children.length)lo.innerHTML='<p class="muted" style="padding:8px 4px">Tidak ada hasil.</p>';
  if(!la.children.length)la.innerHTML='<p class="muted" style="padding:8px 4px">Tidak ada hasil.</p>';
  if(!lb.children.length)lb.innerHTML='<p class="muted" style="padding:8px 4px">Tidak ada hasil.</p>';
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
