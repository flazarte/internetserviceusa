jQuery(function($) {
    var canBeLoaded = true;    
    $(".ctn-shop-loadmore").click(function() {
      // AJAX
   var CatValue = $(".cat-name").data('value');
      var button = $(this),
        data = {
          action: "catloadmore",
          query: cat_loadmore_params.posts,
          page: parseInt(cat_loadmore_params.current_page) + 1,
          cat:  $(".cat-name").data('value')
          
        };
  
      if (canBeLoaded == true && $("#product-category").length) {
        var counter = parseInt(cat_loadmore_params.current_page) + 1;
       var countItem = $("#product-category .item").length;
       var dataValue = $("#product-category").data('value');
       var ItemValue = $(".cat-count").length;
       
    
        

      
     
        $.ajax({
          url: cat_loadmore_params.ajaxurl,
          data: data,
          type: 'POST',
          
          beforeSend: function(xhr) {
            button.text('Loading...');

           
            canBeLoaded = false;
          },

          success: function(response) {
            if (response.success) {
               button.text('Load more');
               var count = 0;
              var html = "";

              $(response.data.post).each(function(i, v) {
                count++;
                ItemValue++;

                html += '<div class="item on-sale cat-count" data-value="' + count + '" id="item-val">';
                if (v.post_sale == true) {
                    html += '<div class="sale-banner">Item on Sale!</div>';
                }
                html += '<div class="item-img">';
                 if(v.post_featured_image){
                   html += '<a href="' + v.permalink + '"><img src="' + v.post_featured_image + '" alt="' + v.post_title + '"></a>';
                }else{
                    html += '<a href="' + v.permalink + '"><img src="' + v.post_placeholder + '/images/product-placeholder.jpg" alt="Product Image Placeholder"></a>';
                }  
                html += '</div>';
                html += '<div class="item-body">';
                html += '<a href="' + v.permalink + '" class="item-name">' + v.post_title + '</a>';
                html += '<p class="item-desc">' + v.post_desc + '</p>';
                html += '<div class="price-con">';
                html += '<div class="left">';
                html += '<div class="item-no">Item# <span>' + v.post_id + '</span></div>';
                if (v.post_sale == true) {
                    html += '<div class="price">' + v.post_price + '</div>';
                } else {

                    html += '<div class="price" style="color: orange;">' + v.post_price + '</div>';

                }
                html += '</div>';
                html += '<div class="right">';
                if (v.post_external) {
                    html += '<a href="' + v.post_external_link + '" class="woocommerce-LoopProductImage-link shop-btn" rel="nofollow">';
                } else {

                   html += '<a href="' + v.permalink + '" class="shop-btn" rel="nofollow">';

                } 
                html += '<i class="fas fa-cart-plus"></i>';
                html += '<span>Shop Now</span>';
                html += '</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
      
              });


              
              $("#product-category").append(html);
              
  
              canBeLoaded = true;
              //if total item value loop + offset is equals to the total products published
              //button will hide
              if ( (ItemValue + 9) >= dataValue  ) {
                             
                button.hide(); 
                                   
              }



            } else {
             //do nothing
            }

            cat_loadmore_params.current_page++;
          }
        });
      }
    });
  });
  