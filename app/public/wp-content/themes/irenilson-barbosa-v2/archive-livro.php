<?php
/** IRENILSON BARBOSA — Arquivo de Livros (vitrine de produtos). */
defined('ABSPATH') || exit;
get_header();
?>
<div class="wrap" style="padding-top:40px;padding-bottom:40px">
	<h1 style="font-family:var(--serif);font-size:clamp(1.5rem,3vw,2rem);color:var(--ink);margin:0 0 8px">Livros</h1>
	<p style="color:var(--tx-2);margin:0 0 32px;font-size:1rem">Obras de Irenilson Barbosa — autor, organizador e coautor.</p>

	<?php if (have_posts()) : ?>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:28px">
			<?php while (have_posts()) : the_post();
				$pid = get_the_ID();
				$ano = get_post_meta($pid, 'ano', true);
				$editora = get_post_meta($pid, 'editora', true);
				$participacao = wp_get_post_terms($pid, 'participacao', ['fields' => 'names']);
				$part_label = !empty($participacao) ? $participacao[0] : 'Autor';
			?>
				<article style="background:#fff;border-radius:12px;overflow:hidden;transition:transform .25s;border:1px solid var(--line)" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 28px -12px rgba(62,44,27,.18)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
					<a href="<?php the_permalink(); ?>" style="display:block;text-decoration:none;color:inherit">
						<?php if (has_post_thumbnail()) : ?>
							<div style="aspect-ratio:3/4;overflow:hidden;background:var(--bege-100)">
								<?php the_post_thumbnail('full', ['style' => 'width:100%;height:100%;object-fit:cover;transition:transform .4s', 'onmouseover' => "this.style.transform='scale(1.05)'", 'onmouseout' => "this.style.transform=''"]); ?>
							</div>
						<?php endif; ?>
						<div style="padding:20px">
							<div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:8px">
								<span style="font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:#fff;background:var(--accent);padding:3px 10px;border-radius:4px"><?php echo esc_html($part_label); ?></span>
								<?php if ($ano) : ?>
									<span style="font-size:11px;font-weight:500;color:var(--tx-dim);padding:3px 0"><?php echo esc_html($ano); ?></span>
								<?php endif; ?>
							</div>
							<h2 style="font-family:var(--serif);font-size:1.125rem;font-weight:700;color:var(--ink);margin:0 0 6px;line-height:1.3"><?php the_title(); ?></h2>
							<?php if ($editora) : ?>
								<p style="font-size:0.85rem;color:var(--tx-2);margin:0"><?php echo esc_html($editora); ?></p>
							<?php endif; ?>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>

		<div style="margin-top:40px"><?php the_posts_pagination(); ?></div>

	<?php else : ?>
		<p style="color:var(--tx-dim)">Nenhum livro cadastrado ainda.</p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
