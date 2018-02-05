<?php get_header(); ?>

<?php get_sidebar(); ?>

<section class="content-main" role="main">
			
			<div class="col-sm-8">

				<div class="category-wide blog-wide col-sm-12">


				<div class="breadcrumb">
					<h4><?php _e('Search results for ','newsmag'); ?> <?php echo get_search_query(); ?></h4>
				</div>


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