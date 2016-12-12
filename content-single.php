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
        <?php //krobs_post_nav();?>
    </div>
</div>