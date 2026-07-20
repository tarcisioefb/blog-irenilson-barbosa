<?php
/** IRENILSON BARBOSA — Página Sobre. */
defined('ABSPATH') || exit;
get_header();
while (have_posts()) : the_post(); ?>
<style>
@media(max-width:1024px){.ib-sobre-grid{grid-template-columns:1fr!important}.ib-sobre-foto{position:static!important;max-width:240px;margin:0 auto var(--space-6)}.ib-sobre-sticky{position:static!important}}
@media(max-width:640px){.ib-sobre-formacao{grid-template-columns:1fr!important}.ib-sobre-foto{max-width:180px}}
</style>
<div class="wrap" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<article style="max-width:1280px;margin:0 auto">
		<div class="ib-sobre-grid" style="display:grid;grid-template-columns:320px 1fr;gap:var(--space-10);align-items:start;margin-bottom:var(--space-10)">
			<div class="ib-sobre-sticky" style="position:sticky;top:140px">
				<div style="aspect-ratio:1/1;border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-card);background:var(--paper-2)">
					<img src="http://irenilson-barbosa.local/wp-content/uploads/2026/07/Irenilson-Barbosa-Retrato.avif" alt="Irenilson Barbosa" style="width:100%;height:100%;object-fit:cover;display:block">
				</div>
			</div>
			<div>
				<h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);font-weight:500;color:var(--ink);margin:0 0 var(--space-1);line-height:var(--leading-tight)">Irenilson Barbosa</h1>
				<p style="font-size:var(--text-lg);color:var(--tx-dim);margin:0 0 var(--space-6)">Professor, escritor e pesquisador</p>

				<div style="padding:var(--space-5);background:var(--paper-2);border-radius:var(--radius-md);margin-bottom:var(--space-8);border-left:3px solid var(--accent)">
					<p style="margin:0;font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2)">Professor Adjunto da Universidade Federal do Recôncavo da Bahia (UFRB). Pós-Doutor em Ciências da Educação pela Universidade do Porto (2024). Doutor e Mestre em Educação pela UFBA.</p>
				</div>

				<!-- Formação -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Formação acadêmica</h2>
				<div class="ib-sobre-formacao" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-8)">
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
				</div>

				<!-- Atuação -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Atuação</h2>
				<p style="font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2);margin:0 0 var(--space-8)">Professor efetivo da <strong style="color:var(--ink)">Universidade Federal do Recôncavo da Bahia (UFRB)</strong> desde 2010, atuando no Centro de Formação de Professores (CFP) em Amargosa-BA. Leciona disciplinas de graduação e pós-graduação nas áreas de políticas educacionais, educação especial e inclusiva, currículo, didática e formação de professores. Foi Coordenador Geral do PARFOR na UFRB (2011–2012) e coordenador de projetos de pesquisa, extensão e residência pedagógica.</p>

				<!-- Grupos de pesquisa -->
				<div style="padding:var(--space-5);background:var(--paper);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-md);margin-bottom:var(--space-8)">
					<p style="margin:0;font-size:var(--text-13);color:var(--tx-2);line-height:var(--leading-relax)"><strong style="color:var(--ink)">Grupos de pesquisa:</strong> Educação, Sociedade e Diversidade (UFRB); Educação Especial, Diversidade e Contemporaneidade (UFRB); Currículo, Avaliação, Formação e Tecnologias em Educação (CAFTe) — CIIE/FPCEUP (Portugal).</p>
				</div>

				<!-- Pesquisa -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Pesquisa e publicações</h2>
				<p style="font-size:var(--text-base);line-height:var(--leading-relax);color:var(--tx-2);margin:0 0 var(--space-8)">Desenvolve pesquisas em educação inclusiva, afetividade, políticas educacionais, formação de professores e relações étnico-raciais. Autor de <strong style="color:var(--ink)">"Um Negro no Gólgota"</strong> (2015) e <strong style="color:var(--ink)">"A Vida em Poesia"</strong> (2015), além de capítulos e artigos no Brasil e exterior.</p>

				<!-- Áreas -->
				<h2 style="font-size:var(--text-sm);font-weight:var(--weight-bold);letter-spacing:var(--track-wider);text-transform:uppercase;color:var(--ink);margin:0 0 var(--space-4);padding-bottom:var(--space-2);border-bottom:var(--border-w) solid var(--border-c)">Áreas de atuação</h2>
				<div style="display:flex;gap:var(--space-2);flex-wrap:wrap;margin-bottom:var(--space-8)">
					<span style="font-size:var(--text-13);color:var(--ink);background:var(--paper-2);padding:var(--space-1) var(--space-4);border-radius:40px;border:var(--border-w) solid var(--border-c)">Educação Especial e Inclusiva</span>
					<span style="font-size:var(--text-13);color:var(--ink);background:var(--paper-2);padding:var(--space-1) var(--space-4);border-radius:40px;border:var(--border-w) solid var(--border-c)">Formação de Professores</span>
					<span style="font-size:var(--text-13);color:var(--ink);background:var(--paper-2);padding:var(--space-1) var(--space-4);border-radius:40px;border:var(--border-w) solid var(--border-c)">Políticas Educacionais</span>
					<span style="font-size:var(--text-13);color:var(--ink);background:var(--paper-2);padding:var(--space-1) var(--space-4);border-radius:40px;border:var(--border-w) solid var(--border-c)">Afetividade e Educação</span>
					<span style="font-size:var(--text-13);color:var(--ink);background:var(--paper-2);padding:var(--space-1) var(--space-4);border-radius:40px;border:var(--border-w) solid var(--border-c)">Relações Étnico-Raciais</span>
					<span style="font-size:var(--text-13);color:var(--ink);background:var(--paper-2);padding:var(--space-1) var(--space-4);border-radius:40px;border:var(--border-w) solid var(--border-c)">Currículo e Didática</span>
				</div>

				<p style="font-size:var(--text-xs);color:var(--tx-dim);margin:0;padding-top:var(--space-4);border-top:var(--border-w) solid var(--border-c)">Informações compiladas do Currículo Lattes.</p>
			</div>
		</div>
	</article>
</div>
<?php
endwhile;
get_footer();
