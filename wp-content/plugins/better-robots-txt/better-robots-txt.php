<?php

/*
* Plugin Name: Better Robots.txt  - Index, rank & SEO booster + Woocommerce
* Description: Better-Robots.txt plugin helps you boosting your website indexation and your ranking by adding specific instructions in your robots.txt
* Author: Pagup
* Version: 1.3.0.1
* Author URI: https://pagup.com/
* Text Domain: better-robots-txt
* Domain Path: /languages/
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !function_exists( 'rtf_fs' ) ) {
    // Create a helper function for easy SDK access.
    function rtf_fs()
    {
        global  $rtf_fs ;
        
        if ( !isset( $rtf_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
            $rtf_fs = fs_dynamic_init( array(
                'id'              => '2345',
                'slug'            => 'better-robots-txt',
                'type'            => 'plugin',
                'public_key'      => 'pk_fc28da2ba58a7288429539266f4db',
                'is_premium'      => false,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'has_affiliation' => 'selected',
                'trial'           => array(
                'days'               => 14,
                'is_require_payment' => true,
            ),
                'menu'            => array(
                'slug'           => 'better-robots-txt',
                'override_exact' => true,
                'first-path'     => 'options-general.php?page=better-robots-txt',
                'support'        => false,
                'parent'         => array(
                'slug' => 'options-general.php',
            ),
            ),
                'is_live'         => true,
            ) );
        }
        
        return $rtf_fs;
    }
    
    // Init Freemius.
    rtf_fs();
    // Signal that SDK was initiated.
    do_action( 'rtf_fs_loaded' );
    function rtf_fs_settings_url()
    {
        return admin_url( 'options-general.php?page=better-robots-txt&tab=robot-settings' );
    }
    
    rtf_fs()->add_filter( 'connect_url', 'rtf_fs_settings_url' );
    rtf_fs()->add_filter( 'after_skip_url', 'rtf_fs_settings_url' );
    rtf_fs()->add_filter( 'after_connect_url', 'rtf_fs_settings_url' );
    rtf_fs()->add_filter( 'after_pending_connect_url', 'rtf_fs_settings_url' );
    // freemius opt-in
    function rtf_fs_custom_connect_message(
        $message,
        $user_first_name,
        $product_title,
        $user_login,
        $site_link,
        $freemius_link
    )
    {
        $break = "<br><br>";
        return sprintf( __( 'Hey %1$s, %2$s Click on Allow & Continue to start optimizing your website with your robots.txt :)!  Create a powerful robots.txt with clear instructions for crawlers to get better results on search engines and improve your SEO. %2$s Never miss an important update -- opt-in to our security and feature updates notifications. %2$s See you on the other side.', 'better-robots-txt' ), $user_first_name, $break );
    }
    
    rtf_fs()->add_filter(
        'connect_message',
        'rtf_fs_custom_connect_message',
        10,
        6
    );
    $agents = array(
        array(
        "name"   => "Google Bot",
        "agent"  => "Googlebot",
        "bot"    => "googlebot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    ),
        array(
        "name"   => "Google Images",
        "agent"  => "Googlebot-Image",
        "bot"    => "google_images",
        "path"   => "/wp-content/uploads/",
        "dir"    => "media directory",
        "define" => "",
    ),
        array(
        "name"   => "Google Media Partners",
        "agent"  => "Mediapartners-Google",
        "bot"    => "mediapartners_google",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    ),
        array(
        "name"   => "Google AdsBot",
        "agent"  => "AdsBot-Google",
        "bot"    => "google_adsbot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    ),
        array(
        "name"   => "Google Mobile",
        "agent"  => "AdsBot-Google-Mobile",
        "bot"    => "google_mobile",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    ),
        array(
        "name"   => "Bing Bot",
        "agent"  => "Bingbot",
        "bot"    => "bingbot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "(Microsoft Search Engine)",
    ),
        array(
        "name"   => "MSN Bot",
        "agent"  => "Msnbot",
        "bot"    => "msnbot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "(Microsoft Search Engine)",
    ),
        array(
        "name"   => "MSNBot Media",
        "agent"  => "msnbot-media",
        "bot"    => "msnbot-media",
        "path"   => "/wp-content/uploads/",
        "dir"    => "media directory",
        "define" => "",
    ),
        array(
        "name"   => "Apple bot",
        "agent"  => "Applebot",
        "bot"    => "applebot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "(Used for Siri and Spotlight Suggestions)",
    ),
        array(
        "name"   => "Yandex Bot",
        "agent"  => "Yandex",
        "bot"    => "yandexbot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "(Search Engine in Russia)",
    ),
        array(
        "name"   => "Yandex Images",
        "agent"  => "YandexImages",
        "bot"    => "yandeximages",
        "path"   => "/wp-content/uploads/",
        "dir"    => "media directory",
        "define" => "",
    ),
        array(
        "name"   => "Yahoo Search (Slurp bot)",
        "agent"  => "Slurp",
        "bot"    => "slurp",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    ),
        array(
        "name"   => "DuckDuckGo Bot",
        "agent"  => "DuckDuckBot",
        "bot"    => "duckduckbot",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    ),
        array(
        "name"   => "Qwant",
        "agent"  => "Qwantify",
        "bot"    => "qwantify",
        "path"   => "/",
        "dir"    => "root",
        "define" => "",
    )
    );
    // Better Robots Txt
    class robots_txt
    {
        function __construct()
        {
            // making sure we have the right paths...
            
            if ( !defined( 'WP_PLUGIN_URL' ) ) {
                if ( !defined( 'WP_CONTENT_DIR' ) ) {
                    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
                }
                if ( !defined( 'WP_CONTENT_URL' ) ) {
                    define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
                }
                if ( !defined( 'WP_PLUGIN_DIR' ) ) {
                    define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
                }
                define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
            }
            
            // end if
            // stuff to do on plugin activation/deactivation
            //register_activation_hook(__FILE__, array(&$this, 'rt_activate'));
            register_deactivation_hook( __FILE__, array( &$this, 'rt_deactivate' ) );
            // add default stuff to robots.txt if we're public
            
            if ( get_option( 'blog_public' ) ) {
                remove_action( 'do_robots', 'do_robots' );
                add_action( 'do_robots', array( &$this, 'rt_robots' ) );
            }
            
            // end if
            //add quick links to plugin settings
            $plugin = plugin_basename( __FILE__ );
            if ( is_admin() ) {
                add_filter( "plugin_action_links_{$plugin}", array( &$this, 'setting_link' ) );
            }
        }
        
        // end function
        // quick setting link in plugin section
        function setting_link( $links )
        {
            $settings_link = '<a href="options-general.php?page=better-robots-txt">Settings</a>';
            array_unshift( $links, $settings_link );
            return $links;
        }
        
        // end function
        // removed settings (if checked) on plugin deactivation
        function rt_deactivate()
        {
            $options = $this->get_options();
            if ( $options['remove_settings'] ) {
                delete_option( 'robots_txt' );
            }
        }
        
        // end function
        function rt_robots()
        {
            
            if ( is_robots() ) {
                $options = $this->get_options();
                $output = "";
                // end pro only
                // custom rules for robots.txt
                if ( '' != $options['user_agents'] ) {
                    $output .= stripcslashes( $options['user_agents'] ) . "\n\n";
                }
                // hide robots.txt
                if ( isset( $options['hide_robots'] ) && !empty($options['hide_robots']) && $options['hide_robots'] == "allow" ) {
                    $output .= "Disallow: /robots.txt\n\n";
                }
                global  $agents ;
                // loop to display user-agents on front-end
                $last = count( $agents ) - 1;
                foreach ( $agents as $i => $row ) {
                    $isFirst = $i == 0;
                    $isLast = $i == $last;
                    if ( isset( $options[$row['bot']] ) && !empty($options[$row['bot']]) ) {
                        
                        if ( $options[$row['bot']] == "allow" ) {
                            $agent_output = 'User-agent: ' . $row['agent'] . '\\nAllow: ' . $row['path'] . '\\n\\n';
                            $output .= stripcslashes( $agent_output );
                        } elseif ( $options[$row['bot']] == "disallow" ) {
                            $agent_output = 'User-agent: ' . $row['agent'] . '\\nDisallow: ' . $row['path'] . '\\n\\n';
                            $output .= stripcslashes( $agent_output );
                        }
                    
                    }
                }
                // end user-agents loop
                // step 1 - chinese search engines
                
                if ( isset( $options['chinese_bot'] ) && !empty($options['chinese_bot']) ) {
                    if ( $options['chinese_bot'] !== "disable" ) {
                        $output .= __( '# Popular chinese search engines', 'better-robots-txt' ) . "\n\n";
                    }
                    
                    if ( $options['chinese_bot'] == "allow" ) {
                        $chinese_bot = "User-agent: Baiduspider\n" . "Allow: /\n" . "User-agent: Baiduspider/2.0\n" . "Allow: /\n" . "User-agent: Baiduspider-video\n" . "Allow: /\n" . "User-agent: Baiduspider-image\n" . "Allow: /\n" . "User-agent: Sogou spider\n" . "Allow: /\n" . "User-agent: Sogou web spider\n" . "Allow: /\n" . "User-agent: Sosospider\n" . "Allow: /\n" . "User-agent: Sosospider+\n" . "Allow: /\n" . "User-agent: Sosospider/2.0\n" . "Allow: /\n" . "User-agent: yodao\n" . "Allow: /\n" . "User-agent: youdao\n" . "Allow: /\n" . "User-agent: YoudaoBot\n" . "Allow: /\n" . "User-agent: YoudaoBot/1.0\n" . "Allow: /\n\n";
                        $output .= $chinese_bot;
                    }
                    
                    
                    if ( $options['chinese_bot'] == "disallow" ) {
                        $chinese_bot = "User-agent: Baiduspider\n" . "Disallow: /\n" . "User-agent: Baiduspider/2.0\n" . "Disallow: /\n" . "User-agent: Baiduspider-video\n" . "Disallow: /\n" . "User-agent: Baiduspider-image\n" . "Disallow: /\n" . "User-agent: Sogou spider\n" . "Disallow: /\n" . "User-agent: Sogou web spider\n" . "Disallow: /\n" . "User-agent: Sosospider\n" . "Disallow: /\n" . "User-agent: Sosospider+\n" . "Disallow: /\n" . "User-agent: Sosospider/2.0\n" . "Disallow: /\n" . "User-agent: yodao\n" . "Disallow: /\n" . "User-agent: youdao\n" . "Disallow: /\n" . "User-agent: YoudaoBot\n" . "Disallow: /\n" . "User-agent: YoudaoBot/1.0\n" . "Disallow: /\n\n";
                        $output .= $chinese_bot;
                    }
                
                }
                
                // step 2 - protect your data / feed protector
                if ( isset( $options['feed_protector'] ) && !empty($options['feed_protector']) ) {
                    
                    if ( $options['feed_protector'] == "allow" ) {
                        $output .= __( '# Spam Backlink Blocker', 'better-robots-txt' ) . "\n\n";
                        $feed_protector = "Disallow: /feed/\n" . "Disallow: /feed/\$\n" . "Disallow: /comments/feed\n" . "Disallow: /trackback/\n" . "Disallow: */?author=*\n" . "Disallow: */author/*\n" . "Disallow: /author*\n" . "Disallow: /author/\n" . "Disallow: */comments\$\n" . "Disallow: */feed\n" . "Disallow: */feed\$\n" . "Disallow: */trackback\n" . "Disallow: */trackback\$\n" . "Disallow: /?feed=\n" . "Disallow: /wp-comments\n" . "Disallow: /wp-feed\n" . "Disallow: /wp-trackback\n" . "Disallow: */replytocom=\n\n";
                        $output .= $feed_protector;
                    }
                
                }
                // end pro only
                // step 10 - ads.txt & app-ads.txt
                if ( isset( $options['ads-txt'] ) && !empty($options['ads-txt']) ) {
                    
                    if ( $options['ads-txt'] == "allow" ) {
                        $output .= __( '# Allow/Disallow Ads.txt', 'better-robots-txt' ) . "\n\n";
                        $ads_txt = "Allow: /ads.txt\n\n";
                        $output .= $ads_txt;
                    } elseif ( $options['ads-txt'] == "disallow" ) {
                        $output .= __( '# Allow/Disallow Ads.txt', 'better-robots-txt' ) . "\n\n";
                        $ads_txt = "Disallow: /ads.txt\n\n";
                        $output .= $ads_txt;
                    }
                
                }
                if ( isset( $options['app-ads-txt'] ) && !empty($options['app-ads-txt']) ) {
                    
                    if ( $options['app-ads-txt'] == "allow" ) {
                        $output .= __( '# Allow/Disallow App-ads.txt', 'better-robots-txt' ) . "\n\n";
                        $ads_txt = "Allow: /app-ads.txt\n\n";
                        $output .= $ads_txt;
                    } elseif ( $options['app-ads-txt'] == "disallow" ) {
                        $output .= __( '# Allow/Disallow App-ads.txt', 'better-robots-txt' ) . "\n\n";
                        $ads_txt = "Disallow: /app-ads.txt\n\n";
                        $output .= $ads_txt;
                    }
                
                }
                // Individual post disallow rules
                global  $wpdb ;
                $metas = $wpdb->get_results( $wpdb->prepare( "SELECT meta_value FROM {$wpdb->postmeta} where meta_key = %s", 'rt_disallow' ) );
                
                if ( !empty($metas) ) {
                    $output .= __( '# Manual rules with Better Robots.txt Post Meta Box' ) . "\n\n";
                    $output .= "User-agent: *\n";
                    foreach ( $metas as $meta ) {
                        if ( !empty($meta->meta_value) ) {
                            $output .= "Disallow: " . $meta->meta_value . "\n";
                        }
                    }
                    $output .= "\n";
                }
                
                // crawl-delay for robots.txt
                if ( isset( $options['crawl_delay'] ) && !empty($options['crawl_delay']) ) {
                    $output .= "Crawl-delay: " . stripcslashes( $options['crawl_delay'] ) . "\n\n";
                }
                // personalize text for robots.txt
                
                if ( isset( $options['personalize'] ) && !empty($options['personalize']) ) {
                    $personalize_text = stripcslashes( $options['personalize'] );
                    $personalize_text = str_replace( "\n", '#', $personalize_text );
                    $output .= "#" . $personalize_text . "\n\n";
                }
                
                // display credit
                $output .= __( '# This robots.txt file was created by', 'better-robots-txt' ) . ' Better Robots.txt (Index & Rank Booster by Pagup) Plugin. https://www.better-robots.com/';
                header( 'Status: 200 OK', true, 200 );
                header( 'Content-type: text/plain; charset=' . get_bloginfo( 'charset' ) );
                echo  $output ;
                exit;
            }
            
            // end if
        }
        
        // end function
        function get_options()
        {
            $options = get_option( 'robots_txt' );
            if ( !is_array( $options ) ) {
                $options = $this->default_options();
            }
            return $options;
        }
        
        // end function
        function default_options()
        {
            $options = array(
                'user_agents'     => "User-agent: *\n" . "Allow: /wp-admin/admin-ajax.php\n" . "Allow: /*/*.css\n" . "Allow: /*/*.js\n" . "Disallow: /wp-admin/\n" . "Disallow: /wp-includes/\n" . "Disallow: /readme.html\n" . "Disallow: /license.txt\n" . "Disallow: /xmlrpc.php\n" . "Disallow: /wp-login.php\n" . "Disallow: /wp-register.php\n" . "Disallow: */disclaimer/*\n" . "Disallow: *?attachment_id=\n" . "Disallow: /privacy-policy\n",
                'remove_settings' => false,
            );
            update_option( 'robots_txt', $options );
            return $options;
        }
    
    }
    // end class
    // admin notifications
    include_once dirname( __FILE__ ) . '/inc/notices.php';
    // better robots languages text domain
    add_action( 'plugins_loaded', 'better_robots_textdomain' );
    //add_action( 'init', 'better_robots_textdomain' );
    function better_robots_textdomain()
    {
        load_plugin_textdomain( 'better-robots-txt', false, basename( dirname( __FILE__ ) ) . '/languages/' );
    }
    
    $robots_txt = new robots_txt();
    
    if ( is_admin() ) {
        include_once dirname( __FILE__ ) . '/admin-ui-inc/notices.php';
        include_once dirname( __FILE__ ) . '/better-robots-txt-admin.php';
        include_once dirname( __FILE__ ) . '/inc/post-meta-box.php';
    }

}
