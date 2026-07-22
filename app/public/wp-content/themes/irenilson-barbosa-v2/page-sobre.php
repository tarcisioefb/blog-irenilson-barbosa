<?php
/** IRENILSON BARBOSA — Página Sobre. */
defined('ABSPATH') || exit;
$pid = get_queried_object_id();

$sobre_foto        = get_post_meta($pid, 'ib_sobre_foto', true) ?: wp_upload_dir()['baseurl'] . '/2026/07/Irenilson-Barbosa-Retrato.avif-square.jpg';
$sobre_nome        = get_post_meta($pid, 'ib_sobre_nome', true) ?: 'Irenilson Barbosa';
$sobre_subtitulo   = get_post_meta($pid, 'ib_sobre_subtitulo', true) ?: 'Professor, escritor e pesquisador';
$sobre_descricao   = get_post_meta($pid, 'ib_sobre_descricao', true) ?: 'Professor Adjunto da UFRB. Pós-Doutor em Ciências da Educação pela Universidade do Porto. Pós-Doutorando em Democracia e Direitos Humanos pela Universidade de Coimbra. Doutor e Mestre em Educação pela UFBA. Licenciado em Pedagogia (UFBA) e Bacharel em Teologia. Coordenador do Mestrado Profissional em Educação Inclusiva em Rede (PROFEI).';
$sobre_formacao    = get_post_meta($pid, 'ib_sobre_formacao', true) ?: "2024–2025|Pós-Doutorando|Democracia e Direitos Humanos, Ius Gentium Conimbrigae, Universidade de Coimbra\n2023–2024|Pós-Doutorado|Ciências da Educação, FPCEUP/Universidade do Porto\n2012–2016|Doutorado|Educação, UFBA\n2002–2004|Mestrado|Educação, UFBA\n2001|Licenciatura|Pedagogia, UFBA\n1990|Bacharelado|Teologia, STBSB";
$sobre_grupos      = get_post_meta($pid, 'ib_sobre_grupos', true) ?: 'Educação, Sociedade e Diversidade (UFRB); Educação Especial, Diversidade e Contemporaneidade (UFRB); Currículo, Avaliação, Formação e Tecnologias em Educação (CAFTe) — CIIE/FPCEUP (Portugal).';
$sobre_publicacoes = get_post_meta($pid, 'ib_sobre_publicacoes', true) ?: 'Autor de livros, capítulos de livros e artigos sobre educação inclusiva, educação especial, direitos humanos, teologia e interseccionalidades raciais, poemas e reflexões. <strong>"O Homem que Não Sabia Ser Santo"</strong> marca sua estreia na ficção, mesclando realismo mágico sertanejo com reflexões filosóficas e psicanalíticas sobre identidade, fé e humanidade — temperadas na filosofia de cozinha que brota do chão rachado da Bahia. Também autor de <strong>"Um Negro no Gólgota"</strong> (2015) e <strong>"A Vida em Poesia"</strong> (2015).';
$sobre_email       = get_post_meta($pid, 'ib_sobre_email', true) ?: 'irenilsonjb@yahoo.com.br';
$sobre_lattes      = get_post_meta($pid, 'ib_sobre_lattes', true) ?: 'http://lattes.cnpq.br/1666550999462374';
$sobre_scholar     = get_post_meta($pid, 'ib_sobre_scholar', true) ?: 'https://scholar.google.com/citations?user=YKHWTRsAAAAJ';
$sobre_orcid       = get_post_meta($pid, 'ib_sobre_orcid', true) ?: 'https://orcid.org/0000-0001-6638-3620';

$formacao_items = array_filter(array_map('trim', explode("\n", $sobre_formacao)));

get_header();
while (have_posts()) : the_post(); ?>
<style>
@media(max-width:1024px){.ib-sobre-grid{grid-template-columns:1fr!important}.ib-sobre-foto{position:static!important;max-width:240px;margin:0 auto var(--space-6)}.ib-sobre-sticky{position:static!important}}
@media(max-width:640px){.ib-sobre-formacao{grid-template-columns:1fr!important}.ib-sobre-foto{max-width:180px}}
</style>
<div class="wrap" id="main" style="padding-top:16px;padding-bottom:var(--space-10)">
	<?php ib_breadcrumb(); ?>
	<article style="max-width:1280px;margin:0 auto">
		<div class="ib-sobre-grid" style="display:grid;grid-template-columns:320px 1fr;gap:var(--space-10);align-items:start;margin-bottom:var(--space-10)">
			<div class="ib-sobre-sticky" style="position:sticky;top:140px">
				<div style="aspect-ratio:1/1;border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-card);background:var(--paper-2)">
					<img src="<?php echo esc_url($sobre_foto); ?>" alt="Irenilson Barbosa" style="width:100%;height:100%;object-fit:cover;display:block">
				</div>
			</div>
			<div>
				<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);font-weight:700;color:var(--ink);margin:0 0 var(--space-1);line-height:var(--leading-tight)"><?php echo esc_html($sobre_nome); ?></h1>
				<p style="font-size:var(--text-lg);color:var(--tx-dim);margin:0 0 var(--space-6)"><?php echo esc_html($sobre_subtitulo); ?></p>

				<div style="padding:var(--space-5);background:var(--paper-2);border-radius:var(--radius-md);margin-bottom:var(--space-8);border-left:3px solid var(--accent)">
					<p style="margin:0;font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2)"><?php echo wp_kses_post($sobre_descricao); ?></p>
				</div>

				<?php if (!empty($formacao_items)) : ?>
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Formação acadêmica</h2>
				<div class="ib-sobre-formacao" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-8)">
					<?php foreach ($formacao_items as $item) : $parts = explode('|', $item); $periodo = trim($parts[0] ?? ''); $grau = trim($parts[1] ?? ''); $instituicao = trim($parts[2] ?? ''); ?>
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600"><?php echo esc_html($periodo); ?></span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><?php if ($grau) : ?><strong style="color:var(--ink)"><?php echo esc_html($grau); ?></strong><?php endif; ?><?php if ($grau && $instituicao) : ?><br><?php endif; ?><?php if ($instituicao) : ?><span style="color:var(--tx-2)"><?php echo esc_html($instituicao); ?></span><?php endif; ?></p>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<div style="padding:var(--space-4) var(--space-5);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md);margin-bottom:var(--space-8);font-size:var(--text-13);line-height:var(--leading-relax);color:var(--tx-2)">
					<strong style="color:var(--ink)">Grupos de pesquisa:</strong> <?php echo esc_html($sobre_grupos); ?>
				</div>

				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Pesquisa e publicações</h2>
				<p style="font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2);margin:0 0 var(--space-8)"><?php echo $sobre_publicacoes; ?></p>

				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Contato</h2>
				<div style="margin-bottom:var(--space-6);font-size:var(--text-13);color:var(--tx-2)">
					<span>✉️ <a href="mailto:<?php echo esc_attr($sobre_email); ?>" style="color:var(--ink);text-decoration:none"><?php echo esc_html($sobre_email); ?></a></span>
				</div>

				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Mais informações</h2>
				<div style="display:flex;flex-direction:column;gap:var(--space-2);margin-bottom:var(--space-8);font-size:var(--text-13);color:var(--tx-2)">
					<span>📄 <a href="<?php echo esc_url($sobre_lattes); ?>" target="_blank" rel="noopener" style="color:var(--accent);text-decoration:none">Currículo Lattes</a></span>
					<span>🎓 <a href="<?php echo esc_url($sobre_scholar); ?>" target="_blank" rel="noopener" style="color:var(--accent);text-decoration:none">Google Scholar</a></span>
					<span>🆔 <a href="<?php echo esc_url($sobre_orcid); ?>" target="_blank" rel="noopener" style="color:var(--accent);text-decoration:none">ORCID</a></span>
				</div>

			</div>
		</div>
	</article>
</div>
<?php
endwhile;
get_footer();
