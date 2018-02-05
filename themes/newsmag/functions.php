<?php 

/* TGM */
require get_template_directory() . '/admin/admin-init.php';


/* Homepage Builder Widget */
require_once get_template_directory() . '/admin/homepage-widget.php';


function newsmag_setup() {	

	global $content_width;
	if ( ! isset( $content_width ) ){
		$content_width = 663; 
	}
	
	load_theme_textdomain( 'newsmag', get_template_directory() . '/lang' );
	
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );	

	add_theme_support('custom-background');

	add_theme_support( 'post-thumbnails' );	

	register_nav_menus(array(
		'top-menu' => __( 'Top Menu', 'newsmag' ),
		'footer-menu' => __( 'Footer Menu', 'newsmag' ),
		));
	
}
add_action( 'after_setup_theme', 'newsmag_setup' );



function newsmag_scripts_styles() {
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );	

	
	wp_enqueue_script('GoogleMaps','https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false',array('jquery'),'',true);	

	wp_enqueue_script('modernizr',get_template_directory_uri().'/js/modernizr.js',array('jquery'),'',false);

	wp_enqueue_script('smoothscroll',get_template_directory_uri().'/js/smoothscroll.js',array('jquery'),'',true);

	wp_enqueue_script('slickslider',get_template_directory_uri().'/js/slick.js',array('jquery'),'',true);

	wp_enqueue_script('fitvid',get_template_directory_uri().'/js/jquery.fitvids.js',array('jquery'),'',true);	

	wp_enqueue_script('newsmag-custom',get_template_directory_uri().'/js/newsmag-custom.js',array('jquery'),'',true);


	wp_enqueue_style( 'newsmag-style', get_stylesheet_uri());


	wp_register_style('googleFontsRoboto','//fonts.googleapis.com/css?family=Roboto+Slab');
    wp_enqueue_style( 'googleFontsRoboto'); 

    wp_register_style('googleFontsPT','//fonts.googleapis.com/css?family=PT+Sans');
    wp_enqueue_style( 'googleFontsPT');

    wp_register_style('googleFontsOpen','//fonts.googleapis.com/css?family=Open+Sans');
    wp_enqueue_style( 'googleFontsOpen');
	
}
add_action( 'wp_enqueue_scripts', 'newsmag_scripts_styles' );




function newsmag_title($title){

	$name=get_bloginfo('title');

	$desc=get_bloginfo('description');

	$title.=$name.' | '.$desc;

	return $title;

}

add_filter('wp_title','newsmag_title');





function newsmag_header_fallback(){ ?>

	<nav class="primary-navigation col-sm-12">
		<ul class="nav navbar-nav">
			<?php wp_list_pages(
				array(

					'title_li' => '',
					'depth' => 3

			)); ?>
		</ul>
	</nav>

<?php }



function newsmag_footer_fallback(){ ?>

	<div class="footer-menu">
		<ul>
			<?php wp_list_pages(array(
				'title_li' => '',
				'depth' => 1,
			)); ?>
		</ul>
	</div>

<?php }



function newsmag_excerpt_length() {
	return 40;
}
add_filter( 'excerpt_length', 'newsmag_excerpt_length');



function newsmag_excerpt_more() {
	return ' .....';
}
add_filter('excerpt_more', 'newsmag_excerpt_more');






function newsmag_widgets(){

	register_sidebar(array(
		'id'			=> 'homepage',
		'name' 			=> __('Build Your Homepage','newsmag'),
		'description'	=> __('Build your homepage to use this area. But first, create a homepage template. Dashboard > Pages > Add New > Template > Homepage','newsmag')
		));
		

	register_sidebar(array(
		'id'         	 => 'sidebar',
	    'name'       	 => __( 'Right Sidebar', 'newsmag' ),
	    'description' 	 => __( 'This widget is located right side as sidebar.', 'newsmag' ),
	    'before_widget'	 => '<div class="widget">',
		'after_widget' 	 => '</div>',
		'before_title' 	 => '<h3>',
		'after_title'  	 => '</h3>',
		));


	register_sidebar(array(
		'id'         	=> 'footer-1',
	    'name'       	=> __( 'Footer 1', 'newsmag' ),
	    'description' 	=> __( 'This widget is located footer.', 'newsmag' ),
	    'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));


	register_sidebar(array(
		'id'         	 => 'footer-2',
	    'name'      	 => __( 'Footer 2', 'newsmag' ),
	    'description'	 => __( 'This widget is located footer.', 'newsmag' ),
	    'before_widget'	 => '<div class="widget">',
		'after_widget' 	 => '</div>',
		'before_title' 	 => '<h3 class="widget-title">',
		'after_title' 	 => '</h3>',
		));


	register_sidebar(array(
		'id'         	=> 'footer-3',
	    'name'       	=> __( 'Footer 3', 'newsmag' ),
	    'description'	=> __( 'This widget is located footer.', 'newsmag' ),
	    'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));


	register_sidebar(array(
		'id'         	=> 'footer-4',
	    'name'       	=> __( 'Footer 4', 'newsmag' ),
	    'description'	=> __( 'This widget is located footer.', 'newsmag' ),
	    'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));



}

add_action('widgets_init','newsmag_widgets');







function newsmag_custom_comment_form($defaults) {
	
	
	$defaults['comment_notes_before'] = '';	
	$defaults['id_form'] = 'comment-form';
	$defaults['comment_field'] = '<p><textarea name="comment" id="comment" class="form-control" rows="6"></textarea></p>';

	return $defaults;
}

add_filter('comment_form_defaults', 'newsmag_custom_comment_form');

function newsmag_custom_comment_fields() {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	
	$fields = array(
		'author' => '<p>' . 
						'<input id="author" name="author" type="text" class="form-control" placeholder="Name ( required )" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />' .
						
		            '</p>',
		'email' => '<p>' . 
						'<input id="email" name="email" type="text" class="form-control" placeholder="Email ( required )" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />'  .
		            '</p>',
		'url' => '<p>' . 
						'<input id="url" name="url" type="text" class="form-control" placeholder="Website" value="' . esc_attr($commenter['comment_author_url']) . '" />'  .
		            '</p>'
	);

	return $fields;
}

add_filter('comment_form_default_fields', 'newsmag_custom_comment_fields');







function newsmag_widget_init() {

	require_once get_template_directory() . '/admin/widgets.php';
	register_widget( 'Newsmag_Flickr_Widget' );	
	register_widget( 'Newsmag_PopularPosts_Widget' );
	register_widget('homepage_builder');	

}

add_action( 'widgets_init', 'newsmag_widget_init' );





define('ACF_LITE',true);


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_tip-for-contact-form',
		'title' => 'Tip for Contact Form',
		'fields' => array (
			array (
				'key' => 'field_53c16fc19fe17',
				'label' => 'Tip for Contact Form',
				'name' => '',
				'type' => 'message',
				'message' => '( !!! But first, you have to install recommended plugin Contact Form 7. ) In order to add Contact Form, you should go to Contact > Contact Forms , and then you will see the shortcode on the screen. Copy it and paste above the editor.',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_google-maps',
		'title' => 'Google Maps',
		'fields' => array (
			array (
				'key' => 'field_53b70abfbe7f4',
				'label' => 'Add Google Map',
				'name' => 'google_maps',
				'type' => 'google_map',
				'center_lat' => 39,
				'center_lng' => 35,
				'zoom' => 6,
				'height' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_slider-option',
		'title' => 'Slider Option',
		'fields' => array (
			array (
				'key' => 'field_53b706d16c610',
				'label' => 'Add to Slider',
				'name' => 'slider_one_check',
				'type' => 'true_false',
				'instructions' => 'Enable Slider ?',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_53b707676c611',
				'label' => 'Slider Image',
				'name' => 'slider_one_image',
				'type' => 'image',
				'instructions' => 'Add the image to slider ',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




function newsmag_options(){ 

	global $newsmag;		

		if(isset($newsmag['favicon']['url'])){

		echo '<link rel="shortcut icon" href="'.esc_url($newsmag['favicon']['url']).'">';

		
		}		

 ?> <style>

	<?php echo strip_tags($newsmag['opt-ace-editor-css']); ?>

 </style> <?php 

	

}

add_action('wp_head','newsmag_options');