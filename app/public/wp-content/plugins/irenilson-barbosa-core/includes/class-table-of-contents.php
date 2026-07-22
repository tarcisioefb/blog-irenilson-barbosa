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

		$headings = [];
		$content = preg_replace_callback('/<h([23])(\s[^>]*?)?>(.*?)<\/h[23]>/is', function($m) use (&$headings) {
			$level = (int) $m[1];
			$attrs = $m[2] ?? '';
			$inner = $m[3];
			$title = wp_strip_all_tags($inner);
			$id = 'toc-' . sanitize_title($title);
			$headings[] = ['level' => $level, 'title' => $title, 'id' => $id];
			if (preg_match('/\bid\s*=\s*["\']/', $attrs)) {
				return $m[0];
			}
			return "<h{$level}{$attrs} id=\"{$id}\">{$inner}</h{$level}>";
		}, $content);

		if (count($headings) < 2) return $content;

		$toc = self::render_toc($headings);

		if (strpos($content, '<!--/IB_TTS-->') !== false) {
			$content = str_replace('<!--/IB_TTS-->', $toc . '<!--/IB_TTS-->', $content);
		} else {
			$content = $toc . $content;
		}
		return $content;
	}

	private static function render_toc($headings) {
		$html = '<div class="ib-toc is-open" data-ib-toc>';
		$html .= '<div class="ib-toc__head" data-ib-toc-head>';
		$html .= '<span class="ib-toc__head-inner"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg> <span class="ib-toc__title">Índice do artigo</span></span>';
		$html .= '<span class="ib-toc__toggle" aria-label="Alternar índice"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>';
		$html .= '</div>';
		$html .= '<nav class="ib-toc__body"><ul class="ib-toc__list">';
		foreach ($headings as $h) {
			$html .= '<li class="ib-toc__item ib-toc__item--h' . $h['level'] . '"><a href="#' . esc_attr($h['id']) . '" class="ib-toc__link">' . esc_html($h['title']) . '</a></li>';
		}
		$html .= '</ul></nav></div>';
		$html .= '<script>(function(){var e=document.querySelector("[data-ib-toc]");if(!e)return;var h=e.querySelector("[data-ib-toc-head]");h.addEventListener("click",function(){e.classList.toggle("is-open");})})();</script>';
		return $html;
	}
}
