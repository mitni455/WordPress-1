<?php
	
	/*
		STOP
		-------------------------------
		Serifly Theme Options Panel 1.1
		Updated on October 27th, 2012
		http://serifly.com
		
		Copyright (c) 2012 Serifly.com
	*/
	
	$buildPanel = array
	(
		'general' => array
		(
			'label' => 'General Settings',
			'form' => array
			(
				'favicon_url' => array
				(
					'label' => 'Custom Favicon',
					'help' => 'Specify the internet address or upload your own favicon. PNG, GIF or ICO at 16 x 16 pixels.',
					'type' => 'image_upload',
					'value' => '',
					'opt' => ''
				),
				'title' => array
				(
					'label' => 'Alternative Title',
					'help' => 'Check if you set the browser title manually or via a plugin.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'navigation_label' => array
				(
					'label' => 'Navigation Label',
					'help' => 'Enter an alternative label for the mobile navigation. Default is "Navigate..."',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'contact_email' => array
				(
					'label' => 'Contact Form Email',
					'help' => 'This email address will receive all messages sent by the contact form. Leave blank to use the admin email address.',
					'type' => 'text',
					'value' => '',
					'opt' => 'no_border'
				),
				'contact_captcha' => array
				(
					'label' => 'Disable Captcha',
					'help' => 'Disable the captcha for the contact form.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => 'no_border'
				),
				'contact_position' => array
				(
					'label' => 'Contact Position',
					'help' => 'Show the page content below contact form.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => 'no_border'
				),
				'contact_text' => array
				(
					'label' => 'Contact Confirmation',
					'help' => 'Enter the confirmation text you want to show when a message has been sent via the contact form.',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'custom_feed' => array
				(
					'label' => 'Custom Feed',
					'help' => 'Enter your feed URL if you don\'t want to use the default RSS feed.',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'tracking_code' => array
				(
					'label' => 'Tracking Code',
					'help' => 'Paste your Google Analytics or other tracking code here. It will be inserted before the closing body tag of your theme.',
					'type' => 'textarea',
					'value' => '',
					'opt' => ''
				)
			)
		),
		'header' => array
		(
			'label' => 'Header Options',
			'form' => array
			(
				'image_logo_url' => array
				(
					'label' => 'Custom Logo',
					'help' => 'Specify the internet address of your logo or upload a new one. Your logo should not exceed 60 pixels in height.',
					'type' => 'image_upload',
					'value' => '',
					'opt' => 'no_border'
				),
				'text_logo' => array
				(
					'label' => 'Text Logo',
					'help' => 'Check to display the text entered below rather than an image.',
					'type' => 'checkbox_text',
					'value' => '',
					'opt' => ''
				),
				'hide_search' => array
				(
					'label' => 'Hide Search',
					'help' => 'Hide the blog search in the header.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => 'no_border'
				),
				'optional_icon' => array
				(
					'label' => 'Optional Icon',
					'help' => 'You can choose an icon if you are not showing the blog search.',
					'type' => 'select',
					'value' => array
					(
						'' => 'No Icon',
						'phone' => 'Phone',
						'chat' => 'Chat',
						'email' => 'Mail',
						'user' => 'User'
					),
					'opt' => 'no_border'
				),
				'optional_text' => array
				(
					'label' => 'Optional Text',
					'help' => 'You can enter a text you want to show instead of the blog search. HTML is allowed.',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
			)
		),
		'footer' => array
		(
			'label' => 'Footer Options',
			'form' => array
			(
				'copy' => array
				(
					'label' => 'Footer Copyright',
					'help' => 'Automatically add the year and &copy; before the footer text.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => 'no_border'
				),
				'text' => array
				(
					'label' => 'Footer Text',
					'help' => 'Enter what you would like to see on the bottom left of your site. HTML is allowed.',
					'type' => 'textarea',
					'value' => '',
					'opt' => ''
				)
			)
		),
		'timeline' => array
		(
			'label' => 'Timeline Options',
			'form' => array
			(
				'tag_navigation' => array
				(
					'label' => 'Navigation Filter',
					'help' => 'Instead of using the post dates of your timeline items you can order them by using the tags. Please note that every item should only contain one tag if you choose this option.',
					'type' => 'select',
					'value' => array
					(
						'' => 'Dates',
						'tags' => 'Tags'
					),
					'opt' => ''
				),
				'full_width' => array
				(
					'label' => 'Full Width',
					'help' => 'Show the timeline in full width by default.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'read_more' => array
				(
					'label' => 'More Label',
					'help' => 'Enter the text to replace the default more link label "View Project".',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'box' => array
				(
					'label' => 'Text Box',
					'help' => 'Enter some text or HTML code to display a little box right next to your timeline.',
					'type' => 'textarea',
					'value' => '',
					'opt' => ''
				)
			)
		),
		'blog' => array
		(
			'label' => 'Blog Options',
			'form' => array
			(
				'hide_label' => array
				(
					'label' => 'Hide Label',
					'help' => 'Don\'t display the label "Published" in the post header.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'hide_author' => array
				(
					'label' => 'Hide Author',
					'help' => 'Don\'t display the author in the post header.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'hide_category' => array
				(
					'label' => 'Hide Category',
					'help' => 'Don\'t display the category in the post header.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'hide_comments' => array
				(
					'label' => 'Hide Comments',
					'help' => 'Don\'t display the comments and link in the post header.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'show_time' => array
				(
					'label' => 'Show Time',
					'help' => 'Display the time in the post header.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'short_date' => array
				(
					'label' => 'Short Date',
					'help' => 'Display a shortened version of the month (e.g. Oct).',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'read_more' => array
				(
					'label' => 'More Label',
					'help' => 'Enter the text to replace the default more link label "Read More".',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				)
			)
		),
		'styling' => array
		(
			'label' => 'Styling  Options',
			'form' => array
			(
				'base_color' => array
				(
					'label' => 'Base Color',
					'help' => 'Choose a different base color for links and buttons.',
					'type' => 'color',
					'value' => '',
					'opt' => ''
				),
				'header_color' => array
				(
					'label' => 'Header Color',
					'help' => 'Choose a different header background color. Choose a darker color, all links and text will be displayed in white.',
					'type' => 'color',
					'value' => '',
					'opt' => ''
				),
				'header_hover' => array
				(
					'label' => 'Header Link Color',
					'help' => 'Use the base color for header hover states.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'grey_hero_unit' => array
				(
					'label' => 'Grey Hero Unit',
					'help' => 'Change the hero unit to a light grey instead of white.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'grey_footer' => array
				(
					'label' => 'Grey Footer',
					'help' => 'Change the footer to a light grey instead of white.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'dark_footer_bar' => array
				(
					'label' => 'Dark Footer Bar',
					'help' => 'Change the bottom footer to a dark color.',
					'type' => 'checkbox',
					'value' => '',
					'opt' => ''
				),
				'custom_css' => array
				(
					'label' => 'Custom CSS',
					'help' => 'Enter your own custom CSS without touching the original. Go wild.',
					'type' => 'textarea',
					'value' => '',
					'opt' => ''
				)
			)
		),
		'social' => array
		(
			'label' => 'Social Networks',
			'form' => array
			(
				'twitter' => array
				(
					'label' => 'Twitter',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'facebook' => array
				(
					'label' => 'Facebook',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'google' => array
				(
					'label' => 'Google Plus',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'dribbble' => array
				(
					'label' => 'Dribbble',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'forrst' => array
				(
					'label' => 'Forrst',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'vimeo' => array
				(
					'label' => 'Vimeo',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'youtube' => array
				(
					'label' => 'Youtube',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'flickr' => array
				(
					'label' => 'Flickr',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				),
				'pinterest' => array
				(
					'label' => 'Pinterest',
					'help' => '',
					'type' => 'text',
					'value' => '',
					'opt' => ''
				)
			)
		)
	);
	
?>