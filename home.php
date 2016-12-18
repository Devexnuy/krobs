<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
global $theme_options;
get_header();

?>
<!-- Swiper -->
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
<?php else: ?>
    <p>Active su widget: Publicidad No. 1.</p>
<?php endif; ?>
<div class="swiper-container">
    <div class="swiper-wrapper" id="SW_master">
        <?php $categories = array('29224', '28740'); ?>
        <?php for ($i = 0; $i < count($categories); $i++) : ?>
            <div class="swiper-slide post-listing">
                <span id="id_loop" style="display: none"><?php echo $categories[$i]; ?></span>
                <h2 style="margin-bottom: 10px;"  class="main-category"><?php echo get_cat_name($categories[$i]) ?></h2>
                <?php $args = array(
                    "posts_per_page" => 15,
                    "cat"            => $categories[$i]
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
                    <span class="load-more" style="clear: both;display: block"></span>
                <?php else: ?>
                    <?php get_template_part('content','none' ); ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        <?php endfor; ?>
        <div class="swiper-slide post-listing ajax cat-2">
            <span class="cat-num">cat-2</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-3">
            <span class="cat-num">cat-3</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-4">
            <span class="cat-num">cat-4</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-5">
            <span class="cat-num">cat-5</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-6">
            <span class="cat-num">cat-6</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-7">
            <span class="cat-num">cat-7</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-8">
            <span class="cat-num">cat-8</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-9">
            <span class="cat-num">cat-9</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-10">
            <span class="cat-num">cat-10</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
        <div class="swiper-slide post-listing ajax cat-11">
            <span class="cat-num">cat-11</span>
            <h2 class="loading-home">Cargando...</h2>
        </div>
    </div>
</div>
<!-- end inner page -->
<?php get_footer(); ?>
