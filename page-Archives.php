<?php

	/* Template Name: Page Archives */

?>

<?php get_header(); ?>

<div class="archive-box">
<span>All Posts In AARON</span>
<H1>Archives</H1>
</div>

	
<div class="container">	
	<div id="content">
	<div id="main" <?php if(get_theme_mod('sp_sidebar_archive') == true) : ?><?php endif; ?> class="fullpage">
			
	 

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	  <main class="main-content">
        <section class="section-body">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php endwhile; ?>
            <div class="fancy-archive">
                <?php $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'ignore_sticky_posts' => 1
                );
                $the_query = new WP_Query( $args );
                $posts_rebuild = array();
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    $post_year = get_the_time('Y');
                    $post_mon = get_the_time('m');
                    $posts_rebuild[$post_year][$post_mon][] = '<li><a href="'. get_permalink() .'">'. get_the_title() .'</a> <em> ('. get_comments_number('0', '1', '%') .')</em></li>';
                endwhile;
                wp_reset_postdata();
                foreach ($posts_rebuild as $key => $value) {
                    $output .= '<h3 class="archive-year">' . $key . '</h3>';
                    $year = $key;
                    foreach ($value as $key_m => $value_m) {
                        $output .= '<h3 class="archive-month">' . $year . ' - ' . $key_m . '</h3><ul class="fancy-ul">';
                        foreach ($value_m as $key => $value_d) {
                            $output .=  $value_d;
                        }
                        $output .= '</ul>';
                    }
                }
                echo $output;
                ?>
            </div>
        </section>
    </main>
					

	
</article>

 </div>



<?php get_footer(); ?>
