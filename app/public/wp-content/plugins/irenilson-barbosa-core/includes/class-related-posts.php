<?php
namespace IrenilsonBarbosa\Core;

class RelatedPosts {
	public static function init() {
		add_filter('the_content', [__CLASS__, 'display_related']);
	}

	public static function primary_cat($id) {
		$cats = get_the_category($id);
		foreach ($cats as $c) {
			if ('uncategorized' !== strtolower($c->slug)) return $c;
		}
		return !empty($cats) ? $cats[0] : null;
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

		$html = '<div class="eh-sec-head" style="margin-top:var(--space-8)"><h2>Artigos relacionados</h2></div>';
		$html .= '<div class="eh-cards">';

		while ($related->have_posts()) {
			$related->the_post();
			$tid = get_the_ID();
			$ob = get_post($tid);
			$html .= '<article class="eh-card">';
			$html .= '<a class="eh-card__imgwrap' . (has_post_thumbnail($tid) ? '' : ' is-empty') . '" href="' . get_permalink($tid) . '" aria-label="' . esc_attr(get_the_title($tid)) . '">';
			if (has_post_thumbnail($tid)) {
				$html .= get_the_post_thumbnail($tid, 'ib-card', ['loading' => 'lazy']);
			}
			$cat = \IrenilsonBarbosa\Core\RelatedPosts::primary_cat($tid);
			if ($cat) {
				$html .= '<span class="en-tag en-tag--solid">' . esc_html($cat->name) . '</span>';
			}
			$html .= '</a>';
			$html .= '<h3 class="eh-card__t"><a href="' . get_permalink($tid) . '">' . esc_html(get_the_title($tid)) . '</a></h3>';
			$html .= '</article>';
		}

		wp_reset_postdata();

		$html .= '</div>';

		return $content . $html;
	}
}
