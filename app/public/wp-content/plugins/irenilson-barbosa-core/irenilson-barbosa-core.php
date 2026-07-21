<?php
/**
 * Plugin Name: Irenilson Barbosa Core
 * Plugin URI:  https://irenilsonbarbosa.com.br
 * Description: Funcionalidades do portal editorial — CPTs, taxonomias, metadados e componentes. Desenvolvido por Zucatech (zucatech.com).
 * Version:     1.0.0
 * Author:      Zucatech
 * Author URI:  https://zucatech.com
 * Text Domain: irenilson-barbosa-core
 */

defined('ABSPATH') || exit;

define('IRENILSON_CORE_VERSION', '1.0.1');
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
});

if (defined('WP_CLI') && WP_CLI) {
	\WP_CLI::add_command('ib-convert', ['\IrenilsonBarbosa\Core\ImageOptimizer', 'cli_convert']);
}
