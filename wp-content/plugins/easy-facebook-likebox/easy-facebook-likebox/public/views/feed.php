<?php

/** 
 * Represents the view for the public-facing feed of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 * 
 * @package   Easy Facebook like box
 * @author    Danish Ali Malik
 * @link      https://maltathemes.com
 * @copyright 2019 MaltaThemes
 */
extract( $instance );
error_reporting( E_ERROR | E_PARSE );
/*
 * Getting main class
 */
$FTA = new Feed_Them_All();
/*
 * Getting Settings
 */
$fta_settings = $FTA->fta_get_settings();
/*
 * Facebook Settings
 */
$fb_settings = $fta_settings['plugins']['facebook'];
/*
 * Getting approved pages.
 */
$approved_pages = $fb_settings['approved_pages'];

if ( !isset( $access_token ) or !isset( $instance['fb_appid'] ) ) {
    $access_token = $fb_settings['access_token'];
    if ( empty($access_token) ) {
        $access_token = '222116127877068|4223b75bbcf692242b677db0c08d9b56';
    }
}

if ( isset( $instance['fb_appid'] ) and !empty($instance['fb_appid']) ) {
    $access_token = $instance['fb_appid'];
}
$test_mode = false;
if ( empty($fanpage_id) ) {
    $page_id = $fanpage_url;
}
if ( empty($fanpage_url) ) {
    $page_id = $fanpage_id;
}
if ( empty($fanpage_id) && empty($fanpage_url) ) {
    $page_id = '617177998743210';
}
if ( is_customize_preview() ) {
    $page_id = get_option( 'efbl_account_id', false );
}
$page_id = efbl_parse_url( $page_id );
// echo "<pre>"; print_r($page_id);exit();
$efbl_page_slug = is_numeric( $page_id );
if ( $approved_pages ) {
    foreach ( $approved_pages as $efbl_page ) {
        if ( !$efbl_page_slug && $efbl_page['username'] && $efbl_page['username'] == $page_id ) {
            $page_id = $efbl_page['id'];
        }
        if ( $efbl_page['id'] == $page_id ) {
            $own_access_token = $efbl_page['access_token'];
        }
    }
}
$post_limit = ( $post_limit ? $post_limit : '10' );
$number_of_posts = ( $post_number ? $post_number : '10' );
if ( isset( $layout ) && !empty($layout) ) {
    
    if ( $layout == 'half' ) {
        $layout = 'halfwidth';
    } elseif ( $layout == 'full' ) {
        $layout = 'fullwidth';
    }

}
$image_size = ( $image_size ? $image_size : 'normal' );
$link_target = ( $links_new_tab ? '_blank' : '_self' );

if ( empty($show_logo) || $show_logo == 0 ) {
    $show_logo = 0;
} else {
    $show_logo = 1;
}


if ( empty($show_image) || $show_image == 0 ) {
    $show_image = 0;
} else {
    $show_image = 1;
}

if ( empty($cache_unit) ) {
    $cache_unit = 5;
}
if ( $cache_unit < 1 ) {
    $cache_unit = 1;
}
//Calculate the cache time in seconds
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
//setting query for "Show Posts By"
$query = 'posts';
$others_only = false;

if ( $post_by == 'me' ) {
    $query = 'posts';
} else {
    
    if ( $post_by == 'others' ) {
        $query = 'feed';
    } else {
        
        if ( $post_by == 'onlyothers' ) {
            $query = 'feed';
            $others_only = true;
        }
    
    }

}

$enable_popup_for = array( 'photo', 'video' );
$page_name = $approved_pages[$page_id]['name'];
$trasneint_name = 'efbl_' . $query . '_' . str_replace( ' ', '', $page_name ) . '-' . $post_limit;
if ( empty($page_name) ) {
    $trasneint_name = 'efbl_' . $query . '_' . str_replace( ' ', '', $page_id ) . '-' . $post_limit;
}
global  $efbl_skins ;
if ( is_customize_preview() ) {
    $skin_id = get_option( 'efbl_skin_id', false );
}
//if(isset($instance['clear_cache']) && !empty($instance['clear_cache'])) delete_transient( $trasneint_name );
// delete_transient($trasneint_name); exit();
$is_saved_posts = false;
$next_post_url = null;
$posts_json = get_transient( $trasneint_name );
if ( isset( $posts_json ) && !empty($posts_json) ) {
    $is_saved_posts = true;
}
if ( $approved_pages ) {
    foreach ( $approved_pages as $key => $approved_page ) {
        if ( $approved_page['id'] == $page_id ) {
            $own_access_token = $approved_page['access_token'];
        }
    }
}
if ( empty($own_access_token) ) {
    $own_access_token = $fb_settings['access_token'];
}

if ( efl_fs()->is_free_plan() && !array_key_exists( $page_id, $approved_pages ) ) {
    reset( $approved_pages );
    $result = key( $approved_pages );
    $page_id = $result;
    $own_access_token = $approved_pages[$page_id]['access_token'];
}

$jws_api_url = 'https://graph.facebook.com/v4.0/' . $page_id . '/?fields=posts.limit(' . $post_limit . '){status_type,full_picture,permalink_url,likes{pic_crop,id,name},comments.limit(30){id,like_count,permalink_url,likes.limit(10),comments,reactions,comment_count,created_time,message,message_tags,attachment},reactions{id,name,pic_crop,type,link},created_time,story,message,reactions.type(LIKE).limit(0).summary(1).as(like),reactions.type(LOVE).limit(0).summary(1).as(love),reactions.type(HAHA).limit(0).summary(1).as(haha),reactions.type(WOW).limit(0).summary(1).as(wow),reactions.type(SAD).limit(0).summary(1).as(sad),reactions.type(ANGRY).limit(0).summary(1).as(angry),from,message_tags,shares,story_tags,picture,attachments,via,to,with_tags,dynamic_posts},about,picture{url}&access_token=' . $own_access_token . '&locale=en_us';
if ( isset( $accesstoken ) && !empty($accesstoken) ) {
    $own_access_token = $accesstoken;
}

if ( !$posts_json || '' == $posts_json || $test_mode ) {
    //build query
    $jws_api_url = 'https://graph.facebook.com/' . $page_id . '/' . $query . '?access_token=' . $access_token . '&limit=' . $post_limit . '&locale=en_us';
    $jws_api_url = 'https://graph.facebook.com/v4.0/' . $page_id . '/?fields=posts.limit(' . $post_limit . '){status_type,full_picture,permalink_url,likes{pic_crop,id,name},comments.limit(30){id,like_count,permalink_url,likes.limit(10),comments,reactions,comment_count,created_time,message,message_tags,attachment},reactions{id,name,pic_crop,type,link},created_time,story,message,reactions.type(LIKE).limit(0).summary(1).as(like),reactions.type(LOVE).limit(0).summary(1).as(love),reactions.type(HAHA).limit(0).summary(1).as(haha),reactions.type(WOW).limit(0).summary(1).as(wow),reactions.type(SAD).limit(0).summary(1).as(sad),reactions.type(ANGRY).limit(0).summary(1).as(angry),from,message_tags,shares,story_tags,picture,attachments,via,to,with_tags,dynamic_posts},about,picture{url}&access_token=' . $own_access_token . '&locale=en_us';
    // echo $jws_api_url;exit;
    //set json data
    $posts_json = jws_fetchUrl( $jws_api_url );
    $json_decoded = json_decode( $posts_json );
    //store in databse if not in test mode
    if ( !$test_mode && !empty($json_decoded->posts->data) ) {
        set_transient( $trasneint_name, $posts_json, $cache_seconds );
    }
    //exit('nocahe found');
} else {
    //echo 'usign cached object ... ';
    //echo 'Number of seconds '.$cache_seconds.'<br>';
}

$json_decoded = json_decode( $posts_json );
$fbData = $json_decoded->posts->data;
$selected_skin = $instance['layout'];
if ( !$instance['layout'] && empty($instance['layout']) ) {
    $selected_skin = $efbl_skins[$skin_id]['design']['layout_option'];
}

if ( is_customize_preview() ) {
    $skin_id = get_option( 'efbl_skin_id', false );
    $efbl_skin_values = get_option( 'efbl_skin_' . $skin_id, false );
    $selected_skin = $efbl_skin_values['layout_option'];
    // echo "<pre>";print_r($efbl_skin_values);echo "</pre>";
}

// plan end

if ( !$json_decoded->error ) {
    // unset($fbData['0']);
    $page_logo_trasneint_name = "esf_logo_" . $page_id;
    $auth_img_src = get_transient( $page_logo_trasneint_name );
    
    if ( !$auth_img_src || '' == $auth_img_src || $test_mode ) {
        //Get the image suource of author
        $auth_img_src = 'https://graph.facebook.com/' . $page_id . '/picture?type=large&redirect=0&access_token=' . $own_access_token;
        if ( $auth_img_src ) {
            $auth_img_src = json_decode( jws_fetchUrl( $auth_img_src ) );
        }
        if ( $auth_img_src->data->url ) {
            $auth_img_src = $auth_img_src->data->url;
        }
        //Store in a transient for 6 months
        $auth_img_src = set_transient( $page_logo_trasneint_name, $auth_img_src, 180 * 60 * 60 * 24 );
        // echo "<pre>"; print_r($auth_img_src);exit();
    }
    
    $returner = null;
    $rand_id = mt_rand( 1, 10 );
    $efbl_bio_data = efbl_get_page_bio( $page_id, $access_token, $cache_seconds );
    $page_meta = $fb_settings['approved_pages'][$page_id];
    //Start wraper of feed
    $returner .= '<div class="efbl_feed_wraper efbl_skin_' . $skin_id . '" id="efbl_feed_' . $rand_id . '">';
    
    if ( $efbl_bio_data ) {
        $returner .= '<div class="efbl_header">
					<div class="efbl_header_inner_wrap">
						<div class="efbl_header_img">
							<a href="https://www.facebook.com/' . $efbl_bio_data->id . '" target="_blank"><img src="' . $auth_img_src . '"/>
							</a>
						</div>
						<div class="efbl_header_meta">
							<h4 class="efbl_header_title">' . $efbl_bio_data->name . '</h4>';
        if ( $efbl_bio_data->category ) {
            $returner .= '<div class="efbl_cat" title="' . __( 'Category', 'easy-facebook-likebox' ) . '"><i class="icon icon-esf-tag" aria-hidden="true"></i>' . $efbl_bio_data->category . '</div>';
        }
        if ( $efbl_bio_data->fan_count ) {
            $returner .= '<div class="efbl_followers" title="' . __( 'Followers', 'easy-facebook-likebox' ) . '""><i class="icon icon-esf-user" aria-hidden="true"></i>' . efbl_readable_count( $efbl_bio_data->fan_count ) . '</div>';
        }
        $returner .= '<p class="efbl_bio">' . wp_trim_words( $efbl_bio_data->about, 55, null ) . '</p>
						</div>
					</div>
				</div>';
    }
    
    $is_sliced = false;
    $fbData = array_slice( $fbData, 0, $post_limit );
    if ( isset( $fbData ) && !empty($fbData) ) {
        $is_sliced = true;
    }
    
    if ( $fbData ) {
        $i = null;
        $pi = 1;
        // increment counter for popup gallery
        $efbl_skin = $efbl_skins[$skin_id]['design'];
        if ( empty($layout) ) {
            $layout = $selected_skin;
        }
        if ( $layout == 'half' ) {
            $layout = 'halfwidth';
        }
        if ( $layout == 'full' ) {
            $layout = 'fullwidth';
        }
        if ( empty($layout) ) {
            $layout = 'halfwidth';
        }
        // echo "<pre>"; print_r($layout);exit();
        $carousel_class = null;
        $carousel_atts = null;
        // echo "<pre>"; print_r($fbData['2']); echo "</pre>"; exit();
        $returner .= '<div class="efbl_feeds_holder efbl_feeds_' . $layout . ' ' . $carousel_class . '" ' . $carousel_atts . ' data-template="' . $layout . '">';
        if ( 'masonry' == $layout ) {
            $returner .= '<div class="efbl-masonry-sizer"></div> <div class="efbl-gutter-sizer"></div>';
        }
        foreach ( $fbData as $story ) {
            $efbl_comments_count = 0;
            //to check for the number of posts specified
            // if($i == $post_limit) break;
            $post_text = null;
            $story_id = $story->id;
            //get the feed type
            $feed_type = $story->status_type;
            $efbl_likes_count = $story->like->summary->total_count + $story->love->summary->total_count + $story->haha->summary->total_count + $story->wow->summary->total_count + $story->sad->summary->total_count + $story->angry->summary->total_count;
            if ( 'events' == $filter or 'albums' == $filter or 'videos' == $filter or 'images' == $filter or 'mentioned' == $filter ) {
                $efbl_likes_count = count( $story->reactions->data );
            }
            if ( isset( $story->comments->data ) ) {
                $efbl_comments_count = count( $story->comments->data );
            }
            if ( !$efbl_comments_count ) {
                $efbl_comments_count = 0;
            }
            //getting number of shares
            $shares = $story->shares;
            //get the time of story
            $time = $story->created_time;
            if ( 'events' == $filter ) {
                $time = $story->updated_time;
            }
            //convert time into minutes/days ago.
            $time = efbl_time_ago( $time );
            $story_link = 'https://www.facebook.com/' . $story->id;
            $pic_class = "efbl_no_image";
            if ( $story->full_picture && 'shared_story' !== $feed_type ) {
                $pic_class = "efbl_has_image";
            }
            ( isset( $story->message_tags ) ? $text_tags = $story->message_tags : ($text_tags = $story->story_tags) );
            //Get the original story
            if ( !empty($story->story) ) {
                $post_text = htmlspecialchars( $story->story );
            }
            //get mesasge
            if ( !empty($story->message) ) {
                $post_text = htmlspecialchars( $story->message );
            }
            $post_plain_text = $post_text;
            $html_check_array = array(
                '&lt;',
                '’',
                '“',
                '&quot;',
                '&amp;',
                '#',
                'http'
            );
            //Convert links url to html links
            $post_text = ecff_makeClickableLinks( $post_text, array( 'http', 'mail' ), array(
                'target' => $link_target,
            ) );
            //convert hastags into links
            $post_text = ecff_hastags_to_link( $post_text );
            //always use the text replace method
            
            if ( ecff_stripos_arr( $post_text, $html_check_array ) !== false ) {
                //Loop through the tags
                if ( $text_tags ) {
                    foreach ( $text_tags as $message_tag ) {
                        $tag_name = $message_tag->name;
                        $tag_link = '<a href="https://facebook.com/' . $message_tag->id . '" target="' . $link_target . '">' . $tag_name . '</a>';
                        $post_text = str_replace( $tag_name, $tag_link, $post_text );
                    }
                }
            } else {
                //not html found now use manaul loop
                $message_tags_arr = array();
                $j = 0;
                if ( $text_tags ) {
                    foreach ( $text_tags as $message_tag ) {
                        $j++;
                        $tag_name = $message_tag->name;
                        $tag_link = '<a href="https://facebook.com/' . $message_tag->id . '" target="' . $link_target . '">' . $message_tag->name . '</a>';
                        $post_text = str_replace( $tag_name, $tag_link, $post_text );
                    }
                }
            }
            
            if ( isset( $words_limit ) && $words_limit > 0 ) {
                $post_text = wp_trim_words( $post_text, $words_limit, null );
            }
            $words_limit = preg_replace( '/<iframe.*?\\/iframe>/i', '', $words_limit );
            $feed_img = $story->full_picture;
            if ( !empty($feed_img) && 'shared_story' != $feed_type ) {
                $pic_class = "efbl_has_image";
            }
            $video_source = $story->attachments->data['0']->media->source;
            //plan end
            $video_iframe = null;
            $story_attach_type = $story->attachments->data['0']->type;
            if ( $story_attach_type == 'video_inline' && empty($video_source) ) {
                $video_iframe = '<iframe type="text/html" width="720"  height="512" src="https://www.facebook.com/v2.3/plugins/video.php?href=' . $story->attachments->data['0']->url . '?autoplay=1&amp;mute=0&width=720&height=512" allowfullscreen="" frameborder="0" webkitallowfullscreen="" mozallowfullscreen=""></iframe>';
            }
            $story_from_name = $story->from->name;
            if ( 'events' == $filter ) {
                $story_from_name = $story->owner->name;
            }
            //get author image src
            $author_image = '<a href="https://facebook.com/' . $page_id . '" title="' . $story->name . '" target="' . $link_target . '"><img alt="' . $story->name . '" src="' . $auth_img_src . '" title="' . $story->from->name . '" width="40" height="40" /></a>';
            if ( isset( $words_limit ) && !empty($words_limit) ) {
                $post_text = wp_trim_words( $post_text, $words_limit );
            }
            $post_text = ecff_hastags_to_link( $post_text );
            $post_text = ecff_makeClickableLinks( $post_text, array( 'http', 'mail', 'https' ), array(
                'target' => $link_target,
            ) );
            /*
             * Starting buffer.
             */
            ob_start();
            /*
             Selected Template file url.
            */
            $efbl_templateurl = EFBL_PLUGIN_DIR . 'public/views/templates/template-' . $layout . '.php';
            /*
             * Including the template file.
             */
            require $efbl_templateurl;
            /*
             * Cleaning buffer.
             */
            ob_end_clean();
            $i++;
            if ( 'added_photos' == $feed_type or 'added_video' == $feed_type ) {
                $pi++;
            }
        }
        $returner .= '</div>';
        /*
         * Combinig shortcode atts for getting feeds from instagram api.
         */
        $combined_atts = $post_limit . ',' . $words_limit . ',' . $skin_id . ',' . $cache_seconds . ',' . $page_id . ',' . $layout . ',' . $trasneint_name . ',' . $filter . ',' . $events_filter;
        $efbl_load_more_text = __( apply_filters( 'efbl_load_more_text', 'Load More' ), 'easy-facebook-likebox' );
        $efbl_loading_text = __( apply_filters( 'efbl_loading_text', 'Loading' ), 'easy-facebook-likebox' );
        $efbl_no_more_posts = __( apply_filters( 'efbl_no_more_posts', 'No More Found' ), 'easy-facebook-likebox' );
        $efbl_view_all_events = __( apply_filters( 'efbl_view_all_events', 'View All Events' ), 'easy-facebook-likebox' );
        if ( !$is_saved_posts && empty($next_post_url) ) {
            $load_btn_disabled = 'no-more';
        }
    } else {
        
        if ( $filter ) {
            $returner .= '<p class="efbl_error_msg">' . __( "{$efbl_bio_data->name} don't have any {$filter}.", 'easy-facebook-likebox' ) . '</p>';
        } else {
            $returner .= '<p class="efbl_error_msg">' . __( 'Whoops! Nothing found according to your query, Try changing parameters to see posts.', 'easy-facebook-likebox' ) . '</p>';
        }
    
    }
    
    //empty end
    //Display like box here if enabled
    if ( $show_like_box ) {
        $returner .= '<div class="efbl_custom_likebox">' . do_shortcode( '[efb_likebox fanpage_url="' . $page_id . '" box_width="" box_height="500" colorscheme="light" locale="en_US" responsive="1" show_faces="0" show_header="0" show_stream="0" show_border="0" ]' ) . '</div>';
    }
    $returner .= '<input type="hidden" id="item_number" value=""></div>';
    echo  $returner ;
} else {
    // echo "<pre>"; print_r($json_decoded);exit();
    $error_msg = $json_decoded->error->message;
    
    if ( $fbData->error->code == 10 ) {
        $error_msg = __( 'Please authenticate your Facebook pages from Easy Facebook Like Box settings page and use page id of approved pages only', 'easy-facebook-likebox' );
    } else {
        echo  '<p class="efbl_error_msg">' . __( 'Error: ', 'easy-facebook-likebox' ) . '' . $error_msg . '</p>' ;
    }

}
