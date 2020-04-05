<?php 
    if ( ! class_exists( "rt_notices" ) ) {
        class rt_notices {

            // Pro recommendation
            public static function pro_recommendation() {
                $output = '<div class="rt-note-white" style="margin: 18px 0;"><i><p>' . sprintf( wp_kses( __( 'Did you know that when you optimize your Robots.txt, you maximize your site’s crawlability (& your ranking on search engines) but you help reducing your site’s ecological footprint and, at your level, the greenhouse gas (CO2) production generated by major search engines? Read this <a href="%s" target="_blank">article</a> for more info.', 'better-robots-txt' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( "https://better-robots.com/how-to-save-the-planet-with-your-website/" ) ) . '</p>';
                
                $output .= '<p>' . __( 'Don\'t do things by halves! If you want to get PRO, go PRO.', 'better-robots-txt' ) . '</p>';

                $output .= '<p>' . __( 'Better Robots.txt TEAM.', 'better-robots-txt' ) . '</p></i></div>';

                return $output;
            }

            // Check your robots.txt notice
            public static function check_robotstxt() {
                return '<div class="rt-note btn" style="margin: 18px 0;"><p>' . sprintf( wp_kses( __( 'Please check your robots.txt before and after optimization (if you don\'t see changes, please read FAQ) &nbsp; <a href="%1s" target="_blank" class="note-btn">Your Robots.txt</a> &nbsp; Want to see a robots.txt fully optimized with Better Robots.txt PRO? Click <a href="%2s" target="_blank">HERE</a>', 'better-robots-txt' ), array(  'a' => array( 'href' => array(), 'target' => array(), 'class' => array() ) ) ), esc_url( $host_url."/robots.txt" ), esc_url( "https://mobilook.co/robots.txt" ) ) . '</p></div>';
            }

            // Metabox notice
            public static function metabox_robotstxt() {
                return '<div class="rt-note btn" style="margin: 18px 0;"><p>' . sprintf( wp_kses( __( 'Don’t forget to use our « Robots.txt post META BOX » for manual exclusions (if required). &nbsp; <a href="%s" target="_blank">See this feature</a>', 'better-robots-txt' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( plugin_dir_url( __FILE__ ) . '../assets/imgs/screenshot-5.jpg' ) ) . '</p></div>';
            }

            // Set Permalinks, Clear Cache after Saving Changes notice
            public static function clear_notice() {
                return '<div class="rt-note"><p>' . __( "Note: Better Robots.txt creates a virtual robots.txt file. Please make sure that your permalinks are enabled and there is no physical robots.txt file on your server. If you're using any kind of cache then make sure to clear it after Saving Changes. Please read FAQ for more details.", 'better-robots-txt' ) . '</p>
                </div>';
            }

            // physical robots.txt file notification
            public static function robots_file_exists() {  
                $faq_link = "options-general.php?page=better-robots-txt&tab=robot-faq";
                $robots_file_exists = sprintf( wp_kses( __( 'Note: A physical Robots.txt file was detected on your server. Better Robots.txt will attempt to remove it upon saving changes. Please read our <a href="%s">FAQ</a> for more info', 'better-robots-txt' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $faq_link ) );
                echo '<div class="notice notice-warning is-dismissible"><p>' . $robots_file_exists . '</p></div>';
            }

            // physical robots.txt file not deleted notification
            public static function robots_file_not_deleted() {
                return '<div class="notice notice-warning is-dismissible"><p><strong>'.__( 'Note: Better robots.txt was not able to remove your current physical robots.txt file. Please check file permissions on server or delete it manually', 'better-robots-txt' ).'</strong></p></div> ';
            }


        }
    }

    if ( class_exists( "rt_notices" ) ) {
        $rt_notices = new rt_notices;
    }
?>