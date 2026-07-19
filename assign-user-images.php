<?php
/**
 * 1. Cria usuário Irenilson Barbosa
 * 2. Atribui todos os posts a ele
 * 3. Baixa imagens do conteúdo e define como thumbnail
 *
 * Uso: wp eval-file assign-user-images.php
 */

// ---- 1. CRIAR USUÁRIO ----
$user_id = username_exists('irenilson');
if (! $user_id) {
    $user_id = wp_insert_user([
        'user_login'   => 'irenilson',
        'user_pass'    => wp_generate_password(24),
        'user_email'   => 'irenilson@irenilsonbarbosa.com.br',
        'display_name' => 'Irenilson Barbosa',
        'first_name'   => 'Irenilson',
        'last_name'    => 'Barbosa',
        'role'         => 'author',
        'description'  => 'Professor universitário, escritor e pesquisador. Doutor em Educação pela UFBA.',
    ]);

    if (is_wp_error($user_id)) {
        echo "ERRO ao criar usuário: {$user_id->get_error_message()}\n";
        exit(1);
    }
    echo "Usuário criado: ID {$user_id} (irenilson)\n";
} else {
    echo "Usuário já existe: ID {$user_id} (irenilson)\n";
    // Ensure role is author
    $user = new WP_User($user_id);
    $user->set_role('author');
}

// ---- 2. ATRIBUIR TODOS OS POSTS AO NOVO USUÁRIO ----
$post_types = ['post', 'publicacao', 'livro', 'material'];
$total_updated = 0;

foreach ($post_types as $pt) {
    $posts = get_posts([
        'post_type'      => $pt,
        'posts_per_page' => -1,
        'post_status'    => 'any',
        'fields'         => 'ids',
    ]);

    foreach ($posts as $post_id) {
        wp_update_post([
            'ID'          => $post_id,
            'post_author' => $user_id,
        ]);
        $total_updated++;
    }
    echo "  {$pt}: " . count($posts) . " posts atualizados\n";
}
echo "Total de posts reatribuídos: {$total_updated}\n";

// ---- 3. BAIXAR IMAGENS E DEFINIR COMO THUMBNAIL ----
echo "\n--- Processando imagens destacadas ---\n";

$all_posts = get_posts([
    'post_type'      => $post_types,
    'posts_per_page' => -1,
    'post_status'    => 'any',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$images_set = 0;
$images_fail = 0;
$already_have = 0;

foreach ($all_posts as $post) {
    // Skip if already has a thumbnail
    if (has_post_thumbnail($post->ID)) {
        $already_have++;
        continue;
    }

    // Find first image in content
    $content = $post->post_content;
    if (! preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches)) {
        continue;
    }

    $image_url = $matches[1];

    // Skip placeholder icons, tracking pixels, etc.
    if (preg_match('/(icon|avatar|pixel|blogger\.com\/img\/blogger)/i', $image_url)) {
        continue;
    }

    // Skip if it's not a real image URL (data URIs)
    if (strpos($image_url, 'data:') === 0) {
        continue;
    }

    // Ensure URL is absolute
    if (strpos($image_url, 'http') !== 0) {
        continue;
    }

    // Download and sideload
    $attachment_id = media_sideload_image($image_url, $post->ID, null, 'id');

    if (is_wp_error($attachment_id)) {
        $images_fail++;
        if ($images_fail <= 5) {
            echo "  Falha: {$image_url} — {$attachment_id->get_error_message()}\n";
        }
        continue;
    }

    set_post_thumbnail($post->ID, $attachment_id);
    $images_set++;

    if ($images_set % 25 === 0) {
        echo "  Imagens definidas: {$images_set}\n";
    }
}

echo "\n---\n";
echo "Thumbnails definidas: {$images_set}\n";
echo "Já possuíam: {$already_have}\n";
echo "Falhas: {$images_fail}\n";
echo "Total de posts: " . count($all_posts) . "\n";
