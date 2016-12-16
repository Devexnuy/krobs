<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

 global $theme_options ;

 ?>
	            </div><!-- end .content -->
	        </div><!-- end .single-page -->
	        <!--section contact social-->
	    </div><!-- end .wrapper -->
	</div><!-- End #main -->
    <footer class="main-footer">
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        <?php else: ?>
            <p>Active su widget: Publicidad No. 1.</p>
        <?php endif; ?>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
