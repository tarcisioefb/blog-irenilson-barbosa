<?php
namespace IrenilsonBarbosa\Core;

class ReadingTime {
	public static function init() {
		add_action('save_post', [__CLASS__, 'calculate_reading_time']);
		add_filter('the_content', [__CLASS__, 'display_reading_time']);
	}

	public static function calculate_reading_time($post_id) {
		if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
			return;
		}

		$post    = get_post($post_id);
		$content = wp_strip_all_tags($post->post_content);
		$words   = str_word_count($content, 0, 'àáâãäéèêëíìîïóòôõöúùûüçñÀÁÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÜÇÑ');
		$minutes = max(1, round($words / 200));

		update_post_meta($post_id, 'tempo_leitura', $minutes);
	}

	public static function display_reading_time($content) {
		if (! is_single() || ! in_the_loop()) {
			return $content;
		}

		$minutes = get_post_meta(get_the_ID(), 'tempo_leitura', true);
		if (! $minutes) {
			return $content;
		}

		$label = sprintf(_n('%d min de leitura', '%d min de leitura', $minutes, 'irenilson-barbosa-core'), $minutes);

		$badge = sprintf(
			'<p class="reading-time" style="font-size:0.875rem;color:var(--wp--preset--color--marrom-400);margin-bottom:var(--wp--preset--spacing--30)">%s</p>',
			esc_html($label)
		);

		return $badge . $content;
	}
}
