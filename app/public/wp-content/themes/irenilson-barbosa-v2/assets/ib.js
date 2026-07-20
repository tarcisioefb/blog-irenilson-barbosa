/* IRENILSON BARBOSA — comportamento do tema: gaveta mobile, busca, sticky, copiar link, micro-interações. */
(function () {
	'use strict';
	function ready(fn){ if(document.readyState!=='loading'){fn();} else {document.addEventListener('DOMContentLoaded',fn);} }
	ready(function () {
		// === DRAWER (gaveta mobile) ===
		var burger = document.querySelector('[data-elite-burger]');
		var drawer = document.querySelector('[data-elite-drawer]');
		var scrim  = document.querySelector('[data-elite-scrim]');
		var closeEl= document.querySelector('[data-elite-close]');
		var mast   = document.getElementById('masthead');

		function openDrawer(){
			if(!drawer)return;
			drawer.classList.add('is-open');
			drawer.removeAttribute('aria-hidden');
			drawer.removeAttribute('inert');
			if(scrim){scrim.hidden=false; requestAnimationFrame(function(){scrim.classList.add('is-open');});}
			if(burger){burger.classList.add('is-open'); burger.setAttribute('aria-expanded','true');}
			document.body.style.overflow='hidden';
		}
		function closeDrawer(){
			if(!drawer)return;
			drawer.classList.remove('is-open');
			drawer.setAttribute('aria-hidden','true');
			drawer.setAttribute('inert','inert');
			if(scrim){scrim.classList.remove('is-open'); setTimeout(function(){scrim.hidden=true;},260);}
			if(burger){burger.classList.remove('is-open'); burger.setAttribute('aria-expanded','false');}
			document.body.style.overflow='';
		}
		if(burger){burger.addEventListener('click',openDrawer);}
		if(closeEl){closeEl.addEventListener('click',closeDrawer);}
		if(scrim){scrim.addEventListener('click',closeDrawer);}

		// === SEARCH ===
		var so = document.querySelector('[data-elite-search]');
		var sOpen = document.querySelector('[data-elite-search-open]');
		var sClose= document.querySelector('[data-elite-search-close]');
		function openSearch(){ if(!so)return; so.classList.add('is-open'); so.setAttribute('aria-hidden','false'); var i=so.querySelector('input'); if(i){setTimeout(function(){i.focus();},60);} }
		function closeSearch(){ if(!so)return; so.classList.remove('is-open'); so.setAttribute('aria-hidden','true'); }
		if(sOpen){sOpen.addEventListener('click',openSearch);}
		if(sClose){sClose.addEventListener('click',closeSearch);}
		document.addEventListener('keydown',function(e){ if(e.key==='Escape'){closeDrawer();closeSearch();} });

		// === STICKY HEADER ===
		if(mast){
			var tb=document.querySelector('.topbar');
			var th=tb?tb.offsetHeight:40;
			var ph=document.getElementById('masthead-placeholder');
			var onScroll=function(){
				if(window.pageYOffset>th){
					if(!mast.classList.contains('is-fixed')){
						mast.classList.add('is-fixed');
						if(!ph){ph=document.getElementById('masthead-placeholder');}
						if(ph){ph.classList.add('is-visible');}
					}
				} else {
					mast.classList.remove('is-fixed');
					if(ph){ph.classList.remove('is-visible');}
				}
			};
			window.addEventListener('scroll',onScroll,{passive:true}); onScroll();
		}

		// === READING PROGRESS BAR ===
		var rbar = document.getElementById('reading-bar');
		if(!rbar){
			rbar = document.createElement('div');
			rbar.id = 'reading-bar';
			rbar.className = 'reading-bar';
			document.body.prepend(rbar);
		}
		function updateReadingBar(){
			var scrollTop = window.pageYOffset;
			var docHeight = document.documentElement.scrollHeight - window.innerHeight;
			if(docHeight > 0){
				var progress = Math.min(scrollTop / docHeight * 100, 100);
				rbar.style.width = progress + '%';
			}
		}
		window.addEventListener('scroll', updateReadingBar, {passive:true});

		// === SCROLL TO TOP ===
		var stt = document.getElementById('scroll-top');
		if(!stt){
			stt = document.createElement('button');
			stt.id = 'scroll-top';
			stt.className = 'scroll-top';
			stt.setAttribute('aria-label', 'Voltar ao topo');
			stt.innerHTML = '<svg viewBox="0 0 24 24"><path d="M18 15l-6-6-6 6"/></svg>';
			document.body.appendChild(stt);
			stt.addEventListener('click', function(){
				window.scrollTo({top:0,behavior:'smooth'});
			});
		}
		function toggleScrollTop(){
			stt.classList.toggle('is-visible', window.pageYOffset > 400);
		}
		window.addEventListener('scroll', toggleScrollTop, {passive:true});

		// === COPIAR LINK ===
		document.addEventListener('click',function(e){
			var btn=e.target.closest ? e.target.closest('[data-elite-copy]') : null;
			if(!btn)return;
			var url=btn.getAttribute('data-elite-copy');
			var done=function(){ var old=btn.innerHTML; btn.innerHTML='Link copiado ✓'; setTimeout(function(){btn.innerHTML=old;},1600); };
			if(navigator.clipboard&&navigator.clipboard.writeText){ navigator.clipboard.writeText(url).then(done).catch(done); }
			else { var t=document.createElement('textarea'); t.value=url; document.body.appendChild(t); t.select(); try{document.execCommand('copy');}catch(x){} document.body.removeChild(t); done(); }
		});
	});
})();
