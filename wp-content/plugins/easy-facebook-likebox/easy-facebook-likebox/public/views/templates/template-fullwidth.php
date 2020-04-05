<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
list( $efbl_feed_width, $efbl_feed_height, $type, $attr ) = getimagesize( $feed_img );
$efbl_ver = 'free';
if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
    $efbl_ver = 'pro';
}
$efbl_free_popup_type = 'data-imagelink="' . $feed_img . '"';
$efbl_free_popup_class = null;

if ( 'added_video' == $feed_type && !empty($video_source) ) {
    $efbl_free_popup_type = 'data-video="' . $video_source . '"';
    $efbl_free_popup_class = 'efbl_popup_video';
}

$returner .= '<div id="efblcf" class="efbl_fb_story efbl_ver_' . $efbl_ver . ' ' . $layout . ' ' . $feed_type . ' ' . $pic_class . ' efbl_' . $filter . '">';

if ( 'efbl_has_image' == $pic_class ) {
    $returner .= '<div class="efbl_story_photo">';
    $returner .= '<a href="' . admin_url( 'admin-ajax.php' ) . '?action=efbl_generate_popup_html&rand_id=' . $rand_id . '" ' . $efbl_free_popup_type . ' data-storylink="' . $story_link . '"  data-linktext="' . __( 'Read full story', 'easy-facebook-likebox' ) . '" data-caption="' . htmlentities( $post_text ) . '" data-itemnumber="' . $pi . '" class="efbl_feed_popup ' . $efbl_free_popup_class . ' efbl-cff-item_number-' . $pi . '"><span class="efbl_hover"><i class="icon icon-esf-plus" aria-hidden="true"></i></span></a>';
    if ( $efbl_ver !== 'pro' ) {
        
        if ( 'added_video' == $feed_type && !empty($video_source) ) {
            // echo "<pre>"; print_r($video_source);exit();
            $returner .= '<video src="' . $video_source . '" controls>
                                                  Your browser does not support HTML5 video.
                                                </video>';
        } else {
            $returner .= '<img alt="' . $story_from_name . '" src="' . $feed_img . '" />';
        }
    
    }
    // Plan end
    $returner .= '</a></div>';
}

$returner .= '<div class="efbl_post_content">';
//Author information
$returner .= '<div class="efbl_author_info">';
$returner .= '<div class="efbl_auth_logo">' . $author_image . '</div>';
$returner .= '<div class="efbl_name_date">
                                            
                                            <p class="efbl_author_name"> <a href="https://facebook.com/' . $page_id . '" target="' . $link_target . '">' . $story_from_name . '</a></p>
                                            
                                            <p class="efbl_story_time">' . $time . '</p>
                                            
                                    </div>
                                     
                                </div>';
//plan end
//Story content
$returner .= '<p class="efbl_story_text">' . nl2br( $post_text ) . '</p>';
//Plan end

if ( 'shared_story' == $feed_type ) {
    // echo "<pre>"; print_r($story->attachments->data['0']); echo '</pre>'; exit();
    
    if ( $story->picture ) {
        $link_image = 'efbl_has_link_image';
    } else {
        $link_image = 'efbl_no_link_image';
    }
    
    $returner .= '<div class="efbl_shared_story ' . $link_image . ' ">';
    if ( $story->picture ) {
        $returner .= '<a href="' . $story->attachments->data['0']->url . '" class="efbl_link_image" re="nofollow" target="' . $link_target . '"><img alt="' . $story->name . '" src="' . $story->picture . '" /></a>';
    }
    $returner .= '<div class="efbl_link_text">';
    $returner .= '<p class="efbl_title_link"><a href="' . $story->attachments->data['0']->url . '" target="' . $link_target . '">' . $story->attachments->data['0']->title . '</a></p>';
    $returner .= '<p class="efbl_link_description">' . $story->attachments->data['0']->description . '</p>';
    $returner .= '</div>';
    $returner .= '</div>';
}

// shared story link
$returner .= '</div>';
//Story meta
$returner .= '<div class="efbl_story_meta">';
//do not show whole container if none of these available

if ( !empty($efbl_skins[$skin_id]['design']['show_comments']) || !empty($efbl_skins[$skin_id]['design']['show_likes']) || !empty($efbl_skins[$skin_id]['design']['show_shares']) ) {
    
    if ( $efbl_likes_count > 0 || $story->shares->count > 0 || $efbl_comments_count > 0 ) {
        $returner .= '<div class="efbl_info">';
        if ( $efbl_likes_count > 0 ) {
            $returner .= '<span class="efbl_likes">
                                                        <span class="efbl_like_text"><i class="icon icon-esf-thumbs-o-up"></i></span>
                                                        <span class="efbl_likes_counter"> ' . $efbl_likes_count . ' </span>                                             
                                                    </span>';
        }
        if ( $efbl_comments_count > 0 ) {
            $returner .= '<span class="efbl_comments">
                                                        <span class="efbl_comments_text"><i class="icon icon-esf-comment-o"></i></span>
                                                        <span class="efbl_comments_counter"> ' . $efbl_comments_count . ' </span>
                                                    </span>';
        }
        if ( $story->shares->count > 0 ) {
            $returner .= '<span class="efbl_shares">
                                                        <span class="efbl_shares_text"><i class="icon icon-esf-share"></i></span> 
                                                        <span class="efbl_shares_counter"> ' . $story->shares->count . ' </span>
                                                    </span>';
        }
        $returner .= '</div>';
    }
    
    if ( $filter !== 'albums' ) {
        $read_more_text = __( apply_filters( 'efbl_read_more_text', 'Read full story' ), 'easy-facebook-likebox' );
    }
    $share_this_text = __( apply_filters( 'efbl_share_text', 'Share' ), 'easy-facebook-likebox' );
}

$returner .= '<!--Readmore div started-->
                                        <div class="efbl_read_more_link">
                                            <a href="' . $story_link . '" target="' . $link_target . '" class="efbl_read_full_story">' . $read_more_text . '</a>                                    
                                             
                                            <a href="javascript:void(0)" class="efbl_share_links">' . $share_this_text . '</a>
                                                
                                                <span class="efbl_links_container">
                                                    <a class="efbl_facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . $story_link . '" target="' . $link_target . '"><i class="icon icon-esf-facebook"></i></a>
                                                    
                                                    <a class="efbl_twitter" href="https://twitter.com/intent/tweet?text=' . $story_link . '" target="' . $link_target . '"><i class="icon icon-esf-twitter"></i></a>
                                                    
                                                    <a class="efbl_linked_in" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $story_link . '" target="' . $link_target . '"><i class="icon icon-esf-linkedin"></i></a>
                                                    
                                                </span>
                                                
                                        </div>
                                        <!--Readmore div end-->';

if ( !empty($efbl_skins[$skin_id]['design']['show_comments']) ) {
    if ( $efbl_comments_count > 0 ) {
        //Comments area started
        $returner .= '<div class="efbl_comments_wraper">';
    }
    
    if ( $efbl_likes_count > 0 ) {
        $like_text = __( apply_filters( 'efbl_like_this_text', 'like this.' ), 'easy-facebook-likebox' );
        $and_text = __( apply_filters( 'efbl_and_text', 'and ' ), 'easy-facebook-likebox' );
        $other_text = __( apply_filters( 'efbl_other_text', 'other ' ), 'easy-facebook-likebox' );
        $others_text = __( apply_filters( 'efbl_others_text', 'others ' ), 'easy-facebook-likebox' );
    }
    
    
    if ( count( $story->comments->data ) > 0 ) {
        $ci = 1;
        foreach ( $story->comments->data as $comment ) {
            $comment_likes = $comment->like_count;
            $comment_message = htmlspecialchars( $comment->message );
            $comment_time = efbl_time_ago( $comment->created_time );
            //do not show more than 10 comments
            if ( $ci == 5 ) {
                break;
            }
            // echo "<pre>"; print_r($comment);exit();
            $returner .= '<div class="efbl_comments">';
            $returner .= '<div class="efbl_commenter_image">';
            $returner .= '<a href="https://facebook.com/' . $comment->id . '" target="' . $link_target . '" rel="nofollow" title="' . $story->name . '"> 
                                                                        <img alt="' . $story->name . '" src="' . EFBL_PLUGIN_URL . '/assets/fb-avatar.png" width=32 height=32>
                                                                    </a>';
            $returner .= '</div>';
            $returner .= '<div class="efbl_comment_text">';
            $returner .= '<a  title="' . $story->name . '" class="efbl_comenter_name" href="https://facebook.com/' . $comment->from->id . '" target="' . $link_target . '" rel="nofollow"> 
                                                                          ' . $comment->from->name . '
                                                                    </a>';
            $returner .= '<p class="efbl_comment_message">' . $comment_message . '</p>';
            $returner .= '<p class="efbl_comment_time_n_likes">';
            if ( $comment_likes ) {
                $returner .= '<span class="efbl_comment_like"><i class="icon icon-esf-thumbs-o-up"></i>&nbsp;' . $comment_likes . '</span> - ';
            }
            $returner .= '<span class="efbl_comment_time">' . $comment_time . '</span> </p>';
            $returner .= '</div>';
            //comments text
            $returner .= '</div>';
            $ci++;
        }
        $comment_more_text = __( apply_filters( 'efbl_comment_on_text', 'comment on facebook' ), 'easy-facebook-likebox' );
        $returner .= '<div class="efbl_comments_footer">
                                            <a href="' . $story_link . '" target="' . $link_target . '" rel="nofollow"><i class="icon icon-esf-comment-o"></i> ' . $comment_more_text . ' </a>
                                        </div>';
    }
    
    if ( $efbl_comments_count > 0 ) {
        //Comments area ends here
        $returner .= '</div>';
    }
}

// echo "<pre>"; print_r($returner);exit();
$returner .= '</div>';
// Plan end
$returner .= '</div>';