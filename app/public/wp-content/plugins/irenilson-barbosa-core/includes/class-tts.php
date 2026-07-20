<?php
namespace IrenilsonBarbosa\Core;

class TTS {
	public static function init() {
		add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue']);
		add_filter('the_content', [__CLASS__, 'append_button'], 5);
	}

	public static function enqueue() {
		if (!is_singular(['post', 'publicacao', 'livro', 'poiesis', 'material'])) return;
		$theme_uri = get_template_directory_uri();
		wp_enqueue_script('ib-tts', $theme_uri . '/assets/ib-tts.js', [], IRENILSON_CORE_VERSION, true);
		wp_localize_script('ib-tts', 'ibTTS', [
			'pauseLabel'  => 'Pausar',
			'resumeLabel' => 'Continuar',
			'stopLabel'   => 'Parar',
			'loadingLabel'=> 'Preparando voz…',
		]);
	}

	public static function append_button($content) {
		if (!is_singular(['post', 'publicacao', 'livro', 'poiesis', 'material']) || !in_the_loop() || !is_main_query()) {
			return $content;
		}
		static $done = false;
		if ($done) return $content;
		$done = true;
		$btn = '<div class="ib-tts"><button type="button" class="ib-tts__play" data-ib-tts-play aria-label="Ouvir artigo">'
			. '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M11 5L6 9H2v6h4l5 4V5z"/><line x1="20.07" y1="4.93" x2="22" y2="6"/><line x1="17" y1="7" x2="19" y2="9"/><line x1="20.07" y1="19.07" x2="22" y2="18"/><line x1="17" y1="17" x2="19" y2="15"/></svg>'
			. '<span>Ouvir</span>'
			. '</button>'
			. '<div class="ib-tts__controls" hidden>'
			. '<button type="button" class="ib-tts__ctrl" data-ib-tts-pause aria-label="Pausar"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg></button>'
			. '<button type="button" class="ib-tts__ctrl" data-ib-tts-stop aria-label="Parar"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="6" width="12" height="12"/></svg></button>'
			. '<span class="ib-tts__status"></span>'
			. '</div></div>';
		return $btn . $content;
	}
}
