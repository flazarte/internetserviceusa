<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $feed_type == 'VIDEO' ) {
    $feed_url = $videothumb;
}
list( $mif_feed_width, $mif_feed_height, $type, $attr ) = getimagesize( $feed_url );
//======================================================================
// File for the Frontend funcionality of My Instagram Feeds
//======================================================================
$returner .= '<div  class="mif_single mif_grid_layout feed_type_' . strtolower( $feed_type ) . ' ' . $mif_values['feed_image_filter'] . '" style="background-image:url(' . $feed_url . ')">

									<span class="mif_overlay">';
$returner .= '</span>';
$returner .= '<img class="mif_feed_image ' . $mif_values['feed_image_filter'] . '" src="' . $feed_url . '"/>';
$returner .= '<div class="video_icon"> </div><span class="mif_carousel_icon"><i class="icon icon-esf-clone"></i></span><div class="mif_content_holder">';
if ( $videothumb ) {
    $feed_url = $data->media_url;
}
$returner .= '<a class="mif_feed_popup_free mif_feed_popup_free_hide" target="_blank" href="' . $url . '"><i class="icon icon-esf-plus"></i></a>';
$returner .= '</div></div>';