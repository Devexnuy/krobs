<?php
/**
 * @package Domik - Responsive Architecture WP Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 5-5-2015
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
global $theme_options;

if(!function_exists('theme_domik_hex2rgb')){
    function theme_domik_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if(!function_exists('theme_domik_colourBrightness')){
    /*
    * $hex = '#ae64fe';
    * $percent = 0.5; // 50% brighter
    * $percent = -0.5; // 50% darker
    */
    function theme_domik_colourBrightness($hex, $percent) {
        // Work out if hash given
        $hash = '';
        if (stristr($hex,'#')) {
            $hex = str_replace('#','',$hex);
            $hash = '#';
        }
        /// HEX TO RGB
        $rgb = theme_domik_hex2rgb($hex);
        //// CALCULATE 
        for ($i=0; $i<3; $i++) {
            // See if brighter or darker
            if ($percent > 0) {
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
            } else {
                // Darker
                $positivePercent = $percent - ($percent*2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
            }
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        //// RBG to Hex
        $hex = '';
        for($i=0; $i < 3; $i++) {
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            // Add a leading zero if necessary
            if(strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
            }
            // Append to the hex string
            $hex .= $hexDigit;
        }
        return $hash.$hex;
    }
}

function theme_domik_bg_png($color, $input, $output){
    $image = imagecreatefrompng ( $input );
    $rgbs = theme_domik_hex2rgb($color);
    $background = imagecolorallocate( $image, $rgbs[0], $rgbs[1], $rgbs[2] );

    imagepng( $image, $output);

}
if(!function_exists('theme_domik_stripWhitespace')){
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function theme_domik_stripWhitespace($content)
    {
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);

        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);

        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);

        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);

        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);

        return trim($content);
    }

}



function theme_domik_add_rgba_background_inline_style($color = '#ed5153', $handle = 'skin') {
    $inline_style = '.testimoni-wrapper,.pricing-wrapper,.da-thumbs li  article,.team-caption,.home-centered{background-color:rgba(' . implode(",", hex2rgb($color)) . ', 0.9);}';
    wp_add_inline_style($handle, $inline_style);
}

if(!function_exists('theme_domik_overridestyle')){
	function theme_domik_overridestyle(){
		global $theme_options;

		$inline_style = '
.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before {background-color:'.$theme_options['skin-color'].';}
body,.l-line {background-color:'.$theme_options['body-background-color'].';}
.wrapper-inner,.full-width-wrap:before,.scale-callback:before,.fullheight-carousel-holder , .fullheight-carousel,.fullheight-carousel-holder .customNavigation a,.carousel-link-holder h3 a:before , .carousel-link-holder h3 a:after,.services-info,.team-photo   span,.fixed-column,.show-info:before,.fixed-filter,.gallery-item .overlay,.hid-port-info .grid-item,footer:before,.to-top,.back-link {background-color:'.$theme_options['main-background-color'].';}
a {color:'.$theme_options['text-link-color'].';}
a:focus,a:hover {color:'.$theme_options['text-link-hover-color'].';}
header,nav li ul {background-color:'.$theme_options['header-background-color'].';}
nav li a,.arthref .icon-container ul li span {color:'.$theme_options['menu-text-color'].';}
nav li a:hover,.arthref .icon-container ul li a:hover span {color:'.$theme_options['menu-text-hover-color'].';}
.nav-button span {background-color:'.$theme_options['mobile-menu-trigger-color'].';}
@media only screen and  (max-width: 1036px) { .nav-holder {background-color:'.$theme_options['header-background-color'].';} }
';
        // Remove whitespace
        $inline_style = theme_domik_stripWhitespace($inline_style);

        return $inline_style;

	}
}
