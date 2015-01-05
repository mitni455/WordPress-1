<?php
	
	// User defined styles
	function serifly_custom_theme()
	{
		$customTheme = '<style type="text/css">';
		
		if (serifly_option('styling_base_color'))
		{
			$customTheme.= 'a,';
			$customTheme.= 'a.button.light,';
			$customTheme.= 'button.light,';
			$customTheme.= '#header ul.navigation li a:hover,';
			$customTheme.= '#header div.navigation > ul li a:hover,';
			$customTheme.= '#header ul.navigation li ul li a,';
			$customTheme.= '#header div.navigation > ul li ul li a,';
			$customTheme.= '.tabWrapper ul.tabs li,';
			$customTheme.= '.timeline ul.navigation li a.active,';
			$customTheme.= '.timeline .element .content h1 a:hover';
			$customTheme.= '{';
			$customTheme.= '	color: #' . serifly_option('styling_base_color') . ';';
			$customTheme.= '}';
			
			$customTheme.= '.blogPostHeader .title a';
			$customTheme.= '{';
			$customTheme.= '	color: #333;';
			$customTheme.= '}';
			
			$customTheme.= '.blogPostHeader .title a:hover';
			$customTheme.= '{';
			$customTheme.= '	color: #' . serifly_option('styling_base_color') . ';';
			$customTheme.= '}';
			
			$customTheme.= '.testimonial, .widget .testimonial,';
			$customTheme.= 'q,';
			$customTheme.= 'cite,';
			$customTheme.= 'blockquote,';
			$customTheme.= '#header a.logo span,';
			$customTheme.= '#footer .large .widget h5 span,';
			$customTheme.= '.timeline .element .content ul.sliderControls li.prev:hover,';
			$customTheme.= '.timeline .element .content ul.sliderControls li.next:hover,';
			$customTheme.= '.timeline ul.navigation li a.active';
			$customTheme.= '{';
			$customTheme.= '	border-color: #' . serifly_option('styling_base_color') . ';';
			$customTheme.= '}';
			
			$customTheme.= 'a.button,';
			$customTheme.= 'button,';
			$customTheme.= 'input[type="submit"],';
			$customTheme.= '.widget.widget_calendar caption,';
			$customTheme.= '.table caption,';
			$customTheme.= '#zoomClose,';
			$customTheme.= '#zoomPrev,';
			$customTheme.= '#zoomNext,';
			$customTheme.= '#header ul.timelineControl li.prev:hover,';
			$customTheme.= '#header ul.timelineControl li.next:hover,';
			$customTheme.= '#header ul.timelineControl li.sidebar:hover,';
			$customTheme.= '.blogPostHeader .date .month,';
			$customTheme.= '.timeline .element .content ul.sliderControls li.circle.active,';
			$customTheme.= '.timeline .element .content ul.sliderControls li.prev:hover,';
			$customTheme.= '.timeline .element .content ul.sliderControls li.next:hover,';
			$customTheme.= '.gallery .controls .prev:hover,';
			$customTheme.= '.gallery .controls .next:hover';
			$customTheme.= '{';
			$customTheme.= '	background-color: #' . serifly_option('styling_base_color') . ';';
			$customTheme.= '}';
			
			$customTheme.= 'a.button.grey,';
			$customTheme.= 'button.grey,';
			$customTheme.= 'input[type="submit"].grey';
			$customTheme.= '{';
			$customTheme.= '	background-color: #ccc;';
			$customTheme.= '}';
			
			$customTheme.= 'a.button.green,';
			$customTheme.= 'button.green,';
			$customTheme.= 'input[type="submit"].green';
			$customTheme.= '{';
			$customTheme.= '	background-color: #80bc12;';
			$customTheme.= '}';
			
			$customTheme.= 'a.button:hover,';
			$customTheme.= 'button:hover,';
			$customTheme.= 'input[type="submit"]:hover';
			$customTheme.= '{';
			$customTheme.= '	background-color: #333;';
			$customTheme.= '}';
			
			$customTheme.= 'a.button.light,';
			$customTheme.= 'button.light,';
			$customTheme.= 'input[type="submit"].light';
			$customTheme.= '{';
			$customTheme.= '	background-color: #fff;';
			$customTheme.= '}';
			
			$customTheme.= 'a.button.light:hover,';
			$customTheme.= 'button.light:hover,';
			$customTheme.= 'input[type="submit"].light:hover';
			$customTheme.= '{';
			$customTheme.= '	background-color: #fafafa;';
			$customTheme.= '}';
			
			$customTheme.= '#zoomClose:hover';
			$customTheme.= '{';
			$customTheme.= '	background-color: rgba(255, 255, 255, 0.12);';
			$customTheme.= '}';
			
			$customTheme.= '#zoomPrev,';
			$customTheme.= '#zoomNext';
			$customTheme.= '{';
			$customTheme.= '	background-color: #fff;';
			$customTheme.= '}';
			
			$customTheme.= '#zoomPrev.inactive,';
			$customTheme.= '#zoomNext.inactive';
			$customTheme.= '{';
			$customTheme.= '	background-color: rgba(255, 255, 255, 0.12);';
			$customTheme.= '}';
		}
		
		if (serifly_option('styling_header_color'))
		{
			$customTheme.= '#header';
			$customTheme.= '{';
			$customTheme.= '	background: #' . serifly_option('styling_header_color') . ';';
			$customTheme.= '	border-bottom: none;';
			$customTheme.= '	-webkit-box-shadow: 0 4px 0 rgba(0, 0, 0, 0.04);';
			$customTheme.= '	-moz-box-shadow: 0 4px 0 rgba(0, 0, 0, 0.04);';
			$customTheme.= '	box-shadow: 0 4px 0 rgba(0, 0, 0, 0.04);';
			$customTheme.= '}';
			
			$customTheme.= '#header a,';
			$customTheme.= '#header .optional,';
			$customTheme.= '#header ul.navigation li a,';
			$customTheme.= '#header div.navigation > ul li a,';
			$customTheme.= '#header ul.navigation li ul li a,';
			$customTheme.= '#header div.navigation > ul li ul li a';
			$customTheme.= '{';
			$customTheme.= '	color: #fff;';
			$customTheme.= '}';
			
			if (serifly_option('styling_base_color') && serifly_option('styling_header_hover'))
			{
				$customTheme.= '#header .optional a';
				$customTheme.= '{';
				$customTheme.= '	color: #' . serifly_option('styling_base_color') . ';';
				$customTheme.= '}';
			}
			
			$customTheme.= '#header ul.navigation li ul,';
			$customTheme.= '#header div.navigation > ul li ul';
			$customTheme.= '{';
			$customTheme.= '	background-color: #' . serifly_option('styling_header_color') . ';';
			$customTheme.= '}';
			
			$customTheme.= '#header a.logo,';
			$customTheme.= '#header ul.navigation li ul,';
			$customTheme.= '#header div.navigation > ul li ul,';
			$customTheme.= '#header ul.navigation li ul li ul,';
			$customTheme.= '#header ul.navigation li:hover ul li ul,';
			$customTheme.= '#header div.navigation > ul li ul li ul,';
			$customTheme.= '#header div.navigation > ul li:hover ul li ul,';
			$customTheme.= '#header .optional,';
			$customTheme.= '#header ul.timelineControl';
			$customTheme.= '{';
			$customTheme.= '	border-color: rgba(255, 255, 255, 0.2);';
			$customTheme.= '}';
						
			$customTheme.= '#header a.logo span';
			$customTheme.= '{';
			$customTheme.= '	color: #fff !important;';
			
			if (serifly_option('styling_base_color') && serifly_option('styling_header_hover'))
			{
				$customTheme.= '	border-color: #' . serifly_option('styling_base_color') . ';';
			}
			else
			{
				$customTheme.= '	border-color: rgba(255, 255, 255, 0.3);';
			}
			
			$customTheme.= '}';
			
			$customTheme.= '#header ul.navigation li a:hover,';
			$customTheme.= '#header div.navigation > ul li a:hover,';
			$customTheme.= '#header ul.navigation li ul li a:hover,';
			$customTheme.= '#header div.navigation > ul li ul li a:hover';
			$customTheme.= '{';
			
			if (serifly_option('styling_base_color') && serifly_option('styling_header_hover'))
			{
				$customTheme.= '	color: #' . serifly_option('styling_base_color') . ';';
			}
			else
			{
				$customTheme.= '	color: rgba(255, 255, 255, 0.5);';
			}
			
			$customTheme.= '}';
			
			$customTheme.= '#header ul.navigation li:hover ul li ul li.border,';
			$customTheme.= '#header div.navigation > ul li:hover ul li ul li.border';
			$customTheme.= '{';
			$customTheme.= '	background: rgba(255, 255, 255, 0.2);';
			$customTheme.= '}';
			
			$customTheme.= '#header ul.social li a';
			$customTheme.= '{';
			$customTheme.= '	background-image: url(' . get_template_directory_uri() . '/img/icons/socialWhite.png);';
			$customTheme.= '}';
			
			$customTheme.= '#header .optional .phone';
			$customTheme.= '{';
			$customTheme.= '	background-image: url(' . get_template_directory_uri() . '/img/icons/phoneWhite.png);';
			$customTheme.= '}';
			
			$customTheme.= '#header .optional .email';
			$customTheme.= '{';
			$customTheme.= '	background-image: url(' . get_template_directory_uri() . '/img/icons/emailWhite.png);';
			$customTheme.= '}';
			
			$customTheme.= '#header .optional .chat';
			$customTheme.= '{';
			$customTheme.= '	background-image: url(' . get_template_directory_uri() . '/img/icons/chatWhite.png);';
			$customTheme.= '}';
			
			$customTheme.= '#header .optional .user';
			$customTheme.= '{';
			$customTheme.= '	background-image: url(' . get_template_directory_uri() . '/img/icons/userWhite.png);';
			$customTheme.= '}';
			
			$customTheme.= '#header ul.timelineControl li';
			$customTheme.= '{';
			$customTheme.= '	background-color: #' . serifly_option('styling_header_color') . ';';
			$customTheme.= '	background-image: url(' . get_template_directory_uri() . '/img/layout/timelineControlsWhite.png);';
			$customTheme.= '	border-color: rgba(255, 255, 255, 0.2);';
			$customTheme.= '}';
			
			$customTheme.= '#header ul.timelineControl li.prev:hover,';
			$customTheme.= '#header ul.timelineControl li.next:hover,';
			$customTheme.= '#header ul.timelineControl li.sidebar:hover';
			$customTheme.= '{';
			
			if (serifly_option('styling_base_color') && serifly_option('styling_header_hover'))
			{
				$customTheme.= '	background-color: #' . serifly_option('styling_base_color') . ';';
			}
			else
			{
				$customTheme.= '	background-color: #fff;';
			}
			
			$customTheme.= '}';
			
			$customTheme.= '#header input[type="text"], #header select';
			$customTheme.= '{';
			$customTheme.= '	border-color: #fff;';
			$customTheme.= '}';
			
			$customTheme.= '#header .mobileNavigation';
			$customTheme.= '{';
			$customTheme.= '	background-position: -178px -100px;';
			$customTheme.= '}';
		}
		
		if (serifly_option('styling_grey_hero_unit'))
		{
			$customTheme.= 'div.heroUnit { background-color: #fafafa; -webkit-box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.02); -moz-box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.02); box-shadow: inset 0 -3px 0 rgba(0, 0, 0, 0.02); }';
		}
		
		if (serifly_option('styling_grey_footer'))
		{
			$customTheme.= 'body { background-color: #fafafa; }';
			$customTheme.= '#footer { background-color: #fafafa; -webkit-box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.02); -moz-box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.02); box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.02); }';
		}
		
		if (serifly_option('styling_dark_footer_bar'))
		{
			$customTheme.= 'body { background-color: #333; }';
			$customTheme.= '#footer .bottom { background-color: #333; border-color: #333; -webkit-box-shadow: inset 0 3px 0 #2b2b2b; -moz-box-shadow: inset 0 3px 0 #2b2b2b; box-shadow: inset 0 3px 0 #2b2b2b; }';
			$customTheme.= '#footer .bottom a.top { background-color: #333; border-color: #666; }';
			$customTheme.= '#footer .bottom a.top:hover { background-color: #444; }';
		}
		
		if (serifly_option('styling_custom_css'))
		{
			$customTheme.= stripslashes(serifly_option('styling_custom_css'));
		}
		
		$customTheme.= '</style>';
		
		if ($customTheme != '<style type="text/css"></style>')
		{
			$customTheme = str_replace('  ', ' ', $customTheme);
			$customTheme = str_replace("\n", '', $customTheme);
			$customTheme = str_replace("\r", '', $customTheme);
			$customTheme = str_replace("\t", '', $customTheme);
		
			echo $customTheme . "\n";
		}
	}
	
?>