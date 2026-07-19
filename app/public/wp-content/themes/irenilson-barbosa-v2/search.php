<?php
/** IRENILSON BARBOSA — resultados de busca. */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="wrap">
	<?php ib_breadcrumb(); ?>
	<header class="arch-head"><span class="kick">Busca</span><h1>Resultados para “<?php echo esc_html( get_search_query() ); ?>”</h1></header>
</div>
<div class="wrap arch-layout">
	<div class="arch-content">
		<?php if ( have_posts() ) : ?>
			<div class="arch-grid">
				<?php while ( have_posts() ) : the_post(); ib_card( get_the_ID() ); endwhile; ?>
			</div>
			<?php echo '<div class="pagination">' . paginate_links( array( 'mid_size' => 2, 'prev_text' => '‹', 'next_text' => '›' ) ) . '</div>'; ?>
		<?php else : ?>
			<p>Nenhuma matéria encontrada para “<?php echo esc_html( get_search_query() ); ?>”. Tente outros termos.</p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
