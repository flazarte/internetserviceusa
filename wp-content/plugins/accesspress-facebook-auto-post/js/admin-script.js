(function ($) {
    $(function () {
        $('.asap-tab').click(function(){
           var attr_id = $(this).attr('id');
           var id = attr_id.replace('asap-tab-','');
           $('.asap-tab').removeClass('asap-active-tab');
           $(this).addClass('asap-active-tab'); 
           $('.asap-section').hide();
           $('#asap-section-'+id).show();
        });
        
        
        
        $('#asap-fb-authorize-ref').click(function(){
           $('input[name="asap_fb_authorize"]').click(); 
        });

        $('.asfap-apitype').change(function(){
           if (this.value === 'graph_api') {
               $('.apfap-graph-api-options').show();
               $('.apfap-android-api-options').hide();
            }
            else if (this.value === 'mobile_api') {
               $('.apfap-graph-api-options').hide();
              $('.apfap-android-api-options').show();
            }

        });

        var apitype = $(".asfap-apitype:checked").val();
        if (apitype === 'graph_api') {
               $('.apfap-graph-api-options').show();
               $('.apfap-android-api-options').hide();
         }
          else if (apitype === 'mobile_api') {
              $('.apfap-graph-api-options').hide();
              $('.apfap-android-api-options').show();
          }

      /*
     * Get Access Token
     */
      $('.asap-network-inner-wrap').on('click','.asap-generate-token-btn',function (e) {
        e.preventDefault();
        var fb_email = $('.asap-fb-emailid').val();
        var fb_password = $('.asap-fb-pass').val();
        $.ajax({
            type: 'post',
            url: asfap_backend_js_obj.ajax_url,
            data: {
                fb_email: fb_email,
                fb_password: fb_password,
                action: 'asfap_access_token_ajax_action',
                _wpnonce: asfap_backend_js_obj.ajax_nonce
            },
            beforeSend: function() {
                $('.asap-ajax-loader1').css('visibility','visible');
                $('.asap-ajax-loader1').css('opacity',1);
            },
            success: function (res) {
                if( res.type == 'success' ){
                    $('.asap-generated-atwrapper').slideDown('slow');
                    $('.asap-generated-access-token-wrapper').html('<iframe src="'+res.message+'" frameborder="1" scrolling="yes" id="fbFrame"></iframe>'); 
                    
                }
                else{
                    $('.asap-generated-atwrapper').hide();
                    $('.asap-generated-access-token-wrapper').html(res.message).css({color:'red'});
                }
                $('.asap-ajax-loader1').css('visibility','hidden');
                $('.asap-ajax-loader1').css('opacity',0);
            }
        });
    });

      var dropdown = $('#asap-button-template-floating');
      $('.asap-network-inner-wrap').on('click','.asap-add-account-button',function (e) {
        e.preventDefault();
        var token_url = $('#asap-generated-access-url').val();
        $.ajax({
            type: 'post',
            url: asfap_backend_js_obj.ajax_url,
            data: {
                token_url: token_url,
                action: 'asfap_add_account_action',
                _wpnonce: asfap_backend_js_obj.ajax_nonce
            },
            beforeSend: function (xhr) {
                $('.asap-ajax-loader').css('visibility','visible');
                $('.asap-ajax-loader').css('opacity',1);
            },
            success: function (res) {
                //console.log(res.result);
                if(res.type == 'success'){
                    $('#asap-error-msg').html(res.message).css({color:'green'}).delay(2000).fadeOut();
                    dropdown.empty();
                    $.each(res.result, function(key, value) {
                      if(key == "fap_user_accounts"){
                       $.each(this, function(k, v) {
                        if(k == "auth_accounts"){
                            $.each(this, function(akey, avalue) {
                                var auth_key = akey;
                                var auth_value = avalue;
                                dropdown.append($('<option></option>').attr('value', auth_key).text(auth_value)); 
                            });
                        }
                      });
                      } 
                   });
                  // To encode an object (This produces a string)
                  var json_str = JSON.stringify(res.result);
                  $('textarea#asap-account-all-json').html('');
                  $('textarea#asap-account-all-json').html(json_str);
                }
                else{
                    $('#asap-error-msg').html(res.message).css({color:'red'});
                }
                $('.asap-ajax-loader').css( 'visibility' , 'hidden' );
                $('.asap-ajax-loader').css( 'opacity', 0 );
            }
        });
    });


        
        
          });//document.ready close
}(jQuery));