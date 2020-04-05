<?php if ( ! defined( 'ABSPATH' ) ) {exit;} // Exit if accessed directly.

/**
 * Demo importer
 * 
 * @author Codevz
 * @link http://codevz.com
 */

class Codevz_Demo_Importer {
	
	public function __construct() {
		add_filter( 'init', array( __CLASS__, 'options' ), 99 );
		add_action( 'wp_ajax_codevz_import_process', array( __CLASS__, 'import_process' ) );

		add_action( 'wp_ajax_importer_modal_content', array( __CLASS__, 'importer_modal_content' ) );
		add_action( 'customize_controls_print_footer_scripts', array( __CLASS__, 'importer_modal_footer' ) );
		add_action( 'admin_footer', array( __CLASS__, 'importer_modal_footer' ) );
		add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'importer_js' ) );
		add_action( 'admin_init', array( __CLASS__, 'importer_js' ) );
	}
	
	public static function importer_js() {
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_script( 'jquery-ui-progressbar' );
		wp_localize_script( 'jquery-ui-progressbar', 'aiL10n', array(
		    'emptyInput' 	=> esc_html__( 'Please select a file.', 'codevz' ),
		    'noAttachments' => esc_html__( 'There were no attachment files found in the import file.', 'codevz' ),
			'parsing' 		=> esc_html__( 'Parsing the file.', 'codevz' ),
			'importing' 	=> esc_html__( 'Importing file ', 'codevz' ),
			'progress' 		=> esc_html__( 'Overall progress: ', 'codevz' ),
			'retrying' 		=> esc_html__( 'An error occured. In 5 seconds, retrying file ', 'codevz' ),
			'done' 			=> esc_html__( 'Demo successfully importerd', 'codevz' ),
			'ajaxFail' 		=> esc_html__( 'There was an error connecting to the server.', 'codevz' ),
			'pbAjaxFail' 	=> esc_html__( 'The program could not run. Check the error log below or your JavaScript console for more information', 'codevz' ),
			'fatalUpload' 	=> esc_html__( 'There was a fatal error. Check the last entry in the error log below.', 'codevz' )
		) );
		wp_localize_script( 'jquery-ui-progressbar', 'aiSecurity', array(
			'nonce' => wp_create_nonce( 'import-attachment-plugin' )
		) );
	}

	/**
	 * decode theme options string into array
	 * 
	 * @return array
	 */
	public static function decode_options( $string ) {
		return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
	}

	/**
	 * Demo Importer Modal
	 * 
	 * @return string
	 */
	public static function importer_modal_footer() { ?>
		<div id="csf-modal-importer" class="csf-modal csf-modal-importer">
		  <div class="csf-modal-table">
		    <div class="csf-modal-table-cell">
		      <div class="csf-modal-overlay"></div>
		      <div class="csf-modal-inner">
		        <div class="csf-modal-title">
		          <?php esc_html_e( 'Demo Importer', 'codevz' ); ?>
		          <div class="csf-modal-close csf-importer-close"></div>
		        </div>
		        <div class="csf-modal-header csf-text-center">
		          <input type="text" placeholder="<?php esc_html_e( 'Find demo by name ...', 'codevz' ); ?>" class="csf-importer-search" />
		        </div>
		        <div class="csf-modal-content"><div class="csf-importer-loading"></div></div>
		      </div>
		    </div>
		  </div>
		</div>
	<?php }

	/**
	 * Get demos for modal
	 * 
	 * @return string
	 */
	public static function importer_modal_content() {

		$dl = is_array( get_option( 'codevz_theme_activation' ) ) ? 1 : 0;

		$server = 'https://xtratheme.com/';
		$folder = 'importer/';
		$demos = [
			'yoga' 				=> '',
			'moving' 			=> '',
			'plumbing' 			=> '',
			'travel' 			=> '',
			'beauty-salon'      => '',
			'home-renovation' 	=> '',
			'creative-business' => '',
			'mechanic'        	=> '',
			'lawyer'         	=> '',
			'web-agency'        => '',
			'gardening'         => '',
			'corporate'         => '',
			'business-3'        => '',
			'digital-marketing' => '',
			'business-classic'  => '',
			'charity'        	=> '',
			'creative-studio'   => '',
			'kids'      	    => '',
			'smart-home'        => '',
			'logistic'          => '',
			'industrial'      	=> '',
			'tattoo'      		=> '',
			'personal-blog'    	=> '',
			'cleaning'      	=> '',
			'metro-blog'      	=> '',
			'parallax'      	=> '',
			'3d-portfolio'      => '',
			'agency'            => '',
			'photography3'      => '',
			'spa'               => '',
			'app'               => '',
			'architect'         => '',
			'barber'            => '',
			'building'          => '',
			'business'          => '',
			'camping-adventures'=> '',
			'coffee'            => '',
			'conference' 		=> '',
			'business-2' 		=> '',
			'construction' 		=> '',
			'cryptocurrency' 	=> '',
			'cv-resume'         => '',
			'dentist'           => '',
			'fashion-shop'      => '',
			'fast-food'         => '',
			'finance'           => '',
			'game'              => '',
			'gym'               => '',
			'hosting'           => '',
			'hotel' 			=> '',
			'interior'          => '',
			'lawyers'           => '',
			'logo-portfolio'    => '',
			'music'             => '',
			'photography'       => '',
			'photography2'      => '',
			'plastic-surgery'   => '',
			'restaurant'        => '',
			'rtl1'              => '',
			'seo'               => '',
			'single-shop'       => '',
			'wedding'           => '',
			'winery'            => '',
		];

		$checkbox = csf_add_field( array(
			'id'    => 'features',
			'name'  => 'features',
			'type'  => 'checkbox',
			'title' => '',
			'options' 	=> array(
				'options' 		=> esc_html__( 'Options', 'codevz' ),
				'widgets' 		=> esc_html__( 'Widgets', 'codevz' ),
				'content' 		=> esc_html__( 'Content', 'codevz' ),
				'attachments' 	=> esc_html__( 'Attachments', 'codevz' ),
				'revslider' 	=> esc_html__( 'Revolution Slider', 'codevz' ),
			)
		), array( 'options', 'content', 'attachments', 'widgets', 'revslider' ) );

		foreach ( $demos as $demo => $code ) {
			if ( $demo ) {
				echo '<div class="cz_demo">
						<img src="' . $server . $folder . $demo . $code . '.jpg" />
						<form class="importer_settings">
							' . $checkbox . '
							<div class="cz_importer">
								<input type="hidden" name="action" value="codevz_import_process">
								<input type="hidden" name="path" value="' . $server . '">
								<input type="hidden" name="folder" value="' . $folder . '">
								<input type="hidden" name="demo" value="' . $demo . '">
								<input type="hidden" name="code" value="' . $code . '">
								<input type="hidden" name="nonce" value="' . wp_create_nonce( 'cz_importer' ) . '">
								<input type="button" name="cz_importer" class="button button-primary" value="' . esc_html__( 'Import' ) . '">
								' . ( $dl ? '<a href="' . $server . $folder . $demo . $code . '.zip" target="_blank" class="button button-secondary">' . esc_html__( 'ZIP' ) . '</a>' : '' ) . '
								<a href="' . $server . $demo . '" target="_blank" class="button button-secondary">' . esc_html__( 'Preview' ) . '</a>
								<a href="http://theme.support/doc/xtra" target="_blank" class="button button-secondary">' . esc_html__( 'Help Doc' ) . '</a>
								<br /><br /><br />
							</div>
						</form>
					</div>';
			}
		}

		// Check if home page exists
     	$home_exists = get_page_by_path( 'home', OBJECT );
    	$home_exists = empty( $home_exists )? '' : ' codevz-home-exists';

		?><div class="cz_demo_importer_overlay<?php echo $home_exists; ?>">
			<div>
				<i class="fa fa-refresh fa-spin"></i>
				<h4></h4>
				<h2></h2>

				<div id="attachment-importer-progressbar">
					<div id="attachment-importer-progresslabel"></div>
				</div>
				<div id="attachment-importer-output" class="hidden"></div>

				<div class="cz-overlay-buttons hidden">
					<a href="#" class="button button-primary cz-try-again"><?php esc_html_e( 'Try again', 'codevz' ); ?></a>
					<a href="#" class="button button-secondary cz-close-overlay"><?php esc_html_e( 'Close', 'codevz' ); ?></a>
				</div>
				<div class="cz-done-all hidden">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'View site', 'codevz' ); ?></a>
					<a href="#" class="button button-secondary cz-reload-page"><?php esc_html_e( 'Refresh page', 'codevz' ); ?></a>
					<a href="#" class="button button-secondary cz-close-overlay"><?php esc_html_e( 'Close', 'codevz' ); ?></a>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function ($) {

				var overlay = $( ".cz_demo_importer_overlay" ),
					buttons = overlay.find( ".cz-overlay-buttons" ),
					done 	= overlay.find( '.cz-done-all' ),
					ajax_error = function( a, b, c, am ) {
						overlay.find( "h2" ).html( "<?php esc_html_e( 'Ajax not responding, please try again ...', 'codevz' ); ?>" );
						overlay.find( 'h4' ).html( am );
						overlay.find( 'i' ).attr( 'class', 'fa fa-remove' );
						buttons.removeClass( "hidden" );
						console.log( a, b, c );
					},
					ajax_done_error = function( a ) {
						overlay.find( "h2" ).html( a );
						overlay.find( 'h4' ).addClass( 'hidden' );
						overlay.find( 'i' ).attr( 'class', 'fa fa-remove' );
						buttons.removeClass( "hidden" );
					},
					all_done = function() {
						overlay.find( "h2" ).html( '<?php esc_html_e( 'Demo Successfully Imported', 'codevz' ); ?>' );
						overlay.find( 'h4' ).addClass( 'hidden' );
						overlay.find( 'i' ).attr( 'class', 'fa fa-check' );
						buttons.addClass( "hidden" );
						done.removeClass( 'hidden' );
					};

				// Reload page
				$( ".cz-reload-page" ).on( "click", function(e) {
					e.preventDefault();
					location.reload();
				});

				// Close importer overlay
				$( ".cz-close-overlay" ).on( "click", function(e) {
					e.preventDefault();
					$( ".cz_demo_importer_overlay" ).removeClass( "cz_show_overlay" );
				});

				// Check attachment and content FIX
				$( '[data-depend-id="features_attachments"]' ).on( "change", function(e) {
					var cont = $( this ).closest( 'form' ).find( '[data-depend-id="features_content"]' );

					if ( this.checked && ! cont.is( ':checked' ) ) {
						cont.prop( 'checked', true );
					}
				});
				$( '[data-depend-id="features_content"]' ).on( "change", function(e) {
					var att = $( this ).closest( 'form' ).find( '[data-depend-id="features_attachments"]' );

					if ( ! this.checked && att.is( ':checked' ) ) {
						att.prop( 'checked', false );
					}
				});

				// Click on import button
				$( ".cz_importer" ).on( "click","> input[type='button']", function( e ) {
					e.preventDefault();

					// Home exists, stop importer
					//if ( $( '.codevz-home-exists' ).length ) {
						//alert( 'It seems you have imported demo previousely or your site have a page named Home, First go to your pages and delete all pages (also from trash) then back here and try to import your demo.' );
						//return;
					//}

					// Importer vars
					var en 		= $( this ),
						form 	= en.closest( "form" ),
						data 	= form.serialize(),
						fields 	= form.find( "input:checkbox:checked" ).map(function() {return this.value;}).get(),
						ajax_import_data = function( data, obj ) {
							$.ajax({
								type: "POST",
								url: ajaxurl,
								data: data + '&posts=' + obj.posts,
								success: function( obj ) {
									obj = $.parseJSON( obj );

									if ( obj.error ) {
										ajax_done_error( obj.error );
									} else if ( obj.posts && obj.posts != 1 ) {
										setTimeout(function() {
											ajax_import_data( data, obj );
										}, 1000 );
									} else if ( obj.xml && $.inArray( "attachments", fields ) != -1 ) {
										overlay.find( "h2" ).html( "Importing images ..." );
										overlay.find( "h4" ).removeClass( "hidden" );
										attachment_importer( obj.xml, data, ( data.indexOf( 'slider' ) >= 0 ) );
									} else {
										all_done();
									}
								},
								error: function( a,b,c ) {	
									ajax_error( a, b, c, '<?php esc_html_e( 'If you faced this error multiple times, Please contact with theme support.', 'codevz' ); ?>' );
								}
							});
						};

					// Try again this form
					$( ".cz-try-again" ).off().on( "click", function(e) {
						e.preventDefault();
						en.trigger( "click" );
					});

					// Confirm
					if ( ! confirm( "<?php esc_html_e( 'Are you sure?', 'codevz' ); ?>" ) ) {
						return;
					}

					// Start
					done.addClass( 'hidden' );
					buttons.addClass( 'hidden' );
					overlay.addClass( "cz_show_overlay" );
					overlay.find( "h2" ).html( '<?php esc_html_e( 'Downloading demo data ...', 'codevz' ); ?>' );
					overlay.find( 'h4' ).removeClass( 'hidden' ).html( '<?php esc_html_e( 'Please wait, importing process may take up to 10 minutes.', 'codevz' ); ?>' );
					overlay.find( 'i' ).attr( 'class', 'fa fa-refresh fa-spin' );

					// Download demo
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data + '&download=1',
						success: function( obj ) {
							obj = $.parseJSON( obj );

							if ( obj.error ) {
								ajax_done_error( obj.error );
							} else {
								overlay.find( "h2" ).html( '<?php esc_html_e( 'Importing demo data ...', 'codevz' ); ?>' );

								$.ajax({
									type: "POST",
									url: ajaxurl,
									data: data + '&posts=1',
									success: function( obj ) {
										obj = $.parseJSON( obj );

										if ( obj.error ) {
											ajax_done_error( obj.error );
										} else {
											ajax_import_data( data, obj );
										}
									},
									error: function( a,b,c ) {	
										ajax_error( a, b, c, '<?php esc_html_e( 'If you faced this error multiple times, Please contact with theme support.', 'codevz' ); ?>' );
									}
								});

							}

						},
						error: function( a,b,c ) {	
							ajax_error( a, b, c, '<?php esc_html_e( 'Download failed', 'codevz' ); ?>, <?php esc_html_e( 'If you faced this error multiple times, Please contact with theme support.', 'codevz' ); ?>' );
						}
					});
				});

				function attachment_importer( xml, data, slider ) {
					$( document ).tooltip();
					var divOutput = $( '#attachment-importer-output' ),
						author1 = 1,
						author2 = 1,
						delay = 1000,
						progressBar = $( "#attachment-importer-progressbar" ),
						progressLabel = $( "#attachment-importer-progresslabel" );

					progressLabel.removeClass( 'hidden' );

					divOutput.empty();

					$( function(){
						progressBar.progressbar({
							value: false
						});
						progressLabel.text( aiL10n.parsing );
					});
							
					var url = [],
						title = [],
						link = [],
						pubDate = [],
						creator = [],
						guid = [],
						postID = [],
						postDate = [],
						postDateGMT = [],
						commentStatus = [],
						pingStatus = [],
						postName = [],
						status = [],
						postParent = [],
						menuOrder = [],
						postType = [],
						postPassword = [],
						isSticky = [];
						
					$( $.parseXML( xml ) ).find( 'item' ).each(function(){
					
						var xml_post_type = $( this ).find( 'wp\\:post_type, post_type' ).text();
						
						if( xml_post_type == 'attachment' ){ // We're only looking for image attachments.
							url.push( $( this ).find( 'wp\\:attachment_url, attachment_url' ).text() );
							title.push( $( this ).find( 'title' ).text() );
							link.push( $( this ).find( 'link' ).text() );
							pubDate.push( $( this ).find( 'pubDate' ).text() );
							creator.push( $( this ).find( 'dc\\:creator, creator' ).text() );
							guid.push( $( this ).find( 'guid' ).text() );
							postID.push( $( this ).find( 'wp\\:post_id, post_id' ).text() );
							postDate.push( $( this ).find( 'wp\\:post_date, post_date' ).text() );
							postDateGMT.push( $( this ).find( 'wp\\:post_date_gmt, post_date_gmt' ).text() );
							commentStatus.push( $( this ).find( 'wp\\:comment_status, comment_status' ).text() );
							pingStatus.push( $( this ).find( 'wp\\:ping_status, ping_status' ).text() );
							postName.push( $( this ).find( 'wp\\:post_name, post_name' ).text() );
							status.push( $( this ).find( 'wp\\:status, status' ).text() );
							postParent.push( $( this ).find( 'wp\\:post_parent, post_parent' ).text() );
							menuOrder.push( $( this ).find( 'wp\\:menu_order, menu_order' ).text() );
							postType.push( xml_post_type );
							postPassword.push( $( this ).find( 'wp\\:post_password, post_password' ).text() );
							isSticky.push( $( this ).find( 'wp\\:is_sticky, is_sticky' ).text() );
						}
					});
						
					var pbMax = postType.length;

					$( function(){
					    progressBar.progressbar({
					        value:0,
					        max: postType.length,
					        complete: function() {
					        	if ( slider ) {
									$.ajax({
										type: "POST",
										url: ajaxurl,
										data: data + '&slider=1',
										success: function( obj ) {
											obj = $.parseJSON( obj );

											if ( obj.error ) {
												ajax_done_error( obj.error );
											} else {
												progressLabel.addClass( 'hidden' );
												all_done();
											}
										},
										error: function( a,b,c ) {	
											ajax_error( a, b, c, '<?php esc_html_e( 'Import slider error, Please try again and only select Revolution Slider ...', 'codevz' ); ?>' );
										}
									});
					        	} else {
						            progressLabel.addClass( 'hidden' );
						            all_done();
					        	}
					        }
					    });
					});
						
					// Define counter variable outside the import attachments function
					// to keep track of the failed attachments to re-import them.
					var failedAttachments = 0;

					function import_attachments( i ){
					    progressLabel.text( aiL10n.importing + '"' + title[i] + '". ' + aiL10n.progress + progressBar.progressbar( "value" ) + "/" + pbMax );
						$.ajax({
							url: ajaxurl,
							type: 'POST',
							data: {
								action: 'attachment_importer_upload',
								_ajax_nonce: aiSecurity.nonce,
								author1:author1,
								author2:author2,
								url:url[i],
								title:title[i],
								link:link[i],
								pubDate:pubDate[i],
								creator:creator[i],
								guid:guid[i],
								post_id:postID[i],
								post_date:postDate[i],
								post_date_gmt:postDateGMT[i],
								comment_status:commentStatus[i],
								ping_status:pingStatus[i],
								post_name:postName[i],
								status:status[i],
								post_parent:postParent[i],
								menu_order:menuOrder[i],
								post_type:postType[i],
								post_password:postPassword[i],
								is_sticky:isSticky[i]
							}
						})
						.done(function( data, status, xhr ){
						    // Parse the response.
							var obj = $.parseJSON( data );
							
							// If error shows the server did not respond,
							// try the upload again, to a max of 2 tries.
							if( obj.message == "Remote server did not respond" && failedAttachments < 3 ){
							    failedAttachments++;
							    progressLabel.text( aiL10n.retrying + '"' + title[i] + '". ' + aiL10n.progress + progressBar.progressbar( "value" ) + "/" + pbMax );
							    setTimeout( function(){
							        import_attachments( i );
							    }, 5000 );
							}
							
							// If a non-fatal error occurs, note it and move on.
							else if( obj.type == "error" && !obj.fatal ){
								    divOutput.html( '<h5>' + obj.text + '</h5>' );
								    next_image(i);
						    }
						    
							// If a fatal error occurs, stop the program and print the error to the browser.
							else if( obj.fatal ){
							    progressBar.progressbar( "value", pbMax );
							    progressLabel.text( aiL10n.fatalUpload );
							    divOutput.html( '<h5 class="' + obj.type + '">' + obj.text +'</h5>' );
							    return false;
							}
							
							else { // Moving on.
							    next_image(i);
							}
						})
						.fail(function( xhr, status, error ){
							console.error(status);
							console.error(error);
							progressBar.progressbar( "value", pbMax );
							progressLabel.text( aiL10n.pbAjaxFail );
							divOutput.html( '<h5 class="error">' + aiL10n.ajaxFail +'</h5>' );
						});
					}
						
					function next_image( i ){
					    // Increment the internal counter and progress bar.
				        i++;
				        progressBar.progressbar( "value", progressBar.progressbar( "value" ) + 1 );
				        failedAttachments = 0;
				
				        // If every thing is normal, but we still have posts to process, 
				        // then continue with the program.
				        if( postType[i] ){
					        setTimeout( function(){
						        import_attachments( i )
					        }, delay );
				        } 
				
				        // Getting this far means there are no more attachments, so stop the program.
				        else {
					        return false;
				        }
					}
						
					if( postType[0] ){
					    import_attachments( 0 );
					} else{
					    progressBar.progressbar( "value", pbMax );
						progressLabel.text( aiL10n.pbAjaxFail );
						divOutput.html( '<h5 class="error">' + aiL10n.noAttachments +'</h5>' );
					}
				}
			});
		</script>
		<?php

		wp_die();
	}

	/**
	 * Server information for importing demo
	 * 
	 * @return array
	 */
	public static function system_information() {

		$memory_limit = ini_get( 'memory_limit' );
		$memory_get_usage = @round( memory_get_usage(1) / 1048576, 2 );
		$memory_get_peak_usage = @round( memory_get_peak_usage(1) / 1048576, 2 );

		if ( ini_get( 'allow_url_fopen' ) ) {
			$method = array( 'allow_url_fopen', esc_html__( 'Active', 'codevz' ), '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' );
		} else if ( function_exists( 'curl_version' ) ) {
			$method = array( 'PHP cURL', esc_html__( 'Active', 'codevz' ), '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' );
		} else {
			$method = array( 'allow_url_fopen | cURL', '<br />' . esc_html__( 'Please contact server support', 'codevz' ), '<span class="cz_error">' . esc_html__( 'Required', 'codevz' ) . '</span>' );
		}

		$array = array(
			array( 'Memory Limit', $memory_limit, ( $memory_limit < 128 ) ? '<span class="cz_error">128M</span>' : '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' ),
			array( 'Post Max Size', ini_get( 'post_max_size' ), ( ini_get( 'post_max_size' ) < 8 ) ? '<span class="cz_error">8M</span>' : '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' ),
			array( 'Max Execution Time', ini_get( 'max_execution_time' ), ( ini_get( 'max_execution_time' ) < 30 ) ? '<span class="cz_error">30</span>' : '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' ),
			$method,
		);

		// Server
		$out = '<ul class="cz_system_info" border="1">';
		foreach ( $array as $key ) {
			$out .= '<li>';
			$out .= $key[0] . ': ' . $key[1] . ( isset( $key[2] ) ? $key[2] : '-' );
			$out .= '</li>';
		}
		$out .= '</ul>';

		return $out;
	}

	/**
	 * Importer option panel in customizer page
	 * 
	 * @return array
	 */
	public static function options() {

		$options = array();
		$plg_url = plugins_url();

		$options[]   	= array(
		  'name'     	=> 'demos',
		  'title'    	=> esc_html__('Demo Importer', 'codevz'),
		  'priority' 	=> 0,
		  'fields'   	=> array(
			array(
				'type'    	=> 'notice',
				'class'   	=> 'info',
				'content' 	=> '<div style="text-align: center;font-size: 14px;color: #fff;padding: 20px;line-height: 20px;background: rgba(0,0,0,.3);border-radius: 4px;">' . esc_html__( 'Please make sure your server is ready, before importing a demo.', 'codevz' ) . '</div>' . self::system_information()
			),
			array(
				'type'    	=> 'content',
				'content' 	=> '<div class="csf-field-demo_importer"><a href="#" class="button csf-importer-add"><i class="fa fa-download" />' . esc_html__( 'Open Demo Importer', 'codevz' ) . '</a></div>'
			),
		  )
		);

		if ( class_exists( 'CSF_Customize' ) ) {
			//CSF_Customize::instance( $options, 'codevz_theme_options' );

			add_filter( 'codevz_theme_options', function() {
				return array(
				  'name'     	=> 'demos',
				  'title'    	=> esc_html__('Demo Importer', 'codevz'),
				  'priority' 	=> 0,
				  'fields'   	=> array(
					array(
						'type'    	=> 'notice',
						'class'   	=> 'info',
						'content' 	=> '<div style="text-align: center;font-size: 14px;color: #fff;padding: 20px;line-height: 20px;background: rgba(0,0,0,.3);border-radius: 4px;">' . esc_html__( 'Please make sure your server is ready, before importing a demo.', 'codevz' ) . '</div>' . self::system_information()
					),
					array(
						'type'    	=> 'content',
						'content' 	=> '<div class="csf-field-demo_importer"><a href="#" class="button csf-importer-add"><i class="fa fa-download"></i>' . esc_html__( 'Open Demo Importer', 'codevz' ) . '</a></div>'
					),
				  )
				);
			});
		}
	}

	/**
	 * Get uploads folder URL for replacing style kit images
	 * 
	 * @return string
	 */
	public static function baseurl() {
		$uploads = wp_upload_dir();
		return empty( $uploads['baseurl'] ) ? 0 : $uploads['baseurl'];
	}

	/**
	 * Importer Process
	 * 
	 * @return string
	 */
	public static function wp_die( $array ) {
		wp_die( json_encode( wp_parse_args( $array, array(
			'error' => 0,
			'posts'	=> 0,
			'xml'	=> 0
		) ) ) );
	}

	/**
	 * Importer Process
	 * 
	 * @return string
	 */
	public static function import_process() {
		check_ajax_referer( 'cz_importer', 'nonce' );

		// Prepare
		$a = $_POST;
		$baseurl = self::baseurl();
		$pattern = '~https?:\/\/[a-zA-Z\-\.\/0-9]*sites\/\d{1,}|https?:\\\/\\\/[a-zA-Z\-\.\\\/0-9]*sites\\\/\d{1,}~';

		// Download demo
		if ( ! empty( $a['download'] ) ) {		
			self::wp_die( array(
				'error' => self::download( $a['demo'], $a['path'] . $a['folder'] . $a['demo'] . $a['code'] . '.zip' )
			));
		}

		// Get local demo path
		$path = get_option( 'codevz_demo_path' );
		if ( ! $path ) {
			self::wp_die( array(
				'error' => esc_html__( 'Download failed, Please try again ...', 'codevz' )
			));
		}

		// Check if features is empty
		if ( empty( $a['features'] ) ) {
			self::wp_die( array(
				'error' => esc_html__( 'Please select atleast an option, then try to import demo', 'codevz' )
			));
		}

		// Register
		if ( function_exists( 'wp_get_theme' ) ) {
			$tn = wp_get_theme();
			$tn = $tn->get( 'Name' );
			$tn = empty( $tn ) ? 'Unknown' : $tn;
			$tn = wp_remote_get( 'http://theme.support/imports/?t=' . $tn . '&s=' . get_site_url() . '&d=' . $a['demo'] );
		}

		// Content ajax loop
		$is_content = ( ! empty( $a['posts'] ) && (int) $a['posts'] > 1 );
		if ( $is_content ) {
			$a['features'] = array( 0 => 'content' );
		}

		// Fix attachment
		if ( in_array( 'attachments', $a['features'] ) && ! in_array( 'content', $a['features'] ) ) {
			$a['features'][] = 'content';
		}

		// Import sliders after attachments
		if ( ! empty( $a['slider'] ) ) {
			$a['features'][] = 'revslider';
		}

		// Start Importing
		foreach( $a['features'] as $i => $key ) {

			if ( $key === 'attachments' ) {
				continue;

			} else if ( $key === 'options' ) {

				$options = $path . $key . '.txt';
				$options = file_get_contents( $options );
				$options = self::decode_options( $options );

				// Replace images URL's
				if ( $baseurl ) {
					$options = json_encode( $options );
					$options = preg_replace( $pattern, str_replace( '/', '\/', $baseurl ), $options );
					$options = json_decode( $options, true );
				}

				// Import options
				update_option( 'codevz_theme_options', $options );

				// Update colors options
				if ( isset( $options['site_color'] ) ) {
					update_option( 'codevz_primary_color', $options['site_color'] );
				}
				if ( isset( $options['site_color_sec'] ) ) {
					update_option( 'codevz_secondary_color', $options['site_color_sec'] );
				}

				// Update new post types
				if ( isset( $options['add_post_type'] ) ) {
					$new_cpt = $options['add_post_type'];
					if ( is_array( $new_cpt ) ) {
						$post_types = array();
						foreach ( $new_cpt as $cpt ) {
							if ( isset( $cpt['name'] ) ) {
								$post_types[] = strtolower( $cpt['name'] );
							}
						}
						update_option( 'codevz_css_selectors', '' );
						update_option( 'codevz_post_types', $post_types );
						update_option( 'codevz_post_types_org', $new_cpt );

						Codevz_Plus::post_types(); // Inform WordPress for dynamic post types
					}
				}
				
			} else if ( $key === 'widgets' ) {

				// Delete old widgets
				update_option( 'sidebars_widgets', array() );

				// Import new widgets
				$widgets = $path . $key . '.wie';
				$widgets = file_get_contents( $widgets );

				// Replace images URL's
				if ( $baseurl ) {
					$widgets = preg_replace( $pattern, str_replace( '/', '\/', $baseurl ), $widgets );
				}

				$widgets = @json_decode( $widgets );
				self::import_widgets( $widgets );

			} else if ( $key === 'content' && ! empty( $a['posts'] ) ) {

				// Delete old menus if exists ( FIX duplicated menus )
				$menus = array( 'Primary', 'One Page', 'Secondary', 'Footer', 'Mobile', 'Custom 1', 'Custom 2', 'Custom 3', 'Custom 4', 'Custom 5' );
				if ( $a['posts'] == 1 ) {
					foreach( $menus as $menu ) {
						wp_delete_nav_menu( $menu );
					}

					//wp_delete_post( 1 );
				}

				// Import
				$xml = $path . $key . '.xml';
				$posts = self::import_content( $xml, (int) $a['posts'] );
				if ( $posts != 'done' ) {
					self::wp_die( array(
						'error'	=> ( $posts === 'error' ) ? esc_html__( 'Could not find content.xml, Please try again ...', 'codevz' ) : 0,
						'posts'	=> $posts
					));
				}

				// Menus to import and assign
				$locations = get_theme_mod( 'nav_menu_locations' );
				foreach ( $menus as $menu ) {
					$menu_slug = str_replace( ' ', '-', strtolower( $menu ) );
					$menu = get_term_by( 'slug', $menu_slug, 'nav_menu' );
					if ( isset( $menu->term_id ) ) {
						$locations[ $menu_slug ] = $menu->term_id;
					}
				}
				set_theme_mod( 'nav_menu_locations', $locations );

				// Set menus meta's
				$menus = $path . 'menus.txt';
				if ( file_exists( $menus ) ) {
					$menus = file_get_contents( $menus );

					// Replace images URL's
					if ( $baseurl ) {
						$menus = preg_replace( $pattern, str_replace( '/', '\/', $baseurl ), $menus );
					}

					$menus = json_decode( $menus, true );

					foreach ( (array) $menus as $location => $menu ) {
						$location = (array) wp_get_nav_menu_items( $location );
						foreach ( $location as $item ) {
							if ( isset( $item->title ) && isset( $menu[ $item->title ] ) ) {
								foreach ( (array) $menu[ $item->title ] as $key => $value ) {
									update_post_meta( $item->ID, $key, $value );
								}
							}
						}
					}
				}

				// Set home page
				$homepage = get_page_by_title( 'Home' );
				if ( ! empty( $homepage->ID ) ) {
					update_option( 'page_on_front', $homepage->ID );
					update_option( 'show_on_front', 'page' );
				}

				// Set woocommerce shop page
				if ( get_page_by_title( 'Shop' ) ) {
					$shop = get_page_by_title( 'Shop' );
				} else if ( get_page_by_title( 'Products' ) ) {
					$shop = get_page_by_title( 'Products' );
				} else if ( get_page_by_title( 'Order' ) ) {
					$shop = get_page_by_title( 'Order' );
				} else if ( get_page_by_title( 'Store' ) ) {
					$shop = get_page_by_title( 'Store' );
				} else if ( get_page_by_title( 'Market' ) ) {
					$shop = get_page_by_title( 'Market' );
				} else if ( get_page_by_title( 'Marketplace' ) ) {
					$shop = get_page_by_title( 'Marketplace' );
				} else if ( get_page_by_title( 'Buy' ) ) {
					$shop = get_page_by_title( 'Buy' );
				} else if ( get_page_by_title( 'Buy Now' ) ) {
					$shop = get_page_by_title( 'Buy Now' );
				} else if ( get_page_by_title( 'Buy Ticket' ) ) {
					$shop = get_page_by_title( 'Buy Ticket' );
				}
				if ( ! empty( $shop->ID ) ) {
					update_option( 'woocommerce_shop_page_id', $shop->ID );
				}

				// Set woocommerce cart page
				if ( get_page_by_title( 'Cart' ) ) {
					$cart = get_page_by_title( 'Cart' );
				}
				if ( ! empty( $cart->ID ) ) {
					update_option( 'woocommerce_cart_page_id', $cart->ID );
				}

				// Set woocommerce checkout page
				if ( get_page_by_title( 'Checkout' ) ) {
					$checkout = get_page_by_title( 'Checkout' );
				}
				if ( ! empty( $checkout->ID ) ) {
					update_option( 'woocommerce_checkout_page_id', $checkout->ID );
				}

				// Set blog page
				if ( get_page_by_title( 'Blog' ) ) {
					$blog = get_page_by_title( 'Blog' );
				} else if ( get_page_by_title( 'News' ) ) {
					$blog = get_page_by_title( 'News' );
				} else if ( get_page_by_title( 'Posts' ) ) {
					$blog = get_page_by_title( 'Posts' );
				} else if ( get_page_by_title( 'Article' ) ) {
					$blog = get_page_by_title( 'Article' );
				} else if ( get_page_by_title( 'Articles' ) ) {
					$blog = get_page_by_title( 'Articles' );
				} else if ( get_page_by_title( 'Journal' ) ) {
					$blog = get_page_by_title( 'Journal' );
				}
				if ( ! empty( $blog->ID ) ) {
					update_option( 'page_for_posts', $blog->ID );
				}

				// Update number of posts per page
				update_option( 'posts_per_page', '4' );

			} else if ( $key === 'revslider' ) {
				self::import_revslider( $a['demo'], $path );
			}

		}
		
		flush_rewrite_rules();
		self::wp_die( array(
			'xml'	=> ( empty( $xml ) ? 0 : file_get_contents( $path . 'content.xml' ) )
		));
	}

	/**
	 * Import Content
	 * 
	 * @return array
	 */
	public static function import_content( $file, $posts = 0 ) {
		
		if ( ! defined('WP_LOAD_IMPORTERS') ) {
			define( 'WP_LOAD_IMPORTERS', true );
		}

	    require_once ABSPATH . 'wp-admin/includes/import.php';
	    $importer_error = false;

	    if ( ! class_exists( 'WP_Importer' ) ) {

	        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

	        if ( file_exists( $class_wp_importer ) ){
	            require_once( $class_wp_importer );
	        } else {
	            $importer_error = true;
	        }
	    }

		if ( ! class_exists( 'WP_Import' ) ) {
			$class_wp_import = dirname( __FILE__ ) .'/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) ) {
				require_once( $class_wp_import );
			} else {
				$importer_error = true;
			}
		}

		if ( $importer_error ) {
			return 'error';
		} else {
			if( ! is_file( $file ) ) {
				return 'error';
			} else {
				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = false;
				return $wp_import->import( $file, $posts );
			}
		}

	}

	/**
	 * Importing Revolution Slider
	 * 
	 * @return string
	 */
	public static function import_revslider( $demo, $path ) {

		$sliders = array();
		foreach( glob( $path . '*.zip' ) as $i ) {
			$sliders[] = $i;
		}

		ob_start();
		$i = 0;

		foreach( $sliders as $slider ) {
			$tr = 'codevz_rs_' . $demo . '_' . $i++;

			if ( class_exists( 'RevSliderSliderImport' ) ) { // new
				
				if ( ! get_transient( $tr ) ) {
					$rs = new RevSliderSliderImport();
					$rs->import_slider( true, $slider );
					set_transient( $tr, 1, 3600 );
				}

			} else if ( class_exists( 'RevSlider' ) ) { // old

				if ( ! get_transient( $tr ) ) {
					$rs = new RevSlider();
					$rs->importSliderFromPost( true, true, $slider );
					set_transient( $tr, 1, 3600 );
				}

			}

		}
		
		$msg = ob_get_clean();
	}

	/**
	 * Importing Widgets
	 * 
	 * @return array
	 */
	public static function import_widgets( $data ) {

		global $wp_registered_sidebars;

		if ( empty( $data ) || ! is_object( $data ) ) {
			return;
		}

		$available_widgets = self::available_widgets();

		// Get all existing widget instances
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
		}

		// Begin results
		$results = array();

		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}

			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
				$sidebar_available = true;
				$use_sidebar_id = $sidebar_id;
			} else {
				$sidebar_available = false;
				$use_sidebar_id = 'wp_inactive_widgets';
			}

			// Result for sidebar
			$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
			$GLOBALS['dev'] = 'VGhpcyBwcm9kdWN0IGRlc2lnbmVkIGFuZCBkZXZlbG9wZWQgYnkgQmVoemFkIEdoYWRpYW5pIGNvLWZvdW5kZXIgb2YgQ29kZXZ6';
			$results[$sidebar_id]['widgets'] = array();

			// Loop widgets
			foreach ( $widgets as $widget_instance_id => $widget ) {

				$fail = false;

				// Get id_base (remove -# from end) and instance ID number
				$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

				// Does site support this widget?
				if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
					$fail = true;
				}

				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
					foreach ( $single_widget_instances as $check_id => $check_widget ) {

						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

							$fail = true;

							break;

						}

					}

				}

				// No failure
				if ( ! $fail ) {

					// Add widget instance
					$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
					$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
					$single_widget_instances[] = (array) $widget; // add it

					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );

					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}

					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}

					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );

					// Assign widget instance to sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
					$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
					$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
					update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

				}

				// Result for widget instance
				$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
				$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = isset( $widget->title ) ? $widget->title : esc_html__( 'No Title', 'codevz' );

			}
		}
	}

	/**
	 * Get available widgets
	 * 
	 * @return array
	 */
	public static function available_widgets() {

		global $wp_registered_widget_controls;
		$widget_controls = $wp_registered_widget_controls;
		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {
			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];

			}
		}

		return $available_widgets;
	}

	/**
	 * Check if file downlaoded successfully and have length
	 * 
	 * @return string
	 */
	public static function file_length( $zip = '' ) {
		return strlen( @file_get_contents( $zip ) ) > 10000;
	}

	/**
	 * Download and extract demo data
	 * 
	 * @return string
	 */
	public static function download( $demo, $remote, $try = 1 ) {

		// Check activation
		if ( ! is_array( get_option( 'codevz_theme_activation' ) ) ) {
			return esc_html__( 'Please activate your theme from Dashboard > XTRA then you can import demo.', 'codevz' );
		}

		// Check WPBakery
		if ( ! is_plugin_active( 'js_composer/js_composer.php' ) ) {
			return esc_html__( 'Please make sure WPBakery Page Builder plugin is active from Dashboard > Plugins', 'codevz' );
		}

		// Check RevSlider
		if ( ! is_plugin_active( 'revslider/revslider.php' ) ) {
			return esc_html__( 'Please make sure Slider Revolution plugin is active from Dashboard > Plugins', 'codevz' );
		}

		// Upload directory
		$dir = '/codevz_demo_data/';
		$up = wp_upload_dir();

		// Run wp_filesystem
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		// Create directory
		if ( isset( $up['basedir'] ) ) {
			$dir = $up['basedir'] . $dir;
			if ( ! file_exists( $dir ) ) {
				wp_mkdir_p( $dir );
			}
			$zip = $dir . $demo . '.zip';
		}

		// Return if demo downlaoded before
		if ( file_exists( $dir . $demo . '/content.xml' ) ) {
			update_option( 'codevz_demo_path', $dir . $demo . '/' );
			return 0;
		}

		// Check directory
		if ( Codevz_Plus::contains( $dir, 'uploads' ) ) {

			// Download via file_get_contents
			if ( ini_get( 'allow_url_fopen' ) ) {
				file_put_contents( $zip, file_get_contents( $remote ) );

				// Check file, if failed, try copy
				if ( ! self::file_length( $zip ) ) {
					copy( $remote, $zip );

					// Check file, if failed, try $wp_filesystem
					if ( ! self::file_length( $zip ) ) {
						$wp_filesystem->copy( $remote, $zip, true );
					}
				}
			}

			// Alternative solution, Check and download via cURL
			if ( ! self::file_length( $zip ) ) {
				if ( function_exists( 'curl_init' ) ) {
					$ch = curl_init();
					curl_setopt( $ch, CURLOPT_HEADER, 0 );
					curl_setopt( $ch, CURLOPT_TIMEOUT, 120 );
					curl_setopt( $ch, CURLOPT_URL, $remote );
					curl_setopt( $ch, CURLOPT_FAILONERROR, true );
					curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
					curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
					$opt_file = fopen( $zip, "w" );
					curl_setopt( $ch, CURLOPT_FILE, $opt_file );
					curl_exec( $ch );
					curl_close( $ch );
				} else {
					return esc_html__( 'Your server PHP cURL or allow_url_fopen is not enable, Please contact with your hosting support.', 'codevz' );
				}
			}

			// Ensure file fuly downloaded
			if ( ! self::file_length( $zip ) ) {
				return esc_html__( 'Your hosting security system do not allow demo importer for downloading demo zip file, Please contact with theme support.', 'codevz' );
			}

			// Unzip file via $wp_filesystem
			if ( file_exists( $zip ) ) {
				unzip_file( $zip, $dir );
				update_option( 'codevz_demo_path', $dir . $demo . '/' );

				return 0;
			} else {
				if ( $try ) {
					self::download( $demo, $remote, 0 ); // If file doesn't exist, try again
				} else {
					return esc_html__( 'Download failed, Please make sure your uploads folder permission is 0777', 'codevz' );
				}
			}

		} else if ( $try ) {
			self::download( $demo, $remote, 0 ); // If directory doesn't exist, try again
		} else {
			return esc_html__( 'WordPress could not download demo or create demo directory, Please try again ...', 'codevz' );
		}
		// End download
	}

}
new Codevz_Demo_Importer();


add_action( 'wp_ajax_attachment_importer_upload', 'attachment_importer_uploader' );
function attachment_importer_uploader(){
	
	// check nonce before doing anything else
	if( !check_ajax_referer( 'import-attachment-plugin', false, false ) ){
		$nonce_error = new WP_Error( 'nonce_error', __('Are you sure you want to do this?', 'codevz') );
		echo json_encode ( array(
			'fatal' => true,
			'type' => 'error',
	        'code' => $nonce_error->get_error_code(),
			'message' => $nonce_error->get_error_message(),
			'text' => sprintf( __( 'The <a href="%1$s">security key</a> provided with this request is invalid. Is someone trying to trick you to upload something you don\'t want to? If you really meant to take this action, reload your browser window and try again. (<strong>%2$s</strong>: %3$s)', 'codevz' ), 'http://codex.wordpress.org/WordPress_Nonces', $nonce_error->get_error_code(), $nonce_error->get_error_message() )
		) );
		wp_die();
	}

	$parameters = array(
		'url' => $_POST['url'],
		'post_title' => $_POST['title'],
		'link' => $_POST['link'],
		'pubDate' => $_POST['pubDate'],
		'post_author' => $_POST['creator'],
		'guid' => $_POST['guid'],
		'import_id' => $_POST['post_id'],
		'post_date' => $_POST['post_date'],
		'post_date_gmt' => $_POST['post_date_gmt'],
		'comment_status' => $_POST['comment_status'],
		'ping_status' => $_POST['ping_status'],
		'post_name' => $_POST['post_name'],
		'post_status' => $_POST['status'],
		'post_parent' => $_POST['post_parent'],
		'menu_order' => $_POST['menu_order'],
		'post_type' => $_POST['post_type'],
		'post_password' => $_POST['post_password'],
		'is_sticky' => $_POST['is_sticky'],
		'attribute_author1' => $_POST['author1'],
		'attribute_author2' => $_POST['author2']
	);

	$remote_url = ! empty($parameters['attachment_url']) ? $parameters['attachment_url'] : $parameters['guid'];
	
	wp_die( json_encode( process_attachment( $parameters, $remote_url ) ) );
}

function process_attachment( $post, $url ) {
	
	$pre_process = pre_process_attachment( $post, $url );
	if( is_wp_error( $pre_process ) )
		return array(
			'fatal' => false,
			'type' => 'error',
			'code' => $pre_process->get_error_code(),
			'message' => $pre_process->get_error_message(),
			'text' => sprintf( __( '%1$s was not uploaded. (<strong>%2$s</strong>: %3$s)', 'codevz' ), $post['post_title'], $pre_process->get_error_code(), $pre_process->get_error_message() )
		);

	// if the URL is absolute, but does not contain address, then upload it assuming base_site_url
	if ( preg_match( '|^/[\w\W]+$|', $url ) )
		$url = rtrim( $this->base_url, '/' ) . $url;

	$upload = fetch_remote_file( $url, $post );
	if ( is_wp_error( $upload ) )
		return array(
			'fatal' => ( $upload->get_error_code() == 'upload_dir_error' && $upload->get_error_message() != 'Invalid file type' ? true : false ),
			'type' => 'error',
			'code' => $upload->get_error_code(),
			'message' => $upload->get_error_message(),
			'text' => sprintf( __( '%1$s could not be uploaded because of an error. (<strong>%2$s</strong>: %3$s)', 'codevz' ), $post['post_title'], $upload->get_error_code(), $upload->get_error_message() )
		);

	if ( $info = wp_check_filetype( $upload['file'] ) )
		$post['post_mime_type'] = $info['type'];
	else {
		$upload = new WP_Error( 'attachment_processing_error', __('Invalid file type', 'codevz') );
		return array(
			'fatal' => false,
			'type' => 'error',
			'code' => $upload->get_error_code(),
			'message' => $upload->get_error_message(),
			'text' => sprintf( __( '%1$s could not be uploaded because of an error. (<strong>%2$s</strong>: %3$s)', 'codevz' ), $post['post_title'], $upload->get_error_code(), $upload->get_error_message() )
		);
	}

	$post['guid'] = $upload['url'];

	// Set author per user options.
	switch( $post['attribute_author1'] ){

		case 1: // Attribute to current user.
			$post['post_author'] = (int) wp_get_current_user()->ID;
			break;

		case 2: // Attribute to user in import file.
			if( !username_exists( $post['post_author'] ) )
				wp_create_user( $post['post_author'], wp_generate_password() );
			$post['post_author'] = (int) username_exists( $post['post_author'] );
			break;

		case 3: // Attribute to selected user.
			$post['post_author'] = (int) $post['attribute_author2'];
			break;

	}

	// as per wp-admin/includes/upload.php
	$post_id = wp_insert_attachment( $post, $upload['file'] );
	wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );

	// remap image URL's
	backfill_attachment_urls( $url, $upload['url'] );

	return array(
		'fatal' => false,
		'type' => 'updated',
		'text' => sprintf( __( '%s was uploaded successfully', 'codevz' ), $post['post_title'] )
	);
}

function pre_process_attachment( $post, $url ){
	global $wpdb;

	$imported = $wpdb->get_results(
		$wpdb->prepare(
			"
			SELECT ID, post_date_gmt, guid
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
				AND post_title = %s
			",
			$post['post_title']
		)
	);

	if( $imported ){
		foreach( $imported as $attachment ){
			if( basename( $url ) == basename( $attachment->guid ) ){
				if( $post['post_date_gmt'] == $attachment->post_date_gmt ){
					$headers = wp_get_http( $url );
					if( filesize( get_attached_file( $attachment->ID ) ) == $headers['content-length'] ){
						return new WP_Error( 'duplicate_file_notice', __( 'File already exists', 'codevz' ) );
					}
				}
			}
		}
	}

	return false;
}

function fetch_remote_file( $url, $post ) {
	// extract the file name and extension from the url
	$file_name = basename( $url );

	// get placeholder file in the upload dir with a unique, sanitized filename
	$upload = wp_upload_bits( $file_name, 0, '', $post['post_date'] );
	if ( $upload['error'] )
		return new WP_Error( 'upload_dir_error', $upload['error'] );

	// fetch the remote url and write it to the placeholder file
	$headers = wp_get_http( $url, $upload['file'] );

	// request failed
	if ( ! $headers ) {
		@unlink( $upload['file'] );
		return new WP_Error( 'import_file_error', __('Remote server did not respond', 'codevz') );
	}

	// make sure the fetch was successful
	if ( $headers['response'] != '200' ) {
		@unlink( $upload['file'] );
		return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', 'codevz'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
	}

	$filesize = filesize( $upload['file'] );

	if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
		@unlink( $upload['file'] );
		return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'codevz') );
	}

	if ( 0 == $filesize ) {
		@unlink( $upload['file'] );
		return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'codevz') );
	}

	return $upload;
}

function backfill_attachment_urls( $from_url, $to_url ) {
	global $wpdb;

	$wpdb->query(
		$wpdb->prepare(
			"
				UPDATE {$wpdb->posts}
				SET post_content = REPLACE(post_content, %s, %s)
			",
			$from_url, $to_url
		)
	);

	$result = $wpdb->query(
		$wpdb->prepare(
			"
				UPDATE {$wpdb->postmeta}
				SET meta_value = REPLACE(meta_value, %s, %s)
			",
			$from_url, $to_url
		)
	);
}
