<?php get_header(); ?>

<?php get_sidebar(); ?>

<section class="content-error" role="main">			
			
			<div class="col-sm-8">

				<div class="error-deep">
					
					<i class="fa fa-unlink fa-3x"></i>

					<h3><?php _e('Page Not Found!','newsmag'); ?></h3>

					<p class="go-home"><?php _e('Go to','newsmag'); ?> <a href="<?php echo esc_url(home_url('/')); ?>" class="u-url" rel="home"><?php _e('Homepage','newsmag'); ?></a></p>

				</div>

			</div> <!-- end col-sm-8 -->			

</section> <!-- end content-error -->

<?php get_template_part('footer','widget' ); ?>

<?php get_footer(); ?>