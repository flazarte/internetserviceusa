<?php

// free only notices
// pro notification
function rt_notice_subscribe()
{
    if ( !PAnD::is_admin_notice_active( 'notice-subcribe-120' ) ) {
        return;
    }
    $purchase_url = "options-general.php?page=better-robots-txt-pricing";
    $getpro = sprintf( wp_kses( __( 'Better Robotstxt - Boost your Google ranking with <a href="%s" target="_blank">Better Robots.txt PRO</a> plugin | Get 10&#37; OFF if you subscribe here:', 'better-robots-txt' ), array(
        'a' => array(
        'href'   => array(),
        'target' => array(),
    ),
    ) ), esc_url( $purchase_url ) );
    ?>
        <div data-dismissible="notice-subcribe-120" class="notice rt-notice notice-success is-dismissible">
            <p class="rt-p"><?php 
    echo  $getpro ;
    ?></p>
            <form action="https://Pagup.us14.list-manage.com/subscribe/post?u=a706b8e968389b05725c65849&amp;id=9c762f94b8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate rt-form-notice" target="_blank" novalidate>

                <input type="email" value="" name="EMAIL" class="rt-field-notice" placeholder="<?php 
    echo  __( 'Email address', 'better-robots-txt' ) ;
    ?>" required>

                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a706b8e968389b05725c65849_b802a7a540" tabindex="-1" value=""></div>
                <div class="clear rt-clear-notice"><input type="submit" value="<?php 
    echo  __( 'Subscribe', 'better-robots-txt' ) ;
    ?>" name="subscribe" id="mc-embedded-subscribe" class="rt-btn-notice"></div>

            </form>
        </div>

        <?php 
}

function rt_notice_rate()
{
    if ( !PAnD::is_admin_notice_active( 'notice-rating-120' ) ) {
        return;
    }
    ?>
    
            <div data-dismissible="notice-rating-120" class="notice rt-notice notice-success is-dismissible">
                <p class="rt-p"><?php 
    $rating_url = "https://wordpress.org/support/plugin/better-robots-txt/reviews/?rate=5#new-post";
    $show_support = sprintf( wp_kses( __( 'Show support for Better Robots.txt with a 5-star rating » <a href="%s" target="_blank">Click here</a>', 'better-robots-txt' ), array(
        'a' => array(
        'href'   => array(),
        'target' => array(),
    ),
    ) ), esc_url( $rating_url ) );
    echo  $show_support ;
    ?></p>
            </div>
    <?php 
}

add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'rt_notice_subscribe' );
add_action( 'admin_notices', 'rt_notice_rate' );
// end free only