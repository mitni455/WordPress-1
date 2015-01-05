<?php
	
	// Remove default gallery
	remove_shortcode('gallery');
	
	// New gallery function
	function serifly_gallery_shortcode($atts)
	{
		global $post;
		
		 extract(shortcode_atts(array
		 (
	        'orderby' => 'menu_order ASC, ID ASC',
	        'id' => $post->ID,
	        'itemtag' => 'li',
	        'icontag' => 'span',
	        'captiontag' => 'p',
	        'columns' => 1,
	        'size' => 'large',
	        'link' => 'file'
	    ), $atts));
	    
	     $args = array
	     (
	        'post_type' => 'attachment',
	        'post_parent' => $id,
	        'numberposts' => -1,
	        'orderby' => $orderby
        ); 
	    
	    $gallery = get_posts($args);
	    
	    $galleryPrint = '<div class="gallery"><ul>';
	    
	    foreach ($gallery as $key => $image)
	    {
	    	$image_src_size = wp_get_attachment_image_src($image->ID, $size);
		    $image_src_full = wp_get_attachment_image_src($image->ID, 'full');
		    $image_caption = $image->post_excerpt;
		    $image_description = $image->post_content;
		    
		    if ($image_description == '')
		    {
			    $image_description = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
		    }
		    
		    $galleryPrint.= '<li' . (($key == 0) ? '' : ' style="display: none;"' ) . '><a href="' . $image_src_full[0] . '"><img src="' . $image_src_size[0] . '" alt="' . $image_description . '" /><input type="hidden" value="' . $image_caption . '" /></a></li>';
	    }
	    
	    return $galleryPrint . '</ul></div>';
	}
	
	// Add new shortcode
	add_shortcode('gallery', 'serifly_gallery_shortcode');
		
?>