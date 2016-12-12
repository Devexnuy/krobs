<?php 
/**
 * @package Domik - Responsive Architecture WP Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 5-5-2015
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if(!function_exists('cth_select_media_file_field')){
 	function cth_select_media_file_field($f_id = 'cat_header_image',$f_title = 'Header Background Image', $term_values = array(),$new_screen = true){
 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$f_id.']">'.$f_title.'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$f_id.']">'.$f_title.'</label></th>';
			    echo '<td>';
 		}
 		
	        	echo '<img id="term_meta['.$f_id.'][preview]" src="'.(isset($term_values[$f_id]['url']) ? esc_attr($term_values[$f_id]['url']) : '').'" alt="" '.(isset($term_values[$f_id]['url']) ? ' style="display:block;width:200px;height=auto;"' : ' style="display:none;width:200px;height=auto;"').'>';
	            echo '<input type="hidden" name="term_meta['.$f_id.'][url]" id="term_meta['.$f_id.'][url]" value="'.(isset($term_values[$f_id]['url']) ? esc_attr($term_values[$f_id]['url']) : '').'">';
	            echo '<input type="hidden" name="term_meta['.$f_id.'][id]" id="term_meta['.$f_id.'][id]" value="'.(isset($term_values[$f_id]['id']) ? esc_attr($term_values[$f_id]['id']) : '').'">';
	            
	            echo '<p class="description"><a href="#" class="button button-primary upload_image_button metakey-term_meta fieldkey-'.$f_id.'">'.esc_html__('Upload Image', 'monolit').'</a>  <a href="#" class="button button-secondary remove_image_button metakey-term_meta fieldkey-'.$f_id.'">'.esc_html__('Remove', 'monolit').'</a></p>';
	    if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}

 	}
}

if(!function_exists('cth_radio_options_field')){
	/**
	* field_options : array('id','name','desc','values','default')
	*
	*/
 	function cth_radio_options_field($field_options, $term_values = array(),$new_screen = true){
 		if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
 			$checked = $term_values[$field_options['id']];
 		}elseif( isset($field_options['default']) ){
 			$checked = $field_options['default'];
 		}else{
 			$checked = ' No provide default value';
 		}
 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}
 		
		        if(!empty($field_options['values'])){
		        	foreach ($field_options['values'] as $val => $opt) {
		        		echo '<input type="radio" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']" value="'.$val.'" '.checked( $checked, $val,false).'>'.$opt.'&nbsp;&nbsp;';
		        	}
		        }
		        if(isset($field_options['desc'])){
		        	echo '<p class="description">'.$field_options['desc'].'</p>';
		        }
		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}
	            
	        

 	}
}