	
		<!-- END CONTENT -->
		</div>
		
	<!-- END CONTAINER -->
	</div>

	<div id="instagram-footer">
		<div class="instagram-widget">
		<h2 class="instagram-title">热评文章</h2>
		<ul class="instagram-pics">
<?php
 		   $arr = array('meta_key' => '_thumbnail_id',
                'showposts' => 5,        // 显示6个特色图像
                'posts_per_page' => 5,   // 显示6个特色图像
                'orderby' => 'comment_count',     // 按发布时间先后顺序获取特色图像，可选：'title'、'rand'、'comment_count'等
                'ignore_sticky_posts' => 1,
                'order' => 'DESC');

  		  $slideshow = new WP_Query($arr);
		    if ($slideshow->have_posts()) {
 		       $postCount = 0;
 		       while ($slideshow->have_posts()) {
  		          $slideshow->the_post();
		?>
		    <li class="inkwell">
 		       <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
 		       <?php
		            // 获取特色图像的地址
 		           $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full-thumb');
   		         echo '<img border="0" alt="' . get_the_title() . '" src="' . $timthumb_src[0] . '" /> ';
  		      ?>
   		     </a>
  		  </li>
		<?php
		        } // endwhile
    			    wp_reset_postdata();
  		  } // endif
		?>

		</ul>
		</div>
	</div>


	<div id="footer">
		<div class="container">
		<p class="copyright left"><?php echo wp_kses_post(get_theme_mod('sp_footer_copyright_left')); ?></p>
		<p class="copyright right"><?php echo wp_kses_post(get_theme_mod('sp_footer_copyright_right')); ?></p>	
		</div>	
	</div>
	
	<?php wp_footer(); ?>

<script type="text/javascript">
function show(id)
{	var aaron = document.getElementById(id);
    	if( aaron.style.display == "block")
{
	document.getElementById(id).style.display='none';
}
else if (document.getElementById(id).style.display == "none")
{   document.getElementById(id).style.display='block';
	}
}
</script>



        <script>
(function(){
    var bp = document.createElement('script');
    bp.src = '//push.zhanzhang.baidu.com/push.js';
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
       </script>


</body>

</html>