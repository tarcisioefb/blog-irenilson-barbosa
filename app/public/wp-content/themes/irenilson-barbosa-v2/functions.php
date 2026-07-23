<?php
/**
 * Blog do Irenilson — setup do tema.
 * Desenvolvido por Zucatech (zucatech.com)
 */

defined('ABSPATH') || exit;

define('IRENILSON_VER', '2.0.9');

require get_template_directory() . '/inc/template-tags.php';

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
add_image_size('ib-book-thumb', 150, 225, true);
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
	$h_name  = $heading !== 'System' ? str_replace('+', ' ', $heading) : 'Georgia';
	$b_name  = $body !== 'System' ? str_replace('+', ' ', $body) : 'system-ui';
	$h_fallback = $heading !== 'System' ? ',Georgia,serif' : ',"Iowan Old Style","Times New Roman",serif';
	$b_fallback = $body !== 'System' ? ',system-ui,sans-serif' : ',-apple-system,"Segoe UI",Roboto,sans-serif';
	printf(
		'<style id="ib-fonts-css">:root{--serif:\'%s\'%s;--sans:\'%s\'%s}</style>',
		esc_html($h_name), esc_html($h_fallback),
		esc_html($b_name), esc_html($b_fallback)
	);
});

// CSS + JS
add_filter('use_block_editor_for_post', function ($enabled, $post) {
	if ($post && $post->post_name === 'sobre') return false;
	return $enabled;
}, 10, 2);

add_action('admin_head', function () {
	$screen = get_current_screen();
	if ($screen && $screen->id === 'page' && ($_GET['post'] ?? '') && get_post($_GET['post'])->post_name === 'sobre') {
		echo '<style>#postdivrich,#postdivrich_0,#postdivrich_1{display:none!important}</style>';
	}
});

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('irenilson', get_template_directory_uri() . '/assets/ib.css', [], IRENILSON_VER);
	wp_enqueue_script('irenilson', get_template_directory_uri() . '/assets/ib.js', [], IRENILSON_VER, true);
	if (is_singular() && comments_open()) {
		wp_enqueue_script('comment-reply');
	}
});

// Data padrão Brasil
add_filter('option_date_format', function () { return 'j \d\e F \d\e Y'; });

// Ordenação e limite por tipo de arquivo
add_action('pre_get_posts', function ($query) {
	if (is_admin() || !$query->is_main_query()) return;

	if (is_post_type_archive('poiesis')) {
		$query->set('posts_per_page', 16);
	}

	if (is_post_type_archive('livro')) {
		$query->set('meta_key', 'ano');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'DESC');
	}
});

// Reatribui posts de Tarcisio (ID 1) para Irenilson (ID 2) automaticamente
add_filter('wp_insert_post_data', function ($data, $postarr) {
	if (isset($data['post_author']) && (int)$data['post_author'] === 1) {
		$data['post_author'] = 2;
	}
	return $data;
}, 10, 2);

// Avatar local para o usuário Irenilson (ID 2)
add_filter('get_avatar_url', function ($url, $id_or_email, $args) {
	$user_id = 0;
	if (is_numeric($id_or_email)) $user_id = (int) $id_or_email;
	elseif ($id_or_email instanceof \WP_User) $user_id = $id_or_email->ID;
	elseif (is_object($id_or_email) && isset($id_or_email->user_id)) $user_id = (int) $id_or_email->user_id;
	elseif (is_string($id_or_email) && is_email($id_or_email)) {
		$user = get_user_by('email', $id_or_email);
		$user_id = $user ? $user->ID : 0;
	}
	if (2 === $user_id) {
		$uploads = wp_upload_dir();
		return $uploads['baseurl'] . '/2026/07/Irenilson-Barbosa-Retrato.avif-square.jpg';
	}
	return $url;
}, 10, 3);

// ─── SVG ──────────────────────────────────────────────────

add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
});

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
	$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	if ('svg' === $ext) {
		$data['ext']  = 'svg';
		$data['type'] = 'image/svg+xml';
	}
	return $data;
}, 10, 4);

add_filter('wp_handle_upload_prefilter', function ($file) {
	if ('image/svg+xml' !== $file['type']) return $file;

	$content = file_get_contents($file['tmp_name']);
	if (false === $content) return $file;

	// Sanitiza: remove scripts, event handlers, iframes, foreign objects
	$content = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $content);
	$content = preg_replace('/<iframe[^>]*>.*?<\/iframe>/is', '', $content);
	$content = preg_replace('/<foreignObject[^>]*>.*?<\/foreignObject>/is', '', $content);
	$content = preg_replace('/\bon\w+\s*=\s*["\'][^"\']*["\']/i', '', $content);
	$content = preg_replace('/javascript\s*:/i', '', $content);
	$content = preg_replace('/data:\s*[^,]+,/i', '', $content);

	file_put_contents($file['tmp_name'], $content);
	return $file;
});

// Exibe preview de SVG na biblioteca de mídia
add_action('admin_head', function () {
	echo '<style type="text/css">.media-frame .attachment svg{width:100%;height:auto}</style>';
});

// ─── Newsletter (formulário — exibição no tema) ──────────────

function ib_newsletter_form() {
	?>
	<form class="ib-newsletter" method="post" onsubmit="return ibNewsletter(this)">
		<input type="email" name="email" required placeholder="seu@email.com" aria-label="E-mail" class="ib-newsletter__input">
		<button type="submit" class="ib-newsletter__btn">Assinar</button>
	</form>
	<div class="ib-newsletter-msg" aria-live="polite"></div>
	<p style="font-size:var(--text-xs);color:var(--tx-2);margin:var(--space-2) 0 0;line-height:1.4">Ao assinar, você concorda com a <a href="/privacidade/" target="_blank" style="color:var(--accent);text-decoration:underline">Política de Privacidade</a>. Seus dados não serão compartilhados.</p>
	<script>
	function ibNewsletter(f) {
		var btn = f.querySelector('button'), msg = f.parentNode.querySelector('.ib-newsletter-msg');
		btn.disabled = true; btn.textContent = 'Enviando…';
		var fd = new FormData(); fd.append('action','ib_newsletter'); fd.append('email',f.email.value);
		fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>',{method:'POST',body:fd})
		.then(function(r){return r.json()}).then(function(d){
			msg.textContent = d.data; msg.style.color = d.success ? 'var(--accent)' : '#991B1B';
			if(d.success) f.email.value = '';
			btn.disabled = false; btn.textContent = 'Assinar';
		});
		return false;
	}
	</script>
	<?php
}
