<?php
/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
		
/*
* Define Module search class if not exists alreadys
*/
if(!class_exists('ESPF_MODULE_SEARCH')):

	/**
	 * Holds all the modules seach functionality
	 */
	class ESPF_MODULE_SEARCH{

		/**
		 * Includes search card in search results if user search module which ESPF already has
		 * @since     5.1.7
		 */
		function __construct(){	
			
			/**
			 * Check current screen
			 */
			add_action( 'current_screen', array( $this, 'espf_search_start' ) );
		}

		/*
	     * espf_search_start will enqueue style and js files.
	     * All search realeated hooks and filters
	     * $screen will contain the current screen name.
	     */
	    public function espf_search_start( $screen ){

	    	/**
			 * Check if plugin search page and first page
			 */
	      	if ( 'plugin-install' === $screen->base && ( ! isset( $_GET['paged'] ) || 1 == $_GET['paged'] ) ) :
	      		add_filter( 'plugins_api_result', array( $this, 'espf_module_card' ), 10, 3 );
	      		add_filter( 'plugin_install_action_links', array( $this, 'efpf_module_related_links' ), 10, 2 );
	      		add_action( 'admin_enqueue_scripts', array( $this, 'espf_search_scripts' ) );
	      		add_filter( 'self_admin_url', array( $this, 'plugin_details' ) );
	      	endif;		

	     } /* espf_search_start Method ends here. */  

	     public function plugin_details( $url ) {
		return false !== stripos( $url, 'tab=plugin-information&amp;plugin=easy-facebook-likebox-search')
			? 'plugin-install.php?tab=plugin-information&amp;plugin=easy-facebook-likebox&amp;TB_iframe=true&amp;width=600&amp;height=550'
			: $url;
	}

	      /*
	     * espf_search_scripts will enqueue style and js files for search.
	     */      
	     public function espf_search_scripts() {

	     	/*
         	* espf-search-results Css.
         	*/
        	wp_enqueue_style( 'espf-search-results', FTA_PLUGIN_URL . 'assets/css/espf-search-results.css' );

			 /*
	         * espf-search-results JS
	         */
	        wp_enqueue_script(
	            'espf-search-results-js',
	            FTA_PLUGIN_URL . 'assets/js/espf-search-results.js',
	            array( 'jquery' ),
	            true
	        );

			wp_localize_script(
				'espf-search-results-js',
				'espf_search',
				array('poweredBy'      => esc_html__( 'by Easy Social Post Feed (installed)', 'easy-facebook-likebox' ),
					'suggestion_content'         => esc_html__(
						'This suggestion was made by Easy Social Post Feed, the social post feed plugin already installed on your site.',
						'easy-facebook-likebox'
					),
					'hideText'       => esc_html__( 'Hide this suggestion', 'easy-facebook-likebox' ),
				)
			);
		}/* espf_search_scripts Method ends here. */  

	     /*
	     * efpf_module_related_links will hold the sugegstion card.
	     */
	    public function efpf_module_related_links( $links, $plugin){

	    	if ( 'easy-facebook-likebox-search' !== $plugin['slug'] ) return $links;

	    	remove_filter( 'self_admin_url', array( $this, 'plugin_details' ) );

	    	$links = array();

	    	$links[] = '<a
				id="plugin-select-settings"
				class="espf-search-btn button"
				href="'.$plugin['btn_url'].'"
				>' . esc_html__( 'Learn More', 'easy-facebook-likebox' ) . '</a>';

			// Dismiss link
			$links[] = '<a
			class="espf-search-hide-btn">' . esc_html__( 'Hide this suggestion', 'easy-facebook-likebox' ) . '</a>';

			return $links;	
	    
	     } /* efpf_module_related_links Method ends here. */ 


	     /*
	     * espf_module_card will hold the sugegstion card.
	     */
	    public function espf_module_card( $result, $action, $args){

	    	if (!empty( $args->search ) ):

	    	// If words are more than 3
			if ( strlen( $args->search ) >= 3 ):

				$Feed_Them_All = new Feed_Them_All();

				$version = $Feed_Them_All->version;

				$espf_plugin_data = $this->espf_plugin_data();

				$espf_plugin_data = (array) $espf_plugin_data;

				$espf_search_data_arr = $this->espf_search_data($args->search);

				if(isset($espf_search_data_arr) && !empty($espf_search_data_arr )):

					$overrides = array(
						'plugin-search' => true,
						'name' => sprintf(   
							esc_html_x( 'ESPF: %s', 'Easy Social Post Feed: Module Name', 'easy-facebook-likebox' ),
							$args->search
						),
						'short_description' => $espf_search_data_arr['description'],
						'btn_url' => $espf_search_data_arr['btn_url'],
						'requires_connection' => true,
						'slug'    => 'easy-facebook-likebox-search',
						'version' => $version
					);

				$search_data = wp_parse_args($overrides, $espf_plugin_data);

				
				// Add it to the top of the list
				$result->plugins = array_filter( $result->plugins, array( $this, 'espf_remove_main_card' ) );

				array_unshift( $result->plugins, $search_data );

				// echo '<pre>';print_r($result->plugins);exit();

				endif;

			endif;/* Words length. */  

			endif;/* Not empty search words ends here. */  

			return $result;
	    
	     } /* espf_module_card Method ends here. */ 

	  
		/**
		 * Get the plugin repo's data for ESPF.
		 */
		public static function espf_plugin_data() {
			$data = get_transient( 'espf_plugin_info' );

			if ( false === $data || is_wp_error( $data ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
				$data = plugins_api( 'plugin_information', array(
					'slug' => 'easy-facebook-likebox',
					'is_ssl' => is_ssl(),
					'fields' => array(
						'banners' => true,
						'reviews' => true,
						'active_installs' => true,
						'versions' => false,
						'sections' => false,
						'icons' => true
					),
				) );
				set_transient( 'espf_plugin_info', $data, DAY_IN_SECONDS );
			}

			return $data;

		}/* espf_plugin_data Method ends here. */ 

		/**
		 * Holds content for each search words and link as well
		 */
		public function espf_search_data($word) {

			$espf_search_data_arr =  array( 'Facebook Page Plugin' => array(
											'title' => 'Facebook Page Plugin',
											'description' => __('Display a Facebook Page Plugin (previously Facebook Like Box) to attract visitors and gain likes from your own website.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox&sub_tab=efbl-likebox-use#efbl-general')
											),
											'facebook page plugin' => array(
											'title' => 'facebook page plugin',
											'description' => __('Display a Facebook Page Plugin (previously Facebook Like Box) to attract visitors and gain likes from your own website.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox&sub_tab=efbl-likebox-use#efbl-general')
											),
											'Facebook Like Box' => array(
											'title' => 'Facebook Like Box',
											'description' => __('Display a Facebook Page Plugin (previously Facebook Like Box) to attract visitors and gain likes from your own website.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox&sub_tab=efbl-likebox-use#efbl-general')
											),
											'facebook like box' => array(
											'title' => 'facebook like box',
											'description' => __('Display a Facebook Page Plugin (previously Facebook Like Box) to attract visitors and gain likes from your own website.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox&sub_tab=efbl-likebox-use#efbl-general')
											),
											'custom facebook feed' => array(
											'title' => 'custom facebook feed',
											'description' => __('Display a customizable, responsive and SEO friendly feed of your Facebook posts, images, albums, videos, status, links, and events on your site.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox#efbl-general')
											),
											'Custom Facebook Feed' => array(
											'title' => 'Custom Facebook Feed',
											'description' => __('Display a customizable, responsive and SEO friendly feed of your Facebook posts, images, albums, videos, status, links, and events on your site.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox#efbl-general')
											),
											'Facebook Feed' => array(
											'title' => 'Facebook Feed',
											'description' => __('Display a customizable, responsive and SEO friendly feed of your Facebook posts, images, albums, videos, status, links, and events on your site.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox#efbl-general')
											),
											'facebook feed' => array(
											'title' => 'facebook feed',
											'description' => __('Display a customizable, responsive and SEO friendly feed of your Facebook posts, images, albums, videos, status, links, and events on your site.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox#efbl-general')
											),
											'Custom Instagram Feed' => array(
											'title' => 'Custom Instagram Feed',
											'description' => __('Display your stunning photos and videos from your Instagram account on your site. It’s mobile-friendly, highly customizable, SEO friendly and has multiple layouts.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=mif#mif-shortcode')
											),
											'custom instagram feed' => array(
											'title' => 'custom instagram feed',
											'description' => __('Display your stunning photos and videos from your Instagram account on your site. It’s mobile-friendly, highly customizable, SEO friendly and has multiple layouts.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=mif#mif-shortcode')
											),
											'Instagram Feed' => array(
											'title' => 'Instagram Feed',
											'description' => __('Display your stunning photos and videos from your Instagram account on your site. It’s mobile-friendly, highly customizable, SEO friendly and has multiple layouts.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=mif#mif-shortcode')
											),
											'instagram feed' => array(
											'title' => 'instagram feed',
											'description' => __('Display your stunning photos and videos from your Instagram account on your site. It’s mobile-friendly, highly customizable, SEO friendly and has multiple layouts.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=mif#mif-shortcode')
											),
											'PopUp' => array(
											'title' => 'PopUp',
											'description' => __('Display anything in a popup to engage and convert your visitors into subscribers and customers.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox#efbl-auto-popup')
											),
											'popup' => array(
											'title' => 'popup',
											'description' => __('Display anything in a popup to engage and convert your visitors into subscribers and customers.',
												'easy-facebook-likebox'),
											'btn_url' => admin_url('admin.php?page=easy-facebook-likebox#efbl-auto-popup')
											)
							);
		
		return $espf_search_data_arr[$word];
		}/* espf_search_data Method ends here. */ 
		
		function espf_remove_main_card( $plugin ) {
		return ! in_array( $plugin['slug'], array( 'easy-facebook-likebox' ), true );
		}

	}/* ESPF_MODULE_SEARCH Class ends here. */ 

/**
* Show module search by default
*/
$espf_show_search_results = true;

/**
* Check if disbale filter hooked
*/
$espf_show_search_results = apply_filters( 'espf_show_module_search', $espf_show_search_results );

/**
* Don't show module search results if it's set to false
*/
if($espf_show_search_results) $ESPF_MODULE_SEARCH = new ESPF_MODULE_SEARCH();

endif;