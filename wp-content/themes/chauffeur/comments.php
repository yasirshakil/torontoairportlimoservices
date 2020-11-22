<?php if ( post_password_required() ) {return;}

/*-----------------------------------------------------------------------*/
/*	Display Comments
/*-----------------------------------------------------------------------*/

?>

<!-- BEGIN #respond-wrapper -->
<div id="respond-wrapper">

<?php if ( have_comments() ) : ?>
	
	<div class="clearboth"></div>
	
	<h4 class="comment-count-title"><?php comments_number(esc_html__('No comments', 'chauffeur'), esc_html__('1 Comment', 'chauffeur'), esc_html__('% Comments', 'chauffeur')); ?></h4>
	<div class="title-block7"></div>
	
	<ul class="comments">
		<?php wp_list_comments( array( 'callback' => 'chauffeur_comments' ) ); ?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
		<div class="chauffeur-comments-pagination">
			<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'chauffeur' ) ); ?>
			<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'chauffeur' ) ); ?>
		</div>
		
	<?php endif; ?>

<?php endif;

/*-----------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------*/

if ( comments_open() ) : 

	global $aria_req;
	global $chauffeur_allowed_html_array;
	
	comment_form( array(
		
		'comment_field'				=>	'<label for="comment">' . esc_html__('Comment', 'chauffeur') . '</label><textarea name="comment" id="comment" class="text_input" tabindex="4" rows="9" cols="60"></textarea>',
		
		'comment_notes_before'		=>	'',
		
		'comment_notes_after'		=>	'',
		
		'logged_in_as'				=>	'<p class="logged-in-as">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','chauffeur' ), $chauffeur_allowed_html_array ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
		
		'title_reply'				=>	wp_kses( __( 'Leave a Comment<span class="title-block7"></span>', 'chauffeur' ), $chauffeur_allowed_html_array ),
		
		'title_reply_to'			=>	esc_html__( 'Leave a Comment', 'chauffeur' ),
		
		'cancel_reply_link'			=>	esc_html__( 'Cancel Reply To Comment', 'chauffeur' ),
		
		'label_submit'				=>	esc_html__( 'Submit', 'chauffeur' ),
		
		'id_submit'					=>	'submit-button',
		
		'fields'					=>	array(
										
											'author'	=>	( $req ? '<label>' . esc_html__('Name', 'chauffeur') .' <span class="required">'.esc_html__('*', 'chauffeur').'</span></label>' : '' ) . '<input id="author" class="text_input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_html__( 'Name', 'chauffeur' ) . '" ' . $aria_req . ' />',
											
											'email'	    =>	( $req ? '<label>' . esc_html__('Email', 'chauffeur') .' <span class="required">'.esc_html__('*', 'chauffeur').'</span></label>' : '' ) . '<input id="email" class="text_input" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . esc_html__( 'Email', 'chauffeur' ) . '" ' . $aria_req . ' />',
																
											'url'		=>	'<label>' . esc_html__('Website', 'chauffeur') .' </label><input id="url" class="text_input" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_html__( 'Website', 'chauffeur' ) . '" />'
										)
										
	) );

?>

<?php endif; ?>

<!-- END #respond-wrapper -->
</div>