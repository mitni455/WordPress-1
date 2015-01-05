<?php

	/*
		Plugin Name: Twitter Widget
		Plugin URI: http://serifly.com
		Description: Displays the latest tweets of given profile.
		Author: Serifly
		Version: 1.1
		Author URI: http://serifly.com
	*/
	
	// Retrieve tweets from given profile
	if (isset($_GET, $_GET['serifly_get_tweets']) && $_GET['serifly_get_tweets'] != '')
	{
		$instance = new serifly_widget_twitter();
		$temp_settings = $instance->get_settings();
		
		foreach ($temp_settings as $setting)
		{
			if (isset($setting['profile']) && $setting['profile'] == $_GET['serifly_get_tweets'])
			{
				$settings = $setting;
				break;
			}
		}
		
		if (!isset($settings))
		{
			exit();
		}
		
		$username = $settings['profile'];
		
		$consumer_key = $settings['consumer_key'];
		$consumer_secret = $settings['consumer_secret'];
		
		$access_token = $settings['access_token'];
		$access_token_secret = $settings['access_token_secret'];
		
		$upload_dir = wp_upload_dir();
		
		if (!file_exists($upload_dir['basedir'] . '/cache/'))
		{
			mkdir($upload_dir['basedir'] . '/cache/', 0755, true);
		}
		
		define('CACHE_INTERVAL', 15);
		define('CACHE_FILE', $upload_dir['basedir'] . '/cache/twitter-' . $username . '.cache');
		
		function last_cache()
		{
			if (file_exists(CACHE_FILE) && is_readable(CACHE_FILE))
			{
				$handle = fopen(CACHE_FILE, 'r');
				$read_data = fgets($handle);
				fclose($handle);
				
				return $read_data;
			}
			else
			{
				return false;
			}
		}
		
		function read_cache()
		{
			if (file_exists(CACHE_FILE) && is_readable(CACHE_FILE))
			{
				$handle = fopen(CACHE_FILE, 'r');
				$read_data = fgets($handle);
				$read_data = '';
				while (!feof($handle)) $read_data = fgets($handle);
				fclose($handle);
				
				return $read_data;
			}
			else
			{
				return false;
			}
		}
		
		function update_cache($write_data)
		{
			if (is_writable(dirname(CACHE_FILE)))
			{
				$handle = fopen(CACHE_FILE, 'w');
				$write_data = time() . "\r\n" . $write_data;
				fwrite($handle, $write_data);
				fclose($handle);
				
				return true;
			}
			else
			{
				return false;
			}
		}
				
		if ((time() - last_cache()) > (60 * CACHE_INTERVAL))
		{
			require_once('twitter-api.php');
			
			$twitter_api = new TwitterAPIExchange(array
			(
				'consumer_key' => $consumer_key,
				'consumer_secret' => $consumer_secret,
				'oauth_access_token' => $access_token,
				'oauth_access_token_secret' => $access_token_secret
			));
			
			if ($response = $twitter_api->setGetfield('?screen_name=' . $username . '&count=10')->buildOauth('https://api.twitter.com/1.1/statuses/user_timeline.json', 'GET')->performRequest())
			{
				update_cache($response);
				echo $response;
				exit();
			}
		}
		
		echo read_cache();
		exit();
	}

	class serifly_widget_twitter extends WP_WIDGET
	{
		function serifly_widget_twitter()
		{
			$widget_ops = array('classname' => 'twitterWidget', 'description' => 'Displays the latest tweets of given profile.' );
			$this->WP_Widget('serifly_widget_twitter', 'Twitter Feed', $widget_ops);
		}
		
		function form($instance)
		{
			$instance = wp_parse_args((array)$instance, array('title' => 'Recent Tweets', 'profile' => 'serifly', 'link' => 'Follow me on Twitter', 'count' => 3));
			$title = $instance['title'];
			$profile = $instance['profile'];
			$link = $instance['link'];
			$count = $instance['count'];
			$consumer_key = $instance['consumer_key'];
			$consumer_secret = $instance['consumer_secret'];
			$access_token = $instance['access_token'];
			$access_token_secret = $instance['access_token_secret'];
			
			// HTML Starts
			?>
						
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('profile'); ?>"><?php _e('Profile Name', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('profile'); ?>" name="<?php echo $this->get_field_name('profile'); ?>" type="text" value="<?php echo esc_attr($profile); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link Label', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Tweet Count', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" type="text" value="<?php echo esc_attr($consumer_key); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo esc_attr($consumer_secret); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo esc_attr($access_token); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Secret', 'serifly'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" type="text" value="<?php echo esc_attr($access_token_secret); ?>" /></label></p>
			
			<p>
				Please go to <a href="https://dev.twitter.com">https://dev.twitter.com</a>, log in with your Twitter account and create a new read-only application to generate the required access tokens.
			</p>
			
			<?php
			// HTML Ends			
		}
		
		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['profile'] = $new_instance['profile'];
			$instance['link'] = $new_instance['link'];
			$instance['count'] = $new_instance['count'];
			$instance['consumer_key'] = $new_instance['consumer_key'];
			$instance['consumer_secret'] = $new_instance['consumer_secret'];
			$instance['access_token'] = $new_instance['access_token'];
			$instance['access_token_secret'] = $new_instance['access_token_secret'];
			return $instance;
		}
		
		function widget($args, $instance)
		{
			extract($args, EXTR_SKIP);
		 
		    echo $before_widget;
		    
		    $title = empty($instance['title']) ? ' ' : apply_filters('serifly_widget_twitter', $instance['title']);
		    $profile = empty($instance['profile']) ? ' ' : apply_filters('serifly_widget_twitter', $instance['profile']);
		    $link = empty($instance['link']) ? ' ' : apply_filters('serifly_widget_twitter', $instance['link']);
		    $count = empty($instance['count']) ? ' ' : apply_filters('serifly_widget_twitter', $instance['count']);
		 
		    if (!empty($title))
		    {
		    	echo $before_title . $title . $after_title;
		 	}
		 
		 	// HTML Starts
		 	?>
		 	
		 	<script type="text/javascript">
		 		jQuery(function()
		 		{		 		
			 		jQuery.getJSON('<?php echo site_url('/'); ?>?serifly_get_tweets=<?php echo $profile; ?>', function(response)
					{
						var tweetTarget = jQuery('div.twitter_feed_<?php echo str_replace(' ', '_', $profile); ?>');
						var tweetCount = <?php echo $count; ?>;
						var printTweets = '';
					
						if (response.length != 0 && typeof response[0]['text'] != 'undefined')
						{
							if (tweetCount > response.length)
							{
								tweetCount = response.length;
							}
													
							for (var i = 0; i < tweetCount; i++)
							{
								var cleanedTweet = buildTweet(response[i]['text'], response[i]['created_at']);		
								printTweets+= '<p>' + cleanedTweet[0] + '<br /><span>' + cleanedTweet[1] + '</span></p>';
							
								if (i < (tweetCount - 1))
								{
									printTweets+= '<p class="smallBorder"></p>';
								}
							}
							
							tweetTarget.prepend(printTweets).find('p.remove').remove();
						}
						else
						{
							tweetTarget.find('p.remove:first span').text('Error while loading tweets :(');
						}
					});
		 		});
		 	</script>
		 	
		 	<div class="twitter_feed_<?php echo str_replace(' ', '_', $profile); ?>">
		 		<p class="remove"><span><?php _e('Please wait, retrieving tweets...', 'serifly'); ?></span></p>
		 		<p class="remove smallBorder"></p>
		 		<a class="profileLink button light" href="http://twitter.com/<?php echo $profile; ?>"><?php echo $link; ?></a>
		 		<div class="clearfix">
		 		</div>
		 	</div>
		 	
		 	<?php
		 	// HTML Ends
		 
		    echo $after_widget;
		}
	}
	
	add_action('widgets_init', create_function('', 'return register_widget("serifly_widget_twitter");'));

?>