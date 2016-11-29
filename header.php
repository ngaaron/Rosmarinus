<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$description = '';
$keywords = '';

if (is_home() || is_page()) {
   // 将以下引号中的内容改成你的主页description
   $description = "四年美工，两年设计。自学前端开发知识体系，现专注于网页设计、界面设计和前端开发，并不断加强在交互设计和用户体验上探索，在相关方面积累了丰富的知识和实践经验。最新发表文章：《
》";

   // 将以下引号中的内容改成你的主页keywords
   $keywords = "AARON,AARON HUANG,Wordpress,HTML,CSS,SEO,SEM,设计,前端开发";
}
elseif (is_single()) {

   $description = get_post_meta($post->ID, "description", true);
   
   // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
   $keywords = get_post_meta($post->ID, "keywords", true);
   if($keywords == '') {
      $tags = wp_get_post_tags($post->ID);    
      foreach ($tags as $tag ) {        
         $keywords = $keywords . $tag->name . ",";    
      }
      $keywords = rtrim($keywords, ',');
   }
}
elseif (is_category()) {
   // 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
   $description = category_description();
   $keywords = single_cat_title('', false);
}
elseif (is_tag()){
   // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
   $description = tag_description();
   $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta property="qc:admins" content="355362614713016535636" />
        <meta property="wb:webmaster" content="3de43544598bb300" />
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
        <?php if(get_theme_mod('sp_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo get_theme_mod('sp_favicon'); ?>" />
	<?php endif; ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
       <div id="top-bar">
		<div class="container">
			<div id="nav-wrapper">
	<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'main-menu', 'menu_class' => 'menu' ) ); ?>
			</div>
	<div class="menu-mobile"></div>
		<?php if(!get_theme_mod('sp_topbar_search_check')) : ?>


	<div id="top-search">
		<?php get_search_form(); ?>
		<i class="fa fa-search search-desktop"></i>
		<i class="fa fa-search search-toggle"></i>
	</div>
			

<!-- Responsive Search -->
	<div class="show-search">
          <?php get_search_form(); ?>
	</div>
	<!-- -->			
<?php endif; ?>
			
<?php if(!get_theme_mod('sp_topbar_social_check')) : ?>
<div id="top-social" <?php if(get_theme_mod('sp_topbar_search_check')) : ?>class="nosearch"<?php endif; ?>>
<a href="http://weibo.com/sevronf" target="_blank"><i class="fa fa-weibo"></i></a>
<a href="https://github.com/ngaaron" target="_blank"><i class="fa fa-github"></i></a>
<?php if(get_theme_mod('sp_facebook')) : ?><a href="http://facebook.com/<?php echo esc_html(get_theme_mod('sp_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_twitter')) : ?><a href="http://twitter.com/<?php echo esc_html(get_theme_mod('sp_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_instagram')) : ?><a href="http://instagram.com/<?php echo esc_html(get_theme_mod('sp_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_pinterest')) : ?><a href="http://pinterest.com/<?php echo esc_html(get_theme_mod('sp_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_bloglovin')) : ?><a href="http://bloglovin.com/<?php echo esc_html(get_theme_mod('sp_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_google')) : ?><a href="http://plus.google.com/<?php echo esc_html(get_theme_mod('sp_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_tumblr')) : ?><a href="http://<?php echo esc_html(get_theme_mod('sp_tumblr')); ?>.tumblr.com/" target="_blank"><i class="fa fa-tumblr"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_youtube')) : ?><a href="http://youtube.com/<?php echo esc_html(get_theme_mod('sp_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_dribbble')) : ?><a href="http://dribbble.com/<?php echo esc_html(get_theme_mod('sp_dribbble')); ?>" target="_blank"><i class="fa fa-dribbble"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_soundcloud')) : ?><a href="http://soundcloud.com/<?php echo esc_html(get_theme_mod('sp_soundcloud')); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_vimeo')) : ?><a href="http://vimeo.com/<?php echo esc_html(get_theme_mod('sp_vimeo')); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_linkedin')) : ?><a href="<?php echo esc_html(get_theme_mod('sp_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php endif; ?>
<?php if(get_theme_mod('sp_rss')) : ?><a href="<?php echo esc_url(get_theme_mod('sp_rss')); ?>" target="_blank"><i class="fa fa-rss"></i></a><?php endif; ?>
	</div>
<?php endif; ?>
			</div>
	
	</div>
	
<header id="header">
	<?php if(is_home()){?>
	<div class="aaronfeatured">
		<?php if(get_theme_mod( 'sp_featured_slider' ) == true) : ?>
			<?php get_template_part('inc/featured/featured'); ?>
		<?php endif; ?>
	</div>
	<?php }?>
</header>