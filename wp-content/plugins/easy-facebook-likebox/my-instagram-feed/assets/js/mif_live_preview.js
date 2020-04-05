/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage

 * this, set your custom settings to 'postMessage' and then add your handling

 * here. Your javascript should grab settings from customizer controls, and 

 * then make any necessary changes to the page using jQuery.

 */

								//======================================================================
												// Header Live Preview
								//======================================================================

( function( $ ) {
// console.log('mif_skin_'+mif_skin_id+'[show_header]');
	/*
	* Show or hide header in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_header]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.mif_wrap .mif_header' ).slideDown('slow');
			}else
			{
			$( '.mif_wrap .mif_header' ).slideUp('slow');
			}
			
		});
	});

	/*
	* Updated background color of header in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_header' ).css('background-color', newval );
		});
	});


	/*
	* Updated color of header in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_header, .mif_wrap .mif_header .mif_posts, .mif_wrap .mif_header .mif_followers, .mif_wrap .mif_header .mif_bio, .mif_wrap .mif_header .mif_header_title, .mif_wrap .mif_header_time .mif_header_title' ).css('color', newval );
		});
	});
	/*
	* Updated the title size of header.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[title_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header .mif_header_title' ).css('font-size', newval+'px' );

		} );

	} );

	/*
	* Show or hide display picture in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_dp]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap .mif_header .mif_dp_wrap' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_header .mif_dp_wrap' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show rounded or boxed dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_round_dp]', function( value ) {

		value.bind( function( newval ) {

			if(newval){
				$( '.mif_wrap .mif_header .mif_head_img_holder .mif_overlay, .mif_wrap .mif_header .mif_head_img_holder .mif_header_img' ).css('border-radius', '50%' );	
			}else
			{
		
			$( '.mif_wrap .mif_header .mif_head_img_holder .mif_overlay, .mif_wrap .mif_header .mif_head_img_holder .mif_header_img' ).css('border-radius', '0px' );
			}

		} );

	} );

	/*
	* Show or hide total number of feeds in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_no_of_feeds]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap .mif_header .mif_posts' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_header .mif_posts' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_no_of_followers]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap .mif_header .mif_followers' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_header .mif_followers' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Updated the title size of total posts and followers in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[metadata_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header .mif_posts, .mif_wrap .mif_header .mif_followers' ).css('font-size', newval+'px' );

		} );

	} );


	/*
	* Show or hide bio in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_bio]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap .mif_header .mif_bio' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_header .mif_bio' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Updated the title size of bio in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[bio_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header .mif_bio' ).css('font-size', newval+'px' );

		} );

	} );
	/*
	* Updated the Header Border Color in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[bio_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-color', newval );

		} );

	} );

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_border_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-color', newval );

		} );

	} );

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_border_style]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-style', newval );

		} );

	} );

	/*
	* Updated the Header Border top size in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_border_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-top-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border bottom size in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_border_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-bottom-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border left size in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_border_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-left-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border left size in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_border_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('border-right-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header top padding in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_padding_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('padding-top', newval+'px' );

		} );

	} );

	/*
	* Updated the Header bottom padding in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_padding_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('padding-bottom', newval+'px' );

		} );

	} );

	/*
	* Updated the Header left padding in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_padding_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('padding-left', newval+'px' );

		} );

	} );


	/*
	* Updated the Header right padding in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_padding_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header' ).css('padding-right', newval+'px' );

		} );

	} );
	/*
	* Updated the Header Alignment in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_align]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_header .mif_inner_wrap' ).css('float', newval );

		} );

	} );
	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_dp_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap  .mif_header a:hover .mif_overlay{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updated the Header shadow icon color of dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[header_dp_hover_icon_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap  .mif_header .mif_head_img_holder .mif_overlay .icon{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_follow_btn]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_follow_btn' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_follow_btn' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_load_more_btn]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_load_feeds' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_load_feeds' ).fadeOut('slow');
			}
			
		});
	});

		/*
	* Show or hide next prev icon in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_next_prev_icon]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.mif_wrap .owl-nav' ).slideDown('slow');
			}else
			{
			$( '.mif_wrap .owl-nav' ).slideUp('slow');
			}
			
		});
	});

	/*
	* Show or hide header in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_nav]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.mif_wrap .owl-dots' ).slideDown('slow');
			}else
			{
			$( '.mif_wrap .owl-dots' ).slideUp('slow');
			}
			
		});
	});


	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[nav_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_carousel_main .owl-dots .owl-dot span' ).css('background', newval );
		});
	});

		/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[nav_active_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_carousel_main .owl-dots .owl-dot.active span' ).css('background', newval );
		});
	});

	wp.customize( 'mif_skin_'+mif_skin_id+'[nav_active_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap .owl-theme .owl-dots .owl-dot:hover span{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );
								//======================================================================
												// Feeds Live Preview
								//======================================================================

							
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_background_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({"background-color": newval});

			
		});
	});

	/*
	* Change Image Filters.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_image_filter]', function( value ) {

		value.bind( function( newval ) {


			$( '.mif_wrap  .mif_single .mif_feed_image' ).attr('class', 'mif_feed_image');

			$( '.mif_wrap  .mif_single .mif_feed_image' ).addClass(newval);
			$( '.mif_wrap  .mif_single.mif_grid_layout' ).addClass(newval);
	
			
		});
	});


	/*
	* Change Amount OF Filters.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_image_filter_amount]', function( value ) {

		value.bind( function( newval ) {

				wp.customize( 'mif_skin_'+mif_skin_id+'[feed_image_filter]', function( setting ) {

					    var mif_filter = setting.get();

					    $('<style>.mif_wrap  .mif_single .mif_feed_image.'+mif_filter+', .mif_wrap  .mif_single .mif_feed_image.'+mif_filter+'{filter:'+mif_filter+'('+newval+')}</style>').appendTo('head');
					    $('<style>.mif_wrap  .mif_single.'+mif_filter+', .mif_wrap  .mif_single.'+mif_filter+'{filter:'+mif_filter+'('+newval+')}</style>').appendTo('head'); 
					    
					});
		});
	});


	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_likes]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_likes ' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_likes ' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_show_likes]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_likes' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_likes' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_comments]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_coments' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap .mif_coments' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[number_of_cols]', function( value ) {
		var no_of_columns = null;
		var height = null;	
		value.bind( function( newval ) {
			
			if(1 ==  newval){
				no_of_columns = '98';
				height = '643';	
			}
			else if(2 ==  newval){

				no_of_columns = '48';
				height = '317';	
			}
			else if(3 ==  newval){

				no_of_columns = '30.3333';
				height = '208';	
			}
			else if(4 ==  newval){

				no_of_columns = '22';
				height = '154';	
			}
			else if(5 ==  newval){

				no_of_columns = '18';
				height = '121';	
			}

			$( '.mif_wrap .mif_feeds_holder .mif_grid_layout' ).css({"width": no_of_columns+'%', "height": height+'px'});
			$( '.mif_wrap .mif_masonary_main' ).css({"moz-column-count": newval, "-webkit-column-count": newval, "column-count": newval});
			
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_padding_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({"padding-top": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({ "padding-bottom": newval+'px'});
			
			
		});
	});
/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_padding_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({"padding-left": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_padding_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({ "padding-right": newval+'px'});
			
			
		});
	});

/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_margin_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({"margin-top": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_margin_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({"margin-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_margin_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({"margin-left": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_margin_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_single' ).css({ "margin-right": newval+'px'});
			
			
		});
	});
	
		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_likes]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_lnc_holder  .mif_likes' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap  .mif_lnc_holder  .mif_likes' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_likes_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_likes' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_likes_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_likes p, .mif_wrap .mif_lnc_holder .mif_likes .icon' ).css({"color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_likes_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_likes' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_likes_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_likes' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_comments]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_lnc_holder  .mif_coments' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap  .mif_lnc_holder  .mif_coments' ).fadeOut('slow');
			}
			
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_comments_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_coments' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_comments_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_coments p, .mif_wrap .mif_lnc_holder .mif_coments .icon' ).css({"color": newval});
			
			
		});
	}); 
	
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_comments_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_coments' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_comments_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_lnc_holder .mif_coments' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_feed_caption]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_caption' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap  .mif_caption' ).fadeOut('slow');
			}
			
		});
	});
		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_caption_background_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_caption ' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[caption_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_caption p' ).css({"color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_caption_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_caption' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_caption_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_caption' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});


		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_feed_external_link]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_external, .mif_wrap .mif_external_holder ' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap  .mif_external, .mif_wrap .mif_external_holder ' ).fadeOut('slow');
			}
			
		});
	});
	
		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_external_background_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_external ' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_external_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_external .icon' ).css({"color": newval});
			
			
		});
	}); 

	
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_external_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_external' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_external_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_external' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});


	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_feed_open_popup_icon]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_fulls .icon' ).fadeIn('slow');
			}else
			{
			$( '.mif_wrap  .mif_fulls .icon' ).fadeOut('slow');
			}
			
		});
	});
	
		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_icon_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_grid_layout .mif_fulls ' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_icon_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_fulls .icon, .mif_feed_popup .icon, .mif_wrap .mif_fulls .icon' ).css({"color": newval});
			
			
		});
	}); 

	
	/*
	* Change hover shadow color
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_hover_bg_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap  .mif_single .mif_overlay, .mif_wrap  .mif_single .mif_fulls{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[load_more_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_load_btns .mif_load_feeds' ).css('background-color', newval );
		});
	});


	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[load_more_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_load_btns .mif_load_feeds' ).css('color', newval );
		});
	});

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[load_more_hover_background_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap .mif_load_btns .mif_load_feeds:hover{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[load_more_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap .mif_load_btns .mif_load_feeds:hover{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[follow_btn_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_load_btns .mif_follow_btn' ).css('background-color', newval );
		});
	});


	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[follow_btn_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.mif_wrap .mif_load_btns .mif_follow_btn' ).css('color', newval );
		});
	});

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[follow_btn_hover_background_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap .mif_load_btns .mif_follow_btn:hover{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[follow_btn_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.mif_wrap .mif_load_btns .mif_follow_btn:hover{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_popup_icon_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_fulls' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_popup_icon_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_fulls' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[show_feed_cta]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_wrap  .mif_external_holder' ).fadeIn('slow');
				
			}else
			{
			$( '.mif_wrap  .mif_external_holder' ).fadeOut('slow');
			}
			
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_cta_text_color]', function( value ) {
		value.bind( function( newval ) {
		
				$( '.mif_wrap .mif_external_holder a' ).css({"color": newval});
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_cta_text_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('<style>.mif_wrap .mif_external_holder a:hover{color:' + newval + '!important}</style>').appendTo('head');
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_time_text_color]', function( value ) {
		value.bind( function( newval ) {
		
				$( '.mif_wrap .mif_header_time p' ).css({"color": newval});
		});
	});
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_seprator_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap .mif_default_layout, .mif_wrap .mif_full_layout' ).css({"border-color": newval});
			
			
		});
	});
	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_border_style]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_default_layout,.mif_wrap .mif_full_layout' ).css('border-style', newval );

		} );

	} );

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[feed_border_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_wrap  .mif_default_layout, .mif_wrap .mif_full_layout' ).css('border-bottom-width', newval+'px' );

		} );

	} );

								//======================================================================
												// PoUp Live Preview
								//======================================================================
	/*
	* Background color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_sidebar_bg]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption' ).css({"background-color": newval});
			
			
		});
	});	

	/*
	* content color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_sidebar_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_caption, .mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_text, .mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_all_comments .mif_popup_comment_holder .mif_comment_meta a, .mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_caption a' ).css({"color": newval});
			
			
		});
	});		

	/*
	* Show header
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_header]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_author_info' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_author_info' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show header logo
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_header_logo]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_author_info .mif_auth_logo' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_author_info .mif_auth_logo' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Header title color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_header_title_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_name_date .mif_author_name a' ).css({"color": newval});
			
			
		});
	});	

	/*
	* Header title color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_post_time_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_story_time' ).css({"color": newval});
			
			
		});
	});						


	/*
	* Show caption
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_caption]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_text' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_text' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show meta
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_meta]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	*  meta bg
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_meta_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share' ).css({"background": newval});
			
			
		});
	});	

	/*
	*  meta color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_meta_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share, .mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share .mif_popup_likes_holder a span, .mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share  .mif_popup_comments_holder, .mif_popup_main .mif_main-pop .mif_popup_caption  .mif_popup_meta_like_share .mif_popup_meta_right a' ).css({"color": newval});
			
			
		});
	});

	/*
	* Show reactions counter
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_reactions_counter]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share .mif_popup_likes_holder' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share .mif_popup_likes_holder' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show comments counter
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_comments_counter]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share .mif_popup_comments_holder' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_like_share .mif_popup_comments_holder' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show comments
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_comments]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_all_comments' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_all_comments' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show view on fb link
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_view_fb_link]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_right' ).fadeIn('slow');
			}else
			{
			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_meta_right' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	*  Comments bg
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_comments_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_all_comments .mif_popup_comment_holder .mif_comment_msg' ).css({"background-color": newval});
			
			
		});
	});	

	/*
	*  Comments color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_comments_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.mif_popup_main .mif_main-pop .mif_popup_caption .mif_popup_all_comments .mif_popup_comment_holder .mif_comment_msg' ).css({"color": newval});
			
			
		});
	});	

	/*
	* Show close Icon
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_show_close_icon]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.fancybox-container .mif_popup_main.fancybox-content .fancybox-close-small' ).fadeIn('slow');
			}else
			{
			$( '.fancybox-container .mif_popup_main.fancybox-content .fancybox-close-small' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	*  Close Icon bg color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_close_icon_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.fancybox-container .mif_popup_main.fancybox-content .fancybox-close-small' ).css({"background-color": newval});
			
			
		});
	});	

	/*
	*  Close Icon bg color
	*/	
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_close_icon_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.fancybox-container .mif_popup_main.fancybox-content .fancybox-close-small' ).css({"color": newval});
			
			
		});
	});	

	/*
	* Close hover bg.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_close_icon_bg_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.fancybox-container .mif_popup_main.fancybox-content .fancybox-close-small:hover{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Close hover color.
	*/
	wp.customize( 'mif_skin_'+mif_skin_id+'[popup_close_icon_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.fancybox-container .mif_popup_main.fancybox-content .fancybox-close-small:hover{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );	

} )( jQuery );