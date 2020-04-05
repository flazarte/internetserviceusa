<?php defined('ABSPATH') or die('No script kiddies please!');
$id = $post->ID;
$account_details = get_option('afap_settings');
$account_extra_details = get_option('afap_extra_settings');
//$this->print_array($account_details);
//$this->print_array($account_extra_details);
$api_type = (isset($account_details['api_type']) && $account_details['api_type'] != '')?esc_attr($account_details['api_type']):'graph_api';

$post_type = get_post_type($id);
$taxonomies = get_object_taxonomies($post_type);
$terms = wp_get_post_terms($id, $taxonomies);
$categories = isset($account_details['category']) ? $account_details['category'] : array();
//$this->print_array($categories);
//$this->print_array($terms);
$category_flag = false;
if (count($categories) == 0) {
    $category_flag = true;
} else if (in_array('all', $categories)) {
    $category_flag = true;
} else {
    foreach ($terms as $term) {
        if (in_array($term->term_id, $categories)) {
            $category_flag = true;
        }
    }
}
if ($post_type == "page") {
   $category_flag = true;
}
//var_dump($category_flag);
//die();
/**
 * Checking if the post type of this post is enabled in the account settings and the account is already authorized
 *  in facebook
 * */
$account_details['post_types'] = (isset($account_details['post_types']) && !empty($account_details['post_types']))?$account_details['post_types']:array();
if($api_type == "graph_api"){
if (in_array($post_type, $account_details['post_types']) && $account_extra_details['authorize_status'] == 1 && $category_flag) {
    
    /**
     * Account Details
     * [application_id] => 1651381158424608
      [application_secret] => a697762125e735da3bea0309ee36c0d0
      [facebook_user_id] => devteam2070
      [message_format] => Test Post
      [include_image] => 1
      [post_image] => featured_image
      [custom_image_url] => adsfasdfasdf
      [auto_publish_pages] => Array
      (
      [0] => 1
      [1] => 881870878545563
      [2] => 1505719796374561
      )

      [post_types] => Array
      (
      [0] => post
      [1] => page
      )
     * */
    foreach ($account_details as $key => $val) {
        $$key = $val;
    }

    /**
     * Account Extra Details
     * Array
      (
      [authorize_status] => 1
      [pages] => Array
      (
      [0] => stdClass Object
      (
      [access_token] =>
      [category] => App page
      [name] => AccessPress Social Auto Post
      [id] => 881870878545563
      [perms] => Array
      (
      [0] => ADMINISTER
      [1] => EDIT_PROFILE
      [2] => CREATE_CONTENT
      [3] => MODERATE_CONTENT
      [4] => CREATE_ADS
      [5] => BASIC_ADMIN
      )

      )

      [1] => stdClass Object
      (
      [access_token] =>
      [category] => Organization
      [name] => Testing page
      [id] => 1505719796374561
      [perms] => Array
      (
      [0] => ADMINISTER
      [1] => EDIT_PROFILE
      [2] => CREATE_CONTENT
      [3] => MODERATE_CONTENT
      [4] => CREATE_ADS
      [5] => BASIC_ADMIN
      )

      )

      )

      [access_token] =>
      )
      #post_title,#post_content,#post_excerpt,#post_link,#author_name
     * */
    foreach ($account_extra_details as $key => $val) {
        $$key = $val;
    }
    $post_title = $post->post_title;
    $post_content = strip_tags($post->post_content);
    $post_content = str_replace('&nbsp;','',$post_content);
    $post_content = strip_shortcodes($post_content);
    $post_excerpt = $post->post_excerpt;
    $post_link = get_the_permalink($id);
    $post_author_id = $post->post_author;
    $caption = get_bloginfo('description');
    $author_name = get_the_author_meta('user_nicename', $post_author_id);
    $message_format = str_replace('#post_title', $post_title, $message_format);
    $message_format = str_replace('#post_content', $post_content, $message_format);
    $message_format = str_replace('#post_excerpt', $post_excerpt, $message_format);
    $message_format = str_replace('#post_link', $post_link, $message_format);
    $message_format = str_replace('#author_name', $author_name, $message_format);

    //echo $message_format;die();

    if (is_array($auto_post_pages) && !empty($auto_post_pages)) {
        foreach ($auto_post_pages as $auto_publish_page) {
            if ($auto_publish_page != 1) {
                $access_token = $pages[$auto_publish_page]->access_token;
                $page_id = $auto_publish_page;
                $page_name = $pages[$auto_publish_page]->name;
            } else {
                $page_id = '';
                $page_name = 'Profile Page';
            }
            //echo $page_id;die();
            $fb = new FBAPFacebook(array(
                'appId' => $access_token,
                'secret' => $application_secret,
                'cookie' => true
            ));
           // var_dump($fb);
            if ($post_format == 'simple') {  //For Simple Text Message Posting
                $attachment = array('message' => $message_format,
                    'access_token' => $access_token);
            } else {  //For attaching the blog post along with the text message
                if ($post_image == 'featured_image') {
                    if (has_post_thumbnail($id)) {
                        $image_id = get_post_thumbnail_id($id);
                        $image_url = wp_get_attachment_image_src($image_id, 'large', true);
                        $picture = $image_url[0];
                    } else {
                        $picture = trim($custom_image_url);
                    }
                } else {
                    $picture = trim($custom_image_url);
                }
                
                $description = ($post_content!='')?substr($post_content,0,10000):'';
                
                $attachment = array('message' => $message_format,
                    'access_token' => $access_token,
                    'link' => $post_link,
                    'actions' => array(array('name' => $post_title,'link' => $post_link))
                );
            }
            $post_id = $id;
            $log_time = date('Y-m-d h:i:s A');
            //$this->print_array($attachment);
            try {

                $result = $fb->api('/' . $page_id . '/feed/', 'post', $attachment);
                do_action('afap_after_post',$post_id);
                //var_dump($result);
                /**
                 * Logged as success
                 * */
                $log_status = 1;
                $log_details = __('Posted Successfully on ', 'accesspress-facebook-auto-post') . $page_name;
            } catch (Exception $e) {
                /**
                 * Logged as failure
                 * */
                //$this->print_array($e);die();
                $error_message = $e->getMessage();
                $log_status = 0;
                $log_details = $error_message;
                do_action('atap_error_post',$e);
            }

            /**
             * Inserting logs to logs table
             * */
            global $wpdb;
            $log_table_name = $wpdb->prefix . 'afap_logs';
            $wpdb->insert(
                    $log_table_name, array(
                'post_id' => $id,
                'log_status' => $log_status,
                'log_time' => $log_time,
                'log_details' => $log_details
                    ), array(
                '%d',
                '%d',
                '%s',
                '%s'
                    )
            );
        } //foreach auto publish pages
    } //If autopublish page is not empty check closed
}
}else{
//mobile api
if (in_array($post_type, $account_details['post_types']) && $category_flag) {
 foreach ($account_details as $key => $val) {
        $$key = $val;
 }
    $post_title = strip_tags($post->post_title);
    $post_content = strip_tags($post->post_content);
    $post_content = str_replace('&nbsp;','',$post_content);
    $post_content = strip_shortcodes($post_content);
    $post_content = ($post_content!='')?substr($post_content,0,10000):'';
    $post_excerpt = $post->post_excerpt;
    $post_link = get_the_permalink($id);
    $post_author_id = $post->post_author;
    $caption = get_bloginfo('description');
    $author_name = get_the_author_meta('user_nicename', $post_author_id);
    $message_format = str_replace('#post_title', $post_title, $message_format);
    $message_format = str_replace('#post_content', $post_content, $message_format);
    $message_format = str_replace('#post_excerpt', $post_excerpt, $message_format);
    $message_format = str_replace('#post_link', $post_link, $message_format);
    $message_format = str_replace('#author_name', $author_name, $message_format);
     if($post->post_type == 'product'){
        $_product = wc_get_product( $post->ID );
        $message_format = str_replace('#woo_sale_price', $_product->get_sale_price(), $message_format);
        $message_format = str_replace('#woo_regular_price', $_product->get_regular_price(), $message_format);
    }
$auto_publish_pages = (empty($account_details['page_group_lists']))?array(1):$account_details['page_group_lists'];
$user_data = (empty($account_details['user_data']))?array(1):$account_details['user_data'];
$send = array();
$user_data = (array) json_decode($user_data);
$fap_user_accounts = (empty($user_data['fap_user_accounts']))?array(1):$user_data['fap_user_accounts'];
$fap_user_accounts = (array)$fap_user_accounts;
$auth_tokens = (empty($fap_user_accounts['auth_tokens']))?array(1):$fap_user_accounts['auth_tokens'];
$auth_accounts =(empty($fap_user_accounts['auth_accounts']))?array(1):$fap_user_accounts['auth_accounts'];
$fap_auth_tokens = (array)$auth_tokens;
$fap_auth_accounts = (array)$auth_accounts;
if (is_array($auto_publish_pages) && !empty($auto_publish_pages)) {
        $facebook_api = new AFAP_REST_API();
        foreach ($auto_publish_pages as $auto_publish_page) {
             $fb_post_app_id = $auto_publish_page; // Facebook App ID
             foreach ($fap_auth_accounts as $key => $value ) {
               if($key == $fb_post_app_id){
                 $page_name = $value;
               }
             }
             foreach ($fap_auth_tokens as $k => $v ) {
               if($k == $fb_post_app_id){
                 $fb_access_token_of_app = $v;
               }
             }
             if (isset($fb_access_token_of_app)) {
                    $send['access_token'] = $fb_access_token_of_app;
             }
             if ($post_format == 'simple') {  //For Simple Text Message Posting
                $send['message'] = $message_format;
                if( !empty( $send['message'] ) ){
                    $send['message'] = urlencode($send['message']);  
                }
                $post_method = "feed"; //"feed" for wallposts
            } else {  
                $post_method = "feed"; //"feed" for wallposts
                $send['message'] = substr($message_format, 0, 999);
                $send['link'] = $post_link; // Does not take localhost. 
                $send['name'] = $post_title;
                $send['description'] = $post_content;
                if( isset( $send['link'] ) && !empty( $send['link'] ) ){
                    $send['link'] = urlencode($send['link']);
                }
                if( !empty( $send['message'] ) ){
                    $send['message'] = urlencode($send['message']);  
                }
                if( !empty( $send['description'] ) ){
                    $send['description'] = urlencode($send['description']);  
                }
                if( !empty( $send['name'] ) ){
                    $send['name'] = urlencode($send['name']);  
                }  
            }
            $access_token = $send['access_token'];
            
            $post_id = $id;
            $log_time = date('Y-m-d h:i:s A');
            $account_type = 'Facebook Mobile';

           
            $facebook_api->setMethod("POST");
            $facebook_api->setAccessToken( $access_token );
            $facebook_api->setEndPoint($post_method);
            $facebook_api->setNode( $fb_post_app_id );
            $rawResponse = $facebook_api->request($send);
            if($rawResponse === FALSE){
                $error_message = $facebook_api->getError();
            }
            $res = json_decode($rawResponse->getBody());
            /**
             * Logged as success
             * */
            if(isset($res->error) || !$res ){
                    $error_message = $facebook_api->getError();
                    $postflg = false;
           }
           if( isset( $res->id ) ) {
                    $postflg = true;
            } 
            if( $postflg != false ) {
                     $log_status = 1;
                     $log_details = __('Posted Successfully on ', AFAP_TD) . $page_name;
            }else{
                     $log_status = 0;
                     $log_details = $error_message;
            }
            /**
             * Inserting log to logs table
             * */
            /**
             * Inserting logs to logs table
             * */
            global $wpdb;
            $log_table_name = $wpdb->prefix . 'afap_logs';
            $wpdb->insert(
                    $log_table_name, array(
                'post_id' => $id,
                'log_status' => $log_status,
                'log_time' => $log_time,
                'log_details' => $log_details
                    ), array(
                '%d',
                '%d',
                '%s',
                '%s'
                    )
            );
        }//foreach auto publish pages
    }   //If autopublish page is not empty check closed //If autopublish page is not empty check closed
 }
}