<?php /* Theme Customizer For Sanasar Theme */
   
   function register ( $wp_customize ) {
      
	// Theme Colors
 
	$colors = array();
    $colors[] = array( 'slug'=>'bg_color', 'default' => '#F6FDEC',
    'label' => __( 'Background Color', 'sanasar' ) );
    $colors[] = array( 'slug'=>'primary_color', 'default' => '#7FD075',
    'label' => __( 'Primary Color ', 'sanasar' ) );
    $colors[] = array( 'slug'=>'links_color', 'default' => '#7FD075',
    'label' => __( 'Links Hover Color', 'sanasar' ) );
    $colors[] = array( 'slug'=>'headings_color', 'default' => '#222',
    'label' => __( 'Headings Color', 'sanasar' ) );
	
	foreach($colors as $color)
  {	
    $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'],
    'type' => 'theme_mod', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color', ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
     $color['slug'], array( 'label' => $color['label'], 'section' => 'colors',
     'settings' => $color['slug'] )));
  }
	// Theme Colors Ends
	// Logo Uploader
	
	$wp_customize->add_section( 'sanasar_logo_fav_section' , array(
    'title'       => __( 'Site Logo', 'sanasar' ),
    'priority'    => 30,
    'description' => __('Upload a logo to replace the default site name and description in the header','sanasar'),) );

    $wp_customize->add_setting( 'sanasar_logo', array(
		'sanitize_callback' => 'esc_url_raw') );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sanasar_logo', array(
    'label'    => __( 'Site Logo ( Max height - 60px)', 'sanasar' ),
    'section'  => 'sanasar_logo_fav_section',
    'settings' => 'sanasar_logo',
    ) ) );
	
	function sanasar_check_header_video($file){
  return validate_file($file, array('', 'mp4'));}
	  
	// Logo  Uploader Ends
	
 	// Sidebar Position
	
		$wp_customize->add_section( 'sidebar_position', array(
        'title' => __('Sidebar Position','sanasar'), // The title of section
        'description' => __('Select Your Sidebar Position.','sanasar'), // The description of section
        'priority' => '900',
	) );
	
$wp_customize->add_setting( 'sidebar_position_option', array(
    'default' => 'sidebar_display_right',
    'type' => 'theme_mod',
	'sanitize_callback' => 'sanasar_sanitize_sidebar_placement',
) );

	$wp_customize->add_control( 'sidebar_position_option', array(
    'label' => __('Display Sidebar on Left or Right','sanasar'),
    'section' => 'sidebar_position',
    'type' => 'radio',
    'choices' => array(
        'sidebar_display_right' => __('Right (Default)','sanasar'),
    	'sidebar_display_left' => __('Left','sanasar'),
        ),
) );

function sanasar_sanitize_sidebar_placement( $input ) {
    $valid = array(
       'sidebar_display_right' => __('Right (Default)','sanasar'),
    	'sidebar_display_left' => __('Left','sanasar'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
	  
	// Sidebar Position Ends
    // Social Links
	
	$wp_customize->add_section( 'sociallinks', array(
        'title' => __('Social Links','sanasar'), // The title of section
        'description' => __('Add Your Social Links Here.','sanasar'), // The description of section
        'priority' => '900',
	) );
	
	$wp_customize->add_setting( 'facebooklink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'facebooklink', array('label' => 'Facebook URL', 'section' => 'sociallinks', ) );
	$wp_customize->add_setting( 'twitterlink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'twitterlink', array('label' => 'Twitter Handle', 'section' => 'sociallinks', ) );
    $wp_customize->add_setting( 'googlelink', array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'googlelink', array('label' => 'Google Plus URL','section' => 'sociallinks',) );
	$wp_customize->add_setting( 'pinterestlink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'pinterestlink', array('label' => 'Pinterest URL','section' => 'sociallinks',) );
	$wp_customize->add_setting( 'youtubelink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'youtubelink', array('label' => 'Youtube URL','section' => 'sociallinks',) );
	$wp_customize->add_setting( 'stumblelink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'stumblelink', array('label' => 'Stumbleupon Link','section' => 'sociallinks', ) );
	$wp_customize->add_setting( 'rsslink', array('default' => '#','sanitize_callback' => 'esc_url_raw') );
    $wp_customize->add_control( 'rsslink', array('label' => 'RSS Feeds URL','section' => 'sociallinks',) );

	// Social Links Ends
 	// Footer Copyright Section
	
	$wp_customize->add_section( 'fcopyright', array(
        'title' => __('Footer Copyright','sanasar'), // The title of section
        'description' => __('Add Your Copyright Notes Here.','sanasar'), // The description of section
        'priority' => '900',
	) );
 
	$wp_customize->add_setting( 'sanasar_footer_top', array('default' => 'Sanasar is a Free WordPress Theme designed for Blogs and Magazines. One of the most fastest theme ever built.','sanitize_callback' => 'sanitize_footer_text',) );
    $wp_customize->add_control( 'sanasar_footer_top', array('label' => 'Footer Text','section' => 'fcopyright',) );
  
	function sanitize_footer_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
	
	}
    
	// Footer Copyright Section Ends
	
    // This will output the custom WordPress settings to the live theme's WP head. */
   
   function sanasar_header_output() {
     $sidebar_pos = get_theme_mod('sidebar_position_option');
     $bgcolor = get_theme_mod('bg_color');
	 $primarycolor = get_theme_mod('primary_color');
	 $linkscolor = get_theme_mod('links_color');
	 $headingscolor = get_theme_mod('headings_color');
	
	 
	 
	 ?><?php echo get_theme_mod('textarea_setting'); 
      if ( ($sidebar_pos == 'sidebar_display_left') || ( ! empty( $bgcolor )) || (!empty($primarycolor)) || (!empty($linkscolor)) || (!empty($headingscolor))){
?>	  <!--Customizer CSS--> 
      
	  <style type="text/css">
	        <?php if ($sidebar_pos == 'sidebar_display_left') { ?>
     	    #content{float:right;}
			.post-container, .page-container  { margin-left: 440px; margin-right:0px;}
			 #sidebar{margin-right: -390px; float:left; margin-left:0px; padding:0px; }
			 @media only screen and (max-width: 479px){
			 #sidebar{margin-right:-300px;} }
			 
	    	<?php } ?>

		    <?php if($bgcolor) { ?>
		      body, .search-block #s, .comment-meta {background-color: <?php echo esc_attr($bgcolor); ?>}
		   	<?php } ?>
            
			<?php if($primarycolor) { ?>

              .search-block .search-button,  .pagenavi span.current,
		  .pagenavi span.extend, #respond .form-submit input, .button, .next-image a, .previous-image a,
		    #main-nav, #main-nav #main-menu li, .authorbox, .comment-list .reply 
					 {background-color: <?php echo esc_attr($primarycolor); ?>;}
			a, .widget_tag_cloud a,	.search-block #s , #main-footer a, .comment-metadata a, .entry-content a , 
			.pagenavi a, .pagenavi .pages, .article-footer .tags a, .widget_tag_cloud a {color: <?php echo esc_attr($primarycolor); ?>;}
            #main-nav #main-menu ul li {border-bottom: 1px solid <?php echo esc_attr($primarycolor); ?>;}
#searchform  {border: 1px solid <?php echo esc_attr($primarycolor); ?>;}
#main-footer {border-top: 6px solid <?php echo esc_attr($primarycolor); ?>;}
.comment-meta {box-shadow: 0 0 1px 0 <?php echo esc_attr($primarycolor); ?>;
-moz-box-shadow: 0 0 1px 0 <?php echo esc_attr($primarycolor); ?>;
-webkit-box-shadow: 0 0 1px 0 <?php echo esc_attr($primarycolor); ?>;}

		   	<?php } ?>
			
			<?php if($linkscolor) { ?>
			    .cdetail h3 a:hover, .cdetail h2 a:hover, .related-article h5 a:hover,  .cdetail .postmeta a:hover,
			  h1 a, .h1 a, h2 a, .h2 a, h3 a, .h3 a, h4 a, .h4 a, h5 a, .h5 a, h6 a, .h6 a, a:hover, a:visited:hover, a:focus, a:visited:focus,
			  .post-meta-author a:hover , .post-meta-comments a:hover,
			  .widget_nav_menu #menu-top-menu li a:hover, .widget_archive ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, 
			  .widget_pages ul li a:hover, .widget_nav_menu ul li a:hover, .widget_recent_comments ul li a:hover, .widget_rss ul li a:hover,
			  .widget_recent_entries ul li:hover, .widget_recent_entries ul li a:hover , #crumbs a:hover   {color: <?php echo esc_attr($linkscolor); ?>;}
			  .entry-content a:hover{ border-bottom-color: <?php echo $linkscolor; ?>;}
			  .widget_archive select, .widget_categories select{border:2px solid <?php echo esc_attr($linkscolor); ?>;}
			  .article-footer .tags a,{border: 1px solid <?php echo esc_attr($linkscolor); ?>;}
			 
			  <?php } ?>

			<?php if($headingscolor) { ?>
		     .article-header h1, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6,
			 .cdetail h3 a, .cdetail h2 a, .related-articles h4, .comments-title, .related-article h5 a
			  {color:<?php echo esc_attr($headingscolor); ?>;}             
			 
			<?php } ?>
			
			@media only screen and (max-width: 767px) and (min-width: 480px){
            .post-container,.page-container,.cat-container,.home-container {margin-left:0px !important;}
            }
			@media only screen and (max-width: 479px){
			.post-container,.page-container,.cat-container,.home-container {margin-left:0px !important;}
			
			}
			
	  </style>
      <!--/Customizer CSS-->
	<?php } ?>
	<?php } 

add_action( 'customize_register', 'register', 11 );
add_action( 'wp_head', 'sanasar_header_output', 11 );

//add_action( 'customize_register' , array( 'sanasar_Customize' , 'register' ) );
//add_action( 'wp_head' , array( 'sanasar_Customize' , 'header_output' ) );