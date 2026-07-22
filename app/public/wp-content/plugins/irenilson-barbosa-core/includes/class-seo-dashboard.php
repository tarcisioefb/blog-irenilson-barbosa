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
		?>
		<div class="wrap">
			<h1>🔍 Diagnóstico de SEO</h1>
			<p style="color:var(--tx-2)">Visão geral da saúde de SEO do blog. Última verificação: <?php echo date('d/m/Y H:i'); ?></p>

			<div style="display:flex;gap:20px;flex-wrap:wrap;margin:20px 0">
				<?php self::stat_card($score['icon'], $score['label'], $score['desc'], $score['color']); ?>
				<?php self::stat_card('📄', 'Artigos', count($issues['posts'] ?? []), '#3E2C1B'); ?>
				<?php self::stat_card('📋', 'Problemas encontrados', $total - 4, '#991B1B'); ?>
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
						<tr><td><a href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a></td><td><a href="<?php echo get_edit_post_link($p->ID); ?>">Editar</a></td></tr>
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
						<tr><td><a href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a></td><td><a href="<?php echo get_edit_post_link($p->ID); ?>">Editar</a></td></tr>
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
		$issues = ['no_description' => [], 'no_thumb' => [], 'no_excerpt' => [], 'short_content' => [], 'ok' => [], 'posts' => []];
		$posts = get_posts([
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 200,
			'fields' => 'ids',
			'suppress_filters' => false,
		]);
		$issues['posts'] = $posts;

		foreach ($posts as $pid) {
			$meta_desc = get_post_meta($pid, '_ib_description', true);
			if (!$meta_desc) $issues['no_description'][] = get_post($pid);

			if (!has_post_thumbnail($pid)) $issues['no_thumb'][] = get_post($pid);

			$post_obj = get_post($pid);
			if (empty($post_obj->post_excerpt)) $issues['no_excerpt'][] = $post_obj;

			$words = str_word_count(wp_strip_all_tags($post_obj->post_content));
			if ($words < 300) {
				$post_obj->word_count = $words;
				$issues['short_content'][] = $post_obj;
			}
		}

		if (empty($issues['no_description'])) $issues['ok'][] = 'Todos os posts têm meta description';
		if (empty($issues['no_thumb'])) $issues['ok'][] = 'Todos os posts têm imagem destacada';
		if (empty($issues['short_content'])) $issues['ok'][] = 'Todos os posts têm conteúdo adequado (+300 palavras)';

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
