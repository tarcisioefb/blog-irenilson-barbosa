<?php defined( 'ABSPATH' ) || exit; ?>

<footer class="footer" role="contentinfo">
	<div class="wrap">
		<div class="footer__row">
			<div class="footer__logo"><?php $logo = ib_opt('site_logo'); if ($logo) : $logo_id = attachment_url_to_postid($logo); if ($logo_id) : echo wp_get_attachment_image($logo_id, 'medium', false, ['alt' => esc_attr(get_bloginfo('name')), 'loading' => false]); else : ?><img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"><?php endif; else : ?><span style="font-family:var(--serif);font-weight:700;color:var(--ink)"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span><?php endif; ?></div>

			<div class="footer__links">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
				<a href="<?php echo esc_url( home_url( '/artigos/' ) ); ?>">Artigos</a>
				<a href="<?php echo esc_url( home_url( '/publicacoes/' ) ); ?>">Publicações</a>
				<a href="<?php echo esc_url( home_url( '/livros/' ) ); ?>">Livros</a>
				<a href="<?php echo esc_url( home_url( '/materiais/' ) ); ?>">Materiais</a>
			</div>
		</div>

		<p class="footer__cr">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Irenilson Barbosa. Todos os direitos reservados. <a href="/privacidade/" style="color:var(--tx-2);text-decoration:underline">Política de Privacidade</a>. <span style="font-size:var(--text-xs);color:var(--tx-dim)">Desenvolvido por <a href="https://zucatech.com" target="_blank" rel="noopener" style="color:inherit" aria-label="Zucatech (abre em nova janela)">Zucatech</a>.</span></p>
	</div>
</footer>

<div id="ib-cookie-banner" role="alert" style="display:none;position:fixed;bottom:0;left:0;right:0;z-index:9999;background:var(--ink);color:#fff;padding:var(--space-4) var(--space-6);font-size:var(--text-13);line-height:1.5;box-shadow:0 -4px 20px rgba(0,0,0,.2)">
	<div style="max-width:var(--wrap);margin:0 auto;display:flex;flex-wrap:wrap;align-items:center;gap:var(--space-4)">
		<p style="flex:1;margin:0;min-width:150px;font-size:var(--text-xs)">Este site usa cookies do Google Analytics para entender sua navegação. Ao clicar em "Aceitar", você consente com nossa <a href="/privacidade/" target="_blank" style="color:var(--tx-inv);text-decoration:underline">Política de Privacidade</a>.</p>
		<div style="display:flex;gap:var(--space-2);flex-shrink:0">
			<button type="button" id="ib-cookie-reject" style="padding:var(--space-1) var(--space-4);background:transparent;color:var(--tx-inv-dim);border:1px solid var(--tx-inv-dim);border-radius:var(--radius-sm);cursor:pointer;font-size:var(--text-13)">Rejeitar</button>
			<button type="button" id="ib-cookie-accept" style="padding:var(--space-1) var(--space-4);background:var(--accent);color:#fff;border:none;border-radius:var(--radius-sm);cursor:pointer;font-weight:600;font-size:var(--text-13)">Aceitar</button>
		</div>
	</div>
</div>
<script>
(function(){
	var accepted = localStorage.getItem('ib-cookies-accepted');
	if (accepted) return;
	document.getElementById('ib-cookie-banner').style.display = 'block';
	document.getElementById('ib-cookie-accept').onclick = function(){
		localStorage.setItem('ib-cookies-accepted', '1');
		document.getElementById('ib-cookie-banner').style.display = 'none';
		loadGA();
	};
	document.getElementById('ib-cookie-reject').onclick = function(){
		localStorage.setItem('ib-cookies-accepted', '0');
		document.getElementById('ib-cookie-banner').style.display = 'none';
	};
	function loadGA(){
		var s = document.createElement('script');
		s.src = 'https://www.googletagmanager.com/gtag/js?id=' + (window.ibGID || '');
		s.async = true;
		document.head.appendChild(s);
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', window.ibGID || '', {'anonymize_ip': true});
	}
	if (accepted === '1') loadGA();
})();
</script>
<?php wp_footer(); ?>
</body>
</html>
