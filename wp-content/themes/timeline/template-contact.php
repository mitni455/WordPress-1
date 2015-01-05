<?php
/*
	Template Name: Contact
*/
?>
<?php
	
	// Deliver captcha image
	if (isset($_GET['serifly_form_verify']) && $_GET['serifly_form_verify'] > 1)
	{
		// Stop script if required function is not available
		if (!function_exists('imagepng'))
		{
			die('The required PHP function <strong>imagepng</strong> does not exist. Please disable the captcha in the theme options or recompile PHP.');
		}
			
		// Convert hex to rgb colors
		function colorConvert($input)
		{
			$input = trim($input, '#');
			$color = array();
			
			if (strlen($input) === 6)
			{
				for ($i = 0; $i <= 4; $i = $i + 2)
				{
					$color[] = (int)hexdec(substr($input, $i, 2));
				}
			}
			else if (strlen($input) === 3)
			{
				for ($i = 0; $i <= 2; $i++)
				{
					$color[] = (int)hexdec(substr($input, $i, 1) . substr($input, $i, 1));
				}
			}
			
			return $color;
		}
	
		// Set image colors
		$verifyBackgroundColor = 'fafafa';
		$verifyTextColor = '999';
		$verifyBorderColor = 'eaeaea';
						
		// Generate code and save in cookie		
		srand((double)microtime() * 1000000);
		$verifyCode = substr(strtoupper(md5(rand(0, 999999999))), 2, 6);
		$verifyCode = str_replace('O', 'A', $verifyCode);
		$verifyCode = str_replace('0', 'B', $verifyCode);
		setcookie('serifly_form_verify', md5($verifyCode), time() + 3600, '/');		
		$_COOKIE['serifly_form_verify'] = md5($verifyCode);
				
		// Build image and headers
		header("Content-type: image/png");
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false); 
		header("Pragma: no-cache"); 
		header("Expires: Mon, 1 Jan 2000 01:00:00 GMT");
		$image = imagecreate(80, 60);
		
		// Convert given colors
		list($br, $bg, $bb) = colorConvert($verifyBackgroundColor);
		list($tr, $tg, $tb) = colorConvert($verifyTextColor);
		list($rr, $rg, $rb) = colorConvert($verifyBorderColor);

		// Include colors in image
		$imageBackgroundColor = imagecolorallocate($image, $br, $bg, $bb);
		$imageTextColor = imagecolorallocate($image, $tr, $tg, $tb);
		$imageBorderColor = imagecolorallocate($image, $rr, $rg, $rb);
		
		// Create and destroy image
		imagestring($image, 5, 14, 22, $verifyCode, $imageTextColor);
		imageline($image, imagesx($image) - 1, 0, imagesx($image) - 1, imagesy($image) - 1, $imageBorderColor);
		imagepng($image);
		imagedestroy($image);
		
		// Stop script
		exit();
	}
	
	$contactErrors = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contactValid']))
	{	
		// Set email to send messages to
		if (serifly_option('general_contact_email'))
		{
			$emailTo = serifly_option('general_contact_email');
		}
		else
		{
			$emailTo = get_option('admin_email');
		}
	
		// Validate name
		if(trim($_POST['contactName']) === '')
		{
			$contactErrors['contactName'] = 'Full name is required';
		}
		else
		{
			$contactName = trim($_POST['contactName']);
		}
		
		// Validate email
		if(trim($_POST['contactEmail']) === '')
		{
			$contactErrors['contactEmail'] = 'Email address is required';
		}
		else if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", trim($_POST['contactEmail'])))
		{
			$contactErrors['contactEmail'] = 'Email address is invalid';
		}
		else
		{
			$contactEmail = trim($_POST['contactEmail']);
		}
		
		// Validate message
		if(trim($_POST['contactMessage']) === '')
		{
			$contactErrors['contactMessage'] = 'Message is required';
		}
		else
		{
			if (function_exists('stripslashes'))
			{
				$contactMessage = stripslashes(trim($_POST['contactMessage']));
			}
			else
			{
				$contactMessage = trim($_POST['contactMessage']);
			}
		}
		
		// Validate captcha
		if (!serifly_option('general_contact_captcha'))
		{		
			if (!isset($_POST['contactVerify'], $_COOKIE['serifly_form_verify']) or $_POST['contactVerify'] == '')
			{
				$contactErrors['contactVerify'] = 'Captcha is required';
			}
			else if ($_COOKIE['serifly_form_verify'] != md5(strtoupper($_POST['contactVerify'])))
			{
				$contactErrors['contactVerify'] = 'Captcha is incorrect';
			}	
		}
		
		// Send email
		if (empty($contactErrors) && trim($emailTo) !== '')
		{			
			$subject = '(Contact Form) From ' . $contactName;
			$body = "Name: $contactName \n\nEmail: $contactEmail \n\nMessage: $contactMessage";
			$headers = 'From: ' . $contactName . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $contactEmail;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	}
	
	// Show contact sidebar
	if (function_exists('dynamic_sidebar') && is_active_sidebar('contact-sidebar'))
	{
		$contactSidebar = true;
	}
	else
	{
		$contactSidebar = false;
	}

?>

<?php
	// Header
	get_header();
?>

<div class="contentColumn<?php if ($contactSidebar === false) echo ' fullWidth'; ?>">
<?php
	// Content
	if (have_posts()) : while (have_posts()) : the_post();
?>
<?php if (!serifly_option('general_contact_position')) the_content(); ?>
<!-- Contact Form -->
<div id="contactForm">
	<?php if (isset($emailSent)): ?>
	<div class="infoBox">
		<h2><?php _e('Message Sent', 'serifly'); ?></h2>
		<p><?php _e(((serifly_option('general_contact_text')) ? serifly_option('general_contact_text') : 'Thank you, we have received your message and will reply as soon as possible.'), 'serifly'); ?></p>
	</div>
	<?php else: ?>
	<form action="<?php the_permalink(); ?>" method="post">
		<div class="oneThird">
			<div class="row">
				<label for="contactName"<?php if (isset($contactErrors['contactName'])) echo ' class="error"'; ?>><?php if (isset($contactErrors['contactName'])) { echo $contactErrors['contactName']; } else { echo 'Full Name'; } ?></label>
				<input id="contactName" name="contactName" type="text"<?php if(isset($contactName)) echo ' value="' . $contactName . '"'; ?> />
			</div>
			<div class="row topMargin">
				<label for="contactEmail"<?php if (isset($contactErrors['contactEmail'])) echo ' class="error"'; ?>><?php if (isset($contactErrors['contactEmail'])) { echo $contactErrors['contactEmail']; } else { echo 'Email Address'; } ?></label>
				<input id="contactEmail" name="contactEmail" type="text"<?php if(isset($contactEmail)) echo ' value="' . $contactEmail . '"'; ?> />
			</div>
			<?php if (!serifly_option('general_contact_captcha')): ?>
			<div class="row topMargin">
				<label for="contactVerify"<?php if (isset($contactErrors['contactVerify'])) echo ' class="error"'; ?>><?php if (isset($contactErrors['contactVerify'])) { echo $contactErrors['contactVerify']; } else { echo 'Captcha'; } ?></label>
				<input style="background-image: url(<?php the_permalink(); if (strpos(get_permalink(), '?') === false) { echo '?'; } else { echo '&amp;'; } ?>serifly_form_verify=<?php echo time(); ?>);" id="contactVerify" name="contactVerify" type="text" />
			</div>
			<?php endif; ?>
		</div>
		<div class="twoThird lastColumn">
			<div class="row">
				<label for="contactMessage"<?php if (isset($contactErrors['contactMessage'])) echo ' class="error"'; ?>><?php if (isset($contactErrors['contactMessage'])) { echo $contactErrors['contactMessage']; } else { echo 'Message'; } ?></label>
				<textarea id="contactMessage" name="contactMessage" cols="10" rows="9"><?php if(isset($contactMessage)) echo $contactMessage; ?></textarea>
			</div>
		</div>
		<div class="clearfix">
		</div>
		<button type="submit" class="colorButton"><?php _e('Send Message', 'serifly'); ?></button>
	</form>
	<?php endif; ?>
</div>
<div class="clearfix">
</div>
<?php if (serifly_option('general_contact_position')) the_content(); ?>
<?php endwhile; endif; ?>
</div>

<?php if ($contactSidebar === true): ?>
<div class="widgetColumn">
<?php dynamic_sidebar('Contact Sidebar'); ?>
</div>
<?php endif; ?>

<?php
	// Footer
	get_footer();
?>