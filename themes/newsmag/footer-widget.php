<aside class="main-footer col-sm-12" role="complemantary">

			<?php if(is_active_sidebar('footer-1')){ ?>

				<div class="main-footer-line"></div>

			<?php } ?>
			

			<div class="col-sm-3">
				
				<div class="widget">

					<?php if(dynamic_sidebar('footer-1')); ?>		

				</div>			

			</div> <!-- end col-sm-3 -->


			<div class="col-sm-3">
				
				<div class="widget">
					<?php if(dynamic_sidebar('footer-2')); ?>
				</div>

			</div> <!-- end col-sm-3 -->


			<div class="col-sm-3">
				
				<div class="widget">
				<?php if(dynamic_sidebar('footer-3')); ?>
					
				</div>

			</div> <!-- end col-sm-3 -->


			<div class="col-sm-3">
				
				<div class="widget">
				<?php if(dynamic_sidebar('footer-4')); ?>
					
				</div>

			</div> <!-- end col-sm-3 -->

		</aside> <!-- end main-footer -->