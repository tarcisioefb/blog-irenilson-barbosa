<?php
/** IRENILSON BARBOSA — Página Sobre. */
defined('ABSPATH') || exit;
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
					<img src="<?php echo esc_url(wp_upload_dir()['baseurl']); ?>/2026/07/Irenilson-Barbosa-Retrato.avif-square.jpg" alt="Irenilson Barbosa" style="width:100%;height:100%;object-fit:cover;display:block">
				</div>
			</div>
			<div>
				<h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);font-weight:500;color:var(--ink);margin:0 0 var(--space-1);line-height:var(--leading-tight)">Irenilson Barbosa</h1>
				<p style="font-size:var(--text-lg);color:var(--tx-dim);margin:0 0 var(--space-6)">Professor, escritor e pesquisador</p>

				<div style="padding:var(--space-5);background:var(--paper-2);border-radius:var(--radius-md);margin-bottom:var(--space-8);border-left:3px solid var(--accent)">
					<p style="margin:0;font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2)">Professor Adjunto da UFRB. Pós-Doutor em Ciências da Educação pela Universidade do Porto. Pós-Doutorando em Democracia e Direitos Humanos pela Universidade de Coimbra. Doutor e Mestre em Educação pela UFBA. Licenciado em Pedagogia (UFBA) e Bacharel em Teologia. Coordenador do Mestrado Profissional em Educação Inclusiva em Rede (PROFEI).</p>
				</div>

				<!-- Formação -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Formação acadêmica</h2>
				<div class="ib-sobre-formacao" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-8)">
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600">2024–2025</span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><strong style="color:var(--ink)">Pós-Doutorando</strong> — Democracia e Direitos Humanos, Ius Gentium Conimbrigae, Universidade de Coimbra</p>
					</div>
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600">2023–2024</span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><strong style="color:var(--ink)">Pós-Doutorado</strong> — Ciências da Educação, FPCEUP/Universidade do Porto</p>
					</div>
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600">2012–2016</span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><strong style="color:var(--ink)">Doutorado</strong> — Educação, UFBA</p>
					</div>
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600">2002–2004</span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><strong style="color:var(--ink)">Mestrado</strong> — Educação, UFBA</p>
					</div>
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600">2001</span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><strong style="color:var(--ink)">Licenciatura</strong> — Pedagogia, UFBA</p>
					</div>
					<div style="padding:var(--space-4);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md)">
						<span style="font-size:var(--text-xs);color:var(--accent-2);text-transform:uppercase;letter-spacing:var(--track-wider);font-weight:600">1990</span>
						<p style="margin:var(--space-1) 0 0;font-size:var(--text-13);color:var(--tx-2)"><strong style="color:var(--ink)">Bacharelado</strong> — Teologia, STBSB</p>
					</div>
				</div>

				<!-- Grupos -->
				<div style="padding:var(--space-4) var(--space-5);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md);margin-bottom:var(--space-8);font-size:var(--text-13);line-height:var(--leading-relax);color:var(--tx-2)">
					<strong style="color:var(--ink)">Grupos de pesquisa:</strong> Educação, Sociedade e Diversidade (UFRB); Educação Especial, Diversidade e Contemporaneidade (UFRB); Currículo, Avaliação, Formação e Tecnologias em Educação (CAFTe) — CIIE/FPCEUP (Portugal).
				</div>

				<!-- Pesquisa -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Pesquisa e publicações</h2>
				<p style="font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2);margin:0 0 var(--space-8)">Autor de livros, capítulos de livros e artigos sobre educação inclusiva, educação especial, direitos humanos, teologia e interseccionalidades raciais, poemas e reflexões. <strong style="color:var(--ink)">"O Homem que Não Sabia Ser Santo"</strong> marca sua estreia na ficção, mesclando realismo mágico sertanejo com reflexões filosóficas e psicanalíticas sobre identidade, fé e humanidade — temperadas na filosofia de cozinha que brota do chão rachado da Bahia. Também autor de <strong style="color:var(--ink)">"Um Negro no Gólgota"</strong> (2015) e <strong style="color:var(--ink)">"A Vida em Poesia"</strong> (2015).</p>

				<!-- Contato -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Contato</h2>
				<div style="display:flex;flex-direction:column;gap:var(--space-2);margin-bottom:var(--space-8);font-size:var(--text-13);color:var(--tx-2)">
					<span>✉️ <a href="mailto:irenilsonjb@yahoo.com.br" style="color:var(--ink);text-decoration:none">irenilsonjb@yahoo.com.br</a></span>
					<span>✉️ <a href="mailto:irenilsonjb@ufrb.edu.br" style="color:var(--ink);text-decoration:none">irenilsonjb@ufrb.edu.br</a></span>
					<span>📄 <a href="http://lattes.cnpq.br/1666550999462374" target="_blank" rel="noopener" style="color:var(--accent);text-decoration:none">Currículo Lattes</a></span>
					<span>🎓 <a href="https://scholar.google.com/citations?user=YKHWTRsAAAAJ" target="_blank" rel="noopener" style="color:var(--accent);text-decoration:none">Google Scholar</a></span>
					<span>🆔 <a href="https://orcid.org/0000-0001-6638-3620" target="_blank" rel="noopener" style="color:var(--accent);text-decoration:none">ORCID: 0000-0001-6638-3620</a></span>
				</div>

				<p style="font-size:var(--text-xs);color:var(--tx-dim);margin:0;padding-top:var(--space-4);border-top:var(--border-w) solid var(--border-c)">Informações compiladas do Currículo Lattes.</p>
			</div>
		</div>
	</article>
</div>
<?php
endwhile;
get_footer();
