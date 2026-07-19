<?php
/** IRENILSON BARBOSA — Home. Hero + Mais recentes + blocos por categoria. */
defined( 'ABSPATH' ) || exit;
get_header();

/* Destaques: 4 posts mais recentes. */
$featured = array();
$featured = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'fields' => 'ids', 'ignore_sticky_posts' => 1, 'suppress_filters' => false ) );
$lead      = isset( $featured[0] ) ? $featured[0] : 0;
$secondary = array_slice( $featured, 1, 3 );
$strip     = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish', 'post__not_in' => $featured, 'fields' => 'ids', 'ignore_sticky_posts' => 1, 'suppress_filters' => false ) );
$editorias  = array( 'filosofia', 'educacao', 'politica', 'cultura', 'cotidiano' );
?>

<main class="eh-home">

	<?php if ( $lead ) :
		$lc = ib_primary_cat( $lead );
		$lt = get_the_post_thumbnail_url( $lead, 'full' );
		?>
	<section class="eh-hero">
		<div class="wrap eh-hero__grid">
			<a class="eh-lead<?php echo $lt ? '' : ' is-empty'; ?>" href="<?php echo esc_url( get_permalink( $lead ) ); ?>">
				<?php if ( $lt ) : ?><img src="<?php echo esc_url( $lt ); ?>" alt="" class="eh-lead__img"><?php endif; ?>
				<span class="eh-lead__body">
					<?php if ( $lc ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $lc->name ); ?></span><br><?php endif; ?>
					<span class="eh-lead__title"><?php echo esc_html( get_the_title( $lead ) ); ?></span>
				</span>
			</a>
			<?php
			$s = array_values( $secondary );
			if ( isset( $s[0] ) ) { ib_feat_card( $s[0], 'wide' ); }
			if ( isset( $s[1] ) ) { ib_feat_card( $s[1] ); }

			// Último card do hero: livro em destaque (se houver)
			$hero_book = get_posts( array( 'numberposts' => 1, 'post_status' => 'publish', 'post_type' => 'livro', 'fields' => 'ids', 'suppress_filters' => false ) );
			if ( ! empty( $hero_book ) ) :
				$bid = $hero_book[0];
				$bthumb = get_the_post_thumbnail_url( $bid, 'ib-card' );
				$blink = get_permalink( $bid );
				$bamazon = get_post_meta( $bid, 'link_amazon', true );
			?>
				<a class="eh-feat<?php echo $bthumb ? '' : ' is-empty'; ?>" href="<?php echo esc_url( $blink ); ?>" aria-label="<?php echo esc_attr( get_the_title( $bid ) ); ?>">
					<?php if ( $bthumb ) : ?><img src="<?php echo esc_url( $bthumb ); ?>" alt="" class="eh-feat__img"><?php endif; ?>
					<span class="eh-feat__body">
						<span class="en-tag en-tag--solid" style="background:var(--accent)">📖 Livro</span><br>
						<span class="eh-feat__t"><?php echo esc_html( get_the_title( $bid ) ); ?></span>
					</span>
				</a>
			<?php elseif ( isset( $s[2] ) ) : ib_feat_card( $s[2] );
			endif; ?>

		</div>

		<?php if ( ! empty( $strip ) ) : ?>
		<div class="wrap">
			<div class="eh-strip">
				<div class="eh-strip__label"><span>▲</span>Mais recentes</div>
				<div class="eh-strip__items">
					<?php $n = 1; foreach ( $strip as $sid ) : ?>
						<a href="<?php echo esc_url( get_permalink( $sid ) ); ?>"><span class="eh-strip__n"><?php echo (int) $n++; ?></span><?php echo esc_html( get_the_title( $sid ) ); ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</section>
	<?php endif; ?>

	<section class="eh-main">
		<div class="wrap eh-layout">
			<div class="eh-content">
				<?php
				foreach ( $editorias as $slug ) :
					$term = get_term_by( 'slug', $slug, 'category' );
					if ( ! $term || is_wp_error( $term ) ) { continue; }
					$ids = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'category' => $term->term_id, 'fields' => 'ids', 'suppress_filters' => false ) );
					if ( empty( $ids ) ) { continue; }
					?>
					<div class="eh-sec-head">
						<h2><?php echo esc_html( $term->name ); ?></h2>
						<a href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">Ver tudo →</a>
					</div>
					<div class="eh-cards">
						<?php foreach ( $ids as $pid ) { ib_card( $pid ); } ?>
					</div>
				<?php endforeach; ?>

				<?php
				// Publicações
				$pub_ids = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish', 'post_type' => 'publicacao', 'fields' => 'ids', 'suppress_filters' => false ) );
				if ( $pub_ids ) : ?>
					<div class="eh-sec-head">
						<h2>Publicações</h2>
						<a href="/publicacoes/">Ver todas →</a>
					</div>
					<div class="eh-cards">
						<?php foreach ( $pub_ids as $pid ) { ib_card( $pid ); } ?>
					</div>
				<?php endif; ?>


			</div>

				<?php
				$livro_ids = get_posts( array( 'numberposts' => 2, 'post_status' => 'publish', 'post_type' => 'livro', 'fields' => 'ids', 'suppress_filters' => false ) );
				if ( ! empty( $livro_ids ) ) : ?>
					<div class="eh-sec-head">
						<h2>Livros</h2>
						<a href="/livros/">Ver todos →</a>
					</div>
					<div class="eh-cards">
						<?php foreach ( $livro_ids as $pid ) { ib_card( $pid ); } ?>
					</div>
				<?php endif; ?>

			<?php get_sidebar(); ?>
		</div>
	</section>

</main>

<?php get_footer(); ?>
