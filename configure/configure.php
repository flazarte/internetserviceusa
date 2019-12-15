<?php

	// MENUS

	function _custom_theme_register_menu()
	{
  		register_nav_menus(
    		array(
      			'menu-main' => __( 'Menu principal' ),
      			//'menu-footer' => __( 'Menu footer' ),
    		)
  		);
	}
	add_action( 'init', '_custom_theme_register_menu' );

	// IMAGES

	add_theme_support( 'post-thumbnails' );

	function _custom_theme_init_images_size()
	{
		//add_image_size( '424x424', 424, 424, true );
		add_image_size( 'featured-post-img', 600, 400 ,true);
	}
	add_action( 'init', '_custom_theme_init_images_size' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Giving credits
	function remove_footer_admin () {
		echo 'Thème crée par <a href="http://www.olivier-guilleux.com" target="_blank">Olivier Guilleux</a>';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');

	// Move Yoast to bottom
	function yoasttobottom() {
		return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

	// Remove WP Emoji
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// delete wp-embed.js from footer
	function my_deregister_scripts(){
		wp_deregister_script( 'wp-embed' );
	}
	add_action( 'wp_footer', 'my_deregister_scripts' );

	// delete jquery migrate
	function dequeue_jquery_migrate( &$scripts){
		if(!is_admin()){
			$scripts->remove( 'jquery');
			$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4', true );
		}
	}
	add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

	// force all scripts to load in footer
	function clean_header() {
		remove_action('wp_head', 'wp_print_scripts');
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_enqueue_scripts', 1);
	}
	add_action('wp_enqueue_scripts', 'clean_header');

	// add SVG to allowed file uploads
	function add_file_types_to_uploads($file_types){

		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );

		return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');

	//Page Slug Body Class
	function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
	}
	add_filter( 'body_class', 'add_slug_body_class' );

	function my_custom_sidebar() {
	    register_sidebar(
	        array (
	            'name' => __( 'Custom', 'your-theme-domain' ),
	            'id' => 'custom-side-bar',
	            'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
	            'before_widget' => '<div class="widget-content">',
	            'after_widget' => "</div>",
	            'before_title' => '<h3 class="widget-title">',
	            'after_title' => '</h3>',
	        )
	    );
	}
	add_action( 'widgets_init', 'my_custom_sidebar' );


	// remove w3 total cache footer
	add_filter( 'w3tc_can_print_comment', '__return_false', 10, 1 );
	
