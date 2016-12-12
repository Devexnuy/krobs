<?php

/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 

if (!function_exists('row_sc')) {
	$columnArray = array();

	function row_sc( $atts, $content="" ){
		global $columnArray;
		$id='';
		
		$params = shortcode_atts(array(
			  'id' => '',
			  'class' => '',
			  'animation'=>'0',
			  'effect'=>'fadeInDown',
			  'delay'=>''
		 ), $atts);
		
		if ($params['id']) 
			$id = 'id="' . $params['id'] . '"'; 
		$class = 'row';
		if(!empty($params['class'])){
			$class .= ' '.$params['class'];
		}

		if($params['animation'] == '1'){
			$class .= ' wow '.$params['effect'];
		}

		$class = 'class="'.$class.'"';
		if(!empty($params['delay'])){
			$class .=' data-wow-delay="'.$params['delay'].'"';
		}
		
		do_shortcode( $content );
		
		//Row
		$html = '<div '. $class . ' ' . $id . '>';
		//Columns
		foreach ($columnArray as $key=>$col){
			// Column effect
			//echo'<pre>';var_dump($col);die;
			if(!empty($col['class'])){
				$class = $col['class'];
			}else{
				$class = 'col-md-12';
			}

			if($col['animation'] == '1'){
				$class .= ' wow '.$col['effect'];
			}

			$class = 'class="'.$class.'"';
			if(!empty($col['delay'])){
				$class .=' data-wow-delay="'.$col['delay'].'"';
			}

			$html .='<div ' . $class . '>' . do_shortcode($col['content']) . '</div>';
		}

		$html .='</div>';
	
		$columnArray = array();	
		return $html;
	}
	
	add_shortcode( 'row', 'row_sc' );
		
	//Column Items
	function column_sc( $atts, $content="" ){
		global $columnArray;

		if(is_array($atts)){
			$class = isset($atts['class']) ? $atts['class'] : '';
			$animation = isset($atts['animation']) ? $atts['animation'] : '0';
			$effect = isset($atts['effect']) ? $atts['effect'] : 'fadeInLeft';
			$delay = isset($atts['delay']) ? $atts['class'] : '';
		}else{
			$class = '';
			$animation = '0';
			$effect = 'fadeInLeft';
			$delay = '';
		}


		$columnArray[] = array(
			'class'=>$class,
			'animation'=>$animation,
			'effect'=>$effect,
			'delay'=>$delay,
			'content'=> $content
		);
	}

	add_shortcode( 'column', 'column_sc' );	
}

if(!function_exists('icon_sc')) {

	function icon_sc( $atts, $content="" ) {
	
		extract(shortcode_atts(array(
			   'name' =>"diamond"
		 ), $atts));
		
		return '<i><span class="icon icon-'.$name.'"></span></i>'. $content;
	 
	}
		
	add_shortcode( 'icon', 'icon_sc' );
}

if (!function_exists('link_sc')) {

	function link_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'id'=>'',
			'class' => '',
			'link' => '#',
		 ), $atts));
		
		if (!empty($id)) 
			$id = 'id="' . $id . '"'; 
		$classes = 'iconlink';
		if(!empty($class)){
			$classes .= ' '.$class;
		}

		$html = '<a href="'.$link.'" '.$classes.'>'.do_shortcode($content ).'</a>';

		return $html;
	}

	add_shortcode( 'link', 'link_sc' );
}

if (!function_exists('iconlink_sc')) {

	function iconlink_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'id'=>'',
			'class' => '',
			'link' => '#',
			'animation'=>'0',
			'effect'=>'bounceInDown',
			'delay'=>'',
			'iconclass'=>'fa fa-magic'
		 ), $atts));
		
		if (!empty($id)) 
			$id = 'id="' . $id . '"'; 
		$classes = 'iconlink';
		if(!empty($class)){
			$classes .= ' '.$class;
		}

		if($animation === '1'){
			$classes .= ' wow '.$effect;
		}

		$classes = 'class="'.$classes.'"';
		if(!empty($delay)){
			$classes .=' data-wow-delay="'.$delay.'"';
		}

		$html = '<a href="'.$link.'" '.$classes.'><i class="'.$iconclass.'"></i></a>' . $content;

		return $html;
	}

	add_shortcode( 'iconlink', 'iconlink_sc' );
}

if (!function_exists('paragraph_sc')) {

	function paragraph_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'id'=>'',
			'class' => '',
			'wrapper'=>'p'
		 ), $atts));
		
		if (!empty($id)) 
			$id = 'id="' . $id . '"'; 
		if(!empty($class)){
			$class = 'class="'.$class.'"';
		}

		$html = '<'.$wrapper.' '.$id.' '.$class.'>' . do_shortcode($content ).'</'.$wrapper.'>';

		return $html;
	}

	add_shortcode( 'paragraph', 'paragraph_sc' );
}

//video background
if (!function_exists('video_bg_sc')) {

	function video_bg_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'el_class'=>'',
			'video_id'=>'',
			'video_title'=>'',
			'show_control'=>'',
			'auto_play'=>'',
			'loop'=>'',
			'mute'=>'',
			'opacity'=>'',
			'containment'=>'',
			'quanlity'=>'',
			
		 ), $atts));
		//Start
			$html='';
			$html .= "\n\t".'<a id="bgndVideo" class="player" data-property="{videoURL:\''.$video_id.'\',containment:\''.$containment.'\', showControls:false, autoPlay:true, loop:'.$loop.', mute:'.$mute.', startAt:10, opacity:'.$opacity.', addRaster:false, quality:\''.$quanlity.'\'}">'.$video_title.'</a>';

			return $html;
	}

	add_shortcode( 'video_bg', 'video_bg_sc' );
}


//home_ticker_build
if (!function_exists('home_ticker_sc')) {

	function home_ticker_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'el_class'=>'',
			'title'=>'',
			'subtitle'=>'',
			'link_video' =>'',
			'text_btn1' =>'',
			'text_btn2' =>'',
			'link_btn2' =>'',
		 ), $atts));
		//Start
			$html='';
			$html .= "\n\t".'<h3>'.$title.' <span>'.$subtitle.'</span></h3>';
			$html .= "\n\t".'<p class="btn-inline">';
				$html .= "\n\t".'<a href="'.$link_video.'" data-pretty="prettyPhoto" class="btn btn-bordered btn-lg zoom">'.$text_btn1.'</a>';
				$html .= "\n\t".'<a href="'.$link_btn2.'" class="btn btn-primary btn-lg">'.$text_btn2.'</a>';
			$html .= "\n\t".'</p>';

			return $html;
	}

	add_shortcode( 'home_ticker', 'home_ticker_sc' );
}

//Home Slider
if(!function_exists('home_slider_sc')){

	$homeSliderItems = array();
	
	function home_slider_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'el_class' =>	'',
			'el_id' =>	'',
			// 'link_slider' =>	'',
			// 'images_slider' =>	'',
			// 'images_slider_bor' =>'',
			'attachid' =>'',
		), $atts));

		global $homeSliderItems;


		do_shortcode( $content );

		$html = '';
		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		$html .= "\n\t".'<div'.$el_id.' class="home-slider '.$el_class.'">';
			$html .= "\n\t".'<div class="slider-wrapper">';
				$html .= "\n\t".'<div class="imac-device">';
					$html .= "\n\t".'<ul class="slides">';
					foreach ($homeSliderItems as $key => $slide) {
					if(!empty($slide['el_class'])){
						$html .= "\n\t".'<li class="'.$slide['el_class'].'">';
					}else{
						$html .= "\n\t".'<li>';
					}
							$html .= "\n\t".'<a href="'.$slide['link_slider'].'">'.wp_get_attachment_image( $slide['images_slider'], 'full' ).'</a>';
						$html .= "\n\t".'</li>';
					}
	
					$html .= "\n\t".'</ul>';
				$html .= "\n\t".'</div>';
			$html .= "\n\t".'</div>';
			$html .= "\n\t".'<img src="'.wp_get_attachment_url($attachid).'" class="img-responsive" alt="Slider_Holder_Img" />';
		$html .= "\n\t".'</div>';

		$homeSliderItems = array();


		return $html;
	}

	add_shortcode('home_slider','home_slider_sc');

	

	// End Home Slider

	function home_slider_item_sc($atts, $content = null){

		global $homeSliderItems;

		$homeSliderItems[] = array('el_class'=>(isset($atts['el_class'])? $atts['el_class'] : ''),'link_slider'=>(isset($atts['link_slider'])? $atts['link_slider'] : ''),'images_slider'=>(isset($atts['images_slider'])? $atts['images_slider'] : ''),'content'=>$content);

	}

	add_shortcode('home_slider_item','home_slider_item_sc');

	// End Home Slider
}

//featurebox
if (!function_exists('featurebox_sc')) {

	function featurebox_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'el_class'=>'',
			'title'=>'',
			'icon' => '',
			'link'=>'#'
		 ), $atts));
		//Start
		$html = '<div class="feature-box">';
			$html .= "\n\t".'<i class="pe-7s-'.$icon.' pe-feature"></i>';
			$html .= "\n\t".'<h5>'.$title.'</h5>';
			$html .= "\n\t".'<p>';
				$html .= "\n\t".$content;
			$html .= "\n\t".'</p>';
			$html .= "\n\t".'<a href="'.$link.'">Learn more</a>';
		$html .= "\n\t".'</div>';

		return $html;
	}

	add_shortcode( 'featurebox', 'featurebox_sc' );
}
//Screenshot
if(!function_exists('screenshot_slider_sc')){

	$screenshotSliderItems = array();
	
	function screenshot_slider_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'el_class' =>	'',
			'el_id' =>	'',
			'attachid' =>'',
		), $atts));

		global $screenshotSliderItems;


		do_shortcode( $content );

		$html = '';
		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		$html .= "\n\t".'<div'.$el_id.' class="screenshot-slider '.$el_class.'">';
			$html .= "\n\t".'<div class="screenshot-wrapper">';
				$html .= "\n\t".'<div class="flexslider">';
					$html .= "\n\t".'<ul class="slides">';
					foreach ($screenshotSliderItems as $key => $slide) {
					if(!empty($slide['el_class'])){
						$html .= "\n\t".'<li class="'.$slide['el_class'].'">';
					}else{
						$html .= "\n\t".'<li>';
					}
							$html .= "\n\t".'<a href="'.$slide['link_slider'].'">'.wp_get_attachment_image( $slide['images_slider'], 'full' ).'</a>';
						$html .= "\n\t".'</li>';
					}
	
					$html .= "\n\t".'</ul>';
				$html .= "\n\t".'</div>';
			$html .= "\n\t".'</div>';
			$html .= "\n\t".'<img src="'.wp_get_attachment_url($attachid).'" class="img-responsive" alt="Slider_Holder_Img" />';
		$html .= "\n\t".'</div>';

		$screenshotSliderItems = array();


		return $html;
	}

	add_shortcode('screenshot_slider','screenshot_slider_sc');

	// End Screenshot Slider

	function screenshot_slider_item_sc($atts, $content = null){

		global $screenshotSliderItems;

		$screenshotSliderItems[] = array('el_class'=>(isset($atts['el_class'])? $atts['el_class'] : ''),'link_slider'=>(isset($atts['link_slider'])? $atts['link_slider'] : ''),'images_slider'=>(isset($atts['images_slider'])? $atts['images_slider'] : ''),'content'=>$content);

	}

	add_shortcode('screenshot_slider_item','screenshot_slider_item_sc');

	// End Screenshot Slider
}
//Counter/ Our Fact
if(!function_exists('counter_num_sc')){
	
	function counter_num_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'title' =>	'',
			'number'=>'',
			'id'=>'download',
			

		), $atts));

		$html = '';
	    
			$html .= "\n\t".'<span id="counter-'.$id.'" class="counter-number">'.$number.'</span>';
			$html .= "\n\t".'<span class="counter-text">'.$title.'</span>';

		return $html;
	}

	add_shortcode('counter_num','counter_num_sc');
}
//Testimonials Slider
if(!function_exists('testimonials_slider_sc')){

	$testimonialsSliderItems = array();
	
	function testimonials_slider_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'el_class' =>	'',
			'el_id' =>	'',
			'el_title' =>'',
		), $atts));

		global $testimonialsSliderItems;

		do_shortcode( $content );

		$html = '';
		
		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		$html .= "\n\t".'<div class="testimonials-holder">';
            $html .= "\n\t".'<h3>Testimonials</h3>';
            $html .= "\n\t".'<div class="customNavigation">';
                $html .= "\n\t".'<a class="btn next-slide transition"><i class="fa fa-angle-right"></i></a>';
                $html .= "\n\t".'<a class="btn prev-slide transition"><i class="fa fa-angle-left"></i></a>';
            $html .= "\n\t".'</div>';
            $html .= "\n\t".'<div class="clearfix"></div>';
            $html .= "\n\t".'<div '.$el_id.' class="rep-testimonials-slider owl-carousel '.$el_class.'">';

            foreach ($testimonialsSliderItems as $key => $slide) {
                $html .= "\n\t".'<div class="item">';
                    $html .= "\n\t".'<div class=" row-fluid">';
                        $html .= "\n\t".'<div class="span2">';
                            $html .= "\n\t".'<div class="testi-image">';
                                $html .= "\n\t".'<img src="'.wp_get_attachment_url($slide['ts_avatar']).'" alt="" class="respimg res2">';
                            $html .= "\n\t".'</div>';
                        $html .= "\n\t".'</div>';
                        $html .= "\n\t".'<div class="span10">'.wpb_js_remove_wpautop($slide['content'],true).'</div>';
                    $html .= "\n\t".'</div>';
                $html .= "\n\t".'</div>';
            }

            $html .= "\n\t".'</div>';
        $html .= "\n\t".'</div>';
        $html .= "\n\t".'<div class="clearfix"></div>';

		$testimonialsSliderItems = array();


		return $html;
	}

	add_shortcode('testimonials_slider','testimonials_slider_sc');

	// End Testimonials Slider

	function testimonials_slider_item_sc($atts, $content = null){

		global $testimonialsSliderItems;

		$testimonialsSliderItems[] = array('el_class'=>(isset($atts['el_class'])? $atts['el_class'] : ''),'ts_avatar'=>(isset($atts['ts_avatar'])? $atts['ts_avatar'] : ''),'content'=>$content);

	}

	add_shortcode('testimonials_slider_item','testimonials_slider_item_sc');

	// End Testimonials Slider
}
//Client
if(!function_exists('client_sc')){

	$clientItems = array();
	
	function client_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'el_class' =>	'',
			//'el_id' =>	'testimonials-slider',
			'count' =>'5',
		), $atts));

		global $clientItems;

		do_shortcode( $content );
		$count=(int)$count;

		$html = '';
		$html .= "\n\t".'<ul class="client-list">';
			
				
					foreach ($clientItems as $key => $attachID) {
						if($key === 0|| ($key % $count === 0)){
							if(($key) >= (count($clientItems)- $count)){
								$html .= "\n\t".'<li class="bottom-list">';
							}else{
								$html .= "\n\t".'<li>';
							}
							
								$html .= "\n\t".'<ul>';
						}
						if(($key +1) % $count === 0){
							$html .= "\n\t".'<li class="last">';
						}else{
							$html .= "\n\t".'<li>';
						}									
							$html .= "\n\t".'<a href="'.$attachID['cl_link'].'" class="client-link">';
								$html .= "\n\t".'<span class="logo-hover"><img src="'.wp_get_attachment_url($attachID['cl_hover']).'" alt="" /></span>';
								$html .= "\n\t".'<img src="'.wp_get_attachment_url($attachID['cl_image']).'" class="client-logo" alt="" />';
							$html .= "\n\t".'</a>';
						$html .= "\n\t".'</li>';

						if(($key +1) % $count === 0){
								$html .= "\n\t".'</ul>';
							$html .= "\n\t".'</li>';
						}
					}							
				
		$html .= "\n\t".'</ul>';
		$clientItems = array();


		return $html;
	}

	add_shortcode('client','client_sc');

	// End Client

	function client_item_sc($atts, $content = null){

		global $clientItems;

		$clientItems[] = array('el_class'=>(isset($atts['el_class'])? $atts['el_class'] : ''),'cl_image'=>(isset($atts['cl_image'])? $atts['cl_image'] : ''),'cl_hover'=>(isset($atts['cl_hover'])? $atts['cl_hover'] : ''),'cl_link'=>(isset($atts['cl_link'])? $atts['cl_link'] : ''),'content'=>$content);//'el_class'=>(isset($atts['el_class'])? $atts['el_class']: ''),'link'=>(isset($atts['sl_link'])? $atts['sl_link'] : ''),

	}

	add_shortcode('client_item','client_item_sc');

	// End Client Items
}

//Tweets
if(!function_exists('twitter_feed_sc')){
	
	function twitter_feed_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'title'=>'',
			'twittername' 				=>	'Cththemes',
			'consumer_key'				=>	'b1gNFU5p55j7GR0vACWyZf0j8',
			'consumer_key_secret' 		=>	'V0a7UkD0XTuP4zdoJoBPlpbQC9TtGk8ucotXRZZZP4MYv7TkK2',
			'access_token'				=>	'2549127786-T8zZA3d7cJcgDkI2kwbfQ2XeU8exphGZu3hZVvK',
			'access_token_secret' 		=>	'pQXlpkL9CSCIsEnGF5xgsjKObDRWcD77thGkFG9RLzgjs',
			'count'						=>	'1',

		), $atts));

		$params = array(
						'twittername'=>$twittername,
						'consumer_key'=>$consumer_key,
						'consumer_key_secret'=>$consumer_key_secret,
						'access_token'=>$access_token,
						'access_token_secret'=>$access_token_secret,
						'count'=>$count
				);
		$twitterHelper = new CthTwitterHelper($params);

		$feeds = $twitterHelper->fetch();

		$html = '';

		if(count($feeds)){ 
			$html .= "\n\t".'<div class="twitter-holder">';
			    $html .= "\n\t".'<h3>'.$title.'</h3>';
			    $html .= "\n\t".'<div class="customNavigation">';
			        $html .= "\n\t".'<a class="btn next-slide transition"><i class="fa fa-angle-right"></i></a>';
			        $html .= "\n\t".'<a class="btn prev-slide transition"><i class="fa fa-angle-left"></i></a>';
			    $html .= "\n\t".'</div>';
			    $html .= "\n\t".'<div class="clearfix"></div>';
			    $html .= "\n\t".'<div class="twitts">';
			        $html .= "\n\t".'<div class="twitter-feed">';              
			            $html .= "\n\t".'<div id="twitter-feed">';
			            	$html .= "\n\t".'<ul>';
					            foreach ($feeds as $key => $tweet) {
					            	$html .= "\n\t".'<li>'.$twitterHelper->prepareTweet($tweet['text']).'</li>';
					            }
					        $html .= "\n\t".'</ul>';
			            $html .= "\n\t".'</div>';
			        $html .= "\n\t".'</div>';
			    $html .= "\n\t".'</div>';
			    $html .= "\n\t".'<div class="clearfix"></div>';
			    $html .= "\n\t".'<h4>'.__('More Twitts on ','krobs').'<a href="https://twitter.com/'.$twittername.'" target="_blank">'.$twittername.'</a></h4>';
			$html .= "\n\t".'</div>';								
			
		}

		return $html;
	}

	add_shortcode('twitter_feed','twitter_feed_sc');

}

//Resume
if(!function_exists('resume_sc')){
	
	function resume_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'res_img' =>	'',
			'res_title' =>	'',
			'res_date' =>	'',
			'res_position' =>	'',
			'res_desc' =>'',
			'extraclass' =>'',
		), $atts));


		$html = '';
		
		$html .= "\n\t".'<div class="resume-container '.$extraclass.'">';
            $html .= "\n\t".'<div class="resume-bg">';
                $html .= "\n\t".'<div class="bg transition" style="background:url('.wp_get_attachment_url( $res_img).')"></div>';
                $html .= "\n\t".'<div class="overlay op8 transition"></div>';
            $html .= "\n\t".'</div>';
            $html .= "\n\t".'<!-- resume-head -->';
            $html .= "\n\t".'<div class="resume-head">';
            if(!empty($res_title)) {
                $html .= "\n\t".'<h3>'.preg_replace("/--([^(-){2}]*)--/", "\"$1\"", $res_title).'</h3>';
            }
            if(!empty($res_date)) {
                $html .= "\n\t".'<h4>'.$res_date.'</h4>';
            }
            $html .= "\n\t".'</div>';
            $html .= "\n\t".'<div class="resume-box-holder">';
                $html .= "\n\t".'<div class="resume-box transition">';
                if(!empty($res_position)) {
                	$html .= "\n\t".'<div class="resume-item">'.$res_position.'</div>';
                }
                    
                    $html .= "\n\t".'<div class="clearfix"></div>';
                if(!empty($res_desc)) {
                	$html .= "\n\t".'<h6>'.$res_desc.'</h6>';
                }
                    
                    $html .= "\n\t".'<div class="clearfix"></div>';
                    $html .= "\n\t".'<div class="color-separator"></div>';
                    $html .= "\n\t".'<div class="clearfix"></div>';
                    $html .= "\n\t". $content ;
                $html .= "\n\t".'</div>';
            $html .= "\n\t".'</div>';
        $html .= "\n\t".'</div>';


		return $html;
	}

	add_shortcode('resume','resume_sc');

}

//Counter/ Our Fact
if(!function_exists('clients_slider_sc')){
	
	function clients_slider_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'logos' =>	'',
			'extra_class'=>'',
			'el_id'=>'',
			

		), $atts));

		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		//echo'<pre>';var_dump($logos);die;
		$clients = explode(",", $logos);

		$html = '';

		$html .= "\n\t".'<div class="clients-holder">';
            $html .= "\n\t".'<div '.$el_id.' class="clients-slider owl-carousel '.$extra_class.'">';
            if(!empty($clients)) {
            	foreach($clients as $cl) {
            		$html .= "\n\t".'<div class="item">';
	                    $html .= "\n\t".'<img src="'.wp_get_attachment_url( $cl).'" alt="'.$cl.'" class="respimg res2">';
	                $html .= "\n\t".'</div>';
            	}
            }

            $html .= "\n\t".'</div>';
        $html .= "\n\t".'</div>';
	    

		return $html;
	}

	add_shortcode('clients_slider','clients_slider_sc');
}

//Counter/ Our Fact
if(!function_exists('to_top_sc')){
	
	function to_top_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'title' =>	'To top',
			'extra_class'=>'',
			

		), $atts));


		$html = '';

		$html .= "\n\t".'<div class="to-top-holder gray-bg '.$extra_class.'">';
			$html .= "\n\t".'<a href="#" class="button scroll-btn  content-button  transition hide-icon">';
				$html .= "\n\t".'<i class="fa fa-angle-up transition2"></i>';
				$html .= "\n\t".'<span class="text transition color-bg">'.$title.'</span>';
			$html .= "\n\t".'</a>';
		$html .= "\n\t".'</div>';
	    

		return $html;
	}

	add_shortcode('to_top','to_top_sc');
}

//Home Slider
if(!function_exists('page_title_sc')){
	
	function page_title_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'title' =>	'',
			'extra_class' =>'',
		), $atts));


		$html = '';

		$html .= "\n\t".'<div class="page-title '.$extra_class.'">';
            $html .= "\n\t".'<div class="content">';
                $html .= "\n\t".'<h2>'.preg_replace("/--([^(-){2}]*)--/", "<span>$1</span>", $title).'</h2>';
                $html .= "\n\t".'<div class="clearfix"></div>';
                $html .= "\n\t". $content;
                $html .= "\n\t".'<div class="clearfix"></div>';
                $html .= "\n\t".'<div class="color-separator"></div>';
                $html .= "\n\t".'<div class="clearfix"></div>';
            $html .= "\n\t".'</div>';
            $html .= "\n\t".'<div class="overlay"></div>';
        $html .= "\n\t".'</div>';



		return $html;
	}

	add_shortcode('page_title','page_title_sc');

}

//Client
if(!function_exists('about_services_slider_sc')){

	$aboutServicesItems = array();
	
	function about_services_slider_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'el_class' =>	'',
			'el_id' =>	'',
			//'count' =>'5',
		), $atts));

		global $aboutServicesItems;

		do_shortcode( $content );
		//$count=(int)$count;

		$html = '';
		$slider_content = '';

		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		$count = count($aboutServicesItems);

		foreach ($aboutServicesItems as $key => $sl) {
			$html .= "\n\t".'<span class="about-button show-about'.(($key == 0)? ' cur':'').'" data-key="'.$key.'"  data-count="'.$count.'"><i class="fa fa-'.$sl['icon'].'"></i><span class="tooltip">'.$sl['title'].'</span></span>';

			$slider_content .= "\n\t".'<div class="item"><div class="item-box">'.do_shortcode(rawurldecode(base64_decode(strip_tags($sl['content'])))).'</div></div>';
		}
		
		$html .= "\n\t".'<div class="about-slider-holder '.$el_class.'">';
            $html .= "\n\t".'<div '.$el_id.' class="rep-about-slider">';

            $html .= "\n\t". $slider_content;

            $html .= "\n\t".'</div>';
        $html .= "\n\t".'</div>';

		$aboutServicesItems = array();


		return $html;
	}

	add_shortcode('about_services_slider','about_services_slider_sc');

	// End Client

	function about_services_slider_item_sc($atts, $content = null){

		global $aboutServicesItems;

		$aboutServicesItems[] = array('extra_class'=>(isset($atts['extra_class'])? $atts['extra_class'] : ''),'icon'=>(isset($atts['icon'])? $atts['icon'] : ''),'title'=>(isset($atts['title'])? $atts['title'] : ''),'content'=>$content);

	}

	add_shortcode('about_services_slider_item','about_services_slider_item_sc');

	// End Client Items
}

//About Images Slider
if(!function_exists('about_images_slider_sc')){
	
	function about_images_slider_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'images' =>	'',
			'extra_class'=>'',
			'el_id'=>'',
			

		), $atts));

		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		//echo'<pre>';var_dump($logos);die;
		$images = explode(",", $images);

		$html = '';

		$html .= "\n\t".'<div class="about-image">';
            $html .= "\n\t".'<div class="customNavigation">';
                $html .= "\n\t".'<a class="btn next-slide transition"><i class="fa fa-angle-right"></i></a>';
                $html .= "\n\t".'<a class="btn prev-slide transition"><i class="fa fa-angle-left"></i></a>';
            $html .= "\n\t".'</div>';
            $html .= "\n\t".'<div '.$el_id.'  class="about-image-slider owl-carousel '.$extra_class.'">';
            if(!empty($images)) {
            	foreach($images as $cl) {
	                $html .= "\n\t".'<div class="item">';
	                    $html .= "\n\t".'<img src="'.wp_get_attachment_url( $cl).'" alt="'.$cl.'" class="respimg res2">';
	                $html .= "\n\t".'</div>';
	            }
            }
            $html .= "\n\t".'</div>';
        $html .= "\n\t".'</div>';

		return $html;
	}

	add_shortcode('about_images_slider','about_images_slider_sc');
}

//Skill
if(!function_exists('skill_sc')){
	
	function skill_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'title' =>	'',
			'extraclass'=>'',
			'percent'=>'50%',
		), $atts));


		$html = '';

		$html .= "\n\t".'<div class="custom-skillbar-title"><span>'.$title.'</span></div>';
        $html .= "\n\t".'<div class="skill-bar-percent">'.$percent.'</div>';
        $html .= "\n\t".'<div class="skillbar-bg" data-percent="'.$percent.'">';
            $html .= "\n\t".'<div class="custom-skillbar"></div>';
        $html .= "\n\t".'</div>';

		return $html;
	}

	add_shortcode('skill','skill_sc');
}

//Services
if(!function_exists('services_sc')){

	$servicesItems = array();
	
	function services_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'el_class' =>	'',
			'el_id' =>	'',
			//'count' =>'5',
		), $atts));

		global $servicesItems;

		do_shortcode( $content );
		//$count=(int)$count;

		$html = '';
		$services_content = '';

		$html .= "\n\t".'<div class="services-holder">';
		    $html .= "\n\t".'<ul>';
		    foreach ($servicesItems as $key => $ser) {
		    	$uni_id = uniqid('serv-pop'.($key+1));
		        $html .= "\n\t".'<!-- services-link -->';
		        $html .= "\n\t".'<li class="transition2">';
		            $html .= "\n\t".'<a href="#'.$uni_id.'" data-ser="modal">';
		                $html .= "\n\t".'<i class="fa fa-'.$ser['icon'].' transition"></i>';
		                $html .= "\n\t".'<h5><span>'.$ser['title'].'</span></h5>';
		            $html .= "\n\t".'</a>';
		        $html .= "\n\t".'</li>';

		        $services_content .= "\n\t".'<div class="services-info" id="'.$uni_id.'">';
			        $services_content .= "\n\t".'<div class="serv-overlay"></div>';
			        $services_content .= "\n\t".'<div class="row-fluid">';
			            $services_content .= "\n\t".'<div class="span3">';
			                $services_content .= "\n\t".'<i class="fa fa-'.$ser['icon'].'"></i>';
			                $services_content .= "\n\t".'<h2>'.$ser['title'].'</h2>';
			            $services_content .= "\n\t".'</div>';
			            $services_content .= "\n\t".'<div class="span9">';
			                $services_content .= "\n\t".$ser['content'];
			            $services_content .= "\n\t".'</div>';
			        $services_content .= "\n\t".'</div>';
			    $services_content .= "\n\t".'</div>';
		    }
		    $html .= "\n\t".'</ul>';
		    
		    $html .= "\n\t".$services_content ;

		$html .= "\n\t".'</div>';


		$servicesItems = array();


		return $html;
	}

	add_shortcode('services','services_sc');

	// End Client

	function service_item_sc($atts, $content = null){

		global $servicesItems;

		$servicesItems[] = array('title'=>$atts['title'],'icon'=>$atts['icon'],'content'=>$content);

	}

	add_shortcode('service_item','service_item_sc');

	// End Client Items
}

if(!function_exists('portfolio_grid_sc')){
	
	function portfolio_grid_sc($atts, $content = null){
		extract(shortcode_atts(array(
			'count'		=> 	'9',	
			'extra_class' =>	'',
			'el_id' =>'',
			'order'=>'DESC',
		    'order_by'=>'date'

		), $atts));

		$args = array(
			'post_type' => 'portfolio',
			//'paged' => 0,//$paged,
			'posts_per_page' => $count,
			'order' => $order,
			'order_by' => $order_by,
		);


	   	$classes = 'rep-folio gray-bg';
		if(!empty($extra_class)){
			$classes .= ' '.$extra_class;
		}

		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

	    $portfolios = new WP_Query($args);//echo'<pre>';var_dump($portfolios);die;
	    

	    $html = array();

	    $html[] = '<section'.$el_id.' class="'.$classes.'">';
	    $term_args = array(
		    'orderby'           => 'name', 
		    'order'             => 'DESC',
		); 
	    $portfolio_skills = get_terms('skill',$term_args); 
	    if(count($portfolio_skills)):
	    
            $html[] = '<div id="options">';
                $html[] = '<ul id="filters" class="option-set" data-option-key="filter">';
                    $html[] = '<li class="filter actcat transition" data-filter="all">'.__('All','krobs').'</li>';
                foreach($portfolio_skills as $portfolio_skill) {
                	$html[] = '<li class="filter transition" data-filter="'.esc_attr($portfolio_skill->slug ).'">'.esc_attr($portfolio_skill->name ).' </li>';
				}
                $html[] = '</ul>';
            $html[] = '</div>';
        endif;
            $html[] = '<!-- ajax  Page Holder-->';
            $html[] = '<div id="project-page-holder">';							
                $html[] = '<div class="clearfix"></div>';
                $html[] = '<div id="project-page-data"></div>';
                $html[] = '<div class="clearfix"></div>';
                $html[] = '<div id="project-page-button" class="clearfix">';         	
                    $html[] = '<a id="project_close" class="transition"  href="#"><i class="fa fa-times"></i></a>';
                $html[] = '</div>';
            $html[] = '</div>';
            $html[] = '<div class="clearfix"></div>';
            $html[] = '<!--portfolio links -->';
            $html[] = '<div class="content">';
                $html[] = '<div class="row-fluid">';
                    $html[] = '<div class="span12">';
                        $html[] = '<div id="folio_container">';

                        if($portfolios->have_posts()) {               
			    			while($portfolios->have_posts()) : $portfolios->the_post(); 
			    			$item_classes = array();
							//$item_skill = array();
							$item_cats = get_the_terms(get_the_ID(), 'skill');
							foreach((array)$item_cats as $item_cat){
								if(count($item_cat)>0){
									$item_classes[] = $item_cat->slug ;
									//$item_skill[] = $item_cat->name;
								}
							}
							$item_classes = implode(" ", $item_classes);
							//$item_skill = implode(" / ", $item_skill);

							$popuptype = get_post_meta(get_the_ID(), '_cmb_portfolio_popup', true);
							$captionClass = '';
							$boxClass= '';
							$viewlink = get_the_permalink();
							if($popuptype === 'popup_youtube'){
								$captionClass = 'popup-youtube';
								$viewlink = get_post_meta(get_the_ID(), '_cmb_video_link', true);
							}elseif($popuptype === 'popup_vimeo'){
								$captionClass = 'popup-vimeo';
								$viewlink = get_post_meta(get_the_ID(), '_cmb_video_link', true);
							}elseif($popuptype === 'popup_gallery'){
								$captionClass = 'popup-gallery';
								$viewlink =  wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
							}elseif($popuptype === 'popup_ajax'){
								$captionClass = 'open-project';
								$boxClass= ' open-project-link ';
								//$viewlink =  wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
							}elseif($popuptype === 'popup_modal'){
								$captionClass = 'popup-with-move-anim';
								//$viewlink =  wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
							}

                            $html[] = '<!-- 1 project ajax page slider-->';
                            $html[] = '<div class="box grid-2 notvisible '.$boxClass.'mix '. esc_attr($item_classes ).' mix_all">';
                                $html[] = '<a href="'.esc_url($viewlink ).'" class="'.$captionClass.'">';
                                    $html[] = '<div class="folio-img-holder">';

                                        $html[] = '<img src="'.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())).'" width="400" height="265" class="respimg res2 transition" alt="'.get_the_title( ).'">';
                                        //$html[] = get_the_post_thumbnail(get_the_ID(), 'foliothumb' );
                                        $html[] = '<div class="folio-item">';
                                            $html[] = '<div class="folio-overlay"></div>';
                                            $html[] = '<span class="fol-but">'.__('View','krobs').'</span>';
                                        $html[] = '</div>';
                                    $html[] = '</div>';
                                $html[] = '</a>';
                                $html[] = '<div class="box-details">';
                                    $html[] = '<h3>'.get_the_title( ).'</h3>';
                                $html[] = '</div>';
                            $html[] = '</div>';
                            endwhile;
						}
                            
                        $html[] = '</div>';
                    $html[] = '</div>';
                $html[] = '</div>';
            $html[] = '</div>';
        $html[] = '</section>';


		return implode("\n", $html);
	}

	add_shortcode('portfolio_grid','portfolio_grid_sc');

	// End Products List
}

//Mailchip Embed Code
if(!function_exists('mailchip_embed_code_sc')){
	
	function mailchip_embed_code_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			'extra_class'=>'subcribe-form',
			'el_id'=>'',
			

		), $atts));

		if(!empty($el_id)){
			$el_id = ' id="'.$el_id.'" ';
		}

		$html = '';

        $html .= "\n\t".'<div '.$el_id.'  class="'.$extra_class.'">';
        	$html .= "\n\t".'<fieldset>';
	        	$html .= "\n\t".rawurldecode(base64_decode(strip_tags($content)));
	        $html .= "\n\t".'</fieldset>';
        $html .= "\n\t".'</div>';

		return $html;
	}

	add_shortcode('mailchip_embed_code','mailchip_embed_code_sc');
}

//Span Tag
if(!function_exists('span_sc')){
	
	function span_sc($atts, $content = null){
		extract(shortcode_atts(array(	
			// 'title' =>	'',
			// 'extraclass'=>'',
			// 'percent'=>'50%',
		), $atts));


		$html = '';

        $html .= "\n\t".'<span></span>';

		return $html;
	}

	add_shortcode('span','span_sc');
}

?>