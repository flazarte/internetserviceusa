jQuery(window).load(function() {
		// Animate loader off screen
		jQuery(".esf_loader_wrap").fadeOut();
	});
jQuery( document ).ready(function($) {

	jQuery('.espf_HideblackFridayMsg').click(function(){
                   var data={'action':'espf_black_friday_dismiss'}
                         jQuery.ajax({
                    
                    url: fta.ajax_url,
                    type: "post",
                    data: data,
                    dataType: "json",
                    async: !0,
                    success: function(e ) {
                        
                        if (e=="success") {
                            jQuery('.espf_black_friday_msg').slideUp('fast');
                           
                        }
                    }
                     });
     });

	$('.modal').modal();

	 $('select').material_select();

	 document.querySelectorAll('.select-wrapper').forEach(t => t.addEventListener('click', e=>e.stopPropagation()));  // fixes first click

	 $('ul.tabs').tabs();

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

	/*
	* Activate/deactivate the plugin.
	*/
	jQuery(document).on("click", ".fta_tab_c_holder .fta_all_plugs .card .fta_plug_activate", function($) {

		Materialize.Toast.removeAll();

		var plugin = jQuery(this).data('plug');

		var status = jQuery(this).data('status');

		var toast_msg = null;

		if(status === 'activated'){
			toast_msg = 'Deactivating';
			status = 'deactivated';
		}
		else{
			toast_msg = 'Activating';
			status = 'activated';
		}
		// console.log(plugin);

		Materialize.toast(toast_msg, 40000);

	var data = { action:'fta_plugin_status',
				plugin: plugin,
				status : status,
				fta_nonce : fta.nonce
			  }

	jQuery.ajax({
			
		  url : fta.ajax_url,
		  type: "post",
		  data: data,
	      dataType: "json",
          success: function(response ) {
          	
          	Materialize.Toast.removeAll();

           if (response.success) {

           	Materialize.toast(response.data, 4000);
           	 window.location.href=window.location.href;
				
			} 
			else{
				Materialize.toast(response.data, 4000);
				}
		}});
	 });/* mif_auth_sub func ends here. */	

	/*
	* Delete account or page the plugin.
	*/
	jQuery(document).on("click", ".efbl_delete_at_confirmed", function($) {

		Materialize.Toast.removeAll();

		Materialize.toast('Deleting', 40000);

	var data = { action:'fta_remove_at',
				fta_nonce : fta.nonce
			  }

	jQuery.ajax({
			
		  url : fta.ajax_url,
		  type: "post",
		  data: data,
	      dataType: "json",
          success: function(response ) {
          	
          	Materialize.Toast.removeAll();

           if (response.success) {

           	Materialize.toast(response.data, 4000);
           	jQuery(".efbl_all_pages").slideUp("slow").remove();
			jQuery(".fta_noti_holder").fadeIn("slow");	
			} 
			else{
				Materialize.toast(response.data, 4000);
				}
		}});
	 });/* mif_auth_sub func ends here. */		


	/*
* Copying Page ID.
*/
jQuery(document).on("click", ".efbl_copy_id", function($) {	

	/*
	* Hiding the create new button to make look and feel awesome.
	*/
	var page_id = new ClipboardJS('.efbl_copy_id');


	
	 page_id.on('success', function(e) {

	 	Materialize.Toast.removeAll();
	 	/*
		* Show the dialog.
		*/
		Materialize.toast( 'Copied',  4000);


	  });

  page_id.on('error', function(e) {
  	Materialize.Toast.removeAll();
  		/*
		* Show the dialog.
		*/
		
		Materialize.toast('Something went wrong!', 4000);

  });


 });/* efbl_create_skin func ends here. */

var url_vars = getUrlVars();

/*
* Activate sub tab according to the URL
*/
if(url_vars['sub_tab']){

	var sub_tab = url_vars['sub_tab'];

	var items = sub_tab.split('#');

	sub_tab = items['0'];

	jQuery('.efbl-tabs-vertical .efbl_si_tabs_name_holder li a').removeClass('active');

	jQuery('.efbl-tabs-vertical .efbl_si_tabs_name_holder li a[href^="#'+sub_tab+'"]').addClass('active');

	jQuery('.efbl-tabs-vertical .tab-content').removeClass('active').hide();

	jQuery('.efbl-tabs-vertical #'+sub_tab).addClass('active').fadeIn('slow');

}



 });	