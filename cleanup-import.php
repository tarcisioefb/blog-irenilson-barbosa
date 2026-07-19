<?php
/**
 * Limpa posts importados que não se encaixam no perfil editorial.
 * Mantém apenas 12 posts selecionados + cria exemplares novos.
 *
 * Uso: wp eval-file cleanup-import.php
 */

$keep_ids = [14, 15, 16, 17, 22, 27, 35, 44, 48, 51, 63, 64];

// Move all other posts to trash
$all = get_posts([
    'post_type'      => ['post', 'publicacao', 'livro', 'material'],
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
]);

$trashed = 0;
foreach ($all as $pid) {
    if (! in_array($pid, $keep_ids)) {
        wp_trash_post($pid);
        $trashed++;
    }
}
echo "Posts movidos para lixo: {$trashed}\n";

// Ensure kept posts have correct category
$cat_map = [
    14 => 'filosofia',
    15 => 'educacao',
    16 => 'politica',
    17 => 'cotidiano',
    22 => 'filosofia',
    27 => 'educacao',
    35 => 'cultura',
    44 => 'politica',
    48 => 'politica',
    51 => 'cultura',
    63 => 'cultura',
    64 => 'filosofia',
];

foreach ($cat_map as $pid => $cat_slug) {
    $cat = get_term_by('slug', $cat_slug, 'category');
    if ($cat) {
        wp_set_post_categories($pid, [$cat->term_id]);
    }
}
echo "Categorias reatribuídas para posts mantidos.\n";

// Create example posts for publicações
echo "\n--- Criando exemplos de Publicações ---\n";
$pub_examples = [
    [
        'title' => 'Subjetividade e Formação Docente: Notas sobre uma Epistemologia da Prática',
        'year'  => 2024,
        'type'  => 'artigo-periodico',
        'cat'   => 'Periódico: Revista Brasileira de Educação',
    ],
    [
        'title' => 'Currículo e Diferença: Por uma Pedagogia dos Encontros',
        'year'  => 2023,
        'type'  => 'capitulo-livro',
        'cat'   => 'In: SILVA, A. L. (Org.). Currículo e Contemporaneidade. Editora CRV.',
    ],
    [
        'title' => 'O Lugar da Teoria Crítica na Formação de Professores no Brasil',
        'year'  => 2025,
        'type'  => 'artigo-periodico',
        'cat'   => 'Periódico: Educação e Sociedade',
    ],
];

foreach ($pub_examples as $ex) {
    $pid = wp_insert_post([
        'post_title'   => $ex['title'],
        'post_content' => "<!-- wp:paragraph --><p>Resumo: Este trabalho investiga as interfaces entre {$ex['title']}.</p><!-- /wp:paragraph -->",
        'post_status'  => 'publish',
        'post_type'    => 'publicacao',
        'post_author'  => 2,
    ]);
    if (! is_wp_error($pid)) {
        $term = term_exists($ex['type'], 'tipo-de-publicacao');
        if ($term) {
            wp_set_post_terms($pid, [(int)$term['term_id']], 'tipo-de-publicacao');
        }
        update_post_meta($pid, 'ano_publicacao', $ex['year']);
        echo "  Criado: {$ex['title']}\n";
    }
}

// Create example for livros
echo "\n--- Criando exemplos de Livros ---\n";
$livro_id = wp_insert_post([
    'post_title'   => 'O Homem que não Sabia ser Santo',
    'post_content' => "<!-- wp:paragraph --><p>Há livros que nascem para inquietar. Outros, para provocar espanto, reflexão e silêncio. Esta obra convida o leitor a atravessar zonas sensíveis da existência, entre humanidade, desejo, contradição e busca de sentido.</p><!-- /wp:paragraph -->",
    'post_status'  => 'publish',
    'post_type'    => 'livro',
    'post_author'  => 2,
]);
if (! is_wp_error($livro_id)) {
    $term = term_exists('autor', 'participacao');
    if ($term) {
        wp_set_post_terms($livro_id, [(int)$term['term_id']], 'participacao');
    }
    update_post_meta($livro_id, 'ano', 2021);
    update_post_meta($livro_id, 'editora', 'Editora Independente');
    update_post_meta($livro_id, 'isbn', '978-65-99117-77-6');
    update_post_meta($livro_id, 'link_amazon', 'https://www.amazon.com.br/HOMEM-QUE-NAO-SABIA-SANTO/dp/6599117775');
    echo "  Criado: O Homem que não Sabia ser Santo\n";
}

// Create example material
echo "\n--- Criando exemplo de Material ---\n";
$mat_id = wp_insert_post([
    'post_title'   => 'Plano de Ensino — Filosofia da Educação (2025.1)',
    'post_content' => "<!-- wp:paragraph --><p>Plano de ensino da disciplina Filosofia da Educação, com cronograma, bibliografia e critérios de avaliação.</p><!-- /wp:paragraph -->",
    'post_status'  => 'publish',
    'post_type'    => 'material',
    'post_author'  => 2,
]);
if (! is_wp_error($mat_id)) {
    $term = term_exists('plano-ensino', 'tipo-de-material');
    if ($term) {
        wp_set_post_terms($mat_id, [(int)$term['term_id']], 'tipo-de-material');
    }
    update_post_meta($mat_id, 'ano', 2025);
    echo "  Criado: Plano de Ensino — Filosofia da Educação\n";
}

echo "\n✓ Pronto!\n";
