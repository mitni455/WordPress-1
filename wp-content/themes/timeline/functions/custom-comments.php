<?php
	
	// Custom comment function
	function custom_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
	
		// HTML Starts
		?>
		
		<div id="comment-<?php comment_ID(); ?>" <?php comment_class('comment clearfix'); ?>>
			<?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
			<div class="commentContent">
				<p class="commentHeader"><?php the_author_meta('user_url'); ?><?php printf(__('%s', 'serifly'), get_comment_author_link()); ?> <?php if(get_comment_date('Ymd') == date('Ymd')){ _e('at', 'serifly'); echo ' ' . get_comment_time(get_option('time_format')); } else { _e('on', 'serifly'); echo ' ' . get_comment_date(get_option('date_format')); } ?><?php edit_comment_link(__('Edit Comment', 'serifly'), ' &nbsp;&middot;&nbsp; ', ''); ?> <?php comment_reply_link(array_merge($args, array('before' => ' &nbsp;&middot;&nbsp; ', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>
				<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0'): ?>
				<p class="waiting"><em><?php _e('Your comment is awaiting approval.', 'serifly') ?></em></p>
				<?php endif; ?>
			</div>
		<?php // </div> - Added by Wordpress ?>
				
		<?php
		// HTML Ends
	}
	
?>