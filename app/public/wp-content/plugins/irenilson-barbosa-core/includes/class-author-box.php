<?php
namespace IrenilsonBarbosa\Core;

class AuthorBox {
	public static function init() {
		add_filter('the_content', [__CLASS__, 'display_author_box']);
	}

	public static function display_author_box($content) {
		if (! is_single() || ! in_the_loop()) {
			return $content;
		}

		$author_id   = get_the_author_meta('ID');
		$author_name = get_the_author();
		$author_bio  = get_the_author_meta('description');
		$author_avatar = get_avatar($author_id, 80, '', $author_name, ['class' => 'avatar']);

		$html = sprintf(
			'<div class="ib-author-box">
				<div class="ib-author-box__inner">
					<div class="ib-author-box__avatar">%s</div>
					<div class="ib-author-box__body">
						<span class="ib-author-box__label">Sobre o autor</span>
						<strong class="ib-author-box__name">%s</strong>
						<p class="ib-author-box__bio">%s</p>
					</div>
				</div>
			</div>',
			$author_avatar,
			esc_html($author_name),
			esc_html($author_bio)
		);

		return $content . $html;
	}
}
