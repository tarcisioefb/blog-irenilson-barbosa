<?php
/** IRENILSON BARBOSA — Single Material (download). */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post();
	$pid = get_the_ID();
	$arquivo = get_post_meta($pid, 'arquivo_url', true);
	$ano = get_post_meta($pid, 'ano', true);
	$descricao = get_post_meta($pid, 'descricao', true);
	$tipos = get_the_terms($pid, 'tipo-material');
	$tipo_label = $tipos && !is_wp_error($tipos) ? $tipos[0]->name : '';
?>
<div class="wrap single-wrap" id="main">
	<?php ib_breadcrumb(); ?>

	<div style="display:grid;grid-template-columns:minmax(0,1fr);gap:var(--space-8);max-width:720px;margin:0 auto">

		<?php if ($tipo_label) : ?>
		<div style="display:flex;gap:var(--space-2);flex-wrap:wrap;margin-bottom:var(--space-2)">
			<span class="en-tag en-tag--solid"><?php echo esc_html($tipo_label); ?></span>
			<?php if ($ano) : ?><span class="en-tag" style="background:var(--accent-2)"><?php echo esc_html($ano); ?></span><?php endif; ?>
		</div>
		<?php endif; ?>

		<h1 class="article__title" style="margin-bottom:var(--space-3)"><?php the_title(); ?></h1>

		<?php if (has_post_thumbnail()) : ?>
		<div style="border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-card);background:#fff;max-width:400px">
			<?php the_post_thumbnail('large', ['style' => 'width:100%;height:auto;display:block']); ?>
		</div>
		<?php endif; ?>

		<?php if ($descricao) : ?>
		<div style="font-size:var(--text-15);color:var(--tx-2);line-height:var(--leading-relaxed)"><?php echo wp_kses_post($descricao); ?></div>
		<?php endif; ?>

		<div class="article__body" style="max-width:none;font-size:var(--text-15)"><?php the_content(); ?></div>

		<?php if ($arquivo) : ?>
		<div style="margin:var(--space-4) 0 var(--space-10)">
			<a href="<?php echo esc_url($arquivo); ?>" target="_blank" rel="noopener noreferrer" class="ib-btn ib-btn--amazon" style="display:inline-flex;align-items:center;gap:var(--space-2);font-size:var(--text-base);padding:var(--space-3) var(--space-6)">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
				Baixar material
			</a>
		</div>
		<?php endif; ?>

		<?php echo \IrenilsonBarbosa\Core\AuthorBox::render_html(); ?>
	</div>
</div>
<?php
endwhile;
get_footer();
