<?php
/**
 * Irenilson Barbosa v2 — setup do tema.
 */

defined('ABSPATH') || exit;

define('IRENILSON_VER', '2.0.0');

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/admin-settings.php';

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

// Fontes (configuráveis via Central do Site)
add_action('wp_enqueue_scripts', function () {
	$heading = ib_opt('font_heading') ?: 'Literata';
	$body    = ib_opt('font_body') ?: 'Inter';
	$families = [];
	if ($heading !== 'System') {
		$h = str_replace('+', ' ', $heading);
		$is_display = in_array($heading, ['Red+Hat+Display', 'Fraunces', 'Epilogue', 'Playfair+Display'], true);
		$weights = $is_display ? ':wght@400;500;600;700;800;900' : ':ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500';
		$families[] = $h . $weights;
	}
	if ($body !== 'System') {
		$b = str_replace('+', ' ', $body);
		$families[] = $b . ':wght@400;500;600';
	}
	if ($families) {
		wp_enqueue_style('ib-fonts', 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $families) . '&display=swap', [], IRENILSON_VER);
	}
});

// Injeta variáveis CSS das fontes escolhidas
add_action('wp_head', function () {
	$heading = ib_opt('font_heading') ?: 'Literata';
	$body    = ib_opt('font_body') ?: 'Inter';
	$h_val = $heading !== 'System' ? '"' . str_replace('+', ' ', $heading) . '",Georgia,serif' : 'Georgia,"Iowan Old Style","Times New Roman",serif';
	$b_val = $body !== 'System' ? '"' . str_replace('+', ' ', $body) . '",system-ui,sans-serif' : 'system-ui,-apple-system,"Segoe UI",Roboto,sans-serif';
	echo '<style id="ib-fonts-css">:root{--serif:' . esc_attr($h_val) . ';--sans:' . esc_attr($b_val) . '}</style>';
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
