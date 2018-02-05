<?php
/* The template part for displaying a message that posts cannot be found. @package sanasar */
?>
<div class="singlebox">
  <div class="not-found-block center">
        <h3><?php _e('Oops..! No Results Found.', 'sanasar'); ?></h3>
            <p><?php _e('Perhaps, Try searching with different keywords.', 'sanasar'); ?></p>	                
                <?php get_search_form(); ?>
		    <p><?php _e('Or', 'sanasar'); ?></p>
		   <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Go To Homepage.', 'sanasar'); ?></a>

  </div>
</div>