<?php
/** ELITE NOTÍCIAS — matéria (single). */
defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) : the_post();
	$pid  = get_the_ID();
	$cat  = ib_primary_cat( $pid );
	$words = str_word_count( wp_strip_all_tags( get_the_content() ) );
	$mins  = max( 1, (int) round( $words / 200 ) );
	?>
	<div class="wrap single-wrap">
		<?php ib_breadcrumb(); ?>

		<div class="article-layout">
			<article <?php post_class( 'article' ); ?>>
				<?php if ( $cat ) : ?>
					<div class="article__cat"><a class="en-tag en-tag--solid" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></div>
				<?php endif; ?>

				<h1 class="article__title"><?php the_title(); ?></h1>

				<div class="article__meta">
					<span>por <b>Elite Notícias</b></span>
					<span><?php echo esc_html( get_the_date() ); ?></span>
					<?php if ( $cat ) : ?><span>em <b><?php echo esc_html( $cat->name ); ?></b></span><?php endif; ?>
					<span><?php echo (int) $mins; ?> min de leitura</span>
					<?php if ( comments_open() || get_comments_number() ) : ?><span><?php echo (int) get_comments_number(); ?> comentário(s)</span><?php endif; ?>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="article__hero"><?php the_post_thumbnail( 'full' ); if ( get_the_post_thumbnail_caption() ) : ?><figcaption><?php the_post_thumbnail_caption(); ?></figcaption><?php endif; ?></figure>
				<?php endif; ?>

				<?php ib_share_buttons( $pid ); ?>

				<div class="article__body"><?php the_content(); wp_link_pages(); ?></div>

				<div class="article-section-divider"></div>

				<?php if ( has_tag() ) : ?>
					<div class="tags"><span class="tags__label">Tags</span><?php echo get_the_tag_list( '', '' ); ?></div>
				<?php endif; ?>

				<?php ib_share_buttons( $pid ); ?>

				<?php
				// Relacionados (mesma editoria)
				if ( $cat ) :
					$rel = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish', 'category' => $cat->term_id, 'post__not_in' => array( $pid ), 'fields' => 'ids', 'suppress_filters' => false ) );
					if ( ! empty( $rel ) ) : ?>
						<div class="article-section-divider"></div>
						<section class="related">
							<h2>Leia também</h2>
							<div class="related__grid"><?php foreach ( $rel as $rid ) { ib_card( $rid ); } ?></div>
						</section>
					<?php endif;
				endif;
				?>

				<?php if ( comments_open() || get_comments_number() ) { ?><div class="article-section-divider"></div><?php comments_template(); } ?>
			<script>fetch('/wp-json/elite/v1/view',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({post_id:<?php echo (int) $pid; ?>})});</script>
			</article>

			<?php get_sidebar(); ?>
		</div>
	</div>
	<?php
endwhile;
get_footer();
