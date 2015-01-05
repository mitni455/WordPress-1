<?php

	// Add custom post type
	function timeline_post_types()
	{
		$labels = array
		(  
			'name' => __( 'Timeline', 'serifly'),  
			'singular_name' => __('Timeline', 'serifly'),  
			'rewrite' => array
			(  
				'slug' => __('timeline', 'serifly')  				
			),  
			'add_new' => _x('Add Item', 'timeline', 'serifly'),  
			'edit_item' => __('Edit Timeline Item', 'serifly'),  
			'new_item' => __('New Timeline Item', 'serifly'),  
			'view_item' => __('View Timeline', 'serifly'),  
			'search_items' => __('Search Timeline Items', 'serifly'),  
			'not_found' =>  __('No Timeline Items Found', 'serifly'),  
			'not_found_in_trash' => __('No Timeline Items Found In Trash', 'serifly'),  
			'parent_item_colon' => ''  
		);
		
		$args = array
		(  
			'labels' => $labels,  
			'public' => true,  
			'publicly_queryable' => true,  
			'show_ui' => true,  
			'query_var' => true,  
			'rewrite' => true,  
			'capability_type' => 'post',  
			'hierarchical' => false,  
			'menu_position' => null,  
			'exclude_from_search' => true,
			'supports' => array
			(  
				'title',  
				'editor',  
				'thumbnail'  
			)  
		);
		
		register_post_type(__('timeline', 'serifly'), $args);
	}
	
	function timeline_messages($messages)  
	{
		global $post, $post_ID;
	  
		$messages[__('timeline')] = array
		(  
			0 => '',  
			1 => sprintf(('The timeline has been updated. <a href="%s">View it here</a>.'), esc_url(get_permalink($post_ID))),  
			2 => __('Custom field updated.', 'serifly'),  
			3 => __('Custom field deleted.', 'serifly'),  
			4 => __('The timeline has been updated.', 'serifly'),  
			5 => isset($_GET['revision']) ? sprintf( __('The timeline has been restored to revision from %s', 'serifly'), wp_post_revision_title((int)$_GET['revision'], false)) : false,  
			6 => sprintf(__('The timeline has been published. <a href="%s">View it here</a>.', 'serifly'), esc_url(get_permalink($post_ID))),  
			7 => __('The timeline has been saved.', 'serifly'),  
			8 => sprintf(__('Timeline has been submitted. <a target="_blank" href="%s">Preview Timeline</a>', 'serifly'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),  
			9 => sprintf(__('Timeline has been scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Timeline</a>', 'serifly'), date_i18n( __('M j, Y @ G:i', 'serifly'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),  
			10 => sprintf(__('Timeline draft has been updated. <a target="_blank" href="%s">Preview Timeline</a>', 'serifly'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),  
		);
		 
		return $messages;	
	}
	
	function timeline_filter()  
	{  
		register_taxonomy
		(  
			__('tags', 'serifly'),  
			array(__('timeline', 'serifly')),  
			array
			(  
				'hierarchical' => true,  
				'label' => __('Tags', 'serifly'),  
				'singular_label' => __('Tags', 'serifly'),  
				'hierarchical' => false,
				'rewrite' => array
				(  
					'slug' => 'tags',  
					'hierarchical' => true 
				)
			)  
		);  
	}
	
	add_action('init', 'timeline_post_types');  
    add_action('init', 'timeline_filter', 0);
    add_filter('post_updated_messages', 'timeline_messages');

    // Add custom post values
    function timeline_custom_content()
    {
	    add_meta_box('timeline_images_box', __('Timeline Images', 'serifly'), 'init_timeline_images', 'timeline', 'normal', 'low');
    }
    
    function init_timeline_images()
	{
		global $post;
		$timelineImages = get_timeline_images();
	
		// HTML Starts
		?>
		
		<!-- Meta CSS -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/css/meta.css" type="text/css" />
		
		<!-- Timeline JS -->
		<script type="text/javascript">
			jQuery(function()
			{
				var save_send_to_editor = window.send_to_editor;
				
				jQuery('#timeline_images_select input.image_upload').click(function()
				{
					var imageButton = jQuery(this);
					var imageTarget = jQuery(this).parent().parent().find('input.timeline_images_src');
					var imageIdTarget = jQuery(this).parent().parent().find('input.timeline_images_id');
					var formField = imageTarget.attr('name');
					tb_show('', 'media-upload.php?post_id=' + jQuery('#timeline_post_id').val() + '&amp;type=image&amp;TB_iframe=true');
					
					window.send_to_editor = function(html)
					{
						if ($(html).is('img'))
						{
							var imageUrl = jQuery(html).attr('src');
							var imageID = jQuery(html).attr('class').match(/wp-image-([0-9]+)/);
						}
						else
						{
							var imageUrl = jQuery('img', html).attr('src');
							var imageID = jQuery('img', html).attr('class').match(/wp-image-([0-9]+)/);
						}
											
						if (typeof imageID[1] == 'undefined' || imageID[1] == '')
						{
							alert('Attachment ID could not be determined. Please try again.');
						}
						else
						{
							imageTarget.parent().parent().find('div.previewImage img').attr('src', imageUrl);
							imageTarget.val(imageUrl);							
							imageIdTarget.val(imageID[1]);
							imageButton.val(imageButton.val().replace('Upload', 'Change'));
							
							if (imageButton.parent().find('span').length == 0)
							{
								imageButton.after('<span class="spacing">or</span><input class="button-secondary image_remove" type="button" value="Remove" />');
							}
							
							tb_remove();
						}
						
						window.send_to_editor = save_send_to_editor;
					}
					
					return false;
				});
				
				jQuery('#timeline_images_select').on('click', 'input.image_remove', function()
				{
					var timelineImage = jQuery(this).parent().parent().parent();
					timelineImage.find('div.previewImage img').attr('src', '');
					timelineImage.find('input.timeline_images_src, input.timeline_images_id').val('');
					timelineImage.find('input.image_upload').val(timelineImage.find('.button-primary').val().replace('Change', 'Upload'));
					timelineImage.find('p.buttons span.spacing').remove();
					jQuery(this).remove();
					
					return false;
				});
			});
		</script>
				
		<div id="timeline_images_select" class="meta">
			<input type="hidden" id="timeline_post_id" value="<?php echo $post->ID; ?>" />
			<div class="row globalHelp">
				<p><strong>Upload or select the images for your timeline item.</strong></p><p>For each image you can enter either a YouTube or Vimeo video URL to embed a video on click or any other URL to link to its resource. If you leave the optional link empty the image will link to its original version.</p>
			</div>
			<?php for ($t = 0; $t < 20; $t++): ?>
			<div class="row">
				<div class="previewImage">
					<img src="<?php if(isset($timelineImages, $timelineImages[$t], $timelineImages[$t]['image']) && $timelineImages[$t]['image'] != '') echo $timelineImages[$t]['image']; ?>" />
				</div>
				<div class="leftItem">
					<p class="buttons"><input class="button-primary image_upload" type="button" value="<?php if (isset($timelineImages, $timelineImages[$t], $timelineImages[$t]['image']) && $timelineImages[$t]['image'] != ''){ echo 'Change'; } else { echo 'Upload'; } ?> Image &middot; <?php echo ($t + 1); ?>" /><?php if (isset($timelineImages, $timelineImages[$t], $timelineImages[$t]['image']) && $timelineImages[$t]['image'] != ''): ?><span class="spacing">or</span><input class="button-secondary image_remove" type="button" value="Remove" /><?php endif; ?></p>
					<input class="timeline_images_src" type="hidden" name="timeline_images[]"<?php if (isset($timelineImages, $timelineImages[$t], $timelineImages[$t]['image']) && $timelineImages[$t]['image'] != '') echo ' value="' . $timelineImages[$t]['image'] . '"'; ?> />
					<input class="timeline_images_id" type="hidden" name="timeline_images_id[]"<?php if (isset($timelineImages, $timelineImages[$t], $timelineImages[$t]['id']) && $timelineImages[$t]['id'] != '') echo ' value="' . $timelineImages[$t]['id'] . '"'; ?> />
					<label for="timeline_optional_link_<?php echo ($t + 1); ?>">Optional Link</label>
					<input id="timeline_optional_link_<?php echo ($t + 1); ?>" type="text" name="timeline_images_url[]"<?php if (isset($timelineImages, $timelineImages[$t], $timelineImages[$t]['url']) && $timelineImages[$t]['url'] != '') echo ' value="' . $timelineImages[$t]['url'] . '"'; ?> />
					<p class="help">Enter a URL to link your image to.</p>
				</div>
				<div class="clearfix">
				</div>
			</div>
			<?php endfor; ?>
		</div>
		
		<?php
		// HTML Ends
	}
	
	function get_timeline_images($id = false)
	{	
		if ($id === false)
		{
			global $post;
			return get_post_meta($post->ID, 'timeline_images', true);
		}
		else
		{
			return get_post_meta($id, 'timeline_images', true);
		}
	}
    
    function save_timeline_custom_content($post_ID)
	{		
		global $post;
				
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		{
			return $post_ID;
		}
		
		if ($_POST && isset($post->post_type) && $post->post_type == 'timeline')
		{		
			if (isset($_POST['timeline_images'], $_POST['timeline_images_id'], $_POST['timeline_images_url']))
			{
				$saveTimelineImages = array();
				
				foreach ($_POST['timeline_images'] as $imageKey => $imageValue)
				{
					$saveTimelineImages[] = array
					(
						'image' => $imageValue,
						'id' => $_POST['timeline_images_id'][$imageKey],
						'url' => $_POST['timeline_images_url'][$imageKey]
					);
				}
			
				update_post_meta($post->ID, 'timeline_images', $saveTimelineImages);
			}
		}
	}
    
    add_action('admin_init', 'timeline_custom_content');   
    add_action('save_post', 'save_timeline_custom_content');

?>