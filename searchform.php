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
<form role="search" method="get" class="searh-holder" action="<?php echo home_url( '/' ); ?>">
	<label><span class="screen-reader-text"><?php echo _x( '', 'label','krobs') ?></span></label>
	
	<input type="text" class="search" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder','krobs' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( '', 'label','krobs' ) ?>"/>
	
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button','krobs' ) ?>">
		<i class="fa fa-search transition"></i>
	</button>

</form>