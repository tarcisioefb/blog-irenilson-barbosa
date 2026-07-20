<?php
/** IRENILSON BARBOSA — Página Sobre. */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post(); ?>
<div class="wrap" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<article style="max-width:820px;margin:0 auto">
		<div style="display:grid;grid-template-columns:280px 1fr;gap:var(--space-8);align-items:start;margin-bottom:var(--space-10)">
			<div style="position:sticky;top:140px">
				<img src="http://irenilson-barbosa.local/wp-content/uploads/2026/07/Irenilson-Barbosa-Retrato.avif" alt="Irenilson Barbosa" style="width:100%;height:auto;border-radius:var(--radius-lg);display:block;box-shadow:var(--shadow-card)">
			</div>
			<div>
				<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);font-weight:500;color:var(--ink);margin:0 0 var(--space-1);line-height:var(--leading-tight)">Irenilson Barbosa</h1>
				<p style="font-size:var(--text-base);color:var(--tx-dim);margin:0 0 var(--space-6)">Professor, escritor e pesquisador</p>
				<div class="article__body" style="max-width:none"><?php the_content(); ?></div>
			</div>
		</div>
	</article>
</div>
<?php
endwhile;
get_footer();
