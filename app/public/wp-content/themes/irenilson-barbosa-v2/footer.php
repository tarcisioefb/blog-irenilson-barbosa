<?php defined( 'ABSPATH' ) || exit; ?>

<footer class="footer" role="contentinfo">
	<div class="wrap">
		<div class="footer__row">
			<div class="footer__logo" style="font-family:var(--serif);font-size:1.1rem;font-weight:700;color:var(--ink)"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>

			<div class="footer__links">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
				<a href="<?php echo esc_url( home_url( '/artigos/' ) ); ?>">Artigos</a>
				<a href="<?php echo esc_url( home_url( '/publicacoes/' ) ); ?>">Publicações</a>
				<a href="<?php echo esc_url( home_url( '/livros/' ) ); ?>">Livros</a>
				<a href="<?php echo esc_url( home_url( '/materiais/' ) ); ?>">Materiais</a>
			</div>
		</div>

		<p class="footer__cr">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Irenilson Barbosa. Todos os direitos reservados. <span style="font-size:0.8rem;color:var(--tx-dim)">Desenvolvido por <a href="https://zucatech.com" target="_blank" rel="noopener" style="color:inherit" aria-label="Zucatech (abre em nova janela)">Zucatech</a>.</span></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
