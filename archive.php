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
    <div class="row-fluid">
    <?php if($theme_options['blog_layout']==='left_sidebar'):?>
		<div class="span4">
            <div class="sidebar">
                <?php get_sidebar( );?>
            </div>
        </div><!--end .span4 -->
	<?php endif;?>
	
	<?php if($theme_options['blog_layout']==='fullwidth'):?>
		<div class="span12">
	<?php else:?>
		<div class="span8">
	<?php endif;?>

    		<?php if(have_posts()) : 
				?>
				<?php while(have_posts()) : the_post(); ?>
					
					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
				
				<?php endwhile; ?>

				<?php krobs_pagination();?>
				
				<?php else: ?>
				<?php get_template_part('content','none' ); ?>
			<?php endif; ?> 
			
			
			

        </div><!--end .span12||span8 -->
    <?php if($theme_options['blog_layout']==='right_sidebar'):?>
        <div class="span4">
            <div class="sidebar">
                <?php get_sidebar( );?>
            </div>
        </div><!--end .span4 -->
    <?php endif; ?>
    </div><!--end .row-fluid -->

<!-- end inner page -->
<?php get_footer(); ?>