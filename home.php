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
        <?php $categories = array('29224', '28740', '28743', '28', '28742', '18', '28033', '24', '22', '37543'); ?>
        <?php for ($i = 0; $i < 10; $i++) : ?>
            <div class="swiper-slide post-listing">
                <span id="id_loop" style="display: none"><?php echo $categories[$i]; ?></span>
                <h2 style="margin-bottom: 10px;"><?php echo get_cat_name($categories[$i]) ?></h2>
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
                <?php else: ?>
                    <?php get_template_part('content','none' ); ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        <?php endfor; ?>
    </div>
</div>
<!-- end inner page -->
<?php get_footer(); ?>
