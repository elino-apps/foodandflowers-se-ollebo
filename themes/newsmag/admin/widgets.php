<?php 

class Newsmag_Flickr_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'newsmag_flickr_widget',
			__('Newsmag - Flickr','newsmag'),
			array('description' => __('Display latest photos from flickr.', 'newsmag'), 'classname' => 'newsmag-flickr')
		);
	}
	
	public function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		extract($instance, EXTR_SKIP);
		
		$data = $this->get_flickr($instance); 
		
	?>

		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
		
			<div class="flickr-widget clearfix">

			<?php foreach ((array) $data as $item): ?>
			
				<div class="flickr_badge_image col-sm-3">
					<a href="<?php echo esc_url($item['link']); ?>">
						<img src="<?php echo esc_url($item['media']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
					</a>
				</div>
				
			<?php endforeach; ?>
			
			</div>
		
		<?php echo $after_widget; ?>
		
	<?php
	}
	
	public function get_flickr($instance)
	{
		extract($instance);

		// get from cache
		$cache = get_transient('newsmag_flickr_widget');
		if (is_array($cache) && !empty($cache[$this->number])) {
			return $cache[$this->number];
		}
		
		$data = $this->parse_script(
			'http://api.flickr.com/services/feeds/photos_public.gne?format=json&id='. urlencode($user_id) .'&nojsoncallback=1&tags=' . urlencode($tags),
			$show_num
		);
		
		// store to cache
		$cache[$this->number] = $data;
		set_transient('newsmag_flickr_widget', $cache, 300); // 5 minutes expiry
		
		return $data;
				
	}
	
	/**
	 * Fetch and parse data off flickr feed 
	 * 
	 * @param string $url
	 * @param int $number  number of results
	 */
	public function parse_script($url, $number)
	{
		$file = wp_remote_get($url);
		
		if (is_wp_error($file) OR !$file['body']) {
			return '';
		}
		
		// fix flickr json escape bug
		$file['body'] = str_replace("\\'", "'", $file['body']);
		$data = json_decode($file['body'], true);
		
		if (!is_array($data)) {
			return array();
		}
		
		$data = array_slice($data['items'], 0, $number);
		
		// replace medium with small square image
		foreach ($data as $key => $item) {
			$data[$key]['media'] = preg_replace('/_m\.(jp?g|png|gif)$/', '_s.\\1', $item['media']['m']);	
		}
		
		return $data;
	}	
	
	public function update($new, $old)
	{
		foreach ($new as $key => $val) {
			$new[$key] = wp_filter_kses($val);
		}
		
		delete_transient('newsmag_flickr_widget');
		
		$new['show_num'] = intval($new['show_num']);
		
		return $new;
	}
	
	public function form($instance)
	{
		$defaults = array('title' => 'Flickr Photos', 'show_num' => 12, 'user_id' => '', 'tags' => '');
		$instance = array_merge($defaults, (array) $instance);
		extract($instance);
		
	?>
	
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'newsmag'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('user_id')); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr' . '.com">Get Your ID</a>):', 'newsmag'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('user_id')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('user_id')); ?>" type="text" value="<?php echo esc_attr($user_id); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_num')); ?>"><?php _e('Number of Photos:', 'newsmag'); ?></label>
			<input class="width100" id="<?php echo esc_attr($this->get_field_id('show_num')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('show_num')); ?>" type="text" value="<?php echo esc_attr($show_num); ?>" />
		</p>
		
		
		
	
	<?php
	
	} // end form()
}


class Newsmag_PopularPosts_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'newsmag-popular-posts-widget',
			__('Newsmag - Popular Posts','newsmag'),
			array('description' => __('Displays posts with most comments.','newsmag'), 'classname' => 'popular-posts')
		);
	}

	public function widget($args, $instance) 
	{
		extract($args);
		extract($instance);

		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		$r = new WP_Query(array('posts_per_page' => $number, 'offset' => 0, 'orderby' => 'comment_count'));
		
		if ($r->have_posts()) :
		?>
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			
			<ul class="posts-list">
			<?php  while ($r->have_posts()) : $r->the_post(); global $post; ?>
				<li>
				
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-thumbnail', array('title' => strip_tags(get_the_title()))); ?>
					
					
					
					</a>
					
					<div class="content">
					
						<div class="clearfix">
							<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>"><?php echo get_the_date(); ?> </time>
					
						<span class="comments"><a href="<?php echo esc_attr(get_comments_link()); ?>"><i class="fa fa-comments-o"></i>
							<?php echo get_comments_number(); ?></a></span>
						</div>
					
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
							<?php if (get_the_title()) the_title(); else the_ID(); ?></a>
																	
					</div>
				
				</li>
			<?php endwhile; ?>
			</ul>
			
			<?php echo $after_widget; ?>
		
		<?php
			// reset global data
			wp_reset_postdata();

		endif;
	}

	public function update($new, $old) 
	{
		$new['title'] = strip_tags($new['title']);
		$new['number'] = intval($new['number']);

		return $new;
	}

	public function form($instance) 
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmag'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'newsmag'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
	
}