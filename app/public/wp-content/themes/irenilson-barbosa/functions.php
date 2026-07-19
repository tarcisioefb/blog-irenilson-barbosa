<?php
/**
 * Irenilson Barbosa — functions and setup.
 */

define('IRENILSON_BARBOSA_VERSION', '0.1.0');

/**
 * Theme setup.
 */
add_action('after_setup_theme', function () {
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo', [
		'height'      => 80,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	]);

	register_nav_menus([
		'primary' => __('Primary Menu', 'irenilson-barbosa'),
	]);
});

/**
 * Enqueue Google Fonts — Literata (serif) + Inter (sans).
 */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'irenilson-barbosa-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Literata:ital,opsz,wght@0,7..72,300;0,7..72,400;0,7..72,500;0,7..72,600;0,7..72,700;1,7..72,400;1,7..72,500&display=swap',
		[],
		IRENILSON_BARBOSA_VERSION
	);
});

/**
 * Editor styles.
 */
add_action('after_setup_theme', function () {
	add_editor_style('assets/css/editor.css');
});

/**
 * Remove default WP styles that conflict with block theme.
 */
add_action('wp_enqueue_scripts', function () {
	wp_dequeue_style('wp-block-library-theme');
}, 20);
