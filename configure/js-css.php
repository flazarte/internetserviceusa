<?php
	function _add_javascript()
	{
		//wp_enqueue_script('jquery-js','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true );
		//wp_enqueue_script('owl-js','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), null, true );
  
		  wp_enqueue_script('jquery-assets', get_template_directory_uri() . '/assets/web/assets/jquery/jquery.min.js', array(), null, true );
		  wp_enqueue_script('popper-js', get_template_directory_uri() . '/assets/popper/popper.min.js', array(), null, true );
		  wp_enqueue_script('tether-js', get_template_directory_uri() . '/assets/tether/tether.min.js', array(), null, true );
		  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array(), null, true );
		  wp_enqueue_script('smoothdcrool-js', get_template_directory_uri() . '/assets/smoothscroll/smooth-scroll.js', array(), null, true );
		  wp_enqueue_script('dropdown-js', get_template_directory_uri() . '/assets/dropdown/js/script.min.js', array(), null, true );
		  wp_enqueue_script('touch-swipe-js', get_template_directory_uri() . '/assets/touchswipe/jquery.touch-swipe.min.js', array(), null, true );
		  wp_enqueue_script('vimeo-js', get_template_directory_uri() . '/assets/playervimeo/vimeo_player.js', array(), null, true );
		  wp_enqueue_script('mbr-clients-js', get_template_directory_uri() . '/assets/mbr-clients-slider/mbr-clients-slider.js', array(), null, true );
		  wp_enqueue_script('mbr-tabs-js', get_template_directory_uri() . '/assets/mbr-tabs/mbr-tabs.js', array(), null, true );
		  wp_enqueue_script('mbr-switch-js', get_template_directory_uri() . '/assets/mbr-switch-arrow/mbr-switch-arrow.js', array(), null, true );
		  wp_enqueue_script('mbr-parralax-js', get_template_directory_uri() . '/assets/parallax/jarallax.min.js', array(), null, true );
		  wp_enqueue_script('mbr-social-js', get_template_directory_uri() . '/assets/sociallikes/social-likes.js', array(), null, true );
		  wp_enqueue_script('mbr-courosel-js', get_template_directory_uri() . '/assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js', array(), null, true );
		  wp_enqueue_script('mbr-script-js', get_template_directory_uri() . '/assets/theme/js/script.js', array(), null, true );
		

	}
	add_action('wp_enqueue_scripts', '_add_javascript', 100);

	function _add_stylesheets()
	{
		//wp_enqueue_style('droid-sans-css', 'https://fonts.googleapis.com/css?family=Droid+Sans:300,400,700,900', array(), null, 'all' );
		//wp_enqueue_style('monserrat-css', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,900', array(), null, 'all' );
		//wp_enqueue_style('Nunito-css', 'https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900', array(), null, 'all' );
		//wp_enqueue_style('oswald-css', 'https://fonts.googleapis.com/css?family=Oswald:400,500,700&display=swap', array(), null, 'all' );
		//wp_enqueue_style('proxima-css', 'https://cdn.jsdelivr.net/npm/font-proxima-nova@1.0.1/style.css', array(), null, 'all' );
		//wp_enqueue_style('owl-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), null, 'all' );
		//bootstrap
		wp_enqueue_style('bootstrap-min-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css', array(), null, 'all' );

		wp_enqueue_style('logo-internetservice', get_template_directory_uri() . '/assets/images/logo-128x91-2.png', array(), null, 'all' );
		
		wp_enqueue_style('fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css', array(), null,'all'); 

		//wp_enqueue_style('fontawesome-old', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), null,'all'); 
		
		
		wp_enqueue_style('main-css', get_template_directory_uri() . '/css/style.css', array(), null, 'all' );
  
  		wp_enqueue_style('mobirise-css', get_template_directory_uri() . 'assets/web/assets/mobirise-icons/mobirise-icons.css', array(), null, 'all' );
  		wp_enqueue_style('tether-css', get_template_directory_uri() . '/assets/tether/tether.min.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-grid.min.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-reboot', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-reboot.min.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-dropdown', get_template_directory_uri() . '/assets/dropdown/css/style.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-socicon', get_template_directory_uri() . '/assets/socicon/css/styles.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/assets/theme/css/style.css', array(), null, 'all' );
  		wp_enqueue_style('mbr-theme', get_template_directory_uri() . '/assets/mobirise/css/mbr-additional.css', array(), null, 'all' );
  		wp_enqueue_style('internetservice-style', get_template_directory_uri() . '/style.css', array(), null, 'all' );
	}
	add_action('wp_enqueue_scripts', '_add_stylesheets');
