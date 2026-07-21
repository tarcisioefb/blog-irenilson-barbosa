<?php
/** IRENILSON BARBOSA — Arquivo de Livros (vitrine de produtos). */
defined('ABSPATH') || exit;
get_header(); ?>
<div class="wrap" id="main" style="padding-top:16px;padding-bottom:var(--space-10)">
	<?php ib_breadcrumb(); ?>
	<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);color:var(--ink);margin:0 0 var(--space-2)">Livros</h1>
	<p style="color:var(--tx-2);margin:0 0 var(--space-8);font-size:var(--text-md)">Obras de Irenilson Barbosa — autor, organizador e coautor.</p>

	<?php if (have_posts()) : ?>
		<div class="ib-book-archive-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:var(--space-7)">
			<?php while (have_posts()) : the_post();
				$pid = get_the_ID();
				$ano = get_post_meta($pid, 'ano', true);
				$editora = get_post_meta($pid, 'editora', true);
				$participacao = wp_get_post_terms($pid, 'participacao', ['fields' => 'names']);
				$part_label = !empty($participacao) ? $participacao[0] : 'Autor';
			?>
				<article class="ib-book-card">
					<a href="<?php the_permalink(); ?>" style="display:block;text-decoration:none;color:inherit">
						<?php if (has_post_thumbnail()) : ?>
							<div style="aspect-ratio:2/3;overflow:hidden;background:var(--page)">
								<?php the_post_thumbnail('full', ['style' => 'width:100%;height:100%;object-fit:cover;transition:transform .4s']); ?>
							</div>
						<?php endif; ?>
						<div style="padding:var(--space-5)">
							<div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:var(--space-2)">
								<span class="en-tag en-tag--solid"><?php echo esc_html($part_label); ?></span>
								<?php if ($ano) : ?><span style="font-size:var(--text-xs);color:var(--tx-dim);padding:3px 0"><?php echo esc_html($ano); ?></span><?php endif; ?>
							</div>
							<h2 style="font-family:var(--font-heading);font-size:var(--text-17);font-weight:var(--weight-bold);color:var(--ink);margin:0 0 6px;line-height:var(--leading-snug)"><?php the_title(); ?></h2>
							<?php if ($editora) : ?><p style="font-size:var(--text-13);color:var(--tx-2);margin:0"><?php echo esc_html($editora); ?></p><?php endif; ?>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>

		<div style="margin-top:var(--space-10)"><?php the_posts_pagination(); ?></div>

	<?php else : ?>
		<p style="color:var(--tx-dim)">Nenhum livro cadastrado ainda.</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
