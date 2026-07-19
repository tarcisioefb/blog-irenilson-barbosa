<?php
/** IRENILSON BARBOSA — comentários. */
defined( 'ABSPATH' ) || exit;
if ( post_password_required() ) { return; }
?>
<section class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2><?php echo (int) get_comments_number(); ?> comentário(s)</h2>

		<ol class="comment-list">
			<?php wp_list_comments( array(
				'style'       => 'ol',
				'avatar_size' => 44,
				'callback'    => 'ib_comment',
			) ); ?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'          => 'Deixe um comentário',
		'label_submit'         => 'Publicar comentário',
		'class_submit'         => 'submit',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'cancel_reply_link'    => 'Cancelar',
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">Comentário</label><textarea id="comment" name="comment" rows="5" required></textarea></p>',
	) );
	?>
</section>
