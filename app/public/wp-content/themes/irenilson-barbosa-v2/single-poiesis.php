<?php
/** IRENILSON BARBOSA — Single Poiésis (poema). */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post();
	$notas = get_post_meta(get_the_ID(), 'poiesis_notas', true);
	$poem_author = get_post_meta(get_the_ID(), 'poiesis_author', true) ?: 'Irenilson Barbosa';
?>
<div class="wrap" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<article style="max-width:680px;margin:0 auto">
		<h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);font-weight:500;color:var(--ink);line-height:var(--leading-tight);margin:0 0 var(--space-1)"><?php the_title(); ?></h1>

		<p style="font-size:var(--text-sm);color:var(--tx-dim);margin:0 0 var(--space-8)">por <strong style="color:var(--tx-2);font-weight:600"><?php echo esc_html($poem_author); ?></strong></p>

		<?php if (has_excerpt()) : ?>
			<p style="font-size:var(--text-base);color:var(--tx-dim);font-style:italic;margin:0 0 var(--space-8)"><?php echo esc_html(get_the_excerpt()); ?></p>
		<?php endif; ?>

		<div class="ib-poem-body">
			<?php the_content(); ?>
		</div>

		<?php if ($notas) : ?>
		<div class="ib-poem-notes">
			<?php echo wpautop(wp_kses_post($notas)); ?>
		</div>
		<?php endif; ?>

		<?php \IrenilsonBarbosa\Core\AuthorBox::render(); ?>
	</article>
</div>
<?php
endwhile;
get_footer();
