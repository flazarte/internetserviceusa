<?php

/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Easy Facebook Likebox
 * @author    Danish Ali Malik
 * @license   GPL-2.0+
 * @link      https://maltathemes.com
 * @copyright 2019 MaltaThemes
 */
/*
 * Getting main class
 */
$FTA = new Feed_Them_All();
/*
 * Getting Settings
 */
$fta_settings = $FTA->fta_get_settings();
$efbl_likebox_html = null;
/*
 * Facebook Settings
 */
$options = $fta_settings['plugins']['facebook'];
$delay = 1000;
if ( isset( $options['efbl_popup_interval'] ) ) {
    $delay = $options['efbl_popup_interval'];
}
$width = null;
if ( isset( $options['efbl_popup_width'] ) ) {
    $width = $options['efbl_popup_width'];
}
$height = null;
if ( isset( $options['efbl_popup_height'] ) ) {
    $height = $options['efbl_popup_height'];
}
if ( isset( $options['efbl_popup_shortcode'] ) ) {
    $shortcode = stripslashes( $options['efbl_popup_shortcode'] );
}
$efbl_ver = 'free';
if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
    $efbl_ver = 'pro';
}
if ( $efbl_ver == 'free' ) {
    $exit_intent = 0;
}
if ( isset( $options['exit_intent'] ) ) {
    $exit_intent = $options['exit_intent'];
}
if ( !isset( $exit_intent ) && empty($exit_intent) ) {
    $exit_intent = 0;
}

if ( isset( $options['efbl_enable_popup'] ) ) {
    $popup_class = null;
    if ( empty($shortcode) ) {
        $popup_class = 'efbl_popup_empty';
    }
    ?>
<div style="display:none">
<a class="popup-with-form efbl_popup_trigger" href="#efbl_popup" >Inline</a>
</div>

<!-- This file is used to markup the public facing aspect of the plugin. -->

<div id="efbl_popup" class="white-popup <?php 
    echo  $popup_class ;
    ?>  mfp-hide" style="width:<?php 
    echo  $width ;
    ?>px; height:<?php 
    echo  $height ;
    ?>px">
		<?php 
    
    if ( empty($shortcode) ) {
        
        if ( is_user_logged_in() ) {
            $efbl_setting_direct_link = admin_url( 'admin.php?page=easy-facebook-likebox#efbl-auto-popup' );
            $efbl_setting_direct_link_html = '<a target="_blank" href="' . $efbl_setting_direct_link . '">' . __( 'Take me there', 'easy-facebook-likebox' ) . '</a>';
        } else {
            $efbl_setting_direct_link_html = null;
        }
        
        $efbl_likebox_html .= '<p>' . __( 'OOPS! It seems like popup content field is empty, Please add the following shortcode to Popup Content field from Facebook > Auto Popup settings ' . $efbl_setting_direct_link_html . '.', 'easy-facebook-likebox' ) . '</p>';
        $efbl_likebox_html .= '<p>[efb_likebox fanpage_url="maltathemes" box_width="250" box_height="" locale="en_US" responsive="0" show_faces="1" show_stream="0" hide_cover="0" small_header="0" hide_cta="0" animate_effect="fadeIn" ]</p>';
        $efbl_likebox_html .= '<p>' . __( "Don't forget to replace the maltathemes with your page ID", 'easy-facebook-likebox' ) . '</p>';
        echo  $efbl_likebox_html ;
    } else {
        echo  do_shortcode( $shortcode ) ;
    }
    
    ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	/*$.removeCookie('dont_show', { path: '/' });  */
<?php 
    ?>
	// console.log(trackLeave());
	
	 $('.popup-with-form').magnificPopup({
          type: 'inline',
          preloader: false,
		  
		  <?php 
    if ( isset( $options['efbl_do_not_show_again'] ) and $options['efbl_do_not_show_again'] == 1 ) {
        ?>
		  callbacks: {
			  close: function() {
 				  $.cookie('dont_show', '1' ,{ expires: 7, path: '/' } );	
			  }
		  },
		  <?php 
    }
    ?>
 	 	 
         });
	 
  	<?php 
    
    if ( !$exit_intent ) {
        ?>
	
	if( $.cookie('dont_show') != 1) 
		openFancybox(<?php 
        echo  $delay ;
        ?>);

	<?php 
    }
    
    ?>

	<?php 
    ?>

});

function openFancybox(interval) {
    setTimeout( function() {jQuery('.efbl_popup_trigger').trigger('click'); },interval);
}
</script>
<?php 
}
