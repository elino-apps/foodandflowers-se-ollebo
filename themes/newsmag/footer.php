<?php global $newsmag; ?>

<footer class="site-footer col-sm-12" role="contentinfo">

			<?php   
				
				$args = array(
					'theme_location' => 'footer-menu',				
					'container' => 'div',
					'container_class' => 'footer-menu',				
					'fallback_cb' => 'newsmag_footer_fallback',
					'depth' => 1,					
				);
			
				wp_nav_menu( $args ); ?>

			<div class="footer-line"></div>		
			
			<div class="col-sm-6">
				
				<span class="p-text">
					 <?php echo $newsmag['opt-editor']; ?> 
				</span>

			</div> <!-- end col-sm-6 -->

			<div class="site-generator col-sm-6">
				
				<span><?php _e('Theme by','newsmag'); ?> <a href='<?php echo esc_url("http://burak-aydin.com"); ?>' target="_blank" rel="generator">Burak Aydin</a></span>
				<span class="sep">|</span>
				<span><?php _e('Powered by','newsmag'); ?> <a href="<?php echo esc_url('http://wordpress.org'); ?>" target="_blank" rel="generator">WordPress</a></span>

			</div> <!-- end col-sm-6 -->

		</footer>

	</div> <!-- end main-wrap -->	

	
	<div class="go-top-button">
		<i class="fa fa-angle-up"></i>
	</div>

<?php wp_footer(); ?>
</body>
</html>