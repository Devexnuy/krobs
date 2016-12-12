 <?php

/**
 * Template Name: Home Normal Page
 *
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

global $wp_query;

get_header('home'); ?>

<div class="normal-container">

		<?php while(have_posts()) : the_post(); ?>

			<?php the_content(); ?>
			<?php wp_link_pages(); ?>

		<?php endwhile; ?>

</div>

<?php get_footer('home'); ?>