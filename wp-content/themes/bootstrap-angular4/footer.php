<?php
/**
 * The theme footer
 * 
 * @package bootstrap-angular4
 */
?>

			</div><!--.site-content-->
			
			
			<footer id="site-footer" role="contentinfo">
				<div id="footer-row" class="row site-footer">
					<div class="col-md-6 footer-left">
						<?php 
						if (!dynamic_sidebar('footer-left')) {
							printf(__('Powered by %s', 'bootstrap-angular4'), 'WordPress');
							echo ' | ';
							printf(__('Theme: %s', 'bootstrap-angular4'), '<a href="http://rundiz.com">Bootstrap Angular4 built from Bootstrap Basic</a>');
						} 
						?> 
					</div>
					<div class="col-md-6 footer-right text-right">
						<?php dynamic_sidebar('footer-right'); ?> 
					</div>
				</div>
			</footer>
		</div><!--.container page-container-->
		
		
		<!--wordpress footer-->
		<?php wp_footer(); ?> 
	</body>
</html>