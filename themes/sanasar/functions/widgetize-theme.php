<?php
function sanasar_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'sanasar' ),
		'id'            => 'primary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
}
add_action( 'widgets_init', 'sanasar_widgets_init' );
?>