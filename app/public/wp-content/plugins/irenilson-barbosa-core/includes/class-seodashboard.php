<?php
namespace IrenilsonBarbosa\Core;

class SEODashboard {
	public static function init() {
		add_action('admin_menu', [__CLASS__, 'register_menu']);
	}

	public static function register_menu() {
		add_submenu_page(
			'ib-ajustes',
			'SEO — Diagnóstico',
			'🔍 SEO',
			'edit_pages',
			'ib-seo-dashboard',
			[__CLASS__, 'render']
		);
	}

	public static function render() {
		if (!current_user_can('edit_pages')) wp_die('Sem permissão.');
		$issues = self::scan();
		$total = count($issues);
		$score = self::calc_score($issues);

		if (!empty($_GET['generated'])) {
			$desc = (int) ($_GET['desc_filled'] ?? 0);
			$excerpt = (int) ($_GET['excerpt_filled'] ?? 0);
			echo '<div class="notice notice-success is-dismissible"><p>✅ ' . $desc . ' meta descriptions e ' . $excerpt . ' excerpts gerados automaticamente.</p></div>';
		}
		?>
		<div class="wrap">
			<h1>🔍 Diagnóstico de SEO</h1>
			<p style="color:var(--tx-2)">Visão geral da saúde de SEO do blog. Última verificação: <?php echo date('d/m/Y H:i'); ?></p>
			<form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" style="margin-bottom:12px;display:inline-block">
				<?php wp_nonce_field('ib_batch_seo'); ?>
				<input type="hidden" name="action" value="ib_batch_seo">
				<button type="submit" class="button button-primary" style="background:#4a5d3e;border-color:#4a5d3e">⚡ Gerar todos</button>
			</form>

			<div style="display:flex;gap:20px;flex-wrap:wrap;margin:20px 0">
				<?php self::stat_card($score['icon'], $score['label'], $score['desc'], $score['color']); ?>
				<?php self::stat_card('📄', 'Conteúdos', count($issues['posts'] ?? []), '#3E2C1B'); ?>
				<?php self::stat_card('📋', 'Problemas encontrados', count($issues['no_description']) + count($issues['no_thumb']) + count($issues['no_excerpt']) + count($issues['short_content']), '#991B1B'); ?>
				<?php self::stat_card('✅', 'OK', count($issues['ok'] ?? []), '#2E7D32'); ?>
			</div>

			<?php if (!empty($issues['no_description'])) : ?>
			<div class="ib-seo-section">
				<h2>📝 Artigos sem meta description <span class="ib-seo-count"><?php echo count($issues['no_description']); ?></span></h2>
				<p class="ib-seo-desc">O Google pode gerar a descrição automaticamente, mas o ideal é ter uma descrição única por post.</p>
				<table class="wp-list-table widefat fixed striped">
					<thead><tr><th>Post</th><th>Ação</th></tr></thead>
					<tbody>
					<?php foreach ($issues['no_description'] as $p) : ?>
						<tr><td><a href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a></td><td><a href="<?php echo get_edit_post_link($p->ID); ?>">Editar</a> | <form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" style="display:inline"><?php wp_nonce_field('ib_gen_desc'); ?><input type="hidden" name="action" value="ib_gen_desc"><input type="hidden" name="post_id" value="<?php echo (int) $p->ID; ?>"><button type="submit" style="background:none;border:none;color:#2271b1;cursor:pointer;padding:0;font:inherit;text-decoration:underline">⚡ Gerar</button></form></td></tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php endif; ?>

			<?php if (!empty($issues['no_thumb'])) : ?>
			<div class="ib-seo-section">
				<h2>🖼️ Artigos sem imagem destacada <span class="ib-seo-count"><?php echo count($issues['no_thumb']); ?></span></h2>
				<p class="ib-seo-desc">Imagens destacadas melhoram o CTR no Google e nas redes sociais.</p>
				<table class="wp-list-table widefat fixed striped">
					<thead><tr><th>Post</th><th>Ação</th></tr></thead>
					<tbody>
					<?php foreach ($issues['no_thumb'] as $p) : ?>
						<tr><td><a href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a></td><td><a href="<?php echo get_edit_post_link($p->ID); ?>">Editar</a></td></tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php endif; ?>

			<?php if (!empty($issues['no_excerpt'])) : ?>
			<div class="ib-seo-section">
				<h2>📄 Artigos sem resumo (excerpt) <span class="ib-seo-count"><?php echo count($issues['no_excerpt']); ?></span></h2>
				<p class="ib-seo-desc">O excerpt aparece nos arquivos e pode ser usado como meta description.</p>
				<table class="wp-list-table widefat fixed striped">
					<thead><tr><th>Post</th><th>Ação</th></tr></thead>
					<tbody>
					<?php foreach ($issues['no_excerpt'] as $p) : ?>
						<tr><td><a href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a></td><td><a href="<?php echo get_edit_post_link($p->ID); ?>">Editar</a> | <form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" style="display:inline"><?php wp_nonce_field('ib_gen_desc'); ?><input type="hidden" name="action" value="ib_gen_desc"><input type="hidden" name="post_id" value="<?php echo (int) $p->ID; ?>"><button type="submit" style="background:none;border:none;color:#2271b1;cursor:pointer;padding:0;font:inherit;text-decoration:underline">⚡ Gerar</button></form></td></tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php endif; ?>

			<?php if (!empty($issues['short_content'])) : ?>
			<div class="ib-seo-section">
				<h2>📏 Artigos muito curtos (&lt; 300 palavras) <span class="ib-seo-count"><?php echo count($issues['short_content']); ?></span></h2>
				<table class="wp-list-table widefat fixed striped">
					<thead><tr><th>Post</th><th>Palavras</th><th>Ação</th></tr></thead>
					<tbody>
					<?php foreach ($issues['short_content'] as $p) : ?>
						<tr><td><a href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a></td><td><?php echo (int) $p->word_count; ?></td><td><a href="<?php echo get_edit_post_link($p->ID); ?>">Editar</a></td></tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php endif; ?>

			<?php if (!empty($issues['ok'])) : ?>
			<div class="ib-seo-section">
				<h2>✅ Tudo certo <span class="ib-seo-count ib-seo-count--ok"><?php echo count($issues['ok']); ?></span></h2>
				<ul>
				<?php foreach ($issues['ok'] as $msg) : ?>
					<li style="color:#2E7D32">✅ <?php echo esc_html($msg); ?></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<style>
		.ib-seo-section{background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px;margin-bottom:20px}
		.ib-seo-section h2{margin:0 0 4px;font-size:15px;color:#3E2C1B;display:flex;align-items:center;gap:8px}
		.ib-seo-desc{margin:0 0 16px;color:#6D5940;font-size:12px}
		.ib-seo-count{display:inline-flex;align-items:center;justify-content:center;min-width:22px;height:22px;padding:0 6px;border-radius:11px;background:#991B1B;color:#fff;font-size:11px;font-weight:700}
		.ib-seo-count--ok{background:#2E7D32}
		</style>
		<?php
	}

	private static function scan() {
		global $wpdb;
		$issues = ['no_description' => [], 'no_thumb' => [], 'no_excerpt' => [], 'short_content' => [], 'ok' => [], 'posts' => []];

		$types = get_post_types(['public' => true, 'show_ui' => true], 'names');
		$types = array_diff($types, ['attachment']);

		$all_posts = $wpdb->get_col(
			"SELECT ID FROM {$wpdb->posts} WHERE post_status='publish' AND post_type IN ('" . implode("','", esc_sql($types)) . "')"
		);

		$issues['posts'] = $all_posts;

		$desc_posts = $wpdb->get_col(
			"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_ib_description' AND meta_value != ''"
		);
		$desc_map = array_flip($desc_posts);

		foreach ($all_posts as $pid) {
			$post_obj = get_post($pid);
			$type = $post_obj->post_type;

			if (!isset($desc_map[$pid])) {
				$issues['no_description'][] = $post_obj;
			}

			if ($type !== 'page' && !has_post_thumbnail($pid)) {
				$issues['no_thumb'][] = $post_obj;
			}

			if (empty($post_obj->post_excerpt)) {
				$issues['no_excerpt'][] = $post_obj;
			}

			if (!in_array($type, ['page', 'poiesis', 'livro'], true)) {
				$words = str_word_count(wp_strip_all_tags($post_obj->post_content));
				if ($words < 300) {
					$post_obj->word_count = $words;
					$issues['short_content'][] = $post_obj;
				}
			}
		}

		$type_list = implode(', ', array_keys(get_post_types(['public' => true, 'show_ui' => true], 'names')));

		if (empty($issues['no_description'])) $issues['ok'][] = "Todos os $type_list têm meta description";
		if (empty($issues['no_thumb'])) $issues['ok'][] = "Todos os $type_list têm imagem destacada";
		if (empty($issues['short_content'])) $issues['ok'][] = "Todos os $type_list têm conteúdo adequado (+300 palavras)";

		return $issues;
	}

	private static function calc_score($issues) {
		$total = count($issues['posts']);
		if (!$total) return ['icon' => '📊', 'label' => 'Sem dados', 'desc' => 'Nenhum post publicado.', 'color' => '#999'];
		$problems = count($issues['no_description']) + count($issues['no_thumb']) + count($issues['short_content']);
		$ratio = max(0, 100 - round($problems / $total * 100));
		if ($ratio >= 80) return ['icon' => '🟢', 'label' => "$ratio%", 'desc' => 'SEO saudável', 'color' => '#2E7D32'];
		if ($ratio >= 50) return ['icon' => '🟡', 'label' => "$ratio%", 'desc' => 'Atenção necessária', 'color' => '#F9A825'];
		return ['icon' => '🔴', 'label' => "$ratio%", 'desc' => 'Prioridade alta', 'color' => '#991B1B'];
	}

	private static function stat_card($icon, $label, $value, $color) {
		?>
		<div style="flex:1;min-width:140px;background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px;text-align:center">
			<div style="font-size:28px;margin-bottom:4px"><?php echo $icon; ?></div>
			<div style="font-size:24px;font-weight:700;color:<?php echo $color; ?>"><?php echo is_numeric($value) ? $value : esc_html($value); ?></div>
			<div style="font-size:12px;color:#6D5940"><?php echo esc_html($label); ?></div>
		</div>
		<?php
	}
}
