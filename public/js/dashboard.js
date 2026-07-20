/* dashboard.js */
/* ===== SLIDER ===== */
const slides=document.getElementById('slides');
const total=slides.children.length;let cur=0;
const dotsEl=document.getElementById('dots');
for(let i=0;i<total;i++){
  const b=document.createElement('button');
  b.setAttribute('aria-label','Slide '+(i+1));
  b.onclick=()=>{goSlide(i);resetAuto()};
  dotsEl.appendChild(b);
}
const SLIDE_DUR=5500;
const sliderEl=document.querySelector('.slider');
const progEl=document.getElementById('slideProgress');
const reduceMotion=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
let autoTimer=null;

function goSlide(i){
  cur=i;slides.style.transform='translateX(-'+(i*100)+'%)';
  dotsEl.querySelectorAll('button').forEach((d,j)=>d.classList.toggle('active',j===i));
  restartProgress();
}
/* bar progres di-restart tiap pindah slide */
function restartProgress(){
  if(!progEl||reduceMotion)return;
  progEl.classList.remove('run');void progEl.offsetWidth;
  if(autoTimer)progEl.classList.add('run');
}
function startAuto(){
  if(reduceMotion||autoTimer)return;
  autoTimer=setInterval(()=>goSlide((cur+1)%total),SLIDE_DUR);
  restartProgress();
}
function stopAuto(){
  if(!autoTimer)return;
  clearInterval(autoTimer);autoTimer=null;
  if(progEl)progEl.classList.remove('run');
}
goSlide(0);
/* navigasi manual: pindah slide lalu ulang hitungan auto dari awal */
function resetAuto(){if(autoTimer){clearInterval(autoTimer);autoTimer=null;startAuto();}}
function nextSlide(){goSlide((cur+1)%total);resetAuto()}
function prevSlide(){goSlide((cur-1+total)%total);resetAuto()}

if(sliderEl){
  if(progEl)progEl.style.setProperty('--slide-dur',SLIDE_DUR+'ms');
  /* semi-otomatis: berhenti saat disentuh/hover/fokus, lanjut saat ditinggal */
  sliderEl.addEventListener('mouseenter',stopAuto);
  sliderEl.addEventListener('mouseleave',startAuto);
  sliderEl.addEventListener('focusin',stopAuto);
  sliderEl.addEventListener('focusout',startAuto);
  sliderEl.addEventListener('touchstart',stopAuto,{passive:true});
  /* hemat sumber daya saat tab tidak aktif */
  document.addEventListener('visibilitychange',()=>document.hidden?stopAuto():startAuto());
  startAuto();
}

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

/* ===== ANIMASI KOMPOSISI & SUMBER SAMPAH ===== */
function animateKomp(scope){
  /* nilai persen dibaca dari data-v di markup agar satu sumber kebenaran */
  (scope||document).querySelectorAll('.komp-row').forEach(row=>{
    const bar=row.querySelector('.komp-bar i');if(!bar)return;
    bar.style.width=bar.dataset.v+'%';
    animatePct(row.querySelector('.kv'),parseInt(bar.dataset.v,10)||0);
  });
}
(function(){
  ['kompCard','sumberCard'].forEach(id=>{
    const c=$(id);if(!c)return;
    const o=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){animateKomp(c);o.disconnect();}})});
    o.observe(c);
  });
})();


