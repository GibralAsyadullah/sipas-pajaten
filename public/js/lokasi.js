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
