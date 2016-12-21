<span class="single-id dowloaded"><?php the_ID(); ?></span>
<div <?php post_class('krobs-post');?>>
    <div class="post-media">
        <div class="shortcuts-icons">
            <div class="home">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home.png" alt="home button">
                </a>
            </div>
            <div class="share">
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/share.png" alt="home button">
                </a>
            </div>
        </div>
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
        <?php }elseif(has_post_thumbnail( )){ ?>
            <a href="<?php the_permalink();?>" class="fadelink">
                <img src="<?php echo esc_url(krobs_thumbnail_url('full') );?>" class="respimg res2 transition" alt="<?php the_title( ); ?>"/>
            </a>
        <?php } ?>
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        <?php else: ?>
            <p>Active su widget: Publicidad No. 1.</p>
        <?php endif; ?>
    </div>
    <div class="post-title">
        <div class="post-meta">
            <ul>
                <li>
                    <?php $categories = get_the_category(); ?>
                    <?php $separator = ' '; $output = ''; ?>
                    <?php if ( ! empty( $categories ) ) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <?php $output .= "<span>$category->name</span>" ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php echo trim( $output, $separator ); ?>
                </li>
            </ul>
        </div>
        <div class=" clearfix"></div>
        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a> <?php edit_post_link( __( 'Edit', 'krobs' ), '<span class="edit-link">', '</span>' ); ?></h3>
        <p class="date-author">
            Por <?php the_author(); ?> - <?php $my_date = the_date('', '', '', FALSE); echo $my_date; ?>
        </p>
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
        <p class="tags">
            <?php
            $posttags = get_the_tags();
            if ($posttags) {
              foreach($posttags as $tag) {
                echo "<span>$tag->name</span> "; 
              }
            }
            ?>
        </p>
    <div class="share-options">
        <h6><?php _e('Share : ','krobs');?></h6>
        <ul>
            <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title( );?>&amp;url=<?php the_permalink();?>" class="transition"><i class="fa fa-twitter"></i></a></li>
            <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" class="transition"><i class="fa fa-facebook"></i></a></li>
            <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr($theme_options['logo']['url'] );?>" class="transition"><i class="fa fa-pinterest"></i></a></li>
            <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>" class="transition"><i class="fa fa-google-plus"></i></a></li>
        </ul>
    </div>
</div>
<div class="clearfix"></div>
<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-3' ); ?>
<?php else: ?>
    <p>Active su widget: Publicidad No. 3.</p>
<?php endif; ?>
<!-- Start - Related posts -->
<div class="related-posts">
    <?php $post_categories = wp_get_post_categories( get_the_ID() ); ?>
    <?php foreach ($post_categories as $c): ?>
        <?php $cat = get_category( $c ); ?>
        <?php $query = new WP_Query( array( 'cat' => $cat->term_id, 'posts_per_page' => '5' ) ); ?>
        <?php if ($query->have_posts()): ?>
            <div class="line-blue"></div>
            <h4 class="title"><?php echo $cat->name; ?></h4>
            <div class="carousel-wrapper">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="carousel-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php echo get_permalink() ?>" title="<?php echo esc_attr( the_title() ) ?>">
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                            </a>
                        <?php endif; ?>
                        <h4><?php the_title(); ?></h4>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<div class="clearfix"></div>