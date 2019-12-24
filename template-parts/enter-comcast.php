  <?php
      global $product;
      //current number for city to call
      $citynumber = get_field('city_number');

 ?>

<div class="testimonials-item">
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image"><a href="https://business.comcast.com/enterprise" target="_blank" rel="nofollow">
              <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-3-250x130.jpg" alt="internet service usa" title=""></a>
              <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7">Comcast</br>
              <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span>&nbsp;
<i style="font-size:12px" class="fa"  title="According to 34% user recommendation rating.">&#xf059;</i></span></div>
            <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7">
                 </div>
            </div>
          </div>
          
          <div class="testimonials-caption col-lg-9 col-md-8">
            <div class="user_text">
              <p class="mbr-fonts-style  display-7"><span><button class="btn btn-primary btn-xs">CABLE</button></span></br>Comcast Business- Enterprise provides coverage for 82.92% of <?php echo $product->get_name(); ?>. The Fastest Speed is 987 Mbps.</p>
            </div>

             <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:<?php echo $citynumber;?>"><span><i class="fa fa-phone" aria-hidden="true"></i></span><?php echo $citynumber;?></a>
                    <a class="btn btn-md btn-blue-outline display-4" href="mailto:internetserviceusaseo@gmail.com"><span><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;</span>Request Quotation</a></div>
            
          </div>
        </div>
      </div> 
  