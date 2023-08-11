<h1 id="comments-title"> Comments (<?php echo get_comments_number(); ?>) </h1>

<?php
$comment_form_args = array(
    'label_submit' => '↲',
    'title_reply' => 'Write a Comment',
    'comments_notes_after' => '',
    'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
    'must_log_in' => 'You must login before commenting on a comic.',
    'logged_in_as' => '',
);

comment_form( $comment_form_args );
?>

<h3 id="discussion-title"> Discussion </h3>

<?php
$comments = wp_list_comments();

// Comment Loop
if ( $comments ) {
	foreach ( $comments as $comment ) {
		echo '<p>' . $comment->comment_content . '</p>';
	}
} else {
}
?>
