<?php
	// Header
	get_header();
?>

<div class="contentColumn">
<?php
	// Content for static pages
	if (have_posts()) : while (have_posts()) : the_post();
?>
<?php the_content(); ?>
<?php endwhile; endif; ?>
</div>

<?php
	// Sidebar
	get_sidebar();
?>

<?php
	// Footer
	get_footer();
?>