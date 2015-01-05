<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<!-- Theme by Serifly (http://serifly.com) / Powered by Wordpress (http://wordpress.org) -->
	<head>
		<!-- Title -->
		<?php if (serifly_option('general_title')): ?>
		<title><?php wp_title(''); ?></title>
		<?php else: ?>
		<title><?php wp_title('&middot;', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<?php endif; ?>
		<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!-- Favicon -->
		<?php if (serifly_option('general_favicon_url')): ?>
		<link rel="shortcut icon" href="<?php echo serifly_option('general_favicon_url'); ?>" />
		<?php else: ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" />
		<?php endif; ?>
		<!-- RSS -->
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if (serifly_option('general_custom_feed')) { echo serifly_option('general_custom_feed'); } else { bloginfo('rss2_url'); } ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<script type="text/javascript">var url = '<?php echo get_template_directory_uri(); ?>';<?php if (serifly_option('general_navigation_label')) echo 'var navigationLabel = \'' . serifly_option('general_navigation_label') . '\';' ?></script>
		<?php
			// Comment reply script
			if (is_singular())
			{
				wp_enqueue_script('comment-reply');	
			}
			
			// WordPress header
			wp_head();
			
			// Custom syles set in the theme options
			serifly_custom_theme();
		?>
	</head>
	<body <?php body_class(); ?>>
		<div id="wrapper">
			<!-- Header -->
			<div id="header"<?php if(is_admin_bar_showing()) echo ' style="top: 28px;"' ?>>
				<div class="wrapper">
					<a class="logo" href="<?php echo home_url(); ?>">
						<?php if (serifly_option('header_text_logo') && serifly_option('header_text_logo_value')): ?>
						<span><?php echo serifly_option('header_text_logo_value'); ?></span>
						<?php elseif (serifly_option('header_image_logo_url')): ?>
						<img src="<?php echo serifly_option('header_image_logo_url'); ?>" alt="Logo" />
						<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/layout/logo.png" alt="Logo" />
						<?php endif; ?>
					</a>
					<?php
						// Insert main navigation
						wp_nav_menu
						(
							array
							(
								'menu_class' => 'navigation',
								'theme_location' => 'primary-menu', 
								'container' => '',
								'depth' => 3
							)
						); 
					?>
					<?php if (!is_page_template('timeline.php')): ?>
					<?php if (!serifly_option('header_hide_search') || serifly_option('header_optional_text')): ?>
					<div class="optional">
						<?php if (serifly_option('header_hide_search') && serifly_option('header_optional_text')): ?>
						<div<?php if (serifly_option('header_optional_icon')) echo ' class="' . serifly_option('header_optional_icon') . '"'; ?>>
							<?php echo serifly_option('header_optional_text'); ?>
						</div>
						<?php else: ?>
						<?php get_search_form(); ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php else: ?>
					<ul class="timelineControl">
						<li class="prev">
						</li>
						<li class="next">
						</li>
						<li class="sidebar<?php if (serifly_option('timeline_full_width')) echo ' hidden'; ?>">
						</li>
					</ul>
					<?php endif; ?>
					<?php
						// Check and display social links
						if (
							serifly_option('social_twitter') ||
							serifly_option('social_facebook') ||
							serifly_option('social_google') ||
							serifly_option('social_dribbble') ||
							serifly_option('social_forrst') ||
							serifly_option('social_vimeo') ||
							serifly_option('social_youtube') ||
							serifly_option('social_flickr') ||
							serifly_option('social_pinterest')
						):
					?>
					<!-- Social Links -->
					<ul class="social<?php if (is_page_template('timeline.php')) echo ' socialHide'; ?>">
						<?php if (serifly_option('social_twitter')) echo '<li><a class="twitter" href="' . serifly_option('social_twitter') . '"></a></li>'; ?>
						<?php if (serifly_option('social_facebook')) echo '<li><a class="facebook" href="' . serifly_option('social_facebook') . '"></a></li>'; ?>
						<?php if (serifly_option('social_google')) echo '<li><a class="google" href="' . serifly_option('social_google') . '"></a></li>'; ?>
						<?php if (serifly_option('social_dribbble')) echo '<li><a class="dribbble" href="' . serifly_option('social_dribbble') . '"></a></li>'; ?>
						<?php if (serifly_option('social_forrst')) echo '<li><a class="forrst" href="' . serifly_option('social_forrst') . '"></a></li>'; ?>
						<?php if (serifly_option('social_vimeo')) echo '<li><a class="vimeo" href="' . serifly_option('social_vimeo') . '"></a></li>'; ?>
						<?php if (serifly_option('social_youtube')) echo '<li><a class="youtube" href="' . serifly_option('social_youtube') . '"></a></li>'; ?>
						<?php if (serifly_option('social_flickr')) echo '<li><a class="flickr" href="' . serifly_option('social_flickr') . '"></a></li>'; ?>
						<?php if (serifly_option('social_pinterest')) echo '<li><a class="pinterest" href="' . serifly_option('social_pinterest') . '"></a></li>'; ?>
					</ul>
					<?php endif; ?>
				</div>
			</div>
			<!-- Content -->
			<div id="content">
				<?php
					// Change hero unit if search is being displayed
					if (is_search())
					{
						global $wp_query;
						global $searchCount;
						$searchCount = $wp_query->found_posts;
						$searchKey = esc_html($s);
						
						$heroUnit = array
						(
							'hero_title' => __('Search', 'serifly'),
							'hero_subtitle' => __('Your search for ', 'serifly') . '<strong>' . $searchKey . '</strong>' . __(' returned ', 'serifly') . '<strong>' . $searchCount . '</strong>' . (($searchCount == 1) ? __(' result', 'serifly') : __(' results', 'serifly')) . '.'
						);
					}
					else if (is_404())
					{
						$heroUnit = array
						(
							'hero_title' => __('404', 'serifly') . '<span>,</span><br />' . __('Page Not Found', 'serifly'),
							'hero_subtitle' => __('Sorry, the page you are looking for could not be found.', 'serifly')
						);
						
						$heroStyle = ' pageMissing';
					}
					else
					{
						$heroUnit = get_hero_unit();
					}
					
					// Display hero unit if set
					if (isset($heroUnit, $heroUnit['hero_title']) && $heroUnit['hero_title'] != ''):
				?>
				<!-- Hero Unit -->
				<div class="heroUnit<?php if (isset($heroStyle)) echo $heroStyle; ?>">
					<div class="wrapper">
						<h1><?php echo $heroUnit['hero_title']; ?></h1>
						<?php if (isset($heroUnit['hero_subtitle']) && $heroUnit['hero_subtitle'] != ''): ?>
						<p><?php echo $heroUnit['hero_subtitle']; ?></p>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="wrapper clearfix">