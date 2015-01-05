				</div>
			</div>
			<!-- Footer -->
			<div id="footer">
				<?php if (function_exists('dynamic_sidebar') && is_active_sidebar('large-footer')): ?>
				<div class="large">
					<div class="clearfix">							
					</div>
					<p class="separator">
					</p>
					<div class="wrapper">
						<?php
							// Load footer sidebar
							dynamic_sidebar('Large Footer');
						?>
					</div>
					<div class="clearfix">
					</div>
				</div>
				<?php endif; ?>
				<div class="bottom">
					<div class="wrapper">
						<?php if (serifly_option('footer_text')): ?>
						<p><?php if (serifly_option('footer_copy')) echo date('Y') . ' &copy; '; ?><?php echo serifly_option('footer_text'); ?></p><a class="top" href="#"></a>
						<?php else: ?>
						<p>2012 &copy; <?php bloginfo('name'); ?>. Powered by <a href="http://wordpress.org">WordPress</a>. Theme by <a href="http://serifly.com">Serifly</a>.</p><a class="top" href="#"></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php if (serifly_option('general_tracking_code')) echo serifly_option('general_tracking_code'); ?>
		<?php
			// WordPress footer
			wp_footer();
		?>
	</body>
</html>