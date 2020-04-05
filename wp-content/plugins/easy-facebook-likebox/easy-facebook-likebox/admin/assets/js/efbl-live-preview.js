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
// console.log(efbl_skin_id);
	/*
	* Show or hide header in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_header]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.efbl_feed_wraper .efbl_header' ).slideDown('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_header' ).slideUp('slow');
			}
			
		});
	});

	/*
	* Show or hide next prev icon in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_next_prev_icon]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.efbl_feed_wraper .owl-nav' ).slideDown('slow');
			}else
			{
			$( '.efbl_feed_wraper .owl-nav' ).slideUp('slow');
			}
			
		});
	});

	/*
	* Show or hide header in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_nav]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.efbl_feed_wraper .owl-dots' ).slideDown('slow');
			}else
			{
			$( '.efbl_feed_wraper .owl-dots' ).slideUp('slow');
			}
			
		});
	});

	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[wraper_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_feeds_carousel' ).css('background-color', newval );
		});
	});

	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[nav_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_feeds_carousel .owl-dots .owl-dot span' ).css('background', newval );
		});
	});

		/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[nav_active_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_feeds_carousel .owl-dots .owl-dot.active span' ).css('background', newval );
		});
	});

	wp.customize( 'efbl_skin_'+efbl_skin_id+'[nav_active_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper .owl-theme .owl-dots .owl-dot:hover span{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[load_more_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_load_more_holder a' ).css('background-color', newval );
		});
	});


	/*
	* Updates background color of loadmore in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[load_more_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_load_more_holder a' ).css('color', newval );
		});
	});

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[load_more_hover_background_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper .efbl_load_more_holder a:hover{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[load_more_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper .efbl_load_more_holder a:hover{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );
	
	/*
	* Updated background color of header in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_header' ).css('background-color', newval );
		});
	});


	/*
	* Updated color of header in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.efbl_feed_wraper .efbl_header, .efbl_feed_wraper .efbl_header .efbl_cat, .efbl_feed_wraper .efbl_header .efbl_followers, .efbl_feed_wraper .efbl_header .efbl_bio, .efbl_feed_wraper .efbl_header .efbl_header_title, .efbl_feed_wraper .efbl_header_time .efbl_header_title' ).css('color', newval );
		});
	});

	/*
	* Updated the title size of header.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[title_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header .efbl_header_title' ).css('font-size', newval+'px' );

		} );

	} );

	/*
	* Show or hide display picture in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_dp]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper .efbl_header .efbl_header_img' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_header .efbl_header_img' ).fadeOut('slow');
			}
			
		});
	});


	/*
	* Show rounded or boxed dp.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_round_dp]', function( value ) {

		value.bind( function( newval ) {

			if(newval){
				$( '.efbl_feed_wraper .efbl_header_img img' ).css('border-radius', '50%' );	
			}else
			{
		
			$( '.efbl_feed_wraper .efbl_header_img img' ).css('border-radius', '0px' );
			}

		} );

	} );


	/*
	* Show or hide total number of feeds in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_page_category]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper .efbl_header .efbl_cat' ).fadeIn('slow').css("display","inline-block");
			}else
			{
			$( '.efbl_feed_wraper .efbl_header .efbl_cat' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of feeds in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_shadow]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper #efblcf.efbl_fb_story.grid, .efbl_feed_wraper #efblcf.efbl_fb_story.masonry' ).css("box-shadow","0 0 10px 0 rgba(0,0,0,0.15)");
			}else
			{
			$( '.efbl_feed_wraper #efblcf.efbl_fb_story.grid, .efbl_feed_wraper #efblcf.efbl_fb_story.masonry' ).css("box-shadow","none");
			}
			
		});
	});
		
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_no_of_followers]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper .efbl_header .efbl_followers' ).fadeIn('slow').css("display","inline-block");
			}else
			{
			$( '.efbl_feed_wraper .efbl_header .efbl_followers' ).fadeOut('slow');
			}
			
		});
	});
	
	/*
	* Updated the title size of total posts and followers in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[metadata_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header .efbl_cat, .efbl_feed_wraper .efbl_header .efbl_followers' ).css('font-size', newval+'px' );

		} );

	} );


	/*
	* Show or hide bio in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_bio]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper .efbl_header .efbl_bio' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_header .efbl_bio' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Updated the title size of bio in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[bio_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header .efbl_bio' ).css('font-size', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border Color in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[bio_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-color', newval );

		} );

	} );

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_border_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-color', newval );

		} );

	} );

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_border_style]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-style', newval );

		} );

	} );

	/*
	* Updated the Header Border top size in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_border_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-top-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border bottom size in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_border_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-bottom-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border left size in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_border_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-left-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Border left size in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_border_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('border-right-width', newval+'px' );

		} );

	} );

	/*
	* Updated the Header top padding in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_content_padding]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper #efblcf.efbl_fb_story.grid .efbl_post_content, .efbl_feed_wraper #efblcf.efbl_fb_story.grid .efbl_story_meta' ).css('padding', newval+'px' );

		} );

	} );

	/*
	* Updated the Header top padding in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_padding_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('padding-top', newval+'px' );

		} );

	} );

	/*
	* Updated the Header bottom padding in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_padding_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('padding-bottom', newval+'px' );

		} );

	} );

	/*
	* Updated the Header left padding in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_padding_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('padding-left', newval+'px' );

		} );

	} );


	/*
	* Updated the Header right padding in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_padding_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header' ).css('padding-right', newval+'px' );

		} );

	} );

	/*
	* Updated the Header Alignment in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_align]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_header .efbl_header_inner_wrap' ).css('float', newval );

		} );

	} );

	/*
	* Updated the Header shadow color of dp.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_dp_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper  .efbl_header a:hover .efbl_overlay{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Updated the Header shadow icon color of dp.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[header_dp_hover_icon_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper  .efbl_header .efbl_head_img_holder .efbl_overlay .icon{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_follow_btn]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_follow_btn' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_follow_btn' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_load_more_btn]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_load_more_btn ' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_load_more_btn ' ).fadeOut('slow');
			}
			
		});
	});

								//======================================================================
												// Feeds Live Preview
								//======================================================================
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_background_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"background-color": newval});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_shared_link_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story .efbl_shared_story' ).css({"background-color": newval});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_shared_link_heading_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story .efbl_shared_story .efbl_title_link a' ).css({"color": newval});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_shared_link_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story .efbl_shared_story .efbl_link_description' ).css({"color": newval});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_shared_link_border_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story .efbl_shared_story' ).css({"border-color": newval});
			
			
		});
	});


	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_text_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"color": newval});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_type_icon_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_feeds_holder .efbl_fb_story a.efbl_feed_fancy_popup .icon' ).css({"color": newval});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_header]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_fb_story .efbl_author_info ' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_fb_story .efbl_author_info ' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_shared_link]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_fb_story .efbl_shared_story' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper  .efbl_fb_story .efbl_shared_story' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide header in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_header_logo]', function( value ) {
		value.bind( function( newval ) {

			if(newval){
				$( '.efbl_feed_wraper  .efbl_fb_story .efbl_author_info .efbl_auth_logo' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper  .efbl_fb_story .efbl_author_info .efbl_auth_logo' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_likes]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_likes, .efbl_feed_wraper  .efbl_all_likes_wrap' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_likes, .efbl_feed_wraper  .efbl_all_likes_wrap' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_shares]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_shares' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_shares' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_comments]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_comments' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper .efbl_comments_wraper' ).remove();
			} 
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[number_of_cols]', function( value ) {
		var no_of_columns = null;
		var height = null;	
		value.bind( function( newval ) {
			
			if(1 ==  newval){
				no_of_columns = '98';
				height = '643';	
			}
			else if(2 ==  newval){

				no_of_columns = '49';
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

			$( '.efbl_feed_wraper .efbl_feeds_holder .efbl_grid_layout' ).css({"width": no_of_columns+'%', "height": height+'px'});
			$( '.efbl_feed_wraper .efbl_masonary_main' ).css({"moz-column-count": newval, "-webkit-column-count": newval, "column-count": newval});
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_padding_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_padding_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"padding-top": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_padding_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"padding-right": newval+'px'});
			
			
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_padding_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"padding-left": newval+'px'});
			
			
		});
	});


	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_margin_top]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"margin-top": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_margin_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({ "margin-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_margin_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({"margin-left": newval+'px'});
			
			
		});
	});
	

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_margin_right]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css({ "margin-right": newval+'px'});
			
			
		});
	});
	
		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_likes]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_lnc_holder  .efbl_likes' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper  .efbl_lnc_holder  .efbl_likes' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_meta_data_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_likes, .efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_comments, .efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_shares, .efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_all_likes_wrap' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_meta_data_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_story_meta .efbl_info span, .efbl_feed_wraper .efbl_story_meta .efbl_info span .icon' ).css({"color": newval});
			
			
		});
	}); 


	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_likes_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_lnc_holder .efbl_likes' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_likes_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_lnc_holder .efbl_likes' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_comments]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_comments' ).fadeIn('slow');
				$( '.efbl_feed_wraper .efbl_comments_wraper' ).css("display", 'block !important');
			}else
			{
			$( '.efbl_feed_wraper .efbl_story_meta .efbl_info  .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper .efbl_comments_wraper' ).css("display", 'none !important');
			}
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_comments_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper .efbl_lnc_holder .efbl_comments' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_comments_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper  .efbl_comments p, .efbl_feed_wraper .efbl_comments .icon' ).css({"color": newval});
			
			
		});
	}); 

	
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_comments_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper .efbl_lnc_holder .efbl_comments' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_comments_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_comments' ).fadeOut('slow');
			$( '.efbl_feed_wraper .efbl_lnc_holder .efbl_comments' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_feed_caption]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_story_text' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper  .efbl_story_text' ).fadeOut('slow');
			}
			
		});
	});
	
		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_caption_background_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_story_text ' ).css({"background-color": newval});
			
			
		});
	}); 

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[caption_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_story_text, .efbl_feed_wraper .efbl_story_text p, .efbl_feed_wraper .efbl_story_text a' ).css({"color": newval});
			
			
		});
	}); 

	
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_caption_padding_top_bottom]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_story_text' ).css({"padding-top": newval+'px', "padding-bottom": newval+'px'});
			
			
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_caption_padding_right_left]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_story_text' ).css({"padding-left": newval+'px', "padding-right": newval+'px'});
			
			
		});
	});

	
	
	
	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_feed_open_popup_icon]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_hover .icon ' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper  .efbl_hover .icon  ' ).fadeOut('slow');
			}
			
		});
	});
	

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_icon_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_hover .icon' ).css({"color": newval});
			
			
		});
	}); 



		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[show_feed_cta]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_feed_wraper  .efbl_read_more_link ' ).fadeIn('slow');
			}else
			{
			$( '.efbl_feed_wraper  .efbl_read_more_link ' ).fadeOut('slow');
			}
			
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_cta_text_color]', function( value ) {
		value.bind( function( newval ) {
		
				$( '.efbl_feed_wraper .efbl_read_more_link a' ).css({"color": newval});
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_cta_text_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper #efblcf.efbl_fb_story .efbl_read_more_link a:hover{color:' + newval + '!important}</style>').appendTo('head');
		});
	});

		/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_time_text_color]', function( value ) {
		value.bind( function( newval ) {
		
				$( '.efbl_feed_wraper .efbl_story_time' ).css({"color": newval});
		});
	});

	/*
	* Show or hide total number of followers in real time.
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_seprator_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper .efbl_fb_story' ).css({"border-color": newval});
			
			
		});
	});

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_border_style]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css('border-style', newval );

		} );

	} );

	/*
	* Updated the Header Border style in real time.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_border_size]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_feed_wraper  .efbl_fb_story' ).css('border-width', newval+'px' );

		} );

	} );

	/*
	* Change hover shadow color
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[feed_hover_bg_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.efbl_feed_wraper  .efbl_story_photo .efbl_hover{background:' + newval + '!important}</style>').appendTo('head');

		} );

	} );


								//======================================================================
												// PoUp Live Preview
								//======================================================================
	/*
	* Background color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_sidebar_bg]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption' ).css({"background-color": newval});
			
			
		});
	});	

	/*
	* content color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_sidebar_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_popup_caption, .efbl_popup_main .main-pop .caption .efbl_all_comments_holder .efbl_single_comment_holder .efbl_comment_time, .efbl_popup_main .main-pop .caption .efbl_all_comments_holder .efbl_single_comment_holder .efbl_comment_meta a, .efbl_popup_main .main-pop .caption .efbl_popup_caption a' ).css({"color": newval});
			
			
		});
	});		

	/*
	* Show header
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_header]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_author_info' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_author_info' ).fadeOut('slow');
			}
			
		});
	});

	/*
	* Show header logo
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_header_logo]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_author_info .efbl_auth_logo' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_author_info .efbl_auth_logo' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Header title color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_header_title_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_name_date .efbl_author_name a' ).css({"color": newval});
			
			
		});
	});	

	/*
	* Header title color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_post_time_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_story_time' ).css({"color": newval});
			
			
		});
	});						


	/*
	* Show caption
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_caption]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_popup_caption' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_popup_caption' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show meta
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_meta]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	*  meta bg
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_meta_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share' ).css({"background": newval});
			
			
		});
	});	

	/*
	*  meta color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_meta_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share, .efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share .efbl_popup_likes_holder a span, .efbl_popup_main .main-pop .caption  .efbl_popup_meta_like_share .efbl_view_story a' ).css({"color": newval});
			
			
		});
	});

	/*
	* Show reactions counter
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_reactions_counter]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share .efbl_popup_likes_holder' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share .efbl_popup_likes_holder' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show comments counter
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_comments_counter]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share .efbl_all_comments_count' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_like_share .efbl_all_comments_count' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show comments
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_comments]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_all_comments_holder' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_all_comments_holder' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	* Show view on fb link
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_view_fb_link]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_right' ).fadeIn('slow');
			}else
			{
			$( '.efbl_popup_main .main-pop .caption .efbl_popup_meta_right' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	*  Comments bg
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_comments_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_all_comments_holder .efbl_single_comment_holder .efbl_comment_popup' ).css({"background-color": newval});
			
			
		});
	});	

	/*
	*  Comments color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_comments_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.efbl_popup_main .main-pop .caption .efbl_all_comments_holder .efbl_single_comment_holder .efbl_comment_popup' ).css({"color": newval});
			
			
		});
	});	

	/*
	* Show close Icon
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_show_close_icon]', function( value ) {
		value.bind( function( newval ) {
		
			if(newval){
				$( '.fancybox-container .efbl_popup_main.fancybox-content .fancybox-close-small' ).fadeIn('slow');
			}else
			{
			$( '.fancybox-container .efbl_popup_main.fancybox-content .fancybox-close-small' ).fadeOut('slow');
			}
			
		});
	});	

	/*
	*  Close Icon bg color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_close_icon_bg_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.fancybox-container .efbl_popup_main.fancybox-content .fancybox-close-small' ).css({"background-color": newval});
			
			
		});
	});	

	/*
	*  Close Icon bg color
	*/	
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_close_icon_color]', function( value ) {

		value.bind( function( newval ) {

			$( '.fancybox-container .efbl_popup_main.fancybox-content .fancybox-close-small' ).css({"color": newval});
			
			
		});
	});	

	/*
	* Close hover bg.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_close_icon_bg_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.fancybox-container .efbl_popup_main.fancybox-content .fancybox-close-small:hover{background-color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );

	/*
	* Close hover color.
	*/
	wp.customize( 'efbl_skin_'+efbl_skin_id+'[popup_close_icon_hover_color]', function( value ) {

		value.bind( function( newval ) {
			$('<style>.fancybox-container .efbl_popup_main.fancybox-content .fancybox-close-small:hover{color:' + newval + '!important}</style>').appendTo('head');

		} );

	} );


} )( jQuery );