<?php
/** IRENILSON BARBOSA — Single Poiésis (poema). */
defined('ABSPATH') || exit;
get_header();
ib_breadcrumb();
while (have_posts()) : the_post();
	$notas = get_post_meta(get_the_ID(), 'poiesis_notas', true);
	$poem_author = get_post_meta(get_the_ID(), 'poiesis_author', true) ?: 'Irenilson Barbosa';
	$other = get_posts(array('post_type' => 'poiesis', 'posts_per_page' => 5, 'post__not_in' => array(get_the_ID()), 'orderby' => 'rand'));
?>
<div class="wrap" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<div class="article-layout" style="grid-template-columns:minmax(0,1fr) 400px">
		<article style="max-width:680px">
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
		</article>

		<aside class="eh-aside">
			<?php if (has_post_thumbnail()) : ?>
				<div style="border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-card)">
					<?php the_post_thumbnail('large', array('style' => 'width:100%;height:auto;display:block')); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($other)) : ?>
			<div class="eh-widget">
				<span class="eh-widget__head">Outros poemas</span>
				<div class="ib-rel-list">
					<?php foreach ($other as $p) : ?>
						<a class="ib-rel-item" href="<?php echo esc_url(get_permalink($p->ID)); ?>">
							<?php if (has_post_thumbnail($p->ID)) : ?>
								<span class="ib-rel-item__img"><?php echo get_the_post_thumbnail($p->ID, 'ib-thumb', array('loading' => 'lazy')); ?></span>
							<?php endif; ?>
							<span class="ib-rel-item__body">
								<span class="ib-rel-item__t"><?php echo esc_html(get_the_title($p->ID)); ?></span>
								<span class="ib-rel-item__date"><?php echo esc_html(human_time_diff(get_the_time('U', $p->ID), current_time('timestamp')) . ' atrás'); ?></span>
							</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>

			<div class="eh-widget ib-newsletter-card">
				<span class="eh-widget__head">Newsletter</span>
				<p class="ib-newsletter-card__desc">Receba os novos poemas por e-mail.</p>
				<?php ib_newsletter_form(); ?>
			</div>
		</aside>
	</div>
</div>
<?php
endwhile;
get_footer();
