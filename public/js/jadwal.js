/* jadwal.js — animasi ring persentase (data dirender server) */
(function(){
  const ring=document.getElementById('jRing');
  if(!ring)return;
  const pct=parseInt(ring.dataset.pct||'0',10)||0;
  const o=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){
    ring.style.setProperty('--p',(pct*3.6)+'deg');
    animatePct(document.getElementById('jPct'),pct);o.disconnect();
  }})});
  o.observe(ring);
})();
