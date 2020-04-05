<?php defined('ABSPATH') or die('No script kiddies please!');
/**
 * Plugin Name: FAuto Poster
 * Plugin URI: https://accesspressthemes.com/wordpress-plugins/accesspress-facebook-auto-post/
 * Description: A plugin to publish your wordpress posts to your facebook profile and fan pages.
 * Version: 2.0.7
 * Author: AccessPress Themes
 * Author URI: http://accesspressthemes.com
 * Text Domain: accesspress-facebook-auto-post
 * Domain Path: /languages/
 * License: GPL2
 */
if (!class_exists('AFAP_Class')) {

    /**
     * Declaration of plugin main class
     * */
    class AFAP_Class {

        var $afap_settings;
        var $afap_extra_settings;

        /**
         * Constructor
         */
        function __construct() {
            $this->afap_settings = get_option('afap_settings');
            $this->afap_extra_settings = get_option('afap_extra_settings');
            $this->define_constants();
            register_activation_hook(__FILE__, array($this, 'activation_tasks')); //fired when plugin is activated
            add_action('admin_init', array($this, 'plugin_init')); //starts the session and loads plugin text domain on admin_init hook
            add_action('admin_menu', array($this, 'afap_admin_menu')); //For plugin admin menu
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers js and css for plugin
            add_action('admin_post_afap_fb_authorize_action', array($this, 'fb_authorize_action')); //action to authorize facebook
            add_action('admin_post_afap_callback_authorize', array($this, 'afap_callback_authorize')); //action to authorize facebook
            add_action('admin_post_afap_form_action', array($this, 'afap_form_action')); //action to save settings
            add_action('admin_init', array($this, 'auto_post_trigger')); // auto post trigger
            add_action('admin_post_afap_clear_log', array($this, 'afap_clear_log')); //clears log from log table
            add_action('admin_post_afap_delete_log', array($this, 'delete_log')); //clears log from log table
            add_action('admin_post_afap_restore_settings', array($this, 'restore_settings')); //clears log from log table
            add_action('add_meta_boxes', array($this, 'add_afap_meta_box')); //adds plugin's meta box
            add_action('save_post', array($this, 'save_afap_meta_value')); //saves meta value
            add_action('future_to_publish', array($this, 'auto_post_schedule'));
            add_action(  'transition_post_status',  array($this,'auto_post'), 10, 3 );

             // Facebook Mobile API: Ajax Action for generating Access Token from given Email and Password
            add_action('wp_ajax_asfap_access_token_ajax_action', array($this, 'asfap_access_token_ajax_action'));
            add_action('wp_ajax_nopriv_asfap_access_token_ajax_action', array($this, 'asfap_access_token_ajax_action'));
            // Ajax Action for getting the list of all the pages and groups associated with the email address
            add_action('wp_ajax_asfap_add_account_action', array($this, 'asfap_add_account_action'));
            add_action('wp_ajax_nopriv_asfap_add_account_action', array($this, 'asfap_add_account_action'));

            add_action( 'admin_init', array( $this, 'redirect_to_site' ), 1 );
            add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
            add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
        }

         function plugin_row_meta( $links, $file ){
            if ( strpos( $file, 'accesspress-facebook-auto-post.php' ) !== false ) {
                $new_links = array(
                    'doc' => '<a href="https://accesspressthemes.com/documentation/accesspress-facebook-auto-post/" target="_blank"><span class="dashicons dashicons-media-document"></span>Documentation</a>',
                    'support' => '<a href="http://accesspressthemes.com/support" target="_blank"><span class="dashicons dashicons-admin-users"></span>Support</a>',
                    'pro' => '<a href="https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Faccesspress-social-auto-post%2F11752265" target="_blank"><span class="dashicons dashicons-cart"></span>Premium version</a>'
                );
                $links = array_merge( $links, $new_links );
            }
            return $links;
        }


        function admin_footer_text( $text ){
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'afap') {
                $link = 'https://wordpress.org/support/plugin/accesspress-facebook-auto-post/reviews/#new-post';
                $pro_link = 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Faccesspress-social-auto-post%2F11752265';
                $text = 'Enjoyed FAuto Poster? <a href="' . $link . '" target="_blank">Please leave us a ★★★★★ rating</a> We really appreciate your support! | Try premium version of <a href="' . $pro_link . '" target="_blank">AccessPress Social Auto Post</a> - more features, more power!';
                return $text;
            } else {
                return $text;
            }
        }

      function redirect_to_site(){
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'faposter-doclinks' ) {
                wp_redirect( 'https://accesspressthemes.com/documentation/accesspress-facebook-auto-post/' );
                exit();
            }
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'faposter-premium' ) {
                wp_redirect( 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Faccesspress-social-auto-post%2F11752265' );
                exit();
            }
        }

        /*
        * Start Generating Access Token
        */
        public function asfap_access_token_ajax_action(){
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'apfap_backend_ajax_nonce')) {
                // $fbfor =sanitize_text_field($_POST['fbfor']);
                $fb_email =sanitize_text_field($_POST['fb_email']);
                $fb_password = sanitize_text_field($_POST['fb_password']);

                if( !empty( $fb_email ) && !empty($fb_password ) ) {
                    $token_url = $this->get_token_url($fb_email , $fb_password);
                    if( $token_url != false ) {
                        $response = array(
                            'type' => 'success',
                            'message' => $token_url
                        );
                    }
                } else{
                    $response = array(
                        'type' => 'error',
                        'message' => __( 'Please provide your facebook Username and Password.', 'accesspress-facebook-auto-post' )
                    );
                }
                wp_send_json($response);
                exit;
            }
        }

        /*
        * Generating Access Token For Android and iPhone using Email Id and Password
        */
         function get_token_url($fb_email, $fb_password){
             $credentials = array();
             $apps = array(
                '951357852456' => array(
                            "api_key" => "882a8490361da98702bf97a021ddc14d", //API key for FB android app
                            "api_secret" => "62f8ce9f74b12f84c123cc23437a4a32" //APP Secret for FB android app
                        )
             );

            $default_app = '951357852456'; // Name of the page we created. However, also works with any random numbers because this value is not used anywhere.
            $credentials = $apps[$default_app];

            $sig = md5("api_key=".$credentials['api_key']."credentials_type=passwordemail=".trim($fb_email)."format=JSONgenerate_machine_id=1generate_session_cookies=1locale=en_USmethod=auth.loginpassword=".trim($fb_password)."return_ssl_resources=0v=1.0".$credentials['api_secret']);

            $fb_token_url = "https://api.facebook.com/restserver.php?api_key=".$credentials['api_key']."&credentials_type=password&email=".urlencode(trim($fb_email))."&format=JSON&generate_machine_id=1&generate_session_cookies=1&locale=en_US&method=auth.login&password=".urlencode(trim($fb_password))."&return_ssl_resources=0&v=1.0&sig=".$sig;

            return $fb_token_url;
        }

        public function asfap_add_account_action(){
             if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'apfap_backend_ajax_nonce')) {
                 $token_url = sanitize_text_field($_POST['token_url']);
                 $token_response = array();
                if(!empty($token_url)){
                    $fb_token = stripslashes($token_url);
                    $token_response = $this->asap_add_account($fb_token);
                    if( !empty($token_response) ) {
                         $response =
                        array(
                            'type'=> 'success',
                            'result' => $token_response,
                            'message' => __('Your account added successfully.', 'accesspress-facebook-auto-post')
                        );
                    }
                    else{
                        $response = array(
                            'type' => 'error',
                            'message' =>  __('Invalid access token/User data not found.', 'accesspress-facebook-auto-post')
                        );
                    }
                } else{
                    $response = array(
                        'type' => 'error',
                        'message' => __( 'Please enter the access token.', 'accesspress-facebook-auto-post' )
                    );
                }
                 wp_send_json($response);
            }
        }

        public function asap_add_account($fb_token) {
            $fb_sess_data = array();
            $asap_user_details = array();
            $user_accounts = array();
            $token_result = json_decode($fb_token);
            if( isset( $token_result->error_msg ) ){
                $error = $token_result->error_msg;
                return false;
            }
            elseif ( empty( $token_result ) ) {
                return false;
            }
            $user_app_secret = $token_result->secret;
            $user_accounts = $this->asap_get_user_accounts($token_result);

            if(!empty($user_accounts)) {
                $fb_sess_data =
                 array(
                    'fap_user_cache' => array(
                                        'name' => $user_accounts['fb_user_name'],
                                        'id' => $user_accounts['fb_user_id'],
                    ),
                    'fap_user_id' => $user_accounts['fb_user_id'],
                    'fap_user_accounts' => $user_accounts,
                );
                $asap_user_details = $fb_sess_data;
                return $asap_user_details;
            }
            return false;
        }

        function asap_get_user_accounts($token_result) {
            require_once( AFAP_PLUGIN_PATH . '/Facebook/Facebook_API.php' );
            $asap_facebook_api = new AFAP_REST_API();
            $user_accounts  = array();

            if( empty( $token_result ) || empty( $token_result->access_token)){
                return false;
            }

            $access_token = $token_result->access_token;
            $userData   = $this->asap_get_user_data($access_token, $asap_facebook_api);
            $userPages  = $this->asap_get_page_data($access_token, $asap_facebook_api);
            $userGroups = $this->asap_get_group_data($access_token, $asap_facebook_api);

            if( !empty( $userData ) && $userData ) {
                $facebook_user = $userData;
                $user_accounts['fb_user_name']= $userData->name ;
                $user_accounts['fb_user_id']= $userData->id ;

                $user_accounts['auth_accounts'][$userData->id] = $userData->name.' ('.$userData->id.')';
                $user_accounts['auth_tokens'][$userData->id] = $access_token;
            }

            if( !empty( $userPages ) && $userPages ) {
                foreach ( $userPages as $key => $page ) {
                    $user_accounts['auth_accounts'][$page->id] = $page->name;
                    $user_accounts['auth_tokens'][$page->id] = ( isset( $page->access_token)) ? $page->access_token : $access_token;
                }
            }

            if( !empty( $userGroups ) && $userGroups ) {
                foreach ( $userGroups as $key => $group ) {
                    $user_accounts['auth_accounts'][$group->id] = $group->name . ' ('.$group->privacy.')';
                    $user_accounts['auth_tokens'][$group->id] = $access_token;
                }
            }
            return $user_accounts;
        }

         function asap_get_group_data($access_token, $asap_facebook_api, $limit = 1000 ){
            $asap_facebook_api->setApiVersion('v2.9');
            $asap_facebook_api->setNode('me');
            $asap_facebook_api->setEndPoint('groups');
            $asap_facebook_api->setAccessToken($access_token);

            $params = array(
                'fields'=> 'id,name,privacy,members.summary(total_count).limit(0)',
                'limit' => $limit,
            );

            $rawResponse = $asap_facebook_api->request($params);

            if( $rawResponse ) {
                $res = json_decode( $rawResponse->getBody());
            } else{
                return false;
            }

            if(isset($res->error)){
                $error = $res->error->message;
                return false;
            }

            $groups = (array)$res->data;

            return $groups;
        }

        function asap_get_page_data( $access_token, $asap_facebook_api, $limit = 500 ){
            $p = $limit > 99 ? $limit / 100 : 1;
            $limit = $limit > 100 ? 100 : $limit;
            $pages = array();

            $params = array(
                'fields'=> 'id,name,likes,access_token',
                'limit' => $limit,
            );

            for ($i=0; $i<$p ; $i++) {

                $asap_facebook_api->setApiVersion('v2.3');
                $asap_facebook_api->setNode('me');
                $asap_facebook_api->setEndPoint('accounts');
                $asap_facebook_api->setAccessToken($access_token);

                if($rawResponse = $asap_facebook_api->request($params)){
                    $res = json_decode($rawResponse->getBody());
                    if(isset($res->data)){
                        if(!empty($res->data)){
                            $pages = array_merge($pages,$res->data);
                            if(isset($res->paging->cursors->after)){
                                $params['after'] = $res->paging->cursors->after;
                                continue;
                            }
                        }
                    }
                    break;
                }
            }
            return $pages;
        }

      function asap_get_user_data($access_token, $asap_facebook_api){
            $asap_facebook_api->setNode("me");
            $asap_facebook_api->setMethod("get");
            $asap_facebook_api->setAccessToken($access_token);

            $params =  array('fields'=>'id,name,first_name,last_name');
            if($rawResponse = $asap_facebook_api->request($params)){
            $rawResponse = $asap_facebook_api->request($params);
            if ($rawResponse->getBody() && $rawResponse->getBody()->getContentLength() > 0) {
               $res = json_decode($rawResponse->getBody());
                if(isset($res->error)){
                    $error = $res->error->message;
                    return false;
                }
            }else{
                return false;
            }
           }

            return $res;
        }

        /**
         * Necessary constants define
         */
        function define_constants(){
           if (!defined('AFAP_CSS_DIR')) {
                define('AFAP_CSS_DIR', plugin_dir_url(__FILE__) . 'css');
            }
            if( !defined( 'FAUTOPOSTER_IMAGE_DIR' ) ) {
                define( 'FAUTOPOSTER_IMAGE_DIR', plugin_dir_url( __FILE__ ) . 'images' );
            }
            if (!defined('AFAP_IMG_DIR')) {
                define('AFAP_IMG_DIR', plugin_dir_url(__FILE__) . 'images');
            }
            if (!defined('AFAP_JS_DIR')) {
                define('AFAP_JS_DIR', plugin_dir_url(__FILE__) . 'js');
            }
            if (!defined('AFAP_VERSION')) {
                define('AFAP_VERSION', '2.0.7');
            }
            if (!defined('AFAP_TD')) {
                define('AFAP_TD', 'accesspress-facebook-auto-post');
            }
            if (!defined('AFAP_PLUGIN_FILE')) {
                define('AFAP_PLUGIN_FILE', __FILE__);
            }
            if (!defined('AFAP_PLUGIN_PATH')) {
                define('AFAP_PLUGIN_PATH', plugin_dir_path(__FILE__).'api/facebook-mobile');
            }

            if (!defined('AFAP_API_VERSION')) {
                define('AFAP_API_VERSION', 'v2.0');
            }

            if (!defined('AFAP_api')) {
                define('AFAP_api', 'https://api.facebook.com/' . AFAP_API_VERSION . '/');
            }
            if (!defined('AFAP_api_video')) {
                define('AFAP_api_video', 'https://api-video.facebook.com/' . AFAP_API_VERSION . '/');
            }

            if (!defined('AFAP_api_read')) {
                define('AFAP_api_read', 'https://api-read.facebook.com/' . AFAP_API_VERSION . '/');
            }

            if (!defined('AFAP_graph')) {
                define('AFAP_graph', 'https://graph.facebook.com/' . AFAP_API_VERSION . '/');
            }

            if (!defined('AFAP_graph_video')) {
                define('AFAP_graph_video', 'https://graph-video.facebook.com/' . AFAP_API_VERSION . '/');
            }
            if (!defined('AFAP_www')) {
                define('AFAP_www', 'https://www.facebook.com/' . AFAP_API_VERSION . '/');
            }
        }

        /**
         * Activation Tasks
         */
        function activation_tasks() {
            $afap_settings = $this->get_default_settings();
            $afap_extra_settings = array('authorize_status' => 0);
            if (!get_option('afap_settings')) {
                update_option('afap_settings', $afap_settings);
                update_option('afap_extra_settings', $afap_extra_settings);
            }

            global $wpdb;

            $charset_collate = $wpdb->get_charset_collate();
            $log_table_name = $wpdb->prefix . "afap_logs";


            $log_tbl_query = "CREATE TABLE IF NOT EXISTS $log_table_name (
                                log_id INT NOT NULL AUTO_INCREMENT,
                                PRIMARY KEY(log_id),
                                post_id INT NOT NULL,
                                log_status INT NOT NULL,
                                log_time VARCHAR(255),
                                log_details TEXT
                              ) $charset_collate;";
            //echo $log_tbl_query;
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($log_tbl_query);
            //die();
        }

        /**
         * Starts session on admin_init hook
         */
        function plugin_init() {
            if (!session_id()) {
                session_start();
            }
            load_plugin_textdomain( 'afap', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        /**
         * Returns Default Settings
         */
        function get_default_settings() {
            $default_settings = array('auto_publish' => 0,
                'application_id' => '',
                'application_secret' => '',
                'facebook_user_id' => '',
                'message_format' => '',
                'post_format' => 'simple',
                'include_image'=>0,
                'post_image' => 'featured',
                'custom_image_url' => '',
                'auto_post_pages' => array(),
                'post_types' => array(),
                'category' => array());
            return $default_settings;
        }

        /**
         * Registers Admin Menu
         */
        function afap_admin_menu() {
            add_menu_page(__('FAuto Poster', 'accesspress-facebook-auto-post'), __('FAuto Poster', 'accesspress-facebook-auto-post'), 'manage_options', 'afap', array($this, 'plugin_settings'),'dashicons-facebook-alt');
            add_submenu_page('afap', __( 'Documentation','accesspress-facebook-auto-post' ), __( 'Documentation', 'accesspress-facebook-auto-post'  ), 'manage_options', 'faposter-doclinks', '__return_false', null, 9 );
            add_submenu_page('afap', __( 'Check Premium Version', 'accesspress-facebook-auto-post'  ), __( 'Check Premium Version', 'accesspress-facebook-auto-post'  ), 'manage_options', 'faposter-premium', '__return_false', null, 9 );
        }

        /**
         * Plugin Settings Page
         */
        function plugin_settings() {
            include('inc/main-page.php');
        }

        /**
         * Registers Admin Assets
         */
        function register_admin_assets() {
            if (isset($_GET['page']) && $_GET['page'] == 'afap') {
                wp_enqueue_style('apsp-fontawesome-css', AFAP_CSS_DIR.'/font-awesome.min.css', AFAP_VERSION);
                wp_enqueue_style('afap-admin-css', AFAP_CSS_DIR . '/admin-style.css', array(), AFAP_VERSION);
                wp_enqueue_script('afap-admin-js', AFAP_JS_DIR . '/admin-script.js', array('jquery'), AFAP_VERSION);
               $ajax_js_obj = array('ajax_url' => admin_url('admin-ajax.php'),
                                'ajax_nonce' => wp_create_nonce('apfap_backend_ajax_nonce')
                               );
                wp_localize_script('afap-admin-js', 'asfap_backend_js_obj', $ajax_js_obj);
            }
        }

        /**
         * Returns all registered post types
         */
        function get_registered_post_types() {
            $post_types = get_post_types();
            unset($post_types['revision']);
            unset($post_types['attachment']);
            unset($post_types['nav_menu_item']);
            return $post_types;
        }

        /**
         * Prints array in pre format
         */
        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        /**
         * Action to authorize the facebook
         */
        function fb_authorize_action() {
            if (!empty($_POST) && wp_verify_nonce($_POST['afap_fb_authorize_nonce'], 'afap_fb_authorize_action')) {
                include('inc/cores/fb-authorization.php');
            } else {
                die('No script kiddies please');
            }
        }

        /**
         * Facebook Authorize Callback
         */
        function afap_callback_authorize() {
            if (isset($_COOKIE['afap_session_state']) && isset($_REQUEST['state']) && ($_COOKIE['afap_session_state'] === $_REQUEST['state'])) {
                include('inc/cores/fb-authorization-callback.php');
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Action to save settings
         */
        function afap_form_action() {
            if (!empty($_POST) && wp_verify_nonce($_POST['afap_form_nonce'], 'afap_form_action')) {
                include('inc/cores/save-settings.php');
            } else {
                die('No script kiddies please!!');
            }
        }

        /**
         * Auto Post Trigger
         * */
        function auto_post_trigger() {
            $post_types = $this->get_registered_post_types();
            foreach ($post_types as $post_type) {
                $publish_action = 'publish_' . $post_type;
                $publish_future_action = 'publish_future_'.$post_type;
              //  add_action($publish_action, array($this, 'auto_post'), 10, 2);
              //  add_action($publish_action, array($this, 'auto_post_schedule'), 10, 2);

            }
        }

        /**
         * Auto Post Action
         * */
        function auto_post($new_status, $old_status, $post) {
            if($new_status == 'publish'){
                $auto_post = (isset($_POST['afap_auto_post']) && $_POST['afap_auto_post'] == 'yes')?'yes':'no';
                if ($auto_post == 'yes' || $auto_post == '') {
                    include_once('api/facebook.php'); // facebook api library
                    include_once( AFAP_PLUGIN_PATH . '/Facebook/Facebook_API.php' );
                    include('inc/cores/auto-post.php');
                    $check = update_post_meta($post->ID, 'afap_auto_post', 'no');
                    $_POST['afap_auto_post'] = 'no';
                }
            }
        }

        function auto_post_schedule($post){
            $auto_post = get_post_meta($post->ID,'afap_auto_post',true);
            if ($auto_post == 'yes' || $auto_post == '') {
                include_once('api/facebook.php'); // facebook api library
                include_once( AFAP_PLUGIN_PATH . '/Facebook/Facebook_API.php' );
                include('inc/cores/auto-post.php');
                $check = update_post_meta($post->ID, 'afap_auto_post', 'no');
                $_POST['afap_auto_post'] = 'no';
            }
        }

        /**
         * Clears Log from Log Table
         */
        function afap_clear_log() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'afap-clear-log-nonce')) {
                global $wpdb;
                $log_table_name = $wpdb->prefix . 'afap_logs';
                $wpdb->query("TRUNCATE TABLE $log_table_name");
                $_SESSION['afap_message'] = __('Logs cleared successfully.', 'accesspress-facebook-auto-post');
                wp_redirect(admin_url('admin.php?page=afap&tab=logs'));
                exit();
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         *
         * Delete Log
         */
        function delete_log() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'afap_delete_nonce')) {
                $log_id = $_GET['log_id'];
                global $wpdb;
                $table_name = $wpdb->prefix . 'afap_logs';
                $wpdb->delete($table_name, array('log_id' => $log_id), array('%d'));
                $_SESSION['afap_message'] = __('Log Deleted Successfully', 'accesspress-facebook-auto-post');
                wp_redirect(admin_url('admin.php?page=afap'));
            } else {
                die('No script kiddies please!');
            }
        }

        /**
         * Plugin's meta box
         * */
        function add_afap_meta_box($post_type) {
            add_meta_box(
                    'afap_meta_box'
                    , __('FAuto Poster', 'accesspress-facebook-auto-post')
                    , array($this, 'render_meta_box_content')
                    , $post_type
                    , 'side'
                    , 'high'
            );
        }

        /**
         * afap_meta_box html
         *
         * */
        function render_meta_box_content($post) {
            // Add an nonce field so we can check for it later.
            wp_nonce_field('afap_meta_box_nonce_action', 'afap_meta_box_nonce_field');
            $default_auto_post = in_array($post->post_status, array("future", "draft", "auto-draft", "pending"))?'yes':'no';
            // Use get_post_meta to retrieve an existing value from the database.
            $auto_post = get_post_meta($post->ID, 'afap_auto_post', true);
            //var_dump($auto_post);
            $auto_post = ($auto_post == '' || $auto_post == 'yes') ? $default_auto_post : 'no';

            // Display the form, using the current value.
            ?>
            <label for="afap_auto_post"><?php _e('Enable Auto Post For Facebook Profile or Fan Pages?', 'accesspress-facebook-auto-post'); ?></label>
            <p>
                <select name="afap_auto_post">
                    <option value="yes" <?php selected($auto_post, 'yes'); ?>><?php _e('Yes', 'accesspress-facebook-auto-post'); ?></option>
                    <option value="no" <?php selected($auto_post, 'no'); ?>><?php _e('No', 'accesspress-facebook-auto-post'); ?></option>
                </select>
            </p>
            <?php
        }

        /**
         * Saves meta value
         * */
        function save_afap_meta_value($post_id) {
            //$this->print_array($_POST);die('abc');
            /*
             * We need to verify this came from the our screen and with proper authorization,
             * because save_post can be triggered at other times.
             */

            // Check if our nonce is set.
            if (!isset($_POST['afap_auto_post']))
                return $post_id;
             $nonce = (isset($_POST['afap_meta_box_nonce_field']) && $_POST['afap_meta_box_nonce_field'] !='')?$_POST['afap_meta_box_nonce_field']:'';

            // Verify that the nonce is valid.
            if (!wp_verify_nonce($nonce, 'afap_meta_box_nonce_action'))
                return $post_id;

            // If this is an autosave, our form has not been submitted,
            //     so we don't want to do anything.
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post_id;

            // Check the user's permissions.
            if ('page' == $_POST['post_type']) {

                if (!current_user_can('edit_page', $post_id))
                    return $post_id;
            } else {

                if (!current_user_can('edit_post', $post_id))
                    return $post_id;
            }

            /* OK, its safe for us to save the data now. */

            // Sanitize the user input.
            $auto_post = sanitize_text_field($_POST['afap_auto_post']);

            // Update the meta field.
            update_post_meta($post_id, 'afap_auto_post', $auto_post);
        }

        /**
         * Restores Default Settings
         */
        function restore_settings(){
            $afap_settings = $this->get_default_settings();
            $afap_extra_settings = array('authorize_status'=>0);
            update_option('afap_extra_settings', $afap_extra_settings);
            update_option('afap_settings', $afap_settings);
            $_SESSION['afap_message'] = __('Default Settings Restored Successfully','accesspress-facebook-auto-post');
            wp_redirect('admin.php?page=afap');
            exit();
        }

         function account_pages_and_groups($data) {
            $account_details = get_option('afap_settings');
             $asap_user_details = array();
            if (!empty($account_details)) {
                $page_group_lists = (isset($account_details['page_group_lists']) && !empty($account_details['page_group_lists']))?$account_details['page_group_lists']:array();
                $user_data_arr = (isset($account_details['user_data']) && !empty($account_details['user_data']))?$account_details['user_data']:array();
                if(!empty($user_data_arr)){
                    $asap_user_details = json_decode( $user_data_arr ,TRUE);
                }
            }
            if( is_array($asap_user_details) && !empty($asap_user_details) ) {
                foreach ($asap_user_details as $fb_sess_data) {

             $fb_sess_acc = isset( $fb_sess_data['auth_accounts'] ) ? $fb_sess_data['auth_accounts'] : array();
             $fb_sess_token = isset( $fb_sess_data['auth_tokens'] ) ? $fb_sess_data['auth_tokens'] : array();
                    // Loop of account and merging with page id and app key
                    if($data == "all_app_users_with_name"){
                        foreach ( $fb_sess_acc as $fb_page_id => $fb_page_name ) {
                            $res_data[$fb_page_id] = $fb_page_name;
                        }
                    }
                    elseif($data == "all_auth_tokens"){
                        foreach ( $fb_sess_token as $fb_sess_token_id => $fb_sess_token_data ) {
                            $res_data[$fb_sess_token_id] = $fb_sess_token_data;
                        }
                    }
                }
            }

            if(!empty($res_data)){
                return $res_data;
            }
        }

    }
    $afap_obj = new AFAP_Class();
}// class Termination
