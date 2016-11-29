<?php get_header(); ?>
	
	<div class="container">
		
		<div id="content">
		
			<div id="main" class="fullpage" <?php if(get_theme_mod('sp_sidebar_post') == true) : ?>class="fullwidth"<?php endif; ?>>
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				

				<?php get_template_part('content'); ?>
						
				<?php endwhile; ?>
				
				<?php endif; ?>
			
			</div>
<?php get_footer(); ?>