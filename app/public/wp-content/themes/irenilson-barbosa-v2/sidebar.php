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
		$cat = ib_primary_cat( get_the_ID() );
		if ( $cat ) :
			$rel = get_posts( array( 'numberposts' => 4, 'post_status' => 'publish', 'category' => $cat->term_id, 'post__not_in' => array( get_the_ID() ), 'fields' => 'ids', 'suppress_filters' => false ) );
			if ( ! empty( $rel ) ) : ?>
			<div class="eh-widget">
				<span class="eh-widget__head">Leia também</span>
				<div class="eh-rank">
					<?php $n = 1; foreach ( $rel as $rid ) : ?>
						<a href="<?php echo esc_url( get_permalink( $rid ) ); ?>">
							<span class="eh-rank__n"><?php echo (int) $n++; ?></span>
							<span class="eh-rank__t" style="font-weight:600"><?php echo esc_html( get_the_title( $rid ) ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif;
		endif;
	endif; ?>

	<div class="eh-widget">
		<span class="eh-widget__head">Artigos recentes</span>
		<div class="eh-rank">
			<?php $n = 1; foreach ( get_posts( array( 'numberposts' => 5, 'post_status' => 'publish', 'fields' => 'ids' ) ) as $pid ) : ?>
				<a href="<?php echo esc_url( get_permalink( $pid ) ); ?>"><span class="eh-rank__n"><?php echo (int) $n++; ?></span><span class="eh-rank__t"><?php echo esc_html( get_the_title( $pid ) ); ?></span></a>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="eh-widget" style="background:var(--paper-2);padding:20px;border-radius:8px">
		<span class="eh-widget__head" style="display:block">Newsletter</span>
		<p style="font-size:0.85rem;color:var(--tx-2);margin:0 0 12px;line-height:1.5">Receba os novos ensaios por e-mail.</p>
		<?php ib_newsletter_form(); ?>
	</div>
</aside>
