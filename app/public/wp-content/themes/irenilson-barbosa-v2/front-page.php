<?php
/** IRENILSON BARBOSA — Home. Hero + Mais recentes + blocos por categoria. */
defined( 'ABSPATH' ) || exit;
get_header();

/* Destaques: 4 posts mais recentes. */
$featured = array();
$featured = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'fields' => 'ids', 'ignore_sticky_posts' => 1, 'suppress_filters' => false ) );
$lead      = isset( $featured[0] ) ? $featured[0] : 0;
$secondary = array_slice( $featured, 1, 3 );
$strip     = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'post__not_in' => $featured, 'fields' => 'ids', 'ignore_sticky_posts' => 1, 'suppress_filters' => false ) );
$editorias = ib_opt('home_cats');
if ( empty( $editorias ) ) {
	$editorias = array( 'filosofia', 'educacao', 'politica', 'cultura', 'cotidiano' );
}
?>

<main class="eh-home" id="main">

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
					<h1 class="eh-lead__title"><?php echo esc_html( get_the_title( $lead ) ); ?></h1>
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

			<!-- Col 3: listas empilhadas (livros + publicações) -->
			<div class="eh-hero-lists">
				<div class="eh-hero-list">
					<div class="eh-hero-list__head">Livros</div>
					<div class="eh-hero-list__items">
						<?php
						$hero_books = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish', 'post_type' => 'livro', 'fields' => 'ids', 'suppress_filters' => false ) );
						if ( ! empty( $hero_books ) ) :
							foreach ( $hero_books as $bid ) :
								$bthumb = get_the_post_thumbnail_url( $bid, 'ib-thumb' );
								$bparts = wp_get_post_terms( $bid, 'participacao', array( 'fields' => 'names' ) );
								$bpart = ! empty( $bparts ) ? $bparts[0] : '';
						?>
							<a class="eh-h-item" href="<?php echo esc_url( get_permalink( $bid ) ); ?>">
								<?php if ( $bthumb ) : ?>
									<span class="eh-h-item__img"><img src="<?php echo esc_url( $bthumb ); ?>" alt="" loading="lazy"></span>
								<?php endif; ?>
								<span class="eh-h-item__body">
									<span class="eh-h-item__t"><?php echo esc_html( get_the_title( $bid ) ); ?></span>
									<span class="eh-h-item__meta"><?php echo $bpart ? esc_html( $bpart ) : 'Livro'; ?></span>
								</span>
							</a>
						<?php endforeach; ?>
							<a class="eh-h-item eh-h-item--all" href="/livros/">Ver todos<span aria-hidden="true"> →</span></a>
						<?php else : ?>
							<p style="color:var(--tx-dim);font-size:var(--text-xs);padding:var(--space-3)">Nenhum livro cadastrado.</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="eh-hero-list">
					<div class="eh-hero-list__head">Publicações</div>
					<div class="eh-hero-list__items">
						<?php
						$hero_pubs = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish', 'post_type' => 'publicacao', 'fields' => 'ids', 'suppress_filters' => false ) );
						if ( ! empty( $hero_pubs ) ) :
							foreach ( $hero_pubs as $pid ) :
								$pparts = wp_get_post_terms( $pid, 'tipo-de-publicacao', array( 'fields' => 'names' ) );
								$ppart = ! empty( $pparts ) ? $pparts[0] : '';
						?>
							<a class="eh-h-item" href="<?php echo esc_url( get_permalink( $pid ) ); ?>">
								<span class="eh-h-item__body">
									<span class="eh-h-item__t"><?php echo esc_html( get_the_title( $pid ) ); ?></span>
									<span class="eh-h-item__meta"><?php echo $ppart ? esc_html( $ppart ) : 'Publicação'; ?></span>
								</span>
							</a>
						<?php endforeach; ?>
							<a class="eh-h-item eh-h-item--all" href="/publicacoes/">Ver todas<span aria-hidden="true"> →</span></a>
						<?php else : ?>
							<p style="color:var(--tx-dim);font-size:var(--text-xs);padding:var(--space-3)">Nenhuma publicação cadastrada.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php if ( ! empty( $strip ) ) : ?>
		<div class="wrap" style="margin-top:var(--space-6)">
			<div class="eh-sec-head"><h2>Mais recentes</h2></div>
			<div class="eh-strip-grid">
				<?php foreach ( $strip as $sid ) : ?>
					<a class="ib-rel-item" href="<?php echo esc_url( get_permalink( $sid ) ); ?>">
						<?php if ( has_post_thumbnail( $sid ) ) : ?>
							<span class="ib-rel-item__img">
								<?php echo get_the_post_thumbnail( $sid, 'ib-thumb', array( 'loading' => 'lazy' ) ); ?>
							</span>
						<?php endif; ?>
						<span class="ib-rel-item__body">
							<span class="ib-rel-item__t"><?php echo esc_html( get_the_title( $sid ) ); ?></span>
							<span class="ib-rel-item__date"><?php echo esc_html( human_time_diff( get_the_time( 'U', $sid ), current_time( 'timestamp' ) ) . ' atrás' ); ?></span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php
		$poems = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'post_type' => 'poiesis', 'fields' => 'ids' ) );
		if ( ! empty( $poems ) ) : ?>
		<div class="wrap" style="margin-top:var(--space-8)">
			<div class="eh-sec-head"><h2>Poiésis</h2><a href="/poiesis/">Ver todas<span aria-hidden="true"> →</span></a></div>
			<div class="eh-poem-grid">
				<?php foreach ( $poems as $pid ) : ?>
					<a class="eh-poem-card" href="<?php echo esc_url( get_permalink( $pid ) ); ?>">
						<h3 class="eh-poem-card__t"><?php echo esc_html( get_the_title( $pid ) ); ?></h3>
						<?php if ( has_excerpt( $pid ) ) : ?>
							<p class="eh-poem-card__ex"><?php echo esc_html( get_the_excerpt( $pid ) ); ?></p>
						<?php endif; ?>
						<span class="eh-poem-card__meta">Poema</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php $banner_img = ib_opt('banner_image'); if ($banner_img) : ?>
		<div class="wrap" style="margin-top:var(--space-10)">
			<a href="<?php echo esc_url( ib_opt('banner_link') ?: '#' ); ?>" class="ib-banner" target="_blank" rel="noopener" aria-label="Banner publicitário">
<picture>
				<?php $mob = ib_opt('banner_image_mobile'); if ($mob) : ?>
					<source media="(max-width:640px)" srcset="<?php echo esc_url($mob); ?>">
				<?php endif; ?>
				<?php $tab = ib_opt('banner_image_tablet'); if ($tab) : ?>
					<source media="(min-width:641px) and (max-width:1024px)" srcset="<?php echo esc_url($tab); ?>">
				<?php endif; ?>
				<img src="<?php echo esc_url($banner_img); ?>" alt="" width="1280" height="248" loading="lazy">
			</picture>
			</a>
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
					$ids = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish', 'category' => $term->term_id, 'fields' => 'ids', 'suppress_filters' => false ) );
					if ( empty( $ids ) ) { continue; }
					?>
					<div class="eh-sec-head">
						<h2><?php echo esc_html( $term->name ); ?></h2>
						<a href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">Ver tudo<span aria-hidden="true"> →</span></a>
					</div>
					<div class="ib-section-grid">
						<?php foreach ( $ids as $pid ) { ib_card( $pid ); } ?>
					</div>
				<?php endforeach; ?>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</section>

</main>

<?php get_footer(); ?>
