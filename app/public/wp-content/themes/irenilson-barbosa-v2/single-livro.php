<?php
/** IRENILSON BARBOSA — Single Livro (página de produto). */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post();
	$pid = get_the_ID();
	$isbn = get_post_meta($pid, 'isbn', true);
	$ano = get_post_meta($pid, 'ano', true);
	$editora = get_post_meta($pid, 'editora', true);
	$paginas = get_post_meta($pid, 'numero_paginas', true);
	$comprar = get_post_meta($pid, 'comprar_links', true);
	$links = [];
	if ($comprar) {
		foreach (explode("\n", $comprar) as $linha) {
			$linha = trim($linha);
			if (!$linha) continue;
			$parts = explode('|', $linha, 2);
			if (count($parts) === 2) {
				$links[] = ['texto' => trim($parts[0]), 'url' => trim($parts[1])];
			}
		}
	}
	$participacao = wp_get_post_terms($pid, 'participacao', ['fields' => 'names']);
	$part_label = !empty($participacao) ? $participacao[0] : 'Autor';
?>
<div class="wrap single-wrap" id="main">
	<?php ib_breadcrumb(); ?>

	<?php if (has_post_thumbnail()) : ?>
	<div style="display:grid;grid-template-columns:minmax(0,300px) minmax(0,1fr);gap:clamp(var(--space-6),4vw,var(--space-10));align-items:start;margin-bottom:var(--space-10)">
		<div style="position:sticky;top:140px">
			<div style="border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-hero);background:#fff">
				<?php the_post_thumbnail('full', ['style' => 'width:100%;height:auto;display:block']); ?>
			</div>
		</div>
		<div>
	<?php endif; ?>

			<div style="display:flex;gap:var(--space-2);flex-wrap:wrap;margin-bottom:var(--space-3)">
				<span class="en-tag en-tag--solid"><?php echo esc_html($part_label); ?></span>
				<?php if ($ano) : ?><span class="en-tag" style="background:var(--accent-2)"><?php echo esc_html($ano); ?></span><?php endif; ?>
			</div>

			<h1 class="article__title" style="margin-bottom:var(--space-5)"><?php the_title(); ?></h1>

			<div class="article__body" style="max-width:none"><?php the_content(); ?></div>

			<?php if ($links) : ?>
			<div style="display:flex;gap:var(--space-3);flex-wrap:wrap;margin:var(--space-6) 0">
				<?php foreach ($links as $lk) : ?>
				<a href="<?php echo esc_url($lk['url']); ?>" target="_blank" rel="noopener noreferrer" class="ib-btn ib-btn--amazon" style="flex:1;min-width:180px;max-width:320px">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
					<?php echo esc_html($lk['texto']); ?>
				</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-3);margin:var(--space-6) 0;padding:var(--space-5);background:var(--paper-2);border-radius:var(--radius-md);font-size:var(--text-15)">
				<?php if ($editora) : ?><div><strong style="color:var(--ink)">Editora</strong><br><span style="color:var(--tx-2)"><?php echo esc_html($editora); ?></span></div><?php endif; ?>
				<?php if ($ano) : ?><div><strong style="color:var(--ink)">Ano</strong><br><span style="color:var(--tx-2)"><?php echo esc_html($ano); ?></span></div><?php endif; ?>
				<?php if ($isbn) : ?><div><strong style="color:var(--ink)">ISBN</strong><br><span style="color:var(--tx-2)"><?php echo esc_html($isbn); ?></span></div><?php endif; ?>
				<?php if ($paginas) : ?><div><strong style="color:var(--ink)">Páginas</strong><br><span style="color:var(--tx-2)"><?php echo (int) $paginas; ?></span></div><?php endif; ?>
			</div>

			<?php echo \IrenilsonBarbosa\Core\AuthorBox::render_html(); ?>

	<?php if (has_post_thumbnail()) : ?>
		</div>
	</div>
	<?php endif; ?>

</div>
<?php
endwhile;
get_footer();
