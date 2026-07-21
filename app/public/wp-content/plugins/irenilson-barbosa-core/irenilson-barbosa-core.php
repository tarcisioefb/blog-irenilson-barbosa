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

// Direct includes instead of autoloader (avoids memory issue on search)
require_once IRENILSON_CORE_PATH . 'includes/class-setup.php';
require_once IRENILSON_CORE_PATH . 'includes/class-magazine.php';
require_once IRENILSON_CORE_PATH . 'includes/class-reading-time.php';
require_once IRENILSON_CORE_PATH . 'includes/class-related-posts.php';
require_once IRENILSON_CORE_PATH . 'includes/class-author-box.php';
require_once IRENILSON_CORE_PATH . 'includes/class-admin-settings.php';
require_once IRENILSON_CORE_PATH . 'includes/class-seo.php';
require_once IRENILSON_CORE_PATH . 'includes/class-tts.php';
require_once IRENILSON_CORE_PATH . 'includes/class-image-optimizer.php';

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
