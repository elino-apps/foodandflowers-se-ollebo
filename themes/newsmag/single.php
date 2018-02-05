<?php get_header(); ?>

<?php get_sidebar(); ?>

<section class="content-main" role="main">

			<div class="col-sm-8">

				<div class="blog-wide blog-single col-sm-12">

					<div class="main-category">				
							
							<?php while(have_posts()):the_post(); ?>

									<div class="breadcrumb post-path">
										<ul class="clearfix">
											<li><a href="<?php echo esc_url(home_url('/')); ?>" class="u-url" rel="home"><?php _e('Home','newsmag'); ?></a></li>
											<li><i class="fa fa-angle-double-right"></i></li>
											<li><?php the_category(' - '); ?></li>
											<li><i class="fa fa-angle-double-right"></i></li>
											<li><?php the_title(); ?></li>
																						
										</ul>
									</div>												

									<?php get_template_part('format',get_post_format()); ?>

									<hr>

										<div class="single-tags">
											<?php the_tags(__('Tags : ','newsmag'),'  ',''); ?>
										</div>

										<hr>

										<div class="next-prev-posts clearfix">

											<div class="prev-post">
												<?php previous_post_link('<i class="fa fa-angle-double-left"></i>%link'); ?>
											</div>

											<div class="next-post">
												<?php next_post_link('%link<i class="fa fa-angle-double-right"></i>'); ?>
											</div>

										</div>

									

									<?php if(get_the_author_meta('description')): ?>

										<?php get_template_part('author-bio'); ?>
										
									<?php endif; ?>


									<?php if(comments_open()){ ?>

										<div class="comment-hr"></div>
										
									<?php } ?>
									
									<?php comments_template(); ?>


							<?php endwhile; ?>						

					</div> <!-- end main-category -->					

				</div> <!-- end category-mixed-blog -->		

			</div> <!-- end col-sm-8 -->

</section> <!-- end content-main -->

<?php get_template_part('footer','widget' ); ?>

<?php get_footer(); ?>