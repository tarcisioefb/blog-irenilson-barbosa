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
				<div style="display:flex;flex-direction:column;gap:var(--space-4)">
					<?php foreach ( $rel as $rid ) : ?>
						<a href="<?php echo esc_url( get_permalink( $rid ) ); ?>" style="display:flex;gap:var(--space-3);text-decoration:none;color:inherit">
							<?php if ( has_post_thumbnail( $rid ) ) : ?>
								<span style="flex-shrink:0;width:80px;height:60px;border-radius:var(--radius-sm);overflow:hidden;background:var(--paper-2)">
									<?php echo get_the_post_thumbnail( $rid, 'ib-thumb', array( 'style' => 'width:100%;height:100%;object-fit:cover', 'loading' => 'lazy' ) ); ?>
								</span>
							<?php endif; ?>
							<span style="font-size:var(--text-13);line-height:var(--leading-snug);color:var(--tx-2);align-self:center;transition:color .2s" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''"><?php echo esc_html( get_the_title( $rid ) ); ?></span>
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
