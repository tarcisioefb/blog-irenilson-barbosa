<?php
/**
 * 1. Remove imagem do conteúdo se for a mesma da thumbnail.
 * 2. Define thumbnail a partir da 1ª imagem do conteúdo (se houver).
 * 3. Baixa placeholder de serviço externo para posts sem nenhuma imagem.
 *
 * Uso: wp eval-file images.php
 */

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$post_types = ['post', 'publicacao', 'livro', 'material'];

$posts = get_posts([
	'post_type'      => $post_types,
	'posts_per_page' => -1,
	'post_status'    => 'any',
]);

echo "Total de posts: " . count($posts) . "\n\n";

$duplicates_removed = 0;
$thumb_from_content = 0;
$placeholder_downloaded = 0;

foreach ($posts as $post) {
	$pid = $post->ID;
	$content = $post->post_content;

	// --- 1. Remove imagem duplicada do conteúdo ---
	if (has_post_thumbnail($pid)) {
		$thumb_id = get_post_thumbnail_id($pid);
		$thumb_url = wp_get_attachment_url($thumb_id);

		if ($thumb_url && strpos($content, $thumb_url) !== false) {
			$new_content = preg_replace(
				'/<figure[^>]*>.*?<img[^>]*src=["\']' . preg_quote($thumb_url, '/') . '["\'][^>]*>.*?<\/figure>/is',
				'',
				$content
			);
			$new_content = preg_replace(
				'/<img[^>]*src=["\']' . preg_quote($thumb_url, '/') . '["\'][^>]*\/?>/i',
				'',
				$new_content
			);

			if ($new_content !== $content) {
				wp_update_post(['ID' => $pid, 'post_content' => $new_content]);
				$duplicates_removed++;
				$content = $new_content;
				echo "  Duplicata removida: {$post->post_title}\n";
			}
		}
	}

	// --- 2. Se não tem thumbnail, tenta usar 1ª imagem do conteúdo ---
	if (! has_post_thumbnail($pid)) {
		if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches)) {
			$img_url = $matches[1];
			if (strpos($img_url, 'http') === 0 && ! preg_match('/icon|avatar|pixel|blogger\.com\/img\/blogger/', $img_url)) {
				$attach_id = media_sideload_image($img_url, $pid, null, 'id');
				if (! is_wp_error($attach_id)) {
					set_post_thumbnail($pid, $attach_id);
					$thumb_from_content++;
					echo "  Thumbnail do conteúdo: {$post->post_title}\n";

					// Remove a imagem do conteúdo já que virou thumbnail
					$new_content = preg_replace(
						'/<figure[^>]*>.*?<img[^>]*src=["\']' . preg_quote($img_url, '/') . '["\'][^>]*>.*?<\/figure>/is',
						'',
						$content
					);
					$new_content = preg_replace(
						'/<img[^>]*src=["\']' . preg_quote($img_url, '/') . '["\'][^>]*\/?>/i',
						'',
						$new_content
					);
					if ($new_content !== $content) {
						wp_update_post(['ID' => $pid, 'post_content' => $new_content]);
					}
					continue;
				}
			}
		}

		// --- 3. Gera placeholder JPG local ---
		$upload_dir = wp_upload_dir();
		$filename = 'placeholder-' . $pid . '.jpg';
		$filepath = $upload_dir['path'] . '/' . $filename;

		$img = imagecreatetruecolor(640, 400);
		$bg = imagecolorallocate($img, 0xF5, 0xF0, 0xE8);
		$fg = imagecolorallocate($img, 0x6D, 0x59, 0x40);
		$accent = imagecolorallocate($img, 0xE0, 0xD5, 0xC3);
		imagefill($img, 0, 0, $bg);

		// Faixas decorativas
		imagefilledrectangle($img, 80, 150, 560, 170, $accent);
		imagefilledrectangle($img, 180, 190, 460, 206, $accent);

		// Círculo com iniciais
		$cx = 320; $cy = 90;
		imagefilledellipse($img, $cx, $cy, 80, 80, $fg);
		$text = 'IB';
		$black = imagecolorallocate($img, 0xFC, 0xFA, 0xF5);
		imagestring($img, 5, $cx - 12, $cy - 8, $text, $black);

		imagejpeg($img, $filepath, 80);
		imagedestroy($img);

		$wp_filetype = wp_check_filetype($filename, null);
		$attachment = [
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name($filename),
			'post_content'   => '',
			'post_status'    => 'inherit',
		];
		$attach_id = wp_insert_attachment($attachment, $filepath, $pid);
		$attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
		wp_update_attachment_metadata($attach_id, $attach_data);
		set_post_thumbnail($pid, $attach_id);
		$placeholder_downloaded++;
		echo "  Placeholder JPG: {$post->post_title}\n";
	}
}

echo "\n---\n";
echo "Duplicatas removidas: {$duplicates_removed}\n";
echo "Thumbnails do conteúdo: {$thumb_from_content}\n";
echo "Placeholders baixados: {$placeholder_downloaded}\n";
