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
			'<div class="author-box" style="display:flex;gap:var(--space-4);margin-top:var(--space-6);padding:var(--space-4);background:var(--paper-2);border-radius:var(--radius-md)">
				<div style="flex-shrink:0">%s</div>
				<div>
					<strong style="color:var(--ink)">%s</strong>
					<p style="margin:var(--space-1) 0 0;font-size:0.9rem;color:var(--tx-2)">%s</p>
				</div>
			</div>',
			$author_avatar,
			esc_html($author_name),
			esc_html($author_bio)
		);

		return $content . $html;
	}
}
