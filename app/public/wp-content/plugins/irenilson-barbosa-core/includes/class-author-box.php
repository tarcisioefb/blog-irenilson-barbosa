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
			'<div class="author-box" style="display:flex;gap:var(--wp--preset--spacing--40);margin-top:var(--wp--preset--spacing--60);padding:var(--wp--preset--spacing--40);background:var(--wp--preset--color--bege-50);border-radius:8px">
				<div style="flex-shrink:0">%s</div>
				<div>
					<strong style="color:var(--wp--preset--color--marrom-800)">%s</strong>
					<p style="margin:var(--wp--preset--spacing--10) 0 0;font-size:0.9rem;color:var(--wp--preset--color--marrom-600)">%s</p>
				</div>
			</div>',
			$author_avatar,
			esc_html($author_name),
			esc_html($author_bio)
		);

		return $content . $html;
	}
}
