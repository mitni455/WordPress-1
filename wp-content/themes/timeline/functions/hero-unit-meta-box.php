<?php

	// Add custom post values
    function pages_hero_unit()
    {
	    add_meta_box('hero_unit_box', __('Hero Unit', 'serifly'), 'init_hero_unit', 'page', 'normal', 'low');
    }
    
    function init_hero_unit()
	{
		global $post;
		$heroUnit = get_hero_unit();
				
		// HTML Starts
		?>
		
		<!-- Meta CSS -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/css/meta.css" type="text/css" />
		
		<div id="hero_unit_box" class="meta">
			<div class="row">
				<label for="hero_title">Title</label>
				<input id="hero_title" type="text" name="hero_title"<?php if (isset($heroUnit, $heroUnit['hero_title']) && $heroUnit['hero_title'] != '') echo ' value="' . htmlentities($heroUnit['hero_title']) . '"'; ?> />
				<p class="help">Enter the headline for your hero unit. Use <strong><?php echo htmlentities('<br />'); ?></strong> to create a line break and <strong><?php echo htmlentities('<span>Grey Text</span>'); ?></strong> to color the text in between grey.</p>
			</div>
			<div class="row">
				<label for="hero_subtitle">Subtitle</label>
				<input id="hero_subtitle" type="text" name="hero_subtitle"<?php if (isset($heroUnit, $heroUnit['hero_subtitle']) && $heroUnit['hero_subtitle'] != '') echo ' value="' . htmlentities($heroUnit['hero_subtitle']) . '"'; ?> />
				<p class="help">Enter a subtitle below your headline. Use <strong><?php echo htmlentities('<a href="http://google.com">Google</a>'); ?></strong> to create a link.</p>
			</div>
		</div>
		
		<?php
		// HTML Ends
    }
    
    function get_hero_unit()
    {
	    global $post;
	    
	    if (is_home())
	    {
			$heroPage = get_option('page_for_posts');
	    }
	    else if (isset($post->ID))
	    {
		    $heroPage = $post->ID;
	    }
	    	    
	    if (isset($heroPage))
	    {
	    	return get_post_meta($heroPage, 'hero_unit', true);
	    }
	    else
	    {
		    return false;
	    }
    }
    
    function save_pages_hero_unit()
    {
	    global $post;
	    
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		{
			return $post_ID;
		}
		
		if ($_POST && isset($post->post_type) && $post->post_type == 'page')
		{		
			if (isset($_POST['hero_title'], $_POST['hero_subtitle']))
			{
				update_post_meta($post->ID, 'hero_unit', array('hero_title' => $_POST['hero_title'], 'hero_subtitle' => $_POST['hero_subtitle']));
			}
		}
    }
      
    add_action('admin_init', 'pages_hero_unit');   
    add_action('save_post', 'save_pages_hero_unit');

?>