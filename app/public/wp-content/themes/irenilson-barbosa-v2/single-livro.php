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
	$link_amazon = get_post_meta($pid, 'link_amazon', true);
	$link_marinete = get_post_meta($pid, 'link_marinete', true);
	$participacao = wp_get_post_terms($pid, 'participacao', ['fields' => 'names']);
	$part_label = !empty($participacao) ? $participacao[0] : 'Autor';
?>
<div class="wrap single-wrap">
	<div class="article-layout" style="grid-template-columns:minmax(0,1fr)">
		<article <?php post_class('article'); ?>>
			<div style="display:grid;grid-template-columns:340px 1fr;gap:var(--space-10);align-items:start">
				<div>
					<?php if (has_post_thumbnail()) : ?>
						<div style="border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-hero);background:#fff">
							<?php the_post_thumbnail('full', ['style' => 'width:100%;height:auto;display:block']); ?>
						</div>
					<?php endif; ?>
				</div>

				<div>
					<div style="display:flex;gap:var(--space-2);flex-wrap:wrap;margin-bottom:var(--space-3)">
						<span class="en-tag en-tag--solid"><?php echo esc_html($part_label); ?></span>
						<?php if ($ano) : ?><span class="en-tag" style="background:var(--tx-dim)"><?php echo esc_html($ano); ?></span><?php endif; ?>
					</div>

					<h1 class="article__title" style="margin-bottom:var(--space-2)"><?php the_title(); ?></h1>
					<p style="font-size:var(--text-md);color:var(--tx-2);margin:0 0 var(--space-5)"><?php echo esc_html($part_label === 'Autor' ? 'Por Irenilson Barbosa' : 'Irenilson Barbosa (' . $part_label . ')'); ?></p>

					<div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-3);margin-bottom:var(--space-6);padding:var(--space-5);background:var(--paper-2);border-radius:var(--radius-md);font-size:var(--text-15)">
						<?php if ($editora) : ?><div><strong style="color:var(--ink)">Editora</strong><br><span style="color:var(--tx-2)"><?php echo esc_html($editora); ?></span></div><?php endif; ?>
						<?php if ($ano) : ?><div><strong style="color:var(--ink)">Ano</strong><br><span style="color:var(--tx-2)"><?php echo esc_html($ano); ?></span></div><?php endif; ?>
						<?php if ($isbn) : ?><div><strong style="color:var(--ink)">ISBN</strong><br><span style="color:var(--tx-2)"><?php echo esc_html($isbn); ?></span></div><?php endif; ?>
						<?php if ($paginas) : ?><div><strong style="color:var(--ink)">Páginas</strong><br><span style="color:var(--tx-2)"><?php echo (int) $paginas; ?></span></div><?php endif; ?>
					</div>

					<div class="article__body" style="max-width:none"><?php the_content(); ?></div>

					<div style="display:flex;gap:var(--space-3);flex-wrap:wrap;margin-top:var(--space-7)">
						<?php if ($link_amazon) : ?>
							<a href="<?php echo esc_url($link_amazon); ?>" target="_blank" rel="noopener noreferrer" class="ib-btn ib-btn--amazon">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
								Comprar na Amazon
							</a>
						<?php endif; ?>
						<?php if ($link_marinete) : ?>
							<a href="<?php echo esc_url($link_marinete); ?>" target="_blank" rel="noopener noreferrer" class="ib-btn ib-btn--marinete">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
								Comprar na Marinete
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</div>
<?php
endwhile;
get_footer();
