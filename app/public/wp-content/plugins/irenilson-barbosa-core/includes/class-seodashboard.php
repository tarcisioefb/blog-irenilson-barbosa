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
			echo '<div class="notice notice-success is-dismissible"><p>✅ Geração concluída. ' . (int) $_GET['generated'] . ' itens processados.</p></div>';
		}
		if (!empty($_GET['batch'])) {
			$done = (int) ($_GET['done'] ?? 0);
			$total = (int) ($_GET['total'] ?? 0);
			$pct = $total > 0 ? round($done / $total * 100) : 0;
			echo '<div class="notice notice-info"><p>⏳ Gerando... ' . $done . ' de ' . $total . ' (' . $pct . '%)</p><progress value="' . $done . '" max="' . $total . '" style="width:100%;height:8px;border-radius:4px"></progress></div>';
			echo '<script>setTimeout(function(){var f=document.createElement("form");f.method="POST";f.action="' . admin_url('admin-ajax.php') . '";var i1=document.createElement("input");i1.name="action";i1.value="ib_batch_seo";f.appendChild(i1);var i2=document.createElement("input");i2.name="_wpnonce";i2.value="' . wp_create_nonce('ib_batch_seo') . '";f.appendChild(i2);document.body.appendChild(f);f.submit();},500);</script>';
		}
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">🔍 Diagnóstico de SEO
				<form method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" style="display:inline">
					<?php wp_nonce_field('ib_batch_seo'); ?>
					<input type="hidden" name="action" value="ib_batch_seo">
					<button type="submit" class="button button-primary" style="background:#4a5d3e;border-color:#4a5d3e">⚡ Gerar todos</button>
				</form>
			</h1>
			<p style="color:var(--tx-2)">Visão geral da saúde de SEO do blog. Última verificação: <?php echo date('d/m/Y H:i'); ?></p>

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

		$problem_ids = [];
		foreach (['no_description', 'no_thumb', 'no_excerpt', 'short_content'] as $key) {
			foreach ($issues[$key] as $p) {
				$problem_ids[$p->ID] = true;
			}
		}
		$ratio = max(0, 100 - round(count($problem_ids) / $total * 100));

		$desc = $ratio >= 80 ? 'SEO saudável' : ($ratio >= 50 ? 'Atenção necessária' : 'Prioridade alta');
		return ['icon' => $ratio >= 80 ? '🟢' : ($ratio >= 50 ? '🟡' : '🔴'), 'label' => $desc, 'desc' => "$ratio% dos conteúdos sem problemas", 'color' => $ratio >= 80 ? '#2E7D32' : ($ratio >= 50 ? '#F9A825' : '#991B1B')];
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
