<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Sanitiza conteúdos dos posts:
 * 1. Remove imagens duplicadas (thumbnail repetida no corpo)
 * 2. Restaura conteúdo completo do JSON para posts truncados
 * 3. Normaliza parágrafos (limpa HTML do Blogger, espaçamento)
 *
 * Uso: wp eval-file sanitize-content.php
 */

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';

$post_types = ['post', 'publicacao', 'livro', 'material'];
$posts = get_posts([
	'post_type'      => $post_types,
	'posts_per_page' => -1,
	'post_status'    => 'any',
]);

echo "Total: " . count($posts) . "\n\n";

$dup_removed = 0;
$restored = 0;
$formatted = 0;

// Carrega JSON do Blogger para restaurar conteúdos truncados
$json_path = dirname(ABSPATH, 3) . '/blogger-export.json';
$blogger_posts = [];
if (file_exists($json_path)) {
	$data = json_decode(file_get_contents($json_path), true);
	foreach ($data['posts'] as $bp) {
		$slug = basename($bp['permalink'], '.html');
		$blogger_posts[$slug] = $bp['content'];
	}
	echo "JSON carregado: " . count($blogger_posts) . " posts disponíveis\n\n";
}

// Mapeia slugs do WordPress para slugs do Blogger
$slug_map = [
	'natal-dos-covardes'         => 'natal-dos-covardes',
	'o-que-o-golpe-fara-de-nos'  => 'o-que-o-golpe-fara-de-nos',
	'capitalismo-mundial-em-crise-revela-perversidade-do-seu-sistema-de-desigualdades' => 'capitalismo-mundial-em-crise-revela',
	'ha-391-anos-era-instalado-o-tribunal-da-inquisicao-no-brasil' => 'ha-391-anos-era-instalado-o-tribunal-da-inquisicao-no-brasil',
	'dia-nacional-da-poesia-e-hoje' => 'dia-nacional-da-poesia-e-hoje',
	'da-teologia-do-tempo-e-de-suas-conveniencias-discursivas' => 'do-tempoc-e-de-suas-conveniencias',
];

function normalize_html($html) {
	if (empty($html)) return '';

	// Remove tracking pixels do Blogger
	$html = preg_replace('/<img[^>]*?width\s*=\s*["\']1["\'][^>]*?\/?\s*>/i', '', $html);
	$html = preg_replace('/<div[^>]*class="[^"]*separator[^"]*"[^>]*>\s*<\/div>/i', '', $html);

	// Remove <div> do Blogger que embrulham imagens, mantendo a img
	$html = preg_replace('/<div[^>]*>\s*(<a[^>]*>\s*<img[^>]*>\s*<\/a>)\s*<\/div>/i', '$1', $html);
	$html = preg_replace('/<div[^>]*>\s*(<img[^>]*>)\s*<\/div>/i', '$1', $html);

	// Converte <br> soltos em parágrafos
	$html = preg_replace('/<br\s*\/?>\s*<br\s*\/?>/i', "</p><p>", $html);
	$html = preg_replace('/<br\s*\/?>/i', ' ', $html);

	// Remove <div> aninhados do Blogger, mantendo texto
	$html = preg_replace('/<div[^>]*>/i', '', $html);
	$html = str_replace('</div>', '', $html);

	// Normaliza <p>
	$html = preg_replace('/<p[^>]*>/i', '<p>', $html);

	// Envolve texto solto em <p>
	if (strpos($html, '<p>') === false && strpos($html, '<h') === false && strpos($html, '<img') === false) {
		$html = '<p>' . $html . '</p>';
	}
	$html = preg_replace('/<\/p>\s*<p>/', "</p>\n\n<p>", $html);
	$html = preg_replace('/<p>\s*<\/p>/', '', $html);

	// Remove espaços múltiplos
	$html = preg_replace('/[ \t]+/', ' ', $html);
	$html = preg_replace('/\n\s*\n\s*\n/', "\n\n", $html);

	return trim($html);
}

foreach ($posts as $post) {
	$pid = $post->ID;
	$content = $post->post_content;
	$changed = false;

	// --- 1. Remove imagem duplicada da featured image ---
	if (has_post_thumbnail($pid)) {
		$thumb_file = get_attached_file(get_post_thumbnail_id($pid));
		if (!$thumb_file) continue;

		// Normaliza filename do thumbnail: remove acentos, tamanhos, +, _, hífens, espaços
		$raw = pathinfo(basename($thumb_file), PATHINFO_FILENAME);
		$normal = function_exists('remove_accents') ? mb_strtolower(remove_accents($raw)) : mb_strtolower($raw);
		$normal = preg_replace('/[\s_+\-]+/', '', $normal);
		$normal = preg_replace('/\d+x\d+$/', '', $normal);

		if (strlen($normal) < 5) continue iterate; // filename muito curto, pula

		// Percorre todas as imagens do conteúdo e remove se filename bater
		$new = preg_replace_callback('/<img[^>]*src=["\']([^"\']+)["\'][^>]*\/?>/i', function($m) use ($normal) {
			$url = basename($m[1]);
			$url_name = pathinfo($url, PATHINFO_FILENAME);
			$url_normal = mb_strtolower(remove_accents($url_name));
			$url_normal = preg_replace('/[\s_+\-%20]+/', '', $url_normal);
			$url_normal = preg_replace('/\d+x\d+$/', '', $url_normal);

			if (strlen($url_normal) < 5) return $m[0];
			// Match se um contém o outro (ignorando variações de normalização)
			if (strpos($url_normal, $normal) !== false || strpos($normal, $url_normal) !== false) {
				return '';
			}
			return $m[0];
		}, $content);

		if ($new !== $content) {
			// Remove <figure> e parágrafos/divs vazios
			$new = preg_replace('/<figure[^>]*>\s*<\/figure>/is', '', $new);
			$new = preg_replace('/<p>\s*<\/p>/', '', $new);
			$new = preg_replace('/<div>\s*<\/div>/', '', $new);
			$content = $new;
			$changed = true;
			$dup_removed++;
			echo "  Duplicata removida: {$post->post_title} (thumb: " . basename($thumb_file) . ")\n";
		}
	}

			if ($new !== $content) {
				$content = $new;
				$changed = true;
				$dup_removed++;
				echo "  Duplicata removida: {$post->post_title} (thumb: {$thumb_filename})\n";
			}
		}
	}

	// --- 2. Restaura conteúdo truncado do JSON ---
	if (strlen(trim(strip_tags($post->post_content))) < 200) {
		$slug = $post->post_name;
		// Tenta match exato, depois parcial
		$matched = $slug;
		if (!isset($blogger_posts[$matched])) {
			foreach ($blogger_posts as $bslug => $bcontent) {
				if (strpos($bslug, substr($slug, 0, 20)) === 0 || strpos($slug, $bslug) !== false) {
					$matched = $bslug;
					break;
				}
			}
		}
		if (isset($blogger_posts[$matched])) {
			$full = $blogger_posts[$matched];
			if (strlen($full) > strlen($content)) {
				$content = $full;
				$changed = true;
				$restored++;
				echo "  Restaurado do JSON: {$post->post_title}\n";
			}
		}
	}

	// --- 3. Normaliza formatação ---
	if ($changed || strlen($content) > 100) {
		$normalized = normalize_html($content);
		if ($normalized !== $post->post_content) {
			wp_update_post(['ID' => $pid, 'post_content' => $normalized]);
			$formatted++;
			echo "  Formatado: {$post->post_title}\n";
		}
	}
}

echo "\n---\n";
echo "Imagens duplicadas removidas: {$dup_removed}\n";
echo "Posts restaurados do JSON: {$restored}\n";
echo "Posts formatados: {$formatted}\n";
