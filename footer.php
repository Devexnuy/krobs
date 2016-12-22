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
        <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-5' ); ?>
        <?php else: ?>
            <p>Active su widget: Publicidad No. 5.</p>
        <?php endif; ?>
    </footer>
    <div class="social-lopez" style="display: none;">
        <div class="shared-counts">
            <div class="number">
                <span>5</span> Compartidos
            </div>
            <div class="close">
                <a class="close" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="summary-post">
            <div class="featured-image">
                <img src="http://placehold.it/150x150" alt="featured image" width="150" height="150">
            </div>
            <div class="title">
                <span class="category">Category name</span>
                <h3>El titulo del articulo o noticia</h3>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="social-button">
            <div class="facebook">
                <div class="left">
                    <div class="logo">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </div>
                    <div class="number-facebook">0</div>
                </div>
                <div class="right">
                    <a target="_blank" class="button btn-lopez" href="#">COMPARTIR</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="google">
                <div class="left">
                    <div class="logo">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </div>
                    <div class="number-google">0</div>
                </div>
                <div class="right">
                    <a target="_blank" href="#" class="button btn-lopez">COMPARTIR</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="twitter">
                <div class="left">
                    <div class="logo">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </div>
                    <!-- As of 20th November 2015 there's no Tweet count API, so don't bother: -->
                    <!-- <div class="number-twitter">0</div> -->
                </div>
                <div class="right">
                    <a target="_blank" href="#" class="button btn-lopez">COMPARTIR</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="whatsapp">
                <div class="left">
                    <div class="logo">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    </div>
                    <!-- not aupport -->
                    <!-- <div class="number-whatsapp">0</div> -->
                </div>
                <div class="right">
                    <a  target="_blank" href="#" class="button btn-lopez" data-action="share/whatsapp/share">COMPARTIR</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
