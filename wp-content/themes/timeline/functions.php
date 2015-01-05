<?php
	
	// Enable widget awareness
	if (function_exists('register_sidebar'))
	{
		register_sidebar(array(
			'name' => 'Main Sidebar',
			'id' => 'main-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div><div class="clearfix"></div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		));
		
		register_sidebar(array(
			'name' => 'Page Sidebar',
			'id' => 'page-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div><div class="clearfix"></div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		));
		
		register_sidebar(array(
			'name' => 'Contact Sidebar',
			'id' => 'contact-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div><div class="clearfix"></div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		));
		
		register_sidebar(array(
			'name' => 'Large Footer',
			'id' => 'large-footer',
			'before_widget' => '<div class="widget oneThird widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5><span>',
			'after_title' => '</span></h5>',
		));
	}
				
	// More efficient option delivery
	function serifly_option($option)
	{
		global $seriflyOptions;
	
		if (!isset($seriflyOptions))
		{	
			$seriflyOptions = get_option('serifly_timeline_theme_options');
		}
		
		if (isset($seriflyOptions[$option]) && $seriflyOptions[$option])
		{
			return $seriflyOptions[$option];
		}
		else
		{
			return false;
		}
	}
			
	// Catch buffer
	function callback($buffer)
	{
		// Replace default line break
		return str_replace('<p>&nbsp;</p>', '<p class="break"></p>', $buffer);
	}
	
	function buffer_start()
	{
		ob_start('callback');
	}
	
	function buffer_end()
	{
		ob_end_flush();
	}
		
	// Prioritize custom shortcodes
	function serifly_shortcodes($content)
	{
		global $shortcode_tags, $seriflyShortcodesExtended;
		$shortcode_temp = $shortcode_tags;
		remove_all_shortcodes();
		
		foreach ($seriflyShortcodesExtended as $shortcodeKey => $shortcodeValue)
		{
			add_shortcode($shortcodeKey, 'serifly_' . $shortcodeKey);
		}
						
		$content = do_shortcode($content);
		$shortcode_tags = $shortcode_temp;
		
		return $content;
	}
	
	// Add buffer functions to hooks
	add_action('wp_head', 'buffer_start');
	add_action('wp_footer', 'buffer_end');
	
	// Handle theme options panel
	require(get_template_directory() . '/admin/admin-init.php');
	
	// Load custom post types
	require(get_template_directory() . '/functions/timeline-post-types.php');
	
	// Load custom comments
	require(get_template_directory() . '/functions/custom-comments.php');
	
	// Load meta boxes
	require(get_template_directory() . '/functions/hero-unit-meta-box.php');
	require(get_template_directory() . '/functions/theme-shortcodes-browser.php');
	
	// Load custom gallery function
	require(get_template_directory() . '/functions/custom-gallery.php');
	
	// Load custom theme function
	require(get_template_directory() . '/functions/custom-theme.php');
	
	// Load custom widget functions
	require(get_template_directory() . '/functions/widget-twitter.php');
	require(get_template_directory() . '/functions/widget-timeline.php');
	
	// Load custom shortcodes
	require(get_template_directory() . '/functions/theme-shortcodes.php');
			
	// Activate feed functions
	add_theme_support('automatic-feed-links');
			
	// Load translation domain
	load_theme_textdomain ('serifly');
	
	// Exclude pages from search
	function serifly_exclude_pages($query)
	{
		if ($query->is_search)
		{
			$query->set('post_type', 'post');
		}
		
		return $query;
	}
	
	add_filter('pre_get_posts','serifly_exclude_pages');
	
	// Register navigation
	function register_menu()
	{
		register_nav_menu('primary-menu', __('Primary Menu', 'serifly'));
	}
	
	add_action('init', 'register_menu');
    
    // Add image sizes for timeline
    add_image_size('timeline-preview', 300);  
    add_image_size('timeline-large', 0, 600);
    
    // Load required theme scripts
    function theme_scripts()
    {
    	wp_enqueue_script('jquery');
    	wp_register_script('jquery-ui-custom', get_template_directory_uri() . '/js/jquery-ui-1.9.0.custom.min.js');
    	wp_enqueue_script('jquery-ui-custom');
    	wp_register_script('jquery-slider-min', get_template_directory_uri() . '/js/jquery.slider.min.js');
    	wp_enqueue_script('jquery-slider-min');
    	wp_register_script('jquery-init', get_template_directory_uri() . '/js/jquery.init.js');
    	wp_enqueue_script('jquery-init');
    }
    
    add_action('wp_print_scripts', 'theme_scripts'); 
    
    // Load required theme styles
    function theme_styles()
    {
    	wp_register_style('timeline', get_template_directory_uri() . '/style.css');
    	wp_enqueue_style('timeline');
    }
    
    add_action('wp_print_styles', 'theme_styles');
	
    // Add custom shortcodes with higher priority
	add_filter('the_content', 'serifly_shortcodes', 7);
	add_filter('widget_text', 'serifly_shortcodes', 7);
	
	// Allow default shortcodes in text widgets
	add_filter('widget_text', 'do_shortcode');
	
	// Set content width
	if (!isset($content_width))
	{
		$content_width = 1200;
	}
	
	// Adapt editor
	add_editor_style('css/custom-editor-style.css');
	
?>