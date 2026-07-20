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
							<a class="eh-h-item eh-h-item--all" href="/livros/">Ver todos →</a>
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
							<a class="eh-h-item eh-h-item--all" href="/publicacoes/">Ver todas →</a>
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
			<div class="eh-sec-head"><h2>Poiésis</h2><a href="/poiesis/">Ver todas →</a></div>
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
			<a href="<?php echo esc_url( ib_opt('banner_link') ?: '#' ); ?>" class="ib-banner" target="_blank" rel="noopener">
				<picture>
					<?php $tab = ib_opt('banner_image_tablet'); if ($tab) : ?>
						<source media="(max-width:1024px)" srcset="<?php echo esc_url($tab); ?>">
					<?php endif; ?>
					<?php $mob = ib_opt('banner_image_mobile'); if ($mob) : ?>
						<source media="(max-width:640px)" srcset="<?php echo esc_url($mob); ?>">
					<?php endif; ?>
					<img src="<?php echo esc_url($banner_img); ?>" alt="" loading="lazy">
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
				$sec_i = 0;
				$layouts = array( 'mosaic', 'grid3', 'list', 'inverted' );
				foreach ( $editorias as $slug ) :
					$term = get_term_by( 'slug', $slug, 'category' );
					if ( ! $term || is_wp_error( $term ) ) { continue; }
					$ids = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'category' => $term->term_id, 'fields' => 'ids', 'suppress_filters' => false ) );
					if ( empty( $ids ) ) { continue; }
					$layout = $layouts[ $sec_i % count( $layouts ) ];
					$sec_i++;
					?>
					<div class="eh-sec-head">
						<h2><?php echo esc_html( $term->name ); ?></h2>
						<a href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">Ver tudo →</a>
					</div>

					<?php if ( 'mosaic' === $layout ) : ?>
					<!-- MOSAICO: 1 card 2fr + 2 cards empilhados 1fr -->
					<div class="ib-mosaic">
						<div class="ib-mosaic__lead">
							<article class="eh-card eh-card--lead">
								<a class="eh-card__imgwrap eh-card__imgwrap--lead" href="<?php echo esc_url( get_permalink( $ids[0] ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $ids[0] ) ); ?>">
									<?php if ( has_post_thumbnail( $ids[0] ) ) : ?><img src="<?php echo esc_url( get_the_post_thumbnail_url( $ids[0], 'large' ) ); ?>" alt="" loading="lazy"><?php endif; ?>
									<?php $lc = ib_primary_cat( $ids[0] ); if ( $lc ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $lc->name ); ?></span><?php endif; ?>
								</a>
								<h3 class="eh-card__t"><a href="<?php echo esc_url( get_permalink( $ids[0] ) ); ?>"><?php echo esc_html( get_the_title( $ids[0] ) ); ?></a></h3>
							</article>
						</div>
						<div class="ib-mosaic__side">
							<?php for ( $i = 1; $i < min( 3, count( $ids ) ); $i++ ) : ?>
								<article class="eh-card eh-card--side">
									<a class="eh-card__imgwrap" href="<?php echo esc_url( get_permalink( $ids[ $i ] ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $ids[ $i ] ) ); ?>">
										<?php if ( has_post_thumbnail( $ids[ $i ] ) ) : ?><img src="<?php echo esc_url( get_the_post_thumbnail_url( $ids[ $i ], 'ib-card' ) ); ?>" alt="" loading="lazy"><?php endif; ?>
										<?php $sc = ib_primary_cat( $ids[ $i ] ); if ( $sc ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $sc->name ); ?></span><?php endif; ?>
									</a>
									<h3 class="eh-card__t"><a href="<?php echo esc_url( get_permalink( $ids[ $i ] ) ); ?>"><?php echo esc_html( get_the_title( $ids[ $i ] ) ); ?></a></h3>
								</article>
							<?php endfor; ?>
						</div>
					</div>

					<?php elseif ( 'grid3' === $layout ) : ?>
					<!-- GRID 3 COLUNAS: cards compactos -->
					<div class="ib-grid3">
						<?php foreach ( $ids as $pid ) : ?>
							<article class="eh-card eh-card--compact">
								<a class="eh-card__imgwrap eh-card__imgwrap--compact" href="<?php echo esc_url( get_permalink( $pid ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $pid ) ); ?>">
									<?php if ( has_post_thumbnail( $pid ) ) : ?><img src="<?php echo esc_url( get_the_post_thumbnail_url( $pid, 'ib-card' ) ); ?>" alt="" loading="lazy"><?php endif; ?>
									<?php $gc = ib_primary_cat( $pid ); if ( $gc ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $gc->name ); ?></span><?php endif; ?>
								</a>
								<h3 class="eh-card__t"><?php echo esc_html( get_the_title( $pid ) ); ?></h3>
							</article>
						<?php endforeach; ?>
					</div>

					<?php elseif ( 'list' === $layout ) : ?>
					<!-- LISTA TEXTUAL: thumbnail + título + excerpt, sem badge -->
					<div class="ib-text-list">
						<?php foreach ( $ids as $pid ) : ?>
						<a class="ib-text-item" href="<?php echo esc_url( get_permalink( $pid ) ); ?>">
							<?php if ( has_post_thumbnail( $pid ) ) : ?>
								<span class="ib-text-item__img"><?php echo get_the_post_thumbnail( $pid, 'ib-thumb', array( 'loading' => 'lazy' ) ); ?></span>
							<?php endif; ?>
							<span class="ib-text-item__body">
								<span class="ib-text-item__t"><?php echo esc_html( get_the_title( $pid ) ); ?></span>
								<span class="ib-text-item__ex"><?php echo esc_html( wp_trim_words( get_the_excerpt( $pid ), 18, '…' ) ); ?></span>
								<span class="ib-text-item__date"><?php echo esc_html( get_the_date( 'j F Y', $pid ) ); ?></span>
							</span>
						</a>
						<?php endforeach; ?>
					</div>

					<?php else : ?>
					<!-- MOSAICO INVERTIDO: 1 card retrato + 2 cards horizontais -->
					<div class="ib-inverted">
						<div class="ib-inverted__portrait">
							<article class="eh-card eh-card--portrait">
								<a class="eh-card__imgwrap eh-card__imgwrap--portrait" href="<?php echo esc_url( get_permalink( $ids[0] ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $ids[0] ) ); ?>">
									<?php if ( has_post_thumbnail( $ids[0] ) ) : ?><img src="<?php echo esc_url( get_the_post_thumbnail_url( $ids[0], 'medium' ) ); ?>" alt="" loading="lazy"><?php endif; ?>
									<?php $ic = ib_primary_cat( $ids[0] ); if ( $ic ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $ic->name ); ?></span><?php endif; ?>
								</a>
								<h3 class="eh-card__t"><a href="<?php echo esc_url( get_permalink( $ids[0] ) ); ?>"><?php echo esc_html( get_the_title( $ids[0] ) ); ?></a></h3>
							</article>
						</div>
						<div class="ib-inverted__stack">
							<?php for ( $i = 1; $i < min( 3, count( $ids ) ); $i++ ) : ?>
								<article class="eh-card eh-card--side">
									<a class="eh-card__imgwrap" href="<?php echo esc_url( get_permalink( $ids[ $i ] ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $ids[ $i ] ) ); ?>">
										<?php if ( has_post_thumbnail( $ids[ $i ] ) ) : ?><img src="<?php echo esc_url( get_the_post_thumbnail_url( $ids[ $i ], 'ib-card' ) ); ?>" alt="" loading="lazy"><?php endif; ?>
										<?php $kc = ib_primary_cat( $ids[ $i ] ); if ( $kc ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $kc->name ); ?></span><?php endif; ?>
									</a>
									<h3 class="eh-card__t"><a href="<?php echo esc_url( get_permalink( $ids[ $i ] ) ); ?>"><?php echo esc_html( get_the_title( $ids[ $i ] ) ); ?></a></h3>
								</article>
							<?php endfor; ?>
						</div>
					</div>
					<?php endif; ?>

				<?php endforeach; ?>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</section>

</main>

<?php get_footer(); ?>
