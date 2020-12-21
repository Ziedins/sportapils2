<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sportapils
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

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$sportapils_comment_count = get_comments_number();
			if ( '1' === $sportapils_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One comment', 'sportapils' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s comment', '%1$s comments', $sportapils_comment_count, 'comments title', 'sportapils' ) ),
					number_format_i18n( $sportapils_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
                    'callback' => 'sp_comment'
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sportapils' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

    comment_form(
        array(
            'title_reply' => '<h4 class="post-header"><span class="post-header">' . __( 'Izsaki savu viedokli', 'sportapils' ) . '</span></h4>',
            'comment_notes_before' => '<p class="comment-notes">' . __( 'Jūsu e-pasta adrese netiks publicēta. Obligātie lauki ir atzīmēti kā', 'sportapils' ) . ' <span class="required">*</span></p>',
            'logged_in_as' => false,
            'label_submit' => __( 'Pievieno komentāru', 'sportapils' ),
            'fields' => [
                'author' => '<p class="comment-form-author">
                                <input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required"
                                placeholder="'
                                . __( 'Vārds *', 'sportapils') .'">
                                </p>',
                'email' => '<p class="comment-form-email">
                            <input id="email" name="email" type="email" value="" size="30" maxlength="100" required="required"
                            placeholder="'
                            . __( 'Epasts *', 'sportapils') .'">
                            </p>',
                'cookies' => false,
            ]
        )
    );
	?>

</div><!-- #comments -->
