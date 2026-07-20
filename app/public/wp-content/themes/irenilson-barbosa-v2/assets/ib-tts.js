/* IRENILSON BARBOSA — Text-to-Speech com Web Speech API */
(function () {
	'use strict';

	if (!window.speechSynthesis || !window.ibTTS) return;

	var article, utterance, voices = [], isPT = false;
	var wrap = document.querySelector('.article__body') || document.querySelector('.article');
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

	function getFullText() {
		var title = ibTTS.title || '';
		var author = ibTTS.author || '';
		var typeName = ibTTS.typeName || 'artigo';
		var bio = ibTTS.bio || '';
		var body = '';

		var paragraphs = article.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li, blockquote, figcaption');
		paragraphs.forEach(function (el) {
			var txt = el.textContent.trim();
			if (txt && !el.closest('.ib-tts')) body += txt + '.\n';
		});

		var intro = title + '. ';
		if (author) intro += 'Por ' + author + '. ' + '… … ';
		var outro = ' Este ' + typeName + ' foi escrito por ' + author + '. ' + bio + '.';

		return intro + body + outro;
	}

	function speak() {
		if (speechSynthesis.speaking && !speechSynthesis.paused) {
			speechSynthesis.cancel();
		}
		var text = getFullText();
		if (!text) return;

		utterance = new SpeechSynthesisUtterance(text);
		utterance.voice = getVoice();
		utterance.rate = getRate();
		utterance.lang = 'pt-BR';

		utterance.onstart = function () {
			playBtn.hidden = true;
			ctrls.hidden = false;
			statusEl.textContent = isPT ? 'Reproduzindo…' : 'Reproduzindo… (voz PT pode nao estar disponivel)';
		};

		utterance.onend = function () { resetUI(); };
		utterance.onerror = function () { resetUI(); statusEl.textContent = 'Erro ao reproduzir.'; };

		utterance.onpause = function () {
			pauseBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="5 3 19 12 5 21 5 3"/></svg>';
			pauseBtn.setAttribute('aria-label', 'Continuar');
			statusEl.textContent = 'Pausado.';
		};

		utterance.onresume = function () {
			pauseBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>';
			pauseBtn.setAttribute('aria-label', 'Pausar');
			statusEl.textContent = 'Reproduzindo…';
		};

		speechSynthesis.speak(utterance);
	}

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
	}

	function init() {
		article = document.querySelector('.article__body') || document.querySelector('.article');
		if (!article) return;

		playBtn = document.querySelector('[data-ib-tts-play]');
		ctrls = document.querySelector('.ib-tts__controls');
		pauseBtn = document.querySelector('[data-ib-tts-pause]');
		stopBtn = document.querySelector('[data-ib-tts-stop]');
		statusEl = document.querySelector('.ib-tts__status');
		if (!playBtn || !ctrls || !pauseBtn || !stopBtn || !statusEl) return;

		loadVoices();
		if (typeof speechSynthesis.onvoiceschanged !== 'undefined') {
			speechSynthesis.onvoiceschanged = loadVoices;
		}

		playBtn.addEventListener('click', speak);
		pauseBtn.addEventListener('click', togglePause);
		stopBtn.addEventListener('click', stop);
	}

	ready(init);
})();
