<?php
/**
 * Irenilson Barbosa v2 — setup do tema.
 */

defined('ABSPATH') || exit;

define('IRENILSON_VER', '2.0.0');

require get_template_directory() . '/inc/template-tags.php';
if ( is_admin() ) { require get_template_directory() . '/inc/admin-settings.php'; }

add_action('after_setup_theme', function () {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
	add_theme_support('custom-logo');
	add_theme_support('responsive-embeds');

	register_nav_menus([
		'primary' => 'Menu principal',
	]);

	add_image_size('ib-card', 640, 400, true);
	add_image_size('ib-thumb', 220, 150, true);
});

// Fontes do Google
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'irenilson-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Literata:ital,opsz,wght@0,7..72,300;0,7..72,400;0,7..72,500;0,7..72,600;0,7..72,700;1,7..72,400;1,7..72,500&display=swap',
		[],
		IRENILSON_VER
	);
});

// CSS + JS
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('irenilson', get_template_directory_uri() . '/assets/ib.css', [], IRENILSON_VER);
	wp_enqueue_script('irenilson', get_template_directory_uri() . '/assets/ib.js', [], IRENILSON_VER, true);
	if (is_singular() && comments_open()) {
		wp_enqueue_script('comment-reply');
	}
});

// Data padrão Brasil
add_filter('option_date_format', function () { return 'j \d\e F \d\e Y'; });
