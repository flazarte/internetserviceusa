 <?php
      global $product;
      //current number for city to call
      $citynumber = '+1-833-492-4130';//get_field('city_number');

 ?>
      <div class="testimonials-item">
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image"><a href="https://www.xfinity.com/ " target="_blank" rel="nofollow">
              <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-17-250x130.jpg" alt="internet service usa" title=""></a>
               <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7">
                 Xfinity - Comcast </br>
                 <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star-half checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span>&nbsp;
<i style="font-size:12px" class="fa" data-toggle="tooltip" data-placement="bottom" title="According to 41% user recommendation rating.">&#xf059;</i></span></div>
                 
            <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7">
                 </div>
            </div>
          </div>
          <div class="testimonials-caption col-lg-9 col-md-8">
            <div class="user_text ">
              <?php  if( have_rows('xfinity_body_content') ):

              while( have_rows('xfinity_body_content') ): the_row();

              $per_city_coverage = get_sub_field('per_city_coverage');
  

                ?>
              <p class="mbr-fonts-style  display-7"><span><button class="btn btn-primary btn-xs" data-toggle="collapse" href="#comcast-info" role="button" aria-expanded="false" aria-controls="resi-info">CABLE</button></span></br>Xfinity from Comcast offers internet, TV, and home phone delivered over cable in <?php echo  $per_city_coverage;?>% of <?php echo $product->get_name(); ?>.</p>
              <?php endwhile; ?>
              <?php endif; ?>
            </div>

              <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:<?php echo $citynumber;?>"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
                    <a class="btn btn-md btn-blue-outline display-4" data-toggle="collapse" href="#comcast-info" role="button" aria-expanded="false" aria-controls="resi-info"><span style="font-size:20px" class="fa" data-toggle="tooltip" data-placement="bottom" title="Click for Plans & Pricing.">&#xf059;</span>&nbsp;More Information</a></div>
            
           
          </div>
        </div>
      </div>
    <!--modal at&T --> 
  <div class="collapse" id="comcast-info">
     <div class="card">
  
  <div class="card-body ex">
    <div class="card-header">
    Xfinity INTERNET IN <?php echo $product->get_name(); ?>
  </div>
    <div class="card card-body">
    <div class="row">
  <div class="col-sm-8">
Xfinity from Comcast INTERNET PLANS
    <div class="card">
  <ul class="list-group list-group-flush">
    <!-- xfinity plans -->
 <?php  if( have_rows('xfinity_body_content') ):

              while( have_rows('xfinity_body_content') ): the_row();

              $xfinity_internet_plans = get_sub_field('xfinity_internet_plans');
  
                echo $xfinity_internet_plans;
                ?>



  <?php endwhile; ?>
  
 <?php endif; ?>
    <!-- end of plans -->

  </ul>
</div>
      
  </div>
  <div class="col-sm-4"><br>
    <div class="card border-primary mb-3 ex" style="max-width: 18rem;">
  <div class="card-header"><small>SET UP XFINITY INTERNET SERVICE</small></div>
  <div class="card-body text-primary">
    <p class="card-text">Average wait time to speak with our customer service support is less than 30 seconds.</p></div>
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:<?php echo $citynumber;?>" role="button"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
</div>
<div class="container">
  <div class="row align-center">
    <div class="col">
      
  </div>

   
    <div class="col" data-toggle="tooltip" data-html="true" title="<strong><em>Fast enough for</em><br>* Stream HD and 4K video<br>* Appropriate for smart homes<br>* Large file downloads"><p><small> Fastest Speed</small></p>
      <div class="progress">
        <?php
        if( have_rows('xfinity_body_content') ):

  while( have_rows('xfinity_body_content') ): the_row();

  $fastest_speed = get_sub_field('fastest_speed');
        ?>
  <div class="progress-bar" role="progressbar" style="width: <?php echo $fastest_speed;?>%" aria-valuenow="<?php echo $fastest_speed;?>" aria-valuemin="0" aria-valuemax="<?php echo $fastest_speed;?>"><?php echo $fastest_speed;?>Mbps</div>
</div>
<?php endwhile; ?>
    <?php endif;  wp_reset_query(); ?>
    </div>
  </div>
</div>
  </div>
</div><br>
<div class="row">
  <div class="col-sm-8">
      <p>We've noticed that plans offered by AT&T Internet vary by region, so be sure to verify pricing and plan terms with them before ordering service as all plans or promotions may not be available in all areas or to all customers and can expire at any time.</p><br>
      <div class="card ex">
  <h5 class="card-header">XFINITY ACCESS IN <?php echo $product->get_name(); ?></h5>
  <div class="card-body">
    <p class="card-text">Xfinity offers internet, TV, and home phone delivered over cable in <?php echo $product->get_name(); ?>.</p>
    <p class="card-text">Currently, we've cataloged five plans with prices ranging from $20.00-$80.00/mo that offer download from 25-1000mbps. Xfinity's plans have data caps in place.</p>
  </div>
</div>
  </div>
  <div class="col-sm-4"></div>
</div>
</div></div></div></div>
  
  <!-- end modal at&T --> 