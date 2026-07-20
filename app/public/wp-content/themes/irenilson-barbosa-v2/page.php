<?php
/** IRENILSON BARBOSA — página (Sobre, Contato…). */
defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) : the_post(); ?>
	<div class="wrap single-wrap" id="main">
		<?php ib_breadcrumb(); ?>
		<article class="article" style="max-width:820px;margin:0 auto">
			<h1 class="article__title"><?php the_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?><figure class="article__hero"><?php the_post_thumbnail( 'full' ); ?></figure><?php endif; ?>
			<div class="article__body"><?php the_content(); wp_link_pages(); ?></div>
			<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
		</article>
	</div>
<?php endwhile;
get_footer();
