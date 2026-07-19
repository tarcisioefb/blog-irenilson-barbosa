<?php
/**
 * Importa posts do JSON gerado pelo import-blogger.py.
 * Uso: wp eval-file import-wp.php
 */

$json_path = __DIR__ . '/blogger-export.json';
if (! file_exists($json_path)) {
    echo "ERRO: JSON não encontrado em $json_path\n";
    exit(1);
}

$data = json_decode(file_get_contents($json_path), true);
$posts = $data['posts'] ?? [];

if (empty($posts)) {
    echo "Nenhum post para importar.\n";
    exit(0);
}

echo "Importando " . count($posts) . " posts...\n";

// Create taxonomy terms if they don't exist
function ensure_term($taxonomy, $term_slug, $term_name) {
    if (! term_exists($term_slug, $taxonomy)) {
        wp_insert_term($term_name, $taxonomy, ['slug' => $term_slug]);
        echo "  Criado termo: {$taxonomy} → {$term_name}\n";
    }
}

// Ensure category exists for posts
$categories = [
    'filosofia' => 'Filosofia',
    'educacao'  => 'Educação',
    'politica'  => 'Política',
    'cultura'   => 'Cultura',
    'cotidiano' => 'Cotidiano',
];
foreach ($categories as $slug => $name) {
    ensure_term('category', $slug, $name);
}

// Ensure taxonomy terms for publicacao
$pub_types = [
    'artigo-periodico' => 'Artigo em Periódico',
    'capitulo-livro'   => 'Capítulo de Livro',
    'trabalho-anais'   => 'Trabalho em Anais',
    'resenha-academica' => 'Resenha Acadêmica',
    'tese-dissertacao' => 'Tese / Dissertação',
    'verbete'          => 'Verbete',
];
foreach ($pub_types as $slug => $name) {
    if (taxonomy_exists('tipo-de-publicacao')) {
        ensure_term('tipo-de-publicacao', $slug, $name);
    }
}

// Ensure taxonomy terms for livro
$part_types = ['autor' => 'Autor', 'organizador' => 'Organizador', 'coautor' => 'Coautor'];
foreach ($part_types as $slug => $name) {
    if (taxonomy_exists('participacao')) {
        ensure_term('participacao', $slug, $name);
    }
}

// Ensure taxonomy terms for material
$mat_types = [
    'plano-ensino' => 'Plano de Ensino',
    'apostila'     => 'Apostila',
    'artigo'       => 'Artigo',
    'slide'        => 'Slide',
    'exercicio'    => 'Exercício',
    'ebook'        => 'E-book',
];
foreach ($mat_types as $slug => $name) {
    if (taxonomy_exists('tipo-de-material')) {
        ensure_term('tipo-de-material', $slug, $name);
    }
}

$imported = 0;
$errors  = 0;

foreach ($posts as $i => $post) {
    $post_type = $post['post_type'] ?? 'post';

    // Prepare date (convert ISO to mysql format)
    $date_str = $post['date'] ?? '';
    $mysql_date = '';
    if ($date_str) {
        $dt = date_create($date_str);
        if ($dt) {
            $mysql_date = $dt->format('Y-m-d H:i:s');
        }
    }

    if (! $mysql_date) {
        $mysql_date = current_time('mysql');
    }

    $post_data = [
        'post_title'    => $post['title'],
        'post_content'  => wp_unslash($post['content']),
        'post_excerpt'  => wp_unslash($post['excerpt'] ?? ''),
        'post_status'   => 'publish',
        'post_type'     => $post_type,
        'post_date'     => $mysql_date,
        'post_author'   => 1,
        'post_name'     => sanitize_title($post['title']),
    ];

    $post_id = wp_insert_post($post_data, true);

    if (is_wp_error($post_id)) {
        echo "  ERRO [$i]: {$post['title']} — {$post_id->get_error_message()}\n";
        $errors++;
        continue;
    }

    // Set category for posts
    if ($post_type === 'post' && ! empty($post['category'])) {
        $cat = get_term_by('slug', $post['category'], 'category');
        if ($cat) {
            wp_set_post_categories($post_id, [$cat->term_id]);
        }
    }

    // Set taxonomy terms for publicacao, livro, material
    $tax_map = [
        'publicacao' => ['tax' => 'tipo-de-publicacao', 'term' => $post['taxonomy_term']],
        'livro'      => ['tax' => 'participacao', 'term' => $post['taxonomy_term']],
        'material'   => ['tax' => 'tipo-de-material', 'term' => $post['taxonomy_term']],
    ];

    if (isset($tax_map[$post_type]) && $tax_map[$post_type]['term']) {
        $term = term_exists($tax_map[$post_type]['term'], $tax_map[$post_type]['tax']);
        if ($term) {
            wp_set_post_terms($post_id, [(int)$term['term_id']], $tax_map[$post_type]['tax'], false);
        }
    }

    // Set meta fields
    if ($post_type === 'publicacao') {
        update_post_meta($post_id, 'ano_publicacao', $post['year']);
        update_post_meta($post_id, 'link_externo', $post['permalink']);
    } elseif ($post_type === 'livro') {
        update_post_meta($post_id, 'ano', $post['year']);
    } elseif ($post_type === 'material') {
        update_post_meta($post_id, 'ano', $post['year']);
    }

    $imported++;

    if ($i % 25 === 0) {
        echo "  Progresso: {$i}/" . count($posts) . "\n";
    }
}

echo "\n---\n";
echo "Importados: {$imported}\n";
echo "Erros: {$errors}\n";
echo "Total: " . count($posts) . "\n";
