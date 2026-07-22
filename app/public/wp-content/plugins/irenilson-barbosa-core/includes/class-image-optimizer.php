<?php
namespace IrenilsonBarbosa\Core;

class ImageOptimizer {
	public static function init() {
		add_filter('wp_generate_attachment_metadata', [__CLASS__, 'generate_on_upload'], 10, 3);
		add_filter('wp_get_attachment_image_attributes', [__CLASS__, 'add_format_hint'], 10, 3);
		add_filter('wp_img_tag_add_loading_attr', [__CLASS__, 'maybe_skip_lazy'], 10, 3);
		add_filter('litespeed_media_excludes', [__CLASS__, 'litespeed_nolazy']);
	}

	public static function maybe_skip_lazy($value, $img_tag, $context) {
		if (strpos($img_tag, 'fetchpriority="high"') !== false) {
			return false;
		}
		return $value;
	}

	public static function generate_on_upload($metadata, $attachment_id, $context) {
		if (!is_array($metadata) || empty($metadata['file'])) return $metadata;
		static $processing = [];
		if (isset($processing[$attachment_id])) return $metadata;
		$processing[$attachment_id] = true;

		if (defined('DOING_AJAX') && DOING_AJAX) return $metadata;
		if (did_action('wp') && !is_admin()) return $metadata;

		$ext = strtolower(pathinfo($metadata['file'], PATHINFO_EXTENSION));
		if ($ext === 'avif' && empty($metadata['sizes'])) {
			$metadata = self::generate_avif_sizes($metadata, $attachment_id);
		}

		$uploads = wp_upload_dir();
		$base = $uploads['basedir'] . '/' . dirname($metadata['file']);

		$sizes = $metadata['sizes'] ?? [];
		$sizes['full'] = ['file' => basename($metadata['file'])];

		foreach ($sizes as $size) {
			$file = $base . '/' . $size['file'];
			if (!file_exists($file)) continue;

			if (!file_exists($file . '.webp')) self::convert_to($file, $file . '.webp', 'webp');
			if (!file_exists($file . '.avif')) self::convert_to($file, $file . '.avif', 'avif');
		}

		return $metadata;
	}

	private static function generate_avif_sizes($metadata, $attachment_id) {
		$uploads = wp_upload_dir();
		$src = $uploads['basedir'] . '/' . $metadata['file'];
		if (!file_exists($src)) return $metadata;

		$img = @imagecreatefromavif($src);
		if (!$img) return $metadata;

		$w = imagesx($img);
		$h = imagesy($img);
		$metadata['width'] = $w;
		$metadata['height'] = $h;

		$sizes = wp_get_registered_image_subsizes();
		$base_dir = $uploads['basedir'] . '/' . dirname($metadata['file']);
		$new_sizes = [];

		foreach ($sizes as $name => $s) {
			$sw = (int) $s['width'];
			$sh = (int) $s['height'];
			$crop = !empty($s['crop']);
			$dims = image_resize_dimensions($w, $h, $sw, $sh, $crop);
			if (!$dims) continue;

			$dst_w = $dims[4];
			$dst_h = $dims[5];
			$thumb = imagescale($img, $dst_w, $dst_h);
			if (!$thumb) continue;

			$filename = wp_basename($metadata['file'], '.avif') . "-{$sw}x{$sh}.jpg";
			$filepath = $base_dir . '/' . $filename;
			imagejpeg($thumb, $filepath, 85);
			imagedestroy($thumb);

			$new_sizes[$name] = [
				'file'      => $filename,
				'width'     => $dst_w,
				'height'    => $dst_h,
				'mime-type' => 'image/jpeg',
				'filesize'  => file_exists($filepath) ? filesize($filepath) : 0,
			];
			self::convert_to($filepath, $filepath . '.webp', 'webp');
			self::convert_to($filepath, $filepath . '.avif', 'avif');
		}

		imagedestroy($img);
		$metadata['sizes'] = $new_sizes;
		wp_update_attachment_metadata($attachment_id, $metadata);
		return $metadata;
	}

	private static function convert_to($src, $dest, $format) {
		$info = getimagesize($src);
		if (!$info) return;

		$func = $format === 'webp' ? 'imagewebp' : 'imageavif';
		$quality = $format === 'webp' ? 82 : 75;
		$img = null;

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
			case 'image/avif':
				$img = imagecreatefromavif($src);
				break;
			case 'image/webp':
				$img = imagecreatefromwebp($src);
				break;
		}

		if ($img) {
			if ($format === 'jpeg') {
				imagejpeg($img, $dest, 85);
			} else {
				$func($img, $dest, $quality);
			}
			imagedestroy($img);
		}
	}

	public static function cli_thumb_avif($args, $assoc) {
		if (!defined('WP_CLI') || !WP_CLI) return;
		$ids = get_posts([
			'post_type' => 'attachment',
			'post_mime_type' => 'image/avif',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'post_status' => 'inherit',
		]);
		$count = 0;
		foreach ($ids as $id) {
			if (\wp_attachment_is_image($id) && self::regenerate_from_avif($id)) $count++;
		}
		\WP_CLI::success("Regenerated thumbnails for $count AVIF images.");
	}

	private static function regenerate_from_avif($attachment_id) {
		$meta = \wp_get_attachment_metadata($attachment_id);
		if (!$meta || empty($meta['file'])) return false;
		$ext = strtolower(pathinfo($meta['file'], PATHINFO_EXTENSION));
		if ($ext !== 'avif') return false;

		$uploads = \wp_upload_dir();
		$src = $uploads['basedir'] . '/' . $meta['file'];
		if (!file_exists($src)) return false;

		$img = \imagecreatefromavif($src);
		if (!$img) return false;

		$w = (int) $meta['width'];
		$h = (int) $meta['height'];
		$sizes = \wp_get_registered_image_subsizes();
		$new_sizes = [];
		$base_dir = $uploads['basedir'] . '/' . \dirname($meta['file']);

		foreach ($sizes as $name => $s) {
			$sw = (int) $s['width'];
			$sh = (int) $s['height'];
			$crop = !empty($s['crop']);
			$dims = \image_resize_dimensions($w, $h, $sw, $sh, $crop);
			if (!$dims) continue;
			$dst_w = $dims[4];
			$dst_h = $dims[5];
			$thumb = \imagescale($img, $dst_w, $dst_h);
			if (!$thumb) continue;

			$ext = 'jpg';
			$filename = \wp_basename($meta['file'], '.avif') . "-{$sw}x{$sh}.{$ext}";
			$filepath = $base_dir . '/' . $filename;
			\imagejpeg($thumb, $filepath, 85);
			\imagedestroy($thumb);

			$new_sizes[$name] = [
				'file' => $filename,
				'width' => $dst_w,
				'height' => $dst_h,
				'mime-type' => 'image/jpeg',
			];
			self::convert_to($filepath, $filepath . '.webp', 'webp');
			self::convert_to($filepath, $filepath . '.avif', 'avif');
		}

		\imagedestroy($img);
		$meta['sizes'] = $new_sizes;
		\wp_update_attachment_metadata($attachment_id, $meta);
		return true;
	}

	public static function add_format_hint($attr, $attachment, $size) {
		if (empty($attr['fetchpriority']) || $attr['fetchpriority'] !== 'high') {
			$attr['loading'] = 'lazy';
		}
		return $attr;
	}

	public static function litespeed_nolazy($excludes) {
		$excludes[] = 'fetchpriority=high';
		return $excludes;
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
