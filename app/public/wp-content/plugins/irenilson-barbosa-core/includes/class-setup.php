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
		if (in_array($post_type, ['poiesis', 'livro', 'publicacao', 'material'], true)) return false;
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
		add_action('edit_form_after_title', [__CLASS__, 'render_poiesis_fields']);
		add_action('edit_form_after_title', [__CLASS__, 'render_livro_fields']);
		add_action('edit_form_after_title', [__CLASS__, 'render_publicacao_fields']);
		add_action('edit_form_after_title', [__CLASS__, 'render_material_fields']);
		add_action('save_post', [__CLASS__, 'save_cpt_metabox']);
		add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_media_scripts']);
	}

	public static function enqueue_media_scripts($hook) {
		if (!in_array($hook, ['post.php', 'post-new.php'], true)) return;
		$screen = get_current_screen();
		if (!$screen || !in_array($screen->post_type, ['livro', 'material', 'publicacao', 'poiesis'], true)) return;
		wp_enqueue_media();
		$theme_uri = get_template_directory_uri();
		wp_enqueue_script('ib-admin', $theme_uri . '/assets/ib-admin.js', ['jquery'], IRENILSON_CORE_VERSION, true);
	}

	public static function render_poiesis_fields($post) {
		if ('poiesis' !== $post->post_type) return;
		wp_nonce_field('cpt_save', 'cpt_nonce');
		$author = get_post_meta($post->ID, 'poiesis_author', true);
		$notas = get_post_meta($post->ID, 'poiesis_notas', true);
		?>
		<div style="background:#f0f0f1;padding:12px 16px;margin:8px 0 16px;border-radius:4px">
			<p style="margin:0 0 10px">
				<label for="poiesis_author" style="display:block;font-weight:600;margin-bottom:4px">Autor do poema</label>
				<input type="text" id="poiesis_author" name="poiesis_author" value="<?php echo esc_attr($author ?: 'Irenilson Barbosa'); ?>" style="width:100%;padding:7px 8px;font-size:13px">
			</p>
			<p style="margin:0">
				<label for="poiesis_notas" style="display:block;font-weight:600;margin-bottom:4px">Notas / texto explicativo</label>
				<textarea id="poiesis_notas" name="poiesis_notas" style="width:100%;min-height:80px;padding:7px 8px;font-size:13px" placeholder="Dedicatória, introdução, nota do autor..."><?php echo esc_textarea($notas); ?></textarea>
			</p>
		</div>
		<?php
	}

	public static function render_livro_fields($post) {
		if ('livro' !== $post->post_type) return;
		wp_nonce_field('cpt_save', 'cpt_nonce');
		?>
		<div style="background:#f0f0f1;padding:12px 16px;margin:8px 0 16px;border-radius:4px;display:grid;grid-template-columns:1fr 1fr;gap:12px">
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Ano</label><input type="number" name="ano" value="<?php echo esc_attr(get_post_meta($post->ID, 'ano', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Editora</label><input type="text" name="editora" value="<?php echo esc_attr(get_post_meta($post->ID, 'editora', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">ISBN</label><input type="text" name="isbn" value="<?php echo esc_attr(get_post_meta($post->ID, 'isbn', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Páginas</label><input type="number" name="numero_paginas" value="<?php echo esc_attr(get_post_meta($post->ID, 'numero_paginas', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
		<?php
		$comprar_raw = get_post_meta($post->ID, 'comprar_links', true);
		$comprar_pairs = [];
		if ($comprar_raw) {
			foreach (explode("\n", $comprar_raw) as $linha) {
				$linha = trim($linha);
				if (!$linha) continue;
				$parts = explode('|', $linha, 2);
				if (count($parts) === 2) {
					$comprar_pairs[] = ['texto' => trim($parts[0]), 'url' => trim($parts[1])];
				}
			}
		}
		?>
			<div style="grid-column:1/-1;margin-top:8px">
				<label style="display:block;font-weight:600;margin-bottom:6px;font-size:12px">Links de compra</label>
				<div id="ib-comprar-links">
					<?php for ($i = 0; $i < max(3, count($comprar_pairs) + 1); $i++) :
						$p = $comprar_pairs[$i] ?? ['texto' => '', 'url' => ''];
					?>
					<div style="display:flex;gap:8px;margin-bottom:6px;align-items:end">
						<span style="flex:1">
							<input type="text" name="comprar_texto_<?php echo $i; ?>" value="<?php echo esc_attr($p['texto']); ?>" style="width:100%;padding:7px 8px;font-size:13px" placeholder="Texto do botão">
						</span>
						<span style="flex:2">
							<input type="url" name="comprar_url_<?php echo $i; ?>" value="<?php echo esc_attr($p['url']); ?>" style="width:100%;padding:7px 8px;font-size:13px" placeholder="https://...">
						</span>
					</div>
					<?php endfor; ?>
				</div>
				<input type="hidden" name="comprar_links_count" value="<?php echo max(3, count($comprar_pairs) + 1); ?>">
				<span style="font-size:11px;color:#6D5940">Preencha texto e URL. Deixe em branco para ocultar.</span>
			</div>
		</div>
		<?php
	}

	public static function render_publicacao_fields($post) {
		if ('publicacao' !== $post->post_type) return;
		wp_nonce_field('cpt_save', 'cpt_nonce');
		?>
		<div style="background:#f0f0f1;padding:12px 16px;margin:8px 0 16px;border-radius:4px;display:grid;grid-template-columns:1fr 1fr;gap:12px">
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Ano</label><input type="number" name="ano_publicacao" value="<?php echo esc_attr(get_post_meta($post->ID, 'ano_publicacao', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Periódico / Veículo</label><input type="text" name="periodico" value="<?php echo esc_attr(get_post_meta($post->ID, 'periodico', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">DOI</label><input type="text" name="doi" value="<?php echo esc_attr(get_post_meta($post->ID, 'doi', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Link externo</label><input type="url" name="link_externo" value="<?php echo esc_attr(get_post_meta($post->ID, 'link_externo', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px" placeholder="https://..."></p>
			<p style="margin:0;grid-column:1/-1"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Citação ABNT</label><textarea name="citacao_abnt" style="width:100%;min-height:60px;padding:7px 8px;font-size:13px;font-family:monospace"><?php echo esc_textarea(get_post_meta($post->ID, 'citacao_abnt', true)); ?></textarea></p>
		</div>
		<?php
	}

	public static function render_material_fields($post) {
		if ('material' !== $post->post_type) return;
		wp_nonce_field('cpt_save', 'cpt_nonce');
		$arquivo = get_post_meta($post->ID, 'arquivo_url', true);
		?>
		<div style="background:#f0f0f1;padding:12px 16px;margin:8px 0 16px;border-radius:4px">
			<p style="margin:0 0 10px"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Ano</label><input type="number" name="ano" value="<?php echo esc_attr(get_post_meta($post->ID, 'ano', true)); ?>" style="width:100%;padding:7px 8px;font-size:13px"></p>
			<p style="margin:0 0 10px"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Arquivo para download</label>
				<span style="display:flex;gap:6px">
					<input type="url" id="arquivo_url" name="arquivo_url" value="<?php echo esc_attr($arquivo); ?>" class="regular-text" placeholder="https://..." style="flex:1;padding:7px 8px;font-size:13px;border:1px solid #8c8f94;border-radius:4px">
					<button type="button" class="button" data-media-pick="arquivo_url">Selecionar</button>
					<button type="button" class="button" data-media-clear="arquivo_url">Remover</button>
				</span>
				<?php if ($arquivo) : ?>
					<br><span style="font-size:12px;color:#6D5940">📎 <a href="<?php echo esc_url($arquivo); ?>" target="_blank"><?php echo esc_html(basename($arquivo)); ?></a></span>
				<?php endif; ?>
			</p>
			<p style="margin:0"><label style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Descrição</label><textarea name="descricao" style="width:100%;min-height:80px;padding:7px 8px;font-size:13px"><?php echo esc_textarea(get_post_meta($post->ID, 'descricao', true)); ?></textarea></p>
		</div>
		<?php
	}

	public static function save_cpt_metabox($post_id) {
		if (!isset($_POST['cpt_nonce']) || !wp_verify_nonce($_POST['cpt_nonce'], 'cpt_save')) return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_post', $post_id)) return;

		$text_fields = ['editora', 'isbn', 'periodico', 'citacao_abnt', 'descricao', 'poiesis_author', 'poiesis_notas', 'doi'];
		$int_fields  = ['ano', 'numero_paginas', 'ano_publicacao'];
		$url_fields  = ['link_externo', 'arquivo_url'];

		foreach ($text_fields as $f) {
			if (isset($_POST[$f])) update_post_meta($post_id, $f, sanitize_text_field($_POST[$f]));
		}
		foreach ($int_fields as $f) {
			if (isset($_POST[$f])) update_post_meta($post_id, $f, absint($_POST[$f]));
		}
		foreach ($url_fields as $f) {
			if (isset($_POST[$f])) update_post_meta($post_id, $f, esc_url_raw(trim($_POST[$f])));
		}

		$links = [];
		$count = isset($_POST['comprar_links_count']) ? (int) $_POST['comprar_links_count'] : 3;
		for ($i = 0; $i < $count; $i++) {
			$texto = isset($_POST["comprar_texto_$i"]) ? trim(sanitize_text_field($_POST["comprar_texto_$i"])) : '';
			$url   = isset($_POST["comprar_url_$i"]) ? trim(esc_url_raw($_POST["comprar_url_$i"])) : '';
			if ($texto && $url) {
				$links[] = "$texto | $url";
			}
		}
		update_post_meta($post_id, 'comprar_links', implode("\n", $links));
	}

	public static function register_meta() {
		$meta_fields = [
			'_ib_title'        => ['type' => 'string', 'post_types' => ['post', 'page', 'publicacao', 'livro', 'poiesis', 'material']],
			'_ib_description'  => ['type' => 'string', 'post_types' => ['post', 'page', 'publicacao', 'livro', 'poiesis', 'material']],
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
			'comprar_links'    => ['type' => 'string', 'post_types' => ['livro']],
			'descricao'        => ['type' => 'string', 'post_types' => ['material']],
			'arquivo_url'      => ['type' => 'string', 'post_types' => ['material']],
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
