<h1 id="comments-title"> Comments (<?php echo get_comments_number(); ?>) </h1>

<?php
$comment_form_args = array(
    'label_submit' => 'Send',
    'title_reply' => 'Write a Comment',
    'comments_notes_after' => '',
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
    'must_log_in' => 'You must login before commenting on a comic.',
);

comment_form( $comment_form_args );

$comments = wp_list_comments();

// Comment Loop
if ( $comments ) {
	foreach ( $comments as $comment ) {
		echo '<p>' . $comment->comment_content . '</p>';
	}
} else {
	echo 'No comments found.';
}
?>
