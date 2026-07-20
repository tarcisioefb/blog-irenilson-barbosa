<?php
/** IRENILSON BARBOSA — helpers de template. */
defined( 'ABSPATH' ) || exit;

/** Redes sociais — lê da Central do Site. */
function ib_social() {
	$fb  = \IrenilsonBarbosa\Core\AdminSettings::opt('social_facebook');
	$ig  = \IrenilsonBarbosa\Core\AdminSettings::opt('social_instagram');
	$yt  = \IrenilsonBarbosa\Core\AdminSettings::opt('social_youtube');
	return array_filter([
		'facebook'  => $fb,
		'instagram' => $ig,
		'youtube'   => $yt,
	]);
}
function ib_render_social( $class = 'soc' ) {
	$icons = [
		'facebook' => '<path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"/>',
		'instagram' => '<path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"/><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/><path d="M16.5 7.5v.01"/>',
		'youtube' => '<path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4z"/><path d="M10 9l5 3l-5 3z"/>',
	];
	foreach ( ib_social() as $net => $url ) {
		if ( empty( $url ) ) { continue; }
		$svg = $icons[$net] ?? '<circle cx="12" cy="12" r="10"/>';
		printf( '<a class="%s" href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s (abre em nova janela)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg></a>',
			esc_attr( $class ), esc_url( $url ), esc_attr( ucfirst( $net ) ), $svg );
	}
}

/** Categoria principal do post (ignora Uncategorized). */
function ib_primary_cat( $id ) {
	$cats = get_the_category( $id );
	foreach ( $cats as $c ) {
		if ( 'uncategorized' !== strtolower( $c->slug ) ) { return $c; }
	}
	return ! empty( $cats ) ? $cats[0] : null;
}

/** Card padrão (imagem + tag + título + meta). */
function ib_card( $id ) {
	$cat   = ib_primary_cat( $id );
	$link  = get_permalink( $id );
	$thumb = get_the_post_thumbnail_url( $id, 'ib-card' );
	?>
	<article class="eh-card">
		<a class="eh-card__imgwrap<?php echo $thumb ? '' : ' is-empty'; ?>" href="<?php echo esc_url( $link ); ?>"
			aria-label="<?php echo esc_attr( get_the_title( $id ) ); ?>">
			<?php if ( $thumb ) : ?><img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy"><?php endif; ?>
			<?php if ( $cat ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $cat->name ); ?></span><?php endif; ?>
		</a>
		<h3 class="eh-card__t"><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a></h3>
	</article>
	<?php
}

/** Card de destaque (hero overlay). */
function ib_feat_card( $id, $variant = 'small' ) {
	$cat   = ib_primary_cat( $id );
	$thumb = get_the_post_thumbnail_url( $id, 'wide' === $variant ? 'full' : 'ib-card' );
	$link  = get_permalink( $id );
	$mod   = 'wide' === $variant ? ' eh-feat--wide' : '';
	?>
	<a class="eh-feat<?php echo $mod; ?><?php echo $thumb ? '' : ' is-empty'; ?>" href="<?php echo esc_url( $link ); ?>"
		aria-label="<?php echo esc_attr( get_the_title( $id ) ); ?>">
		<?php if ( $thumb ) : ?><img src="<?php echo esc_url( $thumb ); ?>" alt="" class="eh-feat__img"><?php endif; ?>
		<span class="eh-feat__body">
			<?php if ( $cat ) : ?><span class="en-tag en-tag--solid"><?php echo esc_html( $cat->name ); ?></span><br><?php endif; ?>
			<span class="eh-feat__t"><?php echo esc_html( get_the_title( $id ) ); ?></span>
		</span>
	</a>
	<?php
}

/** Compartilhamento. */
function ib_share_buttons( $id ) {
	$url   = rawurlencode( get_permalink( $id ) );
	$title = rawurlencode( get_the_title( $id ) );
	$fb = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
	$x  = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title;
	$wa = 'https://api.whatsapp.com/send?text=' . $title . '%20' . $url;
	?>
	<div class="share">
		<span class="share__label">Compartilhar</span>
		<a class="sh-fb" href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" aria-label="Facebook (abre em nova janela)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"/></svg></a>
		<a class="sh-x" href="<?php echo esc_url( $x ); ?>" target="_blank" rel="noopener" aria-label="X (abre em nova janela)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4l11.733 16h4.267l-11.733 -16z"/><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/></svg></a>
		<a class="sh-wa" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp (abre em nova janela)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"/><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"/></svg></a>
	</div>
	<?php
}

/** Breadcrumb. */
function ib_breadcrumb() {
	echo '<nav class="breadcrumb" aria-label="Você está aqui"><a href="' . esc_url( home_url( '/' ) ) . '">Início</a>';

	if ( is_singular( 'post' ) ) {
		$cat = ib_primary_cat( get_the_ID() );
		if ( $cat ) { echo '<span class="sep" aria-hidden="true">›</span><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>'; }
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( wp_trim_words( get_the_title(), 8, '…' ) ) . '</span>';

	} elseif ( is_singular( 'publicacao' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><a href="' . esc_url( get_post_type_archive_link( 'publicacao' ) ) . '">Publicações</a>';
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_singular( 'livro' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><a href="' . esc_url( get_post_type_archive_link( 'livro' ) ) . '">Livros</a>';
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_singular( 'material' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><a href="' . esc_url( get_post_type_archive_link( 'material' ) ) . '">Materiais</a>';
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_singular( 'poiesis' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><a href="' . esc_url( get_post_type_archive_link( 'poiesis' ) ) . '">Poiésis</a>';
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_page() ) {
		$post = get_queried_object();
		if ( $post && $post->post_parent ) {
			$parents = array_reverse( get_post_ancestors( $post->ID ) );
			foreach ( $parents as $parent_id ) {
				echo '<span class="sep" aria-hidden="true">›</span><a href="' . esc_url( get_permalink( $parent_id ) ) . '">' . esc_html( get_the_title( $parent_id ) ) . '</a>';
			}
		}
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_category() ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>' . esc_html( single_cat_title( '', false ) ) . '</span>';

	} elseif ( is_search() ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>Busca</span>';

	} elseif ( is_post_type_archive( 'publicacao' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>Publicações</span>';

	} elseif ( is_post_type_archive( 'livro' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>Livros</span>';

	} elseif ( is_post_type_archive( 'material' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>Materiais</span>';

	} elseif ( is_post_type_archive( 'poiesis' ) ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>Poiésis</span>';

	} elseif ( is_404() ) {
		echo '<span class="sep" aria-hidden="true">›</span><span>Página não encontrada</span>';
	}

	echo '</nav>';
}

/** Callback de comentários. */
function ib_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li'; ?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article class="comment-body">
			<?php if ( 0 != $args['avatar_size'] ) : ?>
				<div class="comment-avatar"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
			<?php endif; ?>
			<div class="comment-text">
				<div class="comment-meta">
					<span class="comment-author"><?php comment_author_link(); ?></span>
					<span class="comment-date"><?php printf( __( '%s atrás', 'irenilson-barbosa' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
				</div>
				<?php comment_text(); ?>
				<?php if ( '0' === $comment->comment_approved ) : ?>
					<p class="comment-awaiting">Seu comentário aguarda moderação.</p>
				<?php endif; ?>
				<div class="comment-actions">
					<?php
					comment_reply_link( array_merge( $args, array(
						'reply_text' => 'Responder',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
					) ) );
					edit_comment_link( 'Editar' );
					?>
				</div>
			</div>
		</article>
	<?php
}
