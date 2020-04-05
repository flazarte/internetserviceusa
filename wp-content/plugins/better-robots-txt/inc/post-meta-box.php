<?php

//  Meta Box on POST TYPE
add_action( 'add_meta_boxes', 'rt_post_options' );
function rt_post_options()
{
    $post_types = array( 'post', 'page' );
    foreach ( $post_types as $post_type ) {
        add_meta_box(
            'rt_post_options',
            // id, used as the html id att
            __( 'Better Robots.txt' ),
            // meta box title
            'better_robottxt_post',
            // callback function, spits out the content
            $post_type,
            // post type or page
            'side',
            // context, where on the screen
            'low'
        );
    }
}

function better_robottxt_post( $post )
{
    global  $wpdb ;
    $rt_disallow = get_post_meta( $post->ID, 'rt_disallow', true );
    ?>

    <div class="misc-pub-section misc-pub-section-last"><span id="timestamp">

        <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="alt_text"><?php 
    echo  esc_html__( 'Disallow this post in robots.txt*', 'better-robots-txt' ) ;
    ?></label></p>

        <div class="rt-switch-radio dual-btns">

            <input type="radio" id="rt_disallow_btn1" name="rt_disallow" value="rt_disallow_yes" <?php 
    if ( isset( $rt_disallow ) ) {
        echo  'checked="checked"' ;
    }
    ?> />
            <label for="rt_disallow_btn1"><?php 
    echo  esc_html__( 'Disallow', 'better-robots-txt' ) ;
    ?></label>

            <input type="radio" id="rt_disallow_btn2" name="rt_disallow" value="rt_disallow_no" <?php 
    if ( empty($rt_disallow) ) {
        echo  'checked="checked"' ;
    }
    ?> />
            <label for="rt_disallow_btn2"><?php 
    echo  esc_html__( 'Global Setting', 'better-robots-txt' ) ;
    ?></label>  

        </div>

        <p style="margin-top: 20px;"><?php 
    echo  esc_html__( '*if activated, it will add rules in robots.txt to exclude this post from being visible on SERPs.', 'better-robots-txt' ) ;
    ?></p>

    </div>

    <?php 
}

add_action( 'save_post', 'rt_save_metadata' );
function rt_save_metadata( $postid )
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return false;
    }
    if ( !current_user_can( 'edit_page', $postid ) ) {
        return false;
    }
    if ( empty($postid) ) {
        return false;
    }
    global  $post ;
    //remove trailing slash and replace home_url from get_permalink function
    $post_path = rtrim( str_replace( home_url(), "", get_permalink( $postid ) ), '/' );
    if ( isset( $_POST['rt_disallow'] ) ) {
        $rt_disallow = sanitize_text_field( $_POST['rt_disallow'] );
    }
    $alt_safe = array( "rt_disallow_yes" );
    ( isset( $_POST['rt_disallow'] ) && in_array( $rt_disallow, $alt_safe ) ? update_post_meta( $postid, 'rt_disallow', $post_path ) : delete_post_meta( $postid, 'rt_disallow' ) );
}
