<?php if ( ! defined( 'ABSPATH' ) ) {exit;} // Exit if accessed directly.

/**
 * Automatic plugins update
 * 
 * @author Codevz
 * @link http://codevz.com/
 */

class Codevz_Plugin_Update {

	private static $instance = null;
	private static $plugins = [];
	private static $api = 'https://xtratheme.com/api/';

	public function __construct() {

		self::$plugins = [
			'codevz-plus' 	=> 'Codevz Plus', 
			'js_composer' 	=> 'WPBakery Page Builder', 
			'revslider' 	=> 'Revolution Slider'
		];

		// Remove premium plugins notifications
		remove_filter( 'upgrader_pre_download', [ 'Vc_Updater', 'preUpgradeFilter' ], 99999 );
		remove_filter( 'pre_set_site_transient_update_plugins', [ 'Vc_Updating_Manager', 'check_update' ], 99999 );
		remove_filter( 'in_plugin_update_message-js_composer/js_composer.php', [ 'Vc_Updating_Manager', 'addUpgradeMessageLink' ], 99999 );
		remove_filter( 'pre_set_site_transient_update_plugins', [ 'RevSliderUpdate', 'set_update_transient' ], 99999 );

		// Disable WPB notification
		//global $vc_manager;
		//@$vc_manager->disableUpdater = false;

		// Inform WordPress version of plugins
		add_filter( 'pre_set_site_transient_update_plugins', [ $this, 'transient' ], 99999 );

		// Set plugin changelog
		add_filter( 'plugins_api', [ $this, 'changelog' ], 99999, 3 );

		// Inform WordPress of plugins zip files
		add_filter( 'upgrader_pre_download', [ $this, 'download' ], 99999, 3 );
	}

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Inform WordPress for new vesion of plugins
	 */
	public function transient( $transient ) {

		// Get new versions
		$versions = get_transient( 'codevz_versions' );
		if ( empty( $versions ) ) {
			$request = wp_remote_get( self::$api . 'versions.json' );
			if ( ! is_wp_error( $request ) ) {
				$body = wp_remote_retrieve_body( $request );
				$versions = json_decode( $body, true );
				set_transient( 'codevz_versions', $versions, 60 );
			}
		}

		// There is no new versions
		if ( ! isset( $versions['plugins'] ) ) {
			return $transient;
		}

		// Get changelog
		$request = wp_remote_get( self::$api . 'changelog.txt' );
		if ( ! is_wp_error( $request ) ) {
			$changelog = wp_remote_retrieve_body( $request );
			update_option( 'codevz_changelog', $changelog );
		}

		// Fix when there is no any plugins
		if ( empty( $transient->response ) ) {
			$transient->response = [];
		}

		// Get current plugins versions
		$plugins = function_exists( 'get_plugins' ) ? get_plugins() : [];

		// Activation
		$activate = is_array( get_option( 'codevz_theme_activation' ) ) ? 1 : 0;

		// Inform WordPress about new plugins versions
		foreach( self::$plugins as $slug => $title ) {
			if ( class_exists( 'stdClass' ) && isset( $versions['plugins'][ $slug ]['version'] ) ) {

				// Activation check
				if ( function_exists( 'is_multisite' ) && is_multisite() ) {
					// Multisite check

				} else if ( ! $activate && ( $title === 'WPBakery Page Builder' || $title === 'Revolution Slider' ) ) {
					continue;
				}
				
				// Get current plugin version
				$current_ver = isset( $plugins[ $slug . '/' . $slug . '.php' ]['Version'] ) ? $plugins[ $slug . '/' . $slug . '.php' ]['Version'] : '999';
				$new_version = $versions['plugins'][ $slug ]['version'];
				
				// Compare current and new plugin version
				if ( $current_ver != $new_version && version_compare( $current_ver, $new_version, '<' ) ) {

					$obj 				= new stdClass();
					$obj->slug 			= $slug;
					$obj->name 			= $title;
					$obj->new_version 	= $versions['plugins'][ $slug ]['version'];
					$obj->url 			= '';
					$obj->package 		= self::$api . $slug . '.zip';

					$transient->response[ $slug . '/' . $slug . '.php' ] = $obj;

				} else if ( isset( $transient->response[ $slug . '/' . $slug . '.php' ] ) ) {
					unset( $transient->response[ $slug . '/' . $slug . '.php' ] );
				}
			}
		}

		return $transient;
	}

	/**
	 * Set change log for plugins
	 */
	public function changelog( $false, $action, $arg ) {

		// Create new information for codevz plus
		if ( isset( $arg->slug ) && $arg->slug === 'codevz-plus' ) {

			$obj 				= new stdClass();
			$obj->author 		= 'Codevz';
			$obj->name 			= 'Codevz Plus';
			$obj->slug 			= 'codevz-plus';
			$obj->plugin_name 	= 'codevz-plus';
			$obj->description 	= '';
			$obj->sections 		= [ 'changelog' => get_option( 'codevz_changelog' ) ];

			return $obj;
		}

		return $false;
	}

	/**
	 * Inform WordPress for plugins zip files
	 */
	public function download( $reply, $package, $updater ) {

		foreach( self::$plugins as $slug => $title ) {
			if ( Codevz_Plus::contains( $package, $slug ) ) {
				return false;
			}
		}

		return $reply;
	}

}

// Run automatic plugin updates
Codevz_Plugin_Update::instance();