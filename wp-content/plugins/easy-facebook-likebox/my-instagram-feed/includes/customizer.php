<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================//
// Customizer code Of Feed Them All //
//======================================================================//

if ( !class_exists( "MIF_CUSTOMIZER" ) ) {
    class MIF_CUSTOMIZER
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
            add_action( 'customize_register', array( $this, 'mif_customizer' ) );
            /*
             * customize_preview_init hook will add our js file in customizer.
             */
            add_action( 'customize_preview_init', array( $this, 'mif_live_preview' ) );
            /*
             * customize_preview_init hook will add our js file in customizer.
             */
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'mif_customizer_scripts' ) );
        }
        
        /* __construct Method ends here. */
        /*
         * fta_customizer_scripts holds cutomizer files.
         */
        function mif_customizer_scripts()
        {
            /*
             * Enqueing customizer style file.
             */
            if ( !wp_style_is( 'mif_customizer_style', 'enqueued' ) ) {
                wp_enqueue_style( 'mif_customizer_style', MIF_PLUGIN_URL . 'assets/css/mif_customizer_style.css' );
            }
        }
        
        /* fta_customizer_scripts Method ends here. */
        /*
         * fta_customizer holds code for customizer area.
         */
        public function mif_customizer( $wp_customize )
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            /* Getting the skin id from URL and saving in option for confliction.*/
            
            if ( isset( $_GET['mif_skin_id'] ) ) {
                $skin_id = $_GET['mif_skin_id'];
                update_option( 'efbl_skin_id', $skin_id );
            }
            
            /* Getting the skin id from URL and saving in option for confliction.*/
            
            if ( isset( $_GET['mif_account_id'] ) ) {
                $mif_account_id = $_GET['mif_account_id'];
                update_option( 'mif_account_id', $mif_account_id );
            }
            
            /* Getting back the skin saved ID.*/
            $skin_id = get_option( 'efbl_skin_id', false );
            /* Adding Feed Them All Panel in customizer.*/
            $wp_customize->add_panel( 'mif_skins_panel', array(
                'title' => __( 'Easy Instagram Feed', $FTA->plug_slug ),
            ) );
            /*
             * Getting all the section for Feed Them All Panel.
             */
            $mif_skins_sections = $this->mif_skins_sections();
            /*
             * Checking if any section exists, Adding into customize manager factory one by one. Use fta_skins_sections filter to add or remove your own sections.
             */
            if ( isset( $mif_skins_sections ) ) {
                foreach ( $mif_skins_sections as $section ) {
                    $wp_customize->add_section( $section['id'], array(
                        'title'       => $section['title'],
                        'description' => $section['description'],
                        'priority'    => 100,
                        'panel'       => 'mif_skins_panel',
                    ) );
                }
            }
            /*
             * Getting all the Settings for Feed Them All.
             */
            $mif_skins_settings = $this->mif_skins_settings();
            /*
             * Checking if any setting exists, Adding into customize manager factory one by one. Use fta_skins_settings filter to add or remove your own settings.
             */
            if ( isset( $mif_skins_settings ) ) {
                foreach ( $mif_skins_settings as $setting ) {
                    /*
                     * Getting the type of setting.
                     */
                    $type = $setting['type'];
                    /*
                     * Getting the ID of setting.
                     */
                    $id = $setting['id'];
                    /*
                     * Adding the settings according to the type.
                     */
                    switch ( $type ) {
                        /* If setting type is radio or selectbox. */
                        case "select":
                        case "radio":
                            $transport = 'postMessage';
                            if ( 'mif_skin_' . $skin_id . '[layout_option]' == $id ) {
                                $transport = 'refresh';
                            }
                            if ( 'mif_skin_' . $skin_id . '[number_of_cols]' == $id ) {
                                $transport = 'refresh';
                            }
                            // echo "<pre>"; print_r($mif_skins_settings);exit();
                            $wp_customize->add_setting( $id, array(
                                'default'   => $setting['default'],
                                'transport' => $transport,
                                'type'      => 'option',
                            ) );
                            /* Adding control of number of columns if layout set to grid.*/
                            $wp_customize->add_control( $id, array(
                                'label'       => $setting['label'],
                                'section'     => $setting['section'],
                                'settings'    => $id,
                                'description' => $setting['description'],
                                'type'        => $type,
                                'choices'     => $setting['choices'],
                            ) );
                            break;
                            /* If setting type is checkbox. */
                        /* If setting type is checkbox. */
                        case "checkbox":
                            $transport = 'postMessage';
                            if ( 'mif_skin_' . $skin_id . '[loop]' == $id ) {
                                $transport = 'refresh';
                            }
                            if ( 'mif_skin_' . $skin_id . '[autoplay]' == $id ) {
                                $transport = 'refresh';
                            }
                            $wp_customize->add_setting( $id, array(
                                'default'   => $setting['default'],
                                'transport' => $transport,
                                'type'      => 'option',
                            ) );
                            /* Adding control of show or hide Follow Button.*/
                            $wp_customize->add_control( $id, array(
                                'label'       => $setting['label'],
                                'section'     => $setting['section'],
                                'settings'    => $id,
                                'description' => $setting['description'],
                                'type'        => $type,
                            ) );
                            break;
                            /* If setting type is Color Picker. */
                        /* If setting type is Color Picker. */
                        case "color_picker":
                            $wp_customize->add_setting( $id, array(
                                'default'   => $setting['default'],
                                'transport' => 'postMessage',
                                'type'      => 'option',
                            ) );
                            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
                                'label'       => $setting['label'],
                                'section'     => $setting['section'],
                                'settings'    => $id,
                                'description' => $setting['description'],
                            ) ) );
                            break;
                            /* If setting type is number. */
                        /* If setting type is number. */
                        case "range":
                            $wp_customize->add_setting( $id, array(
                                'default'   => $setting['default'],
                                'transport' => 'postMessage',
                                'type'      => 'option',
                            ) );
                            /* Adding control of show or hide Follow Button.*/
                            $wp_customize->add_control( $id, array(
                                'label'       => $setting['label'],
                                'section'     => $setting['section'],
                                'settings'    => $id,
                                'description' => $setting['description'],
                                'type'        => $type,
                                'input_attrs' => $setting['input_attrs'],
                            ) );
                            break;
                            /* If setting type is Color Picker with opacity. */
                        /* If setting type is Color Picker with opacity. */
                        case "color_picker_alpha":
                            $wp_customize->add_setting( $id, array(
                                'default'   => $setting['default'],
                                'transport' => 'postMessage',
                                'type'      => 'option',
                            ) );
                            /* Adding control of show or hide Follow Button.*/
                            $wp_customize->add_control( new Customize_Alpha_Color_Control( $wp_customize, $id, array(
                                'label'        => $setting['label'],
                                'section'      => $setting['section'],
                                'settings'     => $id,
                                'description'  => $setting['description'],
                                'type'         => $type,
                                'show_opacity' => $setting['show_opacity'],
                                'palette'      => $setting['palette'],
                            ) ) );
                            break;
                            /* If setting type is popup. */
                        /* If setting type is popup. */
                        case "popup":
                            $wp_customize->add_control( new Customize_MIF_PopUp( $wp_customize, $id, array(
                                'label'       => $setting['label'],
                                'settings'    => array(),
                                'section'     => $setting['section'],
                                'description' => $setting['description'],
                                'icon'        => $setting['icon'],
                                'popup_id'    => $id,
                            ) ) );
                            break;
                            /* If setting type is not defined add a text field. */
                        /* If setting type is not defined add a text field. */
                        default:
                            $transport = 'postMessage';
                            if ( 'mif_skin_' . $skin_id . '[gutter_width]' == $id ) {
                                $transport = 'refresh';
                            }
                            $wp_customize->add_setting( $id, array(
                                'default'   => $setting['default'],
                                'transport' => $transport,
                                'type'      => 'option',
                            ) );
                            /* Adding control of number of columns if layout set to grid.*/
                            $wp_customize->add_control( $id, array(
                                'label'       => $setting['label'],
                                'section'     => $setting['section'],
                                'settings'    => $id,
                                'description' => $setting['description'],
                                'type'        => $type,
                            ) );
                    }
                    /* Switch statement ends here. */
                }
            }
            /* Settings Loop ends here. */
        }
        
        /* fta_customizer Method ends here. */
        /*
         * fta_skins_settings holds All the settings of Feed Them All Skins
         */
        private function mif_skins_sections()
        {
            /*
             * Calling main method of plugin
             */
            $FTA = new Feed_Them_All();
            /*
             * All the scetions for FTA Skins.
             */
            $sections = array(
                'mif_layout' => array(
                'id'          => 'mif_layout',
                'title'       => __( 'Layout', $FTA->plug_slug ),
                'description' => __( 'Select the Layout in real time.', $FTA->plug_slug ),
                'priority'    => 35,
            ),
                'mif_header' => array(
                'id'          => 'mif_header',
                'title'       => __( 'Header', $FTA->plug_slug ),
                'description' => __( 'Customize the Header In Real Time', $FTA->plug_slug ),
                'priority'    => 35,
            ),
                'mif_feed'   => array(
                'id'          => 'mif_feed',
                'title'       => __( 'Feed', $FTA->plug_slug ),
                'description' => __( 'Customize the Single Feed Design In Real Time', $FTA->plug_slug ),
                'priority'    => 35,
            ),
                'mif_popup'  => array(
                'id'          => 'mif_popup',
                'title'       => __( 'Media lightbox', $FTA->plug_slug ),
                'description' => __( 'Customize the PopUp In Real Time', $FTA->plug_slug ),
                'priority'    => 35,
            ),
            );
            /*
             * Use fta_skins_sections filter to add new sections into the skins.
             * Returning back all the sections.
             */
            return $sections = apply_filters( 'mif_skins_sections', $sections );
        }
        
        /* fta_skins_sections Method ends here. */
        /*
         * mif_skins_sections holds All the settings of Feed Them All Skins
         */
        private function mif_skins_settings()
        {
            /*
             * Calling main method of plugin
             */
            $FTA = new Feed_Them_All();
            /* Getting the skin id from URL and saving in option for confliction.*/
            
            if ( isset( $_GET['mif_skin_id'] ) ) {
                $skin_id = $_GET['mif_skin_id'];
                update_option( 'mif_skin_id', $skin_id );
            }
            
            /* Getting back the skin saved ID.*/
            $skin_id = get_option( 'mif_skin_id', false );
            /* Getting the saved values.*/
            $skin_values = get_option( 'mif_skin_' . $skin_id, false );
            /* Selected layout for skin.*/
            $selected_layout = $skin_values['layout_option'];
            global  $MIF_SKINS ;
            if ( !isset( $selected_layout ) or empty($selected_layout) ) {
                $selected_layout = 'grid';
            }
            $default_func_name = 'mif_skin_' . $selected_layout . '_values';
            $defaults = $MIF_SKINS->{$default_func_name}();
            // echo "<pre>"; print_r( $defaults);exit();
            /*
             * Adding all the settings
             */
            $settings = array();
            $mif_layout = 'mif_layout';
            $mif_header = 'mif_header';
            $mif_popup_sec = 'mif_popup';
            
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $mif_layout = 'mif_layoutsa';
                $mif_header = 'mif_headersa';
                $mif_popup_sec = 'mif_popupsa';
            }
            
            if ( 'grid' == $selected_layout || 'carousel' == $selected_layout || 'masonary' == $selected_layout ) {
                $settings['mif_skin_' . $skin_id . '[number_of_cols]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[number_of_cols]',
                    'default'     => $defaults['number_of_cols'],
                    'label'       => __( 'Number of columns', $FTA->plug_slug ),
                    'section'     => 'mif_layout',
                    'description' => __( "Select the number of columns for feeds.", $FTA->plug_slug ),
                    'type'        => 'select',
                    'choices'     => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ),
                );
            }
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_layout_btns_upgrade'] = array(
                    'id'          => 'mif_layout_btns_upgrade',
                    'icon'        => 'color_lens',
                    'label'       => __( 'Buttons Settings', $FTA->plug_slug ),
                    'section'     => $mif_layout,
                    'description' => __( "We are sorry, Buttons settings are not included in your plan. Please upgrade to premium version to unlock following settings<ul>\n                                     <li>Show Follow Button</li>\n                                     <li>Follow button Background Color</li>\n                                     <li>Follow button Color</li>\n                                     <li>Follow Hover Background Color</li>\n                                     <li>Follow Hover Color</li>\n                                     <li>Show Load More Button</li>\n                                     <li>Load More Background Color</li>\n                                     <li>Load More Color</li>\n                                     <li>Load More Hover Background Color</li>\n                                     <li>Load More Hover Color</li>\n                                     </ul>", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            $settings['mif_skin_' . $skin_id . '[show_header]'] = array(
                'id'          => 'mif_skin_' . $skin_id . '[show_header]',
                'default'     => $defaults['show_header'],
                'label'       => __( 'Show Header', $FTA->plug_slug ),
                'section'     => 'mif_header',
                'description' => __( 'Show or Hide header.', $FTA->plug_slug ),
                'type'        => 'checkbox',
            );
            $settings['mif_skin_' . $skin_id . '[header_background_color]'] = array(
                'id'          => 'mif_skin_' . $skin_id . '[header_background_color]',
                'default'     => $defaults['header_background_color'],
                'label'       => __( 'Header Background Color', $FTA->plug_slug ),
                'section'     => 'mif_header',
                'description' => __( 'Select the background color of header.', $FTA->plug_slug ),
                'type'        => 'color_picker',
            );
            $settings['mif_skin_' . $skin_id . '[header_text_color]'] = array(
                'id'          => 'mif_skin_' . $skin_id . '[header_text_color]',
                'default'     => $defaults['header_text_color'],
                'label'       => __( 'Header Text Color', $FTA->plug_slug ),
                'section'     => 'mif_header',
                'description' => __( 'Select the content color which are displaying in header.', $FTA->plug_slug ),
                'type'        => 'color_picker',
            );
            $settings['mif_skin_' . $skin_id . '[title_size]'] = array(
                'id'          => 'mif_skin_' . $skin_id . '[title_size]',
                'default'     => $defaults['title_size'],
                'label'       => __( 'Title Size', $FTA->plug_slug ),
                'section'     => 'mif_header',
                'description' => __( 'Select the text size of profile name.', $FTA->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            );
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_head_settings_upgrade'] = array(
                    'id'          => 'mif_head_settings_upgrade',
                    'icon'        => 'color_lens',
                    'label'       => __( 'More Settings?', $FTA->plug_slug ),
                    'section'     => $mif_header,
                    'description' => __( "We are sorry, More header settings are not included in your plan. Please upgrade to premium version to unlock following settings<ul>\n                                     <li>Show Or Hide Display Picture</li>\n                                     <li>Round Display Picture</li>\n                                     <li>Display Picture Hover Shadow Color</li>\n                                     <li>Display Picture Hover Icon color</li>\n                                     <li>Show Total Number Of Feeds</li>\n                                     <li>Show Total Number Of Followers</li>\n                                     <li>Show or Hide Bio</li>\n                                     <li>Text Size of Bio</li>\n                                     <li>Header Border Color</li>\n                                     <li>Border Style</li>\n                                     <li>Show Display Picture</li>\n                                     <li>Border Top Size</li>\n                                     <li>Border Bottom Size</li>\n                                     <li>Border Left Size</li>\n                                     <li>Border Right Size</li>\n                                     <li>Padding Top</li>\n                                     <li>Padding Bottom</li>\n                                     <li>Padding Left</li>\n                                     <li>Padding Right</li>\n                                     <li>Header Alignment eg. Left, Right and Center</li>\n                                     </ul>", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            $settings['mif_skin_' . $skin_id . '[metadata_size]'] = array(
                'id'          => 'mif_skin_' . $skin_id . '[metadata_size]',
                'default'     => $defaults['metadata_size'],
                'label'       => __( 'Size of Total Posts And Followers', $FTA->plug_slug ),
                'section'     => 'mif_header',
                'description' => __( 'Select the text size of total posts and followers which are displaying in header. Please upgrade to premium version to unlock this and other cool features.', $FTA->plug_slug ),
                'type'        => 'number',
                'input_attrs' => array(
                'min' => 0,
                'max' => 100,
            ),
            );
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                $settings['mif_skin_' . $skin_id . '[feed_background_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_background_color]',
                    'default'     => $defaults['feed_background_color'],
                    'label'       => __( 'Background Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the Background color of feed.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
            }
            $mif_feed = 'mif_feed';
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $mif_feed = 'mif_feeddsa';
            }
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_feed_image_filter_popup'] = array(
                    'id'          => 'mif_feed_image_filter_popup',
                    'icon'        => 'color_lens',
                    'label'       => __( 'Image Filter', $FTA->plug_slug ),
                    'section'     => $mif_feed,
                    'description' => __( "We're sorry, Image Filter feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            // echo "<pre>";  print_r($settings); exit();
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_feed_gutter_popup'] = array(
                    'id'          => 'mif_feed_gutter_popup',
                    'icon'        => 'description',
                    'label'       => __( 'Gutter Width', $FTA->plug_slug ),
                    'section'     => $mif_feed,
                    'description' => __( "We are sorry, “Gutter Width” is a premium feature. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                $settings['mif_skin_' . $skin_id . '[feed_padding_top]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_padding_top]',
                    'default'     => $defaults['feed_padding_top'],
                    'label'       => __( 'Padding from top', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the padding top of feed.', $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_padding_bottom]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_padding_top_bottom]',
                    'default'     => $defaults['feed_padding_top_bottom'],
                    'label'       => __( 'Padding from Bottom', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the padding bottom of feed.', $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_padding_left]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_padding_left]',
                    'default'     => $defaults['feed_padding_left'],
                    'label'       => __( 'Padding Left', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the padding left for feed.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_padding_right]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_padding_right]',
                    'default'     => $defaults['feed_padding_right'],
                    'label'       => __( 'Padding Right', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the padding right for feed.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
            }
            
            
            if ( 'masonary' != $selected_layout && 'carousel' != $selected_layout ) {
                $settings['mif_skin_' . $skin_id . '[feed_margin_top]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_margin_top]',
                    'default'     => $defaults['feed_margin_top'],
                    'label'       => __( 'Margin Top', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the margin top of feed i.e. doesn't work with Masonary layout.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_margin_bottom]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_margin_bottom]',
                    'default'     => $defaults['feed_margin_bottom'],
                    'label'       => __( 'Margin Bottom', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the margin bottom of feed i.e. doesn't work with Masonary layout.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_margin_left]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_margin_left]',
                    'default'     => $defaults['feed_margin_left'],
                    'label'       => __( 'Margin Left', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the margin Left of feed i.e. doesn't work with Masonary layout.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_margin_right]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_margin_right]',
                    'default'     => $defaults['feed_margin_right'],
                    'label'       => __( 'Margin Right', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the margin Right of feed i.e. doesn't work with Masonary layout.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
            }
            
            
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                // echo '<pre>'; print_r($mif_feed);exit;
                if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                    $settings['mif_feed_show_likes_popup'] = array(
                        'id'          => 'mif_feed_show_likes_popup',
                        'icon'        => 'favorite_border',
                        'label'       => __( 'Show Hearts of feeds', $FTA->plug_slug ),
                        'section'     => $mif_feed,
                        'description' => __( "We're sorry, Show or hide hearts of feeds is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                        'type'        => 'popup',
                    );
                }
                $settings['mif_skin_' . $skin_id . '[feed_likes_bg_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_likes_bg_color]',
                    'default'     => $defaults['feed_likes_bg_color'],
                    'label'       => __( 'Likes Background Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the background color of likes.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                $settings['mif_skin_' . $skin_id . '[feed_likes_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_likes_color]',
                    'default'     => $defaults['feed_likes_color'],
                    'label'       => __( 'Likes Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the color of likes.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                    $settings['mif_show_comments_popup'] = array(
                        'id'          => 'mif_show_comments_popup',
                        'icon'        => 'mode_comment',
                        'label'       => __( 'Show Comments of feeds', $FTA->plug_slug ),
                        'section'     => $mif_feed,
                        'description' => __( "We're sorry, Show or hide comments of feeds is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                        'type'        => 'popup',
                    );
                }
                $settings['mif_skin_' . $skin_id . '[feed_comments_bg_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_comments_bg_color]',
                    'default'     => $defaults['feed_comments_bg_color'],
                    'label'       => __( 'Comments Background Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the background color of comments.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                $settings['mif_skin_' . $skin_id . '[feed_comments_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_comments_color]',
                    'default'     => $defaults['feed_comments_color'],
                    'label'       => __( 'Comments Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the color of comments.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                    $settings['mif_feed_caption_popup'] = array(
                        'id'          => 'mif_feed_caption_popup',
                        'icon'        => 'description',
                        'label'       => __( 'Show Feed Caption', $FTA->plug_slug ),
                        'section'     => $mif_feed,
                        'description' => __( "We're sorry, Show or hide caption of feeds is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                        'type'        => 'popup',
                    );
                }
                $settings['mif_skin_' . $skin_id . '[caption_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[caption_color]',
                    'default'     => $defaults['caption_color'],
                    'label'       => __( 'Caption Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the feed caption color.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
            }
            
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_feed_open_popup_icon_popup'] = array(
                    'id'          => 'mif_feed_open_popup_icon_popup',
                    'icon'        => 'add',
                    'label'       => __( 'Show Open PopUp Icon', $FTA->plug_slug ),
                    'section'     => $mif_feed,
                    'description' => __( "We're sorry, Show or hide open popup icon is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            $settings['mif_skin_' . $skin_id . '[popup_icon_color]'] = array(
                'id'          => 'mif_skin_' . $skin_id . '[popup_icon_color]',
                'default'     => $defaults['popup_icon_color'],
                'label'       => __( 'Open PopUp Icon color', $FTA->plug_slug ),
                'section'     => 'mif_feed',
                'description' => __( 'Select the icon color which shows on feed hover to open popup.', $FTA->plug_slug ),
                'type'        => 'color_picker',
            );
            
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                    $settings['mif_feed_cta_popup'] = array(
                        'id'          => 'mif_feed_cta_popup',
                        'icon'        => 'favorite_border',
                        'label'       => __( 'Show Feed Call To Action Buttons', $FTA->plug_slug ),
                        'section'     => $mif_feed,
                        'description' => __( "We're sorry, Show or hide call to action buttons is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                        'type'        => 'popup',
                    );
                }
                $settings['mif_skin_' . $skin_id . '[feed_cta_text_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_cta_text_color]',
                    'default'     => $defaults['feed_cta_text_color'],
                    'label'       => __( 'Call To Action color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the color of links like(Share and View on Instagram).', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                $settings['mif_skin_' . $skin_id . '[feed_cta_text_hover_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_cta_text_hover_color]',
                    'default'     => $defaults['feed_cta_text_hover_color'],
                    'label'       => __( 'Call To Action Hover color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the hover color of links like(Share and View on Instagram).', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                $settings['mif_skin_' . $skin_id . '[feed_time_text_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_time_text_color]',
                    'default'     => $defaults['feed_time_text_color'],
                    'label'       => __( 'Feed Time Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the color of feed created time.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
            }
            
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_feed_hover_bg_popup'] = array(
                    'id'          => 'mif_feed_hover_bg_popup',
                    'icon'        => 'favorite_border',
                    'label'       => __( 'Feed Hover Shadow Color', $FTA->plug_slug ),
                    'section'     => $mif_feed,
                    'description' => __( "We're sorry, Feed Hover Shadow Color is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            
            if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                $settings['mif_skin_' . $skin_id . '[feed_seprator_color]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_seprator_color]',
                    'default'     => $defaults['feed_seprator_color'],
                    'label'       => __( 'Feed Seprator Color', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( 'Select the color of feed Seprator.', $FTA->plug_slug ),
                    'type'        => 'color_picker',
                );
                $settings['mif_skin_' . $skin_id . '[feed_border_size]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_border_size]',
                    'default'     => $defaults['feed_border_size'],
                    'label'       => __( 'Border Size', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the border size for feeds.", $FTA->plug_slug ),
                    'type'        => 'number',
                    'input_attrs' => array(
                    'min' => 0,
                    'max' => 100,
                ),
                );
                $settings['mif_skin_' . $skin_id . '[feed_border_style]'] = array(
                    'id'          => 'mif_skin_' . $skin_id . '[feed_border_style]',
                    'default'     => $defaults['feed_border_style'],
                    'label'       => __( 'Border Style', $FTA->plug_slug ),
                    'section'     => 'mif_feed',
                    'description' => __( "Select the border style for feeds.", $FTA->plug_slug ),
                    'type'        => 'select',
                    'choices'     => array(
                    'solid'  => 'Solid',
                    'dashed' => 'Dashed',
                    'dotted' => 'Dotted',
                    'double' => 'Double',
                    'groove' => 'Groove',
                    'ridge'  => 'Ridge',
                    'inset'  => 'Inset',
                    'outset' => 'Outset',
                    'none'   => 'None',
                ),
                );
            }
            
            if ( !efl_fs()->is_plan( 'instagram_premium', true ) or !efl_fs()->is_plan( 'combo_premium', true ) ) {
                $settings['mif_lightbox_popup'] = array(
                    'id'          => 'mif_lightbox_popup',
                    'icon'        => 'favorite_border',
                    'label'       => __( 'Media Lightbox Settings', $FTA->plug_slug ),
                    'section'     => $mif_popup_sec,
                    'description' => __( "We are sorry, Media Lightbox Settings are not included in your plan. Please upgrade to premium version to unlock following settings<ul>\n                                         <li>Sidebar Background Color</li>\n                                         <li>Sidebar Content Color</li>\n                                         <li>Show Or Hide PopUp Header</li>\n                                         <li>Show Or Hide Header Logo</li>\n                                         <li>Header Title Color</li>\n                                         <li>Post Time Color</li>\n                                         <li>Show Or Hide Caption</li>\n                                         <li>Show Or Hide Meta Section</li>\n                                         <li>Meta Background Color</li>\n                                         <li>Meta Content Color</li>\n                                         <li>Show Or Hide Reactions Counter</li>\n                                         <li>Show Or Hide Comments Counter</li>\n                                         <li>Show Or Hide View On Facebook Link</li>\n                                         <li>Show Or Hide Comments</li>\n                                         <li>Comments Background Color</li>\n                                         <li>Comments Color</li>\n                                         <li>Show Or Hide Close Icon</li>\n                                         <li>Close Icon Background Color</li>\n                                         <li>Close Icon Color</li>\n                                         <li>Close Icon Hover Background Color</li>\n                                         <li>Close Icon Hover Color</li>\n                                         </ul>", $FTA->plug_slug ),
                    'type'        => 'popup',
                );
            }
            /*
             * Use mif_skins_settings filter to add new settings into the skins.
             * Returning back all the settings.
             */
            return $settings = apply_filters( 'mif_skins_settings', $settings, $skin_id );
        }
        
        /* mif_skins_sections Method ends here. */
        /**
         * Used by hook: 'customize_preview_init'
         * 
         * @see add_action('customize_preview_init',$func)
         */
        public function mif_live_preview()
        {
            /* Getting saved skin id. */
            $skin_id = get_option( 'mif_skin_id', false );
            /* Enqueing script for displaying live changes. */
            wp_enqueue_script(
                'mif_live_preview',
                MIF_PLUGIN_URL . 'assets/js/mif_live_preview.js',
                array( 'jquery', 'customize-preview' ),
                true
            );
            /* Localizing script for getting skin id in js. */
            wp_localize_script( 'mif_live_preview', 'mif_skin_id', $skin_id );
        }
    
    }
    /* FTA_customizer Class ends here. */
    $MIF_CUSTOMIZER = new MIF_CUSTOMIZER();
}
