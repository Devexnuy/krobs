<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes[] = array(
		'id'         => 'post_options',
		'title'      => 'Post Options',
		'pages'      => array('post'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           array(
                'name' => 'oEmbed for Post Format',
                'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),
            array(
                'name' => __( 'Single Layout', 'cmb' ),
                'desc' => __( 'Choose display layout for this post', 'cmb' ),
                'id' => $prefix . 'single_layout',
                'type' => 'select',
                'options' => array(
                  'fullwidth' => __( 'Fullwidth', 'cmb' ),
                  'right_sidebar' => __( 'Right Sidebar', 'cmb' ),
                  'left_sidebar' => __( 'Left Sidebar', 'cmb' ),
                  ),
                'default' =>'right_sidebar',
            ),
		),
	);
    
    $meta_boxes[] = array(
        'id'         => 'project_fields',
        'title'      => 'Project Fields',
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
          array(
                'name' => 'Popup Type',
                'desc' => 'Select popup type to show this protfolio up',
                'id'   => $prefix . 'portfolio_popup',
                'type'    => 'select',
                'options' => array(
                    'popup_youtube' => __( 'Popup Youtube', 'cmb' ),
                    'popup_vimeo' => __( 'Popup Vimeo', 'cmb' ),
                    'popup_gallery' => __( 'Popup Gallery', 'cmb' ),
                    'popup_ajax' => __( 'Popup Ajax', 'cmb' ),
                    'popup_modal' => __( 'Popup Modal', 'cmb' ),
                ),
                'default'=>'popup_gallery',
            ),
            array(
                'name' => 'Video Link',
                'desc' => 'Insert video link (using for Youtube and Vimeo Popup)',
                'id'   => $prefix . 'video_link',
                'type' => 'text',
            ),
            
        )
    );

	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Extra Info', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
