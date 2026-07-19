<?php
namespace IrenilsonBarbosa\Core;

class RelatedPosts {
	public static function init() {
		add_filter('the_content', [__CLASS__, 'display_related']);
	}

	public static function display_related($content) {
		if (! is_single() || ! in_the_loop() || ! function_exists('ib_card')) {
			return $content;
		}

		$post_id = get_the_ID();
		$cats    = wp_get_post_categories($post_id, ['fields' => 'ids']);

		if (empty($cats)) return $content;

		$related = new \WP_Query([
			'post_type'      => 'post',
			'posts_per_page' => 4,
			'post__not_in'   => [$post_id],
			'category__in'   => $cats,
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		]);

		// Se não tem 3 na mesma categoria, busca dos mais recentes
		if ($related->post_count < 3) {
			$related = new \WP_Query([
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'post__not_in'   => [$post_id],
				'orderby'        => 'date',
				'order'          => 'DESC',
				'no_found_rows'  => true,
			]);
		}

		if (! $related->have_posts()) return $content;

		$html = '<div class="eh-sec-head" style="margin-top:var(--space-8)"><h2>Artigos relacionados</h2></div>';
		$html .= '<div class="eh-cards">';

		while ($related->have_posts()) {
			$related->the_post();
			ob_start();
			ib_card(get_the_ID());
			$html .= ob_get_clean();
		}

		wp_reset_postdata();
		$html .= '</div>';

		return $content . $html;
	}
}
