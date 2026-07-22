<?php
namespace IrenilsonBarbosa\Core;

class TableOfContents {
	public static function init() {
		add_filter('the_content', [__CLASS__, 'process_content'], 7);
	}

	public static function process_content($content) {
		if (!is_singular(['post', 'publicacao', 'livro', 'material']) || !in_the_loop() || !is_main_query()) {
			return $content;
		}
		static $done = false;
		if ($done) return $content;
		$done = true;

		$headings = self::extract_headings($content);
		if (count($headings) < 2) return $content;

		$content = self::add_anchors($content, $headings);
		$toc = self::render_toc($headings);

		if (strpos($content, '<!--/IB_TTS-->') !== false) {
			$content = str_replace('<!--/IB_TTS-->', $toc . '<!--/IB_TTS-->', $content);
		} else {
			$content = $toc . $content;
		}
		return $content;
	}

	private static function extract_headings($content) {
		$pattern = '/<h([23])\s*[^>]*?>(.*?)<\/h[23]>/is';
		preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
		$headings = [];
		foreach ($matches as $m) {
			$headings[] = [
				'level' => (int) $m[1],
				'title' => wp_strip_all_tags($m[2]),
			];
		}
		return $headings;
	}

	private static function add_anchors($content, $headings) {
		foreach ($headings as $h) {
			$id = 'toc-' . sanitize_title($h['title']);
			$pattern = '/<h[' . $h['level'] . ']\s*([^>]*?)>' . preg_quote($h['title'], '/') . '<\/h[' . $h['level'] . ']>/i';
			$replacement = '<h' . $h['level'] . ' $1 id="' . esc_attr($id) . '">' . $h['title'] . '</h' . $h['level'] . '>';
			$content = preg_replace($pattern, $replacement, $content, 1);
		}
		return $content;
	}

	private static function render_toc($headings) {
		$html = '<details class="ib-toc" open>';
		$html .= '<summary class="ib-toc__summary"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg> Índice do artigo</summary>';
		$html .= '<nav class="ib-toc__nav"><ol class="ib-toc__list">';
		$prev_level = 2;
		foreach ($headings as $h) {
			$id = 'toc-' . sanitize_title($h['title']);
			if ($h['level'] > $prev_level) {
				$html .= '<ol class="ib-toc__sublist">';
			} elseif ($h['level'] < $prev_level) {
				$html .= '</ol></li>';
			}
			$tag = $h['level'] === 2 ? 'li' : 'li';
			$html .= '<' . $tag . ' class="ib-toc__item ib-toc__item--h' . $h['level'] . '"><a href="#' . esc_attr($id) . '" class="ib-toc__link">' . esc_html($h['title']) . '</a>';
			if ($h['level'] === $prev_level) {
				$html .= '</li>';
			}
			$prev_level = $h['level'];
		}
		while ($prev_level > 2) {
			$html .= '</ol></li>';
			$prev_level--;
		}
		if (substr($html, -5) !== '</li>') $html .= '</li>';
		$html .= '</ol></nav></details>';
		return $html;
	}
}
