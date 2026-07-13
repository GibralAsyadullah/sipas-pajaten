/* paparan.js */
/* ===== VIDEO ===== */
function ytId(url){
  const m=url.match(/(?:youtu\.be\/|v=|shorts\/|embed\/)([A-Za-z0-9_-]{11})/);
  return m?m[1]:null;
}
function addVideo(){
  const inp=$('videoUrl');
  const id=ytId(inp.value.trim());
  if(!id){alert('Link YouTube belum dikenali. Contoh format: https://youtu.be/XXXXXXXXXXX');return;}
  const empty=$('videoGrid').querySelector('.empty-vid');
  if(empty)empty.remove();
  renderVideo(id);
  inp.value='';
}
function renderVideo(id,cap){
  const grid=$('videoGrid');
  const card=document.createElement('div');
  card.className='video-card';
  card.innerHTML='<div class="frame"><iframe src="https://www.youtube.com/embed/'+id+'" title="Video edukasi" allowfullscreen loading="lazy"></iframe></div><div class="cap">'+(cap||'🎬 Video edukasi')+'</div>';
  grid.prepend(card);
}
$('videoGrid').innerHTML='<div class="card muted empty-vid" style="grid-column:1/-1">Belum ada video. Tempel link YouTube di atas untuk menambahkan — misalnya video sosialisasi pemilahan atau dokumentasi kegiatan KKN.</div>';

/* ===== POSTER ===== */
const cv=$('posterCanvas'),ctx=cv.getContext('2d');
function drawPoster(){
  const W=cv.width,H=cv.height;
  const g=ctx.createLinearGradient(0,0,0,H);
  g.addColorStop(0,'#0F3D28');g.addColorStop(1,'#1E7A46');
  ctx.fillStyle=g;ctx.fillRect(0,0,W,H);
  ctx.fillStyle='#F6F1E7';
  roundRect(30,150,W-60,H-260,26);ctx.fill();
  ctx.fillStyle='#fff';ctx.textAlign='center';
  ctx.font='700 30px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('AYO PILAH SAMPAHMU!',W/2,72);
  ctx.font='600 19px "Plus Jakarta Sans",sans-serif';
  ctx.fillStyle='#F2E4C0';
  ctx.fillText('Mulai dari dua: Organik & Anorganik',W/2,106);
  ctx.fillStyle='#3B9E56';roundRect(60,190,(W-150)/2,220,18);ctx.fill();
  ctx.fillStyle='#D4832A';roundRect(W/2+15,190,(W-150)/2,220,18);ctx.fill();
  ctx.fillStyle='#fff';
  ctx.font='60px sans-serif';
  ctx.fillText('🍃',60+(W-150)/4,270);
  ctx.fillText('🧴',W/2+15+(W-150)/4,270);
  ctx.font='700 24px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('ORGANIK',60+(W-150)/4,320);
  ctx.fillText('ANORGANIK',W/2+15+(W-150)/4,320);
  ctx.font='500 15px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('Sisa makanan, daun',60+(W-150)/4,352);
  ctx.fillText('→ kompos & maggot',60+(W-150)/4,375);
  ctx.fillText('Botol, kaleng, kardus',W/2+15+(W-150)/4,352);
  ctx.fillText('→ Bank Sampah',W/2+15+(W-150)/4,375);
  ctx.fillStyle='#17281E';
  ctx.font='700 22px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('♻️ Tabung Sampahmu, Jadi Rupiah!',W/2,470);
  ctx.font='500 17px "Plus Jakarta Sans",sans-serif';
  ctx.fillStyle='#5C6E60';
  wrapText('Bank Sampah Desa Pajaten kini aktif kembali. Setor sampah anorganik ke Kantor Kepala Desa — ditimbang, dicatat, jadi tabungan.',W/2,510,W-140,26);
  ctx.font='700 17px "Plus Jakarta Sans",sans-serif';
  ctx.fillStyle='#C0453B';
  wrapText('🚫 Jangan buang sampah ke irigasi — menyumbat air & memicu banjir.',W/2,625,W-140,26);
  ctx.fillStyle='#fff';
  ctx.font='600 16px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('KKN Cibuaya 2026 · Desa Pajaten',W/2,H-62);
  ctx.font='500 14px "Plus Jakarta Sans",sans-serif';
  ctx.fillStyle='#F2E4C0';
  ctx.fillText('Universitas Buana Perjuangan Karawang · @kkncibuaya2026_',W/2,H-36);
}
function roundRect(x,y,w,h,r){
  ctx.beginPath();
  ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);ctx.arcTo(x+w,y+h,x,y+h,r);
  ctx.arcTo(x,y+h,x,y,r);ctx.arcTo(x,y,x+w,y,r);ctx.closePath();
}
function wrapText(text,x,y,maxW,lh){
  const words=text.split(' ');let line='';
  for(const w of words){
    const t=line+w+' ';
    if(ctx.measureText(t).width>maxW&&line){ctx.fillText(line.trim(),x,y);line=w+' ';y+=lh;}
    else line=t;
  }
  ctx.fillText(line.trim(),x,y);
}
if(document.fonts&&document.fonts.ready){document.fonts.ready.then(drawPoster);}
drawPoster();
function downloadPoster(){
  const a=document.createElement('a');
  a.download='poster-pilah-sampah-pajaten.png';
  a.href=cv.toDataURL('image/png');
  a.click();
}

/* ===== KALKULATOR TABUNGAN SAMPAH ===== */
const CALC=[
  {n:'Botol plastik (PET)',e:'🍼',price:2500,co2:1.5},
  {n:'Kardus & kertas tebal',e:'📦',price:1500,co2:0.9},
  {n:'Kaleng / besi',e:'🥫',price:3000,co2:1.8},
  {n:'Aluminium',e:'🔩',price:12000,co2:9},
  {n:'Botol kaca',e:'🫙',price:500,co2:0.3},
  {n:'Koran bekas',e:'📰',price:2000,co2:0.9},
];
function rupiah(n){return 'Rp '+Math.round(n).toLocaleString('id-ID')}
function renderCalc(){
  const box=$('calcList');box.innerHTML='';
  CALC.forEach((c,i)=>{
    const row=document.createElement('div');row.className='calc-row';
    row.innerHTML='<span class="cr-ic">'+c.e+'</span><span class="cr-info"><b>'+c.n+'</b><small>± '+rupiah(c.price)+' / kg</small></span>'+
      '<span class="cr-input"><input type="number" min="0" step="0.5" inputmode="decimal" placeholder="0" id="ci'+i+'" oninput="updateCalc()" aria-label="Berat '+c.n+' (kg)"><span class="cr-unit">kg</span></span>';
    box.appendChild(row);
  });
}
function updateCalc(){
  let total=0,kg=0,co2=0;
  CALC.forEach((c,i)=>{const v=parseFloat($('ci'+i).value)||0;if(v>0){total+=v*c.price;kg+=v;co2+=v*c.co2}});
  $('calcTotal').textContent=rupiah(total);
  $('calcKg').textContent=(kg%1===0?kg:kg.toFixed(1))+' kg total';
  $('calcCo2').textContent='± '+(co2%1===0?co2:co2.toFixed(1))+' kg CO₂ dicegah';
  const trees=co2/21;
  $('calcTree').textContent = kg>0
    ? ('Setara serapan ± '+(trees<0.1?'<0,1':trees.toFixed(1))+' pohon selama setahun 🌳')
    : 'Isi beratnya untuk lihat dampak lingkunganmu.';
}
function resetCalc(){CALC.forEach((c,i)=>{$('ci'+i).value=''});updateCalc()}
renderCalc();
updateStartBest();

/* ===== SERTIFIKAT ===== */
let certReady=false;
function loadImg(src){return new Promise(res=>{const i=new Image();i.onload=()=>res(i);i.onerror=()=>res(null);i.src=src;});}
function roundRectPath(ctx,x,y,w,h,r){ctx.beginPath();ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);ctx.arcTo(x,y,x+w,y,r);ctx.closePath();}
function cLeaf(ctx,x,y,s,rot,color){ctx.save();ctx.translate(x,y);ctx.rotate(rot);ctx.fillStyle=color;ctx.beginPath();ctx.moveTo(0,0);ctx.bezierCurveTo(s*0.55,-s*0.35,s*0.55,-s*0.85,0,-s);ctx.bezierCurveTo(-s*0.55,-s*0.85,-s*0.55,-s*0.35,0,0);ctx.closePath();ctx.fill();ctx.restore();}
function leafCluster(ctx,x,y,d){cLeaf(ctx,x,y,44,d*0.5,'#2E7D46');cLeaf(ctx,x,y,36,d*1.2,'#4FB86C');cLeaf(ctx,x,y,28,d*-0.12,'#D9A227');}
function rosette(ctx,x,y,r){ctx.save();ctx.translate(x,y);for(let i=0;i<12;i++){ctx.rotate(Math.PI/6);ctx.fillStyle=i%2?'#C4901C':'#E0B94A';ctx.beginPath();ctx.moveTo(0,0);ctx.lineTo(-r*0.28,-r);ctx.lineTo(r*0.28,-r);ctx.closePath();ctx.fill();}ctx.beginPath();ctx.fillStyle='#0F3D28';ctx.arc(0,0,r*0.42,0,7);ctx.fill();ctx.fillStyle='#E0B94A';ctx.font='700 '+Math.round(r*0.5)+'px sans-serif';ctx.textAlign='center';ctx.textBaseline='middle';ctx.fillText('★',0,1);ctx.textBaseline='alphabetic';ctx.restore();}
async function makeCert(){
  const name=($('certName').value||'').trim()||'Sahabat Lingkungan';
  const cv=$('certCanvas'),ctx=cv.getContext('2d'),W=cv.width,H=cv.height;
  // latar gradien
  const bg=ctx.createLinearGradient(0,0,0,H);bg.addColorStop(0,'#FCFAF3');bg.addColorStop(1,'#E7F1DA');
  ctx.fillStyle=bg;ctx.fillRect(0,0,W,H);
  // bingkai warna
  ctx.strokeStyle='#C4901C';ctx.lineWidth=9;roundRectPath(ctx,22,22,W-44,H-44,22);ctx.stroke();
  ctx.strokeStyle='#1E7A46';ctx.lineWidth=2.5;roundRectPath(ctx,40,40,W-80,H-80,15);ctx.stroke();
  // aksen daun sudut
  leafCluster(ctx,66,128,1);leafCluster(ctx,W-66,128,-1);
  cLeaf(ctx,60,H-70,40,0.4,'#2E7D46');cLeaf(ctx,60,H-70,30,1.1,'#4FB86C');
  // banner judul (hijau)
  const bw=540,bx=W/2-bw/2,by=58;
  const bgr=ctx.createLinearGradient(bx,by,bx,by+96);bgr.addColorStop(0,'#1E7A46');bgr.addColorStop(1,'#0F3D28');
  ctx.fillStyle=bgr;roundRectPath(ctx,bx,by,bw,96,16);ctx.fill();
  ctx.textAlign='center';
  ctx.fillStyle='#F2E4C0';ctx.font='800 15px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('KKN CIBUAYA 2026 · DESA PAJATEN',W/2,by+30);
  ctx.fillStyle='#fff';ctx.font='800 40px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('SERTIFIKAT',W/2,by+76);
  // subjudul
  ctx.fillStyle='#C4901C';ctx.font='800 24px "Fraunces",Georgia,serif';
  ctx.fillText('✦ SAHABAT LINGKUNGAN ✦',W/2,196);
  ctx.fillStyle='#5C6E60';ctx.font='500 17px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('Dengan bangga diberikan kepada',W/2,238);
  // nama
  ctx.fillStyle='#0F3D28';ctx.font='700 48px "Fraunces",Georgia,serif';
  ctx.fillText(name,W/2,296);
  ctx.strokeStyle='#C4901C';ctx.lineWidth=2.5;
  ctx.beginPath();ctx.moveTo(W/2-200,316);ctx.lineTo(W/2+200,316);ctx.stroke();
  cLeaf(ctx,W/2-208,320,16,0.9,'#3B9E56');cLeaf(ctx,W/2+208,320,16,-0.9,'#3B9E56');
  // deskripsi
  ctx.fillStyle='#5C6E60';ctx.font='500 16px "Plus Jakarta Sans",sans-serif';
  const desc='atas kepedulian & partisipasi aktif dalam pengelolaan sampah berbasis lingkungan berkelanjutan di Desa Pajaten.';
  let line='',y=356;const words=desc.split(' ');
  for(const w of words){const t=line+w+' ';if(ctx.measureText(t).width>W-260&&line){ctx.fillText(line.trim(),W/2,y);line=w+' ';y+=26;}else line=t;}
  ctx.fillText(line.trim(),W/2,y);
  // medali emas (tengah)
  rosette(ctx,W/2,452,30);
  const tgl=new Date().toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'});
  ctx.textAlign='center';
  ctx.fillStyle='#17281E';ctx.font='600 15px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('Cibuaya, '+tgl, 285, 544);
  ctx.fillStyle='#5C6E60';ctx.font='500 12px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('Tanggal diterbitkan', 285, 564);
  // blok ttd kanan
  const sx=W-210;
  const [seal,masc]=await Promise.all([loadImg(SEAL_URI),loadImg(MASCOTS.cheer)]);
  ctx.textAlign='center';
  ctx.fillStyle='#5C6E60';ctx.font='500 13px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('Hormat kami,', sx, 470);
  // stempel seal: lingkaran putih + cincin emas, gambar di-clip lingkaran (rapi, tak distorsi)
  if(seal){
    const r=30, cy=512;
    ctx.save();
    ctx.beginPath();ctx.arc(sx,cy,r+3,0,Math.PI*2);ctx.fillStyle='#fff';ctx.fill();
    ctx.lineWidth=1.6;ctx.strokeStyle='#C4901C';ctx.stroke();
    ctx.beginPath();ctx.arc(sx,cy,r,0,Math.PI*2);ctx.clip();
    ctx.drawImage(seal,sx-r,cy-r,r*2,r*2);
    ctx.restore();
  }
  // garis tanda tangan di bawah stempel
  ctx.strokeStyle='#C4901C';ctx.lineWidth=1.6;ctx.beginPath();ctx.moveTo(sx-108,556);ctx.lineTo(sx+108,556);ctx.stroke();
  ctx.fillStyle='#0F3D28';ctx.font='800 16px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('Tim KKN Pajaten Cibuaya', sx, 578);
  ctx.fillStyle='#8F6710';ctx.font='700 11px "Plus Jakarta Sans",sans-serif';
  ctx.fillText('UBP Karawang · 2026', sx, 593);
  // maskot pojok kiri bawah
  if(masc){const mw=100,mh=masc.height*mw/masc.width;ctx.drawImage(masc,48,H-14-mh,mw,mh);}
  certReady=true;$('certDownload').disabled=false;
}
function downloadCert(){
  if(!certReady){makeCert().then(()=>{});return;}
  const a=document.createElement('a');
  a.download='sertifikat-sahabat-lingkungan-pajaten.png';
  a.href=$('certCanvas').toDataURL('image/png');a.click();
}
