<?php 

class homepage_builder extends WP_Widget{

	function __construct(){

		parent::__construct('newsmag_widget',__('Newsmag - Homepage Builder','newsmag'),array(
			'classname' => 'newsmag_builder',
			'description' => __('You can customize your homepage by this widget. Don\'t use others.','newsmag')
			));
	}


	public function form($instance){ 

		if(isset($instance['title'])){
			$title=$instance['title'];
		}else{
			$title='';
		} 


		if(isset($instance['newsmag_category'])){
			$newsmag_category=$instance['newsmag_category'];
		}else{
			$instance['newsmag_category']='';
		}

		if(isset($instance['block_style'])){
			$block_style=$instance['block_style'];
		}else{
			$instance['block_style']='';
		}

		if(isset($instance['show_post'])){
			$show_post=$instance['show_post'];
		}else{
			$instance['show_post']='';
		}
		

		$categories=get_categories();


		?>

		<label><?php _e('Title','newsmag'); ?> :</label><br>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>"><br>
		
		<hr>

		<label><?php _e('Category','newsmag'); ?> :</label><br>
		<select name="<?php echo $this->get_field_name('newsmag_category'); ?>" id="<?php echo $this->get_field_id('newsmag_category'); ?>">
			<?php foreach($categories as $category){ ?>
				<option value="<?php echo $category->slug; ?>" <?php selected($category->slug,$instance['newsmag_category']); ?>><?php echo $category->cat_name; ?></option>
			<?php } ?>
		</select><br>

		<hr>

		

		<label><?php _e('Block Style','newsmag'); ?> :</label><br>
		<select name="<?php echo $this->get_field_name('block_style'); ?>" id="<?php echo $this->get_field_id('block_style'); ?>">
			<option value="slider" <?php selected('slider',$instance['block_style']); ?>><?php _e('Slider','newsmag'); ?></option>
			<option value="banner" <?php selected('banner',$instance['block_style']); ?>><?php _e('Post Banner','newsmag'); ?></option>
			<option value="onecolumn" <?php selected('onecolumn',$instance['block_style']); ?>><?php _e('One Column','newsmag'); ?></option>
			<option value="twocolumns" <?php selected('twocolumns',$instance['block_style']); ?>><?php _e('Two Columns','newsmag'); ?></option>
			<option value="thumbnail" <?php selected('thumbnail',$instance['block_style']); ?>><?php _e('Thumbnail','newsmag'); ?></option>
		</select><br>

		<hr>
		
		<label><?php _e('Posts to Show','newsmag'); ?> :</label><br>
		<select name="<?php echo $this->get_field_name('show_post'); ?>" id="<?php echo $this->get_field_id('show_post'); ?>">
			<option value="2" <?php selected(2,$instance['show_post']); ?>>2</option>
			<option value="3" <?php selected(3,$instance['show_post']); ?>>3</option>
			<option value="4" <?php selected(4,$instance['show_post']); ?>>4</option>
			<option value="5" <?php selected(5,$instance['show_post']); ?>>5</option>
			<option value="6" <?php selected(6,$instance['show_post']); ?>>6</option>
			<option value="7" <?php selected(7,$instance['show_post']); ?>>7</option>
			<option value="8" <?php selected(8,$instance['show_post']); ?>>8</option>
			<option value="9" <?php selected(9,$instance['show_post']); ?>>9</option>
			<option value="10" <?php selected(10,$instance['show_post']); ?>>10</option>
		</select>



		<?php }



	public function update($new_instance,$old_instance){

		$instance=array();

		$instance['title']=(!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['newsmag_category']=(!empty($new_instance['newsmag_category'])) ? $new_instance['newsmag_category'] : '';
		$instance['block_style']=(!empty($new_instance['block_style'])) ? $new_instance['block_style'] : '';
		$instance['show_post']=(!empty($new_instance['show_post'])) ? $new_instance['show_post'] : '';

		return $instance;

	}



	public function widget($args,$instance){

		extract($args,EXTR_SKIP);

		echo $before_widget;
			
			if($instance['block_style']=='slider'){ ?>
					
					<section class="primary-slider col-sm-8" role="slider">	
									
						<div class="slider swipe">

						<?php query_posts('post_type=post&posts_per_page='.$instance['show_post'].'&category_name='.$instance['newsmag_category']);

						if(have_posts()):

						while(have_posts()):the_post(); ?>

							<div class="h-entry">

								<div class="image">
									<a href="<?php the_permalink(); ?>" class="u-photo">
										<?php the_post_thumbnail(); ?>
									</a>
								</div> <!-- end image -->

								<div class="slider-title-wrap">
												
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>" class="u-url"><?php the_title(); ?></a>
									</h3>
												
								</div> <!-- end slider-title-wrap -->

								<div class="p-category">

										<?php the_category() ?>

								</div> <!-- end p-category -->

							</div> <!-- end h-entry -->

							<?php endwhile; ?>

							<?php endif; ?>

							<?php wp_reset_query(); ?>

						</div> <!-- end slider swipe -->		
								
					</section>

			<?php }elseif($instance['block_style']=='banner'){

				query_posts('post_type=post&posts_per_page='.$instance['show_post'].'&category_name='.$instance['newsmag_category']); 				

				if(have_posts()):

				while(have_posts()):the_post(); ?>

				<section class="featured-category col-sm-4">
							
					<div class="col-sm-12">
										
						<article <?php post_class('h-entry'); ?> id="post-<?php the_ID(); ?>">
											
							<header class="entry-header">
												
								<h4 class="entry-title"><a href="<?php the_permalink(); ?>" class="u-url" rel="bookmark"><?php the_title(); ?></a></h4>							

							</header>

							<span class="p-category"><?php the_category(); ?></span>

							<div class="entry-media">
													
								<a href="<?php the_permalink(); ?>" class="u-url">
									<?php the_post_thumbnail(); ?>
								</a>

							</div> <!-- entry-media -->

						</article>

					</div> <!-- end col-sm-12 -->					

				</section> <!-- end featured-category -->

				<?php endwhile; ?>

				<?php endif; ?>

				<?php wp_reset_query();

			}elseif($instance['block_style']=='onecolumn'){

				query_posts('post_type=post&posts_per_page='.$instance['show_post'].'&category_name='.$instance['newsmag_category']);

				if(have_posts()): ?>	

				<section class="content-main" role="main">					

				<div class="category-mixed col-sm-4">

					<h3 class="p-category">
						<?php if(!empty($instance['title'])){ ?>

						<span><?php echo $instance['title']; ?></span>

						<?php }else{ ?>
						
						<span><?php _e('Category','newsmag'); ?></span>

						<?php } ?>
					</h3>

					<div class="main-category">
						
						<ul>

						<?php while(have_posts()):the_post(); ?>

							<li>

								<article <?php post_class('h-entry'); ?> id="post-<?php the_ID(); ?>">
									
									<div class="entry-content entry-media">

										<a href="<?php the_permalink(); ?>" class="u-photo">
											<?php the_post_thumbnail(); ?>
										</a>

									</div> <!-- end entry-content -->

									<header class="entry-header">
										
										<h4 class="entry-title"><a href="<?php the_permalink(); ?>" class="u-url" rel="bookmark"><?php the_title(); ?></a></h4>

										<div class="entry-meta">
											
											<span class="dt-published"><?php the_date(); ?></span>

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

									</div> <!-- end entry-content -->

								</article> <!-- end h-entry -->
								
							</li>
							
							<?php endwhile; ?>
							
						</ul>

					</div> <!-- end main-category -->					

				</div> <!-- end category-mixed -->	

				</section>				

				<?php endif; ?>
				
			<?php wp_reset_query();

			}elseif($instance['block_style']=='twocolumns'){

				query_posts('post_type=post&posts_per_page='.$instance['show_post'].'&category_name='.$instance['newsmag_category']);

				if(have_posts()): ?>

				<section class="content-main" role="main">	

				<div class="col-sm-8">

				<div class="category-wide col-sm-12">

					<h3 class="p-category">
						<?php if(!empty($instance['title'])){ ?>

						<span><?php echo $instance['title']; ?></span>

						<?php }else{ ?>
						
						<span><?php _e('Category','newsmag'); ?></span>

						<?php } ?>
					</h3>

					<div class="main-category">
						
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
										
										<h3 class="entry-title">
											<a href="<?php the_permalink(); ?>" class="u-url" rel="bookmark"><?php the_title(); ?></a>
										</h3>

										<div class="entry-meta">
											
											<span class="dt-published"><?php the_date(); ?></span>

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

									</div> <!-- end entry-content -->

									

								</article> <!-- end h-entry -->
								
							</li>

						<?php endwhile; ?>
							
						</ul>

					</div> <!-- end main-category -->
					

				</div> <!-- end category-wide -->

				</div> <!-- end col-sm8 -->	

				</section>

				<?php endif; ?>

				<?php wp_reset_query(); 


			}elseif($instance['block_style']=='thumbnail'){

				query_posts('post_type=post&posts_per_page='.$instance['show_post'].'&category_name='.$instance['newsmag_category']);

				if(have_posts()): ?>

				<section class="content-main" role="main">
				<div class="col-sm-8">	

				<div class="category-box col-sm-12">

					<h3 class="p-category">
						<?php if(!empty($instance['title'])){ ?>

						<span><?php echo $instance['title']; ?></span>

						<?php }else{ ?>
						
						<span><?php _e('Category','newsmag'); ?></span>

						<?php } ?>
					</h3>

					<div class="main-category">
						
						<ul class="clearfix">

						<?php while(have_posts()):the_post(); ?>

							<li class="col-sm-3">

								<article <?php post_class('h-entry'); ?> id="post-<?php the_ID(); ?>">
									
									<div class="entry-content entry-media">

										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>

									</div> <!-- end entry-content -->

									<header class="entry-header">
										
										<h5 class="entry-title">
											<a href="<?php the_permalink(); ?>" class="u-url" rel="bookmark"><?php the_title(); ?></a>
										</h5>										

									</header> <!-- end entry-header -->									

								</article> <!-- end h-entry -->
								
							</li>	

						<?php endwhile; ?>	

						</ul>

					</div> <!-- end main-category -->
					

				</div> <!-- end category-box -->

				</div> <!-- end col-sm-8 -->
				</section> <!-- end content-main -->

				<!-- end col-sm-8 -->

				<?php endif; ?>

				<?php wp_reset_query();

			}else{

				echo _e('Please build your homepage','newsmag');

			}

		echo $after_widget;

	}

}