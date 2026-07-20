<?php
/** IRENILSON BARBOSA — Arquivo Poiésis. */
defined('ABSPATH') || exit;
get_header(); ?>
<div class="wrap" id="main" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<?php ib_breadcrumb(); ?>
	<!-- Hero -->
	<div style="padding:var(--space-10) var(--space-8);background:linear-gradient(135deg,var(--paper-2) 0%,var(--paper) 100%);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-lg);margin-bottom:var(--space-10);text-align:center">
		<p style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-widest);font-weight:700;margin:0 0 var(--space-3)">Ποίησις</p>
		<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);font-weight:400;color:var(--ink);margin:0 0 var(--space-4);line-height:var(--leading-tight)">Poiésis</h1>
		<p style="max-width:640px;margin:0 auto;font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2)">Poiésis é uma palavra polissêmica de origem grega. Ela denota, entre outras coisas, a ação ou a capacidade de produzir ou fazer algo de forma criativa. Nos escritos de Platão é possível entender a poíésis como processo criativo, conhecimento e aprendizado lúdico — ação que converte o "não ser" em "ser".</p>
	</div>

	<?php if (have_posts()) : ?>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:var(--space-6)">
			<?php while (have_posts()) : the_post(); ?>
				<article class="ib-poem-card" style="text-align:center;padding:var(--space-6);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md);transition:box-shadow .25s">
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
