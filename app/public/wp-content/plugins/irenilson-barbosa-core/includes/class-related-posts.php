<?php
namespace IrenilsonBarbosa\Core;

class RelatedPosts {
	public static function init() {}

	public static function get_ids($post_id = null, $limit = 4) {
		if (! $post_id) $post_id = get_the_ID();
		$cats = wp_get_post_categories($post_id, ['fields' => 'ids']);
		if (empty($cats)) return [];

		$related = new \WP_Query([
			'post_type'      => 'post',
			'posts_per_page' => $limit + 1,
			'post__not_in'   => [$post_id],
			'category__in'   => $cats,
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		]);

		$ids = [];
		if ($related->have_posts()) {
			while ($related->have_posts()) { $related->the_post(); $ids[] = get_the_ID(); }
		}
		wp_reset_postdata();

		if (count($ids) < $limit) {
			$fill = get_posts([
				'posts_per_page' => $limit - count($ids),
				'post__not_in'   => array_merge([$post_id], $ids),
				'orderby'        => 'date',
				'order'          => 'DESC',
				'fields'         => 'ids',
			]);
			$ids = array_merge($ids, $fill);
		}

		return array_slice($ids, 0, $limit);
	}

	public static function render() {
		if (! is_single() || ! function_exists('ib_card')) return;
		$ids = self::get_ids();
		if (empty($ids)) return;

		echo '<div class="eh-sec-head"><h2>Artigos relacionados</h2></div>';
		echo '<div class="eh-cards eh-cards--4col">';
		foreach ($ids as $rid) { ib_card($rid); }
		echo '</div>';
	}
}
