<?php
namespace IrenilsonBarbosa\Core;

class RelatedPosts {
	public static function init() {}

	public static function render() {
		if (! is_single() || ! function_exists('ib_card')) return;

		$post_id = get_the_ID();
		$cats    = wp_get_post_categories($post_id, ['fields' => 'ids']);
		if (empty($cats)) return;

		// Primeiro tenta buscar 4 da mesma categoria
		$related = new \WP_Query([
			'post_type'      => 'post',
			'posts_per_page' => 5,
			'post__not_in'   => [$post_id],
			'category__in'   => $cats,
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		]);

		$ids = [];
		if ($related->have_posts()) {
			while ($related->have_posts()) {
				$related->the_post();
				$ids[] = get_the_ID();
			}
		}
		wp_reset_postdata();

		// Se não tem 4, completa com os mais recentes (excluindo já selecionados)
		if (count($ids) < 4) {
			$fill = get_posts([
				'posts_per_page' => 4 - count($ids),
				'post__not_in'   => array_merge([$post_id], $ids),
				'orderby'        => 'date',
				'order'          => 'DESC',
				'fields'         => 'ids',
			]);
			$ids = array_merge($ids, $fill);
		}

		if (empty($ids)) return;

		echo '<div class="eh-sec-head"><h2>Artigos relacionados</h2></div>';
		echo '<div class="eh-cards eh-cards--4col">';

		foreach ($ids as $rid) {
			ib_card($rid);
		}

		echo '</div>';
	}
}
