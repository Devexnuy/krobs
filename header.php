<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

 ?>
<?php
global $theme_options;
global $wp_query;

?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
    <head>
        <!--=============== basic  ===============-->
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="shortcut icon" href="<?php echo esc_url($theme_options['favicon']['url']);?>" type="image/x-icon"/>
        <?php    wp_head(); ?>
    </head>

    <body <?php body_class( );?>>
        <div id="main">

            <div class="nav-holder blog-bav">
                <!--logo-->
                <div class="logo-holder">
                    <a href="<?php echo esc_url(home_url('/'));?>">
                        <?php if($theme_options['logo']['url']):?>
                        <img src="<?php echo esc_url($theme_options['logo']['url']);?>"  width="<?php echo esc_attr($theme_options['logo_size_width'] );?>" height="auto" class="krobs-logo" alt="<?php bloginfo('name');?>" />
                        <?php endif;?>
                        <?php if(isset($theme_options['logo_text']) && $theme_options['logo_text'] != ''):?>
                            <h1 class="logo-text"><?php echo esc_html($theme_options['logo_text']);?></h1>
                        <?php endif;?>
                        <?php if(isset($theme_options['slogan']) && $theme_options['slogan'] != ''):?>
                            <h3 class="slogan"><em><?php echo esc_html($theme_options['slogan']);?></em></h3>
                        <?php endif;?>
                    </a>
                </div>
                <!--nav button-->
                <div class="btn-menu-wrapper elem call-menu transition2">
                    <div id="btn-menu">
                        <span class="icon-container">
                        <span class="line line01"></span>
                        <span class="line line02"></span>
                        <span class="line line03"></span>
                        <span class="line line04"></span>
                        </span>
                    </div>
                </div>
                <!--template navigation-->
                <nav class="vis swiper-container-menu">
                <?php
                    $defaults1= array(
                                    'theme_location'  => 'tmobil_menu',
                                    'menu'            => '',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'krobs_menu swiper-wrapper',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'walker'          => new Description_Walker, // custom walker to replace li with div,
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '<span class="transition"></span>',
                                    'link_after'      => '',
                                    'items_wrap'      => '<div id="%1$s" class="%2$s">%3$s</div>',
                                    'depth'           => 0,
                    );
                    if ( has_nav_menu( 'tmobil_menu' ) ) {
                        wp_nav_menu( $defaults1 );
                    } 
                ?>
                </nav>
                <div class="arrow-nav">
                    <a href="#" class="arrow-right transition2"><i class="fa fa-angle-right"></i></a>
                    <a href="#" class="arrow-left transition2"><i class="fa fa-angle-left"></i></a>
                </div>
            </div>

            <div class="wrapper">
                <div class="single-page-title-holder">
                <?php if(!empty($theme_options['blog_header_bg']['url'])) :?>
                    <div class="single-page-bg" style="background-image:url(<?php echo esc_url($theme_options['blog_header_bg']['url']);?>);"></div>
                <?php else : ?>
                    <div class="single-page-bg no-bg"></div>
                <?php endif;?>
                    <div class="page-title">
                        <div class="content">
                            <?php krobs_breadcrumbs();?>

                            <div class="clearfix"></div>
                            <div class="color-separator"></div>
                            <div class="clearfix"></div>
                            <?php if(is_404()){
                                echo '<br><br><div class="clearfix"><a href="'.esc_url(home_url('/')).'" class="button float-button content-button  transition hide-icon"><i class="fa fa-angle-left transition2"></i><span class="text transition color-bg">'.__('BACK TO HOME','krobs').'</span></a></div>';
                            }?>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="single-page">
                    <div class="content">
