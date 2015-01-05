<?php

	/*
		Plugin Name: Timeline Widget
		Plugin URI: http://serifly.com
		Description: Displays the latest project added to your timeline.
		Author: Serifly
		Version: 1.0
		Author URI: http://serifly.com
	*/

	class serifly_widget_timeline extends WP_WIDGET
	{
		// Initialize widget
		function serifly_widget_timeline()
		{
			$widget_ops = array('classname' => 'timelineWidget', 'description' => 'Displays the latest project added to your timeline.' );
			$this->WP_Widget('serifly_widget_timeline', 'Latest Timeline Item', $widget_ops);
		}
		
		function form($instance)
		{
			$instance = wp_parse_args((array)$instance, array('title' => 'Newest Project', 'linkName' => 'Go to Timeline'));
			$title = $instance['title'];
			$linkName = $instance['linkName'];
			
			// HTML Starts
			?>
						
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('linkName'); ?>"><?php _e('Link Label', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('linkName'); ?>" name="<?php echo $this->get_field_name('linkName'); ?>" type="text" value="<?php echo esc_attr($linkName); ?>" /></label></p>
			
			<?php
			// HTML Ends			
		}
		
		// Return updated instance
		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['linkName'] = $new_instance['linkName'];
			return $instance;
		}
		
		// Widget function
		function widget($args, $instance)
		{
			extract($args, EXTR_SKIP);
		 
		    echo $before_widget;
		    
		    $title = empty($instance['title']) ? ' ' : apply_filters('serifly_widget_timeline', $instance['title']);
		    $linkName = empty($instance['linkName']) ? ' ' : apply_filters('serifly_widget_timeline', $instance['linkName']);
		 
		    if (!empty($title))
		    {
		    	echo $before_title . $title . $after_title;;
		 	}
		 
		 	// Query for timeline items
		 	$timelineContent = new WP_Query
		 	(
		 		array
		 		(  
		 			'post_type' =>  'timeline',  
		 			'posts_per_page'  =>'1'  
		 		)  
		 	);
		 
		 	// HTML Starts
		 	?>
		 	
		 	<?php if ($timelineContent->have_posts()) :  while ($timelineContent->have_posts()) : $timelineContent->the_post(); ?>
		 	<?php
				
				// Timeline item images
				$timelineImages = get_timeline_images(get_the_ID());
				$timelineImagesPrint = array();
				
				foreach ($timelineImages as $timelineImageKey => $timelineImageValue)
				{			
					if (isset($timelineImageValue['image'], $timelineImageValue['id'], $timelineImageValue['url']) && $timelineImageValue['image'] != '' && $timelineImageValue['id'] != '')
					{
						$timelineImagesPrint[] = array
						(
							'image' => $timelineImageValue['image'],
							'id' => $timelineImageValue['id'],
							'url' => $timelineImageValue['url'],
						);
					}
				}
				
				// Check if image is present and if was uploaded with the WordPress uploader
				if ((isset($timelineImagesPrint[0]['id']) && $timelineImagesPrint[0]['id'] != '') && (strpos($timelineImagesPrint[0]['image'], home_url()) !== false)):
				
				$timelineWidgetSrc = wp_get_attachment_image_src($timelineImagesPrint[0]['id'], 'timeline-preview');
			?>
	 		<p class="picture"><a href="<?php the_permalink(); ?>"><img src="<?php echo $timelineWidgetSrc[0]; ?>" alt="<?php echo $timelineWidgetSrc[0]; ?>" /></a></p>
	 		<?php else: ?>
	 		<p><?php _e('Sorry, your latest timeline post either doesn\'t contain an image or it wasn\'t uploaded manually. Imported images are not supported.', 'serifly'); ?></p>
	 		<p class="separatorLine"></p>
	 		<?php endif; ?>
	 		<h3><?php echo get_the_title(); ?></h3>
	 		<p><a class="timelineLink" href="<?php the_permalink(); ?>"><?php echo $linkName; ?></a></p>
	 		<?php endwhile; ?>
		 	<?php else: ?>
		 	<p><?php _e('Sorry, there are no timeline items to display.', 'serifly'); ?></p>
		 	<?php endif; wp_reset_query(); ?>
		 	
		 	<?php
		 	// HTML Ends
		 
		    echo $after_widget;
		}
	}
	
	// Add widget hook
	add_action('widgets_init', create_function('', 'return register_widget("serifly_widget_timeline");'));

?>