<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 *
 * @var $layout
 * @var $sec_id
 * @var $video_id
 * @var $slideshow_imgs
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $css = $el_id = '';
$output = $after_output = '';
//Custom options
$layout = $sec_id = $video_id = $slideshow_imgs = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


if($layout == 'home_slide_top'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'homeholder',
        'no-bg',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

    <section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
        <div class="content rep-home" <?php //echo esc_html($sec_id);?>>
            <?php echo wpb_js_remove_wpautop( $content ); ?>
        </div>
        <div class="clearfix"></div>
    </section>

<?php
}elseif($layout == 'home_slide_footer'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );

?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'home-footer',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<footer<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="row-fluid">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</footer>
<?php
}elseif($layout == 'about_features'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'gray-bg',
        'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="content">
        <div class="row-fluid">
            <?php echo wpb_js_remove_wpautop( $content ); ?>
        </div>
    </div>
</section>

<?php
}elseif($layout == 'about_services'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'rep-about',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
            <?php echo wpb_js_remove_wpautop( $content ); ?>
</section>

<?php
}elseif($layout == 'about_facts'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );

?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'rep-facts',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="content">
        <div  class="facts row-fluid">
            <?php echo wpb_js_remove_wpautop( $content ); ?>
        </div>
    </div>
</section>

<?php
}elseif($layout == 'about_twitter'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'bg',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> class="rep-twitteritem">
    <div class="overlay op8"></div>
    <div  <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>></div>
    <div class="content">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</section>

<?php
}elseif($layout == 'about_resume'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'rep-resume',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php echo wpb_js_remove_wpautop( $content ); ?>
</section>


<?php
}elseif($layout == 'about_testimonials'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'bg',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section class="rep-testimonials" <?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?>>
    <div class="overlay op8"></div>
    <div  <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>></div>
    <div class="content">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</section>


<?php
}elseif($layout == 'about_clients'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'rep-clients',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php echo wpb_js_remove_wpautop( $content ); ?>
</section>

<?php
}elseif($layout == 'contact_form'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'rep-contact',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php echo wpb_js_remove_wpautop( $content ); ?>
</section>

<?php
}elseif($layout == 'contact_social'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'bg bg-parallax',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> class="rep-contact-social">
    <div class="overlay"></div>
    <div  <?php echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>></div>
    <div class="content">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</section>

<?php
}elseif($layout == 'folio_subscribe'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'bg',
        'bg-parallax',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> class="rep-subscribe">
    <div class="overlay"></div>
    <div  <?php echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>></div>
    <div class="content">
        <div class="subscribe-holder">
            <h3><?php _e('Subscribe','krobs');?></h3>
            <div class="row-fluid">
                <?php echo wpb_js_remove_wpautop( $content ); ?>
            </div>
        </div>
    </div>
</section>

<?php
}elseif($layout == 'folio_order'){
    // $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' sec-style ' .  get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    // $css_class_new = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class , $this->settings['base'], $atts );


?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'rep-order gray-bg',
        // 'subab',
        //$el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>
<section<?php echo isset($sec_id) && !empty($sec_id) ? " id='".esc_attr($sec_id)."' " : (isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : "" );?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="content">
        <?php echo wpb_js_remove_wpautop( $content ); ?>
    </div>
</section>


<?php }else { 

	$el_class = $this->getExtraClass( $el_class );
    $css_classes = array(
        'vc_row',
        'wpb_row', //deprecated
        'vc_inner',
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );

    if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
        $css_classes[]='vc_row-has-fill';
    }

    if (!empty($atts['gap'])) {
        $css_classes[] = 'vc_column-gap-'.$atts['gap'];
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

    $wrapper_attributes = array();
    // build attributes for wrapper
    if ( ! empty( $el_id ) ) {
        $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
    }

    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
    $wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

    $output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div>';
    $output .= $after_output;

    echo $output;

}