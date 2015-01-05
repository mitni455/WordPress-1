<?php

	// Add custom post values
    function theme_shortcodes_browser()
    {
    	add_meta_box('serifly_theme_shortcodes_browser', __('Shortcodes', 'serifly'), 'init_theme_shortcodes_browser', 'post', 'side', 'high');
	    add_meta_box('serifly_theme_shortcodes_browser', __('Shortcodes', 'serifly'), 'init_theme_shortcodes_browser', 'page', 'side', 'high');
	    add_meta_box('serifly_theme_shortcodes_browser', __('Shortcodes', 'serifly'), 'init_theme_shortcodes_browser', 'timeline', 'side', 'high');
    }
    
    function init_theme_shortcodes_browser()
	{
		global $seriflyShortcodesExtended;
						
		// HTML Starts
		?>
				
		<!-- Meta CSS -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/css/meta.css" type="text/css" />
		
		<script type="text/javascript">
			(function(jQuery)
			{
				jQuery.fn.getCursorPosition = function()
				{
					var el = jQuery(this).get(0);
					var pos = 0;
					
					if('selectionStart' in el) 
					{
						pos = el.selectionStart;
					}
					else if('selection' in document)
					{
						el.focus();
						var Sel = document.selection.createRange();
						var SelLength = document.selection.createRange().text.length;
						Sel.moveStart('character', -el.value.length);
						pos = Sel.text.length - SelLength;
					}
					
					return pos;
				}
			})(jQuery);
						
			jQuery(function()
			{	
				jQuery('#serifly_theme_shortcodes_browser ul li').click(function()
				{				
					var insert = jQuery(this).find('pre.hidden').html();
					
					if (tinyMCE.activeEditor != null && jQuery('#content').is(':hidden'))
					{
						tinyMCE.activeEditor.execCommand('mceInsertContent', false, insert.replace(/\r?\n|\r/g, '<p>&nbsp;</p>'));
					}
					else if (jQuery('#content').is(':visible'))
					{
						if (insert.search('<ul><li>List item</li></ul>') !== -1)
						{
							insert = insert.replace('<ul>', "\n<ul>\n\t").replace('</ul>', "\n</ul>\n");
						}
										
						var cursorPosition = jQuery('#content').getCursorPosition();
						var textValue = jQuery('#content').val();
						var textStart = textValue.substring(0, cursorPosition);
						var textEnd = textValue.substring(cursorPosition, textValue.length);
						
						jQuery('#content').val(textStart + insert + textEnd);
					}
					else
					{
						if (insert.search('<ul><li>List item</li></ul>') !== -1)
						{
							insert = insert.replace('<ul>', "\n<ul>\n\t").replace('</ul>', "\n</ul>\n");
						}
					
						alert('Could not located active editor. Please copy and paste following code manually to your editor.\n\n' + insert);
					}
					
					return false;
				});
			});
		</script>
		
		<div id="serifly_theme_shortcodes_browser" class="meta">
			<div class="row shortcodes">
				<ul>
					<?php foreach ($seriflyShortcodesExtended as $key => $value): ?>
						<li>
							<span><?php echo $value['label']; ?></span>
							<pre><?php echo str_replace(array("\n", 'List item'), '', strip_tags($value['code'])); ?></pre>
							<pre class="hidden"><?php echo $value['code']; ?></pre>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="row">
				<p class="help">Please click on the shortcode you would like to insert into your active editor.</p>
			</div>
		</div>
		
		<?php
		// HTML Ends
    }
      
    add_action('admin_init', 'theme_shortcodes_browser');

?>