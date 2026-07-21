<?php
/** IRENILSON BARBOSA — arquivo (categoria, tag, data, autor). */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="wrap" id="main" style="padding-top:16px;padding-bottom:var(--space-6)">
	<?php ib_breadcrumb(); ?>
	<div class="arch-hero">
		<p class="arch-hero__kick"><?php
			if ( is_category() ) { echo 'Editoria'; }
			elseif ( is_tag() ) { echo 'Tag'; }
			elseif ( is_author() ) { echo 'Autor'; }
			elseif ( is_date() ) { echo 'Arquivo'; }
			elseif ( is_post_type_archive('publicacao') ) { echo 'Produção acadêmica'; }
			elseif ( is_post_type_archive('material') ) { echo 'Recursos'; }
			else { echo 'Arquivo'; }
		?></p>
		<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);font-weight:700;color:var(--ink);margin:0 0 var(--space-4);line-height:var(--leading-tight)"><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
		<?php $desc = get_the_archive_description(); if ($desc) : ?><p class="arch-hero__desc"><?php echo $desc; ?></p><?php endif; ?>
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
			<p>Nenhuma matéria encontrada nesta seção.</p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
