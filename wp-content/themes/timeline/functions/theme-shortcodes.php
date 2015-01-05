<?php
	
	// Extend all shortcodes
	$seriflyShortcodesExtended = array
	(
		'break' => array
		(
			'label' => 'Line Break',
			'desc' => '',
			'code' => '[break]'
		),
		'separator' => array
		(
			'label' => 'Separator',
			'desc' => '',
			'code' => '[separator]'
		),
		'separator_line' => array
		(
			'label' => 'Separator Line',
			'desc' => '',
			'code' => '[separator_line]'
		),
		'list' => array
		(
			'label' => 'Default List',
			'desc' => '',
			'code' => '[list]<ul><li>List item</li></ul>[/list]'
		),
		'tick_list' => array
		(
			'label' => 'Tick List',
			'desc' => '',
			'code' => '[tick_list]<ul><li>List item</li></ul>[/tick_list]'
		),
		'cross_list' => array
		(
			'label' => 'Cross List',
			'desc' => '',
			'code' => '[cross_list]<ul><li>List item</li></ul>[/cross_list]'
		),
		'testimonial' => array
		(
			'label' => 'Testimonial',
			'desc' => '',
			'code' => '[testimonial author=""][/testimonial]'
		),
		'button' => array
		(
			'label' => 'Button',
			'desc' => '',
			'code' => '[button url="" style="" size=""][/button]'
		),
		'map' => array
		(
			'label' => 'Embedded Map',
			'desc' => '',
			'code' => '[map location=""]'
		),
		'info_box' => array
		(
			'label' => 'Info Box',
			'desc' => '',
			'code' => '[info_box size=""]<br />[/info_box]'
		),
		'video' => array
		(
			'label' => 'Embedded Video',
			'desc' => '',
			'code' => '[video url=""]'
		),
		'gallery_shortcode' => array
		(
			'label' => 'Gallery',
			'desc' => '',
			'code' => '[gallery size=""]'
		),
		'one_half' => array
		(
			'label' => '50% Column',
			'desc' => '',
			'code' => '[one_half]<br />[/one_half]'
		),
		'one_half_last' => array
		(
			'label' => '50% Column &middot; Last in Row',
			'desc' => '',
			'code' => '[one_half_last]<br />[/one_half_last]'
		),
		'one_third' => array
		(
			'label' => '33% Column',
			'desc' => '',
			'code' => '[one_third]<br />[/one_third]'
		),
		'one_third_last' => array
		(
			'label' => '33% Column &middot; Last in Row',
			'desc' => '',
			'code' => '[one_third_last]<br />[/one_third_last]'
		),
		'two_third' => array
		(
			'label' => '66% Column',
			'desc' => '',
			'code' => '[two_third]<br />[/two_third]'
		),
		'two_third_last' => array
		(
			'label' => '66% Column &middot; Last in Row',
			'desc' => '',
			'code' => '[two_third_last]<br />[/two_third_last]'
		),
		'one_fourth' => array
		(
			'label' => '25% Column',
			'desc' => '',
			'code' => '[one_fourth]<br />[/one_fourth]'
		),
		'one_fourth_last' => array
		(
			'label' => '25% Column &middot; Last in Row',
			'desc' => '',
			'code' => '[one_fourth_last]<br />[/one_fourth_last]'
		),
		'three_fourth' => array
		(
			'label' => '75% Column',
			'desc' => '',
			'code' => '[three_fourth]<br />[/three_fourth]'
		),
		'three_fourth_last' => array
		(
			'label' => '75% Column &middot; Last in Row',
			'desc' => '',
			'code' => '[three_fourth_last]<br />[/three_fourth_last]'
		),
		'tab_wrapper' => array
		(
			'label' => 'Tabs Wrapper',
			'desc' => '',
			'code' => '[tab_wrapper]<br />[/tab_wrapper]'
		),
		'tab' => array
		(
			'label' => 'Tab Item',
			'desc' => '',
			'code' => '[tab label=""]<br />[/tab]'
		),
		'pricing_plans' => array
		(
			'label' => 'Pricing Plans Wrapper',
			'desc' => '',
			'code' => '[pricing_plans]<br />[/pricing_plans]'
		),
		'pricing_plans_header' => array
		(
			'label' => 'Pricing Plans Header',
			'desc' => '',
			'code' => '[pricing_plans_header title="" description="" price="" term=""]'
		),
		'pricing_plans_features' => array
		(
			'label' => 'Pricing Plans Features',
			'desc' => '',
			'code' => '[pricing_plans_features]<ul><li>List item</li></ul>[/pricing_plans_features]'
		),
		'pricing_plans_details' => array
		(
			'label' => 'Pricing Plans Details',
			'desc' => '',
			'code' => '[pricing_plans_details]<ul><li>List item</li></ul>[/pricing_plans_details]'
		),
		'pricing_plans_order' => array
		(
			'label' => 'Pricing Plans Order',
			'desc' => '',
			'code' => '[pricing_plans_order][button url="" style=""][/button][/pricing_plans_order]'
		),
		'table' => array
		(
			'label' => 'Table',
			'desc' => '',
			'code' => '[table]<br />[/table]'
		),
		'table_title' => array
		(
			'label' => 'Table Title',
			'desc' => '',
			'code' => '[table_title][/table_title]'
		),
		'table_row' => array
		(
			'label' => 'Table Row',
			'desc' => '',
			'code' => '[table_row]<br />[/table_row]'
		),
		'table_cell' => array
		(
			'label' => 'Table Cell',
			'desc' => '',
			'code' => '[table_cell][/table_cell]'
		),
		'table_cell_header' => array
		(
			'label' => 'Table Header Cell',
			'desc' => '',
			'code' => '[table_cell_header][/table_cell_header]'
		)
	);
	
	// Spacing
	function serifly_break($atts, $content = null)
	{
		return '<p class="break"></p>';
	}
		
	function serifly_separator($atts, $content = null)
	{
		return '<p class="separator"></p>';
	}
	
	function serifly_separator_line($atts, $content = null)
	{
		return '<p class="separatorLine"></p>';
	}
	
	// Lists
	function serifly_list($atts, $content = null)
	{
		return '<div class="list">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_tick_list($atts, $content = null)
	{
		return '<div class="listTick">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_cross_list($atts, $content = null)
	{
		return '<div class="listCross">' . do_shortcode($content) . '</div>';
	}
	
	// Testimonial
	function serifly_testimonial($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'author' => ''
	    ), $atts));
	
		return '<div class="testimonial"><p>' . do_shortcode($content) . (($author != '') ? '<br /><span>' . $author . '</span>' : '') . '</p></div>';
	}
	
	// Button
	function serifly_button($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'url' => '',
	        'style' => '',
	        'size' => ''
	    ), $atts));
	
		return '<a class="button' . (($style == 'light' || $style == 'grey' || $style == 'green') ? ' ' . $style : '') . (($size == 'auto') ? ' ' . $size : '') . '" href="' . $url . '"><span class="pointer">' . do_shortcode($content) . '</span></a>';
	}
	
	// Map	
	function serifly_map($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'location' => ''
	    ), $atts));
	
		return '<iframe class="autoWidth" width="960" height="200" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=' . urlencode($location) . '&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=' . urlencode($location) . '&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near"></iframe>';
	}
	
	// Info Box
	function serifly_info_box($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'size' => ''
	    ), $atts));
	
		return '<div class="infoBox' . (($size == 'small') ? ' small' : '') . '">' . do_shortcode($content) . '</div>';
	}
	
	// Video
	function serifly_video($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'url' => ''
	    ), $atts));
	
		if ($url != '')
		{
			$vimeoPattern = '/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/';
			$youtubePattern = '/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/';
		
			if (preg_match_all($vimeoPattern, $url, $vimeoMatch))
			{
				$url = 'http://player.vimeo.com/video/' . $vimeoMatch[5][0] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff';
			}
			else if (preg_match_all($youtubePattern, $url, $youtubeMatch))
			{
				$url = 'http://www.youtube.com/embed/' . $youtubeMatch[1][0] . '?rel=0';
			}
			else
			{
				return false;
			}
		
			return '<iframe class="autoWidth" src="' . $url . '"></iframe>';
		}
		else
		{
			return false;
		}
	}
	
	// Columns
	function serifly_one_half($atts, $content = null)
	{
		return '<div class="oneHalf">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_one_half_last($atts, $content = null)
	{
		return '<div class="oneHalf lastColumn">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
	}
	
	function serifly_one_third($atts, $content = null)
	{
		return '<div class="oneThird">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_one_third_last($atts, $content = null)
	{
		return '<div class="oneThird lastColumn">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
	}
	
	function serifly_two_third($atts, $content = null)
	{
		return '<div class="twoThird">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_two_third_last($atts, $content = null)
	{
		return '<div class="twoThird lastColumn">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
	}
	
	function serifly_one_fourth($atts, $content = null)
	{
		return '<div class="oneFourth">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_one_fourth_last($atts, $content = null)
	{
		return '<div class="oneFourth lastColumn">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
	}
	
	function serifly_three_fourth($atts, $content = null)
	{
		return '<div class="threeFourth">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_three_fourth_last($atts, $content = null)
	{
		return '<div class="threeFourth lastColumn">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
	}
	
	// Tabs
	function serifly_tab_wrapper($atts, $content = null)
	{
		return '<div class="tabWrapper">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_tab($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'label' => ''
	    ), $atts));
	
		return '<div class="tabContent">' . do_shortcode($content) . '<div class="clearfix"><input class="tabLabel" type="hidden" value="' . $label . '" /></div></div>';
	}
	
	// Pricing Tables
	function serifly_pricing_plans($atts, $content = null)
	{		
		return '<div class="pricingPlans">' . do_shortcode($content) . '<div class="clearfix"></div></div>';
	}
	
	function serifly_pricing_plans_header($atts, $content = null)
	{
		extract(shortcode_atts(array
		(
	        'title' => '',
	        'description' => '',
	        'price' => '',
	        'term' => ''
	    ), $atts));
			
		return '<div class="pricingPlanHeader"><h2>' . $title . '</h2>' . (($description != '') ? '<p>' . $description . '</p>' : '') . (($price != '') ? '<h1>' . $price . '</h1>' : '') . (($term != '') ? '<p>' . $term . '</p>' : '') . '</div>';
	}
	
	function serifly_pricing_plans_features($atts, $content = null)
	{		
		return '<div class="pricingPlanCoreFeatures">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_pricing_plans_details($atts, $content = null)
	{		
		return '<div class="pricingPlanAdditionalFeatures">' . do_shortcode($content) . '</div>';
	}
	
	function serifly_pricing_plans_order($atts, $content = null)
	{		
		return '<div class="pricingPlanOrder">' . do_shortcode($content) . '</div>';
	}
	
	// Tables
	function serifly_table($atts, $content = null)
	{		
		return '<div class="table"><table>' . do_shortcode($content) . '</table></div>';
	}
	
	function serifly_table_title($atts, $content = null)
	{		
		return '<caption>' . do_shortcode($content) . '</caption>';
	}
		
	function serifly_table_row($atts, $content = null)
	{		
		return '<tr>' . do_shortcode($content) . '</tr>';
	}
	
	function serifly_table_cell($atts, $content = null)
	{		
		return '<td>' . do_shortcode($content) . '</td>';
	}
	
	function serifly_table_cell_header($atts, $content = null)
	{		
		return '<th>' . do_shortcode($content) . '</th>';
	}
	
?>