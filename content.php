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
?>
<div <?php post_class('krobs-post');?>>
    <div class="post-media">
    <?php if($gallery = get_post_gallery( get_the_ID(), false )){
		if(isset($gallery['ids'])) : ?>
		<div class=" media-holder slide-holder no-margin">
            <!-- <div class="customNavigation">
                <a class="next-slide"><i class="fa fa-angle-right transition2"></i></a>
                <a class="prev-slide"><i class="fa fa-angle-left transition2"></i></a>
            </div> -->
            <div class="rep-single-slider owl-carousel">
            <?php
				$gallery_ids = $gallery['ids'];
				$img_ids = explode(",",$gallery_ids);
				$i=1;
				foreach( $img_ids AS $img_id ){
				$image_src = wp_get_attachment_image_src($img_id,'');
			?>
				<div class="item"><img src="<?php echo esc_url($image_src[0]); ?>" width="<?php echo esc_attr($image_src[1]); ?>" height="<?php echo esc_attr($image_src[2]); ?>" class="respimg res2" alt=""></div>
			<?php $i++; } ?>
            </div>
        </div>
		<?php endif; ?>
	<?php }elseif(get_post_meta(get_the_ID(), '_cmb_embed_video', true)!=""){ ?>
		<div class="video-container">
				<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cmb_embed_video', true) )); ?>
		</div>
    <!-- Thumbnail goes here -->
	<?php }elseif(has_post_thumbnail( )){ ?>
        <!-- Link to permalink for featured image -->
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'large' ); ?>
        </a>
        <!-- End . Link to permalink for featured image -->
	<?php } ?>
    <!-- End . Thumbnail goes here -->
    </div>
    <div class="post-title">
        <h4 class="author-post" style="display:none"><?php echo get_the_author(); ?> - </h4>
        <h3 class="the-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    </div>
    <div class="post-sharing">
        <div class="sharing-button">
            <a href="<?php the_ID(); ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more.png" alt="sharing button">
            </a>
        </div>
    </div>
</div>
