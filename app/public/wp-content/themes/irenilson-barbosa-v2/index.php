<?php
/** IRENILSON BARBOSA — fallback (blog / últimas notícias). */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="wrap" style="padding-top:16px">
	<div class="arch-hero">
		<p class="arch-hero__kick">Artigos</p>
		<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);font-weight:700;color:var(--ink);margin:0 0 var(--space-4);line-height:var(--leading-tight)">Últimas notícias</h1>
		<p class="arch-hero__desc">Ensaios, reflexões e artigos sobre filosofia, educação, política, cultura e cotidiano.</p>
	</div>
</div>
<div class="wrap arch-layout">
	<div class="arch-content">
		<?php if ( have_posts() ) : ?>
			<div class="arch-grid">
				<?php while ( have_posts() ) : the_post(); ib_card( get_the_ID() ); endwhile; ?>
			</div>
			<?php echo '<div class="pagination">' . paginate_links( array( 'mid_size' => 2, 'prev_text' => '<span aria-hidden="true">‹</span><span class="screen-reader-text">Anterior</span>', 'next_text' => '<span class="screen-reader-text">Próximo</span><span aria-hidden="true">›</span>' ) ) . '</div>'; ?>
		<?php else : ?>
			<p>Nenhuma matéria publicada ainda.</p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
