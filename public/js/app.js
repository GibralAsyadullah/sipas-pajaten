/* app.js — dimuat di semua halaman (helper, tema, pencarian, pengaturan) */

const $=id=>document.getElementById(id);
function shuffle(a){return a.slice().sort(()=>Math.random()-.5)}
function escapeHtml(s){return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')}


/* ---- efek: suara (Web Audio), getar, confetti, popup ---- */
let muted=false, actx=null;
function audio(){if(!actx){try{actx=new (window.AudioContext||window.webkitAudioContext)()}catch(e){}}return actx}
function toggleMute(){muted=!muted;$('muteBtn').textContent=muted?'🔇':'🔊'}
function tone(freq,dur,type,delay,vol){
  if(muted)return;const a=audio();if(!a)return;
  const t=a.currentTime+(delay||0);
  const o=a.createOscillator(),g=a.createGain();
  o.type=type||'sine';o.frequency.value=freq;
  g.gain.setValueAtTime(0,t);g.gain.linearRampToValueAtTime(vol||.14,t+.02);
  g.gain.exponentialRampToValueAtTime(.0001,t+dur);
  o.connect(g);g.connect(a.destination);o.start(t);o.stop(t+dur);
}
function sfxCorrect(){tone(523,.12,'sine',0);tone(659,.12,'sine',.1);tone(784,.22,'sine',.2)}
function sfxWrong(){tone(196,.18,'sawtooth',0,.1);tone(146,.28,'sawtooth',.12,.1)}
function sfxStreak(){tone(659,.1,'triangle',0);tone(880,.1,'triangle',.09);tone(1046,.22,'triangle',.18)}
function sfxWin(){[523,659,784,1046].forEach((f,i)=>tone(f,.3,'sine',i*.14))}
function sfxLose(){[392,330,262].forEach((f,i)=>tone(f,.3,'sawtooth',i*.16,.09))}
function buzz(ms){if(!muted&&navigator.vibrate)try{navigator.vibrate(ms)}catch(e){}}
function scorePop(txt,cls){
  const p=$('scorePop');p.textContent=txt;p.className='score-pop '+cls;
  void p.offsetWidth;p.classList.add('go');
}
function confetti(emojis){
  const box=document.createElement('div');box.className='confetti';
  const set=emojis||['🎉','✨','🍃','♻️','⭐','🌱'];
  for(let i=0;i<26;i++){
    const s=document.createElement('span');
    s.textContent=set[i%set.length];
    s.style.left=Math.random()*100+'%';
    s.style.animationDuration=(1.6+Math.random()*1.4)+'s';
    s.style.animationDelay=(Math.random()*.3)+'s';
    s.style.fontSize=(0.9+Math.random()*1.2)+'rem';
    box.appendChild(s);
  }
  document.body.appendChild(box);
  setTimeout(()=>box.remove(),3200);
}

/* ===== SPLASH (sekali per sesi) ===== */
const splash=document.getElementById('splash');
function closeSplash(){if(splash)splash.classList.add('gone')}
if(splash){
  if(sessionStorage.getItem('sipas-splash')==='1'){splash.remove();}
  else{sessionStorage.setItem('sipas-splash','1');splash.addEventListener('click',closeSplash);setTimeout(closeSplash,3600);}
}


/* ===== NAVIGASI (multi-halaman Laravel) ===== */
function activateTab(name){window.location.href=(name==='dashboard')?'/':('/'+name);}
function gotoTab(name){activateTab(name)}


/* ===== SCROLL REVEAL ===== */
const io=new IntersectionObserver((entries)=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}});
},{threshold:.12});
function runReveal(){document.querySelectorAll('.reveal:not(.in)').forEach(el=>io.observe(el))}
function jumpTo(id){const el=document.getElementById(id);if(el)el.scrollIntoView({behavior:'smooth',block:'start'});}
runReveal();


function animatePct(el,target){
  if(!el)return;let c=0;const step=Math.max(1,Math.ceil(target/26));
  const t=setInterval(()=>{c+=step;if(c>=target){c=target;clearInterval(t);}el.textContent=c+'%';},26);
}


/* ===== PENCARIAN GLOBAL ===== */
let pendingActions={};
const SEARCH_INDEX=(function(){
  const idx=[];
  [['dashboard','🏠','Beranda','Ringkasan, maskot & program kerja'],
   ['lokasi','📍','Lokasi & Peta','Peta interaktif, denah desa, Bank Sampah'],
   ['game','🎮','Game & Quiz','Latihan memilah sampah'],
   ['paparan','📺','Video & Poster Edukasi','Video edukasi & unduh poster'],
   ['klasifikasi','🗂️','Klasifikasi Sampah','Daftar organik & anorganik'],
   ['galeri','📸','Galeri Dokumentasi','Foto kegiatan KKN'],
   ['jadwal','🗓️','Jadwal & Catatan','Agenda kegiatan harian']
  ].forEach(p=>idx.push({cat:'Menu',ic:p[1],title:p[2],sub:p[3],key:(p[2]+' '+p[3]).toLowerCase(),go:()=>activateTab(p[0])}));

  ITEMS.forEach((it,i)=>idx.push({cat:'Jenis Sampah',ic:it.e,title:it.n,
    sub:({organik:'🍃 Organik',anorganik:'🧴 Anorganik',b3:'☢️ B3'}[it.t])+' · '+it.s,
    key:(it.n+' '+it.t+' '+it.s+' '+(it.f||'')+' '+(it.u||'')).toLowerCase(),
    go:()=>{window.location.href='/klasifikasi?item='+i}}));

  [['📢','Sosialisasi 3R & Kebersihan','Edukasi warga, PKK & sekolah'],
   ['♻️','Bank Sampah & Pembukuan','Menabung sampah anorganik'],
   ['🪱','Budidaya & Pemasaran Maggot','Sampah organik jadi maggot'],
   ['🌾','Eco-Enzyme & Pakan Eceng Gondok','Pakan ternak murah'],
   ['🧪','Pupuk Organik Cair (POC)','Fermentasi sampah organik']
  ].forEach(p=>idx.push({cat:'Program Kerja',ic:p[0],title:p[1],sub:p[2],key:(p[1]+' '+p[2]).toLowerCase(),go:()=>activateTab('dashboard')}));

  [['Pembekalan & Pelepasan KKN','Juni 2026'],
   ['Rapat Koordinasi Proker','Selasa, 7 Juli'],
   ['Pembukaan Resmi KKN','Rabu, 8 Juli'],
   ['Gorol Gabungan 6 Desa','Kamis, 9 Juli'],
   ['Jumat Bersih (Jumsih)','Setiap Jumat'],
   ['Peresmian Bank Sampah & Maggot','Agustus 2026']
  ].forEach(j=>idx.push({cat:'Jadwal',ic:'🗓️',title:j[0],sub:j[1],key:(j[0]+' '+j[1]).toLowerCase(),go:()=>activateTab('jadwal')}));

  idx.push({cat:'Lokasi',ic:'🏛️',title:'Kantor Kepala Desa Pajaten',sub:'Titik Bank Sampah · -6.0511, 107.3447',key:'kantor kepala desa pajaten bank sampah lokasi peta titik kumpul cibuaya',go:()=>activateTab('lokasi')});
  idx.push({cat:'Lokasi',ic:'🏕️',title:'Posko KKN Cibuaya',sub:'Basecamp mahasiswa · Dusun 3',key:'posko kkn cibuaya basecamp mahasiswa dusun lokasi',go:()=>activateTab('lokasi')});
  return idx;
})();
const SUGGEST=['Botol plastik','Maggot','Bank Sampah','Eceng gondok','Jadwal','Posko'];

function openSearch(){
  const o=$('searchOverlay');o.classList.add('show');document.body.style.overflow='hidden';
  const i=$('globalSearch');i.value='';runSearch();setTimeout(()=>i.focus(),90);
}
function closeSearch(){$('searchOverlay').classList.remove('show');document.body.style.overflow=''}
function pickSuggest(q){const i=$('globalSearch');i.value=q;runSearch();i.focus()}
function shl(text,q){
  const i=text.toLowerCase().indexOf(q);
  if(i<0||!q)return escapeHtml(text);
  return escapeHtml(text.slice(0,i))+'<mark>'+escapeHtml(text.slice(i,i+q.length))+'</mark>'+escapeHtml(text.slice(i+q.length));
}
function runSearch(){
  const q=($('globalSearch').value||'').trim().toLowerCase();
  const body=$('searchBody');pendingActions={};
  if(!q){
    body.innerHTML='<div class="search-hint">Pencarian populer</div><div class="sugg-row">'+
      SUGGEST.map(s=>'<button class="sugg" onclick="pickSuggest(\''+s+'\')">'+s+'</button>').join('')+'</div>';
    return;
  }
  const hits=SEARCH_INDEX.filter(e=>e.key.includes(q));
  if(!hits.length){
    body.innerHTML='<div class="search-empty">😕 Tidak ada hasil untuk "<b>'+escapeHtml(q)+'</b>".<br>Coba kata kunci lain, misalnya <i>botol</i>, <i>maggot</i>, atau <i>jadwal</i>.</div>';
    return;
  }
  const order=['Jenis Sampah','Program Kerja','Jadwal','Lokasi','Menu'];
  const groups={};hits.slice(0,50).forEach(h=>{(groups[h.cat]=groups[h.cat]||[]).push(h)});
  let html='';let n=0;
  order.filter(c=>groups[c]).forEach(cat=>{
    html+='<div class="search-group">'+cat+' <span>'+groups[cat].length+'</span></div>';
    groups[cat].forEach(h=>{
      const id='sr'+(n++);pendingActions[id]=h.go;
      html+='<button class="search-res" data-id="'+id+'"><span class="sr-ic">'+h.ic+'</span>'+
        '<span class="sr-txt"><b>'+shl(h.title,q)+'</b><small>'+escapeHtml(h.sub)+'</small></span>'+
        '<span class="sr-go">›</span></button>';
    });
  });
  body.innerHTML=html;
  body.querySelectorAll('.search-res').forEach(btn=>{
    btn.onclick=()=>{const a=pendingActions[btn.dataset.id];closeSearch();if(a)setTimeout(a,10);};
  });
}
document.addEventListener('keydown',e=>{
  if(e.key==='/'&&!/^(input|textarea)$/i.test(document.activeElement.tagName)){e.preventDefault();openSearch();}
  if(e.key==='Escape'){closeSearch();closeSettings();}
});


/* ===== PENGATURAN: mode gelap & ukuran teks ===== */
function saveP(k,v){try{localStorage.setItem(k,v)}catch(e){}}
function loadP(k){try{return localStorage.getItem(k)}catch(e){return null}}
function openSettings(){$('setOverlay').classList.add('show');document.body.style.overflow='hidden'}
function closeSettings(){$('setOverlay').classList.remove('show');document.body.style.overflow=''}
async function shareApp(){
  const data={title:'SIPAS Pajaten',text:'Yuk belajar memilah sampah bersama SIPAS Pajaten — Sistem Edukasi Pengelolaan Sampah KKN Cibuaya 2026!',url:location.href};
  const msg=$('shareMsg');
  try{
    if(navigator.share){await navigator.share(data);}
    else if(navigator.clipboard){await navigator.clipboard.writeText(location.href);if(msg)msg.textContent='✅ Tautan disalin ke clipboard!';}
    else{if(msg)msg.textContent=location.href;}
  }catch(e){/* dibatalkan pengguna */}
}


/* MODE ADMIN dihapus — kini pakai login Laravel (atribut data-admin dipasang server) */

/* ===== TOMBOL KE ATAS ===== */
window.addEventListener('scroll',()=>{$('toTop').classList.toggle('show',window.scrollY>440)},{passive:true});

