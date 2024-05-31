<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area single-blog-bottom">
    <?php
		if ( have_comments() ):
		$sasby_comment_count = get_comments_number();
		$sasby_comments_text = number_format_i18n( $sasby_comment_count ) . ' ';
		if ( $sasby_comment_count > 1 && $sasby_comment_count != 0 ) {
			$sasby_comments_text .= esc_html__( 'Comments', 'sasby' );
		} else if ( $sasby_comment_count == 0 ) {
			$sasby_comments_text .= esc_html__( 'Comment', 'sasby' );
		} else {
			$sasby_comments_text .= esc_html__( 'Comment', 'sasby' );
		}
	?>
		<h3><?php echo esc_html( $sasby_comments_text );?></h3>
	<?php
		$sasby_avatar = get_option( 'show_avatars' );
	?>
		<ul class="comment-list<?php echo empty( $sasby_avatar ) ? ' avatar-disabled' : '';?>">
		<?php
			wp_list_comments(
				array(
					'style'             => 'ul',
					'callback'          => 'SasbyTheme_Helper::comments_callback',
					'reply_text'        => esc_html__( 'Reply', 'sasby' ),
					'avatar_size'       => 90,
					'format'            => 'html5',
					)
				);
		?>
		</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav class="pagination-area comment-navigation">
				<ul>
					<li><?php previous_comments_link( esc_html__( 'Older Comments', 'sasby' ) ); ?></li>
					<li><?php next_comments_link( esc_html__( 'Newer Comments', 'sasby' ) ); ?></li>
				</ul>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation.?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sasby' ); ?></p>
	<?php endif;?>
	<div>
	<?php
		$sasby_commenter = wp_get_current_commenter();
		$sasby_req = get_option( 'require_name_email' );
		$sasby_aria_req = ( $sasby_req ? " required" : '' );

		$sasby_fields =  array(
			'author' =>
			'<div class="row"><div class="col-sm-6"><div class="form-group comment-form-author"><input type="text" id="author" name="author" value="' . esc_attr( $sasby_commenter['comment_author'] ) . '" placeholder="'. esc_attr__( 'Name', 'sasby' ).( $sasby_req ? ' *' : '' ).'" class="form-control"' . $sasby_aria_req . '></div></div>',

			'email' =>
			'<div class="col-sm-6 comment-form-email"><div class="form-group"><input id="email" name="email" type="email" value="' . esc_attr(  $sasby_commenter['comment_author_email'] ) . '" class="form-control" placeholder="'. esc_attr__( 'Email', 'sasby' ).( $sasby_req ? ' *' : '' ).'"' . $sasby_aria_req . '></div></div></div>',
			);

		$sasby_args = array(
			'class_submit'      => 'submit btn-send ghost-on-hover-btn',
			'submit_field'         => '<div class="form-group form-submit">%1$s %2$s</div>',
			'comment_field' =>  '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" required placeholder="'.esc_attr__( 'Comment *', 'sasby' ).'" class="textarea form-control" rows="10" cols="40"></textarea></div>',
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</h3>',
			'fields' => apply_filters( 'comment_form_default_fields', $sasby_fields ),
			);

	?>
	<?php comment_form( $sasby_args );?>
	</div>
</div>