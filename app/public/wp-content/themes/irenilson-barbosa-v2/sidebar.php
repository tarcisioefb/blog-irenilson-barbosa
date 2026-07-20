<?php
/** IRENILSON BARBOSA — sidebar. */
defined( 'ABSPATH' ) || exit;
?>
<aside class="eh-aside">
	<?php if ( ! is_singular( 'post' ) ) : ?>
	<div class="eh-widget">
		<span class="eh-widget__head">Sobre</span>
		<div style="font-size:0.9rem;color:var(--tx-2);line-height:1.7">
			<p><strong style="color:var(--ink)">Irenilson Barbosa</strong> <?php echo esc_html( ib_opt( 'sidebar_bio' ) ?: 'Professor universitário, escritor e pesquisador.' ); ?></p>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( is_singular( 'post' ) ) :
		$rel_ids = \IrenilsonBarbosa\Core\RelatedPosts::get_ids( get_the_ID(), 4 );
		if ( ! empty( $rel_ids ) ) : ?>
			<div class="eh-widget">
				<span class="eh-widget__head">Leia também</span>
				<div class="ib-rel-list">
					<?php foreach ( $rel_ids as $rid ) : ?>
						<a class="ib-rel-item" href="<?php echo esc_url( get_permalink( $rid ) ); ?>">
							<?php if ( has_post_thumbnail( $rid ) ) : ?>
								<span class="ib-rel-item__img">
									<?php echo get_the_post_thumbnail( $rid, 'ib-thumb', array( 'loading' => 'lazy' ) ); ?>
								</span>
							<?php endif; ?>
							<span class="ib-rel-item__body">
								<span class="ib-rel-item__t"><?php echo esc_html( get_the_title( $rid ) ); ?></span>
								<span class="ib-rel-item__date"><?php echo esc_html( human_time_diff( get_the_time( 'U', $rid ), current_time( 'timestamp' ) ) . ' atrás' ); ?></span>
							</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif;
	endif; ?>

	<div class="eh-widget">
		<span class="eh-widget__head">Artigos recentes</span>
		<div class="eh-rank">
			<?php $n = 1; foreach ( get_posts( array( 'numberposts' => 5, 'post_status' => 'publish', 'fields' => 'ids' ) ) as $pid ) : ?>
				<a href="<?php echo esc_url( get_permalink( $pid ) ); ?>"><span class="eh-rank__n"><?php echo (int) $n++; ?></span><span class="eh-rank__t"><?php echo esc_html( get_the_title( $pid ) ); ?></span></a>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="eh-widget ib-newsletter-card">
		<span class="eh-widget__head">Newsletter</span>
		<p class="ib-newsletter-card__desc">Receba os novos artigos por e-mail.</p>
		<?php ib_newsletter_form(); ?>
	</div>
</aside>
