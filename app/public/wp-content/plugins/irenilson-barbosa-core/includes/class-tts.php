<?php
namespace IrenilsonBarbosa\Core;

class TTS {
	public static function init() {
		add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue']);
		add_filter('the_content', [__CLASS__, 'append_button'], 5);
	}

	public static function enqueue() {
		if (!is_singular(['post', 'publicacao', 'livro', 'poiesis', 'material'])) return;
		$post_id = get_queried_object_id();
		$post_type_obj = get_post_type_object(get_post_type());
		$type_name = $post_type_obj ? mb_strtolower($post_type_obj->labels->singular_name) : 'artigo';
		if ('poiesis' === get_post_type()) {
			$author_name = get_post_meta($post_id, 'poiesis_author', true) ?: 'Irenilson Barbosa';
		} else {
			$author_name = get_the_author_meta('display_name', get_post($post_id)->post_author) ?: 'Irenilson Barbosa';
		}
		$bio = get_the_author_meta('description', get_post($post_id)->post_author);
		if (!$bio) {
			$bio = \IrenilsonBarbosa\Core\AdminSettings::opt('sidebar_bio') ?: 'Professor universitário, escritor e pesquisador.';
		}

		$theme_uri = get_template_directory_uri();
		wp_enqueue_script('ib-tts', $theme_uri . '/assets/ib-tts.js', [], ZUCA_CORE_VERSION, true);
		wp_localize_script('ib-tts', 'ibTTS', [
			'title'       => get_the_title($post_id),
			'author'      => $author_name,
			'typeName'    => $type_name,
			'bio'         => wp_trim_words($bio, 20),
			'pauseLabel'  => 'Pausar',
			'resumeLabel' => 'Continuar',
			'stopLabel'   => 'Parar',
			'loadingLabel'=> 'Preparando voz…',
		]);
	}

	public static function render_button() {
		?>
		<div class="ib-tts"><button type="button" class="ib-tts__play" data-ib-tts-play aria-label="Ouvir artigo"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M11 5L6 9H2v6h4l5 4V5z"/><line x1="20.07" y1="4.93" x2="22" y2="6"/><line x1="17" y1="7" x2="19" y2="9"/><line x1="20.07" y1="19.07" x2="22" y2="18"/><line x1="17" y1="17" x2="19" y2="15"/></svg><span>Ouvir</span></button><div class="ib-tts__controls" hidden><button type="button" class="ib-tts__ctrl" data-ib-tts-pause aria-label="Pausar"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg></button><button type="button" class="ib-tts__ctrl" data-ib-tts-stop aria-label="Parar"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="6" width="12" height="12"/></svg></button><span class="ib-tts__status" role="status" aria-live="polite"></span></div></div>
		<?php
	}

	public static function append_button($content) {
		if (!is_singular(['post', 'publicacao', 'livro', 'material']) || !in_the_loop() || !is_main_query()) {
			return $content;
		}
		static $done = false;
		if ($done) return $content;
		$done = true;
		ob_start(); self::render_button(); $btn = ob_get_clean();
		return $btn . '<!--/IB_TTS-->' . $content;
	}
}
