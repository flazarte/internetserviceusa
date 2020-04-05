<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Code for the admin funcionality of My Instagram Feeds
//======================================================================

if ( !class_exists( 'MIF_Admin' ) ) {
    class MIF_Admin
    {
        /* Intitializing $adminurl .*/
        var  $adminurl ;
        /*
         * __construct initialize all function of this class.
         * Returns nothing. 
         * Used action_hooks to get things sequentially.
         */
        function __construct()
        {
            /*
             * admin_menu hooks fires on wp admin load.
             * Add the menu page in wp admin area.
             */
            add_action( 'admin_menu', array( $this, 'mif_menu' ), 100 );
            add_action( 'admin_footer', array( $this, 'mif_head' ) );
            /*
             * admin_enqueue_scripts hooks fires for enqueing custom script and styles.
             * Css file will be include in admin area.
             */
            add_action( 'admin_enqueue_scripts', array( $this, 'mif_admin_style' ) );
            /*
             * mif_save_values hooks fires on Ajax call.
             * mif_save_values method will be call when the authentication been done.
             */
            add_action( 'wp_ajax_mif_create_skin', array( $this, 'mif_create_skin' ) );
            /*
             * mif_delete_skin hooks fires on Ajax call.
             * mif_delete_skin method will be call when the delete skin button is clicked.
             */
            add_action( 'wp_ajax_mif_delete_skin', array( $this, 'mif_delete_skin' ) );
            /*
             * mif_create_skin_url hooks fires on Ajax call.
             * mif_create_skin_url method will be call when the delete skin button is clicked.
             */
            add_action( 'wp_ajax_mif_create_skin_url', array( $this, 'mif_create_skin_url' ) );
            /*
             * mif_delete_transient hooks fires on Ajax call.
             * mif_delete_transient method will be call when the delete transient button is clicked.
             */
            add_action( 'wp_ajax_mif_delete_transient', array( $this, 'mif_delete_transient' ) );
        }
        
        /* __construct Method ends here. */
        /*
         * mif_admin_style will enqueue style and js files.
         * Returns hook name of the current page in admin.
         * $hook will contain the hook name.
         */
        public function mif_admin_style( $hook )
        {
            // exit(MIF_PLUGIN_URL);
            /*
             * Following files should load only on mif page in backend.
             */
            if ( 'easy-social-feed_page_mif' !== $hook ) {
                return;
            }
            /*
             * Css file for admin area.
             */
            wp_enqueue_style( 'mif_admin_style', MIF_PLUGIN_URL . 'assets/css/mif_admin_style.css' );
            /*
             * Custom scripts file for admin area.
             */
            wp_enqueue_script( 'mif_admin_jquery', MIF_PLUGIN_URL . 'assets/js/mif-admin.js', array( 'jquery' ) );
            // echo "<pre>";
            // print_r(admin_url('admin-ajax.php'));exit();
            wp_localize_script( 'mif_admin_jquery', 'mif', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'mif-ajax-nonce' ),
            ) );
            wp_enqueue_script( 'media-upload' );
            wp_enqueue_media();
        }
        
        /* mif_admin_style Method ends here. */
        /*
         * mif_menu will add admin page.
         * Returns nothing.
         */
        public function mif_menu()
        {
            $mif_page_title = __( 'Instagram', 'easy-facebook-likebox' );
            /*
             * add_menu_page will add menu into the page.
             * string $page_title 
             * string $menu_title 
             * string $capability 
             * string $menu_slug
             * callable $function 
             */
            add_submenu_page(
                'feed-them-all',
                $mif_page_title,
                $mif_page_title,
                'administrator',
                $menu_slug = 'mif',
                array( $this, 'mif_page_cb' )
            );
        }
        
        /* mif_menu Method ends here. */
        /*
         * mif_page_cb contains the html/markup of the page.
         * Returns nothing.
         */
        public function mif_page_cb()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $mif_users = array();
            $mif_pro_auth_noti = null;
            // echo "<pre>";
            //  	print_r($fta_settings);exit();
            /*
             * Getting the saved acocunts.
             */
            if ( isset( $fta_settings['plugins']['instagram']['authenticated_accounts'] ) ) {
                $mif_users = $fta_settings['plugins']['instagram']['authenticated_accounts'];
            }
            $mif_ver = null;
            $mif_ver = efl_fs()->is_premium();
            $mif_version = ( $mif_ver ? 'pro' : 'free' );
            /*
             * Getting all skins.
             */
            global  $mif_skins ;
            /*
             * Registred Apps ID's
             */
            // $app_ID = array('222116127877068','405460652816219','256146211143372', '406362656509338','395202813876688');
            $app_ID = array( '405460652816219', '222116127877068' );
            /*
             * Randomly get one
             */
            $rand_app_ID = array_rand( $app_ID, '1' );
            /*
             * To use APP ID
             */
            $u_app_ID = $app_ID[$rand_app_ID];
            $fb_access_token = null;
            if ( isset( $fta_settings['plugins']['facebook']['access_token'] ) ) {
                $fb_access_token = $fta_settings['plugins']['facebook']['access_token'];
            }
            /*
             * Getting the access token and insta id from URL.
             * Seprating the user id from access token.
             */
            /*
             * If Acees Token retrived successfully save it in database automatically.
             */
            
            if ( isset( $_GET['access_token'] ) && !empty($_GET['access_token']) ) {
                $access_token = $_GET['access_token'];
                $access_token = preg_replace( '/[^A-Za-z0-9]/', "", $access_token );
                
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    $script = ' <script>
                    jQuery( document ).ready(function( $ ) {

                        jQuery("#toast-container").slideUp("slow");

                        Materialize.Toast.removeAll();

                       /*
                        * Show the dialog for Saving.
                        */
                        Materialize.toast("Please wait! Authenticating...", 50000000);

                        var url      = window.location.href; 
                        
                        url = MIFremoveURLParameter(url, "access_token");

                        jQuery("#efbl_access_token").text("' . $access_token . '");

                       var data={\'action\':\'efbl_save_access_token\',
                                \'access_token\':\'' . $access_token . '\',
                                \'id\' : \'insta\'
                            }

                   jQuery.ajax({
                        
                        url: "' . admin_url( 'admin-ajax.php' ) . '",
                        type: "post",
                        data: data,
                        dataType: "json",
                        success: function(response ) {
                            window.history.pushState("newurl", "newurl", url);
                            // jQuery("#toast-container").slideUp("slow");

                            Materialize.Toast.removeAll();

                             

                            /*
                            * Show the dialog.
                            */
                            
                            if (response.success) {

                                var pages_html = response.data["1"];

                                if(pages_html == null) { $(\'#fta-auth-error\').modal(\'open\');return;}

                                // console.log(response.data);return;
                                Materialize.toast(response.data["0"], 3000);
                                jQuery("#toast-container").addClass("efbl_green");
                                jQuery(".efbl_all_pages").html(" ").html(response.data["1"]).slideDown("slow");
                                jQuery(".fta_noti_holder").fadeOut("slow");
                                setTimeout(function(){ 
                                    window.location.href = "#mif-shortcode";
                                    window.location.reload();
                                }, 2000);
                            }else{
                                Materialize.toast(response.data, 3000);
                            
                            jQuery("#toast-container").addClass("efbl_red");
                                
                            }
                        }
                         });
                      
                    
                    });
              </script>';
                    echo  $script ;
                }
            
            }
            
            $efbl_ap_class = null;
            $efbl_all_pages_html = null;
            $mif_insta_accounts = null;
            // echo "<pre>";print_r($fta_settings);exit();
            /*
             * If approved pages exists show them
             */
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                $efbl_all_pages_html = '<ul class="collection with-header"> <li class="collection-header"><h5>' . __( 'Connected Instagram Accounts', 'easy-facebook-likebox' ) . '</h5> <a href="#fta-remove-at" class="modal-trigger fta-remove-at-btn tooltipped" data-position="left" data-delay="50" data-tooltip="' . __( 'Delete Access Token', 'easy-facebook-likebox' ) . '"><i class="material-icons">delete_forever</i></a></li>';
                $efbl_ap_class = 'show';
                foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
                    $fta_insta_connected_account = $efbl_page['instagram_connected_account'];
                    
                    if ( isset( $fta_insta_connected_account->ig_id ) && !empty($fta_insta_connected_account->ig_id) ) {
                        $mif_insta_accounts[] = $fta_insta_connected_account;
                        // echo "<pre>"; print_r($fta_insta_connected_account);exit();
                        $efbl_all_pages_html .= sprintf(
                            '<li class="collection-item avatar fta_insta_connected_account li-' . $fta_insta_connected_account->ig_id . '">
                    
                    <a href="https://www.instagram.com/' . $fta_insta_connected_account->username . '" target="_blank">
                              <img src="%2$s" alt="" class="circle">
                    </a>          
                              <span class="title">%1$s</span>
                              <p>%5$s <br> %6$s %3$s <i class="material-icons efbl_copy_id tooltipped" data-position="right" data-clipboard-text="%3$s" data-delay="100" data-tooltip="%7$s">content_copy</i></p>
                         </li>',
                            $fta_insta_connected_account->name,
                            $fta_insta_connected_account->profile_picture_url,
                            $fta_insta_connected_account->id,
                            __( 'Instagram account connected with ' . $efbl_page['name'] . '', 'easy-facebook-likebox' ),
                            $fta_insta_connected_account->username,
                            __( 'ID:', 'easy-facebook-likebox' ),
                            __( 'Copy', 'easy-facebook-likebox' )
                        );
                    }
                
                }
                $efbl_all_pages_html .= '</ul>';
            }
            
            // echo "<pre>"; print_r($mif_insta_accounts);exit();
            /*
             * $returner variable will contain all html.
             * $returner defines empty at start to avoid junk values.
             */
            $returner = null;
            $adminurl = admin_url( 'admin.php?page=mif' );
            $authenticated_accounts = $mif_users;
            //echo "<pre>"; print_r($a);exit();
            /*
             * General tab html.
             * mif_general_html filter can be used to customize general tab html.
             */
            $mif_general_html = null;
            $mif_premium_auth_btn = '<a class="mif_auth_btn mif_auth_btn_st btn waves-effect waves-light" href="https://www.facebook.com/dialog/oauth?client_id=' . $u_app_ID . '&redirect_uri=https://maltathemes.com/efbl/app-' . $u_app_ID . '/index.php&scope=manage_pages,instagram_basic&state=' . $adminurl . '">
            <img src="' . MIF_PLUGIN_URL . '/assets/images/insta-logo.png"/>' . __( 'Connect My Instagram Account', 'easy-facebook-likebox' ) . '</a>';
            $mif_general_html .= sprintf(
                '<div id="mif-general" class="col s12 mif_tab_c slideLeft">	
                 <h5>%1$s</h5>
                 <p class="mif_auth_notice">%2$s  <a href="https://easysocialfeed.com/documentation/how-to-connect-instagram-account-with-facebook-page/" target="_blank">%10$s</a> </p>			
					%3$s
			       

                         <div class="row auth-row">
                            <div class="efbl_all_pages col s12 %7$s">
                                %6$s
                            </div>
                         </div>

                    <p>%8$s</p>
				</div>',
                /* Variables starts here. */
                __( "Let's connect your account with plugin", 'easy-facebook-likebox' ),
                __( 'Due to recent changes in Facebook and Instagram API in order to display your Instagram feeds you will have to connect your Instagram account with any Facebook page that you manage.', 'easy-facebook-likebox' ),
                $mif_premium_auth_btn,
                __( 'Access Token', 'easy-facebook-likebox' ),
                $fb_access_token,
                $efbl_all_pages_html,
                $efbl_ap_class,
                __( "Please note: This does not give us permission to manage your Facebook pages, it simply allows the plugin to see a list of the pages you manage and retrieve an Access Token.", 'easy-facebook-likebox' ),
                __( 'Save', 'easy-facebook-likebox' ),
                __( 'Step by step guide to connect account with video.', 'easy-facebook-likebox' )
            );
            $mif_general_html = apply_filters( 'mif_general_html', $mif_general_html );
            $mif_skin_options = null;
            if ( isset( $mif_skins ) ) {
                foreach ( $mif_skins as $mif_skin ) {
                    $mif_skin_options .= '<option value="' . $mif_skin['ID'] . '" data-icon="' . get_the_post_thumbnail_url( $mif_skin['ID'], 'thumbnail' ) . '">' . $mif_skin['title'] . '</option>';
                }
            }
            $mif_users_options = null;
            $mif_auth_accounts = $mif_users;
            $mif_all_auth_accounts = count( $mif_auth_accounts );
            
            if ( isset( $mif_auth_accounts ) && $mif_all_auth_accounts > 1 ) {
                foreach ( $mif_auth_accounts as $mif_auth_account ) {
                    $mif_users_options .= '<option value="' . $mif_auth_account['user_id'] . '" data-icon="' . $mif_auth_account['profile_picture'] . '">' . $mif_auth_account['username'] . '</option>';
                }
            } else {
                $mif_users_options .= '<option value="" disabled selected>' . __( 'Connect More Than One Account To Use This Feature.', 'easy-facebook-likebox' ) . '</option>';
            }
            
            /*
             * Shortcode tab html.
             * mif_shortcode_html filter can be used to customize shortcode tab html.
             */
            $mif_shortcode_html = null;
            $mif_premium_hashtag = null;
            $mif_premium_multi_feeds = '<span class="form_fields">
										      <input name="" class="modal-trigger" href="#mif-multifeed-upgrade" type="checkbox" required value="mif_free_multifeed" id="mif_free_multifeed" />
										      <label for="mif_free_multifeed">' . __( 'Multiple Feeds', 'easy-facebook-likebox' ) . '</label>
	   									  </span>';
            $fta_settings = $FTA->fta_get_settings();
            $skin_id = null;
            /* Getting the demo page id. */
            if ( isset( $fta_settings['plugins']['instagram']['default_skin_id'] ) && !empty($fta_settings['plugins']['instagram']['default_skin_id']) ) {
                $skin_id = $fta_settings['plugins']['instagram']['default_skin_id'];
            }
            $mif_insta_account = null;
            if ( isset( $mif_insta_accounts['0']->id ) ) {
                $mif_insta_account = $mif_insta_accounts['0']->id;
            }
            $mif_users_id_options = null;
            
            if ( $mif_insta_accounts ) {
                foreach ( $mif_insta_accounts as $mif_insta_single_account ) {
                    $mif_users_id_options .= '<option value="' . $mif_insta_single_account->id . '" data-icon="' . $mif_insta_single_account->profile_picture_url . '">' . $mif_insta_single_account->username . '</option>';
                }
            } else {
                $mif_users_id_options = '<option value="" disabled selected>' . __( 'No accounts found, Please connect your Instagram account with plugin first', 'easy-facebook-likebox' ) . '</option>';
            }
            
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                $mif_default_shortcode = '<p>' . __( 'Copy and paste the following shortcode in any page, post or text widget to display the feed.', 'easy-facebook-likebox' ) . '</p>
                                    <blockquote class="mif-shortcode-block">[my-instagram-feed user_id=' . $mif_insta_account . ' skin_id=' . $skin_id . '] </blockquote> 
                                    <a class="btn waves-effect mif_copy_shortcode waves-light tooltipped" data-position="right" data-delay="50" data-tooltip="' . __( 'Copy', 'easy-facebook-likebox' ) . '" data-clipboard-text="[my-instagram-feed user_id=' . $mif_insta_account . ' skin_id=' . $skin_id . ']" href="javascript:void(0);"><i class="material-icons right">content_copy</i> </a>
';
            } else {
                $mif_default_shortcode = '<blockquote class="efbl-red-notice">' . __( 'It looks like you have not connected your Instagram account with plugin yet. Please click on the Connect My Instagram Account button from authentication tab to get the access token from Facebook and then go with the flow.', 'easy-facebook-likebox' ) . '</blockquote>';
            }
            
            // echo '<pre>'; print_r($mif_users_id_options);exit();
            $mif_shortcode_html .= sprintf(
                '<div id="mif-shortcode" class="col s12 mif_tab_c slideLeft">
						<div class="mif-swipe-shortcode_wrap">
							
							<div class="mif_shortocode_genrator_wrap">

									<h5>%3$s</h5>

                                    %37$s
									
									<h5>%18$s</h5>
									<p>%21$s</p>
									<form class="mif_shortocode_genrator" name="mif_shortocode_genrator" type="post">

                                        <div class="input-field col s6 mif_fields">
                                            <select id="mif_user_id" class="icons mif_skin_id">
                                             %36$s
                                            </select>
                                            <label>%10$s</label>
                                          </div>

						              	 <div class="input-field col s6 mif_fields">
							                <input id="mif_feeds_per_page" type="number" min="1">
							                <label for="mif_feeds_per_page" class="">%14$s</label>
						              	</div>

						              	 <div class="input-field col s6 mif_fields">
						              	 <select id="mif_skin_id" class="icons mif_skin_id">
									      <option value="" disabled selected>%12$s</option>
									      %25$s
									    </select>
							                
						              	</div>

						              	 <div class="input-field col s6 mif_fields">
							                <input id="mif_wrap_class" type="text">
							                <label for="mif_wrap_class" class="">%4$s</label>
						              	</div>

						              	 <div class="input-field col s6 mif_fields">
							                <input id="mif_caption_words" type="number" min="1">
							                <label for="mif_caption_words" class="">%16$s</label>
						              	</div>

						              	<div class="input-field col s6 mif_fields">
							                <input id="mif_cache_unit" type="number" min="1">
							                <label for="mif_cache_unit" class="">%6$s</label>
						              	</div>

						               <div class="input-field col s6 mif_fields">
						              	 <select id="mif_cache_duration" class="icons mif_cache_duration">
									      <option value="" disabled selected>%26$s</option>
									      <option value="minutes" >%27$s</option>
									      <option value="hours">%28$s</option>
									      <option value="days">%29$s</option>
									    </select>
							                
						              	</div>

						              	<div style="display:none" class="mif_have_multi_users"></div>

						              	<input type="submit" class="btn  mif_shortcode_submit" value="%22$s" />
									</form>
									 <div class="mif_generated_shortcode">
									 <blockquote class="mif-shortcode-block"></blockquote>
										<a class="btn waves-effect mif_copy_shortcode mif_shortcode_generated_final waves-light tooltipped" data-position="right" data-delay="50" data-tooltip="%24$s"  href="javascript:void(0);"><i class="material-icons right">content_copy</i> </a>
									 </div>	
								</div>	

								<h5>%1$s</h5>
							<p>%2$s</p>
							

							 <ul class="collapsible" data-collapsible="accordion">
								  <li>
								    <div class="collapsible-header">
								      <i class="material-icons">class</i>
								    	<span class="mif_detail_head"> %4$s </span>
								     </div>
								    <div class="collapsible-body"><p>%5$s</p></div>
								  </li>
								 

								  <li>
								    <div class="collapsible-header">
								      <i class="material-icons">account_circle</i>   
								      <span class="mif_detail_head"> %10$s</span>
								      </div>
								     <div class="collapsible-body"><p>%11$s</p></div>
								  </li>

								   <li>
								    <div class="collapsible-header">
								      <i class="material-icons">web</i>
								      <span class="mif_detail_head"> %12$s</span>
								      </div>
								     <div class="collapsible-body"><p>%13$s</p></div>
								  </li>

								  <li>
								    <div class="collapsible-header">
								      <i class="material-icons">view_compact</i>
								      <span class="mif_detail_head"> %14$s</span>
								      </div>
								     <div class="collapsible-body"><p>%15$s</p></div>
								  </li>

								  <li>
								    <div class="collapsible-header">
								      <i class="material-icons">plus_one</i>
								      <span class="mif_detail_head"> %16$s</span>
								      </div>
								     <div class="collapsible-body"><p>%17$s</p></div>
								  </li>

								   <li>
								    <div class="collapsible-header">
								      <i class="material-icons">cached</i>
								      <span class="mif_detail_head"> %6$s</span>
								      </div>
								     <div class="collapsible-body"><p>%7$s</p></div>
								  </li>

								  <li>
								    <div class="collapsible-header">
								      <i class="material-icons">access_time</i>
								      <span class="mif_detail_head">%26$s</span>
								      </div>
								     <div class="collapsible-body"><p>%32$s</p></div>
								  </li>

								</ul>
								
						</div>
				</div>',
                /* Variables starts here. */
                __( "Unable to understand shortocde parameters?", 'easy-facebook-likebox' ),
                __( 'No worries, Each shortocde parameter is explained below first read them and generate your shortocde.', 'easy-facebook-likebox' ),
                __( 'How to use this plugin?', 'easy-facebook-likebox' ),
                __( 'Wrapper Class', 'easy-facebook-likebox' ),
                __( 'You can easily add the custom CSS class to the wraper of your Instagram Feeds.', 'easy-facebook-likebox' ),
                __( 'Cache Unit', 'easy-facebook-likebox' ),
                __( 'Feeds Will be automatically refreshed after particular minutes/hours/days. Simply paste the number of days in cache_unit parameter.', 'easy-facebook-likebox' ),
                __( 'Hashtag', 'easy-facebook-likebox' ),
                __( 'You can also show the Instagram Feeds by hashtag. Simply insert the hashtag. It will override the username option and display feeds by hashtag only.', 'easy-facebook-likebox' ),
                __( 'Accounts', 'easy-facebook-likebox' ),
                __( "You can display any of the connected account feeds. Select the account you wish to display the feeds from list.", 'easy-facebook-likebox' ),
                __( 'Skin', 'easy-facebook-likebox' ),
                __( 'You can totally change the look and feel of your feeds section. Simply paste the Skin ID in skin_id parameter. You can find the skins in dashboard->My Instagram Feeds->Skins section.', 'easy-facebook-likebox' ),
                __( 'Feeds Per Page', 'easy-facebook-likebox' ),
                __( 'You can show only specific feeds. Simply paste the Feeds Per Page number in feeds_per_page parameter.', 'easy-facebook-likebox' ),
                __( 'Caption Words', 'easy-facebook-likebox' ),
                __( 'You can show limited caption words. Simply paste the Caption Words number in caption_words parameter.', 'easy-facebook-likebox' ),
                __( 'Need More Options?', 'easy-facebook-likebox' ),
                __( 'User Name', 'easy-facebook-likebox' ),
                __( 'Hashtag', 'easy-facebook-likebox' ),
                __( 'Use the following shortcode generator to further customize the shortcode.', 'easy-facebook-likebox' ),
                __( 'Generate', 'easy-facebook-likebox' ),
                __( 'Copy and paste the following shortcode in any page, post or text widget to display the feed.', 'easy-facebook-likebox' ),
                __( 'Copy', 'easy-facebook-likebox' ),
                $mif_skin_options,
                __( 'Cache Duration', 'easy-facebook-likebox' ),
                __( 'Minutes', 'easy-facebook-likebox' ),
                __( 'Hours', 'easy-facebook-likebox' ),
                __( 'Days', 'easy-facebook-likebox' ),
                __( 'Multiple Feeds', 'easy-facebook-likebox' ),
                $mif_users_options,
                __( 'Define cache duration to refresh feeds automatically. Like after minutes/hours/days feeds would be refreshed. Simply paste the duration option in cache_duration parameter', 'easy-facebook-likebox' ),
                $mif_premium_hashtag,
                $mif_premium_multi_feeds,
                __( 'PRO', 'easy-facebook-likebox' ),
                $mif_users_id_options,
                $mif_default_shortcode
            );
            $mif_skin_html = null;
            /* Getting the demo page id. */
            $fta_settings = $FTA->fta_get_settings();
            $page_id = null;
            /* Getting the demo page id. */
            if ( isset( $fta_settings['plugins']['instagram']['default_page_id'] ) && !empty($fta_settings['plugins']['instagram']['default_page_id']) ) {
                $page_id = $fta_settings['plugins']['instagram']['default_page_id'];
            }
            $page_permalink = get_permalink( $page_id );
            
            if ( isset( $mif_skins ) ) {
                foreach ( $mif_skins as $mif_skin ) {
                    $customizer_url = admin_url( 'customize.php' );
                    /* If permalink got successfully */
                    if ( isset( $page_permalink ) ) {
                        /* Include permalinks for making*/
                        $customizer_url = add_query_arg( array(
                            'url'              => urlencode( $page_permalink ),
                            'autofocus[panel]' => 'mif_skins_panel',
                            'mif_skin_id'      => $mif_skin['ID'],
                            'mif_customize'    => 'yes',
                        ), $customizer_url );
                    }
                    $selected_layout = null;
                    if ( isset( $mif_skin['design']['layout_option'] ) ) {
                        $selected_layout = ucfirst( str_replace( "_", " ", $mif_skin['design']['layout_option'] ) );
                    }
                    /* if condition ends here*/
                    $skin_img = ( get_the_post_thumbnail_url( $mif_skin['ID'], 'thumbnail' ) ? get_the_post_thumbnail_url( $mif_skin['ID'], 'thumbnail' ) : MIF_PLUGIN_URL . 'assets/images/skin-placeholder.jpg' );
                    $mif_skin_html .= '<div class="card col mif_single_skin s3 mif_skin_' . $mif_skin['ID'] . '">
					    <div class="card-image waves-effect waves-block waves-light">
					      <img class="activator" src="' . $skin_img . '">
					    </div>
					    <div class="card-content">
					      <span class="card-title activator grey-text text-darken-4">' . $mif_skin['title'] . '<i class="material-icons right">more_vert</i></span>

					    </div>';
                    if ( $selected_layout ) {
                        $mif_skin_html .= '<span class="selected_layout">' . __( 'Layout: ', 'easy-facebook-likebox' ) . '' . $selected_layout . '</span>';
                    }
                    $mif_skin_html .= '<div class="mif_cta_holder">
                            <label>' . __( 'Please select your account first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any account.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="mif_selected_account_' . $mif_skin['ID'] . '" required>
                            ' . $mif_users_id_options . '
                            </select>

                            <a class="btn waves-effect  mif_skin_redirect waves-light" data-page_id="' . $page_id . '" data-skin_id="' . $mif_skin['ID'] . '" href="javascript:void(0);"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

					      	<a class="btn waves-effect right mif_skin_delete_confrim waves-light" data-skin_id="' . $mif_skin['ID'] . '" href="javascript:void(0);"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

					      		<a class="btn waves-effect mif_copy_skin_id waves-light"  data-clipboard-text="' . $mif_skin['ID'] . '" href="javascript:void(0);">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
					      </div>

					    <div class="card-reveal">
					      <span class="card-title grey-text text-darken-4">' . $mif_skin['title'] . '<i class="material-icons right">close</i></span>
					      <p>' . $mif_skin['description'] . '</p>
					    </div>
					  </div>';
                }
            } else {
                $mif_skin_html .= '<blockquote class="error">' . __( 'Whoops! No skin found. Create new skin from button above to totally customize your feed in real-time.', 'easy-facebook-likebox' ) . '</blockquote>';
            }
            
            
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $mif_skin_html .= '<div class="card col mif_single_skin mif_single_skin_free s3">
                        <a class="skin_free_full modal-trigger" href="#mif-free-masonry-upgrade"></a>
                        <div class="card-image waves-effect waves-block waves-light">
                         <a class=" modal-trigger" href="#mif-free-masonry-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
                        </div>
                        <div class="card-content">
                         <a class=" modal-trigger" href="#mif-free-masonry-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Masonry layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
                          </div>
                          <span class="selected_layout">' . __( 'Layout: Masonry', 'easy-facebook-likebox' ) . '</span>
                          <div class="mif_cta_holder">
                           <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="mif_selected_account" required>
                            ' . $mif_users_id_options . '
                            </select>
                            <a class="btn waves-effect  waves-light mif_skin_redirect_free modal-trigger" href="#mif-free-masonry-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

                            <a class="btn waves-effect right mif_skin_delete_free waves-light modal-trigger" href="#mif-free-masonry-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

                                <a class="btn waves-effect mif_copy_skin_id modal-trigger  waves-light" href="#mif-free-masonry-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
                          </div>

                        <div class="card-reveal">
                          <span class="card-title grey-text text-darken-4">' . __( 'Layout: Masonry', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
                          <p>' . __( 'This is the Masonry demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
                        </div>
                      </div>';
                $mif_skin_html .= '<div class="card col mif_single_skin mif_single_skin_free s3">
                        <a class="skin_free_full modal-trigger" href="#mif-free-carousel-upgrade"></a>
                        <div class="card-image waves-effect waves-block waves-light">
                         <a class=" modal-trigger" href="#mif-free-carousel-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
                        </div>
                        <div class="card-content">
                         <a class=" modal-trigger" href="#mif-free-carousel-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Carousel layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
                          </div>
                          <span class="selected_layout">' . __( 'Layout: Carousel', 'easy-facebook-likebox' ) . '</span>
                          <div class="mif_cta_holder">
                           <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="mif_selected_account" required>
                            ' . $mif_users_id_options . '
                            </select>
                            <a class="btn waves-effect  waves-light mif_skin_redirect_free modal-trigger" href="#mif-free-carousel-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

                            <a class="btn waves-effect right mif_skin_delete_free waves-light modal-trigger" href="#mif-free-carousel-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

                                <a class="btn waves-effect mif_copy_skin_id modal-trigger  waves-light" href="#mif-free-carousel-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
                          </div>

                        <div class="card-reveal">
                          <span class="card-title grey-text text-darken-4">' . __( 'Layout: Carousel', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
                          <p>' . __( 'This is the Carousel demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
                        </div>
                      </div>';
                $mif_skin_html .= '<div class="card col mif_single_skin mif_single_skin_free s3">
                        <a class="skin_free_full modal-trigger" href="#mif-free-half_width-upgrade"></a>
                        <div class="card-image waves-effect waves-block waves-light">
                         <a class=" modal-trigger" href="#mif-free-half_width-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
                        </div>
                        <div class="card-content">
                         <a class=" modal-trigger" href="#mif-free-half_width-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Half Width layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
                          </div>
                          <span class="selected_layout">' . __( 'Layout: Half Width', 'easy-facebook-likebox' ) . '</span>
                          <div class="mif_cta_holder">
                           <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="mif_selected_account" required>
                            ' . $mif_users_id_options . '
                            </select>
                            <a class="btn waves-effect  waves-light mif_skin_redirect_free modal-trigger" href="#mif-free-half_width-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

                            <a class="btn waves-effect right mif_skin_delete_free waves-light modal-trigger" href="#mif-free-half_width-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

                                <a class="btn waves-effect mif_copy_skin_id modal-trigger  waves-light" href="#mif-free-half_width-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
                          </div>

                        <div class="card-reveal">
                          <span class="card-title grey-text text-darken-4">' . __( 'Layout: Half Width', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
                          <p>' . __( 'This is the Half Width demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
                        </div>
                      </div>';
                $mif_skin_html .= '<div class="card col mif_single_skin mif_single_skin_free s3">
                        <a class="skin_free_full modal-trigger" href="#mif-free-full_width-upgrade"></a>
                        <div class="card-image waves-effect waves-block waves-light">
                         <a class=" modal-trigger" href="#mif-free-full_width-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
                        </div>
                        <div class="card-content">
                         <a class=" modal-trigger" href="#mif-free-full_width-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Full Width layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
                          </div>
                          <span class="selected_layout">' . __( 'Layout: full_width', 'easy-facebook-likebox' ) . '</span>
                          <div class="mif_cta_holder">
                           <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="mif_selected_account" required>
                            ' . $mif_users_id_options . '
                            </select>
                            <a class="btn waves-effect  waves-light mif_skin_redirect_free modal-trigger" href="#mif-free-full_width-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

                            <a class="btn waves-effect right mif_skin_delete_free waves-light modal-trigger" href="#mif-free-full_width-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

                                <a class="btn waves-effect mif_copy_skin_id modal-trigger  waves-light" href="#mif-free-full_width-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
                          </div>

                        <div class="card-reveal">
                          <span class="card-title grey-text text-darken-4">' . __( 'Layout: Full width', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
                          <p>' . __( 'This is the full Width demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
                        </div>
                      </div>';
            }
            
            // echo "<pre>"; print_r($mif_skins);exit();
            /*
             * Getting MIF transients.
             */
            $mif_transients = $this->mif_transients();
            /*
             * Cache tab html.
             * mif_cache_html filter can be used to customize cache tab html.
             */
            $mif_cache_html = null;
            $mif_cache_html .= sprintf(
                '<div id="mif-cache" class="col s12 mif_tab_c slideLeft">
						<div class="mif-swipe-cache_wrap">
							 %1$s
						</div>
				</div>',
                /* Variables starts here. */
                $mif_transients
            );
            $mif_cache_html = apply_filters( 'mif_shortcode_html', $mif_cache_html );
            $layout_choices = '<option value="grid">' . __( 'Grid', 'easy-facebook-likebox' ) . '</option>';
            
            if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $layout_choices .= '<option value="free-masonary">' . __( 'Masonry', 'easy-facebook-likebox' ) . '</option>
                                   <option value="free-carousel">' . __( 'Carousel', 'easy-facebook-likebox' ) . '</option>
                                   <option value="free-half_width">' . __( 'Half Width', 'easy-facebook-likebox' ) . '</option>
                                   <option value="free-full_width">' . __( 'Full Width', 'easy-facebook-likebox' ) . '</option>';
            }
            
            /*
             * Skins tab html.
             * mif_skinsl_html filter can be used to customize skins tab html.
             */
            $mif_skins_html = null;
            $mif_skins_html .= sprintf(
                '<div id="mif-skins" class="col s12 mif_tab_c slideLeft"><div class="row">
					
                    <div class="mif_skin_head_wrap">
                        <h5>%9$s</h5>
                        <p>%10$s</p>
                    </div>

					<a class="btn waves-effect mif_create_skin waves-light" href="javascript:void(0);">%1$s <i class="material-icons left">add_circle_outline</i></a>

					<!-- New Skin Html Starts Here -->
					<div class="mif_new_skin col s12">	
					  <form name="mif_new_skin_details" id="mif_new_skin_details">
                         <a class="waves-effect waves-light mif_show_all_skins btn" href="javascript:void(0);">%11$s <i class="material-icons left">list</i></a>
					  	<div class="input-field">
					  		<i class="material-icons prefix">title</i>
			                <input id="mif_skin_title" required name="mif_skin_title" type="text">
			                <label for="mif_skin_title" class="">%2$s</label>
			             </div>

			             <div class="input-field">
			                <i class="material-icons prefix">description</i>
			                <textarea id="mif_skin_description" required name="mif_skin_description" class="materialize-textarea"></textarea>
			                <label for="mif_skin_description" class="">%3$s</label>
		              	</div>

                       
		              	<div class="input-field">
			               
						<div class="mdl-textfield mdl-js-textfield mif_skin_feat_img_wrap">
			                	 <i class="material-icons prefix">image</i>
										    <input class="mdl-textfield__input" type="text" id="mif_skin_feat_img" placeholder="%7$s" value="" name="mif_skin_feat_img">
										    <label class="mdl-textfield__label" for="mif_skin_feat_img"></label>
							 <i class="btn waves-effect waves-light waves-input-wrapper">
							    <input type="button" class="" value="%4$s" id="mif_skin_feat_img_btn"/>
                                <i class="material-icons left">file_upload</i>
                            </i>    
						  </div>		
		              	</div>

                        <div class="input-field">
                            <i class="material-icons prefix">developer_board</i>
                               <select id="mif_selected_layout" class="mif_selected_layout" name="mif_selected_layout" required>
                                %12$s
                            </select>  
                            <label for="mif_selected_layout" class="">%13$s</label>
                        </div>

                         <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                               <select id="mif_skin_selected" class="mif_selected_account" name="mif_selected_account" required>
                            ' . $mif_users_id_options . '
                            </select>  
                            <label for="mif_skin_selected" class="">%8$s</label>
                        </div>
                        <i class="btn waves-effect create_new_skin_fb_wrap waves-light waves-input-wrapper">
		              	   <input type="submit" class="create_new_skin_sub" name="create_new_skin_sub" value="%5$s"/>
                            <i class="material-icons right">add_circle_outline</i>
                        </i>   
					  </form>	
					</div> 
					<!-- New Skin Html Ends Here -->	

					<!-- Skin Html Starts Here -->
					<div class="mif_all_skins col s12">	
                        
					 	%6$s
					 </div> 
					<!-- Skin Html Ends Here -->


				</div></div>',
                /* Variables starts here. */
                __( 'Create New Skin', 'easy-facebook-likebox' ),
                __( 'Title (optional)', 'easy-facebook-likebox' ),
                __( 'Description (optional)', 'easy-facebook-likebox' ),
                __( 'Upload Skin Image', 'easy-facebook-likebox' ),
                __( 'Create', 'easy-facebook-likebox' ),
                $mif_skin_html,
                __( 'Skin Image (optional)', 'easy-facebook-likebox' ),
                __( 'Please select your account to see in preview', 'easy-facebook-likebox' ),
                __( 'Want to customize the layout of Instagram feed?', 'easy-facebook-likebox' ),
                __( 'Skins allows you to totally customize the look and feel of your feed in real-time using WordPress customizer. Skin holds all the design settings like feed layout (fullwidth, Grid, etc), show hide elements, page header, and single post colors, margins and a lot of cool settings separately. Questions? <a target="_blank" href="https://easysocialfeed.com/documentation/how-to-use-skins/">See this support document.</a>', 'easy-facebook-likebox' ),
                __( 'Show All Skins', 'easy-facebook-likebox' ),
                $layout_choices,
                __( 'Layout', 'easy-facebook-likebox' )
            );
            $mif_skins_html = apply_filters( 'mif_skins_html', $mif_skins_html );
            /*
             * Our Plugins tab html.
             * mif_other_plugins_html filter can be used to customize our plugins tab html.
             */
            $mif_op_html = null;
            //echo "<pre>"; print_r($mif_op_html);exit();
            /*
             * Getting the Current URL for returing back to this page.
             * Getting the mif saved page id.
             * Getting the permalink of page.
             */
            $current_link = urlencode( (( isset( $_SERVER['HTTPS'] ) ? "https" : "http" )) . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" );
            $fta_settings = $FTA->fta_get_settings();
            $page_id = null;
            /* Getting the demo page id. */
            if ( isset( $fta_settings['plugins']['instagram']['default_page_id'] ) && !empty($fta_settings['plugins']['instagram']['default_page_id']) ) {
                $page_id = $fta_settings['plugins']['instagram']['default_page_id'];
            }
            $page_permalink = get_permalink( $page_id );
            $page_permalink = urlencode( $page_permalink );
            $final_customize_Url = admin_url( 'customize.php?url=' . $page_permalink . '&autofocus[panel]=fta_skins_panel&mif_customize=yes&return=' . $current_link . '' );
            $efbl_empty_at_class = null;
            if ( empty($fta_settings['plugins']['facebook']['access_token']) ) {
                $efbl_empty_at_class = 'fta_empty_at';
            }
            $mif_fb_link = null;
            if ( isset( $fta_settings['plugins']['facebook']['status'] ) && 'activated' == $fta_settings['plugins']['facebook']['status'] ) {
                $mif_fb_link = '<div class="mif_tabs_right">
                            <a class="" href="' . esc_url( admin_url( 'admin.php?page=easy-facebook-likebox' ) ) . '">' . __( 'Facebook', 'easy-facebook-likebox' ) . '</a>
                        </div>  ';
            }
            //echo "<pre>"; print_r($access_token);exit();
            /*
             * Base html.
             * mif_base_html filter can be used to customize base html of setting page.
             */
            $returner .= sprintf(
                '<div class="esf_loader_wrap">
                <div class="esf_loader_inner">
                <div class="loader mif_loader"></div>
                 </div>
               </div> <div class="mif_wrap z-depth-1 %11$s">     
				<div class="mif_wrap_inner">
                
					<div class="mif_loader_wrap">
					 <i class=" fa fa-spinner fa-spin"></i>
				    </div>  
				<div class="mif_tabs_holder">
					<div class="mif_tabs_header">
						<ul id="mif_tabs" class="tabs">
							<li class="tab col s3">
								<a class="active mif-general" href="#mif-general">
								<i class="material-icons dp48">settings_applications</i>
                                <span>%1$s</span>
								</a></li>

								

							<li class="tab col s3"><a class=" mif_for_disable mif-shortcode" href="#mif-shortcode">
								<i class="material-icons dp48">info_outline</i>
                                 <span>%2$s</span>
								</a>
								</li>

							<li class="tab col s3"><a class="mif_for_disable mif-skins" href="#mif-skins">
								<i class="material-icons dp48">web</i>
                                <span>%5$s</span>
								</a>
								</li>	

							<li class="tab col s3"><a class=" mif_for_disable mif-cache"  href="#mif-cache">
								<i class="material-icons dp48">cached</i>
                                 <span>%9$s</span>
								</a>
								</li>

						</ul>
					  %23$s
					</div>
					<div class="mif_tab_c_holder">
						%3$s
						%6$s
						%4$s
						%10$s
						%13$s
						%14$s
					</div>
				</div>	
				</div>	
				<!-- Popup starts<!-->
                       <div id="fta-remove-at" class="modal">
                            <div class="modal-content">
                            <span class="mif-close-modal modal-close"><i class="material-icons dp48">close</i></span>
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">error_outline</i> </span>
                                <h5>%19$s</h5>
                                <p>%20$s</p>
                                <a class="waves-effect waves-light btn modal-close" href="javascript:void(0)">%22$s</a>
                                <a class="waves-effect waves-light btn efbl_delete_at_confirmed modal-close" href="javascript:void(0)">%21$s</a>
                            </div>
                        </div>

                        </div>
                <!-- Popup ends<!-->

                <!-- Remove Skin Popup starts<!-->
					   <div id="mif-remove-skin" class="modal mif-remove-skin mif-confirm-modal">
						    <div class="modal-content">
					    	<span class="mif-close-modal modal-close"><i class="material-icons dp48">close</i></span>
					     	<div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">error_outline</i> </span>
								<h5>%19$s</h5>
								<p>%31$s</p>
								<a class="waves-effect waves-light btn modal-close" href="javascript:void(0)">%22$s</a>
								<a class="waves-effect waves-light btn mif_skin_delete modal-close" href="javascript:void(0)">%21$s</a>
					     	</div>
					    </div>

						</div>
				<!-- Remove Skin Popup ends<!--> 

                       <!-- Popup starts<!-->
                       <div id="fta-auth-error" class="modal">
                            <div class="modal-content">
                            <span class="mif-close-modal modal-close"><i class="material-icons dp48">close</i></span>
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">error_outline</i> </span>
                                <p>%15$s</p>
                                
                                <a class="waves-effect waves-light efbl_authentication_btn btn" href="%16$s"><i class="material-icons right">camera_enhance</i>%17$s</a>
                            </div>
                        </div>

                        </div>
                <!-- Popup ends<!-->    

                 <!-- Masonry Layout Modal Structure -->
                      <div id="mif-free-masonry-upgrade" class="fta-upgrade-modal modal">
                         <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%24$s</h5>
                                <p>%26$s</p>
                                <p>%27$s</p>
                                <hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%25$s</a>
                                  
                            </div>
                        </div>
                       
                      </div> 

                <!-- Masonry Layout Structure Ends--> 

                 <!-- carousel Layout Modal Structure -->
                      <div id="mif-free-carousel-upgrade" class="fta-upgrade-modal modal">
                         <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%24$s</h5>
                                <p>%28$s</p>
                                <p>%27$s</p>
                                <hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%25$s</a>
                                  
                            </div>
                        </div>
                       
                      </div> 

                <!-- carousel Layout Structure Ends--> 

                 <!-- half_width Layout Modal Structure -->
                      <div id="mif-free-half_width-upgrade" class="fta-upgrade-modal modal">
                         <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%24$s</h5>
                                <p>%29$s</p>
                                <p>%27$s</p>
                                <hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%25$s</a>
                                  
                            </div>
                        </div>
                       
                      </div> 

                <!-- half_width Layout Structure Ends--> 

                 <!-- full_width Layout Modal Structure -->
                      <div id="mif-free-full_width-upgrade" class="fta-upgrade-modal modal">
                         <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%24$s</h5>
                                <p>%30$s</p>
                                <p>%27$s</p>
                                <hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%25$s</a>
                                  
                            </div>
                        </div>
                       
                      </div> 

                <!-- full_width Layout Structure Ends--> 

			</div>',
                /* Variables starts here. */
                __( 'Authentication', 'easy-facebook-likebox' ),
                __( 'How to use?', 'easy-facebook-likebox' ),
                $mif_general_html,
                $mif_shortcode_html,
                __( 'Customize (skins)', 'easy-facebook-likebox' ),
                $mif_skins_html,
                __( 'Attention!', 'easy-facebook-likebox' ),
                __( 'It looks like you have not connected your Facebook page with plugin yet. Please click on the “Connect My Facebook Pages” button to get the access token from Facebook and then go with the flow.', 'easy-facebook-likebox' ),
                __( 'Clear Cache', 'easy-facebook-likebox' ),
                $mif_cache_html,
                $efbl_empty_at_class,
                __( 'Help', 'easy-facebook-likebox' ),
                $mif_help_html = null,
                $mif_op_html,
                __( "Sorry, Plugin is unable to get the accounts data. Please delete the access token and select accounts in the second step of authentication to give the permission.", 'easy-facebook-likebox' ),
                'https://www.facebook.com/dialog/oauth?client_id=' . $u_app_ID . '&redirect_uri=https://maltathemes.com/efbl/app-' . $u_app_ID . '/index.php&scope=manage_pages,instagram_basic&state=' . admin_url( 'admin.php?page=mif' ) . '',
                __( 'Connect My Instagram Account', 'easy-facebook-likebox' ),
                __( 'Other Plugins', 'easy-facebook-likebox' ),
                __( 'Are you sure?', 'easy-facebook-likebox' ),
                __( "Do you really want to delete the access token? It will delete all the pages data, access tokens and premissions given to the app.", 'easy-facebook-likebox' ),
                __( 'Delete', 'easy-facebook-likebox' ),
                __( 'Cancel', 'easy-facebook-likebox' ),
                $mif_fb_link,
                __( 'Premium Feature', 'easy-facebook-likebox' ),
                __( 'Upgrade to pro', 'easy-facebook-likebox' ),
                __( "We're sorry, Masonry layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/my-instagram-feed-demo/masonary>Check out the demo</a>", 'easy-facebook-likebox' ),
                __( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?" and enter <code>espf10</code>', 'easy-facebook-likebox' ),
                __( "We're sorry, Carousel layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/my-instagram-feed-demo/carousel>Check out the demo</a>", 'easy-facebook-likebox' ),
                __( "We're sorry, Half Width layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/my-instagram-feed-demo/blog-layout>Check out the demo</a>", 'easy-facebook-likebox' ),
                __( "We're sorry, Full Width layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/my-instagram-feed-demo/full-width>Check out the demo</a>", 'easy-facebook-likebox' ),
                __( "Do you really want to delete the skin? It will delete all the settings values of the skin.", 'easy-facebook-likebox' )
            );
            if ( efl_fs()->is_free_plan() ) {
                $returner .= '<div class="espf-upgrade">
                <h2>' . __( 'Easy Social Feed <b>Pro</b>', 'easy-facebook-likebox' ) . '</h2>
                 <p>' . __( 'Unlock all premium features such as Advanced PopUp, More Fancy Layouts, Post filters like events, images, videos, and albums, gallery in the PopUp and above all top notch priority support.', 'easy-facebook-likebox' ) . '</p>
                  <p>' . __( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?" and enter <code>espf10</code>', 'easy-facebook-likebox' ) . '</p>
                   <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>' . __( 'Upgrade To Pro', 'easy-facebook-likebox' ) . '</a>
                 </div>';
            }
            $returner = apply_filters( 'mif_base_html', $returner );
            echo  $returner ;
        }
        
        /* mif_supported_func Method ends here. */
        /*
         * mif_create_skin on ajax.
         * Returns the customizer URL with skin ID. 
         * Create the skin for instagram feeds 
         */
        function mif_create_skin()
        {
            $FTA = new Feed_Them_All();
            /* Getting the form data. */
            $form_data = $_POST['form_data'];
            /* Getting the form data in strings. */
            parse_str( $form_data );
            /* Initalizing layout array. */
            $layout = array();
            /* Adding layout value to the array. */
            $layout['layout_option'] = sanitize_text_field( $mif_selected_layout );
            /* Arguments for default skin. */
            $xo_new_skins = array(
                'post_title'   => sanitize_text_field( $mif_skin_title ),
                'post_content' => sanitize_text_field( $mif_skin_description ),
                'post_type'    => 'mif_skins',
                'post_status'  => 'publish',
                'post_author'  => get_current_user_id(),
            );
            if ( wp_verify_nonce( $_POST['mif_nonce'], 'mif-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    $skin_id = wp_insert_post( $xo_new_skins );
                }
            }
            /* If skin is created successfully. */
            
            if ( isset( $skin_id ) ) {
                update_option( 'mif_skin_' . $skin_id, $layout );
                $thumbnail_id = $this->mif_get_image_id( $mif_skin_feat_img );
                set_post_thumbnail( $skin_id, $thumbnail_id );
                /* Getting the demo page id. */
                $fta_settings = $FTA->fta_get_settings();
                $page_id = $fta_settings['plugins']['instagram']['default_page_id'];
                /* Getting permalink from ID. */
                $page_permalink = get_permalink( $page_id );
                $customizer_url = 'customize.php';
                /* If permalink got successfully */
                if ( isset( $page_permalink ) ) {
                    /* Include permalinks for making*/
                    $customizer_url = add_query_arg( array(
                        'url'              => urlencode( $page_permalink ),
                        'autofocus[panel]' => 'mif_skins_panel',
                        'mif_skin_id'      => $skin_id,
                        'mif_customize'    => 'yes',
                        'mif_account_id'   => $mif_selected_account,
                    ), $customizer_url );
                }
                /* if condition ends here*/
                /* Sending back the values. */
                echo  wp_send_json_success( admin_url( $customizer_url ) ) ;
                die;
            } else {
                echo  wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) ) ;
                die;
            }
            
            exit;
        }
        
        /* mif_create_skin Method ends here. */
        /*
         * mif_delete_skin on ajax.
         * Returns the Success or Error Message. 
         * Delete the skin
         */
        function mif_delete_skin()
        {
            /* Getting the skin ID. */
            $skin_id = intval( $_POST['skin_id'] );
            if ( wp_verify_nonce( $_POST['mif_nonce'], 'mif-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    $skin_deleted = wp_delete_post( $skin_id, true );
                }
            }
            /* If skin is deleted successfully. */
            
            if ( isset( $skin_deleted ) ) {
                $returned_arr = array( __( 'Skin is successfully deleted.', 'easy-facebook-likebox' ), $skin_id );
                /* Sending back the values. */
                echo  wp_send_json_success( $returned_arr ) ;
                die;
            } else {
                echo  wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) ) ;
                die;
            }
            
            exit;
        }
        
        /*
         * mif_create_skin_url on ajax.
         * Returns the URL. 
         */
        function mif_create_skin_url()
        {
            /* Getting the skin ID. */
            $skin_id = intval( $_POST['skin_id'] );
            $selectedVal = intval( $_POST['selectedVal'] );
            $page_id = intval( $_POST['page_id'] );
            $page_permalink = get_permalink( $page_id );
            
            if ( wp_verify_nonce( $_POST['mif_nonce'], 'mif-ajax-nonce' ) ) {
                $customizer_url = admin_url( 'customize.php' );
                /* If permalink got successfully */
                if ( isset( $page_permalink ) ) {
                    /* Include permalinks for making*/
                    $customizer_url = add_query_arg( array(
                        'url'              => urlencode( $page_permalink ),
                        'autofocus[panel]' => 'mif_skins_panel',
                        'mif_skin_id'      => $skin_id,
                        'mif_customize'    => 'yes',
                        'mif_account_id'   => $selectedVal,
                    ), $customizer_url );
                }
                // echo  wp_send_json_error( $customizer_url ) ; die;
                echo  wp_send_json_success( array( __( 'Please wait! We are generating preview for you.', 'easy-facebook-likebox' ), $customizer_url ) ) ;
                die;
            } else {
                echo  wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) ) ;
                die;
            }
        
        }
        
        /* mif_create_skin Method ends here. */
        /*
         * mif_delete_transient on ajax.
         * Returns the Success or Error Message. 
         * Delete the transient
         */
        function mif_delete_transient()
        {
            /* Getting the skin ID. */
            $transient_id = sanitize_text_field( $_POST['transient_id'] );
            $replaced_value = str_replace( '_transient_', '', $transient_id );
            if ( wp_verify_nonce( $_POST['mif_nonce'], 'mif-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    $mif_deleted_trans = delete_transient( $replaced_value );
                }
            }
            /* If skin is deleted successfully. */
            
            if ( isset( $mif_deleted_trans ) ) {
                $returned_arr = array( __( 'Cache is successfully deleted.', 'easy-facebook-likebox' ), $transient_id );
                /* Sending back the values. */
                echo  wp_send_json_success( $returned_arr ) ;
                die;
            } else {
                echo  wp_send_json_error( __( 'Something Went Wrong! Please try again.', 'easy-facebook-likebox' ) ) ;
                die;
            }
            
            exit;
        }
        
        /* mif_delete_transient Method ends here. */
        /* mif_disable_app_notification__premium_only Method ends here. */
        /* retrieves the attachment ID from the file URL */
        function mif_get_image_id( $image_url )
        {
            /* Getting the global wpdb */
            global  $wpdb ;
            /* Getting attachment ID from custom query */
            $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $image_url ) );
            /* Returning back the attachment ID */
            return $attachment[0];
        }
        
        /* mif_get_image_id Method ends here. */
        /*
         * It will get the remote URL, Retreive it and return decoded data.
         */
        public function mif_get_data( $url )
        {
            /*
             * Getting the data from remote URL.
             */
            $json_data = wp_remote_retrieve_body( wp_remote_get( $url ) );
            /*
             * Decoding the data.
             */
            $decoded_data = json_decode( $json_data );
            /*
             * Returning it to back.
             */
            return $decoded_data;
        }
        
        /* mif_mif_get_data method ends here. */
        /*
         * Will return All Transients collection.
         */
        public function mif_transients()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $mif_auth_accounts = array();
            $trans_name = null;
            $returner = null;
            /*
             * Getting saved access token.
             */
            if ( isset( $fta_settings['plugins']['instagram']['access_token'] ) ) {
                $access_token = $fta_settings['plugins']['instagram']['access_token'];
            }
            /*
             * Initializing global wpdb varibale.
             */
            global  $wpdb ;
            /*
             * Custom Query for getting all transients from wp
             */
            $mif_trans_sql = "SELECT `option_name` AS `name`, `option_value` AS `value`\r\n\t\t            FROM  {$wpdb->options}\r\n\t\t            WHERE `option_name` LIKE '%transient_%'\r\n\t\t            ORDER BY `option_name`";
            /*
             * Getting results of the cahche.
             */
            $mif_trans_results = $wpdb->get_results( $mif_trans_sql );
            /*
             * Initializing empty array for mif transients.
             */
            $mif_trans_posts = array();
            /*
             * Initializing empty array for mif bio transients.
             */
            $mif_trans_bio = array();
            /*
             * Looping thorugh transients if got any results.
             */
            if ( $mif_trans_results ) {
                foreach ( $mif_trans_results as $mif_trans_result ) {
                    /*
                     * Checking Mif exists in transient slug then save that in mif transient array.
                     */
                    if ( strpos( $mif_trans_result->name, 'mif' ) !== false && strpos( $mif_trans_result->name, 'posts' ) !== false && strpos( $mif_trans_result->name, 'timeout' ) == false ) {
                        $mif_trans_posts[$mif_trans_result->name] = $mif_trans_result->value;
                    }
                    /*
                     * Checking Mif exists in transient slug then save that in mif transient array.
                     */
                    if ( strpos( $mif_trans_result->name, 'mif' ) !== false && strpos( $mif_trans_result->name, 'bio' ) !== false && strpos( $mif_trans_result->name, 'timeout' ) == false ) {
                        $mif_trans_bio[$mif_trans_result->name] = $mif_trans_result->value;
                    }
                }
            }
            /*
             * Bio Cached.
             */
            
            if ( $mif_trans_bio ) {
                $returner .= '<ul class="collection with-header mif_bio_collection">
						<li class="collection-header"><h5>' . __( 'Profile Data', 'easy-facebook-likebox' ) . '</h5></li>';
                foreach ( $mif_trans_bio as $key => $value ) {
                    $pieces = explode( '-', $key );
                    $trans_name = array_pop( $pieces );
                    // if(isset($fta_settings['plugins']['instagram']['authenticated_accounts']))
                    // $mif_auth_accounts = $fta_settings['plugins']['instagram']['authenticated_accounts'];
                    // $trans_name = $mif_auth_accounts[$trans_name]['username'];
                    $returner .= '<li class="collection-item ' . $key . '">
		    							<div>' . $trans_name . '
		    							<a href="javascript:void(0);" data-mif_collection="mif_bio_collection" data-mif_trans="' . $key . '" class="secondary-content mif_del_trans"><i class="material-icons">delete</i></a>
		    							</div>
		    						</li>';
                }
                $returner .= '</ul>';
            }
            
            /*
             * Posts Cached.
             */
            
            if ( $mif_trans_posts ) {
                $returner .= '<ul class="collection with-header mif_users_collection">
						<li class="collection-header"><h5>' . __( 'Profile Feeds', 'easy-facebook-likebox' ) . '</h5></li>';
                foreach ( $mif_trans_posts as $key => $value ) {
                    $pieces = explode( '-', $key );
                    $trans_name = array_pop( $pieces );
                    $trans_name = $pieces['1'];
                    // echo "<pre>"; print_r($pieces);exit();
                    // if(isset($fta_settings['plugins']['instagram']['authenticated_accounts']))
                    // $mif_auth_accounts = $fta_settings['plugins']['instagram']['authenticated_accounts'];
                    // $trans_name = $mif_auth_accounts[$trans_name]['username'];
                    $returner .= '<li class="collection-item ' . $key . '">
		    							<div>' . $trans_name . '
		    							<a href="javascript:void(0);" data-mif_collection="mif_users_collection" data-mif_trans="' . $key . '" class="secondary-content mif_del_trans"><i class="material-icons">delete</i></a>
		    							</div>
		    						</li>';
                }
                $returner .= '</ul>';
            }
            
            if ( empty($mif_trans_posts) && empty($mif_trans_bio) ) {
                $returner = '<h4>' . __( 'Nothing Found!', 'mif' ) . '</h4> <p>' . __( 'Nothing cached at the moment.Feeds will be automatically after showing the feeds on frontend.', 'easy-facebook-likebox' ) . '</p>';
            }
            /*
             * Returning it to back.
             */
            return $returner;
        }
        
        /* mif_transients method ends here. */
        /*
         *  Return the user ID from access token.
         */
        public function mif_get_user_id( $access_token )
        {
            $access_token_exploded = explode( ".", $access_token );
            /*
             * Getting saved user id.
             */
            return $access_token_exploded['0'];
        }
        
        /* mif_get_bio method ends here. */
        /*
         *  Return the user name from access token.
         */
        public function mif_get_user_name( $access_token )
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            /*
             *  Getting the authenticated accounts.
             */
            $authenticated_accounts = $fta_settings['plugins']['instagram']['authenticated_accounts'];
            /*
             *  Getting the user_id from access token.
             */
            $mif_user_id = $this->mif_get_user_id( $access_token );
            /*
             * Returning the user name.
             */
            return $authenticated_accounts[$mif_user_id]['username'];
        }
        
        /* mif_get_user_name method ends here. */
        function mif_head()
        {
            echo  "<script>function MIFremoveURLParameter(url, parameter) {\r\n    //prefer to use l.search if you have a location/link object\r\n    var urlparts= url.split('?');   \r\n    if (urlparts.length>=2) {\r\n\r\n        var prefix= encodeURIComponent(parameter)+'=';\r\n        var pars= urlparts[1].split(/[&;]/g);\r\n\r\n        //reverse iteration as may be destructive\r\n        for (var i= pars.length; i-- > 0;) {    \r\n            //idiom for string.startsWith\r\n            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  \r\n                pars.splice(i, 1);\r\n            }\r\n        }\r\n\r\n        url= urlparts[0]+'?'+pars.join('&');\r\n        return url;\r\n    } else {\r\n        return url;\r\n    }\r\n} </script>" ;
        }
    
    }
    /* MIF_Admin Class ends here. */
    $MIF_Admin = new MIF_Admin();
}
