<?php
/** IRENILSON BARBOSA — Single Material (download). */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post();
	$pid  = get_the_ID();
	$cat  = ib_primary_cat($pid);
	$words = str_word_count(wp_strip_all_tags(get_the_content()));
	$mins  = max(1, (int) round($words / 200));
	$arquivo = get_post_meta($pid, 'arquivo_url', true);
	$ano = get_post_meta($pid, 'ano', true);
	$tipos = get_the_terms($pid, 'tipo-material');
	$tipo_label = $tipos && !is_wp_error($tipos) ? $tipos[0]->name : '';
?>
	<main class="wrap single-wrap" id="main">
		<?php ib_breadcrumb(); ?>

		<div class="article-layout">
			<article <?php post_class('article'); ?>>
				<?php if ($cat) : ?>
					<div class="article__cat"><a class="en-tag en-tag--solid" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a></div>
				<?php endif; ?>

				<h1 class="article__title"><?php the_title(); ?></h1>

				<div class="article__meta">
					<span>por <b><?php echo esc_html(get_the_author()); ?></b></span>
					<span><?php echo esc_html(get_the_date()); ?></span>
					<?php if ($tipo_label) : ?><span><b><?php echo esc_html($tipo_label); ?></b></span><?php endif; ?>
					<?php if ($ano) : ?><span><?php echo esc_html($ano); ?></span><?php endif; ?>
					<span><?php echo (int) $mins; ?> min de leitura</span>
				</div>

				<?php if (has_post_thumbnail()) : ?>
					<figure class="article__hero"><?php
$thumb_id = get_post_thumbnail_id();
if ($thumb_id) {
    echo wp_get_attachment_image($thumb_id, 'large', false, array(
        'alt' => esc_attr(get_the_title()),
        'fetchpriority' => 'high',
        'loading' => false,
        'data-no-lazy' => '1',
        'sizes' => '(max-width: 840px) 100vw, 840px',
    ));
}
if (get_the_post_thumbnail_caption()) : ?><figcaption><?php the_post_thumbnail_caption(); ?></figcaption><?php endif; ?></figure>
				<?php endif; ?>

				<?php ib_share_buttons($pid); ?>

				<div class="article__body"><?php the_content(); wp_link_pages(); ?></div>

				<?php if ($arquivo) : ?>
				<div style="margin:var(--space-6) 0">
					<a href="<?php echo esc_url($arquivo); ?>" target="_blank" rel="noopener noreferrer" class="ib-btn ib-btn--amazon" style="display:inline-flex;align-items:center;gap:var(--space-2);font-size:var(--text-base);padding:var(--space-3) var(--space-6)">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
						Baixar material
					</a>
				</div>
				<?php endif; ?>

				<?php echo \IrenilsonBarbosa\Core\AuthorBox::render_html(); ?>

				<div class="article-section-divider"></div>

				<?php ib_share_buttons($pid); ?>

			</article>

			<?php get_sidebar(); ?>
		</div>

		<?php \IrenilsonBarbosa\Core\RelatedPosts::render(); ?>
	</main>
	<?php
endwhile;
get_footer();
