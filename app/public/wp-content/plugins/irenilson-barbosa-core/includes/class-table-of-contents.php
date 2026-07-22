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
		$html = '<div class="ib-toc is-open" data-ib-toc>';
		$html .= '<div class="ib-toc__head" data-ib-toc-head>';
		$html .= '<span class="ib-toc__head-inner"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg> <span class="ib-toc__title">Índice do artigo</span></span>';
		$html .= '<span class="ib-toc__toggle" aria-label="Alternar índice">▼</span>';
		$html .= '</div>';
		$html .= '<nav class="ib-toc__body"><ol class="ib-toc__list">';
		foreach ($headings as $h) {
			$id = 'toc-' . sanitize_title($h['title']);
			$html .= '<li class="ib-toc__item ib-toc__item--h' . $h['level'] . '"><a href="#' . esc_attr($id) . '" class="ib-toc__link">' . esc_html($h['title']) . '</a></li>';
		}
		$html .= '</ol></nav></div>';
		$html .= '<script>(function(){var e=document.querySelector("[data-ib-toc]");if(!e)return;var h=e.querySelector("[data-ib-toc-head]");h.addEventListener("click",function(){e.classList.toggle("is-open");});})();</script>';
		return $html;
	}
}
