<?php /* Template Name: Contact Form Template */ ?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<section class="content-main clearfix" role="main">

			<div class="col-sm-8">

				<div class="blog-wide blog-single blog-page col-sm-12">

					<div class="main-category">				
							
							<?php while(have_posts()):the_post(); ?>																

									<article <?php post_class('h-entry'); ?> id="post-<?php the_ID(); ?>">
										
										<header class="entry-header">
											
											<h3 class="entry-title"><?php the_title(); ?></h3>

											<div class="entry-meta">

													<?php edit_post_link(__('Edit','newsmag')); ?>

											</div> <!-- end entry-meta -->

										</header> <!-- end entry-header -->

										<div class="entry-content">

												


<?php 
 
	$location = get_field('google_maps');
	 
	if( !empty($location) ):
	?>
	<div class="acf-map">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
	</div>
	<?php endif;

	?>


											
											<?php the_content(); ?>

										</div> <!-- end entry-content -->										


									</article> <!-- end h-entry -->										


							<?php endwhile; ?>						

					</div> <!-- end main-category -->					

				</div> <!-- end category-mixed-blog -->		

			</div> <!-- end col-sm-8 -->

</section> <!-- end content-main -->

<?php get_template_part('footer','widget' ); ?>

<?php get_footer(); ?>