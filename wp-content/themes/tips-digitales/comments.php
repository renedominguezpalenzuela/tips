<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TIPS_Digitales
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="border-color-secundary comments-area px-3">

	<?php
        $grupo_header = get_field('grupo_header', 'option');

		$comment_args = array
		(
			'class_form' => 'row mx-3',
			'class_submit' => 'wpcf7-form-control wpcf7-login btn btn-primary',
			'comment_field' => '<textarea cols="40" rows="4" id="comment" class="col-lg-11 col-md-10 col-12 wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" name="comment"></textarea>',
			'title_reply' => '',
			'logged_in_as' => '',
			'must_log_in' => '<p class="must-log-in px-3">Lo siento, debes estar conectado para publicar un comentario. <a class="must-log-in-link px-3" href="' . $grupo_header['pagina_quiero_participar'] . '">Iniciar Sesión</a></p>',
			'submit_field' => '<p class="col-lg-1 col-md-2 col-12 mt-3 my-md-auto">%1$s %2$s</p>',
			'submit_button' => '<button name="%1$s" type="submit" id="submit_comment" class="%3$s d-block mx-auto" value="" disabled><i class="fa fa-chevron-right"></i></button>'
		);
		
		comment_form($comment_args);

	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<?php the_comments_navigation(); ?>

		<ul class="list-group list-comments">
			<?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
		</ul>


		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tips-digitales' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	?>

</div><!-- #comments -->
