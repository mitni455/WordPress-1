<?php
/*
	Template Name: Full Width
*/
?>

<?php
	// Header
	get_header();
?>

<div class="contentColumn fullWidth">
<?php
	// Content
	if (have_posts()) : while (have_posts()) : the_post();
?>
<?php the_content(); ?>
<?php endwhile; endif; ?>
</div>

<?php
	// Footer
	get_footer();
?>