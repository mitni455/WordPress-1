<?php
	// Blog post content template
?>
<div <?php post_class(($wp_query->current_post == 0) ? 'blogPost noTopMargin' : 'blogPost'); if(($wp_query->current_post + 1) == ($wp_query->post_count)) { echo ' id="lastPost"'; } ?>>
	<div class="blogPostHeader">
		<a class="date" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><span class="month"><?php if (serifly_option('blog_short_date')) { the_time('M'); } else { the_time('F'); } ?></span><span class="day"><?php the_time('j'); ?></span></a>
		<div class="title">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php
				// Blog post header				
			?>
			<p><?php if (!serifly_option('blog_hide_label')): ?><?php _e('Published', 'serifly'); ?><?php endif; ?><?php if (!serifly_option('blog_hide_author')): ?> <?php _e('by', 'serifly'); ?> <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a><?php endif; ?><?php if (serifly_option('blog_show_time')): ?> <?php _e('at', 'serifly'); ?> <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo the_time(get_option('time_format')); ?></a><?php endif; ?><?php if (!serifly_option('blog_hide_category')): ?> <?php _e('in', 'serifly'); ?> <a href="<?php $category = get_the_category(); echo get_category_link($category[0]->cat_ID); ?>"><?php echo $category[0]->cat_name; ?></a><?php endif; ?><?php if (!serifly_option('blog_hide_comments')): ?> <?php _e('with', 'serifly'); echo ' '; comments_popup_link(__('No Comments', 'serifly'), __('1 Comment', 'serifly'), __('% Comments', 'serifly')); ?><?php endif; ?></p>
		</div>
		<div class="clearfix">
		</div>
	</div>
<?php
	// Get comments for single post
	if (is_single()):
?>
	<?php the_content(); wp_link_pages(); ?>
	<?php the_tags('<ul class="tags"><li>', '</li><li>', '</li></ul>'); ?>
	<div class="clearfix">
	</div>
</div>
<?php if (!serifly_option('blog_hide_comments')): ?>
<div class="blogPostComments">
	<?php comments_template('', true); ?>
	<div class="clearfix">
	</div>
</div>
<?php endif; ?>
<?php else: ?>
	<?php
		// Show "Read More" tag and tags		
	?>
	<?php the_content('<span>' . ((serifly_option('blog_read_more')) ? serifly_option('blog_read_more') : __('Read More', 'serifly')) . '</span>'); ?>
	<?php the_tags('<ul class="tags"><li>', '</li><li>', '</li></ul>'); ?>
	<div class="clearfix">
	</div>
</div>
<?php endif; ?>