<?php

/**
 * Plugin Name: Easy Social Feed
 * Plugin URI:        httt://wordpress.org/plugins/easy-facebook-likebox
 * Description:       Formerly "Easy Facebook Like Box and Custom Facebook Feed" plugin allows you to easily display custom facebook feed, custom Instagram photos and videos feed, page plugin (like box) on your website using either widget or shortcode to increase facbook fan page likes. You can use the shortcode generator. Additionally it also now allows you to dipslay the customized facebook feed on your website using the same color scheme of your website. Its completely customizable with lots of optional settings. Its also responsive facebook like box at the same time.
 * Version:           5.2.4
 * Author:            Danish Ali Malik 
 * Author URI:        https://maltathemes.com/danish-ali-malik
 * Text Domain:       easy-facebook-likebox,
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
//error_reporting(0);
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'efl_fs' ) ) {
    efl_fs()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'efl_fs' ) ) {
        // Create a helper function for easy SDK access.
        function efl_fs()
        {
            global  $efl_fs ;
            
            if ( !isset( $efl_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $efl_fs = fs_dynamic_init( array(
                    'id'              => '4142',
                    'slug'            => 'easy-facebook-likebox',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_d982f4dff842224ca5e54c84f6822',
                    'is_premium'      => false,
                    'has_addons'      => false,
                    'has_paid_plans'  => true,
                    'trial'           => array(
                    'days'               => 7,
                    'is_require_payment' => true,
                ),
                    'has_affiliation' => 'all',
                    'menu'            => array(
                    'support'    => false,
                    'slug'       => 'feed-them-all',
                    'first-path' => 'admin.php?page=esf_welcome',
                ),
                    'is_live'         => true,
                ) );
            }
            
            return $efl_fs;
        }
        
        // Init Freemius.
        efl_fs();
        // Signal that SDK was initiated.
        do_action( 'efl_fs_loaded' );
    }
    
    //======================================================================
    // Code for the Main structre
    //======================================================================
    $options = get_option( 'fta_settings' );
    //echo "<pre>"; print_r(plugin_dir_path( __FILE__ ) . 'easy-facebook-likebox/easy-facebook-likebox.php');exit();
    $fb_status = $options['plugins']['facebook']['status'];
    
    if ( $fb_status == 'activated' ) {
        require_once plugin_dir_path( __FILE__ ) . 'easy-facebook-likebox/public/includes/core-functions.php';
        require_once plugin_dir_path( __FILE__ ) . 'easy-facebook-likebox/public/easy-facebook-likebox.php';
        //exit('sa');
        require_once plugin_dir_path( __FILE__ ) . 'easy-facebook-likebox/includes/easy-custom-facebook-feed-widget.php';
        require_once plugin_dir_path( __FILE__ ) . 'easy-facebook-likebox/includes/easy-facebook-page-plugin-widget.php';
        // register Foo_Widget widget
        function register_fblx_widget()
        {
            //echo "<pre>"; print_r('sa');exit();
            register_widget( 'Easy_Custom_Facebook_Feed_Widget' );
            register_widget( 'Easy_Facebook_Page_Plugin_Widget' );
        }
        
        add_action( 'widgets_init', 'register_fblx_widget' );
    }
    
    
    if ( !class_exists( 'Feed_Them_All' ) ) {
        class Feed_Them_All
        {
            /*
             * $version defines the version of the plugin.
             */
            public  $version = '5.2.4' ;
            public  $fta_slug = 'easy-facebook-likebox' ;
            public  $plug_slug = 'easy-facebook-likebox' ;
            /*
             * __construct defines all the plugin initial settings.
             * Returns nothing. 
             * Used action_hooks to get things sequentially.
             */
            function __construct()
            {
                /*
                 * init hooks fires on wp load
                 */
                add_action( 'init', array( $this, 'constants' ) );
                add_action( 'init', array( $this, 'includes' ) );
                /*
                 * register_activation_hook fires plugin install.
                 */
                register_activation_hook( __FILE__, array( $this, 'fta_activated' ) );
                /*
                 * Will add the My Instagram Feed settings page link in the plugin area.
                 */
                // add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'fta_settings_link' ) );
            }
            
            /* __construct() Method ends here. */
            /*
             * constants defines all the plugin constants.
             * Returns nothing. 
             * defined() func used to define constant.
             */
            public function constants()
            {
                // Plugin version
                if ( !defined( 'FTA_VERSION' ) ) {
                    define( 'FTA_VERSION', $this->version );
                }
                // Plugin Folder Path
                if ( !defined( 'FTA_PLUGIN_DIR' ) ) {
                    define( 'FTA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
                }
                // Plugin Folder URL
                if ( !defined( 'FTA_PLUGIN_URL' ) ) {
                    define( 'FTA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
                }
                // Plugin Root File
                if ( !defined( 'FTA_PLUGIN_FILE' ) ) {
                    define( 'FTA_PLUGIN_FILE', __FILE__ );
                }
            }
            
            /* constants() Method ends here. */
            /*
             * fta_activated will Add all the necessary data into the database on plugin install.
             * Returns nothing.
             */
            public function fta_activated()
            {
                /*
                 * Getting Installed Date.
                 */
                $install_date = $this->fta_get_settings( 'installDate' );
                /*
                 * Making an array to save the values.
                 */
                $fta_settings = array(
                    'version'     => $this->version,
                    'installDate' => date( 'Y-m-d h:i:s' ),
                    'plugins'     => $this::fta_plugins(),
                );
                // echo "<pre>"; print_r($install_date);exit();
                /*
                 * Saving the all settings.
                 */
                if ( empty($install_date) ) {
                    update_option( 'fta_settings', $fta_settings );
                }
            }
            
            /* fta_activated() Method ends here. */
            /*
             * includes will include all the necessary files.
             * Returns nothing. 
             * include() func used to include any file.
             */
            public function includes()
            {
                /*
                 * Includes module-search.php file which have all the modules search code.
                 */
                include FTA_PLUGIN_DIR . '/includes/class-module-search.php';
                /*
                 * Includes admin.php file which have all the admin area code.
                 */
                include FTA_PLUGIN_DIR . 'admin/admin.php';
                $fta_plugins = $this->fta_plugins();
                $instagram_status = $fta_plugins['instagram']['status'];
                if ( $instagram_status == 'activated' ) {
                    include FTA_PLUGIN_DIR . 'my-instagram-feed/my-instagram-feed.php';
                }
                $fb_status = $fta_plugins['facebook']['status'];
                if ( $fb_status == 'activated' ) {
                    include FTA_PLUGIN_DIR . 'easy-facebook-likebox/easy-facebook-likebox.php';
                }
            }
            
            /* includes() Method ends here. */
            /*
             * It will get the saved settings.
             */
            public function fta_get_settings( $key = null )
            {
                /*
                 * Getting the options from database.
                 */
                $fta_settings = get_option( 'fta_settings', false );
                if ( $key ) {
                    $fta_settings = $fta_settings[$key];
                }
                /*
                 * Returning back the specific key values.
                 */
                return $fta_settings;
            }
            
            /* fta_get_settings method ends here. */
            /*
             * fta_settings_link Will add the My Instagram settings page link in the plugin area.
             */
            public function fta_settings_link( $links )
            {
                $fta_link = array( '<a href="' . admin_url( 'admin.php?page=feed-them-all' ) . '">' . __( 'Settings', 'easy-facebook-likebox' ) . '</a>' );
                return array_merge( $fta_link, $links );
            }
            
            /*
             * fta_plugins Holds all the FTA plugins data
             */
            public function fta_plugins()
            {
                $Feed_Them_All = new Feed_Them_All();
                $fb_status = $Feed_Them_All->fta_get_settings();
                $fb_status = $fb_status['plugins']['facebook']['status'];
                $insta_status = $Feed_Them_All->fta_get_settings();
                $insta_status = $insta_status['plugins']['instagram']['status'];
                if ( empty($fb_status) ) {
                    $fb_status = 'activated';
                }
                if ( empty($insta_status) ) {
                    $insta_status = 'activated';
                }
                /*
                 * Making an array of all plugins
                 */
                $fta_plugins = array(
                    'facebook'  => array(
                    'name'          => __( 'Custom Facebook Feed- Facebook Page Plugin (Likebox & Popup)', $this->plug_slug ),
                    'slug'          => 'easy-facebook-likebox',
                    'activate_slug' => 'facebook',
                    'description'   => __( '<p>This module allows you to display:</p>
                                                                    <ul>
                                                                    <li>Customizable and mobile-friendly Facebook post, images, videos, events, and albums feed</li>
                                                                    <li>Facebook Page Plugin (previously like box)</li>
                                                                    <li>Auto-popup (display page plugin or anything in the auto popup)</li>
                                                                    <li>using shortcode, widget, inside popup and widget.</li>
                                                                     </ul>
                                                                    ', $this->plug_slug ),
                    'img_name'      => 'fb_cover.png',
                    'status'        => $fb_status,
                ),
                    'instagram' => array(
                    'name'          => __( 'Custom Instagram Feed', $this->plug_slug ),
                    'slug'          => 'mif',
                    'activate_slug' => 'instagram',
                    'description'   => __( '<p>This module allows you to display:</p>
                                                                    <ul>
                                                                    <li>Display stunning photos from the Instagram account in feed</li>
                                                                    <li>Gallery of photos in the PopUp</li>
                                                                    <li>using shortcode, widget, inside popup and widget.</li>
                                                                     </ul>', $this->plug_slug ),
                    'img_name'      => 'insta_cover.png',
                    'status'        => $insta_status,
                ),
                );
                /*
                 * Returning back the plugins array
                 */
                return $fta_plugins;
            }
            
            /* fta_plugins method ends here. */
            /* retrieves the attachment ID from the file URL */
            public function fta_get_image_id( $image_url )
            {
                /* Getting the global wpdb */
                global  $wpdb ;
                /* Getting attachment ID from custom query */
                $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $image_url ) );
                /* Returning back the attachment ID */
                return $attachment[0];
            }
        
        }
        /* Feed_Them_All class ends here. */
        $Feed_Them_All = new Feed_Them_All();
    }

}
