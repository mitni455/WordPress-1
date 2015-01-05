<?php
	
	/*
		STOP
		-------------------------------
		Serifly Theme Options Panel 1.1
		Updated on October 27th, 2012
		http://serifly.com
		
		Copyright (c) 2012 Serifly.com
	*/
	
	global $serifly_theme_import_error;
		
?>
<script type="text/javascript">
	jQuery(function()
	{
		jQuery('div.stopHeader div.export').click(function()
		{
			jQuery(this).find('form').submit();
		});
		
		jQuery('div.stopHeader div.import input[type="file"]').change(function()
		{ 
			jQuery(this).parent().submit(); 
		});
	});
</script>
<div class="stopHeader">
	<a class="logo" href="http://serifly.com"></a>
	<div class="title">
		<strong>Timeline</strong><br /><span>Get support on <a href="http://themeforest.com/user/Serifly">Themeforest</a></span>
	</div>
	<div class="export">
		<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
			<?php 
				$options = get_option($prefix . 'theme_options');
			?>
			<input type="hidden" name="serifly_theme_export" value="<?php echo base64_encode(serialize($options)); ?>" />
			Export
		</form>
	</div>
	<div class="import">
		<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="serifly_theme_import" />
			Import
		</form>
	</div>
</div>
<div class="stopWrap">
	<ul class="stopNavigation">
		<?php foreach ($buildPanel as $group => $panel): ?>
		<li ><a href="#theme-options-<?php echo $group; ?>"><?php echo $panel['label'] ?></a></li>
		<?php endforeach; ?>
	</ul>
	<div class="stopOptions">
		<?php if (isset($serifly_theme_import_error) && $serifly_theme_import_error === true): ?>
			<div class="error fade"><p><strong><?php _e('Options could not be imported.', 'serifly'); ?></strong></p></div>
		<?php elseif (isset($serifly_theme_import_error) && $serifly_theme_import_error === false): ?>
			<div class="updated fade"><p><strong><?php _e('Options have been imported and updated.', 'serifly'); ?></strong></p></div>
		<?php elseif ($_REQUEST['settings-updated'] !== false) : ?>
			<div class="updated fade"><p><strong><?php _e('Options have been updated.', 'serifly'); ?></strong></p></div>
		<?php endif; ?>
		<form method="post" action="options.php">
			<?php 
				settings_fields($prefix . 'options');
				$options = get_option($prefix . 'theme_options');
			?>
			<?php foreach ($buildPanel as $group => $panel): ?>
				<div class="stopContent" id="theme-options-<?php echo $group; ?>">
					<?php foreach ($panel['form'] as $id => $field): ?>
						<div class="element"<?php if ($field['opt'] == 'no_border') echo ' style="border-bottom:none;padding-bottom:0;"'; ?>>
						<?php $id = $group . '_' . $id; ?>
						<label for="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>"><?php echo $field['label']; ?></label>
						<?php if ($field['type'] == 'text'): ?>
							<div class="input">
								<input id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" class="regular-text" type="text" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]" value="<?php if (isset($options[$id]) && $options[$id]) echo htmlentities($options[$id]); ?>" />
								<?php if ($field['help'] != ''): ?>
								<span><?php echo $field['help']; ?></span>
								<?php endif; ?>
							</div>
						<?php elseif ($field['type'] == 'checkbox'): ?>
							<div class="input">
								<input id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" type="checkbox" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]" value="1" <?php if (isset($options[$id]) && $options[$id]) checked('1', $options[$id]); ?> />
								<?php if ($field['help'] != ''): ?>
								<span class="checkbox"><?php echo $field['help']; ?></span>
								<?php endif; ?>
							</div>
						<?php elseif ($field['type'] == 'checkbox_text'): ?>
							<div class="input">
								<input id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" type="checkbox" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]" value="1" <?php if (isset($options[$id]) && $options[$id]) checked('1', $options[$id]); ?> />
								<?php if ($field['help'] != ''): ?>
								<span class="checkbox"><?php echo $field['help']; ?></span>
								<?php endif; ?>
							</div>
							<?php $id = $id . '_value'; ?>
							<div class="input">
								<input id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" class="regular-text" type="text" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]" value="<?php if (isset($options[$id]) && $options[$id]) echo htmlentities($options[$id]); ?>" />
							</div>
						<?php elseif ($field['type'] == 'image_upload'): ?>
							<div class="preview_image"<?php if (!isset($options[$id]) || !$options[$id]){ echo ' style="display:none;"'; } ?>>
								<img src="<?php if (isset($options[$id]) && $options[$id]) echo $options[$id]; ?>" alt="Preview" />
							</div>
							<div class="input">
								<input id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" class="regular-text" type="text" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]" value="<?php if (isset($options[$id]) && $options[$id]) echo htmlentities($options[$id]); ?>" />
								<?php if ($field['help'] != ''): ?>
								<span><?php echo $field['help']; ?></span>
								<?php endif; ?>
								<input class="button-secondary image_upload" type="button" value="Upload Image" />
							</div>
						<?php elseif ($field['type'] == 'color'): ?>
							<div class="input colorpicker">
								<input id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" class="regular-text" type="text" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]" value="#<?php if (isset($options[$id]) && $options[$id]) echo $options[$id]; ?>" />
								<div class="colorpickerWrap">
								</div>
								<?php if ($field['help'] != ''): ?>
								<span><?php echo $field['help']; ?></span>
								<?php endif; ?>
							</div>
						<?php elseif ($field['type'] == 'select'): ?>
						<div class="input">
							<select id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]">
								<?php foreach ($field['value'] as $key => $value): ?>
									<option value="<?php echo $key; ?>"<?php if (isset($options[$id]) && $options[$id] && $options[$id] == $key) echo ' selected="selected"'; ?>><?php echo $value; ?></option>
								<?php endforeach; ?>
							</select>
							<?php if ($field['help'] != ''): ?>
							<span><?php echo $field['help']; ?></span>
							<?php endif; ?>
						</div>
						<?php elseif ($field['type'] == 'textarea'): ?>
						<div class="input">
							<textarea id="<?php echo $prefix; ?>theme_options_<?php echo $id; ?>" class="regular-text" cols="10" rows="8" name="<?php echo $prefix; ?>theme_options[<?php echo $id; ?>]"><?php if (isset($options[$id]) && $options[$id]) echo htmlentities($options[$id]); ?></textarea>
							<?php if ($field['help'] != ''): ?>
							<span><?php echo $field['help']; ?></span>
							<?php endif; ?>
						</div>
						<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
			<div class="submit">
				<input id="theme_options_panel" type="hidden" value="theme-options-<?php echo array_shift(array_values(array_keys($buildPanel))); ?>" />
				<input type="submit" class="button-primary" value="<?php _e('Save All Changes', 'serifly'); ?>" />
			</div>
		</form>
		<div class="reset">
			<form method="post" action="options.php">
				<?php 
					settings_fields($prefix . 'options');
					$options = get_option($prefix . 'theme_options');
				?>
				<input type="submit" class="button-secondary" value="<?php _e('Reset All Options', 'serifly'); ?>" />
			</form>
		</div>
	</div>
</div>
<p class="stopFooter"><a href="http://serifly.com">Serifly</a> Theme Options Panel</p>