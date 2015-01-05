<?php
/*
	Template Name: Timeline
*/
?>

<?php
	// Header
	get_header();
?>

<?php

	// Get timeline tags
	$timelineTags = get_terms('tags');
	$timelineTagsCount = count($timelineTags);
	$timelineContentPrint = array();
		
	// Setup timeline navigation
	$timelineNavigation = array();
	
	// Prepare timeline items depending on tag or date navigation
	if (serifly_option('timeline_tag_navigation'))
	{
		foreach ($timelineTags as $timelinePostTagsValue)
		{
			if (!isset($timelineNavigation[$timelinePostTagsValue->slug]))
			{
				// Query for all timeline items (no pagination)
				$timelineContent = new WP_Query
				(
					array
					(  
						'post_type' =>  'timeline',  
						'posts_per_page'  =>'-1',
						'tags' => $timelinePostTagsValue->slug
					)  
				);
				
				if ($timelineContent->have_posts())
				{
					while ($timelineContent->have_posts())
					{
						$timelineContent->the_post();
						global $more; $more = 0;
						
						$timelineContentPrint[] = array
						(
							'tags' => get_the_terms(get_the_ID(), 'tags'),
							'images' => get_timeline_images(get_the_ID()),
							'link' => get_permalink(),
							'title' => get_the_title(),
							'date' => strtolower(get_the_time('F-Y')),
							'content' => apply_filters('the_content', get_the_content((serifly_option('timeline_read_more')) ? serifly_option('timeline_read_more') : __('View Project', 'serifly')))
						);
					}
				}
				
				wp_reset_query();
			
				$timelineNavigation[$timelinePostTagsValue->slug] = $timelinePostTagsValue->name;
			}
		}
	}
	else
	{
		// Query for all timeline items (no pagination)
		$timelineContent = new WP_Query
		(
			array
			(  
				'post_type' =>  'timeline',  
				'posts_per_page'  =>'-1'  
			)  
		);
	
		if ($timelineContent->have_posts())
		{
			while ($timelineContent->have_posts())
			{
				$timelineContent->the_post();
				global $more; $more = 0;
				
				$timelineContentPrint[] = array
				(
					'tags' => get_the_terms(get_the_ID(), 'tags'),
					'images' => get_timeline_images(get_the_ID()),
					'link' => get_permalink(),
					'title' => get_the_title(),
					'date' => strtolower(get_the_time('F-Y')),
					'content' => apply_filters('the_content', get_the_content((serifly_option('timeline_read_more')) ? serifly_option('timeline_read_more') : 'View Project'))
				);
				
				if (!isset($timelineNavigation[strtolower(get_the_time('F-Y'))]))
				{
					$timelineNavigation[strtolower(get_the_time('F-Y'))] = get_the_time('F Y');
				}
			}
		}
		
		wp_reset_query();
	}
	
?>
<div id="timeline" class="timeline<?php if (serifly_option('timeline_full_width')) echo ' fullWidth'; ?>">
	<?php if (!empty($timelineNavigation) && !empty($timelineContent)): ?>
	<ul class="navigation timelineSidebar<?php if (serifly_option('timeline_full_width')) echo ' hidden'; ?>">
		<?php $timelineNavigationCount = 0; foreach ($timelineNavigation as $timelineNavigationKey => $timelineNavigationValue): ?>
		<li>
			<a<?php if ($timelineNavigationCount == 0) echo ' class="active"'; ?> href="#<?php echo $timelineNavigationKey; ?>"><?php echo $timelineNavigationValue; ?></a>
		</li>
		<?php $timelineNavigationCount++; endforeach; ?>
	</ul>
	<?php endif; ?>
	<?php if (serifly_option('timeline_box') && !empty($timelineContent)): ?>
	<p class="infoBox small timelineSidebar<?php if (serifly_option('timeline_full_width')) echo ' hidden'; ?>">
		<?php echo serifly_option('timeline_box'); ?>
	</p>
	<?php endif; ?>
	<!-- Timeline Elements -->
	<?php if (!empty($timelineContentPrint)) :  foreach ($timelineContentPrint as $timelineContentPrintKey => $timelineContentPrintValue): ?>
	<?php $timelinePostTags = $timelineContentPrintValue['tags']; ?>
	<?php
				
		// Timeline item images
		$timelineImages = $timelineContentPrintValue['images'];
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
	?>
	<div class="element<?php if (empty($timelineImagesPrint)) echo ' showBorder'; ?> <?php if (serifly_option('timeline_tag_navigation') && is_array($timelinePostTags) && !empty($timelinePostTags)) { foreach($timelinePostTags as $postTag) { echo $postTag->slug; break; } } else { echo $timelineContentPrintValue['date']; } ?>">
		<?php if (!empty($timelineImagesPrint)): ?>
		<div class="slider">
			<ul class="slider">
				<?php foreach($timelineImagesPrint as $timelineImagesPrintKey => $timelineImagesPrintValue): ?>
				<li>
					<?php
						if (strpos($timelineImagesPrintValue['image'], home_url()) === false)
						{
							$timelineImageLarge[0] = $timelineImagesPrintValue['image'];
						}
						else
						{
							$timelineImageLarge = wp_get_attachment_image_src($timelineImagesPrintValue['id'], 'timeline-large');
						}
					?>
					<a class="zoom" href="<?php if ($timelineImagesPrintValue['url'] != '') { echo $timelineImagesPrintValue['url']; } else { echo $timelineImagesPrintValue['image']; } ?>"><input type="hidden" value="<?php echo $timelineImageLarge[0]; ?>" /></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<div class="content">
			<ul class="sliderControls">
			</ul>
			<h1><a href="<?php echo $timelineContentPrintValue['link']; ?>"><?php echo $timelineContentPrintValue['title']; ?></a></h1>
			<?php echo $timelineContentPrintValue['content']; ?>
			<?php if (is_array($timelinePostTags) && !empty($timelinePostTags) && !serifly_option('timeline_tag_navigation')): ?>
			<ul class="tags">
				<?php foreach ($timelinePostTags as $postTag): ?>
				<li><?php echo $postTag->name; ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="clearfix">
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endforeach; else: ?>
		<p><?php _e('Sorry, no items have been assigned to the timeline yet.', 'serifly'); ?></p>
		<p class="separator"></p>
	<?php endif; ?>
</div>

<?php
	// Footer
	get_footer();
?>