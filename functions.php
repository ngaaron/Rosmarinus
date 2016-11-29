<?php
//////////////////////////////////////////////////////////////////
// Set Content Width
//////////////////////////////////////////////////////////////////
if ( ! isset( $content_width ) )
	$content_width = 1080;

//////////////////////////////////////////////////////////////////
// Theme set up
//////////////////////////////////////////////////////////////////
add_action( 'after_setup_theme', 'solopine_theme_setup' );

if ( !function_exists('solopine_theme_setup') ) {

	function solopine_theme_setup() {
	
		// Register navigation menu
		register_nav_menus(
			array(
				'main-menu' => 'Primary Menu',
			)
		);
		
		// Localization support
		load_theme_textdomain('solopine', get_template_directory() . '/lang');
		
		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
		
		// Featured image
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'full-thumb', 1080, 0, true );
		add_image_size( 'misc-thumb', 520, 400, true );
		
		// Feed Links
		add_theme_support( 'automatic-feed-links' );
	
	}

}

//////////////////////////////////////////////////////////////////
// Register & enqueue styles/scripts
//////////////////////////////////////////////////////////////////

add_action( 'wp_enqueue_scripts','solopine_load_scripts' );

function solopine_load_scripts() {

	// Register scripts and styles
	wp_register_style('sp_style', get_stylesheet_directory_uri() . '/style.css');
	wp_register_style('slicknav-css', get_template_directory_uri() . '/css/slicknav.css');
	wp_register_style('bxslider-css', get_template_directory_uri() . '/css/jquery.bxslider.css');
	wp_register_style('font-awesome', '//ngaaron.com/cat/font-awesome/4.5.0/css/font-awesome.min.css');
	wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css');
	
	wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', 'jquery', '', true);
	wp_register_script('slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', 'jquery', '', true);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/fitvids.js', 'jquery', '', true);
	wp_register_script('sp_scripts', get_template_directory_uri() . '/js/solopine.js', 'jquery', '', true);
	
	// Enqueue scripts and styles
	wp_enqueue_style('sp_style');
	wp_enqueue_style('slicknav-css');
	wp_enqueue_style('bxslider-css');
	wp_enqueue_style('font-awesome');
	
	if(!get_theme_mod('sp_responsive')) {
	wp_enqueue_style('responsive');
	}

	
	
	// JS
	wp_enqueue_script('jquery');
	wp_enqueue_script('bxslider');
	wp_enqueue_script('slicknav');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('sp_scripts');

	
	if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
	
}


//////////////////////////////////////////////////////////////////
// Include files
//////////////////////////////////////////////////////////////////

// Theme Options
include('functions/customizer/sp_custom_controller.php');
include('functions/customizer/sp_customizer_settings.php');
include('functions/customizer/sp_customizer_style.php');

// Widgets
include("inc/widgets/about_widget.php");
include("inc/widgets/social_widget.php");
include("inc/widgets/post_widget.php");
include("inc/widgets/facebook_widget.php");

//////////////////////////////////////////////////////////////////
// Register footer widgets
//////////////////////////////////////////////////////////////////
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Instagram Footer',
		'before_widget' => '<div id="%1$s" class="instagram-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="instagram-title">',
		'after_title' => '</h4>',
		'description' => 'Use the Instagram widget here. IMPORTANT: For best result select "Large" under "Photo Size" and set number of photos to 6.',
	));
}




//////////////////////////////////////////////////////////////////
// COMMENTS LAYOUT
//////////////////////////////////////////////////////////////////

	function solopine_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="thecomment">
						
				<div class="author-img">
					<?php echo get_avatar($comment,$args['avatar_size']); ?>
				</div>
				
				<div class="comment-text">
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'solopine'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
						<?php edit_comment_link(__('Edit', 'solopine')); ?>
					</span>
					<span class="author"><?php echo get_comment_author_link(); ?></span>
					<span class="date"><?php printf(__('%1$s at %2$s', 'solopine'), get_comment_date(),  get_comment_time()) ?></span>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><i class="icon-info-sign"></i> <?php _e('Comment awaiting approval', 'solopine'); ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
						
			</div>
			
			
		</li>

		<?php 
	}

//////////////////////////////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////////////////////////////
function solopine_pagination() {
	
	?>
	
	<div class="pagination">

		<div class="older"><?php next_posts_link(__( 'Older Posts <i class="fa fa-angle-double-right"></i>', 'solopine')); ?></div>
		<div class="newer"><?php previous_posts_link(__( '<i class="fa fa-angle-double-left"></i> Newer Posts', 'solopine')); ?></div>
		
	</div>
					
	<?php
	
}
	
//////////////////////////////////////////////////////////////////
// AUTHOR SOCIAL LINKS
//////////////////////////////////////////////////////////////////
function solopine_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = 'Twitter Username';
	$contactmethods['facebook']  = 'Facebook Username';
	$contactmethods['google']    = 'Google Plus Username';
	$contactmethods['tumblr']    = 'Tumblr Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';

	return $contactmethods;
}
add_filter('user_contactmethods','solopine_contactmethods',10,1);

//////////////////////////////////////////////////////////////////
// PREVENT SCROLL ON READ MORE LINK
//////////////////////////////////////////////////////////////////
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

//////////////////////////////////////////////////////////////////
// EXCLUDE FEATURED CATEGORY
//////////////////////////////////////////////////////////////////

function sp_category($separator) {
	
	if(get_theme_mod( 'sp_featured_cat_hide' ) == true) {
		
		$excluded_cat = get_theme_mod('sp_featured_cat');
		
		$first_time = 1;
		foreach((get_the_category()) as $category) {
			if ($category->cat_ID != $excluded_cat) {
				if ($first_time == 1) {
					echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "solopine" ), $category->name ) . '" ' . '>'  . $category->name.'</a>';
					$first_time = 0;
				} else {
					echo $separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "solopine" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
				}
			}
		}
	
	} else {
		
		$first_time = 1;
		foreach((get_the_category()) as $category) {
			if ($first_time == 1) {
				echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "solopine" ), $category->name ) . '" ' . '>'  . $category->name.'</a>';
				$first_time = 0;
			} else {
				echo $separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "solopine" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
			}
		}
	
	}
}

/**
 * From Twentyfourteen
 * @return string The filtered title.
 */
function solopine_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'solopine' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'solopine_wp_title', 10, 2 );

//////////////////////////////////////////////////////////////////
// THE EXCERPT
//////////////////////////////////////////////////////////////////
function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function sp_string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	
	if(count($words) > $word_limit) {
		array_pop($words);
	}
	
	return implode(' ', $words);
}





/*=======links=======*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//自定义登录页面的LOGO图片
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url(http://ngaaron.com/wp-content/uploads/2016/02/aas_fav.png) !important; }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');

//自定义登录页面的LOGO链接为首页链接
function custom_loginlogo_url($url) {
	return 'http:/ngaaron.com'; //修改URL地址
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

//自定义登录页面LOGO提示为任意文本
function custom_loginlogo_desc($url) {
    return 'AARON'; //修改文本信息
}
add_filter( 'login_headertitle', 'custom_loginlogo_desc' );


/**
 * 自定义 WordPress 后台底部的版权和版本信息
 * http://www.wpdaxue.com/change-admin-footer-text.html
 */
add_filter('admin_footer_text', 'left_admin_footer_text'); 
function left_admin_footer_text($text) {
	// 左边信息
	$text = '<span id="footer-thankyou">本站点由<a href="http://ngaaron.com">黄杏宇</a>进行创作和修改</span>'; 
	return $text;
}
add_filter('update_footer', 'right_admin_footer_text', 11); 
function right_admin_footer_text($text) {
	// 右边信息
	$text = '<span id="footer-thankyou">请支持<a href="http://ngaaron.com/">AARON</a>官方网站</span>'; 
	return $text;
}










/* 去掉调取css/js后面的版本/删除wplogo
 * Edit: zwwooooo
 */
if(!function_exists('cwp_remove_script_version')){
    function cwp_remove_script_version( $src ){  return remove_query_arg( 'ver', $src ); }
    add_filter( 'script_loader_src', 'cwp_remove_script_version' );
    add_filter( 'style_loader_src', 'cwp_remove_script_version' );
}

add_action( 'admin_bar_menu', 'cwp_remove_wp_logo_from_admin_bar_new', 25 );
function cwp_remove_wp_logo_from_admin_bar_new( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}



/**
 * 重置非管理员用户到首页
 */
  function redirect_non_admin_users() {
  	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
  		wp_redirect( home_url() );
  		exit;
  	}
  }
 add_action( 'admin_init', 'redirect_non_admin_users' );


/**
 * 记住评论者信息的Cookie
 */

add_filter('auth_cookie_expiration', 'cookie', 99, 3);
  function cookie($expiration, $user_id = 0, $remember = true) {
    
      if($remember) {
    
          $expiration = 31536000;
    
      }
    
      return $expiration;
    
  }

/**
 * 禁用前端管理工具
 */
add_filter( 'show_admin_bar', '__return_false' );


/**
 * 头像缓存
 */

function fa_cache_avatar($avatar, $id_or_email, $size, $default, $alt)
{
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    $tmp = strpos($avatar, 'http');
    $url = get_avatar_url( $id_or_email, $size ) ;
    $url = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $url);
    $avatar2x = get_avatar_url( $id_or_email, ( $size * 2 ) ) ;
    $avatar2x = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar2x);
    $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
    $tmp = strpos($g, 'avatar/') + 7;
    $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
    $w = home_url();
    $e = ABSPATH .'avatar/'. $size . '*'. $f .'.jpg';
    $e2x = ABSPATH .'avatar/'. ( $size * 2 ) . '*'. $f .'.jpg';
    $t = 1209600; 
    if ( (!is_file($e) || (time() - filemtime($e)) > $t) && (!is_file($e2x) || (time() - filemtime($e2x)) > $t ) ) { 
        copy(htmlspecialchars_decode($g), $e);
        copy(htmlspecialchars_decode($avatar2x), $e2x);
    } else { $avatar = $w.'/avatar/'. $size . '*'.$f.'.jpg';
        $avatar2x = $w.'/avatar/'. ( $size * 2) . '*'.$f.'.jpg';
        if (filesize($e) < 1000) copy($w.'/avatar/default.jpg', $e);
        if (filesize($e2x) < 1000) copy($w.'/avatar/default.jpg', $e2x);
        $avatar = "<img alt='{$alt}' src='{$avatar}' srcset='{$avatar2x}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    }
    return $avatar;
}
add_filter('get_avatar', 'fa_cache_avatar',1,5);

add_filter( 'pre_option_link_manager_enabled', '__return_true' );



//取得文章的阅读次数
function post_views($before = '阅 (', $after = ')', $echo = 1)
{
global $post;
$post_ID = $post->ID;
$views = (int)get_post_meta($post_ID, 'views', true);
if ($echo) echo $before, number_format($views), $after;
else return $views;
}
function record_visitors()
{
if (is_singular()) {
global $post;
$post_ID = $post->ID;
if($post_ID) {
$post_views = (int)get_post_meta($post_ID, 'views', true);
if(!update_post_meta($post_ID, 'views', ($post_views+1))) {
add_post_meta($post_ID, 'views', 1, true);
}
}
}
}
add_action('wp_head', 'record_visitors');


/**
 * WordPress评论回复邮件提醒防垃圾评论版
 * 作者：露兜
 * 博客：http://www.ludou.org/
 *  
 *  2014年7月5日 ：
 *  首个版本
 */

function ludou_comment_mail_notify($comment_id, $comment_status) {
  // 评论必须经过审核才会发送通知邮件
  if ($comment_status !== 'approve' && $comment_status !== 1)
    return;
  
  $comment = get_comment($comment_id);

  if ($comment->comment_parent != '0') {
    $parent_comment = get_comment($comment->comment_parent);

    // 邮件接收者email      
    $to = trim($parent_comment->comment_author_email);
    
    // 邮件标题
    $subject = '您在[' . get_option("blogname") . ']的留言有了新的回复';

    // 邮件内容，自行修改，支持HTML
    $message = '
<div style="border-bottom:3px solid #f2e929;">
<div style="border:2px solid #f2e929;  padding:10px 30px 0px 30px;">
<div style="width: 88px; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto;"><img width="100%" src="http://ngaaron.com/wp-content/uploads/2016/02/aas_fav.png"></div>
<div style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 14px; line-height: 18px; color: #999; ">   
      <p>Hi, ' . $parent_comment->comment_author . '</p>
      <p>您之前在《' . get_the_title($comment->comment_post_ID) . '》的留言：<br /><blockquote formatblock="1" style="margin: 0.8em 0px 0.8em 2em; padding: 0px 0px 0px 0.7em; border-left-width: 2px; border-left-style: solid; border-left-color:#f2e929;">'
       . $parent_comment->comment_content . '</blockquote></p>
      <p>' . $comment->comment_author . ' 给您回复:<br /><blockquote formatblock="1" style="margin: 0.8em 0px 0.8em 2em; padding: 0px 0px 0px 0.7em; border-left-width: 2px; border-left-style: solid; border-left-color:#f2e929;">'
       . $comment->comment_content . '</blockquote></p>
      <p>您可以 <a href="' . htmlspecialchars(get_comment_link($comment->comment_parent)) . ' " style="text-decoration: none; color: #148cf1">点此查看回复完整內容</a></p>
      <p>欢迎再度光临 <a href="'.home_url().'" style="text-decoration: none; color: #148cf1">' . get_option('blogname') . '</a><br /><br /></p>
</div>
      
<p style="margin-top: 20px; border-top: solid 1px #f2f2f2; padding-top: 10px; font-size: 12px; line-height: 20px; color: #999;">本邮件由AARON系统自动发出，请勿<span style="color:#f2e929">直接回复</span>哦。<br>如需联系，可发邮件至 <a href="mailto:iam@ngaaron.com" style="color: #148cf1">iam@ngaaron.com</a></p>
 <p align="center" style="margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; font-size: 12px; line-height: 20px; color: #999;">© 2015 <a href="http://ngaaron.com/" style="text-decoration: none; color: #282828"><strong>AARON</strong><span style="color: #999"> · Amateur Studio</span></a></p>

</div></div>
';

    $message_headers = "Content-Type: text/html; charset=\"".get_option('blog_charset')."\"\n";
    
    // 不用给不填email的评论者和管理员发提醒邮件
    if($to != '' && $to != get_bloginfo('admin_email'))
      @wp_mail($to, $subject, $message, $message_headers);
  }
}


// 编辑和管理员的回复直接发送提醒邮件，因为编辑和管理员的评论不需要审核
add_action('comment_post', 'ludou_comment_mail_notify', 20, 2);

// 普通访客发表的评论，等博主审核后再发送提醒邮件
add_action('wp_set_comment_status', 'ludou_comment_mail_notify', 20, 2);


// 评论添加@，by Ludou
function ludou_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<a href="#comment-' . $comment->comment_parent . '">@'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }

  return $comment_text;
}
add_filter( 'comment_text' , 'ludou_comment_add_at', 20, 2);




// 文章内链 by bigfa
function fa_insert_posts( $atts, $content = null ){
    extract( shortcode_atts( array(

        'ids' => ''

    ),
        $atts ) );
    global $post;
    $content = '';
    $postids =  explode(',', $ids);
    $inset_posts = get_posts(array('post__in'=>$postids));
    foreach ($inset_posts as $key => $post) {
        setup_postdata( $post );
        $content .=  '

<div class="aaroninpostsbox"><div class="aaroninpostsimg"><a href="' . get_permalink() . '" target="_blank" class="mixipImage" >' . get_the_post_thumbnail() . '</a></div><a href="' . get_permalink() . '" target="_blank"><span class="aaroninpostsbox-strong">' . get_the_title() . '</span></a><em class="aaronipem">' . get_the_excerpt() . '...</em><div class="aaronipmeta"><br />发表于 ' . get_the_date() . ' - ' . get_comments_number(). ' 条评论.</div></div>
';
    }
    wp_reset_postdata();
    return $content;
}
add_shortcode('in_post', 'fa_insert_posts');


/**
* WordPress 获取文章图片加强版
*/
if(!function_exists('get_mypost_thumbnail')){
  function get_mypost_thumbnail($post_ID){
     if (has_post_thumbnail()) {
            $timthumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($post_ID), 'full' ); 
            $url = $timthumb_src[0];
    } else {
        if(!$post_content){
            $post = get_post($post_ID);
            $post_content = $post->post_content;
        }
        preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', do_shortcode($post_content), $matches);
        if( $matches && isset($matches[1]) && isset($matches[1][0]) ){       
            $url =  $matches[1][0];
        }else{
            $url =  '';
        }
    }
    return $url;
  }
}

// 同步文章图文内容到微博 by Ngaaron.com at 20160304
 
function post_to_sina_weibo( $post_ID ) {
    if( wp_is_post_revision( $post_ID ) ) return;
    
    // 替换成你的新浪微博登陆名
    $username = "";
    // 替换成你的新浪微博密码
    $password = "";
    // 替换成你的微博开放平台的App Key
    $appkey = "3319626145";
 
 
       /* 获取特色图片，如果没设置就抓取文章第一张图片 */ 
       $url = get_mypost_thumbnail($post_ID);
 
 
    if ( get_post_status( $post_ID ) == 'publish' && $_POST['original_post_status'] != 'publish' ) {
        $request = new WP_Http;
 $status = strip_tags( $_POST['excerpt'] ) . ' ' . get_permalink( $post_ID );
 
if(!empty($url)){
           $api_url = 'https://api.weibo.com/2/statuses/upload_url_text.json'; /* 新的API接口地址 */
           $body = array('status' => $status,'source' => $appkey,'url' => $url);
       } else {
           $api_url = 'https://api.weibo.com/2/statuses/update.json';
           $body = array( 'status' => $status, 'source'=> $appkey);
       }
 
 
        $headers = array( 'Authorization' => 'Basic ' . base64_encode("$username:$password") );
        $result = $request->post( $api_url , array( 'body' => $body, 'headers' => $headers ) );
    }
}
 
add_action('publish_post', 'post_to_sina_weibo', 0);



