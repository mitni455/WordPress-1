<?php
	// Check if password is required to comment
	if(post_password_required())
	{
		return;
	}
?>

<?php
	// Show comments via function
	if (have_comments() && !empty($comments_by_type['comment'])):
?>
<h3 id="comments"><?php comments_number(__('No Comments', 'serifly'), __('1 Comment', 'serifly'), __('% Comments', 'serifly')); ?></h3>
<?php wp_list_comments('type=comment&callback=custom_comment&avatar_size=32&style=div&max_depth=5'); ?>

<?php
	// Comments pagination
	if ((int)get_option('page_comments') === 1):
?>
<div class="blogPageSwitch">
	<?php previous_comments_link(__('Older Comments', 'serifly')); ?>
	<?php next_comments_link(__('Newer Comments', 'serifly')); ?>
	<div class="clearfix">
	</div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php
	// Comments reply form
	if (!comments_open() or is_page() or !post_type_supports(get_post_type(), 'comments')):
?>
<p class="commentsClosed"><em><?php _e('Comments are closed.', 'serifly'); ?></em></p>
<?php else: ?>
	<?php 		
		$comments_args = array
		(
			'title_reply' => __('Leave a Comment', 'serifly'),
			'cancel_reply_link' => __('Cancel Reply', 'serifly'),
			'comment_notes_after' => '<p class="form-allowed-tags"><code>' . allowed_tags() . '</code></p>'
		);
		
		comment_form($comments_args);
	?>
<?php endif; ?>