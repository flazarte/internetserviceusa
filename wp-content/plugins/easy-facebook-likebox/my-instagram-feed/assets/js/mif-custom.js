jQuery( document ).ready(function($) {


	jQuery('#mif_feed_id.mif_wrap').slideDown( "slow", function() {});

	jQuery(document).on("click", ".mif_share_links", function($) {

		jQuery(this).next('.mif_links_container').slideToggle('medium', function() {
   		 if (jQuery(this).is(':visible'))
        jQuery(this).css('display','block');
		});

	

});
 
/* Premium Code Stripped by Freemius */


	//Feeds ajaxify products starts from here

	jQuery(".mif_load_feeds").live("click",  function($) {


	

		jQuery('#mif_load_btn').addClass('loading');

		

		var next_id = jQuery('#mif_next_pag').val();


		var current_items = jQuery('#mif_current_items').val();

		 var shortcode_atts = jQuery(this).data('shortcode_atts');
		

		jQuery.ajax({

			url : mif.ajax_url,

			type : 'post',

			dataType: 'json',

			data : {

				action : 'mif_load_more_feeds',

				current_items : current_items,

				shortcode_atts : shortcode_atts,

				next_id : next_id

			},

			success : function( response ) {

		

				jQuery('.mif_load_feeds').removeClass('loading');

				if(response.success){
						   // console.log(response); return;

					
					var next_item = response.data.mif_next_items;

					var next_id = response.data.next_id;


					// if (next_id == null){
					// 	next_id = 0; jQuery('#mif_load_btn').slideUp('slow');
					// } 

					if(jQuery('#mif_feed_id').data('template') === 'masonary'){

						 
/* Premium Code Stripped by Freemius */

						
					}
					else{
						jQuery('.mif_feeds_holder').append(response.data.html);
					}	

					 
/* Premium Code Stripped by Freemius */
			


						jQuery('#mif_current_items').val(next_item);

						jQuery('#mif_next_pag').val(response.data.next_id);
	
				}
				else{
						jQuery('.mif_feeds_holder').append(response.data.html);
				}



			}

		});


	});	
	
if(mif.version === 'pro'){	
		$(function () {

  $('.mif-popup-carousel-container')
      // Listen to the events
      .on('fotorama:load ' +   // Stage image of some frame is loaded
          'fotorama:showend',  // End of the show transition
          function (e, fotorama, extra) {

              getImageSize($('.fotorama__active .carousel-item img'), function(width, height) {
                  const aspectRatio = width / height;
                  fotorama.resize({
                      width: "100%",
                      ratio: aspectRatio,
                      minwidth: 50,
                      maxwidth: "100%",
                      minheight: 50,
                      maxheight: "100%",
                  }, 500)
              });
              function getImageSize(img, callback) {
                  var $img = $(img);
                  if ($img[0] != undefined) {
                      var wait = setInterval(function() {
                          var w = $img[0].naturalWidth,
                              h = $img[0].naturalHeight;
                          if (w && h) {
                              clearInterval(wait);
                              callback.apply(this, [w, h]);
                          }
                      }, 30);
                  }
              }
          }
      )
}); 

}
/* </fs_premium_only> */	

 });	