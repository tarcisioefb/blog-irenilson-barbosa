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
		'facebook' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'instagram' => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
		'youtube' => '<path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/>',
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
		<a class="sh-fb" href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" aria-label="Facebook (abre em nova janela)"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
		<a class="sh-x" href="<?php echo esc_url( $x ); ?>" target="_blank" rel="noopener" aria-label="X (abre em nova janela)"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
		<a class="sh-wa" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp (abre em nova janela)"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg></a>
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
