<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '|', true, 'right' ); ?></title>	
	
	
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php global $newsmag; ?>


<div class="page-loader">
	<img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" alt="">
</div> 


<div class="main-wrap container">


		<header class="site-header" role="banner">
			
			
			<div class="col-sm-9">

			<?php if(isset($newsmag['logo']['url'])){ ?>

				<?php if($newsmag['logo']['url']){ ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="u-url" rel="home" title="<?php bloginfo('name'); ?>">
						<img src="<?php echo esc_url($newsmag['logo']['url']); ?>" class="newsmag-logo"alt="<?php bloginfo('name'); ?>">
					</a>
				<?php }else{ ?>
				
				<h1 class="p-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="u-url" title="<?php bloginfo('description'); ?>" rel="home"><?php bloginfo('name'); ?></a>
				</h1>

				<?php } }else{ ?>

					<h1 class="p-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" class="u-url" title="<?php bloginfo('description'); ?>" rel="home"><?php bloginfo('name'); ?></a>
					</h1>

				<?php } ?>

			</div> <!-- col-sm-3 -->

			
			<div class="col-sm-3">
				
				<div class="h-entry">
					
					<?php get_search_form(); ?>				
	
				</div> <!-- h-entry -->

			</div> <!-- col-sm-3 -->

			<div class="menu-justify-wrap">
				<div class="menu-justify visible-xs">
					<i class="fa fa-align-justify"></i>
				</div>
			</div>			



			<?php wp_nav_menu(
				array(
					'theme_location' => 'top-menu',
					'container' => 'nav',
					'container_class' => 'primary-navigation col-sm-12',
					'menu_class' => 'nav navbar-nav',
					'fallback_cb' => 'newsmag_header_fallback',
					'depth' => 3
				)); ?>


		</header>		