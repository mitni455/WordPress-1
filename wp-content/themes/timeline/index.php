<?php
	// Header
	get_header();
?>

<div class="contentColumn">
<!-- Content -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php get_template_part('content', get_post_format()); ?>
<?php endwhile; endif; ?>
<?php
	// Check if search was called
	if (isset($searchCount))
	{
		$postCount = $searchCount;
	}
	else if (is_category())
	{
		$postCount = get_the_category();
		$postCount = $postCount[0]->category_count;
	}
	else
	{
		$postCount = wp_count_posts();
		$postCount = $postCount->publish;
	}
		
	// Get post pages for navigation
	$postPage = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$postPages = ceil($postCount / get_option('posts_per_page'));
?>
<?php if ($postPages > 1): ?>
<div class="blogPageSwitch">
	<?php previous_posts_link(__('Newer Entries', 'serifly')) ?><?php next_posts_link(__('Older Entries', 'serifly')) ?>
	<div class="clearfix">
	</div>
</div>
<?php else: ?>
<?php
	// Show errors if no posts are being displayed
	if (isset($searchCount) && $searchCount == 0)
	{
		echo '<p class="space"></p><p>';
		_e('Your search did not return any results.', 'serifly');
		echo '</p>';
	}
	else if($postCount == 0)
	{
		echo '<p class="space"></p><p>';
		_e('There are no posts to display yet.', 'serifly');
		echo '</p>';
	}
?>
<?php endif; ?>
</div>

<?php
	// Sidebar
	get_sidebar();
?>

<?php
	// Footer
	get_footer();
?>