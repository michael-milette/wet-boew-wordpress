<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to wet_boew_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage wet-boew
 * @since wet-boew 4.0
 */
?>
<section id="comments">
<h2 class="wb-inv"><?php _e( 'Comments', 'wet-boew' ); ?></h2>
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to see all the comments.', 'wet-boew' ); ?></p>
	</section><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
		<section>
			<h3 id="comments-title"><?php
			printf( _n( __("An answer to", 'wet-boew') . ' %2$s', '%1$s ' . __("in response to", 'wet-boew') . ' %2$s', get_comments_number(), 'wet-boew' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> ' . __( 'Older comments', 'wet-boew' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'More recent comments', 'wet-boew' ) . ' <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div>
	<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use clf2v2_nsi2v2_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define clf2v2_nsi2v2_comment() and that will be used instead.
					 * See clf2v2_nsi2v2_comment() in clf2v2_nsi2v2/functions.php for more.
					 */
					wp_list_comments( array( 'reply_text' => __("Respond", 'wet-boew'), 'login_text' => __("Login to comment", 'wet-boew'), 'callback' => 'wet_boew_comment' ) );
				?>
			</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span>' . __( 'Older comments', 'wet-boew' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'More recent comments', 'wet-boew' ) . ' <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div>
	<?php endif; // check for comment navigation ?>
		</section>
<?php else :

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'wet-boew' ); ?></p>
	<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 
	comment_form(
		array( 
			'fields' => 
				apply_filters( 
					'comment_form_default_fields', 
					
					array( 
						'author' => '<p class="comment-form-author">' . 
							'<label for="author" class="required"><span class="field-name">' . 
							__('Name', 'wet-boew') . 
							'</span> <strong class="required">' . 
							_x( '(required)', 'noun', 'wet-boew' ) . 
							'</strong></label> ' . 
							( $req ? '<span class="required">*</span>' : '' ) . 
							'<input id="author" name="author" type="text" value="' . 
							esc_attr( $commenter[ 'comment_author' ] ) . '" size="30"' . $aria_req . 
							' /></p>', 
						
						'email' => 
							'<p class="comment-form-email"><label for="email" class="required"><span class="field-name">' . 
							__('Email', 'wet-boew') . 
							'</span> <strong class="required">' . 
							_x( '(required)', 'noun', 'wet-boew' ) . 
							'</strong></label> ' . 
							( $req ? '<span class="required" >*</span>' : '' ) . 
							'<input id="email" name="email" type="text" value="' . 
							esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . 
							' /></p>', 
						
						'url'    => '<p class="comment-form-url"><label for="url">' . __('Website', 'wet-boew') . '</label>' . 
							'<input id="url" name="url" type="text" value="' . 
							esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' 
					) 
				), 

			'title_reply' => __("Submit a response", 'wet-boew'), 
			
			'title_reply_to' => __("Submit a response to %s", 'wet-boew'),

			'cancel_reply_link' => __("Cancel the response", 'wet-boew'), 
			
			'label_submit' => __("Send your comment", 'wet-boew'), 
			
			'comment_field' => '<div class="form-group"><label for="comment" class="required"><span class="field-name">' . 
				_x( 'Comment', 'noun', 'wet-boew' ) . 
				'</span> <strong class="required">' . 
				_x( '(required)', 'noun', 'wet-boew' ) . 
				'</strong></label> <a class="wb-lbx" href="#comment-info-popup" aria-controls="comment-info-popup" role="button"><span class=" glyphicon glyphicon-info-sign"></span><span class="wb-inv">' . __('Information') . '</span></a><textarea id="comment" name="comment" cols="45" rows="3" required="required" class="form-control"></textarea></div>', 
			
			'logged_in_as' => '<p class="logged-in-as">' . 
				sprintf( 
					__( 'You are logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Logout?</a>', 'wet-boew' ), 
					admin_url( 'profile.php' ), 
					$user_identity,
					wp_logout_url(
						apply_filters( 'the_permalink', get_permalink( $post_id ) ) 
					)
				) . '</p>',

			'comment_notes_before' => '<p class="comment-notes">' . 
				__('Your email address will not be published. You must complete all of the <span class="required"> <abbr title="asterisk">*</abbr> required fields.', 'wet-boew') .
					( $req ? $required_text : '' ) .
					'</p>' 
		) 
	); 
?>

	<section id="comment-info-popup" class="mfp-hide modal-dialog modal-content overlay-def">
		<header class="modal-header">
			<h3 class="modal-title"><?php _e( 'Your comment', 'wet-boew' ); ?></h3>
		</header>
		<div class="modal-body">
			<dl>
				<dt><?php _e( 'Content', 'wet-boew' ); ?></dt>
				<dd><?php _e( '<strong>Must</strong> be respectful and kind.', 'wet-boew' ); ?></dd>
				
				<dt><?php _e( 'Publishing', 'wet-boew' ); ?></dt>
				<dd><?php _e( '<strong>Clearly indicate</strong> if you do not want your comment to be published. This can be done by adding text similar to "message only for the author; private; do not publish;..." at the beginning or end of your comment.', 'wet-boew' ); ?></dd>
				
				<dt><?php _e( 'HTML attribute', 'wet-boew' ); ?></dt>
				<dd><?php echo( sprintf( __( 'You can use these HTML tags and attributes: <code>%s</code>', 'wet-boew' ), allowed_tags() ) ); ?></dd>
			</dl>
		</div>
	</section>
</section><!-- #comments -->
