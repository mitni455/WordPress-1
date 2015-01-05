<?php

	/*
		STOP
		-------------------------------
		Serifly Theme Options Panel 1.1
		Updated on October 27th, 2012
		http://serifly.com
		
		Copyright (c) 2012 Serifly.com
	*/

	// Set prefix for theme options
	$prefix = 'serifly_timeline_';
		
	// Configure theme options
	add_action('admin_init', 'theme_options_init');
	add_action('admin_menu', 'theme_options_add_page');
	add_action('admin_print_scripts', 'theme_options_scripts');
	add_action('admin_print_styles', 'theme_options_styles');

	function theme_options_init()
	{
		global $prefix;
		
		register_setting($prefix . 'options', $prefix . 'theme_options', 'theme_options_validate');
	}

	function theme_options_add_page()
	{
		add_theme_page( __('Theme Options', 'serifly'), __('Theme Options', 'serifly'), 'edit_theme_options', 'theme_options', 'theme_options_build_panel');
	}
	
	function theme_options_scripts()
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('farbtastic');
		wp_register_script('my-upload', get_template_directory_uri() . '/admin/js/admin.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
	}
	
	function theme_options_styles()
	{
		wp_enqueue_style('thickbox');
		wp_enqueue_style('farbtastic');
		wp_enqueue_style('admin', get_template_directory_uri() . '/admin/css/admin.css');
	}

	// Render theme options page
	function theme_options_build_panel()
	{
		global $prefix;
	
		if (!isset($_REQUEST['settings-updated']))
		{
			$_REQUEST['settings-updated'] = false;
		}
		
		require(get_template_directory() . '/admin/admin-setup.php');
		require(get_template_directory() . '/admin/admin-interface.php');
	}
	
	// Validate theme options
	function theme_options_validate($input)
	{	
		// Styling: Colors
		$input['styling_base_color'] = str_replace('#', '', $input['styling_base_color']);
		$input['styling_header_color'] = str_replace('#', '', $input['styling_header_color']);
						
		// Return values to Wordpress
		return $input;
	}
	
	// Import and export theme options
	if (isset($_POST, $_POST['serifly_theme_export']))
	{
		$options = base64_decode($_POST['serifly_theme_export']);
	
		header('Content-Type: text/plain');
		header('Content-length: ' . strlen($options)); 
		header('Content-Disposition: attachment; filename="' . $prefix . 'theme_options_export.' . time() . '.txt"'); 
		
		echo $options;
		exit();
	}
	else if (isset($_FILES, $_FILES['serifly_theme_import']) && $_FILES['serifly_theme_import']['name'] != '')
	{		
		if ($options = @unserialize(file_get_contents($_FILES['serifly_theme_import']['tmp_name'])))
		{
			update_option($prefix . 'theme_options', $options);
			
			$serifly_theme_import_error = false;
		}
		else
		{
			$serifly_theme_import_error = true;
		}
	}

?>