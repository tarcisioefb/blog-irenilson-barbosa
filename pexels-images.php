<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

define('PEXELS_KEY', 'TiVST2U8aLJeLG1h4gWeTcjAzwk9d3zWMXRYdiBXzu847bwOa5xSetRw');

$posts = get_posts([
	'post_type'      => ['post', 'publicacao', 'livro', 'material'],
	'posts_per_page' => -1,
	'post_status'    => 'any',
]);

echo "Total: " . count($posts) . "\n";

$updated = 0;

foreach ($posts as $post) {
	if (! has_post_thumbnail($post->ID)) continue;
	$thumb_id = get_post_thumbnail_id($post->ID);
	$thumb_file = get_attached_file($thumb_id);
	if ($thumb_file && strpos(basename($thumb_file), 'placeholder-') === 0) {
		echo "  {$post->post_title}\n";
		$query = 'abstract';
		$title = mb_strtolower($post->post_title);
		if (strpos($title, 'educação') !== false || strpos($title, 'ensino') !== false || strpos($title, 'professor') !== false) $query = 'education';
		elseif (strpos($title, 'filosofia') !== false || strpos($title, 'teologia') !== false || strpos($title, 'pensamento') !== false) $query = 'philosophy';
		elseif (strpos($title, 'política') !== false || strpos($title, 'democracia') !== false || strpos($title, 'golpe') !== false || strpos($title, 'capitalismo') !== false) $query = 'politics';
		elseif (strpos($title, 'poesia') !== false || strpos($title, 'cultura') !== false || strpos($title, 'natal') !== false || strpos($title, 'inquisição') !== false) $query = 'art culture';
		elseif (strpos($title, 'silêncio') !== false || strpos($title, 'escrita') !== false) $query = 'writing';
		elseif (strpos($title, 'rua') !== false || strpos($title, 'cotidiano') !== false || strpos($title, 'errante') !== false) $query = 'street city';
		elseif (strpos($title, 'capoeira') !== false) $query = 'capoeira';
		elseif (strpos($title, 'livro') !== false || strpos($title, 'santo') !== false || $post->post_type === 'livro') $query = 'book';
		elseif (strpos($title, 'plano de ensino') !== false) $query = 'classroom';
		elseif ($post->post_type === 'publicacao') $query = 'academic research';

		$url = 'https://api.pexels.com/v1/search?query=' . urlencode($query) . '&per_page=3&orientation=landscape';
		$resp = wp_remote_get($url, ['headers' => ['Authorization' => PEXELS_KEY], 'timeout' => 15]);
		if (is_wp_error($resp)) { echo "    API error\n"; continue; }
		$body = json_decode(wp_remote_retrieve_body($resp), true);
		if (empty($body['photos'])) { echo "    No results\n"; continue; }
		$image_url = $body['photos'][0]['src']['large'];

		wp_delete_attachment($thumb_id, true);
		$new_id = media_sideload_image($image_url, $post->ID, null, 'id');
		if (is_wp_error($new_id)) { echo "    Download fail: {$new_id->get_error_message()}\n"; continue; }
		set_post_thumbnail($post->ID, $new_id);
		$updated++;
		echo "    ✓ {$query}\n";
	}
}

echo "\nAtualizados: {$updated}\n";
