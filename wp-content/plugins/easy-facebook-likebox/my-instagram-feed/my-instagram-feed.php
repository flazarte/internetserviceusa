<?php
    
    //======================================================================
    // MIF Main Class
    //======================================================================
  
            
             // Plugin Folder Path
            if ( !defined( 'MIF_PLUGIN_DIR' ) ) {
                define( 'MIF_PLUGIN_DIR', FTA_PLUGIN_DIR . '/my-instagram-feed/' );
            }
            // Plugin Folder URL
            if ( !defined( 'MIF_PLUGIN_URL' ) ) {
                define( 'MIF_PLUGIN_URL', FTA_PLUGIN_URL . '/my-instagram-feed/' );
            }
            // Plugin Root File
            if ( !defined( 'MIF_PLUGIN_FILE' ) ) {
                define( 'MIF_PLUGIN_FILE', FTA_PLUGIN_FILE . '/my-instagram-feed/' );
            }

            /*
            * Includes mif-skins.php file which have all Instagram feeds skins.
            */
            include MIF_PLUGIN_DIR . 'includes/mif-skins.php';
            /*
            * Includes customizer.php file which have all Instagram Customizer settings.
            */
            include MIF_PLUGIN_DIR . 'includes/customizer_extend.php';

            /*
            * Includes customizer.php file which have all Instagram Customizer settings.
            */
            include MIF_PLUGIN_DIR . 'includes/customizer.php';

            /*
             * Includes admin.php file which have all the admin area code.
             */
            include MIF_PLUGIN_DIR . 'admin/admin.php';
    
            /*
             * Includes frontend.php file which have all forntend code.
             */
            include MIF_PLUGIN_DIR . 'frontend/frontend.php';