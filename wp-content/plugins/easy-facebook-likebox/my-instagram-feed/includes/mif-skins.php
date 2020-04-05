<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Main class of all FTA Skins
//======================================================================

if ( !class_exists( 'MIF_SKINS' ) ) {
    class MIF_SKINS
    {
        /*
         * __construct initialize all function of this class.
         * Returns nothing. 
         * Used action_hooks to get things sequentially.
         */
        function __construct()
        {
            /* Action hook fires on admin load. */
            add_action( 'init', array( $this, 'mif_skins_register' ), 20 );
            $this->mif_skins();
            /*
             * Gets all Skins.
             */
            $this->mif_default_skins();
        }
        
        /* __construct Method ends here. */
        /*
         * Register skins posttype.
         */
        public function mif_skins_register()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            // echo "<pre>"; print_r();exit();
            /* Arguments for custom post type of skins. */
            $args = array(
                'public'              => true,
                'label'               => __( 'MIF Skins', $FTA->plug_slug ),
                'show_in_menu'        => false,
                'exclude_from_search' => true,
                'has_archive'         => false,
                'hierarchical'        => true,
                'menu_position'       => null,
            );
            /* register_post_type() registers a custom post type in wp. */
            register_post_type( 'mif_skins', $args );
        }
        
        /* mif_skins_register Method ends here. */
        /*
         * Register Default skins.
         */
        public function mif_default_skins()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            // echo "<pre>"; print_r($fta_settings);exit();
            
            if ( !isset( $fta_settings['plugins']['instagram']['default_skin_id'] ) && empty($fta_settings['plugins']['instagram']['default_skin_id']) ) {
                /* Arguments for default skin. */
                $mif_new_skins = array(
                    'post_title'   => __( "Skin - Grid", $FTA->plug_slug ),
                    'post_content' => __( "This is the demo skin created by Easy Social Feed plugin automatically with default values. You can edit it and change the look & feel of your Feeds.", $FTA->plug_slug ),
                    'post_type'    => 'mif_skins',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                );
                $mif_new_skins = apply_filters( 'mif_default_skin', $mif_new_skins );
                $skin_id = wp_insert_post( $mif_new_skins );
                $fta_settings['plugins']['instagram']['default_skin_id'] = $skin_id;
                update_option( 'fta_settings', $fta_settings );
                if ( isset( $skin_id ) ) {
                    /* saving values.*/
                    update_option( 'mif_skin_' . $skin_id, $this->mif_skin_grid_values() );
                }
            }
            
            
            if ( !isset( $fta_settings['plugins']['instagram']['default_page_id'] ) && empty($fta_settings['plugins']['instagram']['default_page_id']) ) {
                $skin_id = $fta_settings['plugins']['instagram']['default_skin_id'];
                $user_id = null;
                /*
                 * Getting approved pages.
                 */
                $approved_pages = array();
                if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                    $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
                }
                
                if ( $approved_pages ) {
                    reset( $approved_pages );
                    $id = key( $approved_pages );
                    $user_id = $approved_pages[$id]->instagram_accounts->connected_instagram_account->id;
                }
                
                /*
                 * $data array contains the data of demo page.
                 */
                $mif_default_page = array(
                    'post_title'   => __( "Instagram Demo - Customizer", $FTA->plug_slug ),
                    'post_content' => __( "[my-instagram-feed user_id='{$user_id}' skin_id='{$skin_id}'] <br> This is a mif demo page created by plugin automatically. Please don't delete to make the plugin work properly.", $FTA->plug_slug ),
                    'post_type'    => 'page',
                    'post_status'  => 'publish',
                );
                $mif_default_page = apply_filters( 'mif_default_page', $mif_default_page );
                $page_id = wp_insert_post( $mif_default_page );
                $fta_settings['plugins']['instagram']['default_page_id'] = $page_id;
                update_option( 'fta_settings', $fta_settings );
            }
        
        }
        
        /* mif_default_skins Method ends here. */
        /*
         * xo_accounts will get the all accounts.
         * Returns accounts  object.
         */
        public function mif_skins()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            /*
             * Arguments for WP_Query().
             */
            $fta_skins = array(
                'posts_per_page' => 1000,
                'post_type'      => 'mif_skins',
                'post_status'    => array( 'publish', 'draft', 'pending' ),
            );
            /*
             * Quering all active xOptins.
             * WP_Query() object of wp will be used.
             */
            $fta_skins = new WP_Query( $fta_skins );
            /* If any fta_skins are in database. */
            
            if ( $fta_skins->have_posts() ) {
                /* Declaring an empty array. */
                $fta_skins_holder = array();
                /* Looping mif_skins to get all records. */
                while ( $fta_skins->have_posts() ) {
                    /* Making it post. */
                    $fta_skins->the_post();
                    /* Getting the ID. */
                    $id = get_the_ID();
                    $design_arr = null;
                    $design_arr = get_option( 'mif_skin_' . $id, false );
                    $selected_layout = $design_arr['layout_option'];
                    // echo "<pre>"; print_r($design_arr);exit();
                    $title = get_the_title();
                    if ( empty($title) ) {
                        $title = __( 'Skin', $FTA->plug_slug );
                    }
                    /* Making an array of skins. */
                    $fta_skins_holder[$id] = array(
                        'ID'          => $id,
                        'title'       => $title,
                        'description' => get_the_content(),
                    );
                    if ( !isset( $selected_layout ) or empty($selected_layout) ) {
                        $selected_layout = 'grid';
                    }
                    $default_func_name = 'mif_skin_' . $selected_layout . '_values';
                    $defaults = $this->{$default_func_name}();
                    /* If there is no data in live preview section of xOptin setting the default data. */
                    $fta_skins_holder[$id]['design'] = wp_parse_args( $design_arr, $defaults );
                }
                // Loop ends here.
                /* Reseting the current query. */
                wp_reset_postdata();
            } else {
                return __( 'No skins found.', $FTA->plug_slug );
            }
            
            /* Globalising array to access anywhere. */
            $GLOBALS['mif_skins'] = $fta_skins_holder;
            // echo "<pre>";
            // print_r($mif_skins_holder);exit;
        }
        
        /* xo_Skins Method ends here. */
        /*
         * fta_skin_default_values will have default design values of skins.
         */
        public function mif_skin_grid_values()
        {
            $default_val_arr = array(
                'header_background_color'           => '#fff',
                'btnbordercolor-hover'              => '#000',
                'header_text_color'                 => '#000',
                'feed_time_text_color'              => '#000',
                'feed_cta_text_color'               => '#000',
                'number_of_cols'                    => 3,
                'feed_cta_text_hover_color'         => '#000',
                'popup_icon_color'                  => '#fff',
                'feed_hover_bg_color'               => 'rgba(0,0,0,0.5)',
                'layout_option'                     => 'grid',
                'title_size'                        => '16',
                'metadata_size'                     => '16',
                'bio_size'                          => '14',
                'show_comments'                     => false,
                'show_likes'                        => false,
                'show_header'                       => false,
                'show_feed_external_link'           => true,
                'feed_image_filter_amount'          => 0.1,
                'show_dp'                           => true,
                'header_round_dp'                   => true,
                'header_dp_hover_color'             => 'rgba(0,0,0,0.5)',
                'header_dp_hover_icon_color'        => '#fff',
                'header_border_color'               => '#ccc',
                'header_border_style'               => 'none',
                'header_border_top'                 => '0',
                'header_border_bottom'              => '1',
                'header_border_left'                => '0',
                'header_border_right'               => '0',
                'header_padding_top'                => '10',
                'header_padding_bottom'             => '10',
                'header_padding_left'               => '10',
                'header_padding_right'              => '10',
                'feed_image_filter'                 => 'none',
                'header_align'                      => 'left',
                'feed_margin_top'                   => 5,
                'feed_margin_bottom'                => 5,
                'feed_margin_left'                  => 5,
                'feed_margin_right'                 => 5,
                'show_feed_open_popup_icon'         => true,
                'popup_icon_color'                  => '#fff',
                'show_no_of_feeds'                  => true,
                'show_no_of_followers'              => true,
                'show_bio'                          => true,
                'show_follow_btn'                   => true,
                'show_load_more_btn'                => true,
                'load_more_background_color'        => '#333',
                'load_more_color'                   => '#fff',
                'load_more_hover_background_color'  => '#5c5c5c',
                'load_more_hover_color'             => '#fff',
                'follow_btn_background_color'       => '#517fa4',
                'follow_btn_color'                  => '#fff',
                'follow_btn_hover_background_color' => '#4477a0',
                'follow_btn_hover_color'            => '#fff',
                'popup_sidebar_bg'                  => '#fff',
                'popup_sidebar_color'               => '#000',
                'popup_show_header'                 => true,
                'popup_show_header_logo'            => true,
                'popup_header_title_color'          => '#ed6d62',
                'popup_post_time_color'             => '#9197a3',
                'popup_show_caption'                => true,
                'popup_show_meta'                   => true,
                'popup_meta_bg_color'               => '#f6f7f9',
                'popup_meta_color'                  => '#000',
                'popup_show_reactions_counter'      => true,
                'popup_show_comments_counter'       => true,
                'popup_show_view_fb_link'           => true,
                'popup_show_comments'               => true,
                'popup_comments_bg_color'           => '#f2f3f5',
                'popup_comments_color'              => '#4b4f52',
                'popup_close_icon_bg_color'         => 'transparent',
                'popup_close_icon_color'            => '#888',
                'popup_close_icon_bg_hover_color'   => '#eee',
                'popup_close_icon_hover_color'      => '#000',
                'popup_show_close_icon'             => true,
            );
            /*
             * Filters to add more default values
             */
            $default_val_arr = apply_filters( 'mif_grid_layout_defaults', $default_val_arr );
            return $default_val_arr;
        }
        
        /* mif_skin_default_values Method ends here. */
        /*
         * fta_skin_default_values will have default design values of skins.
         */
        public function mif_skin_masonary_values()
        {
            $default_val_arr = array(
                'header_background_color'           => '#fff',
                'gutter_width'                      => 10,
                'btnbordercolor-hover'              => '#000',
                'header_text_color'                 => '#000',
                'feed_time_text_color'              => '#000',
                'feed_cta_text_color'               => '#000',
                'number_of_cols'                    => 4,
                'feed_cta_text_hover_color'         => '#000',
                'popup_icon_color'                  => '#fff',
                'feed_hover_bg_color'               => 'rgba(0,0,0,0.5)',
                'layout_option'                     => 'masonary',
                'title_size'                        => '16',
                'metadata_size'                     => '16',
                'bio_size'                          => '14',
                'show_comments'                     => false,
                'show_likes'                        => false,
                'show_header'                       => false,
                'show_feed_external_link'           => true,
                'feed_image_filter_amount'          => 0.1,
                'show_dp'                           => true,
                'header_round_dp'                   => true,
                'header_dp_hover_color'             => 'rgba(0,0,0,0.5)',
                'header_dp_hover_icon_color'        => '#fff',
                'header_border_color'               => '#ccc',
                'header_border_style'               => 'none',
                'header_border_top'                 => '0',
                'header_border_bottom'              => '1',
                'header_border_left'                => '0',
                'header_border_right'               => '0',
                'header_padding_top'                => '10',
                'header_padding_bottom'             => '10',
                'header_padding_left'               => '10',
                'header_padding_right'              => '10',
                'feed_image_filter'                 => 'none',
                'header_align'                      => 'left',
                'feed_margin_top'                   => 5,
                'feed_margin_bottom'                => 5,
                'feed_margin_left'                  => 5,
                'feed_margin_right'                 => 5,
                'show_feed_open_popup_icon'         => true,
                'popup_icon_color'                  => '#fff',
                'show_no_of_feeds'                  => true,
                'show_no_of_followers'              => true,
                'show_bio'                          => true,
                'show_follow_btn'                   => true,
                'show_load_more_btn'                => true,
                'load_more_background_color'        => '#333',
                'load_more_color'                   => '#fff',
                'load_more_hover_background_color'  => '#5c5c5c',
                'load_more_hover_color'             => '#fff',
                'follow_btn_background_color'       => '#517fa4',
                'follow_btn_color'                  => '#fff',
                'follow_btn_hover_background_color' => '#4477a0',
                'follow_btn_hover_color'            => '#fff',
                'popup_sidebar_bg'                  => '#fff',
                'popup_sidebar_color'               => '#000',
                'popup_show_header'                 => true,
                'popup_show_header_logo'            => true,
                'popup_header_title_color'          => '#ed6d62',
                'popup_post_time_color'             => '#9197a3',
                'popup_show_caption'                => true,
                'popup_show_meta'                   => true,
                'popup_meta_bg_color'               => '#f6f7f9',
                'popup_meta_color'                  => '#000',
                'popup_show_reactions_counter'      => true,
                'popup_show_comments_counter'       => true,
                'popup_show_view_fb_link'           => true,
                'popup_show_comments'               => true,
                'popup_comments_bg_color'           => '#f2f3f5',
                'popup_comments_color'              => '#4b4f52',
                'popup_close_icon_bg_color'         => 'transparent',
                'popup_close_icon_color'            => '#888',
                'popup_close_icon_bg_hover_color'   => '#eee',
                'popup_close_icon_hover_color'      => '#000',
                'popup_show_close_icon'             => true,
            );
            return $default_val_arr;
        }
        
        /* mif_skin_default_values Method ends here. */
        /*
         * fta_skin_default_values will have default design values of skins.
         */
        public function mif_skin_carousel_values()
        {
            $default_val_arr = array(
                'header_background_color'           => '#fff',
                'loop'                              => true,
                'autoplay'                          => true,
                'show_load_more_btn'                => true,
                'show_next_prev_icon'               => true,
                'show_nav'                          => true,
                'nav_color'                         => '#D6D6D6',
                'nav_active_color'                  => '#869791',
                'gutter_width'                      => 0,
                'btnbordercolor-hover'              => '#000',
                'header_text_color'                 => '#000',
                'feed_time_text_color'              => '#000',
                'feed_cta_text_color'               => '#000',
                'number_of_cols'                    => 3,
                'feed_cta_text_hover_color'         => '#000',
                'popup_icon_color'                  => '#fff',
                'feed_hover_bg_color'               => 'rgba(0,0,0,0.5)',
                'layout_option'                     => 'carousel',
                'title_size'                        => '16',
                'metadata_size'                     => '16',
                'bio_size'                          => '14',
                'show_header'                       => false,
                'show_feed_external_link'           => true,
                'feed_image_filter_amount'          => 0.1,
                'show_dp'                           => true,
                'header_round_dp'                   => true,
                'header_dp_hover_color'             => 'rgba(0,0,0,0.5)',
                'header_dp_hover_icon_color'        => '#fff',
                'header_border_color'               => '#ccc',
                'header_border_style'               => 'none',
                'header_border_top'                 => '0',
                'header_border_bottom'              => '1',
                'header_border_left'                => '0',
                'header_border_right'               => '0',
                'header_padding_top'                => '10',
                'header_padding_bottom'             => '10',
                'header_padding_left'               => '10',
                'header_padding_right'              => '10',
                'feed_image_filter'                 => 'none',
                'header_align'                      => 'left',
                'feed_margin_top'                   => 5,
                'feed_margin_bottom'                => 5,
                'feed_margin_left'                  => 5,
                'feed_margin_right'                 => 5,
                'show_next_prev_icon'               => true,
                'show_feed_open_popup_icon'         => true,
                'popup_icon_color'                  => '#fff',
                'show_no_of_feeds'                  => true,
                'show_no_of_followers'              => true,
                'show_bio'                          => true,
                'show_follow_btn'                   => true,
                'show_load_more_btn'                => true,
                'load_more_background_color'        => '#333',
                'load_more_color'                   => '#fff',
                'load_more_hover_background_color'  => '#5c5c5c',
                'load_more_hover_color'             => '#fff',
                'follow_btn_background_color'       => '#517fa4',
                'follow_btn_color'                  => '#fff',
                'follow_btn_hover_background_color' => '#4477a0',
                'follow_btn_hover_color'            => '#fff',
                'popup_sidebar_bg'                  => '#fff',
                'popup_sidebar_color'               => '#000',
                'popup_show_header'                 => true,
                'popup_show_header_logo'            => true,
                'popup_header_title_color'          => '#ed6d62',
                'popup_post_time_color'             => '#9197a3',
                'popup_show_caption'                => true,
                'popup_show_meta'                   => true,
                'popup_meta_bg_color'               => '#f6f7f9',
                'popup_meta_color'                  => '#000',
                'popup_show_reactions_counter'      => true,
                'popup_show_comments_counter'       => true,
                'popup_show_view_fb_link'           => true,
                'popup_show_comments'               => true,
                'popup_comments_bg_color'           => '#f2f3f5',
                'popup_comments_color'              => '#4b4f52',
                'popup_close_icon_bg_color'         => 'transparent',
                'popup_close_icon_color'            => '#888',
                'popup_close_icon_bg_hover_color'   => '#eee',
                'popup_close_icon_hover_color'      => '#000',
                'popup_show_close_icon'             => true,
            );
            return $default_val_arr;
        }
        
        /* mif_skin_default_values Method ends here. */
        /*
         * fta_skin_default_values will have default design values of skins.
         */
        public function mif_skin_half_width_values()
        {
            $default_val_arr = array(
                'background_color'                  => '#fff',
                'header_background_color'           => '#fff',
                'btnbordercolor-hover'              => '#000',
                'header_text_color'                 => '#000',
                'feed_time_text_color'              => '#000',
                'feed_cta_text_color'               => '#000',
                'number_of_cols'                    => 3,
                'feed_cta_text_hover_color'         => '#000',
                'popup_icon_color'                  => '#fff',
                'feed_hover_bg_color'               => 'rgba(0,0,0,0.5)',
                'layout_option'                     => 'half_width',
                'title_size'                        => '16',
                'metadata_size'                     => '16',
                'bio_size'                          => '14',
                'show_comments'                     => true,
                'show_likes'                        => false,
                'show_header'                       => false,
                'show_feed_external_link'           => true,
                'feed_image_filter_amount'          => 0.1,
                'show_dp'                           => true,
                'header_round_dp'                   => true,
                'header_dp_hover_color'             => 'rgba(0,0,0,0.5)',
                'header_dp_hover_icon_color'        => '#fff',
                'header_border_color'               => '#ccc',
                'header_border_style'               => 'none',
                'header_border_top'                 => '0',
                'header_border_bottom'              => '1',
                'header_border_left'                => '0',
                'header_border_right'               => '0',
                'header_padding_top'                => '10',
                'header_padding_bottom'             => '10',
                'header_padding_left'               => '10',
                'header_padding_right'              => '10',
                'feed_image_filter'                 => 'none',
                'feed_background_color'             => 'transparent',
                'feed_padding_top_bottom'           => 10,
                'feed_padding_top'                  => 10,
                'feed_padding_bottom'               => 10,
                'feed_padding_left'                 => 0,
                'feed_padding_right'                => 0,
                'feed_padding_right_left'           => 0,
                'header_align'                      => 'left',
                'feed_seprator_color'               => '#ccc',
                'feed_border_size'                  => '1',
                'feed_border_style'                 => 'solid',
                'feed_margin_top'                   => 5,
                'feed_margin_bottom'                => 5,
                'feed_margin_left'                  => 0,
                'feed_margin_right'                 => 0,
                'show_feed_caption'                 => true,
                'feed_external_color'               => '#fff',
                'show_feed_cta'                     => true,
                'feed_cta_text_color'               => '#000',
                'feed_cta_text_hover_color'         => '#000',
                'feed_time_text_color'              => '#000',
                'feed_show_likes'                   => true,
                'feed_likes_bg_color'               => '#333',
                'feed_likes_color'                  => '#fff',
                'feed_comments_bg_color'            => '#333',
                'feed_comments_color'               => '#fff',
                'feed_seprator_color'               => '#ccc',
                'show_feed_open_popup_icon'         => true,
                'caption_color'                     => '#000',
                'popup_icon_color'                  => '#fff',
                'show_no_of_feeds'                  => true,
                'show_no_of_followers'              => true,
                'show_bio'                          => true,
                'show_follow_btn'                   => true,
                'show_load_more_btn'                => true,
                'load_more_background_color'        => '#333',
                'load_more_color'                   => '#fff',
                'load_more_hover_background_color'  => '#5c5c5c',
                'load_more_hover_color'             => '#fff',
                'follow_btn_background_color'       => '#517fa4',
                'follow_btn_color'                  => '#fff',
                'follow_btn_hover_background_color' => '#4477a0',
                'follow_btn_hover_color'            => '#fff',
                'popup_sidebar_bg'                  => '#fff',
                'popup_sidebar_color'               => '#000',
                'popup_show_header'                 => true,
                'popup_show_header_logo'            => true,
                'popup_header_title_color'          => '#ed6d62',
                'popup_post_time_color'             => '#9197a3',
                'popup_show_caption'                => true,
                'popup_show_meta'                   => true,
                'popup_meta_bg_color'               => '#f6f7f9',
                'popup_meta_color'                  => '#000',
                'popup_show_reactions_counter'      => true,
                'popup_show_comments_counter'       => true,
                'popup_show_view_fb_link'           => true,
                'popup_show_comments'               => true,
                'popup_comments_bg_color'           => '#f2f3f5',
                'popup_comments_color'              => '#4b4f52',
                'popup_close_icon_bg_color'         => 'transparent',
                'popup_close_icon_color'            => '#888',
                'popup_close_icon_bg_hover_color'   => '#eee',
                'popup_close_icon_hover_color'      => '#000',
                'popup_show_close_icon'             => true,
            );
            return $default_val_arr;
        }
        
        /* mif_skin_default_values Method ends here. */
        /*
         * fta_skin_default_values will have default design values of skins.
         */
        public function mif_skin_full_width_values()
        {
            $default_val_arr = array(
                'background_color'                  => '#fff',
                'header_background_color'           => '#fff',
                'btnbordercolor-hover'              => '#000',
                'header_text_color'                 => '#000',
                'feed_time_text_color'              => '#000',
                'feed_cta_text_color'               => '#000',
                'number_of_cols'                    => 3,
                'feed_cta_text_hover_color'         => '#000',
                'popup_icon_color'                  => '#fff',
                'feed_hover_bg_color'               => 'rgba(0,0,0,0.5)',
                'layout_option'                     => 'full_width',
                'title_size'                        => '16',
                'metadata_size'                     => '16',
                'bio_size'                          => '14',
                'show_comments'                     => true,
                'show_likes'                        => true,
                'show_header'                       => false,
                'show_feed_external_link'           => true,
                'feed_image_filter_amount'          => 0.1,
                'show_dp'                           => true,
                'header_round_dp'                   => true,
                'header_dp_hover_color'             => 'rgba(0,0,0,0.5)',
                'header_dp_hover_icon_color'        => '#fff',
                'header_border_color'               => '#ccc',
                'header_border_style'               => 'none',
                'header_border_top'                 => '0',
                'header_border_bottom'              => '1',
                'header_border_left'                => '0',
                'header_border_right'               => '0',
                'header_padding_top'                => '10',
                'header_padding_bottom'             => '10',
                'header_padding_left'               => '10',
                'header_padding_right'              => '10',
                'feed_image_filter'                 => 'none',
                'feed_background_color'             => 'transparent',
                'feed_padding_top_bottom'           => 10,
                'feed_padding_top'                  => 10,
                'feed_padding_bottom'               => 10,
                'feed_padding_left'                 => 0,
                'feed_padding_right'                => 0,
                'feed_padding_right_left'           => 0,
                'header_align'                      => 'left',
                'feed_seprator_color'               => '#ccc',
                'feed_border_size'                  => '1',
                'feed_border_style'                 => 'solid',
                'feed_margin_top'                   => 5,
                'feed_margin_bottom'                => 5,
                'feed_margin_left'                  => 0,
                'feed_margin_right'                 => 0,
                'show_feed_caption'                 => true,
                'feed_external_color'               => '#fff',
                'show_feed_cta'                     => true,
                'feed_cta_text_color'               => '#000',
                'feed_cta_text_hover_color'         => '#000',
                'feed_time_text_color'              => '#000',
                'feed_show_likes'                   => true,
                'feed_likes_bg_color'               => '#333',
                'feed_likes_color'                  => '#fff',
                'feed_comments_bg_color'            => '#333',
                'feed_comments_color'               => '#fff',
                'feed_seprator_color'               => '#ccc',
                'show_feed_open_popup_icon'         => true,
                'caption_color'                     => '#000',
                'popup_icon_color'                  => '#fff',
                'show_no_of_feeds'                  => true,
                'show_no_of_followers'              => true,
                'show_bio'                          => true,
                'show_follow_btn'                   => true,
                'show_load_more_btn'                => true,
                'load_more_background_color'        => '#333',
                'load_more_color'                   => '#fff',
                'load_more_hover_background_color'  => '#5c5c5c',
                'load_more_hover_color'             => '#fff',
                'follow_btn_background_color'       => '#517fa4',
                'follow_btn_color'                  => '#fff',
                'follow_btn_hover_background_color' => '#4477a0',
                'follow_btn_hover_color'            => '#fff',
                'popup_sidebar_bg'                  => '#fff',
                'popup_sidebar_color'               => '#000',
                'popup_show_header'                 => true,
                'popup_show_header_logo'            => true,
                'popup_header_title_color'          => '#ed6d62',
                'popup_post_time_color'             => '#9197a3',
                'popup_show_caption'                => true,
                'popup_show_meta'                   => true,
                'popup_meta_bg_color'               => '#f6f7f9',
                'popup_meta_color'                  => '#000',
                'popup_show_reactions_counter'      => true,
                'popup_show_comments_counter'       => true,
                'popup_show_view_fb_link'           => true,
                'popup_show_comments'               => true,
                'popup_comments_bg_color'           => '#f2f3f5',
                'popup_comments_color'              => '#4b4f52',
                'popup_close_icon_bg_color'         => 'transparent',
                'popup_close_icon_color'            => '#888',
                'popup_close_icon_bg_hover_color'   => '#eee',
                'popup_close_icon_hover_color'      => '#000',
                'popup_show_close_icon'             => true,
            );
            return $default_val_arr;
        }
    
    }
    /* Class ends here. */
    /*
    * Globalising class to get functionality on other files.
    */
    $GLOBALS['MIF_SKINS'] = new MIF_SKINS();
}
