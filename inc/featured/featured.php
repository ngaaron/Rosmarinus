<div class="featured-area">
	<div id="sideslides">
	<ul class="bxslider">
	
		<?php
		
			$featured_cat = get_theme_mod( 'sp_featured_cat' );
			$number = get_theme_mod( 'sp_featured_slider_slides' );
		
		?>
		
		<?php $feat_query = new WP_Query( array( 'cat' => $featured_cat, 'showposts' => $number ) ); ?>
		<?php if ($feat_query->have_posts()) : while ($feat_query->have_posts()) : $feat_query->the_post(); ?>
	
		<li>
	
			<div class="feat-item" style="background-image:url(<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-thumb' ); echo $image[0]; ?>);">
			
				<div class="feat-overlay">
					<div class="feat-overlay-inner">
						
						<div class="post-header">
							
							<span class="cat"><?php sp_category(' '); ?></span>
							<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
							<span class="date"><?php the_time( get_option('date_format') ); ?></span>
							
							<a href="<?php echo get_permalink(); ?>" class="read-more">Read More</a>
							
						</div>
					
					</div>
				</div>
				
			</div>
		
		</li>
		
		<?php endwhile; endif; ?>
	
	</ul>
	</div>
</div>