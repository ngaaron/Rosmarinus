<?php

	/* Template Name: Page Links */

?>

<?php get_header(); ?>

<div class="archive-box">
<span>Friendship</span>
<H1>Links</H1>
</div>
	


	
<div class="container">	
	<div id="content">
	<div id="main" <?php if(get_theme_mod('sp_sidebar_archive') == true) : ?><?php endif; ?> class="fullpage">

	<div class="page-links">

<?php 
$bookmarks = get_bookmarks();if ( !empty($bookmarks) ){ echo '<ul class="link-content clearfix">';    foreach ($bookmarks as $bookmark) {        echo '<li><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >'. get_avatar($bookmark->link_notes,64) . '<span class="sitename">'. $bookmark->link_name .'</span></a></li>';    } echo '</ul>';}
?>

	<p><br/></p>
	</div>

			
	 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	
	<?php if(has_post_format('gallery')) : ?>
	
		<?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
		
		<?php if($images) : ?>
		<div class="post-img">
		<ul class="bxslider">
		<?php foreach($images as $image) : ?>
			
			<?php $the_image = wp_get_attachment_image_src( $image, 'full-thumb' ); ?> 
			<?php $the_caption = get_post_field('post_excerpt', $image); ?>
			<li><img src="<?php echo esc_url($the_image[0]); ?>" <?php if($the_caption) : ?>title="<?php echo $the_caption; ?>"<?php endif; ?> /></li>
			
		<?php endforeach; ?>
		</ul>
		</div>
		<?php endif; ?>
	
	<?php elseif(has_post_format('video')) : ?>
	
		<div class="post-img">
			<?php $sp_video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
			<?php if(wp_oembed_get( $sp_video )) : ?>
				<?php echo wp_oembed_get($sp_video); ?>
			<?php else : ?>
				<?php echo $sp_video; ?>
			<?php endif; ?>
		</div>
	
	<?php elseif(has_post_format('audio')) : ?>
	
		<div class="post-img audio">
			<?php $sp_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php if(wp_oembed_get( $sp_audio )) : ?>
				<?php echo wp_oembed_get($sp_audio); ?>
			<?php else : ?>
				<?php echo $sp_audio; ?>
			<?php endif; ?>
		</div>
	
	<?php else : ?>
		
		<?php if(has_post_thumbnail()) : ?>
		<?php if(!get_theme_mod('sp_post_thumb')) : ?>
		<div class="post-img">
			<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		
	<?php endif; ?>
	
	<div class="post-entry">
		
		<?php if(is_single()) : ?>
		
			<?php the_content(__('<span class="more-button">Continue Reading</span>', 'solopine')); ?>
			
		<?php else : ?>
		
			<?php if(get_theme_mod('sp_post_summary') == 'excerpt') : ?>
				
				<p><?php echo sp_string_limit_words(get_the_excerpt(), 80); ?>&hellip;</p>
				<p><a href="<?php echo get_permalink() ?>" class="more-link"><span class="more-button"><?php _e( 'Continue Reading', 'solopine' ); ?></span></a>
				
			<?php else : ?>
				
				<?php the_content(__('<span class="more-button">Continue Reading</span>', 'solopine')); ?>
				
			<?php endif; ?>
		
		<?php endif; ?>

		<?php wp_link_pages(); ?>

		<?php if(!get_theme_mod('sp_post_tags')) : ?>
		<?php if(is_single()) : ?>
		<?php if(has_tag()) : ?>
			<div class="post-tags">
			<?php the_tags("",""); ?><br/><br/>
			</div>
		<?php endif; ?>	
		<?php endif; ?>
		<?php endif; ?>
	  
		<?php if(is_single()) : ?>
		<div class="likebutton"><li><?php wp_zan();?> - <?php post_views(); ?></li><div class="loading-line"></div> </div>
		<?php endif; ?>	
		
	
	<?php if(get_theme_mod('sp_post_comment_link') && get_theme_mod('sp_post_share')) : else : ?>	
	<div class="post-meta">
		
		<?php if(!get_theme_mod('sp_post_comment_link')) : ?>		
		<div class="meta-comments">
			<?php comments_popup_link( '0 Comments', '1 Comments', '% Comments', '', ''); ?>
		</div>
		<?php endif; ?>
		



		<?php if(!get_theme_mod('sp_post_share')) : ?>
<div></div>
		<?php endif; ?>
		
	</div>
	<?php endif; ?>
	
	<?php if(!get_theme_mod('sp_post_author')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/about_author'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php if(!get_theme_mod('sp_post_related')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/related_posts'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php comments_template( '', true );  ?>
	
</article>
						
<?php endwhile; ?>
<?php endif; ?>
		
 </div>

<?php get_footer(); ?>