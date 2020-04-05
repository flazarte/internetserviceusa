<?php

/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//======================================================================
// Code for the admin funcionality of Easy Facebook Likebox
//======================================================================

if ( !class_exists( 'Easy_Facebook_Likebox_Admin' ) ) {
    class Easy_Facebook_Likebox_Admin
    {
        /* Intitializing $adminurl .*/
        var  $adminurl ;
        var  $plugin_slug = 'easy-facebook-likebox' ;
        /**
         * Initialize the plugin by loading admin scripts & styles and adding a
         * settings page and menu.
         *
         * @since     1.0.0
         */
        function __construct()
        {
            /*
             * admin_menu hooks fires on wp admin load.
             * Add the menu page in wp admin area.
             */
            add_action( 'admin_menu', array( $this, 'efbl_menu' ) );
            add_action( 'admin_footer', array( $this, 'efbl_footer' ) );
            /*
             * admin_enqueue_scripts hooks fires for enqueing custom script and styles.
             * Css file will be include in admin area.
             */
            add_action( 'admin_enqueue_scripts', array( $this, 'efbl_admin_style' ) );
            /*
             * efbl_save_efbl_enable_popup hooks fires on Ajax call.
             * efbl_save_efbl_enable_popup method will be call when the popup values been updated.
             */
            add_action( 'wp_ajax_efbl_save_popup_settings', array( $this, 'efbl_save_popup_settings_cb' ) );
            /*
             * efbl_create_skin hooks fires on Ajax call.
             * efbl_create_skin method will be call when the create new skin is form submitted.
             */
            add_action( 'wp_ajax_efbl_create_skin', array( $this, 'efbl_create_skin' ) );
            /*
             * efbl_create_skin hooks fires on Ajax call.
             * efbl_create_skin method will be call when the create new skin is form submitted.
             */
            add_action( 'wp_ajax_efbl_create_skin_url', array( $this, 'efbl_create_skin_url' ) );
            /*
             * efbl_delete_skin hooks fires on Ajax call.
             * efbl_delete_skin method will be call when the create new skin is form submitted.
             */
            add_action( 'wp_ajax_efbl_delete_skin', array( $this, 'efbl_delete_skin' ) );
            /*
             * efbl_del_trans hooks fires on Ajax call.
             * efbl_del_trans method will be call when the cache is being delted.
             */
            add_action( 'wp_ajax_efbl_del_trans', array( $this, 'efbl_del_trans_cb' ) );
        }
        
        /*
         * efbl_admin_style will enqueue style and js files.
         * Returns hook name of the current page in admin.
         * $hook will contain the hook name.
         */
        public function efbl_admin_style( $hook )
        {
            /*
             * Following files should load only on efbl page in backend.
             */
            if ( 'easy-social-feed_page_easy-facebook-likebox' !== $hook ) {
                return;
            }
            /*
             * Enqueing custom stylesheet for styling.
             */
            wp_enqueue_style( $this->plugin_slug . '-admin-styles', EFBL_PLUGIN_URL . 'admin/assets/css/admin.css', array() );
            /*
             * Custom scripts file for admin area.
             */
            wp_enqueue_script( $this->plugin_slug . '-admin-script', EFBL_PLUGIN_URL . 'admin/assets/js/admin.js', array( 'jquery', 'materialize.min' ) );
            // echo "<pre>";
            // print_r(admin_url('admin-ajax.php'));exit();
            /*
             * Getting Main Class
             */
            $FTA = new Feed_Them_All();
            /*
             * Getting All Settings
             */
            $fta_settings = $FTA->fta_get_settings();
            $default_skin_id = $fta_settings['plugins']['facebook']['default_skin_id'];
            $efbl_ver = 'free';
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $efbl_ver = 'pro';
            }
            /*
             * Localizing script to get admin-ajax url dynamically.
             */
            wp_localize_script( $this->plugin_slug . '-admin-script', 'efbl', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'nonce'           => wp_create_nonce( 'efbl-ajax-nonce' ),
                'version'         => $efbl_ver,
                'default_skin_id' => $default_skin_id,
            ) );
            wp_enqueue_script( 'media-upload' );
            wp_enqueue_media();
        }
        
        /*
         * efbl_menu will add admin page.
         * Returns nothing.
         */
        public function efbl_menu()
        {
            /*
             * Adding Facebook Sub menu.
             */
            add_submenu_page(
                'feed-them-all',
                __( 'Facebook', 'easy-facebook-likebox' ),
                __( 'Facebook', 'easy-facebook-likebox' ),
                'manage_options',
                'easy-facebook-likebox',
                array( $this, 'efbl_page' )
            );
        }
        
        /* efbl_menu Method ends here. */
        /*
         * efbl_page will holds admin page HTML.
         */
        public function efbl_page()
        {
            /*
             * Getting main class
             */
            $FTA = new Feed_Them_All();
            /*
             * Getting Settings
             */
            $fta_settings = $FTA->fta_get_settings();
            /*
             * $returner variable will contain all html.
             * $returner defines empty at start to avoid junk values.
             */
            $returner = null;
            /*
             * EFBL admin page  URL.
             */
            $this->adminurl = admin_url( 'admin.php?page=easy-facebook-likebox' );
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
            $efbl_empty_at_class = null;
            $efbl_insta_link = null;
            if ( isset( $fta_settings['plugins']['instagram']['status'] ) && 'activated' == $fta_settings['plugins']['instagram']['status'] ) {
                $efbl_insta_link = '<div class="efbl_tabs_right">
							<a class="" href="' . esc_url( admin_url( 'admin.php?page=mif' ) ) . '">' . __( 'Instagram', 'easy-facebook-likebox' ) . '</a>
						</div>	';
            }
            // echo'<pre>'; print_r($fta_settings['plugins']['instagram']['status']);exit();
            if ( empty($fta_settings['plugins']['facebook']['access_token']) ) {
                $efbl_empty_at_class = 'fta_empty_at';
            }
            /*
             * Base html.
             * efbl_base_html filter can be used to customize base html of setting page.
             */
            $returner .= sprintf(
                '<div class="esf_loader_wrap">
                <div class="esf_loader_inner">
                <div class="loader efbl_loader"></div>
                 </div>
               </div><div class="efbl_wrap z-depth-1 %15$s">
				<div class="efbl_wrap_inner">
					
				<div class="efbl_tabs_holder">
					<div class="efbl_tabs_header">
						<ul id="efbl_tabs" class="tabs">
							%1$s	
						</ul>
						%26$s
					</div>
					<div class="efbl_tab_c_holder">
						%2$s
						%3$s
						%4$s
						%5$s
						%6$s
					</div>
				</div>	
				</div>	
					</div>  

				<!-- Popup starts<!-->
					   <div id="fta-auth-error" class="modal">
						    <div class="modal-content">
					    	<span class="mif-close-modal modal-close"><i class="material-icons dp48">close</i></span>
					     	<div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">error_outline</i> </span>
								<p>%9$s</p>
								
								<a class="waves-effect waves-light efbl_authentication_btn btn" href="%7$s"><img class="efb_icon left" src="' . EFBL_PLUGIN_URL . '/admin/assets/images/facebook-icon.png"/>%8$s</a>
								
					     	</div>
					    </div>

						</div>
				<!-- Popup ends<!-->

					<!-- Popup starts<!-->
					   <div id="fta-remove-at" class="modal">
						    <div class="modal-content">
					    	<span class="mif-close-modal modal-close"><i class="material-icons dp48">close</i></span>
					     	<div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">error_outline</i> </span>
								<h5>%16$s</h5>
								<p>%17$s</p>
								<a class="waves-effect waves-light btn modal-close" href="javascript:void(0)">%19$s</a>
								<a class="waves-effect waves-light btn efbl_delete_at_confirmed modal-close" href="javascript:void(0)">%18$s</a>
					     	</div>
					    </div>

						</div>
				<!-- Popup ends<!-->	

				<!-- Remove Skin Popup starts<!-->
					   <div id="efbl-remove-skin" class="modal efbl-remove-skin efbl-confirm-modal">
						    <div class="modal-content">
					    	<span class="mif-close-modal modal-close"><i class="material-icons dp48">close</i></span>
					     	<div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">error_outline</i> </span>
								<h5>%16$s</h5>
								<p>%29$s</p>
								<a class="waves-effect waves-light btn modal-close" href="javascript:void(0)">%19$s</a>
								<a class="waves-effect waves-light btn efbl_skin_delete modal-close" href="javascript:void(0)">%18$s</a>
					     	</div>
					    </div>

						</div>
				<!-- Remove Skin Popup ends<!-->	

				<!-- Filter Modal Structure -->
					  <div id="efbl-filter-upgrade" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%12$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Filter Modal Structure Ends--> 

					 <!-- Grid Layout Modal Structure -->
					  <div id="efbl-free-grid-upgrade" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%27$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Grid Layout Structure Ends--> 

					 <!-- Grid Layout Modal Structure -->
					  <div id="efbl-free-masonry-upgrade" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%28$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Grid Layout Structure Ends--> 

					 <!-- Carousel Layout Modal Structure -->
					  <div id="efbl-free-carousel-upgrade" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%30$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Carousel Layout Structure Ends--> 

					 <!-- Other page Modal Structure -->
					  <div id="efbl-other-pages-upgrade" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%20$s</p>
                                <p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Other page Modal Structure Ends--> 

					 <!-- Tabs Modal Structure -->
					  <div id="efbl-tabs-upgrade" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%24$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Filter Tabs Structure Ends--> 

					  <!-- Select pages Modal Structure -->
					  <div id="efbl-pages-enable" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%21$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Select pages Structure Ends--> 

					  <!-- Select posts Structure -->
					  <div id="efbl-posts-enable" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%22$s</p>
                       			<p>%25$s</p>
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- Select posts Structure Ends--> 

					  <!-- exit intent  Structure -->
					  <div id="efbl-exit-intent" class="fta-upgrade-modal modal">
					     <div class="modal-content">
                           
                            <div class="mif-modal-content"> <span class="mif-lock-icon"><i class="material-icons dp48">lock_outline</i> </span>
                                <h5>%10$s</h5>
                                <p>%23$s</p>
                       			<p>%25$s</p>	
                       			<hr />
                                 <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>%11$s</a>
                                  
                            </div>
                        </div>
					   
					  </div> 

					 <!-- exit intent  Structure Ends--> 
			',
                /* Variables starts here. */
                $this->efbl_settings_menu(),
                $this->efbl_authentication_tab(),
                $this->efbl_general_tab(),
                $this->efbl_popup_tab(),
                $this->efbl_skins_html(),
                $this->efbl_cached_html(),
                'https://www.facebook.com/dialog/oauth?client_id=' . $u_app_ID . '&redirect_uri=https://maltathemes.com/efbl/app-' . $u_app_ID . '/index.php&scope=manage_pages,instagram_basic&state=' . admin_url( 'admin.php?page=easy-facebook-likebox' ) . '',
                __( 'Connect My Facebook Pages', 'easy-facebook-likebox' ),
                __( "Sorry, Plugin is unable to get the pages data. Please delete the access token and select pages in the second step of authentication to give the permission.", 'easy-facebook-likebox' ),
                __( 'Premium Feature', 'easy-facebook-likebox' ),
                __( 'Upgrade to pro', 'easy-facebook-likebox' ),
                __( "We're sorry, posts filter is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/custom-facebook-feed/ >Check out the demo</a>", 'easy-facebook-likebox' ),
                __( 'Attention!', 'easy-facebook-likebox' ),
                __( 'It looks like you have not connected your Facebook page with plugin yet. Please click on the “Connect My Facebook Pages” button to get the access token from Facebook and then go with the flow.', 'easy-facebook-likebox' ),
                $efbl_empty_at_class,
                __( 'Are you sure?', 'easy-facebook-likebox' ),
                __( "Do you really want to delete the access token? It will delete all the pages data, access tokens and premissions given to the app.", 'easy-facebook-likebox' ),
                __( 'Delete', 'easy-facebook-likebox' ),
                __( 'Cancel', 'easy-facebook-likebox' ),
                __( "We're sorry, ability to display posts from other pages not managed by you is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ),
                __( "We are sorry showing popup on specific pages feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ),
                __( "We are sorry showing popup on specific posts feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ),
                __( "We are sorry showing popup on exit intent feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ),
                __( "We are sorry showing tabs in likebox feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ),
                __( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?" and enter <code>espf10</code>', 'easy-facebook-likebox' ),
                $efbl_insta_link,
                __( "We are sorry grid layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/custom-facebook-feed/grid>Check out the demo</a>", 'easy-facebook-likebox' ),
                __( "We are sorry masonry layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/custom-facebook-feed/masonry>Check out the demo</a>", 'easy-facebook-likebox' ),
                __( "Do you really want to delete the skin? It will delete all the settings values of the skin.", 'easy-facebook-likebox' ),
                __( "We are sorry carousel layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features. <a target=_blank href=https://easysocialfeed.com/custom-facebook-feed/carousel>Check out the demo</a>", 'easy-facebook-likebox' )
            );
            if ( efl_fs()->is_free_plan() ) {
                $returner .= '<div class="espf-upgrade">
                <h2>' . __( 'Easy Social Feed <b>Pro</b>', 'easy-facebook-likebox' ) . '</h2>
                 <p>' . __( 'Unlock all premium features such as Advanced PopUp, More Fancy Layouts, Post filters like events, images, videos, and albums, the gallery in the PopUp and much more.', 'easy-facebook-likebox' ) . '</p>
                  <p>' . __( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?" and enter <code>espf10</code>', 'easy-facebook-likebox' ) . '</p>
                   <a href="' . efl_fs()->get_upgrade_url() . '" class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i>' . __( 'Upgrade To Pro', 'easy-facebook-likebox' ) . '</a>
                 </div>';
            }
            // echo "<pre>"; print_r($returner);exit();
            echo  apply_filters( 'efbl_base_html', $returner ) ;
        }
        
        /* efbl_page Method ends here. */
        /*
         * Holds Html For Authentication Tab.
         *
         */
        function efbl_authentication_tab()
        {
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
						
						url = EFBLremoveURLParameter(url, "access_token");

						jQuery("#efbl_access_token").text("' . $access_token . '");

				       var data={\'action\':\'efbl_save_access_token\',
				       			\'access_token\':\'' . $access_token . '\',
				       			\'id\' : \'fb\'
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

				            	
				            	Materialize.toast(response.data["0"], 3000);
				            	jQuery("#toast-container").addClass("efbl_green");
				            	jQuery(".efbl_all_pages").html(" ").html(response.data["1"]).slideDown("slow");
				            	jQuery(".fta_noti_holder").fadeOut("slow");

				            	setTimeout(function(){ 
					            	var fta_full_url  = fta.fb_url+"#efbl-general"; 
									window.location.href = "#efbl-general";
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
            
            /*
             * Getting Main Class
             */
            $FTA = new Feed_Them_All();
            /*
             * Getting All Settings
             */
            $fta_settings = $FTA->fta_get_settings();
            $efbl_ap_class = null;
            $efbl_all_pages_html = null;
            /*
             * If approved pages exists show them
             */
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                $efbl_all_pages_html = '<ul class="collection with-header"> <li class="collection-header"><h5>' . __( 'Approved Pages', 'easy-facebook-likebox' ) . '</h5>

			 <a href="#fta-remove-at" class="modal-trigger fta-remove-at-btn tooltipped" data-position="left" data-delay="50" data-tooltip="' . __( 'Delete Access Token', 'easy-facebook-likebox' ) . '"><i class="material-icons">delete_forever</i></a>
 		 </li>';
                $efbl_ap_class = 'show';
                foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
                    
                    if ( isset( $efbl_page['username'] ) ) {
                        $efbl_username = $efbl_page['username'];
                        $efbl_username_label = __( 'Username:', 'easy-facebook-likebox' );
                    } else {
                        $efbl_username = $efbl_page['id'];
                        $efbl_username_label = __( 'ID:', 'easy-facebook-likebox' );
                    }
                    
                    $page_logo_trasneint_name = "esf_logo_" . $efbl_page['id'];
                    $auth_img_src = get_transient( $page_logo_trasneint_name );
                    
                    if ( !$auth_img_src || '' == $auth_img_src ) {
                        //Get the image suource of author
                        $auth_img_src = 'https://graph.facebook.com/' . $efbl_page['id'] . '/picture?type=large&redirect=0&access_token=' . $efbl_page['access_token'];
                        if ( $auth_img_src ) {
                            $auth_img_src = json_decode( jws_fetchUrl( $auth_img_src ) );
                        }
                        if ( $auth_img_src->data->url ) {
                            $auth_img_src = $auth_img_src->data->url;
                        }
                        //Store in a transient for 6 months
                        $auth_img_src = set_transient( $page_logo_trasneint_name, $auth_img_src, 180 * 60 * 60 * 24 );
                    }
                    
                    $efbl_all_pages_html .= sprintf(
                        '<li class="collection-item avatar li-' . $efbl_page['id'] . '">
		    					<a href="https://web.facebook.com/' . $efbl_page['id'] . '" target="_blank">
						      <img src="%2$s" alt="" class="circle">
						      </a>
						      <span class="title">%1$s</span>
						      <p>%3$s <br> %5$s %4$s <i class="material-icons efbl_copy_id tooltipped" data-position="right" data-clipboard-text="%4$s" data-delay="100" data-tooltip="%6$s">content_copy</i></p>

						    </li>',
                        $efbl_page['name'],
                        $auth_img_src,
                        $efbl_page['category'],
                        $efbl_username,
                        $efbl_username_label,
                        __( 'Copy', 'easy-facebook-likebox' )
                    );
                }
                $efbl_all_pages_html .= '</ul>';
            }
            
            // echo "<pre>"; print_r($fta_settings);exit();
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
            /*
             * Authentication tab html.
             * efbl_authentication_tab filter can be used to customize general tab html.
             */
            $efbl_authentication_tab = null;
            $efbl_authentication_tab .= sprintf(
                '<div id="efbl-authentication" class="col efbl_tab_c s12 slideLeft %6$s">
						<h5>%1$s</h5>
						<p>%2$s</p>
						<a class="waves-effect waves-light efbl_authentication_btn btn" href="%4$s"><img class="efb_icon left" src="' . EFBL_PLUGIN_URL . '/admin/assets/images/facebook-icon.png"/>%3$s</a>

					     <div class="row auth-row">
					     	<div class="efbl_all_pages col s12 %6$s">
					     		%5$s
					     	</div>
					     </div>

					<p>%7$s</p>
					  
				</div>',
                /* Variables starts here. */
                __( "Let's connect your Facebook page(s) with the plugin.", 'easy-facebook-likebox' ),
                __( 'Click the button below, log into your Facebook account and authorize the app to get access token.', 'easy-facebook-likebox' ),
                __( 'Connect My Facebook Pages', 'easy-facebook-likebox' ),
                'https://www.facebook.com/dialog/oauth?client_id=' . $u_app_ID . '&redirect_uri=https://maltathemes.com/efbl/app-' . $u_app_ID . '/index.php&scope=manage_pages,instagram_basic&state=' . admin_url( 'admin.php?page=easy-facebook-likebox' ) . '',
                $efbl_all_pages_html,
                $efbl_ap_class,
                __( "Please note: This does not give us permission to manage your Facebook pages, it simply allows the plugin to see a list of the pages you manage and retrieve an Access Token.", 'easy-facebook-likebox' )
            );
            return apply_filters( 'efbl_authentication_tab', $efbl_authentication_tab );
        }
        
        /* efbl_authentication_tab Method ends here. */
        /*
         * Holds Html For general Tab.
         *
         */
        function efbl_general_tab()
        {
            global  $efbl_skins ;
            /*
             * Getting Main Class
             */
            $FTA = new Feed_Them_All();
            /*
             * Getting All Settings
             */
            $fta_settings = $FTA->fta_get_settings();
            $efbl_pages_select = null;
            $efbl_page_options = null;
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
                    $efbl_page_options .= '<option value="' . $efbl_page['id'] . '" data-icon="https://graph.facebook.com/' . $efbl_page['id'] . '/picture">' . $efbl_page['name'] . '</option>';
                }
            } else {
                $efbl_page_options = '<option value="" disabled selected>' . __( 'No page found, Please connect your Facebook page with plugin first from authentication tab', 'easy-facebook-likebox' ) . '</option>';
            }
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                $all_pages = $fta_settings['plugins']['facebook']['approved_pages'];
            }
            $first_el = null;
            if ( isset( $all_pages ) && !empty($all_pages) ) {
                $first_el = reset( $all_pages );
            }
            $default_page_id = $first_el['id'];
            $default_skin_id = $fta_settings['plugins']['facebook']['default_skin_id'];
            // echo "<pre>"; print_r();exit();
            $efbl_premium_filter = null;
            $efbl_premium_filter = '<div class="col s6 efbl_fields">
        <a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_filter_posts_info">?</a>
        <input name="" class="modal-trigger" href="#efbl-filter-upgrade" type="checkbox" required value="efbl_free_filter" id="efbl_free_filter" />
										      <label for="efbl_free_filter">' . __( 'Filter Posts', 'easy-facebook-likebox' ) . '</label></div>';
            $efbl_premium_other_pages = null;
            $efbl_premium_other_pages = '<div class="col s6 efbl_fields">
        <a href="javascript:void(0)" style="right: 10px;" class="efbl_open_collapisble" data-id="efbl_other_pages_info">?</a>
        	<input name="" class="modal-trigger" href="#efbl-other-pages-upgrade" type="checkbox" required value="efbl_free_other_pages" id="efbl_free_other_pages" />
										      <label for="efbl_free_other_pages">' . __( 'Other Page', 'easy-facebook-likebox' ) . '</label></div>';
            $efbl_skin_options = null;
            if ( isset( $efbl_skins ) ) {
                foreach ( $efbl_skins as $efbl_skin ) {
                    $layout_selected = ucfirst( $efbl_skin['design']['layout_option'] );
                    // echo "<pre>"; print_r();exit();
                    $efbl_skin_options .= '<option value="' . $efbl_skin['ID'] . '" data-icon="' . get_the_post_thumbnail_url( $efbl_skin['ID'], 'thumbnail' ) . '">' . $efbl_skin['title'] . ' | Layout: ' . $layout_selected . '</span></option>';
                }
            }
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $efbl_skin_options .= '<option value="free-grid">' . __( 'Grid Skin | Layout: Grid', 'easy-facebook-likebox' ) . '</option>
								   <option value="free-masonry">' . __( 'Grid Masonry | Layout: Masonry', 'easy-facebook-likebox' ) . '</option>
								   <option value="free-carousel">' . __( 'Grid Carousel | Layout: Carousel', 'easy-facebook-likebox' ) . '</option>';
            }
            
            $efbl_premium_tabs = null;
            $efbl_premium_tabs = '<div class="col s12 efbl_fields">
        <a href="javascript:void(0)" class="efbl_open_likebox_collapisble" data-id="efbl_tabs_info">?</a>
        	<input name="" class="modal-trigger" href="#efbl-tabs-upgrade" type="checkbox" required value="efbl_free_tabs" id="efbl_free_tabs" />
										      <label for="efbl_free_tabs">' . __( 'Tabs', 'easy-facebook-likebox' ) . '</label></div>';
            $efbl_events_filter = null;
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) && !empty($fta_settings['plugins']['facebook']['approved_pages']) ) {
                $efbl_default_shortcode = '<p>' . __( 'Copy and paste the following shortcode in any page, post or text widget to display the Custom Facebook Feed', 'easy-facebook-likebox' ) . '</p>
									<blockquote class="efbl-shortcode-block">[efb_feed fanpage_id=' . $default_page_id . ' skin_id=' . $default_skin_id . '] </blockquote> 
									<a class="btn waves-effect efbl_copy_shortcode waves-light tooltipped" data-position="right" data-delay="50" data-tooltip="' . __( 'Copy', 'easy-facebook-likebox' ) . '" data-clipboard-text="[efb_feed fanpage_id=' . $default_page_id . ' skin_id=' . $default_skin_id . ']" href="javascript:void(0);"><i class="material-icons right">content_copy</i> </a>';
                $efbl_default_likebox_notice = '';
            } else {
                $efbl_default_shortcode = '<blockquote class="efbl-red-notice">' . __( 'It looks like you have not connected your Facebook page with plugin yet. Please click on the Connect My Facebook Pages button from authentication tab to get the access token from Facebook and then go with the flow.', 'easy-facebook-likebox' ) . '</blockquote>';
                $default_page_id = 'easysocialfeed';
                $efbl_default_likebox_notice = '<span class="efbl_default_likebox_notice">' . __( '<b>Note:</b> Do not forget to replace "easysocialfeed"</b> with your Facebook page slug/ID or URL', 'easy-facebook-likebox' ) . '</span>';
            }
            
            // echo "<pre>"; print_r($fta_settings['plugins']['facebook']['approved_pages']); exit();
            /*
             * General tab html.
             * efbl_general_html filter can be used to customize general tab html.
             */
            $efbl_general_html = null;
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
                $efbl_feed_heading = __( "You can display your Facebook page(s) feed (posts, photos, videos, events, and albums) by using Easy Facebook Feed widget or shortcode. Check out the", 'easy-facebook-likebox' );
            } else {
                $efbl_feed_heading = __( "You can display your Facebook page(s) feed (posts) by using Easy Facebook Feed widget or shortcode. Check out the", 'easy-facebook-likebox' );
            }
            
            $efbl_general_html .= sprintf(
                '<div id="efbl-general" class="col s12 efbl_tab_c slideLeft">
						<div class="row">
						    <div class="efbl-tabs-vertical">
						        <div class="col s2 efbl_si_tabs_name_holder">
						            <ul class="tabs">
						                <li class="tab">
						                    <a class="active" href="#efbl-feed-use">%1$s</a>
						                </li>
						                <li class="tab">
						                    <a href="#efbl-likebox-use">%27$s</a>
						                </li>
						                <li class="tab">
						                    <a href="#efbl-popup-use">%43$s</a>
						                </li>
						            </ul>
						        </div>
						        <div class="col s10  efbl_tabs_holder">
						            <div id="efbl-feed-use" class="tab-content efbl_tab_c_holder">
						            
		                 	<div class="row">

		                 	<div class="efbl_collapsible_info col s12">

		                 			<div class="efbl_default_shortcode_holder col s8">
						            <h5>%113$s</h5>
									%118$s
									<h5 class="efbl_more_head">%115$s</h5>
									<p>%116$s</p>
									</div>
						          
		                 			<div class="efbl_shortocode_genrator_main col s4">
		                 				<h5>%98$s</h5>
		                 				<ol>
			                 				<li>%99$s</li>
											<li>%100$s</li>
											<li>%101$s</li>
					                 	</ol>
					                </div> 	
			                 			
									<form class="efbl_shortocode_genrator" name="efbl_shortocode_genrator" type="post">
									<h5>%10$s</h5>
                                        <div class="input-field col s12 efbl_fields">
                                        <a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_page_info">?</a>
                                            <select id="efbl_page_id" class="icons efbl_page_id">
                                             %11$s
                                            </select>
                                            <label>%12$s</label>
                                          </div>

                                           <div class="input-field col s12 efbl_fields">
						              	<a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_access_token_info">?</a>
						              		<input id="efbl_access_token" type="text">
							                <label for="efbl_access_token" class="">%108$s</label>
						              	</div>

						              		%102$s

						              		%13$s

						              		%110$s
						              	
						              	<div class="input-field col s12 efbl_fields">
						              	<a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_skin_id_info">?</a>
						              		<select id="efbl_skin_id" class="icons efbl_skin_id">
										      %16$s
										    </select>
										     <label>%15$s</label>
						              	</div>

						              	<div class="input-field col s6 efbl_fields" style="padding-right: 10px;">
						              	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_collapisble" data-id="efbl_post_limit_info">?</a>
						              		<input id="efbl_post_limit" value="10" type="number" min="1">
							                <label for="efbl_post_limit" class="">%23$s</label>
						              	</div>

						              	<div class="input-field col s6 efbl_fields">
						              	<a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_caption_words_info">?</a>
						              		<input id="efbl_caption_words" value="25" type="number" min="1">
							                <label for="efbl_caption_words" class="">%14$s</label>
						              	</div>

						              	<div class="input-field col s6 efbl_fields" style="margin-top: 22px; padding-right: 10px;">
						              	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_collapisble" data-id="efbl_cache_unit_info">?</a>
							                <input id="efbl_cache_unit" value="1" type="number" min="1">
							                <label for="efbl_cache_unit" class="">%21$s</label>
						              	</div>

						               <div class="input-field col s6 efbl_fields">
						               <a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_cache_duration_info">?</a>
						              	 <select id="efbl_cache_duration" class="efbl_cache_duration">
									      <option value="minutes" >%18$s</option>
									      <option value="hours">%19$s</option>
									      <option selected value="days">%20$s</option>
									    </select>
							              <label>%17$s</label>  
						              	</div>

						              	<div class="col s6 efbl_fields" style="padding-right: 10px;">
						              	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_collapisble" data-id="efbl_show_likebox_info">?</a>
						             	 <input name="efbl_show_likebox" type="checkbox" class="filled-in" value="" id="efbl_show_likebox" />
										      <label for="efbl_show_likebox">%22$s</label>
								      </div>

								      <div class="col s6 efbl_fields">
								      	<a href="javascript:void(0)" class="efbl_open_collapisble" data-id="efbl_link_new_tab_info">?</a>
						             	 <input name="efbl_link_new_tab" type="checkbox" class="filled-in" value="" id="efbl_link_new_tab" />
										      <label for="efbl_link_new_tab">%24$s</label>
								      </div>

						              	<input type="submit" class="btn  efbl_shortcode_submit" value="%25$s" />
									</form>

									 <div class="efbl_generated_shortcode">
									  <p>%54$s</p>
									 <blockquote class="efbl-shortcode-block"></blockquote>
										<a class="btn waves-effect efbl_copy_shortcode efbl_shortcode_generated_final waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="%26$s"  href="javascript:void(0);"><i class="material-icons center">content_copy</i> </a>
									 </div>	

			                 	</div>

			                 	<div class="efbl_collapsible_info col s12">
			                 			<h5>%3$s</h5>
										<ol>
			                 				<li>%4$s</li>
											<li>%5$s</li>
											<li>%6$s</li>
											<li>%7$s</li>
											<li>%8$s</li>
					                 	</ol>
					                 	<a class="waves-effect waves-light btn" href="' . admin_url( "widgets.php" ) . '">%9$s<i class="material-icons right">link</i></a>
			                 	</div>

			                 	
		                 	</div>

		                 	<h5>%56$s</h5>
		                 	<p>%57$s</p>
		                 	<ul class="collapsible efbl_shortcode_accord" data-collapsible="accordion">
								  <li id="efbl_page_info">
								    <div class="collapsible-header">
								      <i class="material-icons">pages</i>
								    	<span class="mif_detail_head"> %58$s </span>
								     </div>
								    <div class="collapsible-body"><p>%59$s</p></div>
								  </li>

								  <li id="efbl_access_token_info">
								    <div class="collapsible-header">
								      <i class="material-icons">code</i>
								    	<span class="mif_detail_head"> %108$s </span>
								     </div>
								    <div class="collapsible-body"><p>%109$s</p></div>
								  </li>

								   <li id="efbl_other_pages_info">
								    <div class="collapsible-header">
								      <i class="material-icons">filter_list</i>   
								      <span class="mif_detail_head"> %103$s</span>
								      </div>
								     <div class="collapsible-body"><p>%104$s</div>
								  </li>


								  <li id="efbl_filter_posts_info">
								    <div class="collapsible-header">
								      <i class="material-icons">filter_list</i>   
								      <span class="mif_detail_head"> %60$s</span>
								      </div>
								     <div class="collapsible-body"><p>%61$s</div>
								  </li>

								   <li id="efbl_filter_events_info">
								    <div class="collapsible-header">
								      <i class="material-icons">filter_list</i>   
								      <span class="mif_detail_head"> %111$s</span>
								      </div>
								     <div class="collapsible-body"><p>%112$s</div>
								  </li>

								   <li id="efbl_skin_id_info">
								    <div class="collapsible-header">
								      <i class="material-icons">web</i>
								      <span class="mif_detail_head"> %62$s</span>
								      </div>
								     <div class="collapsible-body"><p>%63$s</p></div>
								  </li>

								  <li id="efbl_post_limit_info">
								    <div class="collapsible-header">
								      <i class="material-icons">view_compact</i>
								      <span class="mif_detail_head"> %64$s</span>
								      </div>
								     <div class="collapsible-body"><p>%65$s</p></div>
								  </li>

								  <li id="efbl_caption_words_info">
								    <div class="collapsible-header">
								      <i class="material-icons">plus_one</i>
								      <span class="mif_detail_head">%66$s</span>
								      </div>
								     <div class="collapsible-body"><p>%67$s</p></div>
								  </li>

								   <li id="efbl_cache_unit_info">
								    <div class="collapsible-header">
								      <i class="material-icons">cached</i>
								      <span class="mif_detail_head">%68$s</span>
								      </div>
								     <div class="collapsible-body"><p>%69$s</p></div>
								  </li>

								  <li id="efbl_cache_duration_info">
								    <div class="collapsible-header">
								      <i class="material-icons">access_time</i>
								      <span class="mif_detail_head">%70$s</span>
								      </div>
								     <div class="collapsible-body"><p>%71$s</p></div>
								  </li>

								  <li id="efbl_show_likebox_info">
								    <div class="collapsible-header">
								      <i class="material-icons">video_label</i>
								      <span class="mif_detail_head">%72$s</span>
								      </div>
								     <div class="collapsible-body"><p>%73$s</p></div>
								  </li>

								  <li id="efbl_link_new_tab_info">
								    <div class="collapsible-header">
								      <i class="material-icons">open_in_new</i>
								      <span class="mif_detail_head">%74$s</span>
								      </div>
								     <div class="collapsible-body"><p>%75$s</p></div>
								  </li>

								</ul>
						            </div>
						            <div id="efbl-likebox-use" class="tab-content efbl_tab_c_holder">
						            	
						            
		                 	<div class="row">

		                 	<div class="efbl_collapsible_info col s12">

		                 			<div class="efbl_default_shortcode_holder col s8">
						            <h5>%113$s</h5>
									<p>%117$s</p>
									<blockquote class="efbl-shortcode-block">[efb_likebox fanpage_url=' . $default_page_id . ' responsive=1]</blockquote> 
									<a class="btn waves-effect efbl_copy_shortcode waves-light tooltipped" data-position="right" data-delay="50" data-tooltip="%26$s" data-clipboard-text="[efb_likebox fanpage_url=' . $default_page_id . ' responsive=1]" href="javascript:void(0);"><i class="material-icons right">content_copy</i> </a> ' . $efbl_default_likebox_notice . '
									<h5 class="efbl_more_head">%115$s</h5>
									<p>%116$s</p>
									</div>

		                 				<div class="efbl_shortocode_genrator_main col s4">
		                 				<h5>%98$s</h5>
		                 				<ol>
			                 				<li>%99$s</li>
											<li>%100$s</li>
											<li>%101$s</li>
					                 	</ol>
					                </div> 
			                 			
									<form class="efbl_like_box_shortocode_genrator" name="efbl_like_box_shortocode_genrator" type="post">
										<h5>%10$s</h5>
                                     	<div class="input-field col s12 efbl_fields">
                                     	<a href="javascript:void(0)" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_url_info">?</a>
							                <input id="efbl_like_box_url" type="text">
							                <label for="efbl_like_box_url" class="">%32$s</label>
						              	</div>

						              	%105$s

						              	<div class="input-field col s6 efbl_fields" style="padding-right: 10px;">
						              	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_appid_info">?</a>
						              		<input id="efbl_like_box_app_id" type="number" min="1">
							                <label for="efbl_like_box_app_id" class="">%33$s</label>
						              	</div>

						              	<div class="input-field col s6 efbl_fields">
						              	<a href="javascript:void(0)" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_width_info">?</a>
						              		<input id="efbl_like_box_width" type="number" min="1">
							                <label for="efbl_like_box_width" class="">%34$s</label>
						              	</div>

						              	<div class="input-field col s6 efbl_fields" style="margin-top: 22px; padding-right: 10px;">
						              	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_height_info">?</a>
						              		<input id="efbl_like_box_height" type="number" min="1">
							                <label for="efbl_like_box_height" class="">%35$s</label>
						              	</div>

						              	<div class="input-field col s6 efbl_fields">
						              	<a href="javascript:void(0)" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_locale_info">?</a>
						              		<select id="efbl_like_box_locale" class="efbl_like_box_locale">
					                            	<option value="af_ZA">Afrikaans</option>
					                                <option value="ar_AR">Arabic</option>
					                                <option value="az_AZ">Azeri</option>
					                                <option value="be_BY">Belarusian</option>
					                                <option value="bg_BG">Bulgarian</option>
					                                <option value="bn_IN">Bengali</option>
					                                <option value="bs_BA">Bosnian</option>
					                                <option value="ca_ES">Catalan</option>
					                                <option value="cs_CZ">Czech</option>
					                                <option value="cy_GB">Welsh</option>
					                                <option value="da_DK">Danish</option>
					                                <option value="de_DE">German</option>
					                                <option value="el_GR">Greek</option>
					                                <option selected="selected" value="en_US">English (US)</option>
					                                <option value="en_GB">English (UK)</option>
					                                <option value="eo_EO">Esperanto</option>
					                                <option value="es_ES">Spanish (Spain)</option>
					                                <option value="es_LA">Spanish</option>
					                                <option value="et_EE">Estonian</option>
					                                <option value="eu_ES">Basque</option>
					                                <option value="fa_IR">Persian</option>
					                                <option value="fb_LT">Leet Speak</option>
					                                <option value="fi_FI">Finnish</option>
					                                <option value="fo_FO">Faroese</option>
					                                <option value="fr_FR">French (France)</option>
					                                <option value="fr_CA">French (Canada)</option>
					                                <option value="fy_NL">NETHERLANDS (NL)</option>
					                                <option value="ga_IE">Irish</option>
					                                <option value="gl_ES">Galician</option>
					                                <option value="hi_IN">Hindi</option>
					                                <option value="hr_HR">Croatian</option>
					                                <option value="hu_HU">Hungarian</option>
					                                <option value="hy_AM">Armenian</option>
					                                <option value="id_ID">Indonesian</option>
					                                <option value="is_IS">Icelandic</option>
					                                <option value="it_IT">Italian</option>
					                                <option value="ja_JP">Japanese</option>
					                                <option value="ka_GE">Georgian</option>
					                                <option value="km_KH">Khmer</option>
					                                <option value="ko_KR">Korean</option>
					                                <option value="ku_TR">Kurdish</option>
					                                <option value="la_VA">Latin</option>
					                                <option value="lt_LT">Lithuanian</option>
					                                <option value="lv_LV">Latvian</option>
					                                <option value="mk_MK">Macedonian</option>
					                                <option value="ml_IN">Malayalam</option>
					                                <option value="ms_MY">Malay</option>
					                                <option value="nb_NO">Norwegian (bokmal)</option>
					                                <option value="ne_NP">Nepali</option>
					                                <option value="nl_NL">Dutch</option>
					                                <option value="nn_NO">Norwegian (nynorsk)</option>
					                                <option value="pa_IN">Punjabi</option>
					                                <option value="pl_PL">Polish</option>
					                                <option value="ps_AF">Pashto</option>
					                                <option value="pt_PT">Portuguese (Portugal)</option>
					                                <option value="pt_BR">Portuguese (Brazil)</option>
					                                <option value="ro_RO">Romanian</option>
					                                <option value="ru_RU">Russian</option>
					                                <option value="sk_SK">Slovak</option>
					                                <option value="sl_SI">Slovenian</option>
					                                <option value="sq_AL">Albanian</option>
					                                <option value="sr_RS">Serbian</option>
					                                <option value="sv_SE">Swedish</option>
					                                <option value="sw_KE">Swahili</option>
					                                <option value="ta_IN">Tamil</option>
					                                <option value="te_IN">Telugu</option>
					                                <option value="th_TH">Thai</option>
					                                <option value="tl_PH">Filipino</option>
					                                <option value="tr_TR">Turkish</option>
					                                <option value="uk_UA">Ukrainian</option>
					                                <option value="ur_PK">Urdu</option>
					                                <option value="vi_VN">Vietnamese</option>
					                                <option value="zh_CN">Simplified Chinese (China)</option>
					                                <option value="zh_HK">Traditional Chinese (Hong Kong)</option>
					                                <option value="zh_TW">Traditional Chinese (Taiwan)</option>
                            
										    </select>
										     <label>%36$s</label>
						              	</div>


						              	<div class="col s6 efbl_fields">
						              	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_responsive_info">?</a>
						             	 <input name="efbl_like_box_responsive" type="checkbox" class="filled-in" value="" id="efbl_like_box_responsive" />
										      <label for="efbl_like_box_responsive">%37$s</label>
								      </div>

								      <div class="col s6 efbl_fields">
								      	<a href="javascript:void(0)"  class="efbl_open_likebox_collapisble" data-id="efbl_like_box_faces_info">?</a>
						             	 <input name="efbl_like_box_faces" type="checkbox" class="filled-in" value="" id="efbl_like_box_faces" />
										      <label for="efbl_like_box_faces">%38$s</label>
								      </div>

								       <div class="col s6 efbl_fields">
								       <a href="javascript:void(0)" style="right: 10px;" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_stream_info">?</a>
						             	 <input name="efbl_like_box_stream" type="checkbox" class="filled-in" value="" id="efbl_like_box_stream" />
										      <label for="efbl_like_box_stream">%39$s</label>
								      </div>

								       <div class="col s6 efbl_fields">
								       	<a href="javascript:void(0)" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_cover_info">?</a>
						             	 <input name="efbl_like_box_cover" type="checkbox" class="filled-in" value="" id="efbl_like_box_cover" />
										      <label for="efbl_like_box_cover">%40$s</label>
								      </div>


								       <div class="col s6 efbl_fields">
								       	<a href="javascript:void(0)" style="right: 10px;" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_sh_info">?</a>
						             	 <input name="efbl_like_box_small_header" type="checkbox" class="filled-in" value="" id="efbl_like_box_small_header" />
										      <label for="efbl_like_box_small_header">%41$s</label>
								      </div>


								       <div class="col s6 efbl_fields">
								        <a href="javascript:void(0)" class="efbl_open_likebox_collapisble" data-id="efbl_like_box_cta_info">?</a>
						             	 <input name="efbl_like_box_hide_cta" type="checkbox" class="filled-in" value="" id="efbl_like_box_hide_cta" />
										      <label for="efbl_like_box_hide_cta">%42$s</label>
								      </div>

						              	<input type="submit" class="btn efbl_likebox_shortcode_submit" value="%25$s" />
									</form>

									 <div class="efbl_likebox_generated_shortcode">
									 <p>%54$s</p>
									 <blockquote class="efbl-likebox-shortcode-block"></blockquote>
										<a class="btn waves-effect efbl_likebox_copy_shortcode efbl_likebox_shortcode_generated_final waves-light tooltipped" data-position="right" data-delay="50" data-tooltip="%26$s"  href="javascript:void(0);"><i class="material-icons center">content_copy</i> </a>
									 </div>	

			                 	</div>

			                 	<div class="efbl_collapsible_info col s12">
			                 			<h5>%3$s</h5>
										<ol>
			                 				<li>%4$s</li>
											<li>%29$s</li>
											<li>%6$s</li>
											<li>%30$s</li>
											<li>%31$s</li>
					                 	</ol>
					                 	<a class="waves-effect waves-light btn" href="' . admin_url( "widgets.php" ) . '">%9$s<i class="material-icons right">link</i></a>
			                 	</div>

			                 	
		                 	</div>

		                 	<h5>%56$s</h5>
		                 	<p>%57$s</p>
		                 	<ul class="collapsible efbl_shortcode_accord efbl_likebox_shortcode_accord" data-collapsible="accordion">
								  <li id="efbl_like_box_url_info">
								    <div class="collapsible-header">
								      <i class="material-icons">insert_link</i>
								    	<span class="mif_detail_head"> %76$s </span>
								     </div>
								    <div class="collapsible-body"><p>%77$s</p></div>
								  </li>
								 
								   <li id="efbl_tabs_info">
								    <div class="collapsible-header">
								      <i class="material-icons">filter_list</i>   
								      <span class="mif_detail_head">%106$s</span>
								      </div>
								     <div class="collapsible-body"><p>%107$s</div>
								  </li>

								  <li id="efbl_like_box_appid_info">
								    <div class="collapsible-header">
								      <i class="material-icons">apps</i>   
								      <span class="mif_detail_head">%78$s</span>
								      </div>
								     <div class="collapsible-body"><p>%79$s</div>
								  </li>

								   <li id="efbl_like_box_width_info">
								    <div class="collapsible-header">
								      <i class="material-icons">check_box_outline_blank</i>
								      <span class="mif_detail_head"> %80$s</span>
								      </div>
								     <div class="collapsible-body"><p>%81$s</p></div>
								  </li>

								  <li id="efbl_like_box_height_info">
								    <div class="collapsible-header">
								      <i class="material-icons">check_box_outline_blank</i>
								      <span class="mif_detail_head"> %82$s</span>
								      </div>
								     <div class="collapsible-body"><p>%83$s</p></div>
								  </li>

								  <li id="efbl_like_box_locale_info">
								    <div class="collapsible-header">
								      <i class="material-icons">language</i>
								      <span class="mif_detail_head">%84$s</span>
								      </div>
								     <div class="collapsible-body"><p>%85$s</p></div>
								  </li>

								   <li id="efbl_like_box_responsive_info">
								    <div class="collapsible-header">
								      <i class="material-icons">laptop_mac</i>
								      <span class="mif_detail_head">%86$s</span>
								      </div>
								     <div class="collapsible-body"><p>%87$s</p></div>
								  </li>

								  <li id="efbl_like_box_faces_info">
								    <div class="collapsible-header">
								      <i class="material-icons">tag_faces</i>
								      <span class="mif_detail_head">%88$s</span>
								      </div>
								     <div class="collapsible-body"><p>%89$s</p></div>
								  </li>

								  <li id="efbl_like_box_stream_info">
								    <div class="collapsible-header">
								      <i class="material-icons">filter_list</i>
								      <span class="mif_detail_head">%90$s</span>
								      </div>
								     <div class="collapsible-body"><p>%91$s</p></div>
								  </li>

								  <li id="efbl_like_box_cover_info">
								    <div class="collapsible-header">
								      <i class="material-icons">broken_image</i>
								      <span class="mif_detail_head">%92$s</span>
								      </div>
								     <div class="collapsible-body"><p>%93$s</p></div>
								  </li>

								   <li id="efbl_like_box_sh_info">
								    <div class="collapsible-header">
								      <i class="material-icons">layers</i>
								      <span class="mif_detail_head">%94$s</span>
								      </div>
								     <div class="collapsible-body"><p>%95$s</p></div>
								  </li>

								  <li id="efbl_like_box_cta_info" >
								    <div class="collapsible-header">
								      <i class="material-icons">do_not_disturb</i>
								      <span class="mif_detail_head">%96$s</span>
								      </div>
								     <div class="collapsible-body"><p>%97$s</p></div>
								  </li>

								</ul>
						            </div>
						            <div id="efbl-popup-use" class="tab-content efbl_tab_c_holder">
						            	<p>%44$s <a target="_blank" href="https://easysocialfeed.com/auto-popup-likebox/">%55$s</a></p>
					                 	<ol>
											<li>%45$s</li>
											<li>%46$s</li>
											<li>%47$s</li>
											<li>%48$s</li>
											<li>%49$s</li>
											<li>%50$s</li>
											<li>%51$s</li>
					                 	</ol>
					                 	<a class="waves-effect waves-light btn efbl_auto_popup_redirect" href="javascript:void(0)">%9$s<i class="material-icons right">link</i></a>
						            </div>
						        </div>
						    </div>
						</div>
				</div>',
                /* Variables starts here. */
                __( 'Facebook Page feed', 'easy-facebook-likebox' ),
                $efbl_feed_heading,
                __( 'How to use Widget?', 'easy-facebook-likebox' ),
                __( 'Go to Appearance > Widgets.', 'easy-facebook-likebox' ),
                __( 'Look for Easy Facebook Feed widget in available widgets section.', 'easy-facebook-likebox' ),
                __( 'Drag and drop the widget to any of your active sidebar.', 'easy-facebook-likebox' ),
                __( 'Change default values with your requirements like fanpage ID of your page and post layout etc.', 'easy-facebook-likebox' ),
                __( 'Click the save button and visit your site to see feeds in widget', 'easy-facebook-likebox' ),
                __( 'Take me there', 'easy-facebook-likebox' ),
                __( 'Shortcode Generator', 'easy-facebook-likebox' ),
                $efbl_page_options,
                __( 'Select Page', 'easy-facebook-likebox' ),
                $efbl_premium_filter,
                __( 'Number of words in caption/content', 'easy-facebook-likebox' ),
                __( 'Select skin and layout', 'easy-facebook-likebox' ),
                $efbl_skin_options,
                __( 'Cache Duration', 'easy-facebook-likebox' ),
                __( 'Minutes', 'easy-facebook-likebox' ),
                __( 'Hours', 'easy-facebook-likebox' ),
                __( 'Days', 'easy-facebook-likebox' ),
                __( 'Cache Unit', 'easy-facebook-likebox' ),
                __( 'Show Likebox', 'easy-facebook-likebox' ),
                __( 'Number of posts to display', 'easy-facebook-likebox' ),
                __( 'Open links in new tab', 'easy-facebook-likebox' ),
                __( 'Generate', 'easy-facebook-likebox' ),
                __( 'Copy', 'easy-facebook-likebox' ),
                __( 'Facebook Page Likebox', 'easy-facebook-likebox' ),
                __( 'You can display your page likebox by using Easy Facebook Likebox widget or shortcode. Check out the', 'easy-facebook-likebox' ),
                __( 'Look for Easy Facebook Likebox widget in available widgets section.', 'easy-facebook-likebox' ),
                __( 'Change default values with your requirements like fanpage url and animation etc.', 'easy-facebook-likebox' ),
                __( 'Click the save button and visit your site to see likebox in widget', 'easy-facebook-likebox' ),
                __( 'Your page full URL', 'easy-facebook-likebox' ),
                __( 'Facebook App ID(optional)', 'easy-facebook-likebox' ),
                __( 'Box width', 'easy-facebook-likebox' ),
                __( 'Box height', 'easy-facebook-likebox' ),
                __( 'Select language', 'easy-facebook-likebox' ),
                __( 'Responsive', 'easy-facebook-likebox' ),
                __( 'Show faces', 'easy-facebook-likebox' ),
                __( 'Show posts stream', 'easy-facebook-likebox' ),
                __( 'Hide cover', 'easy-facebook-likebox' ),
                __( 'Small header', 'easy-facebook-likebox' ),
                __( 'Hide call to action button', 'easy-facebook-likebox' ),
                __( 'Auto PopUp', 'easy-facebook-likebox' ),
                __( 'You can display your likebox or anything including HTML in auto popup which will automatically show after a defined time interval. Follow the steps below to enable and customize it. Check out the ', 'easy-facebook-likebox' ),
                __( 'Go to Easy Facebook Likebox - ESPF > Facebook > AutoPopUp tab.', 'easy-facebook-likebox' ),
                __( 'Enable the PopUp by clicking AutoPopUp checkbox.', 'easy-facebook-likebox' ),
                __( "Enter time interval in which popup will hold", 'easy-facebook-likebox' ),
                __( "Enter popup width, make sure it's the same width as your likebox so likebox can perfectly fit into it.", 'easy-facebook-likebox' ),
                __( "Enter popup height, make sure it's the same height as your likebox so likebox can perfectly fit into it.", 'easy-facebook-likebox' ),
                __( "Enter likebox shortcode in Popup content field. If you haven't generated yet use shortcode generator available in above Facebook Page Likebox tab.", 'easy-facebook-likebox' ),
                __( "There are some advanced settings are also available like display on homepage only etc.", 'easy-facebook-likebox' ),
                __( 'How to use this plugin?', 'easy-facebook-likebox' ),
                __( 'Awesome! you have connected your Facebook page(s) successfully. Please click on any of the following tabs to see instructions and the shortcode generator for each feature.', 'easy-facebook-likebox' ),
                __( 'Paste in the page/post content or in text widget', 'easy-facebook-likebox' ),
                __( 'Demo', 'easy-facebook-likebox' ),
                __( 'Unable to understand shortocde parameters?', 'easy-facebook-likebox' ),
                __( 'No worries, Each shortocde parameter is explained below first read them and generate your shortocde.', 'easy-facebook-likebox' ),
                __( "Pages", 'easy-facebook-likebox' ),
                __( "List of pages you approved for plugin to get the feeds. Select the page you want to display feeds.", 'easy-facebook-likebox' ),
                __( 'Filter posts <a href="' . efl_fs()->get_upgrade_url() . '">(pro)</a>', 'easy-facebook-likebox' ),
                __( "You can filter page feed by mentioned, events, albums, videos and images. Select any of them to display only specific type of posts like page mentioned only posts, pages events only, page albums only, page videos only and page images only.", 'easy-facebook-likebox' ),
                __( "Skin", 'easy-facebook-likebox' ),
                __( "Skins let's you totally customize the look and feel of your feed in real time. Skin holds all the design settings like feed layout, page header and single post colors, margins and alot of cool settings seprately. You can create new skin from Facebook Likebox - ESPF > Facebook > Skins tab.", 'easy-facebook-likebox' ),
                __( 'Number of posts', 'easy-facebook-likebox' ),
                __( 'You can set number of posts to display on your website page. Like if you set 10 only first 10 posts from your page will retrieve.', 'easy-facebook-likebox' ),
                __( 'Number of words in caption/content', 'easy-facebook-likebox' ),
                __( 'You can set number of words in post description. Like if you set 20 only 20 words from feed description will display.', 'easy-facebook-likebox' ),
                __( 'Cache unit', 'easy-facebook-likebox' ),
                __( 'Feeds Will be automatically refreshed after selected time interval. In this setting, the possible values are any number. Recommended value is 5', 'easy-facebook-likebox' ),
                __( 'Cache duration', 'easy-facebook-likebox' ),
                __( 'Define cache duration to refresh feeds automatically. Like after specified minutes/hours/days feeds would be refreshed. Recommended value is days', 'easy-facebook-likebox' ),
                __( 'Show likebox', 'easy-facebook-likebox' ),
                __( 'It will let you show the page like box or the page plugin at the end of feeds.', 'easy-facebook-likebox' ),
                __( 'Links in new tab', 'easy-facebook-likebox' ),
                __( 'If checked all links in feeds will be opened in a new browser tab instead of current tab.', 'easy-facebook-likebox' ),
                __( 'Page URL', 'easy-facebook-likebox' ),
                __( 'Your Facebook fanpage URL. You can find your page URL from browser address bar when page is opened. Like https://facebook.com/maltathemes', 'easy-facebook-likebox' ),
                __( 'Facebook APP ID', 'easy-facebook-likebox' ),
                __( "To get any type of data from Facebook server it requires Facebook developer app which is responsible of all Facebook calls. Don't worry we have approved apps from Facebook which will be usind if you don't have app registred. You can register your app from Facebook developer account and add ID here.", 'easy-facebook-likebox' ),
                __( 'Box Width', 'easy-facebook-likebox' ),
                __( 'Enter Likebox width in pixels. Likebox will be generated according to defined width.', 'easy-facebook-likebox' ),
                __( 'Box Height', 'easy-facebook-likebox' ),
                __( 'Enter Likebox height in pixels. Likebox will be generated according to defined height.', 'easy-facebook-likebox' ),
                __( 'Select Language', 'easy-facebook-likebox' ),
                __( 'Select the language in which you want to display your feeds.', 'easy-facebook-likebox' ),
                __( 'Responsive', 'easy-facebook-likebox' ),
                __( 'If checked box will automatically adjust on mobile and tablet devices', 'easy-facebook-likebox' ),
                __( 'Show Faces', 'easy-facebook-likebox' ),
                __( 'If checked show profile photos of friends who already liked the page.', 'easy-facebook-likebox' ),
                __( 'Show posts stream', 'easy-facebook-likebox' ),
                __( "If checked it will show posts of the page after likebox.", 'easy-facebook-likebox' ),
                __( 'Hide cover', 'easy-facebook-likebox' ),
                __( 'If checked it will not show your Facebook page cover in likebox.', 'easy-facebook-likebox' ),
                __( 'Small Header', 'easy-facebook-likebox' ),
                __( 'If checked it will show small header. Cover picture size will be minimized.', 'easy-facebook-likebox' ),
                __( 'Hide call to action button', 'easy-facebook-likebox' ),
                __( 'If checked it will not display call to action button like Contact Us', 'easy-facebook-likebox' ),
                __( 'How to use shortcode?', 'easy-facebook-likebox' ),
                __( 'Generate the shortcode using the shortcode generator below.', 'easy-facebook-likebox' ),
                __( 'Copy the shortcode in the left column or generate shortcode if you need more options.', 'easy-facebook-likebox' ),
                __( 'Paste in the page/post content or in text widget', 'easy-facebook-likebox' ),
                $efbl_premium_other_pages,
                __( 'Other Pages <a href="' . efl_fs()->get_upgrade_url() . '">(pro)</a>', 'easy-facebook-likebox' ),
                __( "You can display any other public page feed which you don't owns/manage. eg:gopro", 'easy-facebook-likebox' ),
                $efbl_premium_tabs,
                __( 'Tabs <a href="' . efl_fs()->get_upgrade_url() . '">(pro)</a>', 'easy-facebook-likebox' ),
                __( 'You can now have timeline, events and messages tabs in the likebox. Simply filter the feeds from stream', 'easy-facebook-likebox' ),
                __( 'Access Token (Optional)', 'easy-facebook-likebox' ),
                __( "Access Token provided from Facebook to display your page feeds. If you have your own Facebook app and retrieved access token you can use that to display your feed but this is optional if you don't have your app the default access token will be used. Please note: Your Access token is required to show your page events you can follow the steps explained <a target='_blank' href='https://easysocialfeed.com/custom-facebook-feed/page-token/'>here</a>. This step is only required for events filter", 'easy-facebook-likebox' ),
                $efbl_events_filter,
                __( 'Events Filter <a href="' . efl_fs()->get_upgrade_url() . '">(pro)</a>', 'easy-facebook-likebox' ),
                __( "Filter events to display past, upcoming or all events. Default value is Upcoming", 'easy-facebook-likebox' ),
                __( 'How to use this plugin?', 'easy-facebook-likebox' ),
                __( 'Copy and paste the following shortcode in any page, post or text widget to display the feed.', 'easy-facebook-likebox' ),
                __( 'Need More Options?', 'easy-facebook-likebox' ),
                __( 'Use the following shortcode generator to further customize the shortcode.', 'easy-facebook-likebox' ),
                __( 'Copy and paste the following shortcode in any page, post or text widget to display the likebox/page plugin.', 'easy-facebook-likebox' ),
                $efbl_default_shortcode
            );
            return apply_filters( 'efbl_general_html', $efbl_general_html );
        }
        
        /* efbl_general_tab Method ends here. */
        /*
         * Holds Html For popup Tab.
         *
         */
        function efbl_popup_tab()
        {
            $efbl_premium_pages_enable = null;
            $efbl_premium_pages_enable = '<div class="row checkbox-row">
        	<input name="" class="modal-trigger" href="#efbl-pages-enable" type="checkbox" required value="efbl_free_enable_pages" id="efbl_free_enable_pages" />
		<label for="efbl_free_enable_pages">' . __( 'Show on specific pages', 'easy-facebook-likebox' ) . '</label><br>
									<i class="efbl_popup_info">' . __( "Enable this option show popup on selected pages only. PopUp will never show on un-selected pages. If you haven't selected any page it will display on all pages.", 'easy-facebook-likebox' ) . '</i></div>
		<div class="row checkbox-row">
        	<input name="" class="modal-trigger" href="#efbl-posts-enable" type="checkbox" required value="efbl_free_enable_posts" id="efbl_free_enable_posts" />
		<label for="efbl_free_enable_posts">' . __( 'Show on specific posts', 'easy-facebook-likebox' ) . '</label><br>
									<i class="efbl_popup_info">' . __( "Enable this option show popup on selected posts only. PopUp will never show on un-selected posts. If you haven't selected any page it will display on all posts.", 'easy-facebook-likebox' ) . '</i></div>';
            $efbl_premium_exit_intent = null;
            $efbl_premium_exit_intent = '<div class="row checkbox-row">
        	<input name="" class="modal-trigger" href="#efbl-exit-intent" type="checkbox" required value="efbl_free_exit_intent" id="efbl_free_exit_intent" />
		<label for="efbl_free_exit_intent">' . __( 'Show on exit intent', 'easy-facebook-likebox' ) . '</label>
		<br><i class="efbl_popup_info">' . __( "Enable this option show popup on when user is about to leave the site", 'easy-facebook-likebox' ) . '</i></div>';
            /*
             * General tab html.
             * efbl_popup_html filter can be used to customize general tab html.
             */
            $efbl_popup_html = null;
            $efbl_popup_html .= sprintf(
                '<div id="efbl-auto-popup" class="col s12 efbl_tab_c slideLeft">
						<h5>%1$s</h5>
						<p>%2$s</p>
						<form class="efbl_popup_settings" name="efbl_popup_settings" type="post">	
			                <div class="row checkbox-row efbl_enable_popup">
							 	<input class="efbl_options" data-option="efbl_enable_popup" ' . checked( 1, $this->options( 'efbl_enable_popup' ), false ) . '  type="checkbox" name="efbl_settings_display_options[efbl_enable_popup]" id="efbl_enable_popup" />
								<label for="efbl_enable_popup">%3$s</label>
	   									 
                            </div>
							   <div class="row">
					              <div class="input-field col s12">
					                <input name="efbl_settings_display_options[efbl_popup_interval]" class="efbl_input_options" value="' . $this->options( 'efbl_popup_interval' ) . '" id="efbl_popup_interval" type="number">
					                <label for="efbl_popup_interval" class="">%4$s</label>
					                <span>%5$s</span>
					              </div>
					            </div>

					             <div class="row">
					              <div class="input-field col s12">
					                <input name="efbl_settings_display_options[efbl_popup_width]" class="efbl_input_options" min="0" value="' . $this->options( 'efbl_popup_width' ) . '" id="efbl_popup_width" type="number">
					                <label for="efbl_popup_width" class="">%6$s</label>
					                <span>%7$s</span>
					              </div>
					            </div>

					            <div class="row">
					              <div class="input-field col s12">
					                <input name="efbl_settings_display_options[efbl_popup_height]" class="efbl_input_options" min="0" value="' . $this->options( 'efbl_popup_height' ) . '" id="efbl_popup_height" type="number">
					                <label for="efbl_popup_height" class="">%8$s</label>
					                <span>%9$s</span>
					              </div>
					            </div>

					            <div class="row">
					              <div class="input-field col s12">
					                	<textarea id="efbl_popup_shortcode" class="materialize-textarea" class="efbl_input_options" name="efbl_settings_display_options[efbl_popup_shortcode]">%18$s</textarea>
          								<label for="efbl_popup_shortcode">%10$s</label>
					                <span>%11$s</span>
					              </div>
					            </div>
								<h5>%12$s</h5>

								%19$s
								%20$s
								  <div class="row checkbox-row efbl_enable_home_only">
									
								    <input class="efbl_options" data-option="efbl_enable_home_only" ' . checked( 1, $this->options( 'efbl_enable_home_only' ), false ) . '  type="checkbox" name="efbl_settings_display_options[efbl_enable_home_only]" id="efbl_enable_home_only" />
									<label for="efbl_enable_home_only">%13$s</label>
                            	  </div>

                            	  <div class="row checkbox-row efbl_enable_if_login">
								     <input class="efbl_options" data-option="efbl_enable_if_login" ' . checked( 1, $this->options( 'efbl_enable_if_login' ), false ) . '  type="checkbox" name="efbl_settings_display_options[efbl_enable_if_login]" id="efbl_enable_if_login" />
									<label for="efbl_enable_if_login">%14$s</label>
                            	  </div>

                            	  <div class="row checkbox-row efbl_enable_if_not_login">
								    <input class="efbl_options" data-option="efbl_enable_if_not_login" ' . checked( 1, $this->options( 'efbl_enable_if_not_login' ), false ) . '  type="checkbox" name="efbl_settings_display_options[efbl_enable_if_not_login]" id="efbl_enable_if_not_login" />
									<label for="efbl_enable_if_not_login">%15$s</label>
                            	  </div>

                            	  <div class="row checkbox-row efbl_do_not_show_again">
								     <input class="efbl_options" data-option="efbl_do_not_show_again" ' . checked( 1, $this->options( 'efbl_do_not_show_again' ), false ) . '  type="checkbox" name="efbl_settings_display_options[efbl_do_not_show_again]" id="efbl_do_not_show_again" />
									<label for="efbl_do_not_show_again">%16$s</label>
                            	  </div>

                            	  <div class="row checkbox-row efbl_do_not_show_on_mobile">
								    <input class="efbl_options" data-option="efbl_do_not_show_on_mobile" ' . checked( 1, $this->options( 'efbl_do_not_show_on_mobile' ), false ) . '  type="checkbox" name="efbl_settings_display_options[efbl_do_not_show_on_mobile]" id="efbl_do_not_show_on_mobile" />
									<label for="efbl_do_not_show_on_mobile">%17$s</label>
                            	  </div>
						</form>
				</div>',
                /* Variables starts here. */
                __( 'Want to display PopUp on your site?', 'easy-facebook-likebox' ),
                __( 'You can display Facebook Likebox/page plugin, custom Facebook Feeds or anything, for example, age verification message or cookies alert in pop up. It also supports custom HTML code. Simply Enable the popup and paste generated shortcode or anything in pop up content field.', 'easy-facebook-likebox' ),
                __( 'Enable PopUp', 'easy-facebook-likebox' ),
                __( 'PopUp delay after page load', 'easy-facebook-likebox' ),
                __( 'Delay in miliseconds. 1000 ms = 1 second.', 'easy-facebook-likebox' ),
                __( 'PopUp Width', 'easy-facebook-likebox' ),
                __( 'Width in pixels.', 'easy-facebook-likebox' ),
                __( 'Auto popup height' ),
                __( 'Height in pixels.', 'easy-facebook-likebox' ),
                __( 'PopUp content', 'easy-facebook-likebox' ),
                __( 'You can generate easy facebook like box shortcode from Widgets > Easy Facebook LikeBox. ', 'easy-facebook-likebox' ),
                __( 'Like box pup up advanced settings', 'easy-facebook-likebox' ),
                __( 'Display PopUp on home page only.', 'easy-facebook-likebox' ),
                __( 'Show the PopUp if the user is logged in to your site.', 'easy-facebook-likebox' ),
                __( 'Show the PopUp if the user is not logged in to your site (Above option will be ignored if checked). ', 'easy-facebook-likebox' ),
                __( 'Close button act as never show again', 'easy-facebook-likebox' ),
                __( 'Do not display on mobile devices', 'easy-facebook-likebox' ),
                $this->options( 'efbl_popup_shortcode' ),
                $efbl_premium_pages_enable,
                $efbl_premium_exit_intent
            );
            return apply_filters( 'efbl_popup_html', $efbl_popup_html );
        }
        
        /* efbl_popup_tab Method ends here. */
        /*
         * Holds Html For popup Tab.
         *
         */
        function efbl_skins_html()
        {
            /*
             * Getting all skins.
             */
            global  $efbl_skins ;
            $efbl_skin_html = null;
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $efbl_page_options = null;
            
            if ( isset( $fta_settings['plugins']['facebook']['approved_pages'] ) ) {
                foreach ( $fta_settings['plugins']['facebook']['approved_pages'] as $efbl_page ) {
                    $efbl_page_options .= '<option value="' . $efbl_page['id'] . '" data-icon="https://graph.facebook.com/' . $efbl_page['id'] . '/picture">' . $efbl_page['name'] . '</option>';
                }
            } else {
                $efbl_page_options = '<option value="" disabled selected>' . __( 'No page found, Please connect your Facebook page with plugin first from authentication tab', 'easy-facebook-likebox' ) . '</option>';
            }
            
            $page_id = null;
            /* Getting the demo page id. */
            if ( isset( $fta_settings['plugins']['facebook']['default_page_id'] ) && !empty($fta_settings['plugins']['facebook']['default_page_id']) ) {
                $page_id = $fta_settings['plugins']['facebook']['default_page_id'];
            }
            /* Getting permalink from ID. */
            $page_permalink = get_permalink( $page_id );
            if ( isset( $efbl_skins ) ) {
                foreach ( $efbl_skins as $efbl_skin ) {
                    $customizer_url = admin_url( 'customize.php' );
                    /* If permalink got successfully */
                    if ( isset( $page_permalink ) ) {
                        /* Include permalinks for making*/
                        $customizer_url = add_query_arg( array(
                            'url'              => urlencode( $page_permalink ),
                            'autofocus[panel]' => 'efbl_customize_panel',
                            'efbl_skin_id'     => $efbl_skin['ID'],
                            'efbl_customize'   => 'yes',
                        ), $customizer_url );
                    }
                    /* if condition ends here*/
                    $img_url = get_the_post_thumbnail_url( $efbl_skin['ID'], 'thumbnail' );
                    $selected_layout = null;
                    if ( isset( $efbl_skin['design']['layout_option'] ) ) {
                        $selected_layout = ucfirst( $efbl_skin['design']['layout_option'] );
                    }
                    // echo "<pre>"; print_r();exit();
                    if ( !$img_url ) {
                        $img_url = FTA_PLUGIN_URL . 'assets/images/skin-placeholder.jpg';
                    }
                    $efbl_skin_html .= '<div class="card col efbl_single_skin s3 efbl_skin_' . $efbl_skin['ID'] . '">
					    <div class="card-image waves-effect waves-block waves-light">
					      <img class="activator" src="' . $img_url . '">
					    </div>
					    <div class="card-content">
					      <span class="card-title activator grey-text text-darken-4">' . $efbl_skin['title'] . '<i class="material-icons right">more_vert</i></span>
					      </div>';
                    if ( $selected_layout ) {
                        $efbl_skin_html .= '<span class="selected_layout">' . __( 'Layout: ', 'easy-facebook-likebox' ) . '' . $selected_layout . '</span>';
                    }
                    $efbl_skin_html .= '<div class="efbl_cta_holder">
					       <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="efbl_selected_account_' . $efbl_skin['ID'] . '" required>
                            ' . $efbl_page_options . '
                            </select>
					      	<a class="btn waves-effect  waves-light efbl_skin_redirect" data-page_id="' . $page_id . '" data-skin_id="' . $efbl_skin['ID'] . '" href="javascript:void(0);"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

					      	<a class="btn waves-effect right efbl_skin_delete_confrim waves-light" data-skin_id="' . $efbl_skin['ID'] . '" href="javascript:void(0);"><span>' . __( 'Delete', 'efbl' ) . '</span><i class="material-icons right">delete_forever</i></a>

					      		<a class="btn waves-effect efbl_copy_skin_id waves-light"  data-clipboard-text="' . $efbl_skin['ID'] . '" href="javascript:void(0);">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
					      </div>

					    <div class="card-reveal">
					      <span class="card-title grey-text text-darken-4">' . $efbl_skin['title'] . '<i class="material-icons right">close</i></span>
					      <p>' . $efbl_skin['description'] . '</p>
					    </div>
					  </div>';
                }
            }
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $efbl_skin_html .= '<div class="card col efbl_single_skin efbl_single_skin_free s3">
        				<a class="skin_free_full modal-trigger" href="#efbl-free-grid-upgrade"></a>
					    <div class="card-image waves-effect waves-block waves-light">
					     <a class=" modal-trigger" href="#efbl-free-grid-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
					    </div>
					    <div class="card-content">
					     <a class=" modal-trigger" href="#efbl-free-grid-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Grid layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
					      </div>
					      <span class="selected_layout">' . __( 'Layout: Grid', 'easy-facebook-likebox' ) . '</span>
					      <div class="efbl_cta_holder">
					       <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="efbl_selected_account" required>
                            ' . $efbl_page_options . '
                            </select>
					      	<a class="btn waves-effect  waves-light efbl_skin_redirect_free modal-trigger" href="#efbl-free-grid-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

					      	<a class="btn waves-effect right efbl_skin_delete_free waves-light modal-trigger" href="#efbl-free-grid-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

					      		<a class="btn waves-effect efbl_copy_skin_id modal-trigger  waves-light" href="#efbl-free-grid-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
					      </div>

					    <div class="card-reveal">
					      <span class="card-title grey-text text-darken-4">' . __( 'Layout: Grid', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
					      <p>' . __( 'This is the Grid demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
					    </div>
					  </div>';
                $efbl_skin_html .= '<div class="card col efbl_single_skin efbl_single_skin_free s3">
        				<a class="skin_free_full modal-trigger" href="#efbl-free-masonry-upgrade"></a>
					    <div class="card-image waves-effect waves-block waves-light">
					     <a class=" modal-trigger" href="#efbl-free-masonry-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
					    </div>
					    <div class="card-content">
					     <a class=" modal-trigger" href="#efbl-free-masonry-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Masonry layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
					      </div>
					      <span class="selected_layout">' . __( 'Layout: Masonry', 'easy-facebook-likebox' ) . '</span>
					      <div class="efbl_cta_holder">
					       <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="efbl_selected_account" required>
                            ' . $efbl_page_options . '
                            </select>
					      	<a class="btn waves-effect  waves-light efbl_skin_redirect_free modal-trigger" href="#efbl-free-masonry-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

					      	<a class="btn waves-effect right efbl_skin_delete_free waves-light modal-trigger" href="#efbl-free-masonry-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

					      		<a class="btn waves-effect efbl_copy_skin_id modal-trigger  waves-light" href="#efbl-free-masonry-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
					      </div>

					    <div class="card-reveal">
					      <span class="card-title grey-text text-darken-4">' . __( 'Layout: Masonry', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
					      <p>' . __( 'This is the Masonry demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
					    </div>
					  </div>';
                $efbl_skin_html .= '<div class="card col efbl_single_skin efbl_single_skin_free s3">
        				<a class="skin_free_full modal-trigger" href="#efbl-free-carousel-upgrade"></a>
					    <div class="card-image waves-effect waves-block waves-light">
					     <a class=" modal-trigger" href="#efbl-free-carousel-upgrade"> <img class="" src="' . FTA_PLUGIN_URL . '/assets/images/skin-placeholder.jpg"> </a>
					    </div>
					    <div class="card-content">
					     <a class=" modal-trigger" href="#efbl-free-carousel-upgrade"> <span class="card-title  grey-text text-darken-4">' . __( 'Skin - Carousel layout', 'easy-facebook-likebox' ) . '<i class="material-icons right">more_vert</i></span> </a>
					      </div>
					      <span class="selected_layout">' . __( 'Layout: Carousel', 'easy-facebook-likebox' ) . '</span>
					      <div class="efbl_cta_holder">
					       <label>' . __( 'Please select your page first for preview ignorer to add/edit the skin. (This selection is only for preview, it can be used with any page.)', 'easy-facebook-likebox' ) . '</label>
                            <select class="efbl_selected_account" required>
                            ' . $efbl_page_options . '
                            </select>
					      	<a class="btn waves-effect  waves-light efbl_skin_redirect_free modal-trigger" href="#efbl-free-carousel-upgrade"><span>' . __( 'Edit', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">edit</i></a>

					      	<a class="btn waves-effect right efbl_skin_delete_free waves-light modal-trigger" href="#efbl-free-carousel-upgrade"><span>' . __( 'Delete', 'easy-facebook-likebox' ) . '</span><i class="material-icons right">delete_forever</i></a>

					      		<a class="btn waves-effect efbl_copy_skin_id modal-trigger  waves-light" href="#efbl-free-carousel-upgrade">' . __( 'Copy Skin ID', 'easy-facebook-likebox' ) . '<i class="material-icons right">content_copy</i></span> </a>
					      </div>

					    <div class="card-reveal">
					      <span class="card-title grey-text text-darken-4">' . __( 'Layout: Carousel', 'easy-facebook-likebox' ) . '<i class="material-icons right">close</i></span>
					      <p>' . __( 'This is the carousel demo skin included in premium version', 'easy-facebook-likebox' ) . '</p>
					    </div>
					  </div>';
            }
            
            $layout_choices = '<option value="thumbnail">' . __( 'Thumbnail', 'easy-facebook-likebox' ) . '</option>
								   <option value="half">' . __( 'Half Width', 'easy-facebook-likebox' ) . '</option>
								   <option value="full">' . __( 'Full Width', 'easy-facebook-likebox' ) . '</option>';
            
            if ( efl_fs()->is_plan( 'facebook_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
            } else {
                $layout_choices .= '<option value="free-grid">' . __( 'Grid', 'easy-facebook-likebox' ) . '</option>
								   <option value="free-masonry">' . __( 'Masonry', 'easy-facebook-likebox' ) . '</option>
								   <option value="free-carousel">' . __( 'Carousel', 'easy-facebook-likebox' ) . '</option>';
            }
            
            /*
             * Skins tab html.
             * efbl_skinsl_html filter can be used to customize skins tab html.
             */
            $efbl_skins_html = null;
            $efbl_skins_html .= sprintf(
                '<div id="efbl-skins" class="col s12 efbl_tab_c slideLeft">
					<div class="efbl_skin_head_wrap">
					<h5>%8$s</h5>
					<p>%9$s</p>
					</div>
					<a class="btn waves-effect efbl_create_skin waves-light" href="javascript:void(0);">%1$s <i class="material-icons left">add_circle_outline</i></a>

					<!-- New Skin Html Starts Here -->
					<div class="efbl_new_skin col s12">	
					  <form name="efbl_new_skin_details" id="efbl_new_skin_details">
					  <a class="waves-effect waves-light efbl_show_all_skins btn" href="javascript:void(0);">%10$s <i class="material-icons left">list</i></a>
					  	<div class="input-field">
					  		<i class="material-icons prefix">title</i>
			                <input id="efbl_skin_title" required name="efbl_skin_title" type="text">
			                <label for="efbl_skin_title" class="">%2$s</label>
			             </div>

			             <div class="input-field">
			                <i class="material-icons prefix">description</i>
			                <textarea id="efbl_skin_description" required name="efbl_skin_description" class="materialize-textarea"></textarea>
			                <label for="efbl_skin_description" class="">%3$s</label>
		              	</div>
		              	
		              	
		              	<div class="input-field">
			               
						<div class="mdl-textfield mdl-js-textfield efbl_skin_feat_img_wrap">
			                	 <i class="material-icons prefix">image</i>
										    <input class="mdl-textfield__input" type="text" id="efbl_skin_feat_img" placeholder="(optional)" value="" name="efbl_skin_feat_img">
										    <label class="mdl-textfield__label" for="efbl_skin_feat_img"></label>
							 
							<i class="btn waves-effect waves-light waves-input-wrapper">
							<input type="button" class="" value="%4$s" id="efbl_skin_feat_img_btn"/>
							<i class="material-icons left">file_upload</i>
							</i>
						  </div>		
		              	</div>
		              	
		              	<div class="input-field">
                            <i class="material-icons prefix">developer_board</i>
                               <select id="efbl_selected_layout" class="efbl_selected_layout" name="efbl_selected_layout" required>
                            	%11$s
                            </select>  
                            <label for="efbl_selected_layout" class="">%12$s</label>
                        </div>

		              	<div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                               <select id="efbl_account_selected" class="efbl_selected_account" name="efbl_selected_account" required>
                            ' . $efbl_page_options . '
                            </select>  
                            <label for="efbl_account_selected" class="">%7$s</label>
                        </div>
                        
                        <i class="btn waves-effect create_new_skin_fb_wrap waves-light waves-input-wrapper">
		              	<input type="submit" class="create_new_skin_fb" name="create_new_skin_fb" value="%5$s"/>
		              	<i class="material-icons right">add_circle_outline</i>
							</i>
					  </form>	
					</div> 
					<!-- New Skin Html Ends Here -->	

					<!-- Skin Html Starts Here -->
					<div class="efbl_all_skins row">	
					 	%6$s
					 </div> 
					<!-- Skin Html Ends Here -->


				</div>',
                /* Variables starts here. */
                __( 'Create New Skin', 'easy-facebook-likebox' ),
                __( 'Title (optional)', 'easy-facebook-likebox' ),
                __( 'Description (optional)', 'easy-facebook-likebox' ),
                __( 'Upload Skin Image', 'easy-facebook-likebox' ),
                __( 'Create', 'easy-facebook-likebox' ),
                $efbl_skin_html,
                __( 'Please select your Facebook page for preview. It will be for preview only, you can still use this skin for any page.', 'easy-facebook-likebox' ),
                __( 'Want to customize the layout of post feed?', 'easy-facebook-likebox' ),
                __( 'Skins allows you to totally customize the look and feel of your post feed in real-time using WordPress customizer. Skin holds all the design settings like feed layout (fullwidth, Grid, etc), show hide elements, page header, and single post colors, margins and a lot of cool settings separately. Questions? <a target="_blank" href="https://easysocialfeed.com/documentation/how-to-use-skins/">See this support document.</a>', 'easy-facebook-likebox' ),
                __( 'Show All Skins', 'easy-facebook-likebox' ),
                $layout_choices,
                __( 'Layout', 'easy-facebook-likebox' )
            );
            return $efbl_skins_html = apply_filters( 'efbl_skins_html', $efbl_skins_html );
        }
        
        /* efbl_popup_tab Method ends here. */
        /*
         * Holds Html For popup Tab.
         *
         */
        function efbl_cached_html()
        {
            /*
             * Cached tab html.
             * efbl_cached_html filter can be used to customize cache tab html.
             */
            $efbl_cached_html = null;
            $efbl_cached_html .= sprintf(
                '<div id="efbl-cached" class="col s12 efbl_tab_c slideLeft">
								<h5>%1$s</h5>
								<p>%2$s</p>
						     	%3$s
				</div>',
                /* Variables starts here. */
                __( 'Cached Pages', 'easy-facebook-likebox' ),
                __( 'Followings are the cached pages Feeds. Delete the existing one to refresh feeds.', 'easy-facebook-likebox' ),
                $this->efbl_transients()
            );
            return apply_filters( 'efbl_cached_html', $efbl_cached_html );
        }
        
        /* efbl_popup_tab Method ends here. */
        /*
         * Will return All Transients collection.
         */
        public function efbl_transients()
        {
            $returner = null;
            /*
             * Initializing global wpdb varibale.
             */
            global  $wpdb ;
            /*
             * Custom Query for getting all transients from wp
             */
            $efbl_trans_sql = "SELECT `option_name` AS `name`, `option_value` AS `value`\n\t\t            FROM  {$wpdb->options}\n\t\t            WHERE `option_name` LIKE '%transient_%'\n\t\t            ORDER BY `option_name`";
            /*
             * Getting results of the cahche.
             */
            $efbl_trans_results = $wpdb->get_results( $efbl_trans_sql );
            /*
             * Initializing empty array for efbl transients.
             */
            $efbl_trans_posts = array();
            $efbl_trans_bio = array();
            /*
             * Looping thorugh transients if got any results.
             */
            if ( $efbl_trans_results ) {
                foreach ( $efbl_trans_results as $efbl_trans_result ) {
                    /*
                     * Checking EFBL exists in transient slug then save that in efbl transient array.
                     */
                    if ( strpos( $efbl_trans_result->name, 'efbl' ) !== false && strpos( $efbl_trans_result->name, 'posts' ) !== false && strpos( $efbl_trans_result->name, 'timeout' ) == false ) {
                        $efbl_trans_posts[$efbl_trans_result->name] = $efbl_trans_result->value;
                    }
                    /*
                     * Checking EFBL exists in transient slug then save that in efbl transient array.
                     */
                    if ( strpos( $efbl_trans_result->name, 'efbl' ) !== false && strpos( $efbl_trans_result->name, 'bio' ) !== false && strpos( $efbl_trans_result->name, 'timeout' ) == false ) {
                        $efbl_trans_bio[$efbl_trans_result->name] = $efbl_trans_result->value;
                    }
                }
            }
            // echo '<pre>'; print_r($efbl_trans_bio);exit();
            /*
             * Bio Cached.
             */
            
            if ( $efbl_trans_bio ) {
                $returner .= '<ul class="collection with-header efbl_bio_collection">
							<li class="collection-header"><h5>' . __( 'Pages Bio', 'easy-facebook-likebox' ) . '</h5></li>';
                foreach ( $efbl_trans_bio as $key => $value ) {
                    $pieces = explode( '-', $key );
                    $trans_name = array_pop( $pieces );
                    $returner .= '<li class="collection-item ' . $key . '">
			    							<div>' . $trans_name . '
			    							<a href="javascript:void(0);" data-efbl_collection="efbl_bio_collection" data-efbl_trans="' . $key . '" class="secondary-content efbl_del_trans"><i class="material-icons">delete</i></a>
			    							</div>
			    						</li>';
                }
                $returner .= '</ul>';
            }
            
            /*
             * Posts Cached.
             */
            
            if ( $efbl_trans_posts ) {
                $returner .= '<ul class="collection with-header efbl_posts_collection">
							<li class="collection-header"><h5>' . __( 'Feeds', 'easy-facebook-likebox' ) . '</h5></li>';
                foreach ( $efbl_trans_posts as $key => $value ) {
                    $pieces = explode( '_', $key );
                    $page_name = array_pop( $pieces );
                    $second_pieces = explode( '-', $page_name );
                    $page_name = $second_pieces['0'];
                    $key = str_replace( ' ', '', $key );
                    $returner .= '<li class="collection-item ' . $key . '">
		    							<div>' . $page_name . '
		    							<a href="javascript:void(0);" data-efbl_trans="' . $key . '" class="secondary-content efbl_del_trans"><i class="material-icons">delete</i></a>
		    							</div>
		    						</li>';
                }
            } else {
                $returner .= '<blockquote>' . __( 'Whoops! nothing cached at the moment.', 'easy-facebook-likebox' ) . '</blockquote>';
            }
            
            /*
             * Returning it to back.
             */
            return $returner;
        }
        
        /* efbl_transients method ends here. */
        private function options( $option = null )
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            $fta_settings = wp_parse_args( $fta_settings['plugins']['facebook'], $this->efbl_default_options() );
            return $fta_settings[$option];
        }
        
        /**
         * Provides default values for the Social Options.
         */
        function efbl_default_options()
        {
            $defaults = array(
                'efbl_enable_popup'          => null,
                'efbl_popup_interval'        => null,
                'efbl_popup_width'           => null,
                'efbl_popup_height'          => null,
                'efbl_popup_shortcode'       => null,
                'efbl_enable_home_only'      => null,
                'efbl_enable_if_login'       => null,
                'efbl_enable_if_not_login'   => null,
                'efbl_do_not_show_again'     => null,
                'efbl_do_not_show_on_mobile' => null,
            );
            return apply_filters( 'efbl_default_options', $defaults );
        }
        
        // end sandbox_theme_default_social_options
        /*
         * Save efbl_save_popup_settings_cb option value
         */
        public function efbl_save_popup_settings_cb()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            /*
             * Getting the submitted value.
             */
            $efbl_option_value = $_POST['efbl_value'];
            /*
             * Getting the submitted value.
             */
            $efbl_option = sanitize_text_field( $_POST['efbl_option'] );
            /*
             * Getting the saved settings array.
             */
            $efbl_popup_settings = $fta_settings['plugins']['facebook'];
            /*
             * Updating the enable or disable value in array.
             */
            $efbl_popup_settings[$efbl_option] = $_POST['efbl_value'];
            $fta_settings['plugins']['facebook'] = $efbl_popup_settings;
            if ( wp_verify_nonce( $_POST['efbl_nonce'], 'efbl-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    /*
                     * Saving values in wp options table.
                     */
                    $efbl_saved = update_option( 'fta_settings', $fta_settings );
                }
            }
            /*
             * Checking if option is saved successfully.
             */
            
            if ( isset( $efbl_saved ) ) {
                /*
                 * Return success message and die.
                 */
                echo  wp_send_json_success( __( 'Updated', 'easy-facebook-likebox' ) ) ;
                die;
            } else {
                /*
                 * Return error message and die.
                 */
                echo  wp_send_json_error( __( 'Something went wrong! Refresh the page and try Again', 'easy-facebook-likebox' ) ) ;
                die;
            }
        
        }
        
        /* efbl_save_popup_settings_cb Method ends here. */
        /*
         * Delete Cache
         */
        public function efbl_del_trans_cb()
        {
            /*
             * Getting the option value value.
             */
            $value = sanitize_text_field( $_POST['efbl_option'] );
            /*
             * Cleaning the page ID.
             */
            $replaced_value = str_replace( '_transient_', '', $value );
            // echo wp_send_json_success($replaced_value);
            // 	die();
            if ( wp_verify_nonce( $_POST['efbl_nonce'], 'efbl-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    /*
                     * Deleting the cache.
                     */
                    $efbl_deleted_trans = delete_transient( $replaced_value );
                }
            }
            /*
             * Checking if option is saved successfully.
             */
            
            if ( isset( $efbl_deleted_trans ) ) {
                /*
                 * Return success message and die.
                 */
                echo  wp_send_json_success( array( __( 'Deleted', 'easy-facebook-likebox' ), $value ) ) ;
                die;
            } else {
                /*
                 * Return error message and die.
                 */
                echo  wp_send_json_error( __( 'Something went wrong! Refresh the page and try Again', 'easy-facebook-likebox' ) ) ;
                die;
            }
        
        }
        
        /* efbl_del_trans_cb Method ends here. */
        /* retrieves the attachment ID from the file URL */
        function efbl_get_image_id( $image_url )
        {
            /* Getting the global wpdb */
            global  $wpdb ;
            /* Getting attachment ID from custom query */
            $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $image_url ) );
            /* Returning back the attachment ID */
            return $attachment[0];
        }
        
        /* efbl_get_image_id Method ends here. */
        /*
         * efbl_create_skin on ajax.
         * Returns the customizer URL with skin ID. 
         * Create the skin for Facebook feeds 
         */
        function efbl_create_skin()
        {
            $FTA = new Feed_Them_All();
            $fta_settings = $FTA->fta_get_settings();
            /* Getting the form data. */
            $form_data = $_POST['form_data'];
            /* Getting the form data in strings. */
            parse_str( $form_data );
            /* Initalizing layout array. */
            $layout = array();
            /* Adding layout value to the array. */
            $layout['layout_option'] = sanitize_text_field( $efbl_selected_layout );
            // echo  wp_send_json_success( $efbl_selected_layout ) ;
            //            die;
            /* Arguments for default skin. */
            $efbl_new_skins = array(
                'post_title'   => sanitize_text_field( $efbl_skin_title ),
                'post_content' => sanitize_text_field( $efbl_skin_description ),
                'post_type'    => 'efbl_skins',
                'post_status'  => 'publish',
                'post_author'  => get_current_user_id(),
            );
            if ( wp_verify_nonce( $_POST['efbl_nonce'], 'efbl-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    $skin_id = wp_insert_post( $efbl_new_skins );
                }
            }
            /* If skin is created successfully. */
            
            if ( isset( $skin_id ) ) {
                /* Saving the layout value. */
                update_option( 'efbl_skin_' . $skin_id, $layout );
                $thumbnail_id = $FTA->fta_get_image_id( $efbl_skin_feat_img );
                set_post_thumbnail( $skin_id, $thumbnail_id );
                /* Getting the demo page id. */
                $page_id = $fta_settings['plugins']['facebook']['default_page_id'];
                /* Getting permalink from ID. */
                $page_permalink = get_permalink( $page_id );
                $customizer_url = 'customize.php';
                /* If permalink got successfully */
                if ( isset( $page_permalink ) ) {
                    /* Include permalinks for making*/
                    $customizer_url = add_query_arg( array(
                        'url'              => urlencode( $page_permalink ),
                        'autofocus[panel]' => 'efbl_customize_panel',
                        'efbl_skin_id'     => $skin_id,
                        'mif_customize'    => 'yes',
                        'efbl_account_id'  => $efbl_selected_account,
                    ), $customizer_url );
                }
                /* if condition ends here*/
                /* Sending back the values. */
                echo  wp_send_json_success( admin_url( $customizer_url ) ) ;
                die;
            } else {
                echo  wp_send_json_error( __( 'Something Went Wrong! Please try again.', $FTA->plug_slug ) ) ;
                die;
            }
            
            exit;
        }
        
        /* efbl_create_skin Method ends here. */
        /*
         * efbl_delete_skin on ajax.
         * Returns the Success or Error Message. 
         * Delete the skin
         */
        function efbl_delete_skin()
        {
            $FTA = new Feed_Them_All();
            /* Getting the skin ID. */
            $skin_id = intval( $_POST['skin_id'] );
            if ( wp_verify_nonce( $_POST['efbl_nonce'], 'efbl-ajax-nonce' ) ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                    $skin_deleted = wp_delete_post( $skin_id, true );
                }
            }
            /* If skin is deleted successfully. */
            
            if ( isset( $skin_deleted ) ) {
                $returned_arr = array( __( 'Skin is successfully deleted.', $FTA->plug_slug ), $skin_id );
                /* Sending back the values. */
                echo  wp_send_json_success( $returned_arr ) ;
                die;
            } else {
                echo  wp_send_json_error( __( 'Something Went Wrong! Please try again.', $FTA->plug_slug ) ) ;
                die;
            }
            
            exit;
        }
        
        /* efbl_delete_skin Method ends here. */
        /*
         * Holds all the efbl settings menu
         */
        function efbl_settings_menu()
        {
            /*
             * All the efbl settings menu
             */
            $efbl_settings_menu = array(
                'efbl-authentication' => array(
                'slug' => 'efbl-authentication',
                'name' => __( 'Authentication', 'easy-facebook-likebox' ),
                'icon' => 'apps',
            ),
                'efbl-general'        => array(
                'slug' => 'efbl-general',
                'name' => __( 'How to use it?', 'easy-facebook-likebox' ),
                'icon' => 'info_outline',
            ),
                'efbl-auto-popup'     => array(
                'slug' => 'efbl-auto-popup',
                'name' => __( 'Auto PopUp', 'easy-facebook-likebox' ),
                'icon' => 'featured_play_list',
            ),
                'efbl-skins'          => array(
                'slug' => 'efbl-skins',
                'name' => __( 'Customize (skins)', 'easy-facebook-likebox' ),
                'icon' => 'web',
            ),
                'efbl-cached'         => array(
                'slug' => 'efbl-cached',
                'name' => __( 'Clear Cache', 'easy-facebook-likebox' ),
                'icon' => 'cached',
            ),
            );
            /*
             * Filters to add more menus
             */
            $efbl_settings_menu = apply_filters( 'efbl_settings_menu', $efbl_settings_menu );
            if ( $efbl_settings_menu ) {
                $i = null;
            }
            $returner = null;
            foreach ( $efbl_settings_menu as $efbl_setting_menu ) {
                $i++;
                if ( $i == 1 ) {
                    $class = 'active';
                }
                $returner .= sprintf(
                    '<li class="tab col s3">
					<a class="%4$s" href="#%1$s">
					<i class="material-icons dp48">%3$s</i> <span>%2$s</span>
					</a>
					</li>',
                    /* Variables starts here. */
                    $efbl_setting_menu['slug'],
                    $efbl_setting_menu['name'],
                    $efbl_setting_menu['icon'],
                    $class
                );
            }
            return $returner;
        }
        
        /* efbl_settings_menu Method ends here. */
        /*
         * efbl_create_skin_url on ajax.
         * Returns the URL. 
         */
        function efbl_create_skin_url()
        {
            /* Getting the skin ID. */
            $skin_id = intval( $_POST['skin_id'] );
            $selectedVal = intval( $_POST['selectedVal'] );
            $page_id = intval( $_POST['page_id'] );
            $page_permalink = get_permalink( $page_id );
            
            if ( wp_verify_nonce( $_POST['efbl_nonce'], 'efbl-ajax-nonce' ) ) {
                $customizer_url = admin_url( 'customize.php' );
                /* If permalink got successfully */
                if ( isset( $page_permalink ) ) {
                    /* Include permalinks for making*/
                    $customizer_url = add_query_arg( array(
                        'url'              => urlencode( $page_permalink ),
                        'autofocus[panel]' => 'efbl_customize_panel',
                        'efbl_skin_id'     => $skin_id,
                        'mif_customize'    => 'yes',
                        'efbl_account_id'  => $selectedVal,
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
        
        function efbl_footer()
        {
            echo  '<style>.toplevel_page_mif.wp-has-submenu ul li:last-child, .plugins-php [data-slug="my-instagram-feed"] .upgrade{
    display: none;
}</style>' ;
            echo  "<script>function EFBLremoveURLParameter(url, parameter) {\r\n    //prefer to use l.search if you have a location/link object\r\n    var urlparts= url.split('?');   \r\n    if (urlparts.length>=2) {\r\n\r\n        var prefix= encodeURIComponent(parameter)+'=';\r\n        var pars= urlparts[1].split(/[&;]/g);\r\n\r\n        //reverse iteration as may be destructive\r\n        for (var i= pars.length; i-- > 0;) {    \r\n            //idiom for string.startsWith\r\n            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  \r\n                pars.splice(i, 1);\r\n            }\r\n        }\r\n\r\n        url= urlparts[0]+'?'+pars.join('&');\r\n        return url;\r\n    } else {\r\n        return url;\r\n    }\r\n} </script>" ;
        }
    
    }
    $Easy_Facebook_Likebox_Admin = new Easy_Facebook_Likebox_Admin();
}
