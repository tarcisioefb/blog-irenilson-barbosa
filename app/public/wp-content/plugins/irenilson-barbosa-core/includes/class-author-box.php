<?php
namespace IrenilsonBarbosa\Core;

class AuthorBox {
	public static function init() {
		add_filter('the_content', [__CLASS__, 'auto_append']);
	}

	public static function auto_append($content) {
		if (! is_single() || ! in_the_loop() || in_array(get_post_type(), ['poiesis', 'livro'], true)) {
			return $content;
		}
		return $content . self::render_html();
	}

	public static function render() {
		if (is_single() && 'poiesis' === get_post_type()) {
			echo self::render_html();
		}
	}

	public static function render_html() {
		$author_id   = get_the_author_meta('ID');
		$author_name = get_the_author();
		$author_bio  = get_the_author_meta('description');
		$author_avatar = get_avatar($author_id, 80, '', $author_name, ['class' => 'avatar']);
		$about_link = home_url('/sobre/');

		return sprintf(
			'<div class="ib-author-box">
				<div class="ib-author-box__inner">
					<div class="ib-author-box__avatar"><a href="%s">%s</a></div>
					<div class="ib-author-box__body">
						<span class="ib-author-box__label">Sobre o autor</span>
						<strong class="ib-author-box__name"><a href="%s" style="color:inherit;text-decoration:none">%s</a></strong>
						<p class="ib-author-box__bio">%s</p>
					</div>
				</div>
			</div>',
			esc_url($about_link),
			$author_avatar,
			esc_url($about_link),
			esc_html($author_name),
			esc_html($author_bio)
		);
	}
}
