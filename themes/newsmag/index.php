<?php get_header(); ?>

<?php get_sidebar(); ?>

<?php if(function_exists('get_field')){ ?>


<section class="primary-slider col-sm-8" role="slider">			
				
	<div class="slider swipe">


				<?php $slider_one=get_posts(array(
					'numberposts' => -1,
					'post_type' => 'post',
					'meta_key' => 'slider_one_image'
				)); ?>

				
				 <?php foreach($slider_one as $slide_one){ ?>

			      
			     <?php $click_one=get_field('slider_one_check',$slide_one->ID); ?>

			     <?php if($click_one){ ?>
			       
				<?php $image_one=get_field('slider_one_image',$slide_one->ID); ?>

					<div class="h-entry">

						<div class="image">
							<a href="<?php echo get_the_permalink($slide_one->ID); ?>" class="u-photo">
								<img src="<?php echo esc_url($image_one['url']); ?>" alt="">
							</a>
						</div> <!-- end image -->

						<div class="slider-title-wrap">
							
							<h3 class="entry-title">
								<a href="<?php echo get_the_permalink($slide_one->ID); ?>" class="u-url"><?php echo get_the_title($slide_one->ID); ?></a>
							</h3>
							
						</div> <!-- end slider-title-wrap -->

						<div class="p-category">
							
							<?php $categories_one=get_the_category($slide_one->ID);

								foreach($categories_one as $category_one){

									 echo $category_one->cat_name;

								}

							 ?>

						</div> <!-- end p-category -->
					</div> <!-- end h-entry -->


				<?php } } ?>  			

	</div> <!-- end slider swipe -->		
			
</section>

<?php } ?>


<section class="content-main" role="main">
			
			<div class="col-sm-8">

				<div class="category-wide blog-wide col-sm-12">					

					<div class="main-category">

					<?php if(have_posts()): ?>					
						
						<ul>
							
							<?php while(have_posts()):the_post(); ?>
				

								<li class="col-sm-12">								

									<article <?php post_class('h-entry'); ?> id="post-<?php the_ID(); ?>">
										
										<div class="entry-content entry-media col-sm-5">

											<a href="<?php the_permalink(); ?>" class="u-photo">
												<?php the_post_thumbnail(); ?>
											</a>

										</div> <!-- end entry-content -->

										<header class="entry-header">
											
											<h3 class="entry-title"><a href="<?php the_permalink(); ?>" class="u-url" rel="bookmark"><?php the_title(); ?></a></h3>

											<div class="entry-meta">
												
												<span class="dt-published"><?php the_date(); ?></span>

												<span class="sep">|</span>

												<span class="u-category"><?php the_category(' - '); ?></span>																							

												<?php if(comments_open()){ ?>
													<span class="sep">|</span>	

													<span class="span-comment">
														<?php comments_number(__('No Comments', 'newsmag'),__('1 Comment', 'newsmag'),__('% Comments', 'newsmag')); ?>
													</span>	
												<?php } ?>	

											</div> <!-- end entry-meta -->

										</header> <!-- end entry-header -->

										<div class="entry-summary">
											
											<?php the_excerpt(); ?>

											<?php wp_link_pages(array(
												'before' => '<div class="newsmag-link-page">'.__('Pages : ','newsmag'),
												'after'  => '</div>'
											)); ?>

										</div> <!-- end entry-content -->

									</article> <!-- end h-entry -->
									
									
								</li>

							
							<?php endwhile; ?>


							<div class="newsmag-pagenavi">
								
								<?php

									global $wp_query;

									$big = 999999999;

									echo paginate_links( array(

										'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
										'format' => '?paged=%#%',
										'current' => max( 1, get_query_var('paged') ),
										'total' => $wp_query->max_num_pages
									));

								?>

							</div>



							<?php else: ?>	

							<li><?php _e('No posts found.','newsmag'); ?></li>			
							
						</ul>

						<?php endif; ?>

					</div> <!-- end main-category -->
					

				</div> <!-- end category-mixed-blog -->	

	

			</div> <!-- end col-sm-8 -->

</section> <!-- end content-main -->

<?php get_template_part('footer','widget' ); ?>

<?php get_footer(); ?>