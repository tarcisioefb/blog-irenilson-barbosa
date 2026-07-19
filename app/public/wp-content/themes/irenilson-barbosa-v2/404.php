<?php
/** IRENILSON BARBOSA — página não encontrada. */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="wrap single-wrap" style="text-align:center;padding:70px 0">
	<p style="font-family:var(--serif);font-size:80px;margin:0;color:var(--ink)">404</p>
	<h1 class="article__title" style="margin-top:6px">Página não encontrada</h1>
	<p style="color:var(--tx-2);max-width:52ch;margin:6px auto 22px">O conteúdo que você procurou não existe ou foi movido. Volte para a página inicial ou use a busca.</p>
	<p><a class="en-tag en-tag--solid" style="padding:12px 22px;font-size:13px" href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar ao início</a></p>
	<div style="max-width:420px;margin:26px auto 0"><?php get_search_form(); ?></div>
</div>
<?php
get_footer();
