/* IRENILSON BARBOSA — Text-to-Speech com Web Speech API */
(function () {
	'use strict';

	if (!window.speechSynthesis || !window.ibTTS) return;

	var article, utterance, voices = [], isPT = false, chunks = [], chunkIdx = 0;

	var playBtn, ctrls, pauseBtn, stopBtn, statusEl;

	function ready(fn) { if (document.readyState !== 'loading') fn(); else document.addEventListener('DOMContentLoaded', fn); }

	function loadVoices() {
		voices = speechSynthesis.getVoices();
		isPT = voices.some(function (v) { return v.lang && v.lang.startsWith('pt'); });
	}

	function getVoice() {
		if (!voices.length) loadVoices();
		var saved = localStorage.getItem('ib-tts-voice');
		if (saved) {
			var match = voices.filter(function (v) { return v.name === saved; });
			if (match.length) return match[0];
		}
		var pt = voices.filter(function (v) { return v.lang && v.lang.startsWith('pt'); });
		if (pt.length) return pt[0];
		if (voices.length) return voices[0];
		return null;
	}

	function getRate() {
		return parseFloat(localStorage.getItem('ib-tts-rate')) || 1.1;
	}

	function buildChunks() {
		chunks = []; chunkIdx = 0;
		var title = ibTTS.title || '';
		var author = ibTTS.author || '';
		var typeName = ibTTS.typeName || 'artigo';
		var bio = ibTTS.bio || '';

		if (title) chunks.push(title + '.');
		if (author) chunks.push('Por ' + author + '.');
		if (title || author) chunks.push('');

		var isPoem = article.classList.contains('ib-poem-body');
		var paragraphs = article.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li, blockquote, figcaption');
		paragraphs.forEach(function (el) {
			if (el.closest('.ib-tts') || el.closest('.article__meta') || el.closest('.ib-author-box')) return;
			if (isPoem && el.querySelector('br')) {
				var parts = el.innerHTML.split(/<br\s*\/?>/i);
				parts.forEach(function (part) {
					var txt = part.replace(/<[^>]+>/g, '').trim();
					if (txt) chunks.push(txt);
				});
			} else {
				var txt = el.textContent.trim();
				if (txt) chunks.push(txt);
			}
		});
		if (isPoem) {
			var notes = document.querySelector('.ib-poem-notes');
			if (notes) {
				chunks.push('');
				chunks.push('Notas do autor.');
				chunks.push(notes.textContent.trim());
			}
		}
		chunks.push('');
		var isIrenilson = author.indexOf('Irenilson') !== -1;
		chunks.push('Este ' + typeName + ' foi escrito por ' + author + '.' + (isIrenilson ? ' ' + bio + '.' : ''));
	}

	function speakFrom(idx) {
		if (idx < 0 || idx >= chunks.length) return;
		chunkIdx = idx;
		if (speechSynthesis.speaking) speechSynthesis.cancel();
		var text = chunks.slice(chunkIdx).join(' … ');
		if (!text) return;
		utterance = new SpeechSynthesisUtterance(text);
		utterance.voice = getVoice();
		utterance.rate = getRate();
		utterance.lang = 'pt-BR';
		utterance.onstart = function () { updateUI('play'); };
		utterance.onend = function () { resetUI(); };
		utterance.onerror = function () { resetUI(); statusEl.textContent = 'Erro ao reproduzir.'; };
		utterance.onpause = function () { updateUI('pause'); };
		utterance.onresume = function () { updateUI('resume'); };
		speechSynthesis.speak(utterance);
	}

	function updateUI(state) {
		playBtn.hidden = true;
		ctrls.hidden = false;
		if (state === 'play') statusEl.textContent = isPT ? 'Reproduzindo…' : 'Reproduzindo… (voz PT pode nao estar disponivel)';
		else if (state === 'pause') { pauseBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="5 3 19 12 5 21 5 3"/></svg>'; pauseBtn.setAttribute('aria-label', 'Continuar'); statusEl.textContent = 'Pausado.'; }
		else if (state === 'resume') { pauseBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>'; pauseBtn.setAttribute('aria-label', 'Pausar'); statusEl.textContent = 'Reproduzindo…'; }
	}

	function speak() { buildChunks(); speakFrom(0); }

	function togglePause() {
		if (speechSynthesis.paused) speechSynthesis.resume();
		else if (speechSynthesis.speaking) speechSynthesis.pause();
	}

	function stop() { speechSynthesis.cancel(); resetUI(); }

	function resetUI() {
		playBtn.hidden = false;
		ctrls.hidden = true;
		pauseBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>';
		pauseBtn.setAttribute('aria-label', 'Pausar');
		statusEl.textContent = '';
		chunks = [];
	}

	function init() {
		article = document.querySelector('.article__body, .ib-poem-body');
		if (!article) return;
		playBtn = document.querySelector('[data-ib-tts-play]');
		ctrls = document.querySelector('.ib-tts__controls');
		pauseBtn = document.querySelector('[data-ib-tts-pause]');
		stopBtn = document.querySelector('[data-ib-tts-stop]');
		statusEl = document.querySelector('.ib-tts__status');
		if (!playBtn || !ctrls || !pauseBtn || !stopBtn || !statusEl) return;
		loadVoices();
		if (typeof speechSynthesis.onvoiceschanged !== 'undefined') speechSynthesis.onvoiceschanged = loadVoices;
		playBtn.addEventListener('click', speak);
		pauseBtn.addEventListener('click', togglePause);
		stopBtn.addEventListener('click', stop);
	}

	ready(init);
})();
