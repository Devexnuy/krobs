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

<div class="post krobs-post">
    <div class="post-title">
        <div class=" clearfix"></div>
        <h3><a href="javascript:void(0)"><?php _e('Nothing Found Here!','krobs'); ?></a></h3>
    </div>
    
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'krobs' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'krobs' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'krobs' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>


