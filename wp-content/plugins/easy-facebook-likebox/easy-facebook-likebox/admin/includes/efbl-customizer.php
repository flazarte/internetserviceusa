<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Customizer code Of My Instagram Feeds
//======================================================================

if ( !class_exists( 'EFBL_Cuustomizer' ) ) {
    class EFBL_Cuustomizer
    {
        /*
         * __construct initialize all function of this class.
         * Returns nothing. 
         * Used action_hooks to get things sequentially.
         */
        function __construct()
        {
            /*
             * customize_register hook will add custom files in customizer.
             */
            add_action( 'customize_register', array( $this, 'efbl_customizer' ) );
            /*
             * customize_preview_init hook will add our js file in customizer.
             */
            add_action( 'customize_preview_init', array( $this, 'efbl_live_preview' ) );
            /*
             * customize_preview_init hook will add our js file in customizer.
             */
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'efbl_customizer_scripts' ) );
            /*
             * wp_head hooks fires when page head is load.
             * Css file will be added in head.
             */
            add_action( 'wp_head', array( $this, 'efbl_customize_css' ) );
        }
        
        /* __construct Method ends here. */
        /*
         * efbl_customizer holds cutomizer files.
         */
        function efbl_customizer_scripts()
        {
            /*
             * Enqueing customizer style file.
             */
            wp_enqueue_style( 'efbl_customizer_style', EFBL_PLUGIN_URL . 'admin/assets/css/efbl-customizer.css' );
        }
        
        /* efbl_customizer_scripts Method ends here. */
        /*
         * efbl_customizer holds code for customizer area.
         */
        public function efbl_customizer( $wp_customize )
        {
            $Feed_Them_All = new Feed_Them_All();
            /* Getting the skin id from URL and saving in option for confliction.*/
            
            if ( isset( $_GET['efbl_skin_id'] ) ) {
                $skin_id = $_GET['efbl_skin_id'];
                update_option( 'efbl_skin_id', $skin_id );
            }
            
            
            if ( isset( $_GET['efbl_account_id'] ) ) {
                $efbl_account_id = $_GET['efbl_account_id'];
                update_option( 'efbl_account_id', $efbl_account_id );
            }
            
            /* Getting back the skin saved ID.*/
            $skin_id = get_option( 'efbl_skin_id', false );
            /* Getting the saved values.*/
            $skin_values = get_option( 'efbl_skin_' . $skin_id, false );
            /* Selected layout for skin.*/
            $selected_layout = $skin_values['layout_option'];
            global  $EFBL_SKINS ;
            if ( !isset( $selected_layout ) or empty($selected_layout) ) {
                $selected_layout = 'half';
            }
            $default_func_name = 'efbl_skin_' . $selected_layout . '_values';
            $defaults = $EFBL_SKINS->{$default_func_name}();
            // echo "<pre>"; print_r($defaults);exit();
            //======================================================================
            // Easy Facebook Likebox Section
            //======================================================================
            /* Adding our efbl panel in customizer.*/
            $wp_customize->add_panel( 'efbl_customize_panel', array(
                'title' => __( 'Easy Facebook Feed', $Feed_Them_All->plug_slug ),
            ) );
            //======================================================================
            // Layout section
            //======================================================================
            /* Adding layout section in customizer under efbl panel.*/
            $wp_customize->add_section( 'efbl_layout', array(
                'title'       => __( 'Layout Settings', $Feed_Them_All->plug_slug ),
                'description' => __( 'Select the layout settings in real-time.', $Feed_Them_All->plug_slug ),
                'priority'    => 35,
                'panel'       => 'efbl_customize_panel',
            ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_layout_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Layout Settings', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_layout',
                    'description' => __( 'We are sorry, Layout settings are not included in your plan. Please upgrade to premium version to unlock following settings<ul>
                					 <li>Number Of Columns</li>
                					 <li>Show Or Hide Load More Button</li>
                					 <li>Load More Background Color</li>
                					 <li>Load More Color</li>
                					 <li>Load More Hover Background Color</li>
                					 <li>Load More Hover Color</li>
                					 </ul>', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_layout_upgrade',
                ) ) );
            }
            
            //======================================================================
            // Header section
            //======================================================================
            /* Adding layout section in customizer under efbl panel.*/
            $wp_customize->add_section( 'efbl_header', array(
                'title'       => __( 'Header', $Feed_Them_All->plug_slug ),
                'description' => __( 'Customize the Header In Real Time', $Feed_Them_All->plug_slug ),
                'priority'    => 35,
                'panel'       => 'efbl_customize_panel',
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[show_header]';
            /* Adding Setting of show or hide header.*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['show_header'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of show or hide header.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Header', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_header',
                'settings'    => $setting,
                'description' => __( 'Show or hide page header.', $Feed_Them_All->plug_slug ),
                'type'        => 'checkbox',
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[header_background_color]';
            /* Adding Setting of Header text color*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['header_background_color'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding Control of Header text color*/
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
                'label'       => __( 'Header Background Color', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_header',
                'settings'    => $setting,
                'description' => __( 'Select the background color of header.', $Feed_Them_All->plug_slug ),
            ) ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[header_text_color]';
            /* Adding Setting of Header text color*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['header_text_color'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding Control of Header text color*/
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
                'label'       => __( 'Header Text Color', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_header',
                'settings'    => $setting,
                'description' => __( 'Select the content color in header.', $Feed_Them_All->plug_slug ),
            ) ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[title_size]';
            /* Adding Setting of title size*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['title_size'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of title size.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Title Size', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_header',
                'settings'    => $setting,
                'description' => __( 'Select the text size of profile name.', $Feed_Them_All->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_dp_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Display Picture', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Show Or Hide Display Picture” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_dp_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_round_dp_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Round Display Picture', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Round Display Picture” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_round_dp_upgrade',
                ) ) );
            }
            
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[metadata_size]';
            /* Adding Setting of metadata size*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['metadata_size'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of metadata size.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Size of total followers', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_header',
                'settings'    => $setting,
                'description' => __( 'Select the text size of total followers in the header.', $Feed_Them_All->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_hide_bio_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Bio', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Show Or Hide Bio” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_hide_bio_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_color_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Text Size of Bio', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Text Size of Bio” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_color_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_color_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Header Border Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Header Border Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_color_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_style_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Style', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Border Style” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_style_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_top_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Top', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Border Top” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_top_size_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_bottom_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Bottom', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Border Bottom” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_bottom_size_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_left_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Left', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Border Left” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_left_size_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_border_right_size_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Right', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Border Right” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_border_right_size_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_padding_top_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Top', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Padding Top” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_padding_top_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_padding_bottom_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Bottom', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Padding Bottom” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_padding_bottom_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_padding_left_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Left', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Padding Left” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_padding_left_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_head_padding_right_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Padding Right', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_header',
                    'description' => __( 'We are sorry, “Padding Right” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_head_padding_right_upgrade',
                ) ) );
            }
            
            //======================================================================
            // Feed section
            //======================================================================
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[feed_background_color]';
            /* Adding Setting of Header text color*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['feed_background_color'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding Control of Header text color*/
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
                'label'       => __( 'Background Color', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Select the Background color of feed.', $Feed_Them_All->plug_slug ),
            ) ) );
            if ( 'grid' == $selected_layout || 'masonry' == $selected_layout ) {
                
                if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                } else {
                    $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_shadow_feed_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Show Or Hide Box Shadow', $Feed_Them_All->plug_slug ),
                        'section'     => 'efbl_feed',
                        'description' => __( 'We are sorry, “Show Or Hide Box Shadow” is a premium feature.', $Feed_Them_All->plug_slug ),
                        'popup_id'    => 'efbl_shadow_feed_upgrade',
                    ) ) );
                }
            
            }
            if ( 'grid' !== $selected_layout ) {
                
                if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                } else {
                    $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_header_feed_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Show Or Hide Feed Header', $Feed_Them_All->plug_slug ),
                        'section'     => 'efbl_feed',
                        'description' => __( 'We are sorry, “Show Or Hide Feed Header” is a premium feature.', $Feed_Them_All->plug_slug ),
                        'popup_id'    => 'efbl_header_feed_upgrade',
                    ) ) );
                    $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_header_feed_logo_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Show Or Hide Feed Header Logo', $Feed_Them_All->plug_slug ),
                        'section'     => 'efbl_feed',
                        'description' => __( 'We are sorry, “Show Or Hide Feed Header Logo” is a premium feature.', $Feed_Them_All->plug_slug ),
                        'popup_id'    => 'efbl_header_feed_logo_upgrade',
                    ) ) );
                }
            
            }
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_text_color_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Text Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Text Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_text_color_feed_upgrade',
                ) ) );
            }
            
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[feed_padding_top]';
            /* Adding Setting of title size*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['feed_padding_top'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of title size.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Padding Top', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Select the padding top', $Feed_Them_All->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[feed_padding_bottom]';
            /* Adding Setting of title size*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['feed_padding_bottom'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of title size.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Padding Bottom', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Select the padding bottom of feed.', $Feed_Them_All->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[feed_padding_right]';
            /* Adding Setting of title size*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['feed_padding_right'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of title size.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Padding Right', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Select the padding right for feed.', $Feed_Them_All->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[feed_padding_left]';
            /* Adding Setting of title size*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['feed_padding_left'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of title size.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Padding  Left', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Select the padding left for feed.', $Feed_Them_All->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            ) );
            
            if ( 'masonry' !== $selected_layout && 'carousel' !== $selected_layout ) {
                /* Making settings dynamic and saving data with array.*/
                $setting = 'efbl_skin_' . $skin_id . '[feed_margin_top]';
                /* Adding Setting of title size*/
                $wp_customize->add_setting( $setting, array(
                    'default'   => $defaults['feed_margin_top'],
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                /* Adding control of title size.*/
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Margin Top', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the margin top of feed.', $Feed_Them_All->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                ) );
                /* Making settings dynamic and saving data with array.*/
                $setting = 'efbl_skin_' . $skin_id . '[feed_margin_bottom]';
                /* Adding Setting of title size*/
                $wp_customize->add_setting( $setting, array(
                    'default'   => $defaults['feed_margin_bottom'],
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                /* Adding control of title size.*/
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Margin Bottom', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the margin bottom of feed.', $Feed_Them_All->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                ) );
                /* Making settings dynamic and saving data with array.*/
                $setting = 'efbl_skin_' . $skin_id . '[feed_margin_right]';
                /* Adding Setting of title size*/
                $wp_customize->add_setting( $setting, array(
                    'default'   => $defaults['feed_margin_right'],
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                /* Adding control of title size.*/
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Margin Right', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the margin left and right for feed.', $Feed_Them_All->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                ) );
                /* Making settings dynamic and saving data with array.*/
                $setting = 'efbl_skin_' . $skin_id . '[feed_margin_left]';
                /* Adding Setting of title size*/
                $wp_customize->add_setting( $setting, array(
                    'default'   => $defaults['feed_margin_left'],
                    'transport' => 'postMessage',
                    'type'      => 'option',
                ) );
                /* Adding control of title size.*/
                $wp_customize->add_control( $setting, array(
                    'label'       => __( 'Margin Left', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'settings'    => $setting,
                    'description' => __( 'Select the margin left for feed.', $Feed_Them_All->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                ) );
            } else {
                
                if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                } else {
                    $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_gutter_width_feed_upgrade', array(
                        'settings'    => array(),
                        'label'       => __( 'Gutter Width', $Feed_Them_All->plug_slug ),
                        'section'     => 'efbl_feed',
                        'description' => __( 'We are sorry, “Gutter Width” is a premium feature.', $Feed_Them_All->plug_slug ),
                        'popup_id'    => 'efbl_gutter_width_feed_upgrade',
                    ) ) );
                }
            
            }
            
            /* Adding layout section in customizer under efbl panel.*/
            $wp_customize->add_section( 'efbl_feed', array(
                'title'       => __( 'Feed', $Feed_Them_All->plug_slug ),
                'description' => __( 'Customize the Single Feed Design In Real Time', $Feed_Them_All->plug_slug ),
                'priority'    => 35,
                'panel'       => 'efbl_customize_panel',
            ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_meta_bg_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Meta Background Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Feed Meta Background Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_meta_bg_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_meta_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Meta Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Feed Meta Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_meta_feed_upgrade',
                ) ) );
            }
            
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[show_likes]';
            /* Adding Setting of show or hide Follow Button*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['show_likes'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of show or hide Follow Button.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Reactions Counter', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Show or Hide reactions counter', $Feed_Them_All->plug_slug ),
                'type'        => 'checkbox',
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[show_comments]';
            /* Adding Setting of show or hide Follow Button*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['show_comments'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of show or hide Follow Button.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Comments of feeds', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Show or Hide comments of feed', $Feed_Them_All->plug_slug ),
                'type'        => 'checkbox',
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[show_shares]';
            /* Adding Setting of show or hide Follow Button*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['show_shares'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of show or hide Follow Button.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Shares Counter', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Show or Hide shares counter', $Feed_Them_All->plug_slug ),
                'type'        => 'checkbox',
            ) );
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[show_feed_caption]';
            /* Adding Setting of show or hide Follow Button*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['show_feed_caption'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding control of show or hide Follow Button.*/
            $wp_customize->add_control( $setting, array(
                'label'       => __( 'Show Or Hide Feed Caption', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Show or Hide Caption.', $Feed_Them_All->plug_slug ),
                'type'        => 'checkbox',
            ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_icon_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Open PopUp Icon', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Show Or Hide Open PopUp Icon” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_icon_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_icon_color_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Open PopUp Icon color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Open PopUp Icon color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_icon_color_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_icon_color_feedtype_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Type Icon color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Feed Type Icon color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_icon_color_feedtype_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_cta_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Feed Call To Action Buttons', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Show Or Hide Feed Call To Action Buttons” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_cta_feed_upgrade',
                ) ) );
            }
            
            /* Making settings dynamic and saving data with array.*/
            $setting = 'efbl_skin_' . $skin_id . '[feed_cta_text_color]';
            /* Adding Setting of Header text color*/
            $wp_customize->add_setting( $setting, array(
                'default'   => $defaults['feed_cta_text_color'],
                'transport' => 'postMessage',
                'type'      => 'option',
            ) );
            /* Adding Control of Header text color*/
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
                'label'       => __( 'Call To Action color', $Feed_Them_All->plug_slug ),
                'section'     => 'efbl_feed',
                'settings'    => $setting,
                'description' => __( 'Select the color of links like (Share and Read Full Story).', $Feed_Them_All->plug_slug ),
            ) ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_cta_hover_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Call To Action Hover color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Call To Action Hover color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_cta_hover_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_bg_hover_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Hover Shadow Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Feed Hover Shadow Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_bg_hover_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_border_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Feed Border Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Feed Border Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_border_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_bordersize_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Size', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Border Size” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_bordersize_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_borderstyle_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Border Style', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Border Style” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_borderstyle_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_shared_link_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Show Or Hide Shared Link Data', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Show Or Hide Shared Link Data” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_shared_link_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_shared_linkbg_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Shared Link Background Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Shared Link Background Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_shared_linkbg_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_shared_linkhead_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Shared Link Heading Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Shared Link Heading Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_shared_linkhead_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_shared_linktext_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Shared Link Content Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Shared Link Content Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_shared_linktext_feed_upgrade',
                ) ) );
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_shared_linkborder_feed_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Shared Link Border Color', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_feed',
                    'description' => __( 'We are sorry, “Shared Link Border Color” is a premium feature.', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_shared_linkborder_feed_upgrade',
                ) ) );
            }
            
            //======================================================================
            // PopUP section
            //======================================================================
            /* Adding layout section in customizer under efbl panel.*/
            $wp_customize->add_section( 'efbl_popup', array(
                'title'       => __( 'Media lightbox', $Feed_Them_All->plug_slug ),
                'description' => __( 'Customize the PopUp In Real Time', $Feed_Them_All->plug_slug ),
                'priority'    => 35,
                'panel'       => 'efbl_customize_panel',
            ) );
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $wp_customize->add_control( new Customize_EFBL_PopUp( $wp_customize, 'efbl_popup_popup_upgrade', array(
                    'settings'    => array(),
                    'label'       => __( 'Media Lightbox Settings', $Feed_Them_All->plug_slug ),
                    'section'     => 'efbl_popup',
                    'description' => __( 'We are sorry, Media Lightbox Settings are not included in your plan. Please upgrade to premium version to unlock following settings<ul>
                					 <li>Sidebar Background Color</li>
                					 <li>Sidebar Content Color</li>
                					 <li>Show Or Hide PopUp Header</li>
                					 <li>Show Or Hide Header Logo</li>
                					 <li>Header Title Color</li>
                					 <li>Post Time Color</li>
                					 <li>Show Or Hide Caption</li>
                					 <li>Show Or Hide Meta Section</li>
                					 <li>Meta Background Color</li>
                					 <li>Meta Content Color</li>
                					 <li>Show Or Hide Reactions Counter</li>
                					 <li>Show Or Hide Comments Counter</li>
                					 <li>Show Or Hide View On Facebook Link</li>
                					 <li>Show Or Hide Comments</li>
                					 <li>Comments Background Color</li>
                					 <li>Comments Color</li>
                					 <li>Show Or Hide Close Icon</li>
                					 <li>Close Icon Background Color</li>
                					 <li>Close Icon Color</li>
                					 <li>Close Icon Hover Background Color</li>
                					 <li>Close Icon Hover Color</li>
                					 </ul>', $Feed_Them_All->plug_slug ),
                    'popup_id'    => 'efbl_popup_popup_upgrade',
                ) ) );
            }
        
        }
        
        /* efbl_customizer Method ends here. */
        /**
         * Used by hook: 'customize_preview_init'
         * 
         * @see add_action('customize_preview_init',$func)
         */
        public function efbl_live_preview()
        {
            /* Getting saved skin id. */
            $skin_id = get_option( 'efbl_skin_id', false );
            /* Enqueing script for displaying live changes. */
            wp_enqueue_script(
                'efbl_live_preview',
                EFBL_PLUGIN_URL . 'admin/assets/js/efbl-live-preview.js',
                array( 'jquery', 'customize-preview' ),
                true
            );
            /* Localizing script for getting skin id in js. */
            wp_localize_script( 'efbl_live_preview', 'efbl_skin_id', $skin_id );
        }
        
        /* efbl_live_preview Method ends here. */
        /* mif_style Method ends here. */
        /*
         * efbl_customize_css will add the styling to the head of the site.
         */
        public function efbl_customize_css()
        {
            /*
             * Getting all the skins.
             */
            global  $efbl_skins ;
            // echo "<pre>"; print_r($efbl_skins);exit();
            /*
             * Intializing mif css variable.
             */
            $efbl_css = null;
            $efbl_css = '<style type="text/css">';
            /*
             * Getting skins exists loop thorugh it.
             */
            if ( isset( $efbl_skins ) ) {
                foreach ( $efbl_skins as $efbl_skin ) {
                    $selected_layout = $efbl_skin['design']['layout_option'];
                    $skinn_id = $efbl_skin['ID'];
                    $no_of_cols = get_option( 'efbl_skin_' . $skinn_id, false );
                    if ( isset( $no_of_cols['number_of_cols'] ) ) {
                        $no_of_cols = $no_of_cols['number_of_cols'];
                    }
                    /*
                     * If header is enabled and layout is not full width.
                     */
                    
                    if ( !empty($efbl_skin['design']['show_header']) ) {
                        $mif_header_display = 'block';
                    } else {
                        $mif_header_display = 'none';
                    }
                    
                    /*
                     * Background color of the skin.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header { display: ' . $mif_header_display . '; }';
                    /*
                     * Header Size.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header_meta .efbl_header_title { font-size: ' . $efbl_skin['design']['title_size'] . 'px; }';
                    /*
                     * If likes needs to show.
                     */
                    
                    if ( !empty($efbl_skin['design']['show_likes']) ) {
                        $efbl_show_likes = 'inline-block';
                    } else {
                        $efbl_show_likes = 'none';
                    }
                    
                    /*
                     * Show number of feeds counter.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . '  .efbl_likes,  .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . '  .efbl_story_meta .efbl_story_lnc_holder  .efbl_all_likes_wrap { display: ' . $efbl_show_likes . '; }';
                    /*
                     * If shares needs to show.
                     */
                    
                    if ( !empty($efbl_skin['design']['show_shares']) ) {
                        $efbl_show_shares = 'inline-block';
                    } else {
                        $efbl_show_shares = 'none';
                    }
                    
                    /*
                     * Show number of shares counter.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . '  .efbl_shares { display: ' . $efbl_show_shares . '; }';
                    /*
                     * If comments needs to show.
                     */
                    
                    if ( !empty($efbl_skin['design']['show_comments']) ) {
                        $efbl_show_comments = 'inline-block';
                    } else {
                        $efbl_show_comments = 'none';
                    }
                    
                    /*
                     * Show number of feeds counter.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . '   .efbl_comments { display: ' . $efbl_show_comments . '; }';
                    /*
                     * If follow button is enabled.
                     */
                    
                    if ( !empty($efbl_skin['design']['show_follow_btn']) ) {
                        $mif_follow_btn_display = 'inline-block';
                    } else {
                        $mif_follow_btn_display = 'none';
                    }
                    
                    /*
                     * Show Follow Button.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .mif_follow_btn { display: ' . $mif_follow_btn_display . '; }';
                    /*
                     * If feed caption is enabled.
                     */
                    
                    if ( !empty($efbl_skin['design']['show_feed_caption']) ) {
                        $efbl_show_feed_caption = 'block';
                    } else {
                        $efbl_show_feed_caption = 'none';
                    }
                    
                    /*
                     * Show caption
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf .efbl_story_text { display: ' . $efbl_show_feed_caption . '; }';
                    /*
                     * Header Size.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_header_title { font-size: ' . $efbl_skin['design']['title_size'] . 'px; }';
                    /*
                     * Meta data Size.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_posts,.efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_followers { font-size: ' . $efbl_skin['design']['metadata_size'] . 'px; }';
                    /*
                     * Header background Color.
                     */
                    $efbl_css .= '.efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header { background-color: ' . $efbl_skin['design']['header_background_color'] . '; }';
                    /*
                     * Header Color.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header, .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_posts, .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_followers, .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_bio, .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_header .mif_header_title { color: ' . $efbl_skin['design']['header_text_color'] . '; }';
                    /*
                     * Feed CTA Color.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_read_more_link a { color: ' . $efbl_skin['design']['feed_cta_text_color'] . '; }';
                    /*
                     * Background color of feed.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story { background-color: ' . $efbl_skin['design']['feed_background_color'] . ' !important; }';
                    /*
                     * Feed Padding Top.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf { padding-top: ' . $efbl_skin['design']['feed_padding_top'] . 'px; }';
                    /*
                     * Feed Padding Bottom.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf {padding-bottom: ' . $efbl_skin['design']['feed_padding_bottom'] . 'px; }';
                    /*
                     * Feed Padding left.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf { padding-left: ' . $efbl_skin['design']['feed_padding_left'] . 'px; }';
                    /*
                     * Feed Padding right.
                     */
                    $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf {padding-right: ' . $efbl_skin['design']['feed_padding_right'] . 'px; }';
                    
                    if ( 'masonry' !== $selected_layout && 'carousel' !== $selected_layout ) {
                        /*
                         * Feed Margin Top.
                         */
                        $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf { margin-top: ' . $efbl_skin['design']['feed_margin_top'] . 'px; }';
                        /*
                         * Feed Margin Bottom.
                         */
                        $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf { margin-bottom: ' . $efbl_skin['design']['feed_margin_bottom'] . 'px; }';
                        /*
                         * Feed Margin Left.
                         */
                        $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf { margin-left: ' . $efbl_skin['design']['feed_margin_left'] . 'px; }';
                        /*
                         * Feed Margin Right.
                         */
                        $efbl_css .= ' .efbl_feed_wraper.efbl_skin_' . $efbl_skin['ID'] . ' .efbl_fb_story#efblcf {margin-right: ' . $efbl_skin['design']['feed_margin_right'] . 'px; }';
                    }
                
                }
            }
            $efbl_css .= '</style>';
            //      echo "<pre>";
            // print_r($efbl_css);exit();
            echo  $efbl_css ;
        }
    
    }
    /* EFBL_Cuustomizer Class ends here. */
    $EFBL_Cuustomizer = new EFBL_Cuustomizer();
}
