<?php
add_action( 'widgets_init', 'sanasar_category_posts_widget' );
function sanasar_category_posts_widget() {
	register_widget( 'sanasar_category_posts' );
}
class sanasar_category_posts extends WP_Widget {

	function sanasar_category_posts() {
	    $txt = sprintf(__(' - Category Posts', 'sanasar'));
		$widget_ops = array( 'classname' => 'sanasar-category-posts' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'sanasar-category-posts-widget' );
		$this->WP_Widget( 'sanasar-category-posts-widget',theme_name . $txt, $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		
 	       $title = apply_filters('widget_title', $instance['cat_posts_title'] ); 
 	       $no_of_posts = $instance['no_of_posts']; 
   	$cats_id = $instance['cats_id'];
		
		    echo $before_widget;
			if ( $title){
		    echo $before_title;
			echo $title ; 
		    echo $after_title;} ?>
				<ul>
					<?php sanasar_last_posts_cat($no_of_posts , $cats_id)?>	
				</ul>
		<div class="clear"></div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['cat_posts_title'] = strip_tags( $new_instance['cat_posts_title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		$instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'cat_posts_title' =>__( 'Category Posts' , 'sanasar'), 'no_of_posts' => '5' , 'cats_id' => '1' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories();
		$categories = array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat_posts_title' ); ?>"><?php _e('Title:', 'sanasar'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'cat_posts_title' ); ?>" name="<?php echo $this->get_field_name( 'cat_posts_title' ); ?>" value="<?php echo $instance['cat_posts_title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e('Number of posts to show:', 'sanasar'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php _e('Category:', 'sanasar'); ?> </label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
	<?php
	}
}
?>