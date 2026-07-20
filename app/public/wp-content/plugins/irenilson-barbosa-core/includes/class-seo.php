<?php
namespace IrenilsonBarbosa\Core;

class SEO {
	public static function init() {
		add_action('add_meta_boxes', [__CLASS__, 'add_meta_box']);
		add_action('save_post', [__CLASS__, 'save_meta_box']);
		add_action('wp_head', [__CLASS__, 'output'], 1);
		add_filter('pre_get_document_title', [__CLASS__, 'filter_title']);
		add_filter('wp_title', [__CLASS__, 'filter_wp_title'], 10, 2);
	}

	public static function filter_title() {
		return self::get_title();
	}

	public static function filter_wp_title($title, $sep) {
		return self::get_title();
	}

	public static function add_meta_box() {
		$types = ['post', 'page', 'publicacao', 'livro', 'poiesis', 'material'];
		foreach ($types as $t) {
			add_meta_box('ib-seo', 'SEO', [__CLASS__, 'render_meta_box'], $t, 'side', 'default');
		}
	}

	public static function render_meta_box($post) {
		wp_nonce_field('ib_seo_save', 'ib_seo_nonce');
		$title       = get_post_meta($post->ID, '_ib_title', true);
		$description = get_post_meta($post->ID, '_ib_description', true);
		?>
		<p><label for="ib-title" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Título personalizado</label>
		<input type="text" id="ib-title" name="ib_title" value="<?php echo esc_attr($title); ?>" style="width:100%;padding:5px 6px;font-size:12px" placeholder="Deixe vazio para usar o título padrão"></p>
		<p><label for="ib-description" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Meta description</label>
		<textarea id="ib-description" name="ib_description" rows="3" style="width:100%;padding:5px 6px;font-size:12px" placeholder="Resumo para mecanismos de busca (máx. 160 caracteres)"><?php echo esc_textarea($description); ?></textarea></p>
		<?php
	}

	public static function save_meta_box($post_id) {
		if (!isset($_POST['ib_seo_nonce']) || !wp_verify_nonce($_POST['ib_seo_nonce'], 'ib_seo_save')) return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_post', $post_id)) return;

		if (isset($_POST['ib_title'])) {
			update_post_meta($post_id, '_ib_title', sanitize_text_field($_POST['ib_title']));
		}
		if (isset($_POST['ib_description'])) {
			update_post_meta($post_id, '_ib_description', sanitize_textarea_field($_POST['ib_description']));
		}
	}

	public static function output() {
		if (is_admin() || is_feed() || is_robots() || is_trackback()) return;

		$title = self::get_title();
		$desc  = self::get_description();
		$url   = self::get_url();
		$img   = self::get_image();
		$type  = self::get_og_type();

		echo "\n<!-- SEO — Irenilson Barbosa Core -->\n";
		?>
<meta name="description" content="<?php echo esc_attr($desc); ?>">
<link rel="canonical" href="<?php echo esc_url($url); ?>">
<meta property="og:type" content="<?php echo esc_attr($type); ?>">
<meta property="og:title" content="<?php echo esc_attr($title); ?>">
<meta property="og:description" content="<?php echo esc_attr($desc); ?>">
<meta property="og:url" content="<?php echo esc_url($url); ?>">
<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
<meta property="og:locale" content="pt_BR">
<?php if ($img) : ?>
<meta property="og:image" content="<?php echo esc_url($img); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($desc); ?>">
<?php if ($img) : ?>
<meta name="twitter:image" content="<?php echo esc_url($img); ?>">
<?php endif;
		self::output_schema();
		echo "<!-- /SEO -->\n";
	}

	private static function get_url() {
		if (is_singular()) return get_permalink(get_queried_object_id());
		if (is_home() || is_front_page()) return home_url('/');
		if (is_archive()) return get_pagenum_link(1);
		return home_url('/');
	}

	private static function get_og_type() {
		if (is_singular()) {
			$pt = get_post_type();
			if ('livro' === $pt) return 'book';
			return 'article';
		}
		return 'website';
	}

	private static function get_title() {
		if (is_singular()) {
			$custom = get_post_meta(get_queried_object_id(), '_ib_title', true);
			if ($custom) return $custom;
			return single_post_title('', false) . ' — ' . get_bloginfo('name');
		}
		if (is_home() || is_front_page()) {
			return get_bloginfo('name') . ' — Professor universitário, escritor e pesquisador';
		}
		if (is_archive()) {
			$q = get_queried_object();
			if (is_category()) return single_cat_title('', false) . ' — ' . get_bloginfo('name');
			if (is_post_type_archive()) {
				if (is_post_type_archive('publicacao')) return 'Publicações acadêmicas — ' . get_bloginfo('name');
				if (is_post_type_archive('livro')) return 'Livros — ' . get_bloginfo('name');
				if (is_post_type_archive('poiesis')) return 'Poiésis — Poemas — ' . get_bloginfo('name');
				if (is_post_type_archive('material')) return 'Materiais educacionais — ' . get_bloginfo('name');
			}
			return get_the_archive_title() . ' — ' . get_bloginfo('name');
		}
		return wp_get_document_title();
	}

	private static function get_description() {
		if (is_singular()) {
			$custom = get_post_meta(get_queried_object_id(), '_ib_description', true);
			if ($custom) return $custom;

			$post = get_queried_object();
			if (!empty($post->post_excerpt)) return wp_trim_words($post->post_excerpt, 30);
			if (!empty($post->post_content)) return wp_trim_words(wp_strip_all_tags($post->post_content), 30);
		}
		if (is_home() || is_front_page()) {
			return 'Irenilson Barbosa — Professor universitário, escritor e pesquisador. Ensaios sobre filosofia, educação, política e cultura, poemas, publicações acadêmicas e livros.';
		}
		if (is_archive()) {
			if (is_category()) {
				$desc = category_description();
				if ($desc) return wp_trim_words(wp_strip_all_tags($desc), 30);
				return 'Artigos sobre ' . single_cat_title('', false) . ' — Irenilson Barbosa';
			}
			if (is_post_type_archive('publicacao')) return 'Publicações acadêmicas de Irenilson Barbosa — artigos científicos, capítulos de livros e ensaios.';
			if (is_post_type_archive('livro')) return 'Livros de Irenilson Barbosa — obras publicadas sobre educação, inclusão, filosofia e ficção.';
			if (is_post_type_archive('poiesis')) return 'Poemas e criações literárias de Irenilson Barbosa.';
			if (is_post_type_archive('material')) return 'Materiais educacionais para download — slides, apostilas e guias.';
		}
		return '';
	}

	private static function get_image() {
		if (is_singular()) {
			$post_type = get_post_type();
			if (in_array($post_type, ['post', 'publicacao', 'livro', 'poiesis', 'material'], true)) {
				$thumb_id = get_post_thumbnail_id(get_queried_object_id());
				if ($thumb_id) {
					$src = wp_get_attachment_image_url($thumb_id, 'large');
					if ($src) return $src;
				}
			}
		}
		$retrato = home_url('/wp-content/uploads/2026/07/Irenilson-Barbosa-Retrato.avif');
		return $retrato;
	}

	private static function output_schema() {
		if (!is_singular()) return;
		$post = get_queried_object();
		if (!$post || empty($post->post_type)) return;

		$post_type = $post->post_type;

		if (in_array($post_type, ['post', 'publicacao', 'poiesis', 'material'], true)) {
			self::schema_article($post);
		} elseif ('livro' === $post_type) {
			self::schema_book($post);
		}
	}

	private static function schema_article($post) {
		$title  = self::get_title();
		$desc   = self::get_description();
		$url    = get_permalink($post->ID);
		$img    = self::get_image();
		$author_name = 'Irenilson Barbosa';
		$author_url  = home_url('/sobre/');
		if ('poiesis' === $post->post_type) {
			$a = get_post_meta($post->ID, 'poiesis_author', true);
			if ($a) $author_name = $a;
		}
		$pub  = get_the_date('c', $post->ID);
		$mod  = get_the_modified_date('c', $post->ID);
		$type = in_array($post->post_type, ['publicacao', 'material'], true) ? 'ScholarlyArticle' : 'Article';
		?>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"<?php echo esc_js($type); ?>",
"headline":"<?php echo esc_js($title); ?>",
"description":"<?php echo esc_js($desc); ?>",
"url":"<?php echo esc_js($url); ?>",
"datePublished":"<?php echo esc_js($pub); ?>",
"dateModified":"<?php echo esc_js($mod); ?>",
"author":{"@type":"Person","name":"<?php echo esc_js($author_name); ?>","url":"<?php echo esc_js($author_url); ?>"},
"publisher":{"@type":"Person","name":"Irenilson Barbosa","url":"<?php echo esc_js(home_url('/sobre/')); ?>"},
"mainEntityOfPage":{"@type":"WebPage","@id":"<?php echo esc_js($url); ?>"}
<?php if ($img) : ?>,
"image":{"@type":"ImageObject","url":"<?php echo esc_js($img); ?>","width":1200,"height":630}
<?php endif; ?>
}
</script>
		<?php
	}

	private static function schema_book($post) {
		$title       = get_the_title($post->ID);
		$desc        = get_post_meta($post->ID, '_ib_description', true) ?: wp_trim_words(wp_strip_all_tags($post->post_content), 30);
		$isbn        = get_post_meta($post->ID, 'isbn', true);
		$pages       = get_post_meta($post->ID, 'numero_paginas', true);
		$publisher   = get_post_meta($post->ID, 'editora', true);
		$year        = get_post_meta($post->ID, 'ano', true);
		$img         = self::get_image();
		?>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"Book",
"name":"<?php echo esc_js($title); ?>",
"description":"<?php echo esc_js($desc); ?>",
"url":"<?php echo esc_js(get_permalink($post->ID)); ?>",
"author":{"@type":"Person","name":"Irenilson Barbosa","url":"<?php echo esc_js(home_url('/sobre/')); ?>"}
<?php if ($isbn) : ?>,
"isbn":"<?php echo esc_js($isbn); ?>"
<?php endif; if ($pages) : ?>,
"numberOfPages":"<?php echo esc_js($pages); ?>"
<?php endif; if ($publisher) : ?>,
"publisher":"<?php echo esc_js($publisher); ?>"
<?php endif; if ($year) : ?>,
"datePublished":"<?php echo esc_js($year); ?>"
<?php endif; if ($img) : ?>,
"image":"<?php echo esc_js($img); ?>"
<?php endif; ?>
}
</script>
		<?php
	}
}
