<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Main class of all efbl Skins
//======================================================================

if ( !class_exists( 'EFBL_SKINS' ) ) {
    class EFBL_SKINS
    {
        /*
         * __construct initialize all function of this class.
         * Returns nothing. 
         * Used action_hooks to get things sequentially.
         */
        function __construct()
        {
            /* Action hook fires on admin load. */
            add_action( 'init', array( $this, 'efbl_skins_register' ), 20 );
            $this->efbl_default_skins();
            /*
             * init hooks fires on wp load.
             * Gets all Skins.
             */
            add_action( 'init', array( $this, 'efbl_skins' ), 30 );
        }
        
        /* __construct Method ends here. */
        public function efbl_skins_register()
        {
            /* Arguments for custom post type of xOptin. */
            $args = array(
                'public'              => false,
                'label'               => __( 'Facebook Skins', 'easy-facebook-likebox' ),
                'show_in_menu'        => false,
                'exclude_from_search' => true,
                'has_archive'         => false,
                'hierarchical'        => true,
                'menu_position'       => null,
            );
            /* register_post_type() registers a custom post type in wp. */
            register_post_type( 'efbl_skins', $args );
        }
        
        /* efbl_skins_register Method ends here. */
        public function efbl_default_skins()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            // echo '<pre>'; print_r($fta_settings['plugins']['facebook']['default_skin_id']);exit();
            
            if ( !isset( $fta_settings['plugins']['facebook']['default_skin_id'] ) && empty($fta_settings['plugins']['facebook']['default_skin_id']) ) {
                /* Arguments for default skin. */
                $efbl_new_skins = array(
                    'post_title'   => __( "Skin - Half Width", 'easy-facebook-likebox' ),
                    'post_content' => __( "This is the half width demo skin created by plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.", 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                $efbl_new_skins = apply_filters( 'efbl_default_skin', $efbl_new_skins );
                /*
                 * it will update the demo page on every activate if it's exists.
                 * If not exists the add new demo page.
                 */
                $skin_id = wp_insert_post( $efbl_new_skins );
                /* Arguments for default skin. */
                $efbl_new_skin_full = array(
                    'post_title'   => __( "Skin - Full Width", 'easy-facebook-likebox' ),
                    'post_content' => __( "This is the Full width demo skin created by plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.", 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                /*
                 * it will update the demo page on every activate if it's exists.
                 * If not exists the add new demo page.
                 */
                $efbl_new_skin_full_id = wp_insert_post( $efbl_new_skin_full );
                /* Arguments for default skin. */
                $efbl_new_skin_thumbnail = array(
                    'post_title'   => __( "Skin - Thumbnail", 'easy-facebook-likebox' ),
                    'post_content' => __( "This is the Thumbnail demo skin created by plugin automatically with default values. You can edit it and change the look & feel of your Facebook Feeds.", 'easy-facebook-likebox' ),
                    'post_type'    => 'efbl_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                /*
                 * it will update the demo page on every activate if it's exists.
                 * If not exists the add new demo page.
                 */
                $efbl_new_skin_thumbnail_id = wp_insert_post( $efbl_new_skin_thumbnail );
                if ( isset( $skin_id ) ) {
                    /* saving values.*/
                    update_option( 'efbl_skin_' . $skin_id, $this->efbl_skin_half_values() );
                }
                if ( isset( $efbl_new_skin_thumbnail_id ) ) {
                    /* saving values.*/
                    update_option( 'efbl_skin_' . $efbl_new_skin_thumbnail_id, $this->efbl_skin_thumbnail_values() );
                }
                if ( isset( $efbl_new_skin_full_id ) ) {
                    /* saving values.*/
                    update_option( 'efbl_skin_' . $efbl_new_skin_full_id, $this->efbl_skin_full_values() );
                }
                $fta_settings['plugins']['facebook']['default_skin_id'] = $skin_id;
                update_option( 'fta_settings', $fta_settings );
            }
            
            
            if ( !isset( $fta_settings['plugins']['facebook']['default_page_id'] ) && empty($fta_settings['plugins']['facebook']['default_page_id']) ) {
                $skin_id = $fta_settings['plugins']['facebook']['default_skin_id'];
                /*
                 * $data array contains the data of demo page.
                 */
                $efbl_default_page = array(
                    'post_title'   => __( "Facebook Demo - Customizer", 'easy-facebook-likebox' ),
                    'post_content' => __( '[efb_feed fanpage_id="106704037405386" show_like_box="1" post_limit="10" cache_unit="5" cache_duration="days" skin_id=' . $skin_id . ' ]<br> This is a Facebook demo page created by plugin automatically. Please do not delete to make the plugin work properly.', 'easy-facebook-likebox' ),
                    'post_type'    => 'page',
                    'post_status'  => 'publish',
                );
                $efbl_default_page = apply_filters( 'efbl_default_page', $efbl_default_page );
                $page_id = wp_insert_post( $efbl_default_page );
                $fta_settings['plugins']['facebook']['default_page_id'] = $page_id;
                update_option( 'fta_settings', $fta_settings );
            }
        
        }
        
        /*
         * xo_accounts will get the all accounts.
         * Returns accounts  object.
         */
        public function efbl_skins()
        {
            /*
             * Arguments for WP_Query().
             */
            $efbl_skins = array(
                'posts_per_page' => 1000,
                'post_type'      => 'efbl_skins',
                'post_status'    => array( 'publish', 'draft', 'pending' ),
            );
            /*
             * Quering all active xOptins.
             * WP_Query() object of wp will be used.
             */
            $efbl_skins = new WP_Query( $efbl_skins );
            /* If any xoptins_skins are in database. */
            
            if ( $efbl_skins->have_posts() ) {
                /* Declaring an empty array. */
                $efbl_skins_holder = array();
                /* Looping efbl_skins to get all records. */
                while ( $efbl_skins->have_posts() ) {
                    /* Making it post. */
                    $efbl_skins->the_post();
                    /* Getting the ID. */
                    $id = get_the_ID();
                    // wp_delete_post($id, true );
                    $design_arr = null;
                    $design_arr = get_option( 'efbl_skin_' . $id, false );
                    // echo "<pre>"; print_r( $design_arr);exit();
                    $selected_layout = $design_arr['layout_option'];
                    $title = get_the_title();
                    if ( empty($title) ) {
                        $title = __( 'Skin', 'easy-facebook-likebox' );
                    }
                    /* Making an array of skins. */
                    $efbl_skins_holder[$id] = array(
                        'ID'          => $id,
                        'title'       => $title,
                        'description' => get_the_content(),
                    );
                    if ( !isset( $selected_layout ) or empty($selected_layout) ) {
                        $selected_layout = 'half';
                    }
                    $default_func_name = 'efbl_skin_' . $selected_layout . '_values';
                    $defaults = $this->{$default_func_name}();
                    /* If there is no data in live preview section of xOptin setting the default data. */
                    $efbl_skins_holder[$id]['design'] = wp_parse_args( $design_arr, $defaults );
                    // $efbl_skins_holder[$id]['design'] = $design_arr;
                }
                // Loop ends here.
                /* Reseting the current query. */
                wp_reset_postdata();
            } else {
                return __( 'No skins found.', 'easy-facebook-likebox' );
            }
            
            /* Globalising array to access anywhere. */
            $GLOBALS['efbl_skins'] = $efbl_skins_holder;
        }
        
        /* xo_Skins Method ends here. */
        /*
         * efbl_skin_half_values will have default design values of halfwidth layout skin.
         */
        public function efbl_skin_half_values()
        {
            /*
             * Default values
             */
            $half_default = array(
                'layout_option'                    => 'half',
                'show_load_more_btn'               => true,
                'load_more_background_color'       => '#333',
                'load_more_color'                  => '#fff',
                'load_more_hover_background_color' => '#5c5c5c',
                'load_more_hover_color'            => '#fff',
                'header_background_color'          => 'transparent',
                'header_text_color'                => '#000',
                'header_border_color'              => '#ccc',
                'header_border_style'              => 'none',
                'header_border_top'                => '0',
                'header_border_bottom'             => '1',
                'header_border_left'               => '0',
                'header_border_right'              => '0',
                'header_padding_top'               => '10',
                'header_padding_bottom'            => '10',
                'header_padding_left'              => '10',
                'header_padding_right'             => '10',
                'title_size'                       => '16',
                'metadata_size'                    => '16',
                'bio_size'                         => '14',
                'show_comments'                    => true,
                'show_likes'                       => true,
                'show_header'                      => false,
                'show_dp'                          => true,
                'header_round_dp'                  => true,
                'show_page_category'               => true,
                'show_no_of_followers'             => true,
                'show_bio'                         => true,
                'feed_header'                      => true,
                'feed_header_logo'                 => true,
                'feed_background_color'            => 'transparent',
                'feed_padding_top'                 => '0',
                'feed_padding_bottom'              => '0',
                'feed_padding_left'                => '0',
                'feed_padding_right'               => '0',
                'feed_margin_top'                  => '0',
                'feed_margin_bottom'               => '20',
                'feed_margin_left'                 => '0',
                'feed_margin_right'                => '0',
                'feed_meta_data_bg_color'          => '#0073aa',
                'feed_meta_data_color'             => '#fff',
                'show_likes'                       => true,
                'show_comments'                    => true,
                'show_shares'                      => true,
                'show_feed_caption'                => true,
                'show_feed_open_popup_icon'        => true,
                'popup_icon_color'                 => '#fff',
                'show_feed_cta'                    => true,
                'feed_cta_text_color'              => '#000',
                'feed_cta_text_hover_color'        => '#000',
                'feed_hover_bg_color'              => 'rgba(0,0,0,0.5)',
                'feed_seprator_color'              => '#ccc',
                'feed_border_size'                 => '1',
                'feed_border_style'                => 'none',
                'feed_type_icon_color'             => '#fff',
                'feed_text_color'                  => '#000',
                'feed_shared_link'                 => true,
                'feed_shared_link_bg_color'        => '#f7f7f7',
                'feed_shared_link_heading_color'   => '#0073aa',
                'feed_shared_link_color'           => '#000',
                'feed_shared_link_border_color'    => '#eee',
                'popup_sidebar_bg'                 => '#fff',
                'popup_sidebar_color'              => '#000',
                'popup_show_header'                => true,
                'popup_show_header_logo'           => true,
                'popup_header_title_color'         => '#ed6d62',
                'popup_post_time_color'            => '#9197a3',
                'popup_show_caption'               => true,
                'popup_show_meta'                  => true,
                'popup_meta_bg_color'              => '#f6f7f9',
                'popup_meta_color'                 => '#000',
                'popup_show_reactions_counter'     => true,
                'popup_show_comments_counter'      => true,
                'popup_show_view_fb_link'          => true,
                'popup_show_comments'              => true,
                'popup_comments_bg_color'          => '#f2f3f5',
                'popup_comments_color'             => '#4b4f52',
                'popup_close_icon_bg_color'        => 'transparent',
                'popup_close_icon_color'           => '#888',
                'popup_close_icon_bg_hover_color'  => '#eee',
                'popup_close_icon_hover_color'     => '#000',
                'popup_show_close_icon'            => true,
            );
            /*
             * Filters to add more default values
             */
            $half_default = apply_filters( 'efbl_half_layout_defaults', $half_default );
            /*
             * Returns the half skin default values
             */
            return $half_default;
        }
        
        /* efbl_skin_half_values Method ends here. */
        /*
         * efbl_skin_half_values will have default design values of fullwidth layout skin.
         */
        public function efbl_skin_full_values()
        {
            /*
             * Default values
             */
            $full_default = array(
                'layout_option'                    => 'full',
                'show_load_more_btn'               => true,
                'load_more_background_color'       => '#333',
                'load_more_color'                  => '#fff',
                'load_more_hover_background_color' => '#5c5c5c',
                'load_more_hover_color'            => '#fff',
                'header_background_color'          => '#fff',
                'btnbordercolor-hover'             => '#000',
                'header_text_color'                => '#000',
                'feed_time_text_color'             => '#000',
                'feed_cta_text_color'              => '#000',
                'header_background_color'          => 'transparent',
                'header_text_color'                => '#000',
                'header_border_color'              => '#ccc',
                'header_border_style'              => 'none',
                'header_border_top'                => '0',
                'header_border_bottom'             => '1',
                'header_border_left'               => '0',
                'header_border_right'              => '0',
                'header_padding_top'               => '10',
                'header_padding_bottom'            => '10',
                'header_padding_left'              => '10',
                'header_padding_right'             => '10',
                'title_size'                       => '16',
                'metadata_size'                    => '16',
                'bio_size'                         => '14',
                'show_comments'                    => true,
                'show_likes'                       => true,
                'show_header'                      => false,
                'show_dp'                          => true,
                'header_round_dp'                  => true,
                'show_page_category'               => true,
                'show_no_of_followers'             => true,
                'show_bio'                         => true,
                'feed_header'                      => true,
                'feed_header_logo'                 => true,
                'feed_background_color'            => 'transparent',
                'feed_padding_top'                 => '0',
                'feed_padding_bottom'              => '0',
                'feed_padding_left'                => '0',
                'feed_padding_right'               => '0',
                'feed_margin_top'                  => '0',
                'feed_margin_bottom'               => '20',
                'feed_margin_left'                 => '0',
                'feed_margin_right'                => '0',
                'feed_meta_data_bg_color'          => '#0073aa',
                'feed_meta_data_color'             => '#fff',
                'show_likes'                       => true,
                'show_comments'                    => true,
                'show_shares'                      => true,
                'show_feed_caption'                => true,
                'show_feed_open_popup_icon'        => true,
                'popup_icon_color'                 => '#fff',
                'show_feed_cta'                    => true,
                'feed_cta_text_color'              => '#000',
                'feed_cta_text_hover_color'        => '#000',
                'feed_hover_bg_color'              => 'rgba(0,0,0,0.5)',
                'feed_seprator_color'              => '#ccc',
                'feed_border_size'                 => '1',
                'feed_border_style'                => 'none',
                'feed_type_icon_color'             => '#fff',
                'feed_text_color'                  => '#000',
                'feed_shared_link'                 => true,
                'feed_shared_link_bg_color'        => '#f7f7f7',
                'feed_shared_link_heading_color'   => '#0073aa',
                'feed_shared_link_color'           => '#000',
                'feed_shared_link_border_color'    => '#eee',
                'popup_sidebar_bg'                 => '#fff',
                'popup_sidebar_color'              => '#000',
                'popup_show_header'                => true,
                'popup_show_header_logo'           => true,
                'popup_header_title_color'         => '#ed6d62',
                'popup_post_time_color'            => '#9197a3',
                'popup_show_caption'               => true,
                'popup_show_meta'                  => true,
                'popup_meta_bg_color'              => '#f6f7f9',
                'popup_meta_color'                 => '#000',
                'popup_show_reactions_counter'     => true,
                'popup_show_comments_counter'      => true,
                'popup_show_view_fb_link'          => true,
                'popup_show_comments'              => true,
                'popup_comments_bg_color'          => '#f2f3f5',
                'popup_comments_color'             => '#4b4f52',
                'popup_close_icon_bg_color'        => 'transparent',
                'popup_close_icon_color'           => '#888',
                'popup_close_icon_bg_hover_color'  => '#eee',
                'popup_close_icon_hover_color'     => '#000',
                'popup_show_close_icon'            => true,
            );
            /*
             * Filters to add more default values
             */
            $full_default = apply_filters( 'efbl_full_layout_defaults', $full_default );
            /*
             * Returns the Full skin default values
             */
            return $full_default;
        }
        
        /* efbl_skin_full_values Method ends here. */
        /*
         * efbl_skin_grid_values will have default design values of grid layout skin.
         */
        public function efbl_skin_grid_values()
        {
        }
        
        /* efbl_skin_grid_values Method ends here. */
        /*
         * efbl_skin_masonry_values will have default design values of masonry layout skin.
         */
        public function efbl_skin_masonry_values()
        {
        }
        
        /* efbl_skin_masonry_values Method ends here. */
        /*
         * efbl_skin_carousel_values will have default design values of carousel layout skin.
         */
        public function efbl_skin_carousel_values()
        {
        }
        
        /* efbl_skin_carousel_values Method ends here. */
        /*
         * efbl_skin_thumbnail_values will have default design values of thumbnail layout skin.
         */
        public function efbl_skin_thumbnail_values()
        {
            /*
             * Default values
             */
            $thumbnail_default = array(
                'layout_option'                    => 'thumbnail',
                'show_load_more_btn'               => true,
                'load_more_background_color'       => '#333',
                'load_more_color'                  => '#fff',
                'load_more_hover_background_color' => '#5c5c5c',
                'load_more_hover_color'            => '#fff',
                'header_background_color'          => '#fff',
                'btnbordercolor-hover'             => '#000',
                'header_text_color'                => '#000',
                'feed_time_text_color'             => '#000',
                'feed_cta_text_color'              => '#000',
                'header_background_color'          => 'transparent',
                'header_text_color'                => '#000',
                'header_border_color'              => '#ccc',
                'header_border_style'              => 'none',
                'header_border_top'                => '0',
                'header_border_bottom'             => '1',
                'header_border_left'               => '0',
                'header_border_right'              => '0',
                'header_padding_top'               => '10',
                'header_padding_bottom'            => '10',
                'header_padding_left'              => '10',
                'header_padding_right'             => '10',
                'title_size'                       => '16',
                'metadata_size'                    => '16',
                'bio_size'                         => '14',
                'show_comments'                    => true,
                'show_likes'                       => true,
                'show_header'                      => false,
                'show_dp'                          => true,
                'header_round_dp'                  => true,
                'show_page_category'               => true,
                'show_no_of_followers'             => true,
                'show_bio'                         => true,
                'feed_header'                      => true,
                'feed_header_logo'                 => true,
                'feed_background_color'            => 'transparent',
                'feed_padding_top'                 => '0',
                'feed_padding_bottom'              => '0',
                'feed_padding_left'                => '0',
                'feed_padding_right'               => '0',
                'feed_margin_top'                  => '0',
                'feed_margin_bottom'               => '20',
                'feed_margin_left'                 => '0',
                'feed_margin_right'                => '0',
                'feed_meta_data_bg_color'          => '#0073aa',
                'feed_meta_data_color'             => '#fff',
                'show_likes'                       => true,
                'show_comments'                    => true,
                'show_shares'                      => true,
                'show_feed_caption'                => true,
                'show_feed_open_popup_icon'        => true,
                'popup_icon_color'                 => '#fff',
                'show_feed_cta'                    => true,
                'feed_cta_text_color'              => '#000',
                'feed_cta_text_hover_color'        => '#000',
                'feed_hover_bg_color'              => 'rgba(0,0,0,0.5)',
                'feed_seprator_color'              => '#ccc',
                'feed_border_size'                 => '1',
                'feed_border_style'                => 'none',
                'feed_type_icon_color'             => '#fff',
                'feed_text_color'                  => '#000',
                'feed_shared_link'                 => true,
                'feed_shared_link_bg_color'        => '#f7f7f7',
                'feed_shared_link_heading_color'   => '#0073aa',
                'feed_shared_link_color'           => '#000',
                'feed_shared_link_border_color'    => '#eee',
                'popup_sidebar_bg'                 => '#fff',
                'popup_sidebar_color'              => '#000',
                'popup_show_header'                => true,
                'popup_show_header_logo'           => true,
                'popup_header_title_color'         => '#ed6d62',
                'popup_post_time_color'            => '#9197a3',
                'popup_show_caption'               => true,
                'popup_show_meta'                  => true,
                'popup_meta_bg_color'              => '#f6f7f9',
                'popup_meta_color'                 => '#000',
                'popup_show_reactions_counter'     => true,
                'popup_show_comments_counter'      => true,
                'popup_show_view_fb_link'          => true,
                'popup_show_comments'              => true,
                'popup_comments_bg_color'          => '#f2f3f5',
                'popup_comments_color'             => '#4b4f52',
                'popup_close_icon_bg_color'        => 'transparent',
                'popup_close_icon_color'           => '#888',
                'popup_close_icon_bg_hover_color'  => '#eee',
                'popup_close_icon_hover_color'     => '#000',
                'popup_show_close_icon'            => true,
            );
            /*
             * Filters to add more default values
             */
            $thumbnail_default = apply_filters( 'efbl_thumbnail_layout_defaults', $thumbnail_default );
            /*
             * Returns the thumbnail skin default values
             */
            return $thumbnail_default;
        }
    
    }
    /* Class ends here. */
    /*
    * Globalising class to get functionality on other files.
    */
    $GLOBALS['EFBL_SKINS'] = new EFBL_SKINS();
}
