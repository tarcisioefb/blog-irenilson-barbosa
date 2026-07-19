<?php
namespace IrenilsonBarbosa\Core;

class RelatedPosts {
	public static function init() {
		add_filter('the_content', [__CLASS__, 'display_related']);
	}

	public static function display_related($content) {
		if (! is_single() || ! in_the_loop()) {
			return $content;
		}

		$post_id = get_the_ID();
		$cats    = wp_get_post_categories($post_id, ['fields' => 'ids']);
		$tags    = wp_get_post_tags($post_id, ['fields' => 'ids']);

		if (empty($cats) && empty($tags)) {
			return $content;
		}

		$query_args = [
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post__not_in'   => [$post_id],
			'orderby'        => 'rand',
		];

		if (! empty($cats)) {
			$query_args['category__in'] = $cats;
		} elseif (! empty($tags)) {
			$query_args['tag__in'] = $tags;
		}

		$related = new \WP_Query($query_args);

		if (! $related->have_posts()) {
			return $content;
		}

		$html = '<div class="ib-related-section">';
		$html .= '<div class="article-section-divider"></div>';
		$html .= '<h2 class="ib-related-title">Artigos relacionados</h2>';
		$html .= '<div class="ib-related-grid">';

		while ($related->have_posts()) {
			$related->the_post();
			$tid = get_the_ID();
			$html .= '<a class="ib-related-card" href="' . get_permalink() . '">';
			if (has_post_thumbnail()) {
				$html .= '<span class="ib-related-card__img">' . get_the_post_thumbnail($tid, 'ib-card') . '</span>';
			}
			$html .= '<span class="ib-related-card__body">';
			$html .= '<span class="ib-related-card__t">' . get_the_title() . '</span>';
			$html .= '<span class="ib-related-card__date">' . get_the_date('j F Y') . '</span>';
			$html .= '</span></a>';
		}

		wp_reset_postdata();

		$html .= '</div></div>';

		return $content . $html;
	}
}
