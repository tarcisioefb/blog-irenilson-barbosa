<?php
namespace IrenilsonBarbosa\Core;

class Setup {
	public static function init() {
		add_action('init', [__CLASS__, 'register_post_types']);
		add_action('init', [__CLASS__, 'register_taxonomies']);
		add_action('init', [__CLASS__, 'register_meta']);
		add_filter('use_block_editor_for_post_type', [__CLASS__, 'disable_block_editor'], 10, 2);
	}

	public static function disable_block_editor($enabled, $post_type) {
		if ('poiesis' === $post_type) return false;
		return $enabled;
	}

	public static function register_post_types() {
		// Publicações Acadêmicas
		register_post_type('publicacao', [
			'labels' => [
				'name'          => 'Publicações',
				'singular_name' => 'Publicação',
				'menu_name'     => 'Publicações',
				'add_new_item'  => 'Adicionar Publicação',
				'edit_item'     => 'Editar Publicação',
				'view_item'     => 'Ver Publicação',
				'search_items'  => 'Buscar Publicações',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-media-document',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
			'rewrite'      => ['slug' => 'publicacoes'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);

		// Livros
		register_post_type('livro', [
			'labels' => [
				'name'          => 'Livros',
				'singular_name' => 'Livro',
				'menu_name'     => 'Livros',
				'add_new_item'  => 'Adicionar Livro',
				'edit_item'     => 'Editar Livro',
				'view_item'     => 'Ver Livro',
				'search_items'  => 'Buscar Livros',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-book',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
			'rewrite'      => ['slug' => 'livros'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);

		// Poiésis (poemas, criações literárias)
		register_post_type('poiesis', [
			'labels' => [
				'name'          => 'Poiésis',
				'singular_name' => 'Poema',
				'menu_name'     => 'Poiésis',
				'add_new_item'  => 'Adicionar Poema',
				'edit_item'     => 'Editar Poema',
				'view_item'     => 'Ver Poema',
				'search_items'  => 'Buscar Poemas',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-format-quote',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
			'rewrite'      => ['slug' => 'poiesis'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);

		// Materiais
		register_post_type('material', [
			'labels' => [
				'name'          => 'Materiais',
				'singular_name' => 'Material',
				'menu_name'     => 'Materiais',
				'add_new_item'  => 'Adicionar Material',
				'edit_item'     => 'Editar Material',
				'view_item'     => 'Ver Material',
				'search_items'  => 'Buscar Materiais',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-download',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
			'rewrite'      => ['slug' => 'materiais'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);
	}

	public static function register_taxonomies() {
		// Tipo de Publicação (hierárquica)
		register_taxonomy('tipo-de-publicacao', 'publicacao', [
			'labels' => [
				'name'          => 'Tipos de Publicação',
				'singular_name' => 'Tipo de Publicação',
				'menu_name'     => 'Tipos',
				'add_new_item'  => 'Adicionar Tipo',
				'edit_item'     => 'Editar Tipo',
			],
			'hierarchical' => true,
			'rewrite'      => ['slug' => 'tipo'],
			'show_in_rest' => true,
		]);

		// Participação no Livro (hierárquica)
		register_taxonomy('participacao', 'livro', [
			'labels' => [
				'name'          => 'Participações',
				'singular_name' => 'Participação',
				'menu_name'     => 'Participação',
				'add_new_item'  => 'Adicionar Tipo',
				'edit_item'     => 'Editar Tipo',
			],
			'hierarchical' => true,
			'rewrite'      => ['slug' => 'participacao'],
			'show_in_rest' => true,
		]);

		// Tipo de Material (hierárquica)
		register_taxonomy('tipo-de-material', 'material', [
			'labels' => [
				'name'          => 'Tipos de Material',
				'singular_name' => 'Tipo de Material',
				'menu_name'     => 'Tipos',
				'add_new_item'  => 'Adicionar Tipo',
				'edit_item'     => 'Editar Tipo',
			],
			'hierarchical' => true,
			'rewrite'      => ['slug' => 'tipo-material'],
			'show_in_rest' => true,
		]);
	}

	public static function init_metaboxes() {
		add_action('add_meta_boxes', [__CLASS__, 'add_poiesis_metabox']);
		add_action('save_post', [__CLASS__, 'save_poiesis_metabox']);
	}

	public static function add_poiesis_metabox() {
		add_meta_box(
			'poiesis_box',
			'Dados do poema',
			[__CLASS__, 'render_poiesis_metabox'],
			'poiesis',
			'after_title',
			'high'
		);
	}

	public static function render_poiesis_metabox($post) {
		wp_nonce_field('poiesis_save', 'poiesis_nonce');
		$author = get_post_meta($post->ID, 'poiesis_author', true);
		$notas = get_post_meta($post->ID, 'poiesis_notas', true);
		?>
		<p style="margin:0 0 12px">
			<label for="poiesis_author" style="display:block;font-weight:600;margin-bottom:4px">Autor do poema</label>
			<input type="text" id="poiesis_author" name="poiesis_author" value="<?php echo esc_attr($author ?: 'Irenilson Barbosa'); ?>" style="width:100%;padding:8px 10px;font-size:13px">
		</p>
		<p style="margin:0">
			<label for="poiesis_notas" style="display:block;font-weight:600;margin-bottom:4px">Notas / texto explicativo</label>
			<textarea id="poiesis_notas" name="poiesis_notas" style="width:100%;min-height:100px;padding:10px;font-size:13px" placeholder="Dedicatória, introdução, nota do autor..."><?php echo esc_textarea($notas); ?></textarea>
		</p>
		<?php
	}

	public static function save_poiesis_metabox($post_id) {
		if (!isset($_POST['poiesis_nonce']) || !wp_verify_nonce($_POST['poiesis_nonce'], 'poiesis_save')) return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_post', $post_id)) return;

		if (isset($_POST['poiesis_author'])) {
			update_post_meta($post_id, 'poiesis_author', sanitize_text_field($_POST['poiesis_author']));
		}
		if (isset($_POST['poiesis_notas'])) {
			update_post_meta($post_id, 'poiesis_notas', sanitize_textarea_field($_POST['poiesis_notas']));
		}
	}

	public static function register_meta() {
		$meta_fields = [
			'subtitulo'        => ['type' => 'string', 'post_types' => ['post']],
			'tempo_leitura'    => ['type' => 'integer', 'post_types' => ['post']],
			'destaque_tipo'    => ['type' => 'string', 'post_types' => ['post']],
			'ano_publicacao'   => ['type' => 'integer', 'post_types' => ['publicacao']],
			'periodico'        => ['type' => 'string', 'post_types' => ['publicacao']],
			'doi'              => ['type' => 'string', 'post_types' => ['publicacao']],
			'link_externo'     => ['type' => 'string', 'post_types' => ['publicacao']],
			'citacao_abnt'     => ['type' => 'string', 'post_types' => ['publicacao']],
			'isbn'             => ['type' => 'string', 'post_types' => ['livro']],
			'ano'              => ['type' => 'integer', 'post_types' => ['livro', 'material']],
			'editora'          => ['type' => 'string', 'post_types' => ['livro']],
			'sinopse'          => ['type' => 'string', 'post_types' => ['livro']],
			'numero_paginas'   => ['type' => 'integer', 'post_types' => ['livro']],
			'link_amazon'      => ['type' => 'string', 'post_types' => ['livro']],
			'link_marinete'    => ['type' => 'string', 'post_types' => ['livro']],
			'descricao'        => ['type' => 'string', 'post_types' => ['material']],
			'poiesis_notas'    => ['type' => 'string', 'post_types' => ['poiesis']],
			'poiesis_author'   => ['type' => 'string', 'post_types' => ['poiesis']],
		];

		foreach ($meta_fields as $key => $config) {
			foreach ((array) $config['post_types'] as $post_type) {
				register_post_meta($post_type, $key, [
					'show_in_rest' => true,
					'single'       => true,
					'type'         => $config['type'],
					'auth_callback' => function () { return current_user_can('edit_posts'); },
				]);
			}
		}
	}
}
