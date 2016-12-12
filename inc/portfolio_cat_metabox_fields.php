<?php

/**
 * @package Domik - Responsive Architecture WP Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 5-5-2015
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

//For portfolio_cat taxonomy
//https://make.wordpress.org/core/2015/09/04/taxonomy-term-metadata-proposal/
// Add term page
function domik_skill_add_new_meta_field() {
    
    // this will add the custom meta field to the add new term page
    wp_enqueue_media();
    wp_enqueue_script('domik_tax_meta', get_template_directory_uri() . '/inc/assets/upload_file.js', array('jquery'), null, true);
    cth_select_media_file_field('right_image',esc_html__('Right Parallax Image in Archive page','domik'), array());

}
add_action('skill_add_form_fields', 'domik_skill_add_new_meta_field', 10, 2);

// Edit term page
function domik_skill_edit_meta_field($term) {
    wp_enqueue_media();
    wp_enqueue_script('domik_tax_meta', get_template_directory_uri() . '/inc/assets/upload_file.js', array('jquery'), null, true);
    
    // put the term ID into a variable
    $t_id = $term->term_id;
    
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("taxonomy_$t_id");
    
    cth_select_media_file_field('right_image',esc_html__('Right Parallax Image in Archive page','domik'), $term_meta,false);
}
add_action('skill_edit_form_fields', 'domik_skill_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function domik_save_skill_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $t_id = $term_id;
        $term_meta = get_option("taxonomy_$t_id");
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        
        // Save the option array.
        update_option("taxonomy_$t_id", $term_meta);
    }
}
add_action('edited_skill', 'domik_save_skill_custom_meta', 10, 2);
add_action('create_skill', 'domik_save_skill_custom_meta', 10, 2);
