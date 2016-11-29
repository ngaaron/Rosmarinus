<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function solopine_customizer_css() {
    ?>
    <style type="text/css">
	
		#logo { padding:<?php echo get_theme_mod( 'sp_header_padding_top' ); ?>px 0 <?php echo get_theme_mod( 'sp_header_padding_bottom' ); ?>px; }
		
		<?php if(get_theme_mod( 'sp_topbar_bg' )) : ?>#top-bar, .slicknav_menu { background:<?php echo get_theme_mod( 'sp_topbar_bg' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sp_topbar_shadow' )) : ?>#top-bar { box-shadow: none; -webkit-box-shadow: none; -moz-box-shadow: none; }<?php endif; ?>
		<?php if(get_theme_mod( 'sp_topbar_nav_color' )) : ?>#nav-wrapper .menu li a{ color:<?php echo get_theme_mod( 'sp_topbar_nav_color' ); ?>; }<?php endif; ?>
		#nav-wrapper .menu li.current-menu-item > a, #nav-wrapper .menu li.current_page_item > a, #nav-wrapper .menu li a:hover {  color:<?php echo get_theme_mod( 'sp_topbar_nav_color_active' ); ?>; }
		
		#nav-wrapper .menu .sub-menu, #nav-wrapper .menu .children { background: <?php echo get_theme_mod( 'sp_drop_bg' ); ?>; }
		#nav-wrapper ul.menu ul a, #nav-wrapper .menu ul ul a { <?php if(get_theme_mod( 'sp_drop_border' )) : ?>border-top: 1px solid <?php echo get_theme_mod( 'sp_drop_border' ); ?>;<?php endif; ?> color:<?php echo get_theme_mod( 'sp_drop_text_color' ); ?>; }
		#nav-wrapper ul.menu ul a:hover, #nav-wrapper .menu ul ul a:hover { color: <?php echo get_theme_mod( 'sp_drop_text_hover_color' ); ?>; background:<?php echo get_theme_mod( 'sp_drop_text_hover_bg' ); ?>; }
		
		.slicknav_nav { background:<?php echo get_theme_mod( 'sp_mobile_bg' ); ?>; }
		.slicknav_nav a { color:<?php echo get_theme_mod( 'sp_mobile_text' ); ?>; }
		.slicknav_menu .slicknav_icon-bar { background-color:<?php echo get_theme_mod( 'sp_mobile_icon' ); ?>; }
		
		#top-social a i { color:<?php echo get_theme_mod( 'sp_topbar_social_color' ); ?>; }
		#top-social a:hover i { color:<?php echo get_theme_mod( 'sp_topbar_social_color_hover' ); ?>; }
		
		#top-search i { color:<?php echo get_theme_mod( 'sp_topbar_search_magnify' ); ?>; }
		#top-search { border-color:<?php echo get_theme_mod( 'sp_topbar_search_line' ); ?>; }
		
		.widget-title { background:<?php echo get_theme_mod( 'sp_sidebar_title_bg' ); ?>; color:<?php echo get_theme_mod( 'sp_sidebar_title_text' ); ?>; border-color:<?php echo get_theme_mod( 'sp_sidebar_title_border' ); ?>; }
		
		a, .social-widget a:hover > i { color:<?php echo get_theme_mod( 'sp_color_accent' ); ?>; }
		.post-header .cat a, .post-entry blockquote { border-color:<?php echo get_theme_mod( 'sp_color_accent' ); ?>; }
		
		.feat-item .read-more, .more-button  { background:<?php echo get_theme_mod( 'sp_color_more_bg' ); ?>; color:<?php echo get_theme_mod( 'sp_color_more_text' ); ?>; border-color:<?php echo get_theme_mod( 'sp_color_more_border' ); ?>;}
		.feat-item .read-more:hover, .more-button:hover  { background:<?php echo get_theme_mod( 'sp_color_more_bg_hover' ); ?>; color:<?php echo get_theme_mod( 'sp_color_more_text_hover' ); ?>; border-color:<?php echo get_theme_mod( 'sp_color_more_border_hover' ); ?>;}
		
		<?php if(get_theme_mod( 'sp_custom_css' )) : ?>
		<?php echo get_theme_mod( 'sp_custom_css' ); ?>
		<?php endif; ?>
		
    </style>
    <?php
}
add_action( 'wp_head', 'solopine_customizer_css' );

?>