<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 *
 * @var $layout
 * @var $sec_id
 * @var $video_id
 * @var $slideshow_imgs
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
//Custom options
$layout = $sec_id = $video_id = $slideshow_imgs = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($layout == 'home_slide'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );
?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'swiper-slide',
        'slide-bg',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="overlay"></div>
    <div class="slide_container">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</div>

<?php
}elseif($layout == 'home_slide_slideshow'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );
?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'swiper-slide',
        'slide-bg',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php 
    $bgs = explode(",", $slideshow_imgs);
    if(!empty($bgs)) :
    ?>
        <!-- Slider  -->                    
        <div class="rep-slides">                       
            <ul class="slides-container">
            <?php 
                foreach($bgs as $bg) { 
                    ?>
                        <li>
                            <div style="background-image: url('<?php echo wp_get_attachment_url( $bg);?>');" class="slides-fullscreen-img"></div>
                        </li>
            <?php    }   ?>                                                                           
            </ul>                                       
        </div><!-- Slider end -->

<?php endif;?>

    <div class="overlay"></div>
    <div class="container">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</div>

<?php
}elseif($layout == 'home_slide_anim_slideshow'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );

?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'swiper-slide',
        'slide-bg',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<div<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php 
    $bgs = explode(",", $slideshow_imgs);
    if(!empty($bgs)) :
    ?>
        <!-- Slider  -->                    
        <div class="rep-slides transition-slider">                      
            <ul class="slides-container">
            <?php 
                foreach($bgs as $bg) { 
                    ?>
                        <li>
                            <div style="background-image: url('<?php echo wp_get_attachment_url( $bg);?>');" class="slides-fullscreen-img anim-slides"></div>
                        </li>
            <?php    }   ?>                                                                           
            </ul>                                       
        </div><!-- Slider end -->

    <?php endif;?>
    <div class="overlay"></div>
    <div class="container">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</div>

<?php
}elseif($layout == 'home_slide_video'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );

?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'swiper-slide',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div id="video-container">
        <div class="mobile-bg<?php echo esc_attr($style_class);?>"></div>       
        <div id="P3" class="krobs-bg-player video-container" data-property="{videoURL:'<?php echo esc_attr($video_id );?>',containment:'#video-container',autoPlay:true, mute:false, startAt:0, opacity:1,addRaster:true}"></div>                   
    </div>  
    <!-- <div class="overlay"></div> -->
    <!-- <div class="container"> -->
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    <!-- </div> -->
</div>

<?php
}elseif($layout == 'slide'||$layout == 'about_slide' || $layout == 'folio_slide' || $layout == 'contact_slide'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );

?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'swiper-slide',
        'slide-bg',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<div<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="slide_container">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</div>





<?php
}else{
    
    wp_enqueue_script( 'wpb_composer_front_js' );

    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'vc_row',
        'wpb_row', //deprecated
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );

    if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
        $css_classes[]='vc_row-has-fill';
    }

    if (!empty($atts['gap'])) {
        $css_classes[] = 'vc_column-gap-'.$atts['gap'];
    }

    $wrapper_attributes = array();
    // build attributes for wrapper
    if ( ! empty( $el_id ) ) {
        $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
    }
    if ( ! empty( $full_width ) ) {
        $wrapper_attributes[] = 'data-vc-full-width="true"';
        $wrapper_attributes[] = 'data-vc-full-width-init="false"';
        if ( 'stretch_row_content' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
        } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
            $css_classes[] = 'vc_row-no-padding';
        }
        $after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
    }

    if ( ! empty( $full_height ) ) {
        $css_classes[] = 'vc_row-o-full-height';
        if ( ! empty( $columns_placement ) ) {
            $flex_row = true;
            $css_classes[] = 'vc_row-o-columns-' . $columns_placement;
            if ( 'stretch' === $columns_placement ) {
                $css_classes[] = 'vc_row-o-equal-height';
            }
        }
    }

    if ( ! empty( $equal_height ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-equal-height';
    }

    if ( ! empty( $content_placement ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-content-' . $content_placement;
    }

    if ( ! empty( $flex_row ) ) {
        $css_classes[] = 'vc_row-flex';
    }

    $has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

    $parallax_speed = $parallax_speed_bg;
    if ( $has_video_bg ) {
        $parallax = $video_bg_parallax;
        $parallax_speed = $parallax_speed_video;
        $parallax_image = $video_bg_url;
        $css_classes[] = 'vc_video-bg-container';
        wp_enqueue_script( 'vc_youtube_iframe_api_js' );
    }

    if ( ! empty( $parallax ) ) {
        wp_enqueue_script( 'vc_jquery_skrollr_js' );
        $wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
        $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
        if ( false !== strpos( $parallax, 'fade' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fade';
            $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
        } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fixed';
        }
    }

    if ( ! empty( $parallax_image ) ) {
        if ( $has_video_bg ) {
            $parallax_image_src = $parallax_image;
        } else {
            $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
            $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
            if ( ! empty( $parallax_image_src[0] ) ) {
                $parallax_image_src = $parallax_image_src[0];
            }
        }
        $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
    }
    if ( ! $parallax && $has_video_bg ) {
        $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
    $wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

    $output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div>';
    $output .= $after_output;

    echo $output;

}