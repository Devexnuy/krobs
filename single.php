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
							<span class="single-id dowloaded"><?php the_ID(); ?></span>
							<div <?php post_class('krobs-post');?>>
							    <div class="post-media">
									<div class="shortcuts-icons">
										<div class="home">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home.png" alt="home button">
											</a>
										</div>
									</div>
							    <?php if($gallery = get_post_gallery( get_the_ID(), false )){
									if(isset($gallery['ids'])) : ?>
										<div class=" media-holder slide-holder no-margin">
								            <div class="customNavigation">
								                <a class="next-slide"><i class="fa fa-angle-right transition2"></i></a>
								                <a class="prev-slide"><i class="fa fa-angle-left transition2"></i></a>
								            </div>
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
								<?php }elseif(has_post_thumbnail( )){ ?>
									<a href="<?php the_permalink();?>" class="fadelink">
										<img src="<?php echo esc_url(krobs_thumbnail_url('full') );?>" class="respimg res2 transition" alt="<?php the_title( ); ?>"/>
							        </a>
								<?php } ?>

							    </div>
							    <div class="post-title">
							    <?php if($theme_options['author_checkbox']==='1' || $theme_options['date_checkbox']==='1' || $theme_options['comment_checkbox']==='1' || $theme_options['tag_checkbox']==='1'):?>
									<div class="post-meta">
							            <ul>
							            	<?php if($theme_options['date_checkbox']==='1') :?>
											<li> <a href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"><?php the_time('d M');?></a></li>
											<?php endif;?>
											<?php if($theme_options['author_checkbox']==='1' || $theme_options['cats_checkbox']==='1' || $theme_options['tag_checkbox']==='1') :?>
											<li>
												<h6>
												<?php if($theme_options['author_checkbox']==='1') :?>
												<?php _e('Posted by ','krobs');?><?php the_author_posts_link( );?> /
												<?php endif;?>

												<?php if($theme_options['cats_checkbox']==='1') :?>
													<?php echo get_the_category_list(', ');?> /
												<?php endif;?>
												<?php if($theme_options['tag_checkbox']==='1') :?>
													<?php the_tags('');?>
												<?php endif;?>
												</h6>
											</li>
											<?php endif;?>
										</ul>
									</div>
								<?php endif;?>
							        <div class=" clearfix"></div>
									<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
										<?php dynamic_sidebar( 'sidebar-2' ); ?>
									<?php else: ?>
										<p>Active su widget.</p>
									<?php endif; ?>
							        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a> <?php edit_post_link( __( 'Edit', 'krobs' ), '<span class="edit-link">', '</span>' ); ?>	</h3>
							    </div>
							    <div class="post-body">

									<?php the_content();?>

									<?php
									wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'krobs' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>


							    </div>
							    <div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					<?php else: ?>
						<p>Active su widget.</p>
					<?php endif; ?>
                </div>
            </div>
        </div>
		</div><!--end .span12||span8 -->
    </div><!--end .row-fluid -->

<?php get_footer(); ?>
