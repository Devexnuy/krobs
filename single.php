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
                <!------------------------------------------------
                *************** Next post if exist ***************
                ------------------------------------------------->
                <?php $next_post = get_next_post(true);
				$categories = get_the_category($next_post->ID);
                if (!empty( $next_post )): ?>
                    <?php $args['cat'] = $categories[0]->term_id;
					$args['posts_per_page'] = 20;
                    $loop = new WP_Query( $args );
                    // $array_rev = array_reverse($loop->posts);
                    // //reassign the reversed posts array to the $home_shows object
                    // $loop->posts = $array_rev;
					$switch = false;
                    if($loop->have_posts()) : while( $loop->have_posts() ): $loop->the_post();?>
						<?php if ($switch == false): ?>
							<div class="swiper-slide">
	                            <div <?php post_class('krobs-post');?>>
	                                <div class="post-media">
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

	                                                <?php if($theme_options['comment_checkbox']==='1') :?>
	                                                    <li><?php comments_popup_link(__('0 Comment', 'krobs'), __('1 Comment', 'krobs'), __('% Comments', 'krobs')); ?></li>

	                                                <?php endif;?>

	                                                <!-- <li><i class="fa fa-heart-o"></i> 151</li> -->
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
	                                <?php if($theme_options['share_facebook'] === '1'||$theme_options['share_twitter'] === '1'||$theme_options['share_pinterest'] === '1'||$theme_options['share_googleplus'] === '1') :?>
	                                    <div class="share-options">
	                                        <h6><?php _e('Share : ','krobs');?></h6>
	                                        <ul>
	                                            <?php if($theme_options['share_twitter'] === '1') :?>
	                                                <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title( );?>&amp;url=<?php the_permalink();?>" class="transition"><i class="fa fa-twitter"></i></a></li>
	                                            <?php endif;?>
	                                            <?php if($theme_options['share_facebook'] === '1') :?>
	                                                <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" class="transition"><i class="fa fa-facebook"></i></a></li>
	                                            <?php endif;?>
	                                            <?php if($theme_options['share_pinterest'] === '1') :?>
	                                                <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr($theme_options['logo']['url'] );?>" class="transition"><i class="fa fa-pinterest"></i></a></li>
	                                            <?php endif;?>
	                                            <?php if($theme_options['share_googleplus'] === '1') :?>
	                                                <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>" class="transition"><i class="fa fa-google-plus"></i></a></li>
	                                            <?php endif;?>
	                                        </ul>
	                                    </div>
	                                <?php endif;?>
	                            </div>
	                        </div>
						<?php endif; ?>
						<?php if (get_the_ID() == $next_post->ID): ?>
							<?php $switch = true; ?>
						<?php endif; ?>
                    <? endwhile; endif; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                <!------------------------------------------------------
                *************** End - Next post if exist ***************
                ------------------------------------------------------->
                <div class="swiper-slide center-slide">
    		<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>

					<div <?php post_class('krobs-post');?>>
					    <div class="post-media">
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

									<?php if($theme_options['comment_checkbox']==='1') :?>
									<li><?php comments_popup_link(__('0 Comment', 'krobs'), __('1 Comment', 'krobs'), __('% Comments', 'krobs')); ?></li>

									<?php endif;?>

									<!-- <li><i class="fa fa-heart-o"></i> 151</li> -->
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
					<?php if($theme_options['share_facebook'] === '1'||$theme_options['share_twitter'] === '1'||$theme_options['share_pinterest'] === '1'||$theme_options['share_googleplus'] === '1') :?>
					    <div class="share-options">
                            <h6><?php _e('Share : ','krobs');?></h6>
                            <ul>
                            <?php if($theme_options['share_twitter'] === '1') :?>
                                <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title( );?>&amp;url=<?php the_permalink();?>" class="transition"><i class="fa fa-twitter"></i></a></li>
                            <?php endif;?>
                            <?php if($theme_options['share_facebook'] === '1') :?>
                                <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" class="transition"><i class="fa fa-facebook"></i></a></li>
							<?php endif;?>
                            <?php if($theme_options['share_pinterest'] === '1') :?>
                                <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr($theme_options['logo']['url'] );?>" class="transition"><i class="fa fa-pinterest"></i></a></li>
							<?php endif;?>
                            <?php if($theme_options['share_googleplus'] === '1') :?>
                                <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>" class="transition"><i class="fa fa-google-plus"></i></a></li>
                            <?php endif;?>
                            </ul>
                        </div>
					<?php endif;?>
						<?php //krobs_post_nav();?>
					</div>
					<div class="clearfix"></div>



					<?php
					if ( comments_open() || get_comments_number() ) :

					 	comments_template();

					endif; ?>




				<?php endwhile; ?>
			<?php endif; ?>
                </div>
                <!----------------------------------------------------
                *************** Previous post if exist ***************
                ----------------------------------------------------->
                <?php $previous_post = get_previous_post(true);
                if (!empty($previous_post)): ?>
                    <?php $args['p'] = $previous_post->ID;
                    $loop_three = new WP_Query( $args );
                    if($loop_three->have_posts()) : while($loop_three->have_posts() ): $loop_three->the_post();?>
                        <div class="swiper-slide">
                            <div <?php post_class('krobs-post');?>>
                                <div class="post-media">
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

                                                <?php if($theme_options['comment_checkbox']==='1') :?>
                                                    <li><?php comments_popup_link(__('0 Comment', 'krobs'), __('1 Comment', 'krobs'), __('% Comments', 'krobs')); ?></li>

                                                <?php endif;?>

                                                <!-- <li><i class="fa fa-heart-o"></i> 151</li> -->
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
                                <?php if($theme_options['share_facebook'] === '1'||$theme_options['share_twitter'] === '1'||$theme_options['share_pinterest'] === '1'||$theme_options['share_googleplus'] === '1') :?>
                                    <div class="share-options">
                                        <h6><?php _e('Share : ','krobs');?></h6>
                                        <ul>
                                            <?php if($theme_options['share_twitter'] === '1') :?>
                                                <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title( );?>&amp;url=<?php the_permalink();?>" class="transition"><i class="fa fa-twitter"></i></a></li>
                                            <?php endif;?>
                                            <?php if($theme_options['share_facebook'] === '1') :?>
                                                <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" class="transition"><i class="fa fa-facebook"></i></a></li>
                                            <?php endif;?>
                                            <?php if($theme_options['share_pinterest'] === '1') :?>
                                                <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr($theme_options['logo']['url'] );?>" class="transition"><i class="fa fa-pinterest"></i></a></li>
                                            <?php endif;?>
                                            <?php if($theme_options['share_googleplus'] === '1') :?>
                                                <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>" class="transition"><i class="fa fa-google-plus"></i></a></li>
                                            <?php endif;?>
                                        </ul>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php $previous_post_one = get_previous_post(true);
                        if (!empty($previous_post_one)): ?>
                            <?php $args['p'] = $previous_post_one->ID;
                            $loop_four = new WP_Query( $args );
                            if($loop_four->have_posts()) : while($loop_four->have_posts() ): $loop_four->the_post();?>
                                <div class="swiper-slide">
                                    <div <?php post_class('krobs-post');?>>
                                        <div class="post-media">
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

                                                        <?php if($theme_options['comment_checkbox']==='1') :?>
                                                            <li><?php comments_popup_link(__('0 Comment', 'krobs'), __('1 Comment', 'krobs'), __('% Comments', 'krobs')); ?></li>

                                                        <?php endif;?>

                                                        <!-- <li><i class="fa fa-heart-o"></i> 151</li> -->
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
                                        <?php if($theme_options['share_facebook'] === '1'||$theme_options['share_twitter'] === '1'||$theme_options['share_pinterest'] === '1'||$theme_options['share_googleplus'] === '1') :?>
                                            <div class="share-options">
                                                <h6><?php _e('Share : ','krobs');?></h6>
                                                <ul>
                                                    <?php if($theme_options['share_twitter'] === '1') :?>
                                                        <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title( );?>&amp;url=<?php the_permalink();?>" class="transition"><i class="fa fa-twitter"></i></a></li>
                                                    <?php endif;?>
                                                    <?php if($theme_options['share_facebook'] === '1') :?>
                                                        <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" class="transition"><i class="fa fa-facebook"></i></a></li>
                                                    <?php endif;?>
                                                    <?php if($theme_options['share_pinterest'] === '1') :?>
                                                        <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr($theme_options['logo']['url'] );?>" class="transition"><i class="fa fa-pinterest"></i></a></li>
                                                    <?php endif;?>
                                                    <?php if($theme_options['share_googleplus'] === '1') :?>
                                                        <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>" class="transition"><i class="fa fa-google-plus"></i></a></li>
                                                    <?php endif;?>
                                                </ul>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <?php $previous_post_two = get_previous_post(true);
                                if (!empty($previous_post_two)): ?>
                                    <?php $args['p'] = $previous_post_two->ID;
                                    $loop_five = new WP_Query( $args );
                                    if($loop_five->have_posts()) : while($loop_five->have_posts() ): $loop_five->the_post();?>
                                        <div class="swiper-slide">
                                            <div <?php post_class('krobs-post');?>>
                                                <div class="post-media">
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

                                                                <?php if($theme_options['comment_checkbox']==='1') :?>
                                                                    <li><?php comments_popup_link(__('0 Comment', 'krobs'), __('1 Comment', 'krobs'), __('% Comments', 'krobs')); ?></li>

                                                                <?php endif;?>

                                                                <!-- <li><i class="fa fa-heart-o"></i> 151</li> -->
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
                                                <?php if($theme_options['share_facebook'] === '1'||$theme_options['share_twitter'] === '1'||$theme_options['share_pinterest'] === '1'||$theme_options['share_googleplus'] === '1') :?>
                                                    <div class="share-options">
                                                        <h6><?php _e('Share : ','krobs');?></h6>
                                                        <ul>
                                                            <?php if($theme_options['share_twitter'] === '1') :?>
                                                                <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title( );?>&amp;url=<?php the_permalink();?>" class="transition"><i class="fa fa-twitter"></i></a></li>
                                                            <?php endif;?>
                                                            <?php if($theme_options['share_facebook'] === '1') :?>
                                                                <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" class="transition"><i class="fa fa-facebook"></i></a></li>
                                                            <?php endif;?>
                                                            <?php if($theme_options['share_pinterest'] === '1') :?>
                                                                <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr($theme_options['logo']['url'] );?>" class="transition"><i class="fa fa-pinterest"></i></a></li>
                                                            <?php endif;?>
                                                            <?php if($theme_options['share_googleplus'] === '1') :?>
                                                                <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>" class="transition"><i class="fa fa-google-plus"></i></a></li>
                                                            <?php endif;?>
                                                        </ul>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    <? endwhile; endif; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif ?>
                            <? endwhile; endif; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif ?>
                    <? endwhile; endif; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif ?>
                <!----------------------------------------------------------
                *************** End - Previous post if exist ***************
                ----------------------------------------------------------->
            </div>
        </div>
        </div><!--end .span12||span8 -->
    <?php if($sideBar === 'right_sidebar'):?>
        <div class="span4">
            <div class="sidebar">
                <?php get_sidebar( );?>
            </div>
        </div><!--end .span4 -->
    <?php endif; ?>
    </div><!--end .row-fluid -->

<?php get_footer(); ?>
