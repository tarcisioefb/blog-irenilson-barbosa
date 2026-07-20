<?php
namespace IrenilsonBarbosa\Core;

class ReadingTime {
	public static function init() {
		add_action('save_post', [__CLASS__, 'calculate_reading_time']);
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
}
