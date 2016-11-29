<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-header">
						
		<h1><?php the_title(); ?></h1>
						
	</div>
	
	<div class="post-img">
						
		<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>
						
	</div>
	
	<div class="post-entry">
						
		<?php the_content(__('<span class="more-button">Continue Reading</span>', 'solopine')); ?>
		
		<?php wp_link_pages(); ?>
		
	</div>
	
	<?php if(get_theme_mod('sp_page_share') && !comments_open()) : else :?>
	<div class="post-meta">
						
		<div class="meta-comments">
			<?php comments_popup_link( '0 Comments', '1 Comments', '% Comments', '', ''); ?>
		</div>
		
		<?php if(!get_theme_mod('sp_page_share')) : ?>
		<div class="meta-share">
			<span class="share-text">Share:</span>
			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
			<a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php the_title(); ?>%20-%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
			<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
			<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $pin_image; ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
			<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>
		</div>
		<?php endif; ?>
		
	</div>
	<?php endif; ?>
	
	<?php comments_template( '', true );  ?>
	
</article>