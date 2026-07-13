/* dashboard.js */
/* ===== SLIDER ===== */
const slides=document.getElementById('slides');
const total=slides.children.length;let cur=0;
const dotsEl=document.getElementById('dots');
for(let i=0;i<total;i++){
  const b=document.createElement('button');
  b.setAttribute('aria-label','Slide '+(i+1));
  b.onclick=()=>goSlide(i);
  dotsEl.appendChild(b);
}
function goSlide(i){
  cur=i;slides.style.transform='translateX(-'+(i*100)+'%)';
  dotsEl.querySelectorAll('button').forEach((d,j)=>d.classList.toggle('active',j===i));
}
goSlide(0);
setInterval(()=>goSlide((cur+1)%total),5000);

/* ===== TANTANGAN HARIAN ===== */
const CHALLENGES=[
  {e:'♻️',t:'Pisahkan sampah organik & anorganik di rumah hari ini.'},
  {e:'🍼',t:'Kumpulkan 5 botol plastik untuk ditabung ke Bank Sampah.'},
  {e:'🛍️',t:'Bawa tas belanja sendiri, tolak kantong kresek.'},
  {e:'🚰',t:'Pakai botol minum isi ulang, hindari gelas plastik sekali pakai.'},
  {e:'🍂',t:'Kumpulkan daun & sisa sayur untuk bahan kompos.'},
  {e:'🚭',t:'Pungut minimal 3 puntung rokok di sekitar rumah atau sekolah.'},
  {e:'📢',t:'Ajak satu tetangga ikut memilah sampah.'},
  {e:'🥤',t:'Tolak sedotan plastik, coba sedotan bambu atau stainless.'},
  {e:'🧴',t:'Bilas & keringkan kemasan bekas sebelum ditabung.'},
  {e:'🌱',t:'Siram tanaman dengan air bekas cucian beras.'},
];
function chDay(off){const d=new Date(Date.now()-(off||0)*86400000);return d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate()}
function chIndex(){const d=new Date();return Math.floor((d-new Date(d.getFullYear(),0,0))/86400000)}
function renderChallenge(){
  if(!$('chText'))return;
  const c=CHALLENGES[chIndex()%CHALLENGES.length];
  $('chEmoji').textContent=c.e;$('chText').textContent=c.t;
  const streak=parseInt(loadP('sipas-ch-streak')||'0',10)||0;
  $('chStreak').textContent='🔥 '+streak+' hari';
  const done=loadP('sipas-ch-date')===chDay(0);
  const btn=$('chBtn');
  if(done){btn.textContent='🎉 Selesai hari ini!';btn.classList.add('done');btn.disabled=true;}
  else{btn.textContent='✅ Tandai Selesai';btn.classList.remove('done');btn.disabled=false;}
}
function doChallenge(){
  const today=chDay(0);
  if(loadP('sipas-ch-date')===today)return;
  let streak=parseInt(loadP('sipas-ch-streak')||'0',10)||0;
  streak=(loadP('sipas-ch-date')===chDay(1))?streak+1:1;
  saveP('sipas-ch-streak',String(streak));
  saveP('sipas-ch-date',today);
  if(typeof audio==='function'){audio();sfxCorrect();}
  confetti(['🌱','♻️','✨','🎉','🌿']);
  renderChallenge();
}
renderChallenge();


/* ===== FAKTA HARIAN ===== */
const FACTS=[
  'Sampah plastik butuh 100–450 tahun untuk terurai di alam.',
  'Memilah dari rumah membuat sebagian besar sampah bisa didaur ulang atau dikompos.',
  'Satu liter oli bekas dapat mencemari hingga sekitar 1 juta liter air bersih.',
  'Mendaur ulang 1 ton kertas dapat menyelamatkan sekitar 17 pohon.',
  'Maggot BSF mampu mengurai sampah organik dalam jumlah besar setiap hari.',
  'Baterai bekas mengandung logam berat yang meracuni tanah — buang ke dropbox B3.',
  'Membakar sampah menghasilkan asap beracun (dioksin) yang berbahaya bagi paru-paru.',
  'Eco-enzyme dari kulit buah bisa jadi pembersih lantai sekaligus pupuk alami.',
  'Kaleng aluminium bisa didaur ulang berkali-kali tanpa kehilangan kualitas.',
  'Sampah organik yang membusuk di TPA menghasilkan gas metana pemicu perubahan iklim.',
];
let factIdx=0;
function dayIdx(){const d=new Date();return Math.floor((d-new Date(d.getFullYear(),0,0))/86400000)}
function renderFact(){if($('factText'))$('factText').textContent=FACTS[((factIdx%FACTS.length)+FACTS.length)%FACTS.length]}
function nextFact(){factIdx++;renderFact()}
factIdx=dayIdx();renderFact();

/* ===== ANIMASI KOMPOSISI SAMPAH ===== */
function animateKomp(){
  document.querySelectorAll('.komp-bar i').forEach(el=>{el.style.width=el.dataset.v+'%';});
  [['kOrg',55],['kAno',35],['kB3',10]].forEach(([id,v])=>animatePct($(id),v));
}
(function(){
  const c=$('kompCard');if(!c)return;
  const o=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){animateKomp();o.disconnect();}})});
  o.observe(c);
})();


