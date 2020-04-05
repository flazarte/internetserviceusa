/*
* When document is loaded
*/
jQuery(document).ready(function($){

	/*
	* Getting the filter selected value from shortcode generator.
	*/
	jQuery('select#efbl_filter').on('change', function() {
	  if(this.value === 'events'){
	  	jQuery('.efbl_filter_events_wrap').slideDown('slow');
	  }else{
	  	jQuery('.efbl_filter_events_wrap').slideUp('slow');
	  }
	});

	/*
	* Getting the form submitted value from shortcode generator.
	*/
   jQuery(".efbl_shortcode_submit").click(function(event){

   	 /*
	* Prevnting to reload the page.
	*/
   	 event.preventDefault();

   	 var efbl_filter = null;
	
	/*
	* Getting mif_user_id
	*/
   	 var efbl_page_id = $( '#efbl_page_id' ).val();

  /*
	* Getting efbl_access_token
	*/
   	 var efbl_access_token = $( '#efbl_access_token' ).val();
   	
   	 /*
	* Getting Feeds Per Page
	*/
   	 var efbl_filter = $( '#efbl_filter' ).val();

   	 /*
	* Getting Caption Words
	*/
   	 var efbl_skin_id = $( '#efbl_skin_id' ).val();

   	 jQuery('.modal.open').modal('close');


		if(efbl_skin_id == 'free-grid' || efbl_skin_id === 'free-masonry' || efbl_skin_id === 'free-carousel'){
			jQuery('#efbl-'+efbl_skin_id+'-upgrade').modal('open');

			efbl_skin_id = efbl.default_skin_id;
		}

   	 /*
	* Getting Wrap Class
	*/
   	 var efbl_post_limit = $( '#efbl_post_limit' ).val();

   	    	 /*
		* Getting cache unit
		*/
	   	 var efbl_caption_words = $( '#efbl_caption_words' ).val(); 

	   	  /*
		* Getting cache duration
		*/
	   	 var efbl_cache_unit = $( '#efbl_cache_unit' ).val(); 

	   	  /*
		* Getting events filter
		*/
	   	 var efbl_filter_events = $( '#efbl_filter_events' ).val();  


   	  /*
	* Getting Skin ID
	*/
   	 var efbl_cache_duration = $( '#efbl_cache_duration' ).val();

   	/*
	* Getting cache duration
	*/
	var efbl_other_page = $( '#efbl_other_page' ).val(); 
   	

   	 if(efbl_skin_id){
		efbl_skin_id = 'skin_id="'+efbl_skin_id+'" ';
   	 }
   	 else{
   	 	efbl_skin_id = '';
   	 } 

   	  if(efbl_access_token){
		efbl_access_token = 'accesstoken="'+efbl_access_token+'" ';
   	 }
   	 else{
   	 	efbl_access_token = '';
   	 } 

   	 if(efbl_page_id){
		efbl_page_id = 'fanpage_id="'+efbl_page_id+'" ';
   	 }
   	 else{
   	 	efbl_page_id = '';
   	 } 

   	if(efbl_filter){
		efbl_filter = 'filter="'+efbl_filter+'" ';
   	 }
   	 else{
   	 	efbl_filter = '';
   	 } 

   	 if($( '#efbl_filter' ).val() === 'events'){

   	 	efbl_filter_events = 'events_filter="'+efbl_filter_events+'" ';

   	 }else{
   	 	efbl_filter_events = '';
   	 }	
   	 

   	  if(efbl_post_limit){
		efbl_post_limit = 'post_limit="'+efbl_post_limit+'" ';
   	 }else{
   	 	efbl_post_limit = '';
   	 } 


   	 if(efbl_caption_words){
		efbl_caption_words = 'words_limit="'+efbl_caption_words+'" ';
   	 }else{
   	 	efbl_caption_words = '';
   	 }	
   	 
   	 if(efbl_cache_unit){
		efbl_cache_unit = 'cache_unit="'+efbl_cache_unit+'" ';
   	 }else{
   	 	efbl_cache_unit = '';
   	 }	

   	  if(efbl_cache_duration){
		efbl_cache_duration = 'cache_duration="'+efbl_cache_duration+'" ';
   	 }else{
   	 	efbl_cache_duration = '';
   	 }

   	 if (jQuery('#efbl_link_new_tab').is(":checked"))
		{
		 efbl_link_new_tab = 'links_new_tab="1" ';
		}else{
			efbl_link_new_tab = 'links_new_tab="0" ';
		}

	 if (jQuery('#efbl_show_likebox').is(":checked"))
		{
		 efbl_show_likebox = 'show_like_box="1"';
		}else{
			efbl_show_likebox = 'show_like_box="0"';
		}

	if(efbl_other_page){
		efbl_page_id = 'fanpage_id="'+efbl_other_page+'" ';
	}	
    

     var shortcode_html = '[efb_feed '+efbl_page_id+''+efbl_access_token+''+efbl_filter+''+efbl_filter_events+''+efbl_caption_words+''+efbl_post_limit+''+efbl_skin_id+''+efbl_cache_unit+''+efbl_cache_duration+''+efbl_link_new_tab+''+efbl_show_likebox+']';

       	  
     jQuery('.efbl_generated_shortcode blockquote').html(' ');

     jQuery('.efbl_generated_shortcode blockquote').append(shortcode_html);

     jQuery('.efbl_generated_shortcode .efbl_shortcode_generated_final').attr('data-clipboard-text', shortcode_html);

     jQuery('.efbl_generated_shortcode').slideDown();
    
 	});/* Generated shortcode func ends here. */

jQuery(document).on("click", ".efbl_skin_redirect", function(event) {

	/*
	* Disabaling the deafult event.
	*/
	event.preventDefault();

	var skin_id = $(this).data('skin_id');
	var select_id = '.efbl_selected_account_'+skin_id;
	var selectedVal = $(select_id+" option").filter(":selected").val();
	var page_id = $(this).data('page_id');
	
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'efbl_create_skin_url',
				selectedVal : selectedVal,
				skin_id : skin_id,
				page_id : page_id,
				efbl_nonce : efbl.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : efbl.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {

				if(response.success){
					 Materialize.toast(response.data['0'], 4000);
					window.location.href = response.data['1']; 		
				}
				else{
					 Materialize.toast(response.data, 4000);
					 jQuery('#toast-container').addClass('esf-failed-notification');
				}
				
			}

		});/* Ajax func ends here. */

 });/* mif_create_skin func ends here. */


   	/*
	* Getting the form submitted value from shortcode generator.
	*/
   jQuery(".efbl_likebox_shortcode_submit").click(function(event){

   	 /*
	* Prevnting to reload the page.
	*/
   	 event.preventDefault();

   	 var tabs = null;
	
	/*
	* Getting mif_user_id
	*/
   	 var efbl_like_box_url = $( '#efbl_like_box_url' ).val();

   	
   	 /*
	* Getting Feeds Per Page
	*/
   	 var efbl_like_box_app_id = $( '#efbl_like_box_app_id' ).val();

   	 /*
	* Getting Caption Words
	*/
   	 var efbl_like_box_width = $( '#efbl_like_box_width' ).val();

   	 /*
	* Getting Wrap Class
	*/
   	 var efbl_like_box_height = $( '#efbl_like_box_height' ).val();

   	    	 /*
		* Getting cache unit
		*/
	   	 var efbl_like_box_locale = $( '#efbl_like_box_locale' ).val(); 

	   
   	

   	 if(efbl_like_box_url){
		efbl_like_box_url = 'fanpage_url="'+efbl_like_box_url+'" ';
   	 }
   	 else{
   	 	efbl_like_box_url = '';
   	 } 

   	 if(efbl_like_box_app_id){
		efbl_like_box_app_id = 'fb_appid="'+efbl_like_box_app_id+'" ';
   	 }
   	 else{
   	 	efbl_like_box_app_id = '';
   	 } 

   	if(efbl_like_box_width){
		efbl_like_box_width = 'box_width="'+efbl_like_box_width+'" ';
   	 }
   	 else{
   	 	efbl_like_box_width = '';
   	 } 
   	 

   	  if(efbl_like_box_height){
		efbl_like_box_height = 'box_height="'+efbl_like_box_height+'" ';
   	 }else{
   	 	efbl_like_box_height = '';
   	 } 


   	 if(efbl_like_box_locale){
		efbl_like_box_locale = 'locale="'+efbl_like_box_locale+'" ';
   	 }else{
   	 	efbl_like_box_locale = '';
   	 }	

   	 if (jQuery('#efbl_tabs_timeline').is(":checked"))
		{
		 efbl_tabs_timeline = 'timeline,';
		}else{
		efbl_tabs_timeline = '';
		}

	 if (jQuery('#efbl_tabs_events').is(":checked"))
		{
		 efbl_tabs_events = 'events,';
		}else{
		efbl_tabs_events = '';
		}
	 if (jQuery('#efbl_tabs_messages').is(":checked"))
		{
		 efbl_tabs_messages = 'messages';
		}else{
		efbl_tabs_messages = '';
		}	

	if((efbl_tabs_timeline != '') || (efbl_tabs_events != '') || (efbl_tabs_messages != '')){
		tabs = 'tabs="'+efbl_tabs_timeline+efbl_tabs_events+efbl_tabs_messages+'" ';
	}else{
		tabs = ""; 
	}

   	 
   	 // console.log(tabs); return;
   

   	 if (jQuery('#efbl_like_box_responsive').is(":checked"))
		{
		 efbl_like_box_responsive = 'responsive="1" ';
		}else{
			efbl_like_box_responsive = 'responsive="0" ';
		}

	 if (jQuery('#efbl_like_box_faces').is(":checked"))
		{
		 efbl_like_box_faces = 'show_faces="1" ';
		}else{
			efbl_like_box_faces = 'show_faces="0" ';
		}
    
     if (jQuery('#efbl_like_box_stream').is(":checked"))
		{
		 efbl_like_box_stream = 'show_stream="1" ';
		}else{
			efbl_like_box_stream = 'show_stream="0" ';
		}

	 if (jQuery('#efbl_like_box_cover').is(":checked"))
		{
		 efbl_like_box_cover = 'hide_cover="1" ';
		}else{
			efbl_like_box_cover = 'hide_cover="0" ';
		}
		
	 if (jQuery('#efbl_like_box_small_header').is(":checked"))
		{
		 efbl_like_box_small_header = 'small_header="1" ';
		}else{
			efbl_like_box_small_header = 'small_header="0" ';
		}		

	 if (jQuery('#efbl_like_box_hide_cta').is(":checked"))
		{
		 efbl_like_box_hide_cta = 'hide_cta="1"';
		}else{
			efbl_like_box_hide_cta = 'hide_cta="0"';
		}	

     var shortcode_html = '[efb_likebox '+efbl_like_box_url+''+tabs+''+efbl_like_box_app_id+''+efbl_like_box_width+''+efbl_like_box_height+''+efbl_like_box_locale+''+efbl_like_box_responsive+''+efbl_like_box_faces+''+efbl_like_box_stream+''+efbl_like_box_cover+''+efbl_like_box_small_header+''+efbl_like_box_hide_cta+']';

       	  
     jQuery('.efbl_likebox_generated_shortcode blockquote').html(' ');

     jQuery('.efbl_likebox_generated_shortcode blockquote').append(shortcode_html);

     jQuery('.efbl_likebox_generated_shortcode .efbl_likebox_shortcode_generated_final').attr('data-clipboard-text', shortcode_html);

     jQuery('.efbl_likebox_generated_shortcode').slideDown();
    
 	});/* Generated shortcode likeox func ends here. */

   /*
* Copying Shortcode.
*/
jQuery( ".efbl_copy_shortcode" ).click(function($) {

Materialize.Toast.removeAll();
	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	var mif_copy_shortcode = new ClipboardJS('.efbl_copy_shortcode');
	
	 mif_copy_shortcode.on('success', function(e) {
	 	Materialize.Toast.removeAll();
	    Materialize.toast('Copied!', 1000);
	  });

  mif_copy_shortcode.on('error', function(e) {
    Materialize.toast('Something went wrong!', 1000);
  });


 });/* mif_copy_shortcode func ends here. */

   /*
* Copying Shortcode.
*/
jQuery( ".efbl_likebox_copy_shortcode" ).click(function($) {

Materialize.Toast.removeAll();
	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	var mif_copy_shortcode = new ClipboardJS('.efbl_likebox_copy_shortcode');
	
	 mif_copy_shortcode.on('success', function(e) {
	 	Materialize.Toast.removeAll();
	    Materialize.toast('Copied!', 1000);
	  });

  mif_copy_shortcode.on('error', function(e) {
    Materialize.toast('Something went wrong!', 1000);
  });


 });/* mif_copy_shortcode func ends here. */

jQuery( ".efbl_auto_popup_redirect" ).click(function($) {
	jQuery('.efbl_tab_c_holder .efbl_tab_c').removeClass('active');
	jQuery('.efbl_tab_c_holder .efbl_tab_c').css('display', 'none');
	jQuery('.efbl_tab_c_holder #efbl-auto-popup').addClass('active');
	jQuery('.efbl_tab_c_holder #efbl-auto-popup').css('display', 'block');

 });	



    // Materialize.AutoInit();

    // jQuery('#efbl-auth-modal').modal({'startingTop': '40%'});

    var efbl_shortcode = jQuery('#efbl_popup_shortcode').val();


    efbl_shortcode = efbl_shortcode.replace(/\\/g, '');

     var efbl_shortcode = jQuery('#efbl_popup_shortcode').val(efbl_shortcode);


 /*
* Saving options values by ajax.
*/
jQuery(document).on("click", ".efbl_options", function($) {

	/*
	* Getting clicked option value.
	*/	
	var efbl_option = jQuery(this).data('option');

	/*
	* Intializing value variable.
	*/	
	var efbl_value = null;

	/*
	* Checking clicked option status.
	*/
	if(jQuery(this).is(":checked")) {

		/*
		* Value will be true if checked.
		*/	
	    efbl_value = 1;
   }
	else{

		/*
		* Value will be false if not checked.
		*/	
	   	efbl_value = 0;
   }

 // console.log(efbl_option); console.log(efbl_value);
 
   jQuery('#toast-container').slideUp('slow');

    Materialize.Toast.removeAll();

   /*
	* Show the dialog for Saving.
	*/
	Materialize.toast('Saving', 50000000);
// return;
	
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'efbl_save_popup_settings',
				efbl_value : efbl_value,
				efbl_option : efbl_option,
				efbl_nonce : efbl.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : efbl.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {

		jQuery('#toast-container').slideUp('slow');

			Materialize.Toast.removeAll();

		setTimeout(function(){

			// console.log(response.data);

  			/*
			* Show the dialog.
			*/
			Materialize.toast(response.data, 3000);

			if(response.success){
			jQuery('#toast-container').addClass('efbl_green');
			}else{
				jQuery('#toast-container').addClass('esf-failed-notification');
			}
	
		}, 500);			
			
		}

		});/* Ajax func ends here. */

 });/* efbl_options func ends here. */



	 /*
	*  making efblchangeTimer variable false.
	*/
	var efblchangeTimer = false;

	 /*
	* Saving options values by ajax.
	*/
	jQuery(".efbl_input_options").on("change",function($){

		/*
		* If Clear timer varibale is not false clear timeout.
		*/
	    if(efblchangeTimer !== false) clearTimeout(efblchangeTimer);

	    /*
		* Getting clicked option slug.
		*/	
		var efbl_option = jQuery(this).attr('id');

		/*
		* Getting clicked option value.
		*/	
		var efbl_value = jQuery(this).val();


	   jQuery('#toast-container').slideUp('slow');

	    Materialize.Toast.removeAll();

	   /*
		* Show the dialog for Saving.
		*/
		Materialize.toast('Saving', 50000000);

		/*
		* Collecting data for ajax call.
		*/
		var data = { action : 'efbl_save_popup_settings',
					efbl_value : efbl_value,
					efbl_option : efbl_option,
				efbl_nonce : efbl.nonce
		}	

		/*
		* Wait for .3 seconds and make ajax call to save values. 
		*/
	     efblchangeTimer = setTimeout(function(){
	        	
	       /*
			* Making ajax request to save values.
			*/	
			jQuery.ajax({
				url : efbl.ajax_url,
				type : 'post',
				data : data,
				dataType: 'json',
				success : function( response ) {

				jQuery('#toast-container').slideUp('slow');

				Materialize.Toast.removeAll();

				setTimeout(function(){

		  			/*
					* Show the dialog.
					*/
					Materialize.toast(response.data, 4000);

					if(response.success){
					jQuery('#toast-container').addClass('efbl_green');
					}else{
						jQuery('#toast-container').addClass('esf-failed-notification');
					}
			
				}, 500);			
					
				}

				});/* Ajax func ends here. */
	            efblchangeTimer = false;

	     },300);


	});/* efbl_input_options func ends here. */

		 /*
		*  making efblchangeTimer variable false.
		*/
		var efblchangeTimer = false;

	 /*
	* Saving options values by ajax.
	*/
	jQuery("#efbl_popup_shortcode").live("keyup",function($){
				/*
		* If Clear timer varibale is not false clear timeout.
		*/
	    if(efblchangeTimer !== false) clearTimeout(efblchangeTimer);

	    /*
		* Getting clicked option slug.
		*/	
		var efbl_option = jQuery(this).attr('id');

		/*
		* Getting clicked option value.
		*/	
		var efbl_value = jQuery(this).val();



	   jQuery('#toast-container').slideUp('slow');

	  	Materialize.Toast.removeAll();

	   /*
		* Show the dialog for Saving.
		*/
		Materialize.toast('Saving', 50000000);

		/*
		* Collecting data for ajax call.
		*/
		var data = { action : 'efbl_save_popup_settings',
					efbl_value : efbl_value,
					efbl_option : efbl_option,
				efbl_nonce : efbl.nonce
		}	

		/*
		* Wait for .3 seconds and make ajax call to save values. 
		*/
	     efblchangeTimer = setTimeout(function(){
	        	
	       /*
			* Making ajax request to save values.
			*/	
			jQuery.ajax({
				url : efbl.ajax_url,
				type : 'post',
				data : data,
				dataType: 'json',
				success : function( response ) {


				jQuery('#toast-container').slideUp('slow');

				Materialize.Toast.removeAll();

				setTimeout(function(){

		  			/*
					* Show the dialog.
					*/
					Materialize.toast( response.data, 3000);

					if(response.success){
					jQuery('#toast-container').addClass('efbl_green');
					}else{
						jQuery('#toast-container').addClass('esf-failed-notification');
					}
			
				}, 500);			
					
				}

				});/* Ajax func ends here. */
	            efblchangeTimer = false;

	     },300);
	});	

	jQuery('select').on('change', function() {

		jQuery('.modal.open').modal('close');

		var selected_val = this.value;

		if(selected_val === 'free-grid' || selected_val === 'free-masonry' || selected_val === 'free-carousel'){
			jQuery('#efbl-'+selected_val+'-upgrade').modal('open');
		}
   		 
	
	});

	jQuery( ".efbl_skin_delete_confrim" ).click(function($) {
		var skin_id = jQuery(this).data('skin_id');
		jQuery('.modal.open').modal('close');
		jQuery('#efbl-remove-skin').modal('open');
		jQuery('.efbl-remove-skin.open .efbl_skin_delete').attr('data-skin_id', skin_id);
	 });/* efbl_skin_delete_confrim func ends here. */	

	jQuery( ".efbl_create_skin" ).click(function($) {

	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	jQuery(this).hide();

	jQuery(".efbl_show_all_skins").show();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.efbl_all_skins').slideUp();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.efbl_skin_head_wrap').slideUp();

	/*
	* Showing up the skin creataion form.
	*/
	jQuery('.efbl_new_skin ').slideDown();

 });/* efbl_create_skin func ends here. */	

jQuery( ".efbl_show_all_skins" ).click(function($) {

	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	jQuery(this).hide();

	jQuery(".efbl_create_skin").show();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.efbl_all_skins').slideDown();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.efbl_skin_head_wrap').slideDown();

	/*
	* Showing up the skin creataion form.
	*/
	jQuery('.efbl_new_skin ').slideUp();

 });/* efbl_create_skin func ends here. */		

	/*
* Copying Skin ID.
*/
jQuery( ".efbl_copy_skin_id" ).click(function($) {

	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	var skin_id = new ClipboardJS('.efbl_copy_skin_id');

	Materialize.Toast.removeAll();
	
	 skin_id.on('success', function(e) {

	 	Materialize.Toast.removeAll();
	 	/*
		* Show the dialog.
		*/
		Materialize.toast( 'Skin ID is copied',  1000);

	  });

  skin_id.on('error', function(e) {
  	Materialize.Toast.removeAll();
  		/*
		* Show the dialog.
		*/
		
		Materialize.toast('Something went wrong!', 4000);

  });


 });/* efbl_create_skin func ends here. */

 
/* Premium Code Stripped by Freemius */

jQuery(document).on("click", ".create_new_skin_fb", function($) {

	/*
	* Disabaling the deafult event.
	*/
	event.preventDefault();

	Materialize.Toast.removeAll();

	var selected_val = jQuery('#efbl_selected_layout').find(":selected").val();

	if(selected_val === 'free-grid' || selected_val === 'free-masonry' || selected_val === 'free-carousel'){
			jQuery('.modal.open').modal('close');
			
			jQuery('#efbl-'+selected_val+'-upgrade').modal('open');
			return;
		}

	/*
	* Show the dialog for Saving.
	*/
	Materialize.toast("Please wait! We are generating preview for you", 50000000);
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'efbl_create_skin',
				form_data : jQuery( '#efbl_new_skin_details' ).serialize(),
				efbl_nonce : efbl.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : efbl.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {
				// console.log(response); return;
				if(response.success){
					Materialize.Toast.removeAll();
					window.location.href = response.data; 		
				}
				else{
					 /*
					* Show the dialog.
					*/
					Materialize.toast(response.data, 4000);
					jQuery('#toast-container').addClass('esf-failed-notification');
				}
				
			}

		});/* Ajax func ends here. */

 });/* efbl_create_skin func ends here. */

var mediaUploader;

	$( '#efbl_skin_feat_img_btn' ).on( 'click', function(e) {
				 e.preventDefault();
			    // If the uploader object has already been created, reopen the dialog
			      if (mediaUploader) {
			      mediaUploader.open();
			      return;
			    }
			    // Extend the wp.media object
			    mediaUploader = wp.media.frames.file_frame = wp.media({
			      title: 'Choose Skin Featured Image',
			      button: {
			      text: 'Choose Skin Featured Image'
			    }, multiple: false });

			    // When a file is selected, grab the URL and set it as the text field's value
			    mediaUploader.on('select', function() {
			      var attachment = mediaUploader.state().get('selection').first().toJSON();
			      $('#efbl_new_skin_details #efbl_skin_feat_img').next('.mdl-textfield__label').text(' ');
			      $('#efbl_skin_feat_img').val(attachment.url);
			    });
			    // Open the uploader dialog
			    mediaUploader.open();
	});

jQuery(document).on("click", ".efbl_skin_delete", function(event) {
	var skin_id = event.currentTarget.dataset.skin_id;
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'efbl_delete_skin',
				skin_id : skin_id,
				efbl_nonce : efbl.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : efbl.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {
			Materialize.Toast.removeAll();
				if(response.success){

					if(jQuery('#efbl-skins .efbl_all_skins').html() == ""){
					jQuery('#efbl-skins .efbl_create_skin').slideUp('slow');
					jQuery('#efbl-skins .efbl_new_skin').slideDown('slow');
					}

					jQuery('.efbl_skin_'+response.data['1']).fadeOut('slow');
					/*
					* Show the dialog.
					*/
					
					Materialize.toast(response.data['0'],4000);
						
				}
				else{
					/*
					* Show the dialog.
					*/
					
					Materialize.toast(response.data,4000);
					jQuery('#toast-container').addClass('esf-failed-notification');
				}
				
			}

		});/* Ajax func ends here. */

 });/* efbl_create_skin func ends here. */

function EFBLremoveURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        url= urlparts[0]+'?'+pars.join('&');
        return url;
    } else {
        return url;
    }
} 

});
      

(function ( $ ) {
	$(function () {
		
		if ( $( '#efbl_enable_if_login' ).is(":checked") ) {
			$('#efbl_enable_if_not_login').removeAttr("checked"); 
			$('#efbl_enable_if_not_login').attr("disabled", true);
		}else if ( $( '#efbl_enable_if_login' ).is(":checked") ) {
			$('#efbl_enable_if_login').removeAttr("checked"); 
			$('#efbl_enable_if_login').attr("disabled", true);
		}
		
		$('#efbl_enable_if_login').click(function (){
		 
			 if ( $( this ).is(":checked")) {
					$('#efbl_enable_if_not_login').removeAttr("checked"); 
					$('#efbl_enable_if_not_login').attr("disabled", true);
					
 			  } else {
 				   $('#efbl_enable_if_not_login').removeAttr("disabled"); 
 					
			}
			 
		});
		
		$('#efbl_enable_if_not_login').click(function (){
		 
			 if ( $( this ).is(":checked")) {
					$('#efbl_enable_if_login').removeAttr("checked"); 
					$('#efbl_enable_if_login').attr("disabled", true);
					
 			  } else {
 				   $('#efbl_enable_if_login').removeAttr("disabled"); 
 					
			}
			 
		});

		$(".efbl_open_collapisble").click(function() {
			var id = $(this).data('id');
			id = '#'+id;

			var main_class = '.efbl_shortcode_accord li'+id;
			var header_class = '.efbl_shortcode_accord li'+id+' .collapsible-header';
			var body_class = '.efbl_shortcode_accord li'+id+' .collapsible-body';

			jQuery('.efbl_shortcode_accord li').removeClass('active');
			jQuery('.efbl_shortcode_accord li .collapsible-header').removeClass('active');
			jQuery('.efbl_shortcode_accord li .collapsible-body').slideUp('slow');

			jQuery(main_class).addClass('active');
			jQuery(header_class).addClass('active');
			jQuery(body_class).slideDown('slow');

		    $([document.documentElement, document.body]).animate({
		        scrollTop: $(id).offset().top
		    }, 1000);
		});

		$(".efbl_open_likebox_collapisble").click(function() {
			var id = $(this).data('id');
			id = '#'+id;

			var main_class = '.efbl_likebox_shortcode_accord li'+id;
			var header_class = '.efbl_likebox_shortcode_accord li'+id+' .collapsible-header';
			var body_class = '.efbl_likebox_shortcode_accord li'+id+' .collapsible-body';

			jQuery('.efbl_likebox_shortcode_accord li').removeClass('active');
			jQuery('.efbl_likebox_shortcode_accord li .collapsible-header').removeClass('active');
			jQuery('.efbl_likebox_shortcode_accord li .collapsible-body').slideUp('slow');

			jQuery(main_class).addClass('active');
			jQuery(header_class).addClass('active');
			jQuery(body_class).slideDown('slow');

		    $([document.documentElement, document.body]).animate({
		        scrollTop: $(id).offset().top
		    }, 1000);
		});

		$('.efbl_del_trans').click(function (){

			 jQuery('#toast-container').slideUp('slow');

		    Materialize.Toast.removeAll();

		   /*
			* Show the dialog for Saving.
			*/
			Materialize.toast( 'Deleting', 50000000);
		 
			/*
			* Getting clicked option value.
			*/	
			var efbl_option = jQuery(this).data('efbl_trans');
			var collection_class = jQuery(this).data('efbl_collection');
			

			var data = { action : 'efbl_del_trans',
				efbl_option : efbl_option,
				efbl_nonce : efbl.nonce
				}
				

			jQuery.ajax({
			url : efbl.ajax_url,
			type : 'POST',
			dataType: 'json',
			data : data,
			success : function( response ) {

				// console.log(response);return;


				jQuery('#toast-container').slideUp('slow');

				Materialize.Toast.removeAll();

				setTimeout(function(){

		  			/*
					* Show the dialog.
					*/
					Materialize.toast( response.data['0'], 3000);

					if(response.success){

					jQuery('#efbl-cached .collection-item.'+response.data['1']).slideUp('slow');

					var slug = '#efbl-cached .'+collection_class+' .collection-item';
					
					if(jQuery(slug).length == 0){
						//console.log(slug);
					jQuery('#efbl-cached .'+collection_class).slideUp('slow');
					}

					jQuery('#toast-container').addClass('efbl_green');
					}else{
						jQuery('#toast-container').addClass('esf-failed-notification');
					}
			
				}, 500);			
			
			}

			});/* Ajax func ends here. */			

			 
		});	
		

	});

}(jQuery));	