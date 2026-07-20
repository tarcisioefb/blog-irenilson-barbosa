<?php
/** IRENILSON BARBOSA — arquivo (categoria, tag, data, autor). */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="wrap" id="main">
	<?php ib_breadcrumb(); ?>
	<header class="arch-head">
		<span class="kick"><?php
			if ( is_category() ) { echo 'Editoria'; }
			elseif ( is_tag() ) { echo 'Tag'; }
			elseif ( is_author() ) { echo 'Autor'; }
			elseif ( is_date() ) { echo 'Arquivo'; }
			else { echo 'Arquivo'; }
		?></span>
		<h1><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
	</header>
</div>

<div class="wrap arch-layout">
	<div class="arch-content">
		<?php if ( have_posts() ) : ?>
			<div class="arch-grid">
				<?php while ( have_posts() ) : the_post(); ib_card( get_the_ID() ); endwhile; ?>
			</div>
			<?php echo '<div class="pagination">' . paginate_links( array( 'mid_size' => 2, 'prev_text' => '‹', 'next_text' => '›' ) ) . '</div>'; ?>
		<?php else : ?>
			<p>Nenhuma matéria encontrada nesta seção.</p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
