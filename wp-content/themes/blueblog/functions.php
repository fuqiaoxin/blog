<?php
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

/* 
 * shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

/*

add_filter('options_framework_location','options_framework_location_override');

function options_framework_location_override() {
	return array('/extensions/options-renamed.php');
}

*/


/** 
 * Allow script and embed in textarea.
 **/
add_action('admin_init','optionscheck_change_santiziation', 100); 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
 
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
      "width" => array()
      );
		$custom_allowedtags["script"] = array(
		"src" => array(),
		"type" => array(),
		"height" => array(),
		"width" => array()
		);
 
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

/** 
 * Sets up defaults blueblog theme features 
 **/
function blueblog_setup() {

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses a custom image size for featured images
	add_theme_support('post-thumbnails');
	add_image_size('img50', 50, 50, true);
	add_image_size('img150', 150, 90, true);
	add_image_size('img200', 200, 200, true);
	add_image_size('img222', 222, 222, true);
	add_image_size('img253', 253, 160, true);
	add_image_size('img300', 300, 150, true);
	add_image_size('img310', 310, 310, true);
	add_image_size('img1118', 1118, 500, true);

	// custom background
	add_theme_support('custom-background');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'blueblog' ) );

}
add_action( 'after_setup_theme', 'blueblog_setup' );

/** 
 * Post View - Set the Post Custom Field in the WP dashboard
 **/
function bac_PostViews($post_ID) {
 
    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count';
     
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
     
    //If the the Post Custom Field value is empty.
    if($count == ''){
        $count = 0; // set the counter to zero.
         
        //Delete all custom fields with the specified key from the specified post.
        delete_post_meta($post_ID, $count_key);
         
        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count . ' View';
     
    //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);
         
        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
        return $count . ' View';
        }
        //In all other cases return (count) Views
        else {
        return $count . ' Views';
        }
    }
}

/** 
 * page navigation
 **/
function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
 global $request, $posts_per_page, $wpdb, $paged;
 if(empty($prelabel)) {   $prelabel = '&laquo;';
 } if(empty($nxtlabel)) {
 $nxtlabel = '&raquo;';
 } $half_pages_to_show = round($pages_to_show/2);
 if (!is_single()) {
 if(!is_category()) {
 preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);  } else {
 preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);  }
 $fromwhere = $matches[1];
 $numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
 $max_page = ceil($numposts /$posts_per_page);
 if(empty($paged)) {
 $paged = 1;
 }
 if($max_page > 1 || $always_show) {
 echo "$before <div id='Nav'>";   if ($paged >= ($pages_to_show-1)) {
 echo '<a href="'.get_pagenum_link().'">&laquo; First</a> ';  }
 previous_posts_link($prelabel);
 for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) {   if ($i >= 1 && $i <= $max_page) {   if($i == $paged) {
 echo "<strong class='on'>$i</strong>";
 } else {
 echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';   }
 }
 }
 next_posts_link($nxtlabel, $max_page);
 if (($paged+$half_pages_to_show) < ($max_page)) {
 echo ' <a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';   }
 echo "</div> $after";
 }
 }
}

/** 
 * limit tag cloud
 **/
add_filter('widget_tag_cloud_args', 'tag_widget_limit'); 
function tag_widget_limit($args){ 
if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){ 
$args['number'] = 30; //Limit number of tags 
} 
return $args; 
} 

/** 
 * Enqueues scripts and styles for front-end
 **/
function blueblog_scripts_styles() {
	global $wp_styles;

	// Adds JavaScript to comment form
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// all style
	wp_enqueue_style( 'blueblog-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'blueblog-style768', get_template_directory_uri() . '/style768.css' );
	wp_enqueue_style( 'blueblog-style480', get_template_directory_uri() . '/style480.css' );
	wp_enqueue_style( 'blueblog-style320', get_template_directory_uri() . '/style320.css' );
	wp_enqueue_style( 'tmmyid-bxslider', get_template_directory_uri() . '/lib/jquery.bxslider.css', false, '4.1', 'all' );
	wp_enqueue_style( 'tmmyid-swipebox', get_template_directory_uri() . '/lib/swipebox.css', false, '1.0', 'all' );

	// loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'blueblog-ie8', get_template_directory_uri() . '/style_ie8.css' );
	$wp_styles->add_data( 'blueblog-ie8', 'conditional', 'lte IE 8' );

	// all js
	wp_enqueue_script('fixmenu', get_template_directory_uri() . '/js/menu.js', false, '1.0', true);
	wp_enqueue_script('scrooltotop', get_template_directory_uri() . '/js/scrolltotop.js', false, '1.0', true);
	wp_enqueue_script('menunav', get_template_directory_uri() . '/js/responsive_nav.js', false, '1.0', true);
	wp_enqueue_script('menuscroolfix', get_template_directory_uri() . '/js/jquery-menuscrolltofixed.js', false, '1.0', true);
	wp_enqueue_script('searchautohide', get_template_directory_uri() . '/js/search.js', false, '0.1', true);
	wp_enqueue_script('bxslidermin', get_template_directory_uri('template_url') . '/js/jquery.bxslider.min.js', false, '4.1', true);
	wp_enqueue_script('bxsliderminload', get_template_directory_uri('template_url') . '/js/jquery_bxslider_min_load.js', false, '4.1', true);
	wp_enqueue_script('swipeboxmin', get_template_directory_uri() . '/js/jquery.swipebox.js', false, '1.0', true);
	wp_enqueue_script('swipeboxfixios', get_template_directory_uri() . '/js/swipebox-ios-orientationchange-fix.js', false, '1.0', true);
	wp_enqueue_script('swipeboxminload', get_template_directory_uri() . '/js/jquery_swipebox_min_load.js', false, '1.0', true);
	wp_enqueue_script('unveilimg', get_template_directory_uri() . '/js/jquery.lazy.min.js', false, '0.1.6', true);
}
add_action( 'wp_enqueue_scripts', 'blueblog_scripts_styles' );

/*
// google font
function blueblog_fonts() 
{
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'blueblog-droidsans', "$protocol://fonts.googleapis.com/css?family=Droid+Sans" );
	wp_enqueue_style( 'blueblog-latofont', "$protocol://fonts.googleapis.com/css?family=Lato:400,300,700,900" );
	wp_enqueue_style( 'blueblog-opensans-condensed', "$protocol://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,latin-ext" );
}
add_action( 'wp_enqueue_scripts', 'blueblog_fonts' );
*/



/** 
 * Content Width
 **/
if ( ! isset( $content_width ) ) $content_width = 600;

/** 
 * Widget Sidebar
 **/
register_sidebar(array('name' => 'Sidebar Widget'));

/** 
 * Widget Footer Left
 **/
register_sidebar(array('name' => 'Footer Widget Left'));

/** 
 * Widget Footer Right
 **/
register_sidebar(array('name' => 'Footer Widget Right'));

/** 
 * Shortcode in Widget
 **/
add_filter('widget_text', 'do_shortcode');

/** 
 * flickr widget
 **/
require( get_template_directory() . '/inc/widget/flickr.php' );

/** 
 * TMmyid Panel
 **/
require( get_template_directory() . '/inc/options-framework/options-framework.php' );

/** 
 * cmb
 **/
require( get_template_directory() . '/inc/meta-boxes/cmb-wp.php' );

/** 
 * shortcode
 **/
require( get_template_directory() . '/inc/symple-shortcodes/symple-shortcodes.php' );

/** 
 * Custom Widget Admin
 **/
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
	echo '<p><b>Welcome to "Easy Blog" Theme!</b></p> 
	<p>For install the theme please read the manual file.</p>
	<p>Need help? Ask the developer <a href="http://forum.template.my.id/">here</a>.</p>';
}

/** 
 * limit excerpt description by characters
 **/
function excerpt($num) {
	//echo utf8_encode(substr(get_the_excerpt(), 0, $num)) . "...";
	return cn_truncate(get_the_excerpt(),$num,'...');
}

function str_sub(){
 echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 328,"..."); 
}

function cn_truncate($string, $strlen = 20, $etc = '...',$keep_first_style = false){
$strlen = $strlen*2;
$string = trim($string);
if ( strlen($string) <= $strlen ) {
return $string;
}
$str = strip_tags($string);
$j = 0;
for($i=0;$i<$strlen;$i++) {
   if(ord(substr($str,$i,1))>0xa0) $j++; 
}
if($j%2!=0) $strlen++; 
$rstr=substr($str,0,$strlen);
if (strlen($str)>$strlen   ) {$rstr .= $etc;} 

if ( $keep_first_style == true && ereg('^<(.*)>$',$string) ) {
if ( strlen($str) <= $strlen ) {
return $string;
}
$start_pos = strpos($string,substr($str,0,4));
$end_pos = strpos($string,substr($str,-4));
$end_pos = $end_pos+4;
$rstr = substr($string,0,$start_pos) . $rstr . substr($string,$end_pos,strlen($string));
}

return $rstr; 

}



/* 
Utf-8、gb2312都支持的汉字截取函数 
cut_str(字符串, 截取长度, 开始长度, 编码); 
编码默认为 utf-8 
开始长度默认为 0 
*/ 
 
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') 
{ 
    if($code == 'UTF-8') 
    { 
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
        preg_match_all($pa, $string, $t_string); 
 
        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)).'...'; 
        //var_dump(array_slice($t_string[0], $start, $sublen));
		return ( join('', array_slice($t_string[0], $start, $sublen)) ); 
		
    } 
    else 
    { 
        $start = $start*2; 
        $sublen = $sublen*2; 
        $strlen = strlen($string); 
        $tmpstr = ''; 
 
        for($i=0; $i< $strlen; $i++) 
        { 
            if($i>=$start && $i< ($start+$sublen)) 
            { 
                if(ord(substr($string, $i, 1))>129) 
                { 
                    $tmpstr.= substr($string, $i, 2); 
                } 
                else 
                { 
                    $tmpstr.= substr($string, $i, 1); 
                } 
            } 
            if(ord(substr($string, $i, 1))>129) $i++; 
        } 
        if(strlen($tmpstr)< $strlen ) $tmpstr.= '...'; 
        return $tmpstr; 
    } 
} 

/** 
 * remove auto inline
 **/
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

/** 
 * add a custom class to wp attachment link
 **/
function modify_attachment_link( $markup, $id, $size, $permalink ) {
    global $post;
    if ( ! $permalink ) {
        $markup = str_replace( '<a href', '<a class="swipebox" rel="galleryid-'. $post->ID .'" href', $markup );
    }
    return $markup;
}
add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 4 );

/** 
 * add menu
 **/
if (function_exists('add_theme_support')) { add_theme_support('menus'); }

/* 获取文章的第一张图片 add by fxh 20140312 */
function catch_that_image($imgsize='205') {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);  //正则匹配文章中所有图片
  $first_img = $matches [1] [0];
	
	
	if($imgsize=='150'){
		$imgsize='';
	}
  
	if(empty($first_img)){ // 如果文章里没有图片,就定义默认图片
		$first_img =get_template_directory_uri()."/images/nophoto{$imgsize}.png";  //默认图片地址需自己设置
	}
	return $first_img;
}

/* 登录后跳转到指定页面
add_filter('login_redirect', 'new_login_redirect');
function new_login_redirect()
{	
	$redirect=$_GET['redirect_to'];
	if(!empty($redirect)){
		return $redirect;
	}
	return 'http://missleslie.duapp.com/wp-content/plugins/wp-connect/denglu.php';
}*/



function add_editor_buttons($buttons) {
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'backcolor';
$buttons[] = 'underline';
$buttons[] = 'hr';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'paste';
$buttons[] = 'cleanup';
$buttons[] = 'wp_page';
$buttons[] = 'newdocument';
$buttons[] = 'image';
$buttons[] = 'code';
return $buttons;
}

add_filter("mce_buttons_3", "add_editor_buttons");


/**
 * add by fxh 2014 06 26 注册显示修改 	
 */
function is_register() {

	if ( ! is_user_logged_in() ) {
		if ( get_option('users_can_register') ){
			$link = '<a href="' . esc_url( wp_registration_url() ) . '">注册</a>';
		}else{
			$link = '';
		}	
	} else {
		
		$avator=get_avatar( wt_get_user_id(), 32);
		$username=wt_get_username();
		
		$link =$avator.'<a href="' . admin_url() . '">个人中心</a>' ;
		
		
	}

	echo $link;
}

/*
 * add by fxh 2015 0403
 */
 /*
function is_multisite(){
	return true;
}*/

// add by fxh 2014 0626  只管理员可以看到原来自带的导航
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}



// 获取用户id  add by fxh
function wt_get_user_id(){
    global $userdata;
    get_currentuserinfo();
    return $userdata->ID;
}

//获取用户显示名称
function wt_get_username(){
	global $userdata;
    get_currentuserinfo();
	return $userdata->display_name;
}

// 显示用户是否登录的状态 add by fxh
function my_showlogin(){
	$redirect=get_my_currenturl();
	if ( ! is_user_logged_in() ){
		$link ='<a href="' . esc_url( wp_login_url($redirect) ) . '">登录</a>';
		if ( get_option('users_can_register') ){
			$link .= '<a href="' . esc_url( wp_registration_url() ) . '">注册</a>';
		}else{
			$link.= '';
		}
		
	}else{
		//如果用户已经登录 显示用户相关信息
		$avator=get_avatar( wt_get_user_id(), 32); // 用户头像
		$username=wt_get_username(); //用户名称
		
		$link= '<div id="userinfoBtn" ><a class="avator_bg" target="_blank" href="' . admin_url() . '" ></a>'.$avator.'<span>'.$username.'</span>';
		
		$link.='<ul class="userinfo_list">';
		$link.= '<li><a target="_blank" href="' . admin_url() . '/post-new.php">写文章</a></li>';
		$link.= '<li><a target="_blank" href="' . admin_url() . '">个人中心</a></li>';
		$link.= '<li><a href="'. esc_url( wp_logout_url($redirect) ) .'" >退出</a></li>';
		$link.='</ul></div>';
		
		
	}
	
	echo $link;
	
	
}

// 获取当前页面url add by fxh 2014 0627
function get_my_currenturl(){
	$url='http://';
	$url.=$_SERVER['SERVER_NAME'];
	$url.=$_SERVER['REQUEST_URI'];
	
	return $url;
}

// 过滤掉文章中的空格和换行和&nbsp;
function my_DeleteHtml($str) 
{ 
	$str = trim($str); //清除字符串两边的空格
	$str = strip_tags($str,""); //利用php自带的函数清除html格式
	$str = preg_replace("/\t/","",$str); //使用正则表达式匹配需要替换的内容，如：空格，换行，并将替换为空。
	$str = preg_replace("/\r\n/","",$str); 
	$str = preg_replace("/\r/","",$str); 
	$str = preg_replace("/\n/","",$str); 
	$str = preg_replace("/ /","",$str);
	$str = preg_replace("/&nbsp;/","",$str);  //匹配html中的空格
	return trim($str); //返回字符串
}


/**
 * WordPress 后台禁用Google Open Sans字体，加速网站
 * http://www.wpdaxue.com/disable-google-fonts.html
 
add_filter( 'gettext_with_context', 'wpdx_disable_open_sans', 888, 4 );
function wpdx_disable_open_sans( $translations, $text, $context, $domain ) {
  if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
  }
  return $translations;
}
*/

// 去除后台的logo及相关勿用的小东西 来自 wpdaxue.com
add_action( 'admin_bar_menu', 'cwp_remove_wp_logo_from_admin_bar_new', 25 );
function cwp_remove_wp_logo_from_admin_bar_new( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}
// 去除加载文件后面的版本号
if(!function_exists('cwp_remove_script_version')){
    function cwp_remove_script_version( $src ){  return remove_query_arg( 'ver', $src ); }
    add_filter( 'script_loader_src', 'cwp_remove_script_version' );
    add_filter( 'style_loader_src', 'cwp_remove_script_version' );
}


//*
// 移除WP为仪表盘(dashboard)页面加载的小工具  来自互联网 wpdaxue.com
function cwp_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'cwp_remove_dashboard_widgets',11 );
//*/
/**
 * 修复 WordPress 找回密码提示“抱歉，该key似乎无效”
 * http://www.wpdaxue.com/lost-password-error-invalidkey.html
 */
function reset_password_message( $message, $key ) {
	if ( strpos($_POST['user_login'], '@') ) {
		$user_data = get_user_by('email', trim($_POST['user_login']));
	} else {
		$login = trim($_POST['user_login']);
		$user_data = get_user_by('login', $login);
	}
	$user_login = $user_data->user_login;
	$msg = __('您要求重设如下帐号的密码：'). "\r\n\r\n";
	$msg .= network_site_url() . "\r\n\r\n";
	$msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
	$msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
	$msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
	$msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
	return $msg;
}
add_filter('retrieve_password_message', reset_password_message, null, 2);




/** Global Plugin Scripts for The WordPress Admin Area  add by fxh 2014.09.09  添加修改的后台管理css文件 */  
function pluginScripts() {  
    
    wp_register_style( 'plugin', plugins_url( 'admin_style.css' , __FILE__ ) );  
    wp_enqueue_style( 'plugin' );  
}  
add_action( 'admin_enqueue_scripts', 'pluginScripts' );


/** Adding Scripts To The WordPress Login Page */  
function myLoginScripts() {     
?>  
    <link rel='stylesheet' id='default-css' href='<?php echo get_template_directory_uri() . '/admin_style.css';?>' type='text/css' media='all' />  
<?php }  
add_action( 'login_enqueue_scripts', 'myLoginScripts' );  
/** Deregister the login css files */  
function removeScripts() {  
    wp_deregister_style( 'wp-admin' );
    wp_deregister_style( 'colors-fresh' );
}
add_action( 'login_init', 'removeScripts' );

?>