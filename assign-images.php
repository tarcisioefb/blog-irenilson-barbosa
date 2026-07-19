<?php
/**
 * Continua baixando imagens para posts sem thumbnail.
 * Uso: wp eval-file assign-user-images.php
 */

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$post_types = ['post', 'publicacao', 'livro', 'material'];
$all_posts = get_posts([
    'post_type'      => $post_types,
    'posts_per_page' => -1,
    'post_status'    => 'any',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => [
        [
            'key'     => '_thumbnail_id',
            'compare' => 'NOT EXISTS',
        ],
    ],
]);

echo "Posts sem thumbnail: " . count($all_posts) . "\n";

$images_set = 0;
$images_fail = 0;

foreach ($all_posts as $post) {
    $content = $post->post_content;
    if (! preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches)) {
        continue;
    }

    $image_url = $matches[1];

    if (preg_match('/(icon|avatar|pixel|blogger\.com\/img\/blogger|google\.com\/mail)/i', $image_url)) {
        continue;
    }
    if (strpos($image_url, 'data:') === 0 || strpos($image_url, 'http') !== 0) {
        continue;
    }

    // Clean Blogger URL parameters
    $image_url = preg_replace('/=w\d+(-h\d+)?/', '', $image_url);

    $attachment_id = media_sideload_image($image_url, $post->ID, null, 'id');

    if (is_wp_error($attachment_id)) {
        $images_fail++;
        if ($images_fail <= 10) {
            echo "  Falha [{$images_fail}]: " . substr($image_url, 0, 80) . " — {$attachment_id->get_error_message()}\n";
        }
        continue;
    }

    set_post_thumbnail($post->ID, $attachment_id);
    $images_set++;

    if ($images_set % 20 === 0) {
        echo "  Imagens definidas: {$images_set}\n";
    }
}

echo "\n---\n";
echo "Thumbnails definidas: {$images_set}\n";
echo "Falhas: {$images_fail}\n";
