<?php
	// Page sidebar setup & responsive design
	if (function_exists('dynamic_sidebar') && is_page()):
?>
<div class="widgetColumn">
	<?php if (!serifly_option('header_hide_search') || serifly_option('header_optional_text')): ?>
	<div class="optional sidebarOptional">
		<?php if (serifly_option('header_hide_search') && serifly_option('header_optional_text')): ?>
		<div<?php if (serifly_option('header_optional_icon')) echo ' class="' . serifly_option('header_optional_icon') . '"'; ?>>
			<?php echo serifly_option('header_optional_text'); ?>
		</div>
		<?php else: ?>
		<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (is_active_sidebar('page-sidebar')): ?>
	<?php dynamic_sidebar('Page Sidebar'); ?>
	<?php else: ?>
	<p>Please set up the <strong>Page Sidebar</strong> in your WordPress backend.</p>
	<p class="break"></p>
	<p>Choose the template <strong>Full Width</strong> to hide the sidebar on pages.</p>
	<?php endif; ?>
</div>
<?php
	// Default sidebar displayed with blog and posts & responsive design
	elseif (function_exists('dynamic_sidebar') && !is_page()):
?>
<div class="widgetColumn">
	<?php if (!serifly_option('header_hide_search') || serifly_option('header_optional_text')): ?>
	<div class="optional sidebarOptional">
		<?php if (serifly_option('header_hide_search') && serifly_option('header_optional_text')): ?>
		<div<?php if (serifly_option('header_optional_icon')) echo ' class="' . serifly_option('header_optional_icon') . '"'; ?>>
			<?php echo serifly_option('header_optional_text'); ?>
		</div>
		<?php else: ?>
		<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (is_active_sidebar('main-sidebar')): ?>
	<?php dynamic_sidebar('Main Sidebar'); ?>
	<?php else: ?>
	<p>Please set up the <strong>Main Sidebar</strong> in your WordPress backend.</p>
	<?php endif; ?>
</div>
<?php endif; ?>