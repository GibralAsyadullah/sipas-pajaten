/* game.js */
/* ===== RESPONDEN (identitas pemain untuk evaluasi) ===== */
let responden=null;
function loadResponden(){
  try{const r=JSON.parse(loadP('sipas-responden')||'null');if(r&&r.nama){
    if($('rNama'))$('rNama').value=r.nama;
    if($('rUsia')&&r.usia)$('rUsia').value=r.usia;
    if($('rAsal')&&r.asal)$('rAsal').value=r.asal;
  }}catch(e){}
}
function getResponden(){
  const nama=($('rNama')?$('rNama').value:'').trim();
  const err=$('rError');
  if(!nama){
    if(err)err.textContent='Tulis dulu namamu ya, biar hasil mainmu bisa dicatat. 😊';
    if($('rNama')){$('rNama').classList.add('rf-invalid');$('rNama').focus()}
    return null;
  }
  if(err)err.textContent='';
  if($('rNama'))$('rNama').classList.remove('rf-invalid');
  const usia=parseInt($('rUsia')?$('rUsia').value:'',10);
  const r={nama:nama.slice(0,100),usia:(usia>=1&&usia<=120)?usia:null,asal:($('rAsal')?$('rAsal').value:'').trim().slice(0,120)||null};
  saveP('sipas-responden',JSON.stringify(r));
  return r;
}
function submitResult(jenis,skor,benar,total,detail){
  if(!responden)return;
  const tokenEl=document.querySelector('meta[name="csrf-token"]');
  fetch('/game/hasil',{
    method:'POST',
    headers:{'Content-Type':'application/json','Accept':'application/json',
      'X-CSRF-TOKEN':tokenEl?tokenEl.content:''},
    body:JSON.stringify({nama:responden.nama,usia:responden.usia,asal:responden.asal,
      jenis,skor,benar,total_soal:total,detail})
  }).catch(()=>{/* offline? hasil lokal tetap tampil */});
}

/* ===== GAME PILAH ===== */
let gIdx=0,gScore=0,gLives=3,gSet=[],gStreak=0,gBest=0,gCorrect=0,gDetail=[];
/* ---- maskot reaktif & skor terbaik ---- */
function react(el,pose,mood){
  if(!el)return;el.src=MASCOTS[pose];
  el.classList.remove('show','correct','wrong');void el.offsetWidth;
  el.classList.add('show');if(mood)el.classList.add(mood);
}
function bestKey(k){return 'sipas-best-'+k}
function getBest(k){return parseInt(loadP(bestKey(k))||'0',10)||0}
function setBest(k,v){if(v>getBest(k)){saveP(bestKey(k),String(v));return true}return false}
function renderBadges(list){$('goBadges').innerHTML=list.map(b=>'<span class="go-badge">'+b+'</span>').join('')}
function showGoMascot(pose){const m=$('goMascot');m.src=MASCOTS[pose];m.classList.remove('go-mascot');void m.offsetWidth;m.classList.add('go-mascot')}
function pushHist(type,score){
  let arr=getHistAll();arr.unshift({t:type,s:score,d:Date.now()});arr=arr.slice(0,5);
  saveP('sipas-hist',JSON.stringify(arr));
}
function getHistAll(){try{return JSON.parse(loadP('sipas-hist')||'[]')}catch(e){return[]}}
function clearHist(){
  if(!confirm('Hapus semua riwayat main terakhir?'))return;
  saveP('sipas-hist','[]');
  updateStartBest();
}
function updateStartBest(){
  const el=$('startBest');if(!el)return;
  const g=getBest('game'),q=getBest('quiz');
  el.innerHTML=(g||q)?'🏅 Skor terbaik — Game: <b>'+g+'</b> · Quiz: <b>'+q+'</b>':'';
  const hp=$('histPanel');if(!hp)return;
  const hist=getHistAll();
  if(!hist.length){hp.innerHTML='';return;}
  hp.innerHTML='<div class="hist-title"><span>🕘 Riwayat Main Terakhir</span><button type="button" class="hist-clear" onclick="clearHist()" title="Hapus riwayat">🗑️ Hapus</button></div>'+hist.map(h=>{
    const ds=new Date(h.d).toLocaleDateString('id-ID',{day:'numeric',month:'short'});
    return '<div class="hist-row"><span class="ht">'+(h.t==='Game'?'🎮 Game':'🧠 Quiz')+'</span><span class="hs">'+h.s+(h.t==='Game'?' poin':'')+'</span><span class="hd">'+ds+'</span></div>';
  }).join('');
}

function startGame(){
  responden=getResponden();if(!responden)return;
  gSet=shuffle(ITEMS).slice(0,10);
  gIdx=0;gScore=0;gLives=3;gStreak=0;gBest=0;gCorrect=0;gDetail=[];
  audio();
  $('gameStart').classList.add('hidden');
  $('quizArea').classList.add('hidden');
  $('gameOver').classList.add('hidden');
  $('gameArea').classList.remove('hidden');
  $('gReact').classList.remove('show');
  showItem();
}
function showItem(){
  const it=gSet[gIdx];
  $('gEmoji').textContent=it.e;
  $('gEmoji').style.animation='none';void $('gEmoji').offsetWidth;$('gEmoji').style.animation='';
  $('gName').textContent=it.n;
  $('gNum').textContent=gIdx+1;
  $('gScore').textContent=gScore;
  $('gStreak').textContent=gStreak;
  $('gLives').textContent='❤️'.repeat(gLives)+'🖤'.repeat(3-gLives);
  $('gProg').style.width=(gIdx/gSet.length*100)+'%';
  $('gFeedback').textContent='';
  $('gFeedback').className='game-feedback';
  $('gReact').classList.remove('show','correct','wrong');
  document.querySelectorAll('#gItem .bin-btn').forEach(b=>b.disabled=false);
}
function answer(pick,btn){
  const it=gSet[gIdx];
  const fb=$('gFeedback'),item=$('gItem');
  document.querySelectorAll('#gItem .bin-btn').forEach(b=>b.disabled=true);
  if(btn){btn.classList.remove('tap');void btn.offsetWidth;btn.classList.add('tap')}
  const KAT={organik:'Organik',anorganik:'Anorganik',b3:'B3'};
  gDetail.push({soal:it.n,jawab:KAT[pick]||pick,benar:pick===it.t});
  if(pick===it.t){
    gCorrect++;
    gStreak++;gBest=Math.max(gBest,gStreak);
    const bonus=gStreak>=3?5:0,gain=10+bonus;
    gScore+=gain;
    sfxCorrect();buzz(30);
    scorePop('+'+gain,'plus');
    item.classList.remove('pop');void item.offsetWidth;item.classList.add('pop');
    react($('gReact'),gStreak>=3?'cheer':'thumb','correct');
    fb.textContent=(bonus?'🔥 Combo x'+gStreak+'! ':'✅ Betul! ')+it.s;
    fb.className='game-feedback ok';
    if(gStreak>=3){confetti();sfxStreak();$('gStreakPill').classList.remove('hot');void $('gStreakPill').offsetWidth;$('gStreakPill').classList.add('hot')}
    else if(gStreak===1)confetti(['✨','⭐']);
  }else{
    gStreak=0;gLives--;
    sfxWrong();buzz([40,30,40]);
    scorePop('❌','minus');
    item.classList.remove('shake');void item.offsetWidth;item.classList.add('shake');
    react($('gReact'),'plant','wrong');
    fb.textContent='❌ Salah! '+it.n+' termasuk '+({organik:'Organik',anorganik:'Anorganik',b3:'B3'}[it.t])+'. '+it.s;
    fb.className='game-feedback no';
  }
  $('gScore').textContent=gScore;
  $('gStreak').textContent=gStreak;
  $('gLives').textContent='❤️'.repeat(gLives)+'🖤'.repeat(3-gLives);
  setTimeout(()=>{
    gIdx++;
    if(gLives<=0||gIdx>=gSet.length){endGame();}
    else showItem();
  },1300);
}
function endGame(){
  $('gProg').style.width='100%';
  $('gameArea').classList.add('hidden');
  $('gameOver').classList.remove('hidden');
  $('goScore').textContent=gScore+' poin';
  const win=gLives>0, isNewBest=setBest('game',gScore), badges=[];
  pushHist('Game',gScore);
  submitResult('game',gScore,gCorrect,gDetail.length,gDetail);
  if(gScore>=100)badges.push('🌟 Sempurna');
  if(gBest>=5)badges.push('🔥 Combo x'+gBest);
  else if(gBest>=3)badges.push('🔥 Combo Master');
  if(gLives===3&&win)badges.push('❤️ Nyawa Utuh');
  if(isNewBest&&gScore>0)badges.push('🏆 Rekor Baru');
  renderBadges(badges);
  let pose;
  if(!win){pose='plant';$('goMsg').textContent='Nyawa habis! Combo terbaikmu '+gBest+'. Ayo coba lagi, Si Asri percaya kamu bisa! 🌱';sfxLose();}
  else if(gScore>=90){pose='cheer';$('goMsg').textContent='Luar biasa! Kamu Pahlawan Pilah Desa Pajaten! 🎉';sfxWin();confetti();}
  else{pose='thumb';$('goMsg').textContent='Kerja bagus! Combo terbaik '+gBest+'. Terus asah kemampuan memilahmu.';sfxWin();}
  showGoMascot(pose);
  $('goBest').innerHTML=(isNewBest&&gScore>0?'<span class="nb">✨ Rekor baru!</span> ':'')+'Skor terbaik: <b>'+getBest('game')+' poin</b>';
}
function backToStart(){
  $('gameOver').classList.add('hidden');
  $('gameStart').classList.remove('hidden');
  updateStartBest();
}

/* ===== QUIZ ===== */
/* Soal utama diambil dari database (dibagikan lewat window.SIPAS_QUIZ);
   daftar di bawah hanya cadangan bila database belum terisi. */
const QUIZ_FALLBACK=[
  {q:'Sampah organik paling cocok diolah menjadi apa di Desa Pajaten?',
   o:['Dibakar di pekarangan','Kompos, POC, atau pakan maggot','Dibuang ke irigasi','Ditimbun di kantong plastik'],a:1,
   ex:'Sampah organik cepat terurai dan kaya nutrisi, cocok jadi kompos, POC, atau pakan maggot.'},
  {q:'Ke mana sampah anorganik seperti botol plastik sebaiknya disalurkan?',
   o:['Bank Sampah di Kantor Kepala Desa','Dibakar bersama daun kering','Saluran irigasi','Dipendam di kebun'],a:0,
   ex:'Sampah anorganik ditabung ke Bank Sampah agar bernilai, bukan dibakar atau dibuang.'},
  {q:'Apa keuntungan menabung sampah di Bank Sampah?',
   o:['Tidak ada untungnya','Sampah ditimbang dan jadi tabungan uang','Dapat hadiah motor','Sampah dibuang lebih jauh'],a:1,
   ex:'Sampah ditimbang, dicatat, lalu nilainya masuk ke buku tabunganmu.'},
  {q:'Eceng gondok dari irigasi bisa dimanfaatkan menjadi?',
   o:['Pakan ternak setelah dicacah','Bahan bakar kompor','Pengganti pupuk kimia langsung','Tidak bisa dimanfaatkan'],a:0,
   ex:'Eceng gondok dicacah lalu dicampur keong sawah menjadi pakan ternak murah.'},
  {q:'Mengapa membuang sampah ke irigasi dilarang?',
   o:['Airnya jadi lebih jernih','Menyumbat aliran dan memicu banjir','Ikan jadi lebih banyak','Sampah cepat terurai di air'],a:1,
   ex:'Sampah menyumbat aliran air irigasi sehingga berisiko memicu banjir.'},
  {q:'Tempat sampah untuk sampah organik umumnya berwarna?',
   o:['Merah','Kuning','Hijau','Biru'],a:2,
   ex:'Hijau menandakan sampah organik yang mudah terurai; kuning untuk anorganik.'},
  {q:'Maggot (belatung BSF) diberi makan dari?',
   o:['Sampah plastik','Sisa makanan & sampah organik','Kaca dan logam','Kertas kering'],a:1,
   ex:'Maggot memakan sampah organik dan tumbuh jadi pakan ternak bergizi.'},
  {q:'Apa kepanjangan dari prinsip 3R?',
   o:['Reduce, Reuse, Recycle','Read, Run, Rest','Reduce, Repeat, Return','Reuse, Rinse, Repeat'],a:0,
   ex:'3R = Reduce (kurangi), Reuse (pakai ulang), Recycle (daur ulang).'},
  {q:'POC yang dibuat warga berasal dari?',
   o:['Botol plastik dilelehkan','Fermentasi sampah sayur & kulit buah','Air irigasi kotor','Abu pembakaran sampah'],a:1,
   ex:'POC (Pupuk Organik Cair) dibuat dari fermentasi sampah organik dengan EM4 atau air cucian beras.'},
  {q:'Sampah mana yang biasanya bernilai jual paling tinggi di Bank Sampah?',
   o:['Daun kering','Kaleng/logam aluminium','Sisa makanan','Kulit pisang'],a:1,
   ex:'Logam seperti aluminium punya harga jual tinggi dibanding sampah lain.'},
  {q:'Baterai bekas, lampu, dan obat kadaluarsa termasuk jenis sampah?',
   o:['Organik','Anorganik biasa','B3 (Bahan Berbahaya & Beracun)','Bisa dibakar saja'],a:2,
   ex:'Semuanya mengandung zat berbahaya, jadi tergolong B3 dan wajib ditangani khusus.'},
  {q:'Bagaimana cara benar menangani sampah B3 seperti baterai bekas?',
   o:['Dibuang ke tempat sampah biasa','Dibakar agar cepat habis','Dikumpulkan terpisah & diserahkan ke fasilitas khusus','Dikubur di kebun'],a:2,
   ex:'Sampah B3 dikumpulkan terpisah lalu diserahkan ke dropbox B3/pengepul resmi agar tidak mencemari.'},
];
const QUIZ_ALL=(window.SIPAS_QUIZ&&window.SIPAS_QUIZ.length)?window.SIPAS_QUIZ:QUIZ_FALLBACK;
let qSet=[],qIdx=0,qScore=0,qCorrect=0,qCorrectIdx=0,qShuffled=[],qDetail=[];
function startQuiz(){
  responden=getResponden();if(!responden)return;
  qSet=shuffle(QUIZ_ALL).slice(0,Math.min(8,QUIZ_ALL.length));
  qIdx=0;qScore=0;qCorrect=0;qDetail=[];
  audio();
  $('gameStart').classList.add('hidden');
  $('gameArea').classList.add('hidden');
  $('gameOver').classList.add('hidden');
  $('quizArea').classList.remove('hidden');
  $('qReact').classList.remove('show');
  $('qTotal').textContent=qSet.length;
  showQuiz();
}
function showQuiz(){
  const q=qSet[qIdx];
  const sh=shuffle(q.o.map((t,i)=>({t,ok:i===q.a})));
  qShuffled=sh;
  qCorrectIdx=sh.findIndex(o=>o.ok);
  $('qQuestion').textContent=q.q;
  $('qNum').textContent=qIdx+1;
  $('qScore').textContent=qScore;
  $('qProg').style.width=(qIdx/qSet.length*100)+'%';
  $('qFeedback').textContent='';$('qFeedback').className='game-feedback';
  $('qReact').classList.remove('show','correct','wrong');
  const box=$('qOptions');box.innerHTML='';
  sh.forEach((o,i)=>{
    const b=document.createElement('button');
    b.className='quiz-opt';
    b.textContent=String.fromCharCode(65+i)+'. '+o.t;
    b.onclick=()=>pickQuiz(i,b);
    box.appendChild(b);
  });
}
function pickQuiz(i,btn){
  const q=qSet[qIdx];
  const all=$('qOptions').querySelectorAll('.quiz-opt');
  all.forEach(b=>b.disabled=true);
  qDetail.push({soal:q.q,jawab:(qShuffled[i]?qShuffled[i].t:'-'),benar:i===qCorrectIdx});
  if(i===qCorrectIdx){
    btn.classList.add('right');qCorrect++;qScore+=Math.round(100/qSet.length);
    sfxCorrect();buzz(30);confetti(['✨','⭐','🎉']);
    react($('qReact'),'thumb','correct');
    $('qFeedback').innerHTML='✅ Tepat! <span style="font-weight:500">'+escapeHtml(q.ex)+'</span>';
    $('qFeedback').className='game-feedback ok';
  }else{
    btn.classList.add('wrong');all[qCorrectIdx].classList.add('right');
    sfxWrong();buzz([40,30,40]);
    react($('qReact'),'plant','wrong');
    $('qFeedback').innerHTML='❌ Kurang tepat. <span style="font-weight:500">'+escapeHtml(q.ex)+'</span>';
    $('qFeedback').className='game-feedback no';
  }
  $('qScore').textContent=qScore;
  setTimeout(()=>{
    qIdx++;
    if(qIdx>=qSet.length)finishQuiz();
    else showQuiz();
  },2200);
}
function finishQuiz(){
  $('qProg').style.width='100%';
  $('quizArea').classList.add('hidden');
  $('gameOver').classList.remove('hidden');
  const pct=Math.round(qCorrect/qSet.length*100);
  $('goScore').textContent=pct+' / 100';
  const isNewBest=setBest('quiz',pct),badges=[];
  pushHist('Quiz',pct);
  submitResult('quiz',pct,qCorrect,qSet.length,qDetail);
  if(pct===100)badges.push('🌟 Nilai Sempurna');
  else if(pct>=75)badges.push('📚 Cerdas Lingkungan');
  if(isNewBest&&pct>0)badges.push('🏆 Rekor Baru');
  renderBadges(badges);
  let pose;
  if(pct===100){pose='cheer';$('goMsg').textContent='Sempurna! '+qCorrect+' dari '+qSet.length+' benar. Kamu ahli pengelolaan sampah! 🎉';sfxWin();confetti();}
  else if(pct>=60){pose='thumb';$('goMsg').textContent='Bagus! '+qCorrect+' dari '+qSet.length+' benar. Sedikit lagi jadi ahli!';sfxWin();}
  else{pose='plant';$('goMsg').textContent='Benar '+qCorrect+' dari '+qSet.length+'. Yuk pelajari lagi lewat menu Pilah & Edukasi! 🌱';sfxLose();}
  showGoMascot(pose);
  $('goBest').innerHTML=(isNewBest&&pct>0?'<span class="nb">✨ Rekor baru!</span> ':'')+'Nilai terbaik: <b>'+getBest('quiz')+'</b>';
}

/* ===== INIT halaman game ===== */
if($('gameStart')){updateStartBest();loadResponden();}

