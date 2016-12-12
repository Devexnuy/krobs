<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Twitter Feeds", 'krobs'),
   "base"      => "twitter_feed",
   "class"     => "",
    "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'Krobs',
   "params"    => array(
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Title", 'krobs'),
          "param_name"=> "title",
          "value"     => "My Twitts",
          "description" => __("Title", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Twitter name", 'krobs'),
          "param_name"=> "twittername",
          "value"     => "cththemes",
          "description" => __("Twitter name", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Consumer Key", 'krobs'),
          "param_name"=> "consumer_key",
          "value"     => "b1gNFU5p55j7GR0vACWyZf0j8",
          "description" => __("Consumer Key", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Consumer Secret", 'krobs'),
          "param_name"=> "consumer_key_secret",
          "value"     => "V0a7UkD0XTuP4zdoJoBPlpbQC9TtGk8ucotXRZZZP4MYv7TkK2",
          "description" => __("Consumer Secret", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Access Token", 'krobs'),
          "param_name"=> "access_token",
          "value"     => "2549127786-T8zZA3d7cJcgDkI2kwbfQ2XeU8exphGZu3hZVvK",
          "description" => __("Access Token", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Access Token Secret", 'krobs'),
          "param_name"=> "access_token_secret",
          "value"     => "pQXlpkL9CSCIsEnGF5xgsjKObDRWcD77thGkFG9RLzgjs",
          "description" => __("Access Token Secret", 'krobs')
        ),

        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Count", 'krobs'),
          "param_name"=> "count",
          "value"     => "4",
          "description" => __("Number of tweets.", 'krobs')
        ),

    )));
}

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Resume", 'krobs'),
   "base"      => "resume",
   "class"     => "",
    "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'Krobs',
   "params"    => array(
        array(
          "type"      => "attach_image",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Description Image", 'krobs'),
          "param_name"=> "res_img",
          "description" => __("Description Image", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Title", 'krobs'),
          "param_name"=> "res_title",
          "value"     => "",
          "description" => __("Title", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Work Date", 'krobs'),
          "param_name"=> "res_date",
          "value"     => "2012-2014",
          "description" => __("Work Date", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Job Position", 'krobs'),
          "param_name"=> "res_position",
          "value"     => "Project Manager",
          "description" => __("Job Position", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Job Description", 'krobs'),
          "param_name"=> "res_desc",
          "value"     => "Customer Support / Integration",
          "description" => __("Job Detail", 'krobs')
        ),

        array(
          "type"      => "textarea_html",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Resume Details", 'krobs'),
          "param_name"=> "content",
          "value"     => "",
          "description" => __("Resume Details", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Extraclass", 'krobs'),
          "param_name"=> "extraclass",
          "value"     => "",
          "description" => __("Extraclass", 'krobs')
        ),

    )));
}

if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Page Title", 'krobs'),
   "base"      => "page_title",
   "class"     => "",
    "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'Krobs',
   "params"    => array(
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Title", 'krobs'),
          "param_name"=> "title",
          "description" => __("Title", 'krobs')
        ),

        array(
          "type"      => "textarea_html",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Description", 'krobs'),
          "param_name"=> "content",
          "value"     => "",
          "description" => __("Description", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Extraclass", 'krobs'),
          "param_name"=> "extraclass",
          "value"     => "",
          "description" => __("Extraclass", 'krobs')
        ),

    )));
}
 
 //video background
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Background Video", 'krobs'),
   "description" => __("Choose video background",'krobs'),
   "base"      => "video_bg",
   "class"     => "",
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'krobs',
   "params"    => array(
      array(
          "type" => "textfield",
          "heading" => __("Extra class name", "krobs"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
        ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", 'krobs'),
         "param_name"=> "video_title",
         "value"     => "My Video",
         "description" => __("Input title of video.", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Video ID", 'krobs'),
         "param_name"=> "video_id",
         "value"     => "e8DFN3m8XGQ",
         "description" => __("Input ID of video you want use background.</br>Example: http://www.youtube.com/watch?v=<b>e8DFN3m8XGQ</b>", 'krobs')
      ),
      // array(
      //    "type"      => "dropdown",
      //    "holder"    => "div",
      //    "class"     => "",
      //    "heading"   => __("Show Control", 'krobs'),
      //    "param_name"=> "show_control",
      //    "value"       => array(
      //       'Yes'   => 'true',
      //       'No'   => 'false',
      //     ),
      //    "description" => __("Choose for enable", 'krobs')
      // ),
      // array(
      //    "type"      => "dropdown",
      //    "class"     => "",
      //    "heading"   => __("Auto play", 'krobs'),
      //    "param_name"=> "auto_play",
      //    "value"       => array(
      //       'Yes'   => 'true',
      //       'No'   => 'false',
      //     ),
      //    "description" => __("Choose for enable", 'krobs')
      // ),
      array(
         "type"      => "dropdown",
         "class"     => "",
         "heading"   => __("Loop", 'krobs'),
         "param_name"=> "loop",
         "value"       => array(
            'Yes'   => 'true',
            'No'   => 'false',
          ),
         "description" => __("Choose for enable", 'krobs')
      ),
      array(
         "type"      => "dropdown",
         "class"     => "",
         "heading"   => __("Mute", 'krobs'),
         "param_name"=> "mute",
         "value"       => array(
            'Yes'   => 'true',
            'No'   => 'false',
          ),
         "description" => __("Choose for enable", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Opacity", 'krobs'),
         "param_name"=> "opacity",
         "value"     => "1",
         "description" => __("Choose number from 0 to 1", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Containment", 'krobs'),
         "param_name"=> "containment",
         "value"     => ".video-wrapper",
         "description" => __("The CSS selector of the DOM element where you want the video background; if not specified it takes the “body”; if set to “self” the player will be instanced on that element.", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Quanlity", 'krobs'),
         "param_name"=> "quanlity",
         "value"     => "default",
         "description" => __("‘default’ or “small”, “medium”, “large”, “hd720”, “hd1080”, “highres”.", 'krobs')
      ),
    )));
}
 // home_ticker_item
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Home Ticker", 'krobs'),
   "description" => __("Builder home ticker",'krobs'),
   "base"      => "home_ticker",
   "class"     => "",
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'krobs',
   "params"    => array(
      array(
          "type" => "textfield",
          "heading" => __("Extra class name", "krobs"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
        ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", 'krobs'),
         "param_name"=> "title",
         "value"     => "We are building software to help ",
         "description" => __("Input title for homepage", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Sub Title", 'krobs'),
         "param_name"=> "subtitle",
         "value"     => "people manage our business",
         "description" => __("Input sub title for homepage", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Link Video for button 1", 'krobs'),
         "param_name"=> "link_video",
         "value"     => "https://www.youtube.com/watch?v=RoAPTdvgAJg",
         "description" => __("Add video description for your website", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Text for button 1", 'krobs'),
         "param_name"=> "text_btn1",
         "value"     => "Take a video tour",
         "description" => __("Text display button 1", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Text for button 2", 'krobs'),
         "param_name"=> "text_btn2",
         "value"     => "Register for free",
         "description" => __("Text display button 2", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Link for button 2", 'krobs'),
         "param_name"=> "link_btn2",
         "value"     => "#",
         "description" => __("", 'krobs')
      ),
      array(
          "type"      => "attach_images",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Select image", 'krobs'),
          "param_name"=> "images1",
          "description" => __("Home slider images 1", 'krobs')
        ),
    )));
}
//home_slider
if(function_exists('vc_map')){
  //Register "container" content element. It will hold all your inner (child) content elements
  vc_map( array(
      "name" => __("Home Slider", "wpb"),
      "base" => "home_slider",
      "category"  => 'krobs',
      "as_parent" => array('only' => 'home_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      "show_settings_on_create" => false,
      "class"=>'cth_home_slider',
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png", // Simply pass url to your icon here
      //'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/custom.css' ),
      "params" => array(
          // add params same as with any other content element
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
          array(
              "type" => "textfield",
              "heading" => __("id", "krobs"),
              "param_name" => "el_id",
              "description" => __("Slider id", "wpb")
          ),
          array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Slider holder image", 'krobs'),
          "param_name"=> "attachid",
          "description" => __("Home slider holder image", 'krobs')
        ),
      ),
      "js_view" => 'VcColumnView'
  ) );
  vc_map( array(
      "name" => __("Slide Item", "wpb"),
      "base" => "home_slider_item",
      "content_element" => true,
      "as_child" => array('only' => 'home_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      "params" => array(
        //  add params same as with any other content element
        array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
          array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Slide Link", 'krobs'),
         "param_name"=> "link_slider",
         "value"     => "#",
         "description" => __("", 'krobs')
      ),
      array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Slide Image", 'krobs'),
          "param_name"=> "images_slider",
          "description" => __("Slide Image", 'krobs')
        ),
          
      )
  ) );

  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_Home_Slider extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_Home_Slider_Item extends WPBakeryShortCode {
      }
  }
}


// featurebox_item
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Feature Box", 'krobs'),
   "description" => __("Feature Box with icon",'krobs'),
   "base"      => "featurebox",
   "class"     => "",
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'krobs',
   "params"    => array(
      array(
          "type" => "textfield",
          "heading" => __("Extra class name", "krobs"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
        ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Icon", 'krobs'),
         "param_name"=> "icon",
         "value"     => "flash",
         "description" => __("Search icon : <a href='http://themes-pixeden.com/font-demos/7-stroke/' target='_blank'>PE 7 STROKE</a>", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", 'krobs'),
         "param_name"=> "title",
         "value"     => "features 1",
         "description" => __("Title display in featurebox.", 'krobs')
      ),
      array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Content", 'krobs'),
         "param_name"=> "content",
         "value"     => "Praesent faucibus nisl sit amet<br>nulla sollicitudin pretium a sed purus. Nullam bibendum porta magna Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
         "description" => __("Content display in featurebox.", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Link", 'krobs'),
         "param_name"=> "link",
         "value"     => "#",
         "description" => __("Link address to additional info.", 'krobs')
      ),
    )));
}

//counter_item
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Counter Item", 'krobs'),
   "base"      => "counter_num",
   "class"     => "",
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'krobs',
   "params"    => array(
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Title", 'krobs'),
          "param_name"=> "title",
          "value"     => "Downloader",
          "description" => __("Counter title", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Counter Number", 'krobs'),
          "param_name"=> "number",
          "value"     => "1200",
          "description" => __("Counter number.", 'krobs')
        ),
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Counter ID", 'krobs'),
          "param_name"=> "id",
          "value"     => "download",
          "description" => __("Counter ID.", 'krobs')
        ),
    )));
}

//Screenshot
if(function_exists('vc_map')){
  //Register "container" content element. It will hold all your inner (child) content elements
  vc_map( array(
      "name" => __("Screenshot Slider", "wpb"),
      "base" => "screenshot_slider",
      "category"  => 'krobs',
      "as_parent" => array('only' => 'screenshot_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      "show_settings_on_create" => false,
      "class"=>'cth_screenshot_slider',
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png", // Simply pass url to your icon here
      //'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/custom.css' ),
      "params" => array(
          // add params same as with any other content element
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
          array(
              "type" => "textfield",
              "heading" => __("id", "krobs"),
              "param_name" => "el_id",
              "description" => __("Slider id", "wpb")
          ),
          array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Slider holder image", 'krobs'),
          "param_name"=> "attachid",
          "description" => __("Home slider holder image", 'krobs')
        ),
      ),
      "js_view" => 'VcColumnView'
  ) );
  vc_map( array(
      "name" => __("Slide Item", "wpb"),
      "base" => "screenshot_slider_item",
      "content_element" => true,
      "as_child" => array('only' => 'screenshot_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      //"icon" => get_template_directory_uri() . "/vc_extend/swiper-icon.png",
      "params" => array(
        //  add params same as with any other content element
        array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
          array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Slide Link", 'krobs'),
         "param_name"=> "link_slider",
         "value"     => "#",
         "description" => __("", 'krobs')
      ),
      array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Slide Image", 'krobs'),
          "param_name"=> "images_slider",
          "description" => __("Slide Image", 'krobs')
        ),
          
      )
  ) );

  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_Screenshot_Slider extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_Screenshot_Slider_Item extends WPBakeryShortCode {
      }
  }
}

//pricing
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Pricing", 'krobs'),
   "description" => __("Pricing description",'krobs'),
   "base"      => "pricing",
   "class"     => "",
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "category"  => 'krobs',
   "params"    => array(
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Pricing Price", 'krobs'),
         "param_name"=> "price",
         "value"     => "$0",
         "description" => __("Pricing price for your product", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Title", 'krobs'),
         "param_name"=> "title",
         "value"     => "Free",
         "description" => __("Title for your product", 'krobs')
      ),
      array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Sort Description", 'krobs'),
         "param_name"=> "subtitle",
         "value"     => "Free trial 30 days",
         "description" => __("Sort description for your product", 'krobs')
      ),
       array(
         "type"      => "textarea",
         "holder"    => "div",
         "class"     => "",
         "heading"  => __("Content", 'krobs'),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Content display in pricing block.", 'krobs')
      ),
       array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Label Button", 'krobs'),
         "param_name"=> "label",
         "value"     => "Get it now",
         "description" => __("Text display for button", 'krobs')
      ),
       array(
         "type"      => "textfield",
         "class"     => "",
         "heading"   => __("Link", 'krobs'),
         "param_name"=> "link",
         "value"     => "#",
         "description" => __("Link for button", 'krobs')
      ),
    )));
}
// Testimonials Slider
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Clients Slider", 'krobs'),
   "base"      => "clients_slider",
   "class"     => "",
   "icon" => "icon-cth",
   "category"  => 'krobs',
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "params"    => array(
      array(
         "type"      => "attach_images",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Clients Logos", 'krobs'),
         "param_name"=> "logos",
         //"value"     => "3",
         "description" => __("Clients Logos", 'krobs')
      ),
       array(
         "type"      => "textfield",

         "class"     => "",
         "heading"   => __("ID", 'krobs'),
         "param_name"=> "el_id",
         "value"     => "",
         "description" => __("Slider ID", 'krobs')
      ),
       array(
         "type"      => "textfield",

         "class"     => "",
         "heading"   => __("Extra class", 'krobs'),
         "param_name"=> "extra_class",
         "value"     => "",
         "description" => __("Extra class.", 'krobs')
      ),
    )));
}

// To top
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("To Top", 'krobs'),
   "base"      => "to_top",
   "class"     => "",
   "icon" => "icon-cth",
   "category"  => 'krobs',
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "params"    => array(
       array(
         "type"      => "textfield",

         "class"     => "",
         "heading"   => __("Title", 'krobs'),
         "param_name"=> "title",
         "value"     => "To top",
         "description" => __("Title", 'krobs')
      ),
       array(
         "type"      => "textfield",

         "class"     => "",
         "heading"   => __("Extra class", 'krobs'),
         "param_name"=> "extra_class",
         "value"     => "",
         "description" => __("Extra class.", 'krobs')
      ),
    )));
}

//Client
if(function_exists('vc_map')){
  //Register "container" content element. It will hold all your inner (child) content elements
  vc_map( array(
      "name" => __("Client", "wpb"),
      "base" => "client",
      "category"  => 'krobs',
      "as_parent" => array('only' => 'client_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      "show_settings_on_create" => false,
      "class"=>'cth_client',
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png", // Simply pass url to your icon here
      //'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/custom.css' ),
      "params" => array(
          // add params same as with any other content element
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
      ),
      "js_view" => 'VcColumnView'
  ) );
  vc_map( array(
      "name" => __("Client Item", "wpb"),
      "base" => "client_item",
      "content_element" => true,
      "as_child" => array('only' => 'client'), // Use only|except attributes to limit parent (separate multiple values with comma)
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
      "params" => array(
        //  add params same as with any other content element
        array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Select image", 'krobs'),
          "param_name"=> "cl_image",
          "description" => __("Our client image", 'krobs')
        ),
        array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Select image hover", 'krobs'),
          "param_name"=> "cl_hover",
          "description" => __("Our client image hover.", 'krobs')
        ),
        array(
             "type"      => "textfield",
             "class"     => "",
             "heading"   => __("Link", 'krobs'),
             "param_name"=> "cl_link",
             "value"     => "#",
             "description" => __("Link to client", 'krobs')
        ),
      )
  ) );

  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_Client extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_Client_Item extends WPBakeryShortCode {
      }
  }
}

//Testimonials Item Slider
if(function_exists('vc_map')){
  //Register "container" content element. It will hold all your inner (child) content elements
  vc_map( array(
      "name" => __("Testimonials Slider", "wpb"),
      "base" => "testimonials_slider",
      "category"  => 'krobs',
      "as_parent" => array('only' => 'testimonials_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      "show_settings_on_create" => false,
      "class"=>'cth_testimonials_slider',
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png", // Simply pass url to your icon here
      //'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/custom.css' ),
      "params" => array(
          // add params same as with any other content element
          array(
              "type" => "textfield",
              "heading" => __("Title", "krobs"),
              "param_name" => "el_title",
              "value"=>"Testimonials",
              "description" => __("Title", "wpb")
          ),
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
          array(
              "type" => "textfield",
              "heading" => __("id", "krobs"),
              "param_name" => "el_id",
              "description" => __("Slider id", "wpb")
          ),
      ),
      "js_view" => 'VcColumnView'
  ) );
  vc_map( array(
      "name" => __("Testimonial", "wpb"),
      "base" => "testimonials_slider_item",
      "content_element" => true,
      "as_child" => array('only' => 'testimonials_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
      "params" => array(
        //  add params same as with any other content element
        
        array(
          "type"      => "attach_image",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Avatar Image", 'krobs'),
          "param_name"=> "ts_avatar",
          "description" => __("Client avatar", 'krobs')
        ),
          array(
            "type" => "textarea",
            "class" => "",
            "heading" => __( "Client comment", "wpb" ),
            "param_name" => "content",
            "value" => __( "Quisque auctor, magna suscipit dignissim vestibulum, nulla dolor tristique quam, ac viverra nunc purus suscipit tortor. Etiam vel hendrerit libero.Nulla tincidunt interdum leo. Cras molestie eros velit.", "wpb" ),
            "description" => __( "Client comment", "wpb" )
         ), 
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
      )
  ) );

  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_Testimonials_Slider extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_Testimonials_Slider_Item extends WPBakeryShortCode {
      }
  }
}

//About - Skills - Services Slider
if(function_exists('vc_map')){
  //Register "container" content element. It will hold all your inner (child) content elements
  vc_map( array(
      "name" => __("About Slider", "wpb"),
      "base" => "about_services_slider",
      "category"  => 'krobs',
      "as_parent" => array('only' => 'about_services_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      "show_settings_on_create" => false,
      "class"=>'cth_testimonials_slider',
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png", // Simply pass url to your icon here
      //'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/custom.css' ),
      "params" => array(
          // add params same as with any other content element
          array(
              "type" => "textfield",
              "heading" => __("Title", "krobs"),
              "param_name" => "el_title",
              "value"=>"",
              "description" => __("Title", "wpb")
          ),
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
          array(
              "type" => "textfield",
              "heading" => __("id", "krobs"),
              "param_name" => "el_id",
              "description" => __("Slider id", "wpb")
          ),
      ),
      "js_view" => 'VcColumnView'
  ) );
  vc_map( array(
      "name" => __("About Slider Item", "wpb"),
      "base" => "about_services_slider_item",
      "content_element" => true,
      "as_child" => array('only' => 'about_services_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
      "params" => array(
        //  add params same as with any other content element
        
        array(
          "type"      => "textfield",
          "holder"    => "div",
          "class"     => "",
          "heading"   => __("Title", 'krobs'),
          "param_name"=> "title",
          "description" => __("Title", 'krobs')
        ),
        array(
          "type"      => "textfield",
          //"holder"    => "div",
          "class"     => "",
          "heading"   => __("Icon Name", 'krobs'),
          "param_name"=> "icon",
          "description" => __("Awesome Icon Name", 'krobs')
        ),
          array(
            "type" => "textarea_raw_html",
            "class" => "",
            "heading" => __( "Content", "wpb" ),
            "param_name" => "content",
            "value" => "",
            "description" => __( "Content", "wpb" )
         ), 
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "krobs"),
              "param_name" => "extra_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpb")
          ),
      )
  ) );

  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_About_Services_Slider extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_About_Services_Slider_Item extends WPBakeryShortCode {
      }
  }
}

// About Image Slider
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("About Images Slider", 'krobs'),
   "base"      => "about_images_slider",
   "class"     => "",
   "category"  => 'krobs',
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "params"    => array(
      array(
         "type"      => "attach_images",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("About Images", 'krobs'),
         "param_name"=> "images",
         //"value"     => "3",
         "description" => __("About Images", 'krobs')
      ),
       array(
         "type"      => "textfield",

         "class"     => "",
         "heading"   => __("ID", 'krobs'),
         "param_name"=> "el_id",
         "value"     => "",
         "description" => __("Slider ID", 'krobs')
      ),
       array(
         "type"      => "textfield",

         "class"     => "",
         "heading"   => __("Extra class", 'krobs'),
         "param_name"=> "extra_class",
         "value"     => "",
         "description" => __("Extra class.", 'krobs')
      ),
    )));
}

// Mailchip Embed Code
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Mailchip Embed Code", 'krobs'),
   "base"      => "mailchip_embed_code",
   "class"     => "",
   "category"  => 'krobs',
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "params"    => array(
      // array(
      //    "type"      => "attach_images",
      //    "holder"    => "div",
      //    "class"     => "",
      //    "heading"   => __("About Images", 'krobs'),
      //    "param_name"=> "images",
      //    //"value"     => "3",
      //    "description" => __("About Images", 'krobs')
      // ),
       array(
         "type"      => "textarea_raw_html",

         "class"     => "",
         "heading"   => __("Embed Code", 'krobs'),
         "param_name"=> "content",
         "value"     => "",
         "description" => __("Mailchip Subscribe Form Embed Code", 'krobs')
      ),
       array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Extra class", 'krobs'),
         "param_name"=> "extra_class",
         "value"     => "subcribe-form",
         "description" => __("Extra class.", 'krobs')
      ),
    )));
}

// Portfolio grid
if(function_exists('vc_map')){
   vc_map( array(
   "name"      => __("Portfolio Grid", 'krobs'),
   "base"      => "portfolio_grid",
   "class"     => "",
   "category"  => 'Krobs',
   "icon" => get_template_directory_uri() . "/vc_extend/krobs-icon.png",
   "params"    => array(
    array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Count", 'krobs'),
         "param_name"=> "count",
         "value"     => "9",
         "description" => __("Number of portfolio to show", 'krobs')
      ),
    array(
        "type" => "dropdown",
        "class"=>"",
        "heading" => __('Order by', 'krobs'),
        "param_name" => "order_by",
        "value" => array(   
        __('Date', 'krobs') => 'date',  
          __('ID', 'krobs') => 'ID',  
          __('Author', 'krobs') => 'author',       
          __('Title', 'krobs') => 'title',  
          __('Modified', 'krobs') => 'modified',  
        ),
        "description" => __("Order by", 'krobs'),  
        "default"=>'date',    
        ) ,
      array(
        "type" => "dropdown",
        "class"=>"",
        "heading" => __('Order', 'krobs'),
        "param_name" => "order",
        "value" => array(   
          __('Descending', 'krobs') => 'DESC',
                          __('Ascending', 'krobs') => 'ASC',  
                                                                                                          
                        ),
        "description" => __("Order", 'krobs'),      
      ) ,
       array(
         "type"      => "textfield",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Extra class", 'krobs'),
         "param_name"=> "extra_class",
         "value"     => "",
         "description" => __("Extra class.", 'krobs')
      ),
    )));
}

?>