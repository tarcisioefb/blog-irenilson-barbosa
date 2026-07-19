<?php
/** IRENILSON BARBOSA — página não encontrada. */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="wrap single-wrap" style="text-align:center;padding:var(--space-10) 0">
	<?php ib_breadcrumb(); ?>
	<h1 class="article__title" style="margin-top:var(--space-1)">Página não encontrada</h1>
	<p>O conteúdo que você procura não está disponível. Tente usar a busca.</p>
	<p><a class="en-tag en-tag--solid" href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar ao início</a></p>
	<div style="max-width:420px;margin:26px auto 0"><?php get_search_form(); ?></div>
</div>
<?php
get_footer();
