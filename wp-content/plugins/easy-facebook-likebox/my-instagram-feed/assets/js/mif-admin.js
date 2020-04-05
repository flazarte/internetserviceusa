jQuery( document ).ready(function($) {

 	$('#mif_tabs.tabs').tabs({
            swipeable : false
        });
 	$('.mif_loader_wrap').fadeOut("slow", function(){
 		this.remove();
 	});


	$('.modal').modal();

	 $('select').material_select();

	  document.querySelectorAll('.select-wrapper').forEach(t => t.addEventListener('click', e=>e.stopPropagation()));  // fixes first click

	 function getUrlVars()
		{
		    var vars = [], hash;
		    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		    for(var i = 0; i < hashes.length; i++)
		    {
		        hash = hashes[i].split('=');
		        vars.push(hash[0]);
		        vars[hash[0]] = hash[1];
		    }
		    return vars;
		}

	var mif_page = getUrlVars()["page"];

	if(mif_page ==  'mif-other-plugins'){
		jQuery("#mif_tabs li a").removeClass('active');
		jQuery(".mif_tab_c_holder .mif_tab_c").removeClass('active');
		jQuery(".mif_tab_c_holder .mif_tab_c").css('display', 'none');
		jQuery(".mif_tab_c_holder #mif-other-plugins").addClass('active');
		jQuery(".mif_tab_c_holder #mif-other-plugins").css('display', 'block');
		jQuery("#mif_tabs .mif-other-plugins").addClass('active');
	}


	jQuery(document).on("click", ".mif_del_trans", function($) {

	var transient_id = jQuery(this).data('mif_trans');
	var collection_class = jQuery(this).data('mif_collection');
	
	Materialize.Toast.removeAll();
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'mif_delete_transient',
				transient_id : transient_id,
				mif_nonce : mif.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : mif.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {

				if(response.success){

					jQuery('#mif-cache .collection-item.'+response.data['1']).slideUp();

						jQuery('#mif-cache .collection-item.'+response.data['1']).remove();

					var slug = '#mif-cache .'+collection_class+' .collection-item';
					
					if(jQuery(slug).length == 0){
						//console.log(slug);
					jQuery('#mif-cache .'+collection_class).slideUp('slow');
					}

					
					Materialize.toast(response.data['0'], 4000);		
				}
				else{
					 Materialize.toast(response.data, 4000);
					 jQuery('#toast-container').addClass('esf-failed-notification');
				}
				
			}

		});/* Ajax func ends here. */

 });/* mif_create_skin func ends here. */

jQuery('select').on('change', function() {

		jQuery('.modal.open').modal('close');

		var selected_val = this.value;

		if( selected_val === 'free-masonry' || selected_val === 'free-carousel' || selected_val === 'free-half_width' || selected_val === 'free-full_width'){
			jQuery('#mif-'+selected_val+'-upgrade').modal('open');
		}
   		 
	
});

jQuery(".mif_skin_delete_confrim").click(function ($) {
        var skin_id = jQuery(this).data('skin_id');
        jQuery('.modal.open').modal('close');
        jQuery('#mif-remove-skin').modal('open');
        jQuery('.mif-remove-skin.open .mif_skin_delete').attr('data-skin_id', skin_id);
});/* efbl_skin_delete_confrim func ends here. */	

/*
* Saving options values by ajax.
*/
jQuery( ".mif_create_skin" ).click(function($) {

	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	jQuery(this).hide();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.mif_show_all_skins').show();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.mif_all_skins').slideUp();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.mif_skin_head_wrap').slideUp();

	/*
	* Showing up the skin creataion form.
	*/
	jQuery('.mif_new_skin ').slideDown();

 });/* mif_create_skin func ends here. */

jQuery( ".mif_show_all_skins" ).click(function($) {

	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	jQuery(this).hide();

	jQuery(".mif_create_skin").show();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.mif_all_skins').slideDown();

	/*
	* Hiding the All skins html.
	*/
	jQuery('.mif_skin_head_wrap').slideDown();

	/*
	* Showing up the skin creataion form.
	*/
	jQuery('.mif_new_skin').slideUp();

 });/* efbl_show_all_skins func ends here. */		

/*
* Copying Skin ID.
*/
jQuery( ".mif_copy_skin_id" ).click(function($) {

Materialize.Toast.removeAll();
	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	var skin_id = new ClipboardJS('.mif_copy_skin_id');
	
	 skin_id.on('success', function(e) {
	 	Materialize.Toast.removeAll();
	    Materialize.toast('Skin ID is copied', 1000);
	  });

  skin_id.on('error', function(e) {
  	Materialize.Toast.removeAll();
    Materialize.toast('Something went wrong!', 4000);
  });


 });/* mif_create_skin func ends here. */

/*
* Copying Shortcode.
*/
jQuery( ".mif_copy_shortcode" ).click(function($) {

Materialize.Toast.removeAll();
	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	var mif_copy_shortcode = new ClipboardJS('.mif_copy_shortcode');
	
	 mif_copy_shortcode.on('success', function(e) {
	 	Materialize.Toast.removeAll();
	    Materialize.toast('Copied!', 1000);
	  });

  mif_copy_shortcode.on('error', function(e) {
    Materialize.toast('Something went wrong!', 1000);
  });


 });/* mif_copy_shortcode func ends here. */

jQuery(document).on("click", ".create_new_skin_sub", function(event) {

	/*
	* Disabaling the deafult event.
	*/
	event.preventDefault();

	Materialize.Toast.removeAll();

	var selected_val = jQuery('#mif_selected_layout').find(":selected").val();

	if(selected_val === 'free-masonry' || selected_val === 'free-carousel' || selected_val === 'free-half_width' || selected_val === 'free-full_width'){
			jQuery('.modal.open').modal('close');
			
			jQuery('#mif-'+selected_val+'-upgrade').modal('open');
			return;
		}

	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'mif_create_skin',
				form_data : jQuery( '#mif_new_skin_details' ).serialize(),
				mif_nonce : mif.nonce
	}	

	// console.log(data); return;
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : mif.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {

				if(response.success){
					window.location.href = response.data; 		
				}
				else{
					 Materialize.toast(response.data, 4000);
					 jQuery('#toast-container').addClass('esf-failed-notification');
				}
				
			}

		});/* Ajax func ends here. */

 });/* mif_create_skin func ends here. */

jQuery(document).on("click", ".mif_skin_redirect", function(event) {

	/*
	* Disabaling the deafult event.
	*/
	event.preventDefault();

	var skin_id = $(this).data('skin_id');
	var select_id = '.mif_selected_account_'+skin_id;
	var selectedVal = $(select_id+" option").filter(":selected").val();
	var page_id = $(this).data('page_id');
	
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'mif_create_skin_url',
				selectedVal : selectedVal,
				skin_id : skin_id,
				page_id : page_id,
				mif_nonce : mif.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : mif.ajax_url,
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

var mediaUploader;

	$( '#mif_skin_feat_img_btn' ).on( 'click', function(e) {
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
			      $('#mif_new_skin_details #mif_skin_feat_img').next('.mdl-textfield__label').text(' ');
			      $('#mif_skin_feat_img').val(attachment.url);
			    });
			    // Open the uploader dialog
			    mediaUploader.open();
	});

	

	jQuery(document).on('change', '#mif_multiple_users', function() {
  var accountsArr = jQuery(this).val();
  if (accountsArr.length > 2) {

   		Materialize.Toast.removeAll();

		Materialize.toast("You Can Select Maximum 2 Accounts", 4000);
    accountsArr = accountsArr.slice(0, 2);
    // reload the array to multiselect.
    jQuery('#mif_multiple_users').val(accountsArr).material_select();
  }
});


jQuery(document).on("click", ".mif_skin_delete", function(event) {
	var skin_id = event.currentTarget.dataset.skin_id;
	Materialize.Toast.removeAll();
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'mif_delete_skin',
				skin_id : skin_id,
				mif_nonce : mif.nonce
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : mif.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {

				if(response.success){

					if(jQuery('#mif-skins .mif_all_skins').html() == ""){
					jQuery('#mif-skins .mif_create_skin').slideUp('slow');
					jQuery('#mif-skins .mif_new_skin').slideDown('slow');
					}

                    jQuery('.mif_skin_' + response.data['1']).fadeOut();
					Materialize.toast(response.data['0'], 4000);		
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
   jQuery(".mif_shortcode_submit").click(function(event){

   	 /*
	* Prevnting to reload the page.
	*/
   	 event.preventDefault();


   	 var mif_hashtag = ' ';


	
		 /*
	* Getting mif_user_id
	*/
   	 var mif_user_id = $( '#mif_user_id' ).val();

 
   	
   	 /*
	* Getting Feeds Per Page
	*/
   	 var mif_feeds_per_page = $( '#mif_feeds_per_page' ).val();

   	 /*
	* Getting Caption Words
	*/
   	 var mif_caption_words = $( '#mif_caption_words' ).val();

   	 /*
	* Getting Wrap Class
	*/
   	 var mif_wrap_class = $( '#mif_wrap_class' ).val();

   	    	 /*
		* Getting cache unit
		*/
	   	 var mif_cache_unit = $( '#mif_cache_unit' ).val(); 

	   	  /*
		* Getting cache duration
		*/
	   	 var mif_cache_duration = $( '#mif_cache_duration' ).val(); 


   	  /*
	* Getting Skin ID
	*/
   	 var mif_skin_id = $( '#mif_skin_id' ).val();

   	  var mif_multiple_users = null;

	 
	 if(mif_user_id){
		mif_user_id = 'user_id="'+mif_user_id+'"';
   	 }else{
   	 	mif_user_id = '';
   	 }


   	 if(mif_skin_id){
		mif_skin_id = 'skin_id="'+mif_skin_id+'"';
   	 }
   	 else{
   	 	mif_skin_id = '';
   	 } 

   	  if(mif_feeds_per_page){
		mif_feeds_per_page = 'feeds_per_page="'+mif_feeds_per_page+'"';
   	 }else{
   	 	mif_feeds_per_page = '';
   	 } 

   	  if(mif_wrap_class){
		mif_wrap_class = 'wrapper_class="'+mif_wrap_class+'"';
   	 }else{
   	 	mif_wrap_class = '';
   	 }

   	 if(mif_caption_words){
		mif_caption_words = 'caption_words="'+mif_caption_words+'"';
   	 }else{
   	 	mif_caption_words = '';
   	 }	
   	 
   	 if(mif_cache_unit){
		mif_cache_unit = 'cache_unit="'+mif_cache_unit+'"';
   	 }else{
   	 	mif_cache_unit = '';
   	 }	

   	  if(mif_cache_duration){
		mif_cache_duration = 'cache_duration="'+mif_cache_duration+'"';
   	 }else{
   	 	mif_cache_duration = '';
   	 }

    

     var shortcode_html = '[my-instagram-feed '+mif_user_id+' '+mif_skin_id+' '+mif_feeds_per_page+' '+mif_wrap_class+' '+mif_caption_words+' '+mif_cache_unit+' '+mif_cache_duration+']';

       	  // console.log(shortcode_html); return;
     jQuery('.mif_generated_shortcode blockquote').html(' ');

     jQuery('.mif_generated_shortcode blockquote').append(shortcode_html);

     jQuery('.mif_generated_shortcode .mif_shortcode_generated_final').attr('data-clipboard-text', shortcode_html);

     jQuery('.mif_generated_shortcode').slideDown();
    
 	});/* Generated shortcode func ends here. */



function MIFremoveURLParameter(url, parameter) {
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