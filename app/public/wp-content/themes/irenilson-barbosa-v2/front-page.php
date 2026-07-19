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
			<!-- Lead: col 1, rows 1-2 -->
			<a class="eh-lead<?php echo $lt ? '' : ' is-empty'; ?>" href="<?php echo esc_url( get_permalink( $lead ) ); ?>">
				<?php if ( $lt ) : ?><img src="<?php echo esc_url( $lt ); ?>" alt="" class="eh-lead__img"><?php endif; ?>
				<span class="eh-lead__body">
					<?php if ( $lc ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $lc->name ); ?></span><br><?php endif; ?>
					<span class="eh-lead__title"><?php echo esc_html( get_the_title( $lead ) ); ?></span>
				</span>
			</a>

			<!-- Col 2: dois cards empilhados -->
			<?php
			$s = array_values( $secondary );
			if ( isset( $s[0] ) ) : ?>
				<div class="eh-feat-stack">
					<?php ib_feat_card( $s[0] );
					if ( isset( $s[1] ) ) ib_feat_card( $s[1] ); ?>
				</div>
			<?php endif; ?>

			<!-- Col 3: listagem de livros -->
			<div class="eh-book-list">
				<div class="eh-book-list__head">Livros</div>
				<?php
				$hero_books = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'post_type' => 'livro', 'fields' => 'ids', 'suppress_filters' => false ) );
				if ( ! empty( $hero_books ) ) :
					foreach ( $hero_books as $bid ) :
						$bthumb = get_the_post_thumbnail_url( $bid, 'ib-thumb' );
						$bparts = wp_get_post_terms( $bid, 'participacao', array( 'fields' => 'names' ) );
						$bpart = ! empty( $bparts ) ? $bparts[0] : '';
				?>
					<a class="eh-book-item" href="<?php echo esc_url( get_permalink( $bid ) ); ?>">
						<?php if ( $bthumb ) : ?>
							<span class="eh-book-item__img"><img src="<?php echo esc_url( $bthumb ); ?>" alt="" loading="lazy"></span>
						<?php endif; ?>
						<span class="eh-book-item__body">
							<span class="eh-book-item__t"><?php echo esc_html( get_the_title( $bid ) ); ?></span>
							<span class="eh-book-item__meta"><?php echo $bpart ? esc_html( $bpart ) : 'Livro'; ?></span>
						</span>
					</a>
				<?php endforeach; ?>
					<a class="eh-book-item eh-book-item--all" href="/livros/">Ver todos os livros →</a>
				<?php else : ?>
					<p style="color:var(--tx-dim);font-size:var(--text-sm);padding:var(--space-4)">Nenhum livro cadastrado.</p>
				<?php endif; ?>
			</div>
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
