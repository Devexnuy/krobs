<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_options";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'krobs' ),
        'page_title'           => __( 'Theme Options', 'krobs' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBAycicE1b8x_pLv31OaST3vhIiCxW61kY',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */

    Redux::setSection( $opt_name, array(
        'title' => __('General Settings', 'krobs'),
        'id'         => 'general-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-cogs',
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Custom Favicon', 'krobs'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Favicon.', 'krobs'),
                'subtitle' => __('', 'krobs'),
                'default' => array('url' => get_template_directory_uri().'/images/favi.ico'),
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', 'krobs'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo.', 'krobs'),
                'subtitle' => __('', 'krobs'),
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),
            array(
                'id' => 'logo_size_width',
                'type' => 'text',
                'title' => esc_html__('Logo Size Width', 'krobs'),
                // 'subtitle' => esc_html__('', 'domik'),
                // 'desc' => esc_html__('', 'domik'),
                'default' => '138'
            ),
            array(
                'id' => 'logo_size_height',
                'type' => 'text',
                'title' => esc_html__('Logo Size Height', 'krobs'),
                // 'subtitle' => esc_html__('', 'domik'),
                // 'desc' => esc_html__('', 'domik'),
                'default' => '48'
            ),
            array(
                'id' => 'logo_text',
                'type' => 'text',
                'title' => esc_html__('Logo Text', 'krobs'),
                // 'subtitle' => esc_html__('', 'domik'),
                // 'desc' => esc_html__('', 'domik'),
                'default' => ''
            ),
            array(
                'id' => 'slogan',
                'type' => 'text',
                'title' => esc_html__('Slogan (Sub Logo Text)', 'krobs'),
                // 'subtitle' => esc_html__('', 'domik'),
                // 'desc' => esc_html__('', 'domik'),
                'default' => ''
            ),
            array(
                'id' => 'show_loader',
                'type' => 'switch',
                'title' => __('Show Animated Loader', 'krobs'),
                //'subtitle' => esc_html__('Show animation loader', 'alexon'),
                // 'desc' => '',
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => true
            ),
            array(
                'id' => 'show_menu_start',
                'type' => 'switch',
                'title' => __('Show Menu Items after loading', 'krobs'),
                //'subtitle' => esc_html__('Show animation loader', 'alexon'),
                // 'desc' => '',
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => false
            ),
            array(
                'id' => 'footer-text',
                'type' => 'editor',
                'title' => __('Footer Text', 'krobs'),
                'subtitle' => __('Footer Text on main blog page', 'krobs'),
                'default' => '<ul><li><a href="#"  target="_blank" class="transition">facebook</a></li><li><a href="#"  target="_blank" class="transition">twitter</a></li><li><a href="#"  target="_blank" class="transition">Instagram</a></li><li><a href="#"  target="_blank" class="transition">pinterest</a></li></ul>',
            ),
        ),
    ) );

    

    Redux::setSection( $opt_name, array(
        'title' => __('Styling Options', 'krobs'),
        'id'         => 'styling-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-magic',
        'fields' => array(
            array(
                'id'       => 'color-preset',
                'type'     => 'image_select',
                'title'    => __( 'Theme Color', 'krobs' ),
                'subtitle' => __( 'Select your theme color', 'krobs' ),
                'desc'     => __( 'Select your theme color', 'krobs' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'default' => array(
                        'alt' => 'Default',
                        'img' => get_template_directory_uri(). '/functions/assets/default.png'
                    ),
                    'skin2' => array(
                        'alt' => 'Red',
                        'img' => get_template_directory_uri(). '/functions/assets/skin2.png'
                    ),
                    'skin3' => array(
                        'alt' => 'Blue',
                        'img' => get_template_directory_uri(). '/functions/assets/skin3.png'
                    ),
                    'skin4' => array(
                        'alt' => 'Green',
                        'img' => get_template_directory_uri(). '/functions/assets/skin4.png'
                    ),
                    'skin5' => array(
                        'alt' => 'Yellow',
                        'img' => get_template_directory_uri(). '/functions/assets/skin5.png'
                    ),
                   
                    
                ),
                'default'  => 'default'
            ),
            array(
                'id' => 'override-preset',
                'type' => 'select',
                'title' => __('Use Your Own', 'krobs'),
                'subtitle' => __('Set this to <b>Yes</b> if you want to use colors and divider image background bellow.', 'krobs'),
                'desc' => '',
                'options' => array(
                                    'yes' => 'Yes', 
                                    'no' => 'No'
                                ), //Must provide key => value pairs for select options
                'default' => 'no'
            ),
            array(
                'id' => 'theme-color',
                'type' => 'color',
                'compiler'=> false,
                'title' => __('Theme Color', 'krobs'),
                'subtitle' => __('Pick color for the theme (default: #F56D45).', 'krobs'),
                'default' => '#F56D45',
                'validate' => 'color',
                //'mode'=>'border-color',
            ),
            
            array(
                'id' => 'body-font',
                'type' => 'typography',
                'output' => array('body'),
                'title' => __('Body Font Style', 'krobs'),
                'subtitle' => __('Specify the body font properties.</br> Default</br>font-family: Montserrat</br>font-size: 12px</br>font-weight: 400</br>color: #000000', 'krobs'),
                'google' => true,
                // 'default' => array(
                //     'color' => '#444444',
                //     'font-size' => '14px',
                //     'line-height' => '24px',
                //     'font-family' => "Open Sans",
                //     'font-weight' => '400',
                // ),
            ),
            array(
                'id' => 'navigation-font',
                'type' => 'typography',
                'output' => array('p'),
                'title' => __('Paragraph Font Style', 'krobs'),
                'subtitle' => __('Specify the pragraph font properties. Default</br>font-family: Raleway, Open Sans</br>font-size:14px</br>line-height: 21px', 'krobs'),
                'google' => true,
                // 'google' => true,
                // 'default' => array(
                //     'font-size' => '14px',
                //     'line-height' => '18px',
                //     'font-family' => "Open Sans",
                // ),
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'output' => array('h1, h2, h3, h4, h5, h6'),
                'title' => __('Headings Font Style', 'krobs'),
                'subtitle' => __('Specify the title and heading font properties.', 'krobs'),
                'google' => true,
                // 'default' => array(
                //     'color' => '#222222',
                //     'font-family' => "Open Sans",
                //     'font-weight' => '700',
                // ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('Blog Settings', 'krobs'),
        'id'         => 'blog-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-website',
        'fields' => array(
            array(
                'id'       => 'blog_layout',
                'type'     => 'image_select',
                //'compiler' => true,
                'title'    => __( 'Blog Layout', 'krobs' ),
                'subtitle' => __( 'Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'krobs' ),
                'options'  => array(
                    'fullwidth' => array(
                        'alt' => 'Fullwidth',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left_sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right_sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                ),
                'default'  => 'right_sidebar'
            ),

            array(
                'id' => 'blog_header_bg',
                'type' => 'media',
                'url' => true,
                'title' => __('Header Background', 'krobs'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Header Background', 'krobs'),
                'subtitle' => __('', 'krobs'),
                'default' => array('url' => get_template_directory_uri().'/images/bg/1.jpg'),
            ),
            array(
                'id' => 'blog_footer_bg',
                'type' => 'media',
                'url' => true,
                'title' => __('Footer Background', 'krobs'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Footer Background', 'krobs'),
                'subtitle' => __('', 'krobs'),
                'default' => array('url' => get_template_directory_uri().'/images/bg/2.jpg'),
            ),
            
            array(
                'id' => 'blog_excerpt',
                'type' => 'text',
                'title' => __('Blog custom excerpt leng', 'krobs'),
                'subtitle' => __('Input Blog custom excerpt leng', 'krobs'),
                'desc' => __('', 'krobs'),
                'default' => '40'
            ),
            array(
                'id' => 'author_checkbox',
                'type' => 'checkbox',
                'title' => __('Show author', 'krobs'),
                'subtitle' => '',
                'desc' => '',
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'date_checkbox',
                'type' => 'checkbox',
                'title' => __('Show date', 'krobs'),
                'subtitle' => '',
                'desc' => '',
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'cats_checkbox',
                'type' => 'checkbox',
                'title' => __('Show categories', 'krobs'),
                'subtitle' => '',
                'desc' => '',
                'default' => '1' // 1 = on | 0 = off
            ),
            array(
                'id' => 'tag_checkbox',
                'type' => 'checkbox',
                'title' => __('Show tag', 'krobs'),
                'subtitle' => '',
                'desc' => '',
                'default' => '1' // 1 = on | 0 = off
            ),
            array(
                'id' => 'comment_checkbox',
                'type' => 'checkbox',
                'title' => __('Show comment', 'krobs'),
                'subtitle' => '',
                'desc' => '',
                'default' => '1' // 1 = on | 0 = off
            ),
            // array(
            //     'id' => 'author_infor',
            //     'type' => 'checkbox',
            //     'title' => __('Show author information', 'krobs'),
            //     'subtitle' => __('Show information author for list post', 'krobs'),
            //     'desc' => '',
            //     'default' => '1'// 1 = on | 0 = off
            // ),
            array(
                'id' => 'share_facebook',
                'type' => 'checkbox',
                'title' => __('Show Facebook Share Post Icon', 'krobs'),
                'subtitle' => __('Show Facebook Share Post Icon', 'krobs'),
                'desc' => '',
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'share_twitter',
                'type' => 'checkbox',
                'title' => __('Show Twitter Share Post Icon', 'krobs'),
                'subtitle' => __('Show Twitter Share Post Icon', 'krobs'),
                'desc' => '',
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'share_pinterest',
                'type' => 'checkbox',
                'title' => __('Show Pinterest Share Post Icon', 'krobs'),
                'subtitle' => __('Show Pinterest Share Post Icon', 'krobs'),
                'desc' => '',
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'share_googleplus',
                'type' => 'checkbox',
                'title' => __('Show Google Plus Share Post Icon', 'krobs'),
                'subtitle' => __('Show Google Plus Share Post Icon', 'krobs'),
                'desc' => '',
                'default' => '1'// 1 = on | 0 = off
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('Blog Intro Settings', 'krobs'),
        'id'         => 'blog-intro-settings',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-font',
        'fields' => array(
            array(
                'id' => 'blog_home_text',
                'type' => 'text',
                'title' => __('Blog Heading Text', 'krobs'),
                'subtitle' => __('', 'krobs'),
                'desc' => __('', 'krobs'),
                'default' => 'Our --Blog--'
            ),
            array(
                'id' => 'blog_intro',
                'type' => 'textarea',
                'title' => __('Home Blog Intro', 'krobs'),
                'subtitle' => __('', 'krobs'),
                'desc' => __('', 'krobs'),
                'default' => 'Praesent tellus ligula, tincidunt et fringilla vel, tincidunt ut dui. Nulla feugiat, lacus ac malesuada lobortis, elit nunc congue nunc, vel imperdiet lorem leo a lectus.'
            ),
            array(
                'id' => 'archive_intro_type',
                'type' => 'select',
                'title' => __('Archive Page Intro', 'krobs'),
                'subtitle' => __('Select what type off introtext to show on archive page', 'krobs'),
                'desc' => '',
                'options' => array(
                                    '1' => 'Home Blog Intro', 
                                    '2' => 'The Description',
                                    '3' => 'None',
                                ), //Must provide key => value pairs for select options
                'default' => '2'
            ),
            array(
                'id' => 'single_intro_type',
                'type' => 'select',
                'title' => __('Single Post Intro', 'krobs'),
                'subtitle' => __('Select what type off introtext to show on single post page', 'krobs'),
                'desc' => '',
                'options' => array(
                                    '1' => 'Home Blog Intro', 
                                    '2' => 'The Excerpt',
                                    '3' => 'None',
                                ), //Must provide key => value pairs for select options
                'default' => '1'
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('Custom Code', 'krobs'),
        'id'         => 'custom-code',
        'subsection' => false,
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-file-new',
        'fields' => array(
            array(
                'id' => 'custom-css',
                'type' => 'ace_editor',
                'title' => __('CSS Code', 'krobs'),
                'subtitle' => __('Paste your CSS code here.', 'krobs'),
                'mode' => 'css',
                'compiler'=>array('body'),
                'theme' => 'monokai',
                'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                'default' => ""
            ),
        ),
    ) );


    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        // echo '<h1>The compiler hook has run!</h1>';
        // echo "<pre>";
        // print_r( $changed_values ); // Values that have changed since the last save
        // echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        $filename = get_template_directory() . '/css/overridestyle' . '.css';
        global $wp_filesystem;
        if( empty( $wp_filesystem ) ) {
            require_once( ABSPATH .'/wp-admin/includes/file.php' );
            WP_Filesystem();
        }

        if( $wp_filesystem ) {
            $wp_filesystem->put_contents(
                $filename,
                $css,
                FS_CHMOD_FILE // predefined mode settings for WP files
            );
        }

    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
