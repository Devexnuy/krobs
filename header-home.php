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
        <?php    
    
        wp_head(); ?>
    </head>

    <body <?php body_class( );?>>
        <div id="main">
        
            <div class="nav-holder">
                <!--logo-->
                <div class="logo-holder">
                    <a href="<?php echo esc_url(home_url('/'));?>">
                        <?php if($theme_options['logo']['url']):?>
                        <img src="<?php echo esc_url($theme_options['logo']['url']);?>"  width="<?php echo esc_attr($theme_options['logo_size_width'] );?>" height="<?php echo esc_attr($theme_options['logo_size_height'] );?>" class="krobs-logo" alt="<?php bloginfo('name');?>" />
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
                <nav class="vis"> 
                <?php
                    $default= array(
                                    'theme_location'  => 'landing-menu',
                                    'menu'            => '',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'krobs_menu',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    // 'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                    // 'walker'          => new wp_bootstrap_navwalker(),
                                    'walker'          => new Cth_Nav_Walker(),
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '<span class="transition"></span>',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    // 'items_wrap'      => '%3$s',
                                    'depth'           => 0,
                    );
                    if ( has_nav_menu( 'landing-menu' ) ) {
                        wp_nav_menu( $default );
                    }
                ?> 
                </nav>
                <div class="arrow-nav">
                    <a href="#" class="arrow-right transition2"><i class="fa fa-angle-right"></i></a>
                    <a href="#" class="arrow-left transition2"><i class="fa fa-angle-left"></i></a>
                </div>
            </div>
            <!--about slide navigation-->
            <div class="scroll-nav">
            <?php
                    $default= array(
                                    'theme_location'  => 'scroll',
                                    'menu'            => '',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'scroll-nav',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'walker'          => new Cth_Scroll_Nav_Walker(),
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '<span>',
                                    'link_after'      => '</span>',
                                    'items_wrap'      => '%3$s',
                                    'depth'           => 0,
                    );
                    if ( has_nav_menu( 'scroll' ) ) {
                        wp_nav_menu( $default );
                    }
                ?> 
            </div>
