<?php
/**
 * Plugin Name: Irenilson Barbosa Core
 * Plugin URI:  https://irenilsonbarbosa.com.br
 * Description: Gerencia CPTs, SEO, LGPD, TTS, newsletter e segurança do portal editorial. Desenvolvido por Zucatech (zucatech.com).
 * Version:     1.1.0
 * Author:      Zucatech
 * Author URI:  https://zucatech.com
 * Text Domain: irenilson-barbosa-core
 */

defined('ABSPATH') || exit;

define('IRENILSON_CORE_VERSION', '1.1.0');
define('IRENILSON_CORE_PATH', plugin_dir_path(__FILE__));

/**
 * Autoload de classes.
 */
spl_autoload_register(function ($class) {
	$prefix = 'IrenilsonBarbosa\\Core\\';
	$base   = IRENILSON_CORE_PATH . 'includes/';

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
	if ($action !== 'plugin_information' || $slug !== 'irenilson-barbosa-core') return $result;
	$readme = IRENILSON_CORE_PATH . 'readme.txt';
	if (!file_exists($readme)) return $result;

	$content = file_get_contents($readme);
	preg_match('/^=== (.+?) ===/m', $content, $name);
	preg_match('/^Stable tag: (.+)/m', $content, $ver);
	preg_match('/^Contributors: (.+)/m', $content, $contrib);
	preg_match('/^== Description ==\n(.+?)(?=\n== (Installation|Changelog) )/ms', $content, $desc);
	preg_match('/^== Installation ==\n(.+?)(?=\n== (Custom|Description|Changelog|Screenshots|Upgrade|Frequently|Authors|Contributors) )/ms', $content, $install);
	preg_match('/^== Changelog ==\n(.+?)$/ms', $content, $changelog);

	return (object) [
		'name'            => $name[1] ?? 'Irenilson Barbosa Core',
		'slug'            => 'irenilson-barbosa-core',
		'version'         => $ver[1] ?? IRENILSON_CORE_VERSION,
		'author'          => '<a href="https://zucatech.com">Zucatech</a>',
		'requires'        => '6.0',
		'tested'          => '7.0',
		'last_updated'    => gmdate('Y-m-d'),
		'sections'        => [
			'description' => nl2br($desc[1] ?? ''),
			'installation' => nl2br($install[1] ?? ''),
			'changelog'    => nl2br($changelog[1] ?? ''),
		],
		'short_description' => 'Gerencia CPTs, SEO, LGPD, TTS, newsletter e segurança do portal editorial.',
		'banners'         => [],
	];
}, 10, 3);

add_filter('plugin_row_meta', function ($meta, $file) {
	if ($file !== plugin_basename(IRENILSON_CORE_PATH . 'irenilson-barbosa-core.php')) return $meta;
	$meta[] = '<a href="' . self_admin_url('plugin-install.php?tab=plugin-information&plugin=irenilson-barbosa-core&TB_iframe=true&width=600&height=550') . '" class="thickbox open-plugin-details-modal" aria-label="Ver detalhes">Ver detalhes</a>';
	return $meta;
}, 10, 2);
