<?php
/** IRENILSON BARBOSA — Single Poiésis (poema). */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post();
	$notas = get_post_meta(get_the_ID(), 'poiesis_notas', true);
?>
<div class="wrap" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<article style="max-width:680px;margin:0 auto">
		<h1 style="font-family:var(--font-heading);font-size:var(--text-2xl);font-weight:400;color:var(--ink);line-height:var(--leading-tight);margin:0 0 var(--space-2)"><?php the_title(); ?></h1>

		<p style="font-size:var(--text-sm);color:var(--tx-dim);margin:0 0 var(--space-8)">por <?php the_author(); ?></p>

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

		<div style="margin-top:var(--space-10);padding-top:var(--space-6);border-top:var(--border-w) solid var(--border-c)">
			<span style="font-size:var(--text-xs);color:var(--tx-dim)"><?php echo esc_html(get_the_date('j F Y')); ?></span>
		</div>
	</article>
</div>
<?php
endwhile;
get_footer();
