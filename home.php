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
<div class="swiper-container">
    <div class="swiper-wrapper" id="SW_master">
        <?php
        $categories = get_categories( array(
            "hide_empty" => 1,
            "orderby"    => "name",
            "order"      => "ASC"
        ) ); ?>
        <?php foreach( $categories as $category ) : ?>
            <div class="swiper-slide post-listing">
                <span id="id_loop" style="display: none"><?php echo $category->term_id; ?></span>
                <h2 style="margin-top: 80px; margin-bottom: 10px;"><?php echo $category->name; ?></h2>
                <?php $args = array(
                    "posts_per_page" => 4,
                    "cat"            => $category->term_id
                );
                $query = new WP_query ( $args ); ?>
                <?php if($query->have_posts()) : ?>
                    <?php while($query->have_posts()) : $query->the_post(); ?>
                        <?php get_template_part( 'content'); ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <?php get_template_part('content','none' ); ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- end inner page -->
<?php get_footer(); ?>