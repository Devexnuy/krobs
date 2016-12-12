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

<?php while(have_posts()) : the_post(); ?>
<?php
$popuptype = get_post_meta(get_the_ID(), '_cmb_portfolio_popup', true);

if($popuptype == 'popup_ajax') : ?>
	<div class="item-data project-page">
	    <div class="content">
	        <div class="prject-ajax-box">
	            <?php the_content( ); ?>
	        </div>
	    </div>
	</div>
<?php 
elseif($popuptype === 'popup_modal') :?>
	<div id="custom-content" class="white-popup-block">
	    <div class="project-holder">
	        <span class="popup-modal-dismiss transition"><i class="fa fa-times"></i></span>
	        <?php the_content();?>
	    </div>
	</div>
<?php endif;?>
<?php endwhile;?>