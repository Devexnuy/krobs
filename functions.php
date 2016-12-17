<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if (!isset($theme_options) && file_exists(get_template_directory() . '/functions/admin-config.php')) {
    require_once (get_template_directory() . '/functions/admin-config.php');
}
function krobs_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'krobs_removeDemoModeLink');

// Custom fields:
require_once dirname( __FILE__ ) . '/framework/Custom-Metaboxes/metabox-functions.php';
require_once dirname( __FILE__ ) . '/framework/cth_nav_walker.php';
require_once dirname( __FILE__ ) . '/framework/cth_scroll_nav_walker.php';
// require_once dirname( __FILE__ ) . '/framework/BFI_Thumb.php';
require_once dirname( __FILE__ ) . '/framework/twitterfeed/helper.php';
require_once dirname( __FILE__ ) . '/shortcodes.php';

/*  Add responsive container to embeds
/* ------------------------------------ */
function alx_embed_html( $html ) {
    return '<div class="fitvids-container">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' );

if ( ! isset( $content_width ) ){
    $content_width = 690;
}
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background');
add_filter('widget_text', 'do_shortcode');

/*Custom Title tag for older wordpress version */
if (!function_exists('_wp_render_title_tag')) {
    function krobs_render_title() {
?>
<title><?php
        wp_title('|', true, 'right'); ?></title>
<?php
    }
    add_action('wp_head', 'krobs_render_title');
}

/* Register Sidebars */
function krobs_register_sidebars(){

    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'krobs' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Appears in the sidebar section of the site.', 'krobs' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Page Sidebar', 'krobs' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Appears in the sidebar section of the page template.', 'krobs' ),
        'before_widget' => '<div id="%1$s" class="widget cth %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Ads', 'krobs' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Este widget aparece en la sección home.', 'krobs' ),
        'before_widget' => '<div id="%1$s" class="widget cth %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

}

add_action('widgets_init','krobs_register_sidebars' );
if(!function_exists('krobs_theme_setup')){
    function krobs_theme_setup() {
        $lang = get_template_directory() . '/languages';
        load_theme_textdomain('krobs', $lang);

        add_theme_support( 'post-thumbnails' );
        // Adds RSS feed links to <head> for posts and comments.
        add_image_size("foliothumb" , 400, 265, true );
        add_image_size( 'home-thumbnail', 160, 130, true );
        add_theme_support( 'automatic-feed-links' );
        // Switches default core markup for search form, comment form, and comments

        add_theme_support( 'title-tag' );

        // to output valid HTML5.
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
        //Post formats
        add_theme_support( 'post-formats', array(
            'audio',  'gallery', 'image', 'link', 'quote', 'status', 'video'
        ) );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary', __( 'Main Blog Navigation Menu', 'krobs' ) );
        register_nav_menu( 'landing-menu', __( 'Home Page Navigation Menu', 'krobs' ) );
        register_nav_menu( 'scroll', __( 'About Scroll Menu', 'krobs' ) );
        // This theme uses its own gallery styles.

        add_filter( 'use_default_gallery_style', '__return_false' );
    }
}


add_action( 'after_setup_theme', 'krobs_theme_setup' );

/**
 * Enqueue admin scripts and styles.
 *
 * @since Krobs 1.5
 */

if (!function_exists('krobs_enqueue_admin_scripts')) {
    function krobs_enqueue_admin_scripts() {
        // wp_register_script('cththemes-import', get_template_directory_uri() . '/includes/cththemes-import.js', false, '1.0.0', true);
        // wp_enqueue_script('cththemes-import');

        wp_enqueue_style('krobsadmin-styles', get_template_directory_uri() . '/inc/assets/admin_styles.css');
    }
}
add_action('admin_enqueue_scripts', 'krobs_enqueue_admin_scripts');

if(!function_exists('krobs_theme_scripts_styles')){
    function krobs_theme_scripts_styles() {
    	global $theme_options;
    	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
            wp_enqueue_script( 'comment-reply' );
        }
    	// wp_enqueue_script("jquery");

        // wp_enqueue_script("jpreloader", get_template_directory_uri()."/js/jpreloader.min.js",array(),false,true);
        wp_enqueue_script("krobsjs-plugins", get_template_directory_uri()."/js/plugins.js",array('jquery'),false,true);
        // wp_enqueue_script("YTPlayer", get_template_directory_uri()."/js/YTPlayer.js",array(),false,true);
        // wp_enqueue_script("superslides", get_template_directory_uri()."/js/superslides.js",array(),false,true);
        // wp_enqueue_script("fitvids", get_template_directory_uri()."/js/jquery.fitvids.js",array(),false,true);
        wp_enqueue_script("krobs-scripts", get_template_directory_uri()."/js/scripts.js",array(),false,true);
        wp_enqueue_script("custon", get_template_directory_uri()."/js/custom.js",array(),false,true);
        wp_enqueue_script("krobs-slick", get_template_directory_uri()."/js/slick.min.js",array(),false,true);

        wp_localize_script('krobs-scripts', 'krobs_obj', array(
            'show_loader' => isset($theme_options['show_loader'])? $theme_options['show_loader']: 1,
            'show_menu_start' => isset($theme_options['show_menu_start'])? $theme_options['show_menu_start']:0,
        ));

    	// wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
        wp_enqueue_style( 'krobscss-reset', get_template_directory_uri().'/css/reset.css');
        wp_enqueue_style( 'krobscss-bootstrap', get_template_directory_uri().'/css/bootstrap.css');
        // wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css',array(),false,'screen');
        // wp_enqueue_style( 'idangerous-swiper', get_template_directory_uri().'/css/idangerous.swiper.css');
        wp_enqueue_style( 'krobscss-plugins', get_template_directory_uri().'/css/plugins.css');
        // wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
        // wp_enqueue_style( 'YTPlayer-style', get_template_directory_uri().'/css/YTPlayer.css');
        wp_enqueue_style( 'krobscss-theme', get_stylesheet_uri(), array(), '2015-03-06');
        wp_enqueue_style( 'krobscss-custom', get_template_directory_uri().'/css/custom.css');
        // Main file on construction
        wp_enqueue_style('krobsless-main', get_stylesheet_directory_uri() . '/css/main.css');
        // Slick slider
        wp_enqueue_style('krobsless-slick', get_stylesheet_directory_uri() . '/css/slick.css');
        wp_enqueue_style('krobsless-slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css');

        global $wp_query;
        $args = array(
            'nonce' => wp_create_nonce( 'be-load-more-nonce' ),
            'url'   => admin_url( 'admin-ajax.php' ),
            'query' => $wp_query->query,
            'style' => get_site_url()
        );

        wp_enqueue_script( 'be-load-more', get_stylesheet_directory_uri() . '/js/load-more.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'be-load-more', 'beloadmore', $args );

        if($theme_options['override-preset'] === 'yes'){
            wp_enqueue_style( 'color', get_template_directory_uri().'/css/color.php?cl='.substr($theme_options['theme-color'], 1));
        }else{
            wp_enqueue_style( 'color', get_template_directory_uri().'/css/'.$theme_options['color-preset'].'.css');
        }
        if($theme_options['custom-css'] !== ''){
            wp_add_inline_style( 'krobscss-custom', $theme_options['custom-css'] );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'krobs_theme_scripts_styles' );
if(!function_exists('krobs_breadcrumbs')){
    //My Bread Crumb
    function krobs_breadcrumbs() {
        global $theme_options;
        $text['home']     = $theme_options['blog_home_text'];// __('Our --Blog--','krobs'); // text for the 'Home' link
        $text['category'] = __('Archive by Category "%s"','krobs'); // text for a category page
        $text['tax']       = __('Archive for "%s"','krobs'); // text for a taxonomy page
        $text['search']   = __('Search Results for "%s" Query','krobs'); // text for a search results page
        $text['tag']      = __('Posts Tagged "%s"','krobs'); // text for a tag page
        $text['author']   = __('Articles Posted by %s','krobs'); // text for an author page
        $text['archive']  = __('Archive: %s','krobs');
        $text['404']      = __('404 Error','krobs'); // text for the 404 page

        global $post;
        global $theme_options;

        if (is_home() /*|| is_front_page()*/) {
            echo '<h2>';
            echo preg_replace("/--([^(-){2}]*)--/", "<span>$1</span>", $text['home']) ;
            echo '</h2>';
            echo '<div class="clearfix"></div>';
            if(!empty($theme_options['blog_intro'])){
                echo '<p>';
                echo htmlspecialchars_decode($theme_options['blog_intro']);
                echo '</p>';
            }

        }else{
            if ( is_search() ) {
                echo '<h2>';
                printf($text['search'],get_search_query());
                echo '</h2>';
                echo '<div class="clearfix"></div>';

            } elseif ( is_single() && !is_attachment() ) {
                echo '<h2>';
                the_title();
                echo '</h2>';
                echo '<div class="clearfix"></div>';
                if($theme_options['single_intro_type'] == '1'){
                    echo '<p>';
                    echo htmlspecialchars_decode($theme_options['blog_intro']);
                    echo '</p>';
                }elseif($theme_options['single_intro_type'] === '2'){

                    the_excerpt();

                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo '<h2>';
                echo esc_attr($post_type->labels->singular_name );
                echo '</h2>';
                echo '<div class="clearfix"></div>';

            } elseif ( is_page() && !$post->post_parent ) {
                echo '<h2>';
                the_title();
                echo '</h2>';
                echo '<div class="clearfix"></div>';

            } elseif ( is_page() && $post->post_parent ) {
                echo '<h2>';
                the_title();
                echo '</h2>';
                echo '<div class="clearfix"></div>';

            }elseif ( is_404() ) {

                echo '<h2>';
                echo esc_attr( $text['404'] );
                echo '</h2>';
                echo '<div class="clearfix"></div>';
                echo '<p>';
                _e('Page Not Found','krobs');
                echo '</p>';

            }


            if(is_archive()){
                the_archive_title('<h2>','</h2><div class="clearfix"></div>');
                if($theme_options['archive_intro_type'] == '1'){
                    if(!empty($theme_options['blog_intro'])){
                        echo '<p>';
                        echo htmlspecialchars_decode($theme_options['blog_intro']);
                        echo '</p>';
                    }
                }elseif($theme_options['archive_intro_type'] == '2'){
                    $description = get_the_archive_description();
                    if ( $description ) {

                        echo htmlspecialchars_decode($description );

                    }
                }

            }
        }

    }
}



add_shortcode('gallery', '__return_false');

// //Custom Excerpt Function
function krobs_excerpt($limit = 20) {
  global $theme_option;
  if(isset($theme_option['blog_excerpt'])){
    $limit = $theme_option['blog_excerpt'];
  }

  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

// //pagination
function krobs_pagination($prev = 'Prev', $next = 'Next', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => __($prev,'krobs'),
        'next_text' => __($next,'krobs'),
        'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
    if($return){
        echo '<div class="pagination-holder">'.str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $return ).'</div>';
    }

}

// function krobs_custom_img( $image_width = '', $image_height = '', $crop = false ,$thumb_size = '' ) {

//   global $post;

//   if(empty($thumb_size)){
//     $thumb_size = 'full';
//   }

//   $params = array();

//   if(!empty($image_width)){
//     $params['width'] = $image_width;
//   }

//   if(!empty($image_height)){
//     $params['height'] = $image_height;
//   }

//   if($crop){
//     $params['crop'] = true;
//   }

//   $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID, '' ), $thumb_size );
//   $custom_img_src = bfi_thumb( $imgsrc[0], $params );

//   return $custom_img_src;

// }

//Get thumbnail url
function krobs_thumbnail_url($size){
    global $post;
    //$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()),$size );
    if($size==''){
        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
         return $url;
    }else{
        $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
         return $url[0];
    }
}

function krobs_post_nav() {
    global $post;
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous )
        return;
    ?>
    <ul class="pager clearfix">
      <li class="previous">
        <?php previous_post_link( '%link', _x( ' &larr; Prev', 'Previous post link', 'krobs' ) ); ?>
      </li>
      <li class="next">
        <?php next_post_link( '%link', _x( 'Next &rarr;', 'Next post link', 'krobs' ) ); ?>
      </li>
    </ul>
<?php
}

function krobs_theme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo esc_html($tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
        <div class="comment-author">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <?php printf( __( '<cite class="fn">%s</cite>','krobs' ), get_comment_author_link() ); ?>
        <div class="comment-meta">
            <h6><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                    /* translators: 1: date, 2: time */
                    printf( __('%1$s at %2$s','krobs'), get_comment_date(),  get_comment_time() ); ?></a> / <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></h6>
        </div>

        <?php comment_text(); ?>

        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','krobs' ); ?></em>
            <br />
        <?php endif; ?>

        <?php edit_comment_link( __( '(Edit)','krobs' ), '  ', '' );
        ?>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
}


/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'krobs_vcSetAsTheme' );
function krobs_vcSetAsTheme() {
    vc_set_as_theme($disable_updater = true);
}

require_once get_template_directory() . '/vc_extend/vc_shortcodes.php';
//if(class_exists('WPBakeryVisualComposerSetup')){
    function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
        if($tag=='vc_row' || $tag=='vc_row_inner') {
            $class_string = str_replace('vc_row-fluid', '', $class_string);
        }
        if($tag=='vc_column' || $tag=='vc_column_inner') {
            $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'span$1', $class_string);
        }
        return $class_string;
    }

    // Filter to Replace default css class for vc_row shortcode and vc_column

    // add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);

    // Add new Param in Row

    if(function_exists('vc_add_param')){
        vc_add_param('vc_row',array(
                                  "type" => "textfield",
                                  "heading" => __('Section ID', 'wpb'),
                                  "param_name" => "sec_id",
                                  "value" => "",
                                  "description" => __("Section ID", "wpb"),
                                  "group" => 'Krobs Theme',
        ));

        vc_add_param('vc_row',array(
                                  "type" => "textfield",
                                  "heading" => __('Youtube Video ID', 'wpb'),
                                  "param_name" => "video_id",
                                  "value" => "",
                                  "description" => __("Your Youtube Video ID. Will use in Home Slide Video BG layout only", "wpb"),
                                  "group" => 'Krobs Theme',
        ));

        vc_add_param('vc_row',array(
                                  "type" => "attach_images",
                                  "heading" => __('Slideshow Images', 'wpb'),
                                  "param_name" => "slideshow_imgs",
                                  "value" => "",
                                  "description" => __("Slideshow Images. Will use in Home Slide Slideshow and Home Slide Animated Slideshow layout", "wpb"),
                                  "group" => 'Krobs Theme',
        ));

        vc_add_param('vc_row',array(
                                  "type" => "dropdown",
                                  "heading" => __('Section Layout', 'wpb'),
                                  "param_name" => "layout",
                                  "value" => array(
                                                    __('Default', 'wpb') => 'default',

                                                    __('Home Slide', 'wpb') => 'home_slide',
                                                    __('Home Slide Slideshow', 'wpb') => 'home_slide_slideshow',
                                                    __('Home Slide Animated Slideshow', 'wpb') => 'home_slide_anim_slideshow',
                                                    __('Home Slide Video BG', 'wpb') => 'home_slide_video',
                                                    __('About Slide', 'wpb') => 'about_slide',
                                                    __('Portfolio Slide', 'wpb') => 'folio_slide',
                                                    __('Contact Slide', 'wpb') => 'contact_slide',
                                                    __('Swiper Slide', 'wpb') => 'slide',

                                                  ),
                                  "description" => __("Select one of the pre made page sections or using default", "wpb"),
                                  "group" => 'Krobs Theme',
                                )
        );

        vc_add_param('vc_row_inner',array(
                                  "type" => "dropdown",
                                  "heading" => __('Section Layout', 'wpb'),
                                  "param_name" => "layout",
                                  "value" => array(
                                                    __('Default', 'wpb') => 'default',

                                                    __('Home Slide Intro', 'wpb') => 'home_slide_top',
                                                    __('Home Slide Footer', 'wpb') => 'home_slide_footer',

                                                    __('About Features', 'wpb') => 'about_features',
                                                    __('About Services', 'wpb') => 'about_services',
                                                    __('About Facts', 'wpb') => 'about_facts',
                                                    __('About Twitter','wpb') => 'about_twitter',
                                                    __('About Resume','wpb') => 'about_resume',
                                                    __('About Testimonials','wpb') => 'about_testimonials',
                                                    __('About Clients','wpb') => 'about_clients',

                                                    __('Contact Form','wpb') => 'contact_form',
                                                    __('Contact Social','wpb') => 'contact_social',

                                                    __('Portfolio Subscribe','wpb') => 'folio_subscribe',
                                                    __('Portfolio Order','wpb') => 'folio_order',
                                                  ),
                                  "description" => __("Select one of the pre made page sections or using default", "wpb"),
                                  "group" => 'Krobs Theme',
                                )
        );

        vc_add_param('vc_row_inner',array(
                                  "type" => "textfield",
                                  "heading" => __('Section ID', 'wpb'),
                                  "param_name" => "sec_id",
                                  "value" => "",
                                  "description" => __("Section ID", "wpb"),
                                  "group" => 'Krobs Theme',
        ));

        vc_add_param('vc_column',array(
                                  "type" => "dropdown",
                                  "heading" => __('Content Only', 'wpb'),
                                  "param_name" => "content_only",
                                  "value" => array(
                                                    __('No', 'wpb') => 'no',
                                                    __('Yes', 'wpb') => 'yes',
                                                  ),
                                  "description" => __("Set this to Yes if you don't want output column layout mockup", "wpb"),
                                  "group" => 'Krobs Theme',
                                )
        );
        vc_add_param('vc_column_inner',array(
                                  "type" => "dropdown",
                                  "heading" => __('Content Only', 'wpb'),
                                  "param_name" => "content_only",
                                  "value" => array(
                                                    __('No', 'wpb') => 'no',
                                                    __('Yes', 'wpb') => 'yes',
                                                  ),
                                  "description" => __("Set this to Yes if you don't want output column layout mockup", "wpb"),
                                  "group" => 'Krobs Theme',
                                )
        );

    }

    // if(function_exists('vc_remove_param')){
    //     vc_remove_param('vc_row','font_color');
    //     vc_remove_param('vc_column','font_color');
    // }

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'krobs_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function krobs_register_required_plugins() {

    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
    */
    $plugins = array(

        // This is an example of how to include a plugin from a private repo in your theme.
        array('name' => 'Redux Framework',
             // The plugin name.
            'slug' => 'redux-framework',
             // The plugin slug (typically the folder name).
            //'source' => get_template_directory_uri() . '/framework/plugins/redux-framework.3.5.9.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => true,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'https://downloads.wordpress.org/plugin/redux-framework.3.5.9.zip',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        array('name' => 'WPBakery Visual Composer',
             // The plugin name.
            'slug' => 'js_composer',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/js_composer.4.11.1.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        array('name' => 'Rock Lobster Contact Form 7',
             // The plugin name.
            'slug' => 'contact-form-7',
             // The plugin slug (typically the folder name).
            // 'source' => get_template_directory_uri() . '/framework/plugins/contact-form-7.4.4.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.zip',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        array('name' => 'Krobs Theme Add-ons',
             // The plugin name.
            'slug' => 'cth_portfolio_posttype',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/cth_portfolio_posttype.1.5.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        array('name' => 'Envato Wordpress Toolkit',
             // The plugin name.
            'slug' => 'envato-wordpress-toolkit',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/envato-wordpress-toolkit.1.7.3.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'https://github.com/envato/envato-wordpress-toolkit',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
    */
    $config = array(
        'id' => 'tgmpa',
         // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',
         // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins',
         // Menu slug.
        'parent_slug' => 'themes.php',
         // Parent menu slug.
        'capability' => 'edit_theme_options',
         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,
         // Show admin notices or not.
        'dismissable' => true,
         // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',
         // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,
         // Automatically activate plugins after installation or not.
        'message' => '',
         // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}

/**
 * AJAX Load More
 * @link http://www.billerickson.net/infinite-scroll-in-wordpress
 */

function be_ajax_load_more() {
    check_ajax_referer( 'be-load-more-nonce', 'nonce' );

    $args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();
    //$args['post_type'] = isset( $args['post_type'] ) ? esc_attr( $args['post_type'] ) : 'post';
    $args['paged'] = esc_attr( $_POST['page'] );
    //$args['post_status'] = 'publish';
    $args['posts_per_page'] = 15;
    $args['cat'] = esc_attr($_POST['id_loop']);
    ob_start();
    $post_number = 1;
    $loop = new WP_Query( $args );
    if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
        get_template_part( 'content');
        if ($post_number == 5 || $post_number == 10 || $post_number == 15) {
            if ( is_active_sidebar( 'sidebar-2' ) ) {
                dynamic_sidebar( 'sidebar-2' );
            } else {
                echo "<p>Active su widget: Publicidad No. 2.</p>";
            }
        }
        $post_number++;
    endwhile;
    endif; wp_reset_postdata();
    $data = ob_get_clean();
    wp_send_json_success( $data );
    wp_die();
}

add_action( 'wp_ajax_be_ajax_load_more', 'be_ajax_load_more' );
add_action( 'wp_ajax_nopriv_be_ajax_load_more', 'be_ajax_load_more' );

/**
 * Javascript for Load More
 *
 */

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');

/*
 * Walker for custom main menu
 */
class Description_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = empty($item->classes) ? array () : (array) $item->classes;
        $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        !empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . ' swiper-slide"';
        $output .= "<div id='menu-item-$item->ID' $class_names>";
        $attributes  = '';
        !empty( $item->attr_title ) and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        !empty( $item->xfn ) and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        !empty( $item->url ) and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = $args->before
        . "<a $attributes>"
        . $args->link_before
        . $title
        . '</a></div>'
        . $args->link_after
        . $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * AJAX Single post next and previous post
 * @link http://wordpress.stackexchange.com/questions/55259/get-previous-next-posts-by-post-id
 */

 function get_previous_post_id() {
     $post_id = $_POST['post_id'];
     // Get a global post reference since get_adjacent_post() references it
     global $post;
     // Store the existing post object for later so we don't lose it
     $oldGlobal = $post;
     // Get the post object for the specified post and place it in the global variable
     $post = get_post( $post_id );
     // Get the post object for the previous post
     $previous_post = get_previous_post(true);
     // Reset our global object
     $post = $oldGlobal;
     ob_start();
     if (!empty($previous_post)) { ?>
         <?php $args = array(
             'posts_per_page' => 1,
             'p'              => $previous_post->ID
         );
         $query = new WP_Query( $args ); ?>
         <?php if ($query->have_posts()) : ?>
             <div class="swiper-slide">
                 <?php while ($query->have_posts()) : $query->the_post(); ?>
                     <?php get_template_part( 'content', 'single'); ?>
                 <?php endwhile; ?>
             </div>
         <?php endif; ?>
     <?php } else {

     }
     $data = ob_get_clean();
     wp_send_json_success( $data );
     wp_die();
 }

 function get_next_post_id() {
     $post_id = $_POST['post_id'];
     // Get a global post reference since get_adjacent_post() references it
     global $post;
     // Store the existing post object for later so we don't lose it
     $oldGlobal = $post;
     // Get the post object for the specified post and place it in the global variable
     $post = get_post( $post_id );
     // Get the post object for the previous post
     $previous_post = get_next_post(true);
     // Reset our global object
     $post = $oldGlobal;
     ob_start();
     if (!empty($previous_post)) { ?>
         <?php $args = array(
             'posts_per_page' => 1,
             'p'              => $previous_post->ID
         );
         $query = new WP_Query( $args ); ?>
         <?php if ($query->have_posts()) : ?>
             <div class="swiper-slide">
                 <?php while ($query->have_posts()) : $query->the_post(); ?>
                     <?php get_template_part( 'content', 'single'); ?>
                 <?php endwhile; ?>
             </div>
         <?php endif; ?>

     <?php } else {

     }
     $data = ob_get_clean();
     wp_send_json_success( $data );
     wp_die();
 }

function get_home_loop() {
    $categories = array('29224', '28740', '28743', '28', '28742', '18', '28033', '24', '22', '37543');
    $cat_position = $_POST['cat_position'];
    ob_start(); ?>

        <span id="id_loop" style="display: none"><?php echo $categories[$cat_position]; ?></span>
        <h2 style="margin-bottom: 10px;"><?php echo get_cat_name($categories[$cat_position]) ?></h2>
        <?php $args = array(
            "posts_per_page" => 15,
            "cat"            => $categories[$cat_position]
        );
        $query = new WP_query ( $args ); ?>
        <?php $post_number = 1; ?>
        <?php if($query->have_posts()) : ?>
            <?php while($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part( 'content'); ?>
                <?php //Custom ads ?>
                <?php if ($post_number == 2): ?>
                    <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
                        <?php dynamic_sidebar( 'sidebar-2' ); ?>
                    <?php else: ?>
                        <p>Active su widget: Publicidad No. 2.</p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($post_number == 8): ?>
                    <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
                        <?php dynamic_sidebar( 'sidebar-4' ); ?>
                    <?php else: ?>
                        <p>Active su widget: Publicidad No. 4.</p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($post_number == 15): ?>
                    <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
                        <?php dynamic_sidebar( 'sidebar-3' ); ?>
                    <?php else: ?>
                        <p>Active su widget: Publicidad No. 3.</p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php // End . Custom ads ?>
                <?php $post_number++; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <?php get_template_part('content','none' ); ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    
    <?php $data = ob_get_clean();
    wp_send_json_success( $data );
    wp_die();
}

add_action( 'wp_ajax_get_previous_post_id', 'get_previous_post_id' );
add_action( 'wp_ajax_nopriv_get_previous_post_id', 'get_previous_post_id' );

add_action( 'wp_ajax_get_next_post_id', 'get_next_post_id' );
add_action( 'wp_ajax_nopriv_get_next_post_id', 'get_next_post_id' );

add_action( 'wp_ajax_get_home_loop', 'get_home_loop' );
add_action( 'wp_ajax_nopriv_get_home_loop', 'get_home_loop' );


//Insert ads after second paragraph of single post content.

add_filter( 'the_content', 'prefix_insert_post_ads' );

function prefix_insert_post_ads( $content ) {
    ob_start();
    if (is_active_sidebar('sidebar-2')) {
        dynamic_sidebar( 'sidebar-2' );
    } else {
        echo '<p>Active su widget: Publicidad No. 1.</p>';
    }
    $data = ob_get_clean();
	$ad_code = $data;

	if ( true ) {
		return prefix_insert_after_paragraph( $ad_code, 2, $content );
	}

	return $content;
}

// Parent Function that makes the magic happen

function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}

	return implode( '', $paragraphs );
}
