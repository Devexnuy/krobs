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
if(get_post_meta(get_the_ID(), '_cmb_single_layout', true)){
	$sideBar = get_post_meta(get_the_ID(), '_cmb_single_layout', true);
}else{
	$sideBar = $theme_options['blog_layout'];
}
get_header(); ?>

	<div class="row-fluid">
    <?php if($sideBar === 'left_sidebar'):?>
		<div class="span4">
            <div class="sidebar">
                <?php get_sidebar( );?>
            </div>
        </div><!--end .span4 -->
	<?php endif;?>

	<?php if($sideBar ==='fullwidth'):?>
		<div class="span12">
	<?php else:?>
        <div class="span12">
<!--		<div class="span8">-->
	<?php endif;?>
        <div class="swiper-container" id="SW_single">
            <div class="swiper-wrapper">
                <div class="swiper-slide center-slide">
    				<?php if(have_posts()) : ?>
						<?php while(have_posts()) : the_post(); ?>
							<?php get_template_part( 'content', 'single'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
                </div>
            </div>
        </div>
		</div><!--end .span12||span8 -->
    </div><!--end .row-fluid -->

<?php get_footer(); ?>
