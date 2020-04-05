<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Code for the frontend funcionality of My Instagram Feeds
//======================================================================

if ( !class_exists( 'MIF_Front' ) ) {
    class MIF_Front
    {
        /*
         * __construct initialize all function of this class.
         * Returns nothing. 
         * Used action_hooks to get things sequentially.
         */
        function __construct()
        {
            /*
             * wp_enqueue_scripts hooks fires for enqueing custom script and styles.
             * Css file will be include in admin area.
             */
            add_action( 'wp_enqueue_scripts', array( $this, 'mif_style' ) );
            /*
            * add_shortcode() Adds a hook for a shortcode tag..
            * $tag (string) (required) Shortcode tag to be searched in post content
              Default: None
            * $func (callable) (required) Hook to run when shortcode is found
              Default: None
            */
            add_shortcode( 'my-instagram-feed', array( $this, 'mif_shortcode_func' ) );
            /*
             * wp_head hooks fires when page head is load.
             * Css file will be added in head.
             */
            add_action( 'wp_head', array( $this, 'mif_customize_css' ) );
        }
        
        /* __construct Method ends here. */
        /*
         * mif_style will enqueue style and js files on frontend.
         */
        public function mif_style()
        {
            wp_enqueue_script( 'kit.fontawesome', 'https://kit.fontawesome.com/aab9a11966.js' );
            /*
             * If font awesome css files is not enqued already then it will enqueued.
             */
            if ( !wp_style_is( 'font-awesome.min', $list = 'enqueued' ) ) {
                wp_enqueue_style( 'font-awesome.min', MIF_PLUGIN_URL . 'assets/css/font-awesome.min.css' );
            }
            /*
             * Custom CSS file for frontend.
             */
            wp_enqueue_style( 'mif_style', MIF_PLUGIN_URL . 'assets/css/mif_style.css' );
            $mif_ver = 'free';
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $mif_ver = 'pro';
            }
            /*
             * Custom scripts file for frontend.
             */
            wp_enqueue_script(
                'mif-custom',
                MIF_PLUGIN_URL . 'assets/js/mif-custom.js',
                array( 'jquery' ),
                true
            );
            /*
             * Localizing file for getting the admin ajax url in js file.
             */
            wp_localize_script( 'mif-custom', 'mif', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'version'  => $mif_ver,
            ) );
        }
        
        /* mif_style Method ends here. */
        /*
         * mif_customize_css will add the styling to the head of the site.
         */
        public function mif_customize_css()
        {
            /*
             * Getting all the skins.
             */
            global  $mif_skins ;
            // echo "<pre>"; print_r($mif_skins);exit();
            /*
             * Intializing mif css variable.
             */
            $mif_css = null;
            $mif_css = '<style type="text/css">';
            /*
             * Width and height of the feeds.
             */
            $mif_css .= ' .mif_wrap .feed_type_video  .video_icon { background-image:url( ' . includes_url( 'js/mediaelement/mejs-controls.svg' ) . '); }';
            /*
             * Getting skins exists loop thorugh it.
             */
            if ( isset( $mif_skins ) ) {
                foreach ( $mif_skins as $mif_skin ) {
                    $no_of_cols = '';
                    $selected_layout = $mif_skin['design']['layout_option'];
                    $skinn_id = $mif_skin['ID'];
                    $no_of_cols_arr = get_option( 'mif_skin_' . $skinn_id, false );
                    if ( isset( $no_of_cols_arr['number_of_cols'] ) ) {
                        $no_of_cols = $no_of_cols_arr['number_of_cols'];
                    }
                    if ( isset( $no_of_cols_arr['gutter_width'] ) ) {
                        $gutter_width = $no_of_cols_arr['gutter_width'];
                    }
                    
                    if ( 'grid' == $selected_layout || 'carousel' == $selected_layout || 'masonary' == $selected_layout ) {
                        /*
                         * Swith statement on number of cols selected.
                         */
                        switch ( $no_of_cols ) {
                            case '2':
                                $height = '400';
                                break;
                            case '3':
                                $height = '317';
                                break;
                            case '4':
                                $height = '208';
                                break;
                            case '5':
                                $height = '151';
                                break;
                            case '6':
                                $height = '121';
                                break;
                            default:
                                $height = '643';
                                break;
                        }
                        /*
                         * Width and height of the feeds.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_feeds_holder .mif_grid_layout  { width: calc(92% / ' . $no_of_cols . '); }';
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_feeds_holder .mif_grid_layout { height: ' . $height . 'px; }';
                        
                        if ( 'masonary' == $selected_layout ) {
                            $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_masonary_main .mif-masonry-sizer, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_masonary_main .mif_masonary_layout  { width: calc(92% / ' . $no_of_cols . '); }';
                            $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_masonary_main .mif_masonary_layout  { margin-bottom: ' . $gutter_width . 'px!important; }';
                            $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif-gutter-sizer  { width: ' . $gutter_width . 'px!important; }';
                        }
                        
                        // echo "<pre>"; print_r($no_of_cols);exit();
                    }
                    
                    /*
                     * If header is enabled and layout is not full width.
                     */
                    
                    if ( !empty($mif_skin['design']['show_header']) or 'Full_width' == $mif_skin['design']['layout_option'] ) {
                        $mif_header_display = 'block';
                    } else {
                        $mif_header_display = 'none';
                    }
                    
                    /*
                     * Background color of the skin.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main { display: ' . $mif_header_display . '; }';
                    /*
                     * If total number of feeds enables.
                     */
                    
                    if ( !empty($mif_skin['design']['show_no_of_feeds']) ) {
                        $mif_num_of_feeds = 'block';
                    } else {
                        $mif_num_of_feeds = 'none';
                    }
                    
                    /*
                     * Show number of feeds counter.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_posts { display: ' . $mif_num_of_feeds . '; }';
                    /*
                     * If total number of followes enabled.
                     */
                    
                    if ( !empty($mif_skin['design']['show_no_of_followers']) ) {
                        $mif_num_of_followers = 'block';
                    } else {
                        $mif_num_of_followers = 'none';
                    }
                    
                    /*
                     * Show number of followers counter.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_followers { display: ' . $mif_num_of_followers . '; }';
                    /*
                     * If total number of followes enabled.
                     */
                    
                    if ( !empty($mif_skin['design']['show_bio']) ) {
                        $mif_bio_display = 'block';
                    } else {
                        $mif_bio_display = 'none';
                    }
                    
                    /*
                     * Show Bio Div.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_bio { display: ' . $mif_bio_display . '; }';
                    /*
                     * If follow button is enabled.
                     */
                    
                    if ( !empty($mif_skin['design']['show_follow_btn']) ) {
                        $mif_follow_btn_display = 'inline-block';
                    } else {
                        $mif_follow_btn_display = 'none';
                    }
                    
                    /*
                     * Show Follow Button.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_follow_btn { display: ' . $mif_follow_btn_display . '; }';
                    /*
                     * If load more button is enabled.
                     */
                    
                    if ( !empty($mif_skin['design']['show_load_more_btn']) ) {
                        $mif_load_more_btn_display = 'inline-block';
                    } else {
                        $mif_load_more_btn_display = 'none';
                    }
                    
                    /*
                     * Show Follow Button.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_load_feeds { display: ' . $mif_load_more_btn_display . '; }';
                    /*
                     * If Display Picture is enabled.
                     */
                    
                    if ( !empty($mif_skin['design']['show_dp']) ) {
                        $mif_dp_display = 'block';
                    } else {
                        $mif_dp_display = 'none';
                    }
                    
                    /*
                     * Show Display Picture.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_dp_wrap { display: ' . $mif_dp_display . '; }';
                    /*
                     * Header Size.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_header_title { font-size: ' . $mif_skin['design']['title_size'] . 'px; }';
                    /*
                     * Meta data Size.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_posts,.mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_followers { font-size: ' . $mif_skin['design']['metadata_size'] . 'px; }';
                    /*
                     * Bio Size.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_bio { font-size: ' . $mif_skin['design']['bio_size'] . 'px; }';
                    /*
                     * Header background Color.
                     */
                    $mif_css .= '.mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main { background-color: ' . $mif_skin['design']['header_background_color'] . '; }';
                    /*
                     * Header Color.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_posts, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_followers, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_bio, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_main .mif_header_title { color: ' . $mif_skin['design']['header_text_color'] . '; }';
                    /*
                     * PoPup icon color.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_fulls .icon, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single:hover .mif_fulls .icon,
                 .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_feed_popup .icon{ color: ' . $mif_skin['design']['popup_icon_color'] . '!important; }';
                    
                    if ( 'half_width' == $selected_layout || 'full_width' == $selected_layout ) {
                        /*
                         * Caption Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_feed_time { color: ' . $mif_skin['design']['feed_time_text_color'] . '; }';
                        /*
                         * Feed time Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_caption p { color: ' . $mif_skin['design']['caption_color'] . '; }';
                        /*
                         * Feed CTA Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .feed_external_color a { color: ' . $mif_skin['design']['feed_cta_text_color'] . '; }';
                        /*
                         * Feed CTA Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_external_holder a:hover { color: ' . $mif_skin['design']['feed_cta_text_hover_color'] . '; }';
                        /*
                         * Caption Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . '  .mif_caption { color: ' . $mif_skin['design']['caption_color'] . '; }';
                        /*
                         * Background color of the skin.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' { background-color: ' . $mif_skin['design']['background_color'] . '; }';
                        /*
                         * Background color of feed.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { background-color: ' . $mif_skin['design']['feed_background_color'] . '; }';
                        /*
                         * Feed Padding Top And Bottom.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { padding-top: ' . $mif_skin['design']['feed_padding_top'] . 'px; }';
                        /*
                         * Feed Padding Top And Bottom.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single {padding-bottom: ' . $mif_skin['design']['feed_padding_top_bottom'] . 'px; }';
                        /*
                         * Feed Padding left And right.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { padding-left: ' . $mif_skin['design']['feed_padding_left'] . 'px; }';
                        /*
                         * Feed Padding left And right.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single {padding-right: ' . $mif_skin['design']['feed_padding_right'] . 'px; }';
                        /*
                         * Likes background Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_lnc_holder .mif_likes { background-color: ' . $mif_skin['design']['feed_likes_bg_color'] . '; }';
                        /*
                         * Likes Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_lnc_holder .mif_likes p, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_lnc_holder .mif_likes .icon  { color: ' . $mif_skin['design']['feed_likes_color'] . '; }';
                        /*
                         * Comments background Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_lnc_holder .mif_coments { background-color: ' . $mif_skin['design']['feed_comments_bg_color'] . '; }';
                        /*
                         * comments Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_lnc_holder .mif_coments p, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_lnc_holder .mif_coments .icon { color: ' . $mif_skin['design']['feed_comments_color'] . '; }';
                        /*
                         * Caption Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_caption p { color: ' . $mif_skin['design']['caption_color'] . '; }';
                        /*
                         *  External Link Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_external .icon { color: ' . $mif_skin['design']['feed_external_color'] . '; }';
                        /*
                         *  Feed Time Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_header_time p { color: ' . $mif_skin['design']['feed_time_text_color'] . '; }
                ';
                        /*
                         *  Feed Seprator Color.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_default_layout, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_full_layout { border-color: ' . $mif_skin['design']['feed_seprator_color'] . '; }
                ';
                        /*
                         *  Feed Seprator size.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_default_layout,.mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_full_layout { border-bottom-width: ' . $mif_skin['design']['feed_border_size'] . 'px; }
                ';
                        /*
                         *  Feed Seprator style.
                         */
                        $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_default_layout,.mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_full_layout { border-style: ' . $mif_skin['design']['feed_border_style'] . '; }
                ';
                    }
                    
                    /*
                     * Background hover shadow.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single .mif_overlay, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single .mif_fulls{ background-color: ' . $mif_skin['design']['feed_hover_bg_color'] . '; }';
                    /*
                     * Feed Margin Top And Bottom.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { margin-top: ' . $mif_skin['design']['feed_margin_top'] . 'px; }';
                    /*
                     * Feed Margin Top And Bottom.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { margin-bottom: ' . $mif_skin['design']['feed_margin_bottom'] . 'px; }';
                    /*
                     * Feed Margin Left And Right.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { margin-left: ' . $mif_skin['design']['feed_margin_left'] . 'px; }';
                    /*
                     * Feed Margin Left And Right.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_single { margin-right: ' . $mif_skin['design']['feed_margin_right'] . 'px; }';
                    /*
                     *  PopUp Icon Color.
                     */
                    $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_fulls .icon { color: ' . $mif_skin['design']['popup_icon_color'] . '; }';
                    // echo "<pre>";
                    // print_r($mif_skin['design']['feed_hover_bg_color']);exit();
                    /*
                     * Feed hover bg color.
                     */
                    // $mif_css .= ' .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_grid_left_img:hover .mif_fulls, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_full_img:hover .mif_fulls, .mif_wrap.mif_skin_' . $mif_skin['ID'] . ' .mif_masonary_layout:hover .mif_fulls { background-color: ' . $mif_skin['design']['feed_hover_bg_color'] . '; }';
                }
            }
            $mif_css .= '</style>';
            echo  $mif_css ;
        }
        
        function mif_convertHashtags( $str )
        {
            $regex = "/#+([a-zA-Z0-9_]+)/";
            $str = preg_replace( $regex, '<a target="_blank" href="https://www.instagram.com/explore/tags/$1">$0</a>', $str );
            return $str;
        }
        
        /* mif_customize_css Method ends here. */
        /*
         * mif_shortcode_func is the callback func of add_shortcode.
         * Will add the shortcode in wp.
         */
        public function mif_shortcode_func( $atts )
        {
            global  $mif_skins ;
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $mif_skin_default_id = $fta_settings['plugins']['instagram']['default_skin_id'];
            /*
             * $returner variable will contain all html.
             * $returner defines empty at start to avoid junk values.
             */
            $returner = null;
            $mif_values = null;
            $hashtag = null;
            /*
             * shortcode_atts combines user shortcode attributes with known attributes and fills in defaults when needed. The result will contain every key from the known attributes, merged with values from shortcode attributes.
             */
            $atts = shortcode_atts( array(
                'wrapper_class'  => null,
                'user_id'        => null,
                'skin_id'        => $mif_skin_default_id,
                'feeds_per_page' => 9,
                'caption_words'  => 150,
                'cache_unit'     => 1,
                'cache_duration' => 'days',
            ), $atts, 'my-instagram-feed' );
            // echo "<pre>"; print_r($atts);exit();
            /*
             * extracting attributes
             */
            if ( isset( $atts ) ) {
                extract( $atts );
            }
            
            if ( is_customize_preview() ) {
                $skin_id = get_option( 'mif_skin_id', false );
                $user_id = get_option( 'mif_account_id', false );
                // echo "<pre>"; print_r($user_id);exit();
            }
            
            if ( empty($cache_unit) ) {
                $cache_unit = 1;
            }
            if ( empty($cache_duration) ) {
                $cache_duration = 'hours';
            }
            /*
             * Getting cache duration.
             */
            if ( $cache_duration == 'minutes' ) {
                $cache_duration = 60;
            }
            if ( $cache_duration == 'hours' ) {
                $cache_duration = 60 * 60;
            }
            if ( $cache_duration == 'days' ) {
                $cache_duration = 60 * 60 * 24;
            }
            //echo $cache_duration.'<br>';
            $cache_seconds = $cache_duration * $cache_unit;
            /*
             * If caption words are not defined show 20
             */
            //if(!isset($caption_words)) $caption_words = 20;
            if ( isset( $skin_id ) ) {
                $mif_values = $mif_skins[$skin_id]['design'];
            }
            if ( is_customize_preview() ) {
                $mif_values = get_option( 'mif_skin_' . $skin_id, false );
            }
            /*
             * Combinig shortcode atts for getting feeds from instagram api.
             */
            $combined_atts = $hashtag . ',' . $feeds_per_page . ',' . $caption_words . ',' . $skin_id . ',' . $cache_seconds . ',' . $user_id;
            $fta_settings = $FTA->fta_get_settings();
            
            if ( empty($user_id) ) {
                $approved_pages = array();
                
                if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                    /*
                     * Getting saved access token.
                     */
                    $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
                    if ( isset( $approved_pages[array_keys( $approved_pages )['0']]['instagram_accounts']->connected_instagram_account->id ) ) {
                        $user_id = $approved_pages[array_keys( $approved_pages )['0']]['instagram_accounts']->connected_instagram_account->id;
                    }
                }
            
            }
            
            // echo "<pre>"; print_r();exit();
            /*
             * Getting the array of feeds.
             */
            $self_decoded_data = $this->mif_get_bio( $user_id );
            /*
             * Getting the array of feeds.
             */
            $decoded_data = $this->mif_get_feeds(
                $feeds_per_page,
                0,
                $cache_seconds,
                $user_id
            );
            /*
             * If seelf decoded data has object.
             */
            
            if ( !isset( $self_decoded_data->error ) && empty($self_decoded_data->error) ) {
                /*
                 * Getting the selected template.
                 */
                $selected_template = $mif_values['layout_option'];
                /*
                 * Converting the string into lowercase to get template file.
                 */
                $selected_template = strtolower( $selected_template );
                // if(!efl_fs()->is_plan( 'instagram_premium', true ) or  !efl_fs()->is_plan( 'combo_premium', true )):
                //     $selected_template = 'grid';
                // endif;
                $mif_ver = 'free';
                if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                    $mif_ver = 'pro';
                }
                /*
                 * Html starts here.
                 */
                $returner .= '<div id="mif_feed_id" data-template="' . $selected_template . '" class="mif_wrap  fadeIn ' . $wrapper_class . ' mif_skin_' . $skin_id . ' mif_ver_' . $mif_ver . '">				
				<div class="mif_header mif_header_main">
					<div class="mif_inner_wrap">
					<a href="https://www.instagram.com/' . $self_decoded_data->username . '" class="mif_dp_wrap" target="_blank" title="@' . $self_decoded_data->username . '">
				<div class="mif_head_img_holder">
					<img class="mif_header_img" src="' . $self_decoded_data->profile_picture_url . '"/>
				<div class="mif_overlay">
					<i class="icon icon-esf-instagram" aria-hidden="true"></i>
				</div>
				</div>
					</a>			  

				<div class="mif_header_data">
					<h4 class="mif_header_title">' . $self_decoded_data->name . '</h4>
				<div class="mif_posts"><i class="icon icon-esf-picture-o" aria-hidden="true"></i>' . $self_decoded_data->media_count . '</div>';
                $returner .= '<div class="mif_followers"><i class="icon icon-esf-user" aria-hidden="true"></i>' . $self_decoded_data->followers_count . '</div>';
                $returner .= '<p class="mif_bio">' . $self_decoded_data->biography . '</p>
				</div>
				
				</div>
				</div>';
                $carousel_class = ' ';
                $carousel_atts = ' ';
                $returner .= '<div class="mif_feeds_holder mif_' . $selected_template . '_main ' . $carousel_class . '" ' . $carousel_atts . '>';
                if ( 'masonary' == $selected_template ) {
                    $returner .= ' <div class="mif-masonry-sizer"></div><div class="mif-gutter-sizer"></div>';
                }
            }
            
            /*
             * If comments are enabled for $this skin
             */
            if ( isset( $mif_values['show_comments'] ) ) {
                $show_comments = $mif_values['show_comments'];
            }
            $show_likes = null;
            /*
             * If likes are enabled for $this skin
             */
            if ( isset( $show_likes ) ) {
                $show_likes = $mif_values['show_likes'];
            }
            /*
             * Intializing the incremnt variable.
             */
            $i = 0;
            /*
             * If feeds exists loop through each.
             */
            
            if ( !isset( $decoded_data->error ) && !empty($decoded_data->data) ) {
                foreach ( $decoded_data->data as $data ) {
                    /*
                     * Incremanting the variable.
                     */
                    $i++;
                    /*
                     * Next feeds URL
                     */
                    $next_url = $decoded_data->pagination;
                    /*
                     * Feeds created time.
                     */
                    $created_time = $data->timestamp;
                    /*
                     * Converting Feeds created time into human understandable.
                     */
                    $created_time = human_time_diff( strtotime( $created_time ), current_time( 'timestamp', 1 ) ) . ' ago';
                    if ( isset( $data->comments ) ) {
                        $all_comments = $data->comments;
                    }
                    $insta_cap = null;
                    $videothumb = null;
                    /*
                     * Getting feeds caption.
                     */
                    if ( isset( $data->caption ) ) {
                        $insta_cap = $data->caption;
                    }
                    /*
                     * Getting feed Type.
                     */
                    $feed_type = $data->media_type;
                    // echo "<pre>"; print_r($selected_template);exit();
                    if ( 'masonary' == $selected_template ) {
                        $caption_words = 10;
                    }
                    /*
                     * If caption words is enabled.
                     */
                    $trimmed = $insta_cap;
                    if ( $caption_words && $caption_words > 0 ) {
                        $trimmed = wp_trim_words( $insta_cap, $caption_words, null );
                    }
                    $trimmed = nl2br( $this->mif_convertHashtags( $trimmed ) );
                    // echo "<pre>"; print_r($data);exit();
                    /*
                     * Feed image URL.
                     */
                    $feed_url = $data->media_url;
                    /*
                     * If feed type is video getting the video URL.
                     */
                    if ( $feed_type == 'VIDEO' ) {
                        $videothumb = $data->thumbnail_url;
                    }
                    /*
                     * Url of the feed.
                     */
                    $url = $data->permalink;
                    /*
                     * Getting feed likes.
                     */
                    $likes = $data->like_count;
                    /*
                     * Getting feed cooments.
                     */
                    $coments = $data->comments_count;
                    $name = $self_decoded_data->name;
                    $user_name = $self_decoded_data->username;
                    $user_dp = $self_decoded_data->profile_picture_url;
                    /*
                     * Getting the selected template.
                     */
                    //$selected_template = get_theme_mod('layout');
                    /*
                     * If template is not defined set it to default.
                     */
                    if ( $selected_template == '' ) {
                        $selected_template = 'grid';
                    }
                    // echo '<pre>'; print_r($selected_template); exit();
                    /*
                     * Starting buffer.
                     */
                    ob_start();
                    /*
                     * Selected Template file url.
                     */
                    $mif_templateurl = MIF_PLUGIN_DIR . 'frontend/templates/template-' . $selected_template . '.php';
                    /*
                     * Including the template file.
                     */
                    include $mif_templateurl;
                    /*
                     * Cleaning buffer.
                     */
                    ob_end_clean();
                }
                // echo "<pre>"; print_r($returner);exit();
                /* Feeds loop ends here. */
                $returner .= '</div>';
                $returner .= '<div class="mif_load_btns">
					';
                /*
                 * Follow on instgram link.
                 */
                $returner .= '<a href="http://instagram.com/' . $self_decoded_data->username . '" class="mif_follow_btn" style="" target="_blank"><i class="icon icon-esf-instagram"></i>' . __( 'Follow on Instagram', 'easy-facebook-likebox' ) . '</a>

					</div></div>';
                /*
                 * Return error if problem finding feeds.
                 */
            } else {
                // echo "<pre>"; print_r($user_id);exit();
                
                if ( empty($decoded_data->error->message) ) {
                    $error_message = __( "It seems like you haven't get the access token yet.", 'easy-facebook-likebox' );
                } else {
                    $error_message = $decoded_data->error->message;
                }
                
                if ( empty($user_id) ) {
                    $error_message = __( "It seems like you haven't provided user_id in shortcode.", 'easy-facebook-likebox' );
                }
                $returner .= '<p class="mif_error"> ' . $error_message . ' </p>';
            }
            
            //decoded if
            /*
             * Returning the html.
             */
            return $returner;
        }
        
        /* mif_shortcode_func method ends here. */
        public function mif_load_more_feeds()
        {
        }
        
        /* mif_load_more_feeds method ends here. */
        /*
         * It will get the remote URL, Retreive it and return decoded data.
         */
        public function mif_get_data( $url )
        {
            /*
             * Getting the data from remote URL.
             */
            $json_data = wp_remote_retrieve_body( wp_remote_get( $url ) );
            /*
             * Decoding the data.
             */
            $decoded_data = json_decode( $json_data );
            /*
             * Returning it to back.
             */
            return $decoded_data;
        }
        
        /* mif_mif_get_data method ends here. */
        /*
         * It will get current item number and feeds per page, Return the data accordingly.
         */
        public function mif_get_feeds(
            $feeds_per_page = null,
            $current_item = null,
            $cache_seconds = null,
            $user_id = null
        )
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $approved_pages = array();
            $decoded_data_pag = null;
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                /*
                 * Getting saved access token.
                 */
                $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
            }
            if ( $approved_pages ) {
                foreach ( $approved_pages as $key => $approved_page ) {
                    if ( isset( $approved_page['instagram_connected_account']->id ) ) {
                        if ( $approved_page['instagram_connected_account']->id == $user_id ) {
                            $access_token = $approved_page['access_token'];
                        }
                    }
                }
            }
            /*
             * Getting the array of feeds.
             */
            $self_decoded_data = $this->mif_get_bio( $user_id );
            /*
             * Making slug for user posts cache.
             */
            $mif_user_slug = "mif_user_posts-{$user_id}-{$feeds_per_page}";
            /*
             * Getting bio cached.
             */
            $decoded_data = get_transient( $mif_user_slug );
            $mif_all_feeds = null;
            if ( isset( $self_decoded_data->media_count ) && !empty($self_decoded_data->media_count) ) {
                $mif_all_feeds = $self_decoded_data->media_count;
            }
            /*
             * Remote URL of the instagram API with access token and feeds per page attribute
             */
            if ( !$decoded_data || '' == $decoded_data ) {
                
                if ( $mif_all_feeds > 0 ) {
                    $remote_url = "https://graph.facebook.com/v4.0/{$user_id}/media?fields=thumbnail_url,children{permalink,thumbnail_url,media_url,media_type},media_type,caption,comments_count,id,ig_id,like_count,is_comment_enabled,media_url,owner,permalink,shortcode,timestamp,username,comments{id,hidden,like_count,media,text,timestamp,user,username,replies{hidden,id,like_count,media,text,timestamp,user,username}}&limit=" . $feeds_per_page . "&access_token=" . $access_token;
                    // echo "<pre>"; print_r($remote_url); exit();
                    /*
                     * Getting the decoded data from instagram.
                     */
                    $decoded_data = $this->mif_get_data( $remote_url );
                    
                    if ( !isset( $decoded_data->error ) ) {
                        /*
                         * Returning back the sliced array.
                         */
                        $decoded_data = (object) array(
                            'pagination' => $decoded_data->paging->next,
                            'data'       => $decoded_data->data,
                        );
                        set_transient( $mif_user_slug, $decoded_data, $cache_seconds );
                    }
                
                }
            
            }
            /*
             * Getting the current item and feeds per page numbers and returning the sliced array.
             */
            
            if ( !empty($current_item) or !empty($feeds_per_page) ) {
                /*
                 * Getting Pagination.
                 */
                if ( isset( $decoded_data->pagination ) && !empty($decoded_data->pagination) ) {
                    $decoded_data_pag = $decoded_data->pagination;
                }
                /*
                 * Slicing the array.
                 */
                if ( isset( $decoded_data->data ) && !empty($decoded_data->data) ) {
                    $decoded_data = array_slice( $decoded_data->data, $current_item, $feeds_per_page );
                }
                /*
                 * Returning back the sliced array.
                 */
                $decoded_data = (object) array(
                    'pagination' => $decoded_data_pag,
                    'data'       => $decoded_data,
                );
            }
            
            /*
             * Returning it to back.
             */
            return $decoded_data;
        }
        
        /*
         *  Return the bio of Instagram user.
         */
        public function mif_get_bio( $user_id = null )
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $approved_pages = array();
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                /*
                 * Getting saved access token.
                 */
                $approved_pages = $fta_settings['plugins']['facebook']['approved_pages'];
            }
            if ( $approved_pages ) {
                foreach ( $approved_pages as $key => $approved_page ) {
                    if ( isset( $approved_page['instagram_connected_account']->id ) ) {
                        if ( $approved_page['instagram_connected_account']->id == $user_id ) {
                            $access_token = $approved_page['access_token'];
                        }
                    }
                }
            }
            /*
             * Making slug for bio cache.
             */
            $mif_bio_slug = "mif_user_bio-{$user_id}";
            // echo "<pre>"; print_r($mif_bio_slug);exit();
            /*
             * Getting bio cached.
             */
            $self_decoded_data = get_transient( $mif_bio_slug );
            /*
             * Remote URL of the authenticated user of instagram API with access token
             */
            
            if ( !$self_decoded_data || '' == $self_decoded_data ) {
                $mif_bio_url = "https://graph.facebook.com/v4.0/{$user_id}/?fields=biography,followers_count,follows_count,id,ig_id,media_count,name,profile_picture_url,username,website&access_token=" . $access_token;
                /* 
                 * Getting the decoded data of authenticated user from instagram.
                 */
                $self_decoded_data = $this->mif_get_data( $mif_bio_url );
                if ( 400 != $self_decoded_data->meta->code ) {
                    set_transient( $mif_bio_slug, $self_decoded_data, $cache_seconds );
                }
            }
            
            /*
             * Returning it to back.
             */
            return $self_decoded_data;
        }
    
    }
    /* MIF_Front class ends here. */
    $MIF_Front = new MIF_Front();
}
