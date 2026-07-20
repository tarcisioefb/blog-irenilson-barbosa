<?php
namespace IrenilsonBarbosa\Core;

class ImageOptimizer {
	public static function init() {
		add_filter('wp_generate_attachment_metadata', [__CLASS__, 'generate_on_upload'], 10, 3);
		add_filter('wp_get_attachment_image_attributes', [__CLASS__, 'add_format_hint'], 10, 3);
	}

	public static function generate_on_upload($metadata, $attachment_id, $context) {
		if (!is_array($metadata) || empty($metadata['file'])) return $metadata;

		$uploads = wp_upload_dir();
		$base = $uploads['basedir'] . '/' . dirname($metadata['file']);

		$sizes = $metadata['sizes'] ?? [];
		$sizes['full'] = ['file' => basename($metadata['file'])];

		foreach ($sizes as $size) {
			$file = $base . '/' . $size['file'];
			if (!file_exists($file)) continue;

			$webp = $file . '.webp';
			$avif = $file . '.avif';

			if (!file_exists($webp)) self::convert_to($file, $webp, 'webp');
			if (!file_exists($avif)) self::convert_to($file, $avif, 'avif');
		}

		return $metadata;
	}

	private static function convert_to($src, $dest, $format) {
		$info = getimagesize($src);
		if (!$info) return;

		$func = $format === 'webp' ? 'imagewebp' : 'imageavif';
		$quality = $format === 'webp' ? 82 : 75;

		switch ($info['mime']) {
			case 'image/jpeg':
				$img = imagecreatefromjpeg($src);
				break;
			case 'image/png':
				$img = imagecreatefrompng($src);
				imagepalettetotruecolor($img);
				imagealphablending($img, true);
				imagesavealpha($img, true);
				break;
			default:
				return;
		}

		if ($img) {
			$func($img, $dest, $quality);
			imagedestroy($img);
		}
	}

	public static function add_format_hint($attr, $attachment, $size) {
		$attr['loading'] = 'lazy';
		return $attr;
	}

	public static function cli_convert($args, $assoc) {
		if (!defined('WP_CLI') || !WP_CLI) return;

		$format = $assoc['format'] ?? 'webp';
		$force  = isset($assoc['force']);
		$ids = get_posts([
			'post_type' => 'attachment',
			'post_mime_type' => ['image/jpeg', 'image/png'],
			'posts_per_page' => -1,
			'fields' => 'ids',
			'post_status' => 'inherit',
		]);

		$ext = $format === 'webp' ? '.webp' : '.avif';
		$count = 0;

		foreach ($ids as $id) {
			$meta = wp_get_attachment_metadata($id);
			if (!$meta || empty($meta['file'])) continue;

			$uploads = wp_upload_dir();
			$base = $uploads['basedir'] . '/' . dirname($meta['file']);
			$sizes = $meta['sizes'] ?? [];
			$sizes['full'] = ['file' => basename($meta['file'])];

			foreach ($sizes as $size) {
				$file = $base . '/' . $size['file'];
				if (!file_exists($file)) continue;
				$dest = $file . $ext;
				if (!$force && file_exists($dest)) continue;
				self::convert_to($file, $dest, $format);
				$count++;
			}
		}

		\WP_CLI::success("Converted $count images to $format.");
	}
}
