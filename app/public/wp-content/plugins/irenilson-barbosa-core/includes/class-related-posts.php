<?php
namespace IrenilsonBarbosa\Core;

class RelatedPosts {
	public static function init() {}

	public static function render() {
		if (! is_single() || ! function_exists('ib_card')) return;

		$post_id = get_the_ID();
		$cats    = wp_get_post_categories($post_id, ['fields' => 'ids']);
		if (empty($cats)) return;

		$related = new \WP_Query([
			'post_type'      => 'post',
			'posts_per_page' => 4,
			'post__not_in'   => [$post_id],
			'category__in'   => $cats,
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		]);

		if ($related->post_count < 3) {
			wp_reset_postdata();
			$related = new \WP_Query([
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'post__not_in'   => [$post_id],
				'orderby'        => 'date',
				'order'          => 'DESC',
				'no_found_rows'  => true,
			]);
		}

		if (! $related->have_posts()) { wp_reset_postdata(); return; }

		echo '<div class="eh-sec-head"><h2>Artigos relacionados</h2></div>';
		echo '<div class="eh-cards eh-cards--3col">';

		while ($related->have_posts()) {
			$related->the_post();
			ib_card(get_the_ID());
		}

		wp_reset_postdata();
		echo '</div>';
	}
}
