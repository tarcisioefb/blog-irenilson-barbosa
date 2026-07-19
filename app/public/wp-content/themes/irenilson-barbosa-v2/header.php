<?php defined( 'ABSPATH' ) || exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
<?php $fb_app_id = ib_opt('facebook_app_id'); if ($fb_app_id) : ?>
<meta property="fb:app_id" content="<?php echo esc_attr($fb_app_id); ?>">
<?php endif; ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php $fb_app_id = ib_opt('facebook_app_id'); if ($fb_app_id) : ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v18.0&appId=<?php echo esc_attr($fb_app_id); ?>"></script>
<?php endif; ?>

<?php
$ib_menu = array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu', 'depth' => 2, 'fallback_cb' => false );
?>

<header class="eh">
	<div class="topbar">
		<div class="wrap topbar__row">
			<div class="topbar__date"><?php echo esc_html( ucfirst( date_i18n( 'l, j \d\e F \d\e Y' ) ) ); ?></div>
			<div class="topbar__right">
				<span class="topbar__place"><b>Irenilson Barbosa</b> · Professor &amp; Escritor</span>
				<div class="topbar__social"><?php ib_render_social( 'soc' ); ?></div>
			</div>
		</div>
	</div>

	<div class="masthead" id="masthead">
		<div class="wrap masthead__row">
			<button class="burger" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="drawer" data-elite-burger><span></span><span></span><span></span></button>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php
				$logo_url = ib_opt('site_logo');
				if ( $logo_url ) : ?>
					<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="height:50px;width:auto">
				<?php elseif ( has_custom_logo() ) :
					the_custom_logo();
				else : ?>
					<span class="brand__text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<?php endif; ?>
			</a>
			<nav class="nav" aria-label="Menu principal">
				<?php wp_nav_menu( $ib_menu ); ?>
			</nav>
			<button class="search-btn" type="button" aria-label="Buscar" data-elite-search-open>
				<svg viewBox="0 0 24 24" fill="none" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.2-3.2"/></svg>
			</button>
		</div>
	</div>
</header>

<div class="drawer" id="drawer" data-elite-drawer aria-hidden="true">
	<div class="drawer__head">
		<span style="color:#fff;font-family:var(--serif);font-size:1.2rem;font-weight:700"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
		<button class="drawer__close" type="button" aria-label="Fechar menu" data-elite-close>&times;</button>
	</div>
	<nav aria-label="Menu principal (mobile)"><?php wp_nav_menu( $ib_menu ); ?></nav>
	<div class="drawer__social"></div>
</div>
<div class="scrim" data-elite-scrim hidden></div>

<div class="search-overlay" data-elite-search aria-hidden="true">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" name="s" placeholder="Buscar…" aria-label="Buscar" autocomplete="off">
		<button type="submit" aria-label="Buscar"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.2-3.2"/></svg></button>
	</form>
	<button class="search-close" type="button" aria-label="Fechar busca" data-elite-search-close>&times;</button>
</div>
<div class="masthead-placeholder" id="masthead-placeholder"></div>
