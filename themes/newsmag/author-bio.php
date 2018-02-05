<div class="author-info">
	
	<div class="breadcrumb"><h4><?php _e('about the author','newsmag'); ?></h4></div>

	<div class="author-avatar">
		<?php
		
		$author_bio_avatar_size = apply_filters( 'newsmag_author_bio_avatar_size', 74 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h4 class="author-title"><?php the_author(); ?><span> <?php the_author_meta('user_email'); ?> </span></h4>

		<p class="author-bio">

			<?php the_author_meta( 'description' ); ?><br>

			
		</p>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'newsmag' ), get_the_author() ); ?>
		</a>
	</div><!-- .author-description -->
</div><!-- .author-info -->