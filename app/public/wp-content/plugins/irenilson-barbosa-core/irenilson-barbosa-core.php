<?php
/**
 * Plugin Name: Zucatech Blog Core
 * Plugin URI:  https://zucatech.com
 * Description: Gerencia CPTs, SEO, LGPD, TTS, newsletter e segurança do portal editorial. Solução white-label para blogs.
 * Version:     1.1.0
 * Author:      Zucatech
 * Author URI:  https://zucatech.com
 * Text Domain: irenilson-barbosa-core
 */

defined('ABSPATH') || exit;

define('ZUCA_CORE_VERSION', '1.1.0');
define('ZUCA_CORE_PATH', plugin_dir_path(__FILE__));

/**
 * Autoload de classes.
 */
spl_autoload_register(function ($class) {
	$prefix = 'IrenilsonBarbosa\\Core\\';
	$base   = ZUCA_CORE_PATH . 'includes/';

	if (strpos($class, $prefix) !== 0) {
		return;
	}

	$relative_class = substr($class, strlen($prefix));
	$class_kebab    = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $relative_class));
	$file           = $base . 'class-' . $class_kebab . '.php';

	if (file_exists($file)) {
		require_once $file;
	}
});

/**
 * Bootstrap.
 */
add_action('plugins_loaded', function () {
	\IrenilsonBarbosa\Core\Setup::init();
	\IrenilsonBarbosa\Core\Setup::init_metaboxes();
	\IrenilsonBarbosa\Core\Magazine::init();
	\IrenilsonBarbosa\Core\ReadingTime::init();
	\IrenilsonBarbosa\Core\RelatedPosts::init();
	\IrenilsonBarbosa\Core\AuthorBox::init();
	\IrenilsonBarbosa\Core\AdminSettings::init();
	\IrenilsonBarbosa\Core\SEO::init();
	\IrenilsonBarbosa\Core\TTS::init();
	\IrenilsonBarbosa\Core\ImageOptimizer::init();
	\IrenilsonBarbosa\Core\AuditLog::init();
	\IrenilsonBarbosa\Core\Security::init();
	\IrenilsonBarbosa\Core\TableOfContents::init();
});

if (defined('WP_CLI') && WP_CLI) {
	\WP_CLI::add_command('ib-convert', ['\IrenilsonBarbosa\Core\ImageOptimizer', 'cli_convert']);
	\WP_CLI::add_command('ib-thumb-avif', ['\IrenilsonBarbosa\Core\ImageOptimizer', 'cli_thumb_avif']);
}

add_filter('plugins_api', function ($result, $action, $args) {
	$slug = is_object($args) ? ($args->slug ?? '') : ($args['slug'] ?? '');
	if ($action !== 'plugin_information' || $slug !== 'zucatech-blog-core') return $result;
	$readme = ZUCA_CORE_PATH . 'readme.txt';
	if (!file_exists($readme)) return $result;

	$content = file_get_contents($readme);
	preg_match('/^=== (.+?) ===/m', $content, $name);
	preg_match('/^Stable tag: (.+)/m', $content, $ver);

	$sections = [];
	$parts = preg_split('/\n(?=== )/', $content);
	foreach ($parts as $part) {
		if (preg_match('/^== (.+?) ==\n(.+)/s', $part, $m)) {
			$key = sanitize_title($m[1]);
			$sections[$key] = readme_to_html($m[2]);
		}
	}

	return (object) [
		'name'            => $name[1] ?? 'Zucatech Blog Core',
		'slug'            => 'zucatech-blog-core',
		'version'         => $ver[1] ?? ZUCA_CORE_VERSION,
		'author'          => '<a href="https://zucatech.com">Zucatech</a>',
		'requires'        => '6.0',
		'tested'          => '7.0.2',
		'last_updated'    => gmdate('Y-m-d'),
		'sections'        => $sections,
		'short_description' => 'Gerencia CPTs, SEO, LGPD, TTS, newsletter e segurança do portal editorial.',
		'banners'         => [],
	];
}, 10, 3);

function readme_to_html($text) {
	$text = preg_replace('/^= (.+?) =$/m', '<h4>$1</h4>', $text);
	$text = preg_replace('/^\* (.+)$/m', '<li>$1</li>', $text);
	$text = preg_replace('/(<li>.*<\/li>)/s', '<ul>$1</ul>', trim($text));
	$text = preg_replace('/<\/ul>\n<ul>/', '', $text);
	$text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
	$lines = explode("\n", $text);
	$html = '';
	$in_list = false;
	foreach ($lines as $line) {
		if (strpos($line, '<h4>') === 0 || strpos($line, '<ul>') === 0 || strpos($line, '</ul>') === 0) {
			if ($in_list) { $html .= "</ul>\n"; $in_list = false; }
			$html .= $line . "\n";
			continue;
		}
		if (strpos($line, '<li>') === 0) {
			if (!$in_list) { $html .= "<ul>\n"; $in_list = true; }
			$html .= $line . "\n";
			continue;
		}
		if ($in_list) { $html .= "</ul>\n"; $in_list = false; }
		$line = trim($line);
		if ($line === '') continue;
		$html .= '<p>' . $line . "</p>\n";
	}
	if ($in_list) $html .= "</ul>\n";
	return $html;
}

add_filter('plugin_row_meta', function ($meta, $file) {
	if ($file !== plugin_basename(ZUCA_CORE_PATH . 'irenilson-barbosa-core.php')) return $meta;
	$meta[] = '<a href="' . self_admin_url('plugin-install.php?tab=plugin-information&plugin=zucatech-blog-core&TB_iframe=true&width=600&height=550') . '" class="thickbox open-plugin-details-modal" aria-label="Ver detalhes">Ver detalhes</a>';
	return $meta;
}, 10, 2);
