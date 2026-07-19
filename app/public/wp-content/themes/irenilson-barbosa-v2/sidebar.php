<?php
/** IRENILSON BARBOSA — sidebar. */
defined( 'ABSPATH' ) || exit;
?>
<aside class="eh-aside">
	<div class="eh-widget">
		<span class="eh-widget__head">Sobre</span>
		<div style="font-size:0.9rem;color:var(--tx-2);line-height:1.7">
			<p><strong style="color:var(--ink)">Irenilson Barbosa</strong> <?php echo esc_html( ib_opt( 'sidebar_bio' ) ?: 'Professor universitário, escritor e pesquisador.' ); ?></p>
		</div>
	</div>

	<div class="eh-widget">
		<span class="eh-widget__head">Artigos recentes</span>
		<div class="eh-rank">
			<?php $n = 1; foreach ( get_posts( array( 'numberposts' => 5, 'post_status' => 'publish', 'fields' => 'ids' ) ) as $pid ) : ?>
				<a href="<?php echo esc_url( get_permalink( $pid ) ); ?>"><span class="eh-rank__n"><?php echo (int) $n++; ?></span><span class="eh-rank__t"><?php echo esc_html( get_the_title( $pid ) ); ?></span></a>
			<?php endforeach; ?>
		</div>
	</div>
</aside>
