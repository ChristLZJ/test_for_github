<?php
#######################################################################
############################- 屏蔽 emojis -############################
######################################################################
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
#######################################################################
############################- 加载css和js -############################
######################################################################
function mytheme_enqueue_style()
{
    wp_enqueue_style('qzhai', get_template_directory_uri() . '/css/style.css');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_style');
function myfooter()
{
        wp_enqueue_script('qzhai', get_template_directory_uri() . '/js/app.js');
}
add_action('wp_footer', 'myfooter');
function add_scripts() {
wp_deregister_script( 'jquery' );
wp_register_script( 'jquery', 'http://libs.baidu.com/jquery/2.0.0/jquery.min.js');
wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'add_scripts');
#######################################################################
############################- 清除谷歌字体 -############################
######################################################################
function coolwp_remove_open_sans_from_wp_core()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'coolwp_remove_open_sans_from_wp_core');
#######################################################################
############################- 加载主题设置 -############################
######################################################################
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
    require_once dirname(__FILE__) . '/inc/options-framework.php';
}
#######################################################################
############################- 替换头像路径 -############################
######################################################################
function fox_get_https_avatar($avatar)
{
    $avatar = str_replace(array('www.gravatar.com', '0.gravatar.com', '1.gravatar.com', '2.gravatar.com'), 'gravatar.duoshuo.com', $avatar);
    return $avatar;
}
add_filter('get_avatar', 'fox_get_https_avatar');

#######################################################################
############################- 加载菜单 -###############################
######################################################################
include 'includes/qzhai_menu.class.php';
if (function_exists('register_nav_menus')) {
    register_nav_menus(array('main-menu' => '主菜单'));
}

#######################################################################
############################- 加载评论 -################################
######################################################################
function aurelius_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>
   <li id="li-comment-<?php comment_ID();?>">
        <article class="uk-comment">
            <?php 
                if (function_exists('get_avatar') && get_option('show_avatars')) {
                    echo get_avatar($comment, 50);
                }
            ?>
 
        <h6 class="uk-comment-title uk-clearfix"> 
            <?php printf(__('<cite>%s</cite>'), get_comment_author_link());?>
            <time><?php echo get_comment_time('Y-m-d H:i');?></time>
            <span class="uk-comment-meta uk-float-right"><?php edit_comment_link('修改 '); comment_reply_link(array_merge($args, array('reply_text' => '回复 ', 'depth' => $depth, 'max_depth' => $args['max_depth'])));?></span>
        </h6>
            <?php  if ($comment->comment_approved == '0') {?>
                <div class="uk-alert" data-uk-alert>
                    <a href="" class="uk-alert-close uk-close"></a>
                    你的评论正在审核，稍后会显示出来！
                </div>
            <?php } ?>
             <?php comment_text();?>
        </article>
    </li>
<?php 
}

#######################################################################
############################- 图片缩略图 -##############################
######################################################################
add_theme_support('post-thumbnails');
add_image_size('thumbnail', 180, 100, true);

#######################################################################
###############################- 分页 -################################
######################################################################
include 'includes/pagination.php';

#######################################################################
###############################- 加载参数 -################################
######################################################################
include 'includes/fun.php';

#######################################################################
###############################- 存档 -################################
######################################################################
class hacklog_archives
{
    function GetPosts()
    {
        global  $wpdb;
        if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
            return $posts;
        $query="SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
        $rawposts =$wpdb->get_results( $query, OBJECT );
        foreach( $rawposts as $key => $post ) {
            $posts[ mysql2date( 'Y.m', $post->post_date ) ][] = $post;
            $rawposts[$key] = null;
        }
        $rawposts = null;
        wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );;
        return $posts;
    }
    function PostList( $atts = array() )
    {
        global $wp_locale;
        global $hacklog_clean_archives_config;
        $atts = shortcode_atts(array(
            'usejs'        => $hacklog_clean_archives_config['usejs'],
            'monthorder'   => $hacklog_clean_archives_config['monthorder'],
            'postorder'    => $hacklog_clean_archives_config['postorder'],
            'postcount'    => '1',
            'commentcount' => '1',
        ), $atts);
        $atts=array_merge(array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'),$atts);
        $posts = $this->GetPosts();
        ( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );
        foreach( $posts as $key => $month ) {
            $sorter = array();
            foreach ( $month as $post )
                $sorter[] = $post->post_date_gmt;
            $sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;
            array_multisort( $sorter, $sortorder, $month );
            $posts[$key] = $month;
            unset($month);
        }
        $html = '<div class="car-container';
        if ( 1 == $atts['usejs'] ) $html .= ' car-collapse';
        $html .= '">'. "\n";
        if ( 1 == $atts['usejs'] ) $html .= '<a href="#" class="car-toggler">展开所有月份'."</a>\n\n";
        $html .= '<ul id="car-list">' . "\n";
        $firstmonth = TRUE;
        foreach( $posts as $yearmonth => $posts ) {
            list( $year, $month ) = explode( '.', $yearmonth );
            $firstpost = TRUE;
            foreach( $posts as $post ) {
                if ( TRUE == $firstpost ) {
                    $html .= '  <li><span class="car-yearmonth" data-uk-sticky="{boundary: true}">+ ' . sprintf( __('%1$s %2$d'), $wp_locale->get_month($month), $year );
                    if ( '0' != $atts['postcount'] )
                    {
                        $html .= ' <span title="文章数量">(共' . count($posts) . '篇文章)</span>';
                    }
                    $html .= "</span>\n       <ul class='car-monthlisting'>\n";
                    $firstpost = FALSE;
                }
                $html .= '          <li>' .  mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
                if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty($post->post_password) )
                    $html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';
                $html .= "</li>\n";
            }
            $html .= "      </ul>\n   </li>\n";
        }
        $html .= "</ul>\n</div>\n";
        return $html;
    }
    function PostCount()
    {
        $num_posts = wp_count_posts( 'post' );
        return number_format_i18n( $num_posts->publish );
    }
}
if(!empty($post->post_content))
{
    $all_config=explode(';',$post->post_content);
    foreach($all_config as $item)
    {
        $temp=explode('=',$item);
        $hacklog_clean_archives_config[trim($temp[0])]=htmlspecialchars(strip_tags(trim($temp[1])));
    }
}
else
{
    $hacklog_clean_archives_config=array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new');
}
$hacklog_archives=new hacklog_archives();

