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

		$html = '<div class="related-posts" style="margin-top:var(--wp--preset--spacing--70);padding-top:var(--wp--preset--spacing--50);border-top:1px solid var(--wp--preset--color--bege-300)">';
		$html .= '<h3 style="font-size:1rem;text-transform:uppercase;letter-spacing:0.05em;color:var(--wp--preset--color--marrom-400);margin-bottom:var(--wp--preset--spacing--40)">Artigos relacionados</h3>';
		$html .= '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:var(--wp--preset--spacing--40)">';

		while ($related->have_posts()) {
			$related->the_post();
			$html .= '<div style="background:var(--wp--preset--color--branco);border-radius:8px;padding:var(--wp--preset--spacing--40)">';
			if (has_post_thumbnail()) {
				$html .= get_the_post_thumbnail(get_the_ID(), 'medium', [
					'style' => 'width:100%;height:140px;object-fit:cover;border-radius:4px;margin-bottom:var(--wp--preset--spacing--30)',
				]);
			}
			$html .= '<h4 style="margin:0 0 var(--wp--preset--spacing--20)"><a href="' . get_permalink() . '" style="color:var(--wp--preset--color--marrom-800);text-decoration:none">' . get_the_title() . '</a></h4>';
			$html .= '<p style="font-size:0.875rem;color:var(--wp--preset--color--marrom-400);margin:0">' . get_the_date('j F Y') . '</p>';
			$html .= '</div>';
		}

		wp_reset_postdata();

		$html .= '</div></div>';

		return $content . $html;
	}
}
