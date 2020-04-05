<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of schema-editor
 *
 * @author Mark van Berkel
 */
class SchemaFront
{
    public $Settings;

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct()
    {
		$this->Settings = get_option( 'schema_option_name' );

		add_action( 'plugins_loaded', array( $this, 'hook_plugins_loaded' ) );
		add_action( 'init', array( $this, 'HandleCache' ) );
		add_action( 'rest_api_init', array( $this, 'hook_rest_api_init' ) );

		if ( ! empty( $this->Settings['SchemaLinkedOpenData'] ) ) {
			add_action( 'wp', array( $this, 'linked_open_data_output' ), 10, 1 );
			add_action( 'wp_head', array( $this, 'linked_open_data_link_tag' ) );
		}

		// Do not change priority of following hooks as it breaks hook chaining and functions like wp_localize_script
		if ( ! empty( $this->Settings['SchemaDefaultLocation'] ) && $this->Settings['SchemaDefaultLocation'] == 'Footer' )
		{
			add_action( 'wp_footer', array( $this, 'hunch_schema_add' ) );
		}
		else
		{
			add_action( 'wp_head', array( $this, 'hunch_schema_add' ) );
		}

		if ( ! empty( $this->Settings['SchemaRemoveMicrodata'] ) )
		{
			add_action( 'template_redirect', array( $this, 'TemplateRedirect' ), 0 );
		}

		if ( ! empty( $this->Settings['ToolbarShowTestSchema'] ) )
		{
			add_action( 'admin_bar_menu', array( $this, 'AdminBarMenu' ), 999 );
		}

		// Priority 15 ensures it runs after Genesis itself has setup.
		add_action( 'genesis_setup', array( $this, 'GenesisSetup' ), 15 );

		add_action( 'amp_post_template_head', array( $this, 'AMPPostTemplateHead' ) );
		add_filter( 'amp_post_template_metadata', '__return_false', 100 );
		add_filter( 'amp_schemaorg_metadata', '__return_false', 100 );
    }


	public function hook_plugins_loaded() {
  		if ( defined( 'WPSEO_VERSION' ) ) {
			if ( version_compare( WPSEO_VERSION, '11.0', '<' ) ) {
				// Default enabled
				if ( ! isset( $this->Settings['SchemaRemoveWPSEOMarkup'] ) || $this->Settings['SchemaRemoveWPSEOMarkup'] == 1 ) {
					add_filter( 'wpseo_json_ld_output', array( $this, 'RemoveWPSEOJsonLD' ), 10, 2 );
				}

				// Disable WPSEO Breadcrumb markup if ours is enabled
				if ( ! empty( $this->Settings['SchemaBreadcrumb'] ) ) {
					add_filter( 'wpseo_json_ld_output', array( $this, 'RemoveWPSEOJsonLDBreadcrumb' ), 10, 2 );
				}
			} else {
				// Default enabled
				if ( ! isset( $this->Settings['SchemaRemoveWPSEOMarkup'] ) || $this->Settings['SchemaRemoveWPSEOMarkup'] == 1 ) {
					add_filter( 'wpseo_schema_graph_pieces', array( $this, 'wpseo_remove_schema' ), 10, 2 );
				}
			}
		}
	}


	public function HandleCache()
	{
		if ( isset( $_GET['Action'], $_GET['URL'] ) && $_GET['Action'] == 'HSDeleteMarkupCache' )
		{
			delete_transient( 'HunchSchema-Markup-' . md5( $_GET['URL'] ) );

			header( 'HTTP/1.0 202 Accepted', true, 202 );

			exit;
		}
	}


	public function hook_rest_api_init() {
		register_rest_route( 'hunch_schema', '/cache/', array(
			array( 'methods' => 'GET', 'callback' => array( $this, 'rest_api_cache' ) ),
			array( 'methods' => 'POST', 'callback' => array( $this, 'rest_api_cache_modify' ) ),
		) );
	}


	public function rest_api_cache( $request ) {
		return new WP_REST_Response( array( 'status' => 'error', 'message' => 'Please use POST method to send data' ), 405 );
	}


	public function rest_api_cache_modify( $request ) {
		// Log request when debug is on
		if ( ! empty( $this->Settings['Debug'] ) ) {
			$upload_dir_param			= wp_upload_dir( null, false );
			$rest_api_cache_log_file	= $upload_dir_param['basedir'] . DIRECTORY_SEPARATOR . 'schema_app_rest_api_cache_log.txt';

			file_put_contents( $rest_api_cache_log_file, "\n\n\nTime: " . date( 'c' ) . "\nBody:\n" . $request->get_body() . "\n", FILE_APPEND );
		}

		$request_data = json_decode( $request->get_body() );

		if ( empty( $request->get_body() ) || empty( $request_data ) ) {
			if ( ! empty( $this->Settings['Debug'] ) ) {
				file_put_contents( $rest_api_cache_log_file, 'Result: Invalid JSON data', FILE_APPEND );
			}

			return new WP_REST_Response( array( 'status' => 'error', 'message' => 'Invalid JSON data' ), 400 );
		} elseif ( empty( $request_data->{"@type"} ) || empty( $request_data->{"@id"} ) || empty( $request_data->{"@graph"} ) ) {
			if ( ! empty( $this->Settings['Debug'] ) ) {
				file_put_contents( $rest_api_cache_log_file, 'Result: Invalid @type, @id or @graph property', FILE_APPEND );
			}

			return new WP_REST_Response( array( 'status' => 'error', 'message' => 'Invalid @type, @id or @graph property' ), 400 );
		} else {
			if ( stripos( $request_data->{"@id"}, site_url() ) === false ) {
				if ( ! empty( $this->Settings['Debug'] ) ) {
					file_put_contents( $rest_api_cache_log_file, 'Result: Invalid @id property, url does not match', FILE_APPEND );
				}

				return new WP_REST_Response( array( 'status' => 'error', 'message' => 'Invalid @id property, url does not match' ), 400 );
			}

			if ( stripos( $request_data->{"@id"}, '#' ) !== false ) {
				$permalink = strstr( $request_data->{"@id"}, '#', true );
			} else {
				$permalink = $request_data->{"@id"};
			}

			$transient_id = 'HunchSchema-Markup-' . md5( $permalink );

			if ( ! empty( $this->Settings['Debug'] ) ) {
				file_put_contents( $rest_api_cache_log_file, sprintf( "Permalink: %s\nTransient: %s\n", $permalink, $transient_id ), FILE_APPEND );
			}

			switch ( $request_data->{"@type"} ) {
				case 'EntityCreated':
				case 'EntityUpdated':
					// First delete then set; set method only updates expiry time if transient already exists
					delete_transient( $transient_id );
					set_transient( $transient_id, json_encode( $request_data->{"@graph"} ), 86400 );

					if ( ! empty( $this->Settings['Debug'] ) ) {
						file_put_contents( $rest_api_cache_log_file, 'Result: Cache updated', FILE_APPEND );
					}

					return new WP_REST_Response( array( 'status' => 'ok', 'message' => 'Cache updated' ), 200 );
					break;
				case 'EntityDeleted':
					delete_transient( $transient_id );

					if ( ! empty( $this->Settings['Debug'] ) ) {
						file_put_contents( $rest_api_cache_log_file, 'Result: Cache deleted', FILE_APPEND );
					}

					return new WP_REST_Response( array( 'status' => 'ok', 'message' => 'Cache deleted' ), 200 );
					break;
				default:
					if ( ! empty( $this->Settings['Debug'] ) ) {
						file_put_contents( $rest_api_cache_log_file, 'Result: Invalid @type property', FILE_APPEND );
					}

					return new WP_REST_Response( array( 'status' => 'error', 'message' => 'Invalid @type property' ), 400 );
			}
		}
	}


    /**
     * hunch_schema_add is called to lookup schema.org or add default markup 
     */
    public function hunch_schema_add( $JSON = false )
    {
		global $post;

		if ( empty( $post ) )
		{
			return;
		}

		$DisableMarkup = is_singular() ? get_post_meta( $post->ID, '_HunchSchemaDisableMarkup', true ) : false;

		if ( ! $DisableMarkup )
		{
			$PostType = get_post_type();
			$SchemaThing = HunchSchema_Thing::factory( $PostType );

			$SchemaServer = new SchemaServer();
			$SchemaMarkup = $SchemaServer->getResource();

			$JSONSchemaMarkup = array();
			$SchemaMarkupType = '';

			// If Custom schema markup is empty or not found
			if ( $SchemaMarkup === "" || $SchemaMarkup === false ) {

				$SchemaMarkupCustom = get_post_meta( $post->ID, '_HunchSchemaMarkup', true );

				if ( $SchemaMarkupCustom )
				{
					$SchemaMarkupType = 'Custom';
					$SchemaMarkup = $SchemaMarkupCustom;
				}
				else if ( isset( $SchemaThing ) )
				{
					$SchemaMarkupType = 'Default';
					$SchemaMarkup = $SchemaThing->getResource();
				}
			}
			else
			{
				$SchemaMarkupType = 'App';
			}

			do_action( 'hunch_schema_markup_render', $SchemaMarkup, $SchemaMarkupType, $post, $PostType, $JSON );

			$SchemaMarkup = apply_filters( 'hunch_schema_markup', $SchemaMarkup, $SchemaMarkupType, $post, $PostType );

			if ( $SchemaMarkup !== "" && ! is_null( $SchemaMarkup ) )
			{
				if ( $JSON )
				{
					$JSONSchemaMarkup[] = json_decode( $SchemaMarkup );
				}
				else
				{
					printf( '<script type="application/ld+json" data-schema="%s-%s-%s">%s</script>' . "\n", $post->ID, $PostType, $SchemaMarkupType, $SchemaMarkup );
				}
			}

			if ( ! empty( $this->Settings['SchemaWebSite'] ) && is_front_page() )
			{
				$SchemaMarkupWebSite = apply_filters( 'hunch_schema_markup_website', $SchemaThing->getWebSite(), $PostType );

				if ( ! empty( $SchemaMarkupWebSite ) )
				{
					if ( $JSON )
					{
						$JSONSchemaMarkup[] = json_decode( $SchemaMarkupWebSite );
					}
					else
					{
						printf( '<script type="application/ld+json" data-schema="Website">%s</script>' . "\n", $SchemaMarkupWebSite );
					}
				}
			}

			if ( ! empty( $this->Settings['SchemaBreadcrumb'] ) && method_exists( $SchemaThing, 'getBreadcrumb' ) )
			{
				$SchemaMarkupBreadcrumb = apply_filters( 'hunch_schema_markup_breadcrumb', $SchemaThing->getBreadcrumb(), $PostType );

				if ( ! empty( $SchemaMarkupBreadcrumb ) )
				{
					if ( $JSON )
					{
						$JSONSchemaMarkup[] = json_decode( $SchemaMarkupBreadcrumb );
					}
					else
					{
						printf( '<script type="application/ld+json" data-schema="Breadcrumb">%s</script>' . "\n", $SchemaMarkupBreadcrumb );
					}
				}
			}

			if ( $JSON && ! empty( $JSONSchemaMarkup ) )
			{
				if ( count( $JSONSchemaMarkup ) == 1 )
				{
					$JSONSchemaMarkup = reset( $JSONSchemaMarkup );

					print json_encode( $JSONSchemaMarkup );
				}
				else
				{
					print json_encode( $JSONSchemaMarkup );
				}
			}
		}     
    }


	public function linked_open_data_output( $wp ) {
		$request_headers = array();

		if ( function_exists( 'apache_request_headers' ) ) {	
			$request_headers = apache_request_headers();
		}

		if (  ( ! empty( $_GET['format'] ) && $_GET['format'] == 'application/ld json' )  ||  ( ! empty( $request_headers['Accept'] ) && $request_headers['Accept'] == 'application/ld+json' )  ) {
			$this->hunch_schema_add( true );

			exit;
		}
	}


	public function linked_open_data_link_tag() {
		printf( '<link rel="alternate" type="application/ld+json" href="%s?format=application/ld+json" title="Structured Descriptor Document (JSON-LD format)">', HunchSchema_Thing::getPermalink() );
	}


	public function TemplateRedirect()
	{
		ob_start( array( $this, 'RemoveMicrodata' ) );
	}


	public function RemoveMicrodata( $Buffer )
	{
		$Buffer = preg_replace( '/[\s\n]*<(link|meta)(\s|[^>]+\s)itemprop=[\'"][^\'"]*[\'"][^>]*>[\s\n]*/imS', '', $Buffer );

		for ( $I = 1; $I <= 6; $I++ )
		{
			$Buffer = preg_replace( '/(<[^>]*)\sitem(scope|type|prop)(=[\'"][^\'"]*[\'"])?([^>]*>)/imS', '$1$4', $Buffer );
		}

		return $Buffer;
	}


	public function RemoveWPSEOJsonLD( $data, $context )
	{
		if ( in_array( $context, array( 'website', 'company', 'person', 'breadcrumb' ) ) )
		{
			return array();
		}

		return $data;
	}


	public function RemoveWPSEOJsonLDBreadcrumb( $data, $context )
	{
		if ( $context == 'breadcrumb' )
		{
			return array();
		}

		return $data;
	}


	public function wpseo_remove_schema( $pieces, $context ) {
		$pieces = array();

		return $pieces;
	}


	public function AdminBarMenu( $WPAdminBar )
	{
		$Permalink = HunchSchema_Thing::getPermalink();

		if ( $Permalink )
		{
			$Node = array
			(
				'id'    => 'Hunch-Schema',
				'title' => 'Test Schema',
				'href'  => 'https://developers.google.com/structured-data/testing-tool?url=' . urlencode( $Permalink ),
				'meta'  => array
				(
					'class' => 'Hunch-Schema',
					'target' => '_blank',
				),
			);

			$WPAdminBar->add_node( $Node );
		}
	}


	public function GenesisSetup()
	{
		$Attributes = get_option( 'schema_option_name_genesis' );

		if ( $Attributes )
		{
			foreach ( $Attributes as $Key => $Value )
			{
				add_filter( 'genesis_attr_' . $Key, array( $this, 'GenesisAttribute' ), 20 );
			}
		}
	}


	public function GenesisAttribute( $Attribute )
	{
		$Attribute['itemtype'] = '';
		$Attribute['itemprop'] = '';
		$Attribute['itemscope'] = '';

		return $Attribute;
	}


	public function AMPPostTemplateHead( $Template )
	{
		$this->hunch_schema_add( false );
	}

}