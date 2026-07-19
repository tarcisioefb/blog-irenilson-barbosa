<?php
/** IRENILSON BARBOSA — Arquivo Poiésis. */
defined('ABSPATH') || exit;
get_header(); ?>
<div class="wrap" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);font-weight:400;color:var(--ink);margin:0 0 var(--space-2)">Poiésis</h1>
	<p style="color:var(--tx-2);margin:0 0 var(--space-8);font-size:var(--text-md)">Poesia, criação e pensamento lírico.</p>

	<?php if (have_posts()) : ?>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:var(--space-6)">
			<?php while (have_posts()) : the_post(); ?>
				<article style="text-align:center;padding:var(--space-6);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md);transition:box-shadow .25s" onmouseover="this.style.boxShadow='var(--shadow-card)'" onmouseout="this.style.boxShadow=''">
					<a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit">
						<h2 style="font-family:var(--font-heading);font-size:var(--text-lg);font-weight:500;color:var(--ink);margin:0 0 var(--space-2);line-height:var(--leading-tight)"><?php the_title(); ?></h2>
						<?php if (has_excerpt()) : ?>
							<p style="font-size:var(--text-sm);color:var(--tx-dim);font-style:italic;margin:0 0 var(--space-3);line-height:var(--leading-snug)"><?php echo esc_html(get_the_excerpt()); ?></p>
						<?php endif; ?>
						<span style="font-size:var(--text-xs);color:var(--tx-dim)"><?php echo esc_html(get_the_date('j F Y')); ?></span>
					</a>
				</article>
			<?php endwhile; ?>
		</div>
		<div style="margin-top:var(--space-10)"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p style="color:var(--tx-dim)">Nenhum poema publicado ainda.</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
