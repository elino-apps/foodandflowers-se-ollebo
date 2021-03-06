<?php

$themename = "sanasar";
$themefolder = "sanasar";

define ('theme_name', $themename );
define ('theme_ver' , 1.0 );

// Constants for the theme name, folder and remote XML url
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );

if ( ! function_exists( 'sanasar_setup' ) ) :

/** Sets up theme defaults and registers support for various WordPress features. */
function sanasar_setup() {
	/* Make theme available for translation
	  Translations can be filed in the /languages/ directory	 */
	load_theme_textdomain( 'sanasar', get_template_directory() . '/languages' );
	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
	/* Add callback for custom TinyMCE editor stylesheets. (editor-style.css) */
     add_editor_style();
	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support( 'post-thumbnails' );
	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array(
		
		'main-menu' => __( 'Main Menu', 'sanasar' ),
		'footer-menu' => __( 'Footer Menu', 'sanasar' ),
	) );

   global $content_width;
  if ( ! isset( $content_width ) ) { $content_width = 800; /* pixels */ }
	
	}
endif; // sanasar_setup
add_action( 'after_setup_theme', 'sanasar_setup' );

// Theme Functions 

require( get_template_directory() . '/functions/theme-functions.php');
require( get_template_directory() . '/functions/widgetize-theme.php');

/* Custom template tags for this theme. */
require( get_template_directory() . '/inc/paginatelinks.php'); 
require( get_template_directory() . '/inc/widgets.php'); 

/* Theme customizer */
include 'admin/settings.php';

?>