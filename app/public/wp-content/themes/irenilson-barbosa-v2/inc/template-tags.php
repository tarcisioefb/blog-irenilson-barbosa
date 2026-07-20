<?php
/** IRENILSON BARBOSA — helpers de template. */
defined( 'ABSPATH' ) || exit;

/** Redes sociais (placeholder - configurar futuramente). */
function ib_social() {
	return array(
		'facebook'  => 'https://facebook.com/',
		'instagram' => 'https://instagram.com/',
	);
}
function ib_render_social( $class = 'soc' ) {
	foreach ( ib_social() as $net => $url ) {
		if ( empty( $url ) ) { continue; }
		printf( '<a class="%s" href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg></a>',
			esc_attr( $class ), esc_url( $url ), esc_attr( ucfirst( $net ) ) );
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
		<a class="sh-fb" href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 320 512"><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/></svg></a>
		<a class="sh-x" href="<?php echo esc_url( $x ); ?>" target="_blank" rel="noopener" aria-label="X"><svg viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a>
		<a class="sh-wa" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg></a>
	</div>
	<?php
}

/** Breadcrumb. */
function ib_breadcrumb() {
	echo '<nav class="breadcrumb" aria-label="Você está aqui"><a href="' . esc_url( home_url( '/' ) ) . '">Início</a>';

	if ( is_singular( 'post' ) ) {
		$cat = ib_primary_cat( get_the_ID() );
		if ( $cat ) { echo '<span class="sep">›</span><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>'; }
		echo '<span class="sep">›</span><span>' . esc_html( wp_trim_words( get_the_title(), 8, '…' ) ) . '</span>';

	} elseif ( is_singular( 'publicacao' ) ) {
		echo '<span class="sep">›</span><a href="' . esc_url( get_post_type_archive_link( 'publicacao' ) ) . '">Publicações</a>';
		echo '<span class="sep">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_singular( 'livro' ) ) {
		echo '<span class="sep">›</span><a href="' . esc_url( get_post_type_archive_link( 'livro' ) ) . '">Livros</a>';
		echo '<span class="sep">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_singular( 'material' ) ) {
		echo '<span class="sep">›</span><a href="' . esc_url( get_post_type_archive_link( 'material' ) ) . '">Materiais</a>';
		echo '<span class="sep">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_singular( 'poiesis' ) ) {
		echo '<span class="sep">›</span><a href="' . esc_url( get_post_type_archive_link( 'poiesis' ) ) . '">Poiésis</a>';
		echo '<span class="sep">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_page() ) {
		$post = get_queried_object();
		if ( $post && $post->post_parent ) {
			$parents = array_reverse( get_post_ancestors( $post->ID ) );
			foreach ( $parents as $parent_id ) {
				echo '<span class="sep">›</span><a href="' . esc_url( get_permalink( $parent_id ) ) . '">' . esc_html( get_the_title( $parent_id ) ) . '</a>';
			}
		}
		echo '<span class="sep">›</span><span>' . esc_html( get_the_title() ) . '</span>';

	} elseif ( is_category() ) {
		echo '<span class="sep">›</span><span>' . esc_html( single_cat_title( '', false ) ) . '</span>';

	} elseif ( is_search() ) {
		echo '<span class="sep">›</span><span>Busca</span>';

	} elseif ( is_post_type_archive( 'publicacao' ) ) {
		echo '<span class="sep">›</span><span>Publicações</span>';

	} elseif ( is_post_type_archive( 'livro' ) ) {
		echo '<span class="sep">›</span><span>Livros</span>';

	} elseif ( is_post_type_archive( 'material' ) ) {
		echo '<span class="sep">›</span><span>Materiais</span>';

	} elseif ( is_post_type_archive( 'poiesis' ) ) {
		echo '<span class="sep">›</span><span>Poiésis</span>';

	} elseif ( is_404() ) {
		echo '<span class="sep">›</span><span>Página não encontrada</span>';
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
