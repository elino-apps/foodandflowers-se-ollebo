<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>

	<?php if(dynamic_sidebar('homepage')); ?>

<?php get_sidebar(); ?>

<?php get_template_part('footer','widget' ); ?>

<?php get_footer(); ?>