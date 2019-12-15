<?php
      global $product;
      //current number for city to call
      $citynumber = get_field('city_number');

 ?>

<div class="testimonials-item">
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image"><a href="https://www.hughesnet.com/" target="_blank" rel="nofollow">
              <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-12-250x130.jpg" alt="internet service usa" title=""></a>
              <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7">HughesNet </br>
              <span class="fa fa-star checked"></span>
<span class="fa fa-star-half checked"></span>
<span class="fa fa-star "></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span>&nbsp;
<i style="font-size:12px" class="fa"  data-toggle="tooltip" data-placement="bottom" title="According to 25% user recommendation rating.">&#xf059;</i></span></div>
            <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7">
                </div>
            </div>
          </div>
          <div class="testimonials-caption col-lg-9 col-md-8">
            <div class="user_text ">
               <?php  if( have_rows('hughesnet_body_content') ):

              while( have_rows('hughesnet_body_content') ): the_row();

              $per_city_coverage = get_sub_field('per_city_coverage');
  

                ?>
              <p class="mbr-fonts-style  display-7"><span><button class="btn btn-primary btn-xs" data-toggle="collapse" href="#hugs-info" role="button" aria-expanded="false" aria-controls="resi-info">SATELLITE</button></span></br>HughesNet is a satellite internet provider with service available to <?php echo  $per_city_coverage;?>% of <?php echo $product->get_name(); ?>.</p>
              <?php endwhile; ?>
              <?php endif; ?>
            </div>

            <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:<?php echo $citynumber;?>"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
                   <a class="btn btn-md btn-blue-outline display-4" data-toggle="collapse" href="#hugs-info" role="button" aria-expanded="false" aria-controls="resi-info"><span style="font-size:20px" class="fa" data-toggle="tooltip" data-placement="bottom" title="Click for Plans & Pricing.">&#xf059;</span>&nbsp;More Information</a></div>
            
          </div>
        </div>
      </div>
    <!--modal at&T --> 
  <div class="collapse" id="hugs-info">
     <div class="card">
  
  <div class="card-body ex">
    <div class="card-header">
    SATELLITE INTERNET IN <?php echo $product->get_name(); ?>
  </div>
    <div class="card card-body">
    <div class="row">
  <div class="col-sm-8">
HUGHESNET INTERNET PLANS
    <div class="card">
  <ul class="list-group list-group-flush">
  <!-- hughesnet plans -->

     <?php  if( have_rows('hughesnet_body_content') ):

              while( have_rows('hughesnet_body_content') ): the_row();

              $hughesnet_internet_plans = get_sub_field('hughesnet_internet_plans');
  
                echo $hughesnet_internet_plans;
                ?>



  <?php endwhile; ?>
  
 <?php endif; ?>
  <!-- end of plans -->
  </ul>
</div>
      
  </div>
  <div class="col-sm-4"><br>
    <div class="card border-primary mb-3 ex" style="max-width: 18rem;">
  <div class="card-header"><small>SET UP HUGHESNET INTERNET SERVICE</small></div>
  <div class="card-body text-primary">
    <p class="card-text">Average wait time to speak with our customer service support is less than 30 seconds.</p></div>
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:<?php echo $citynumber;?>" role="button"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
</div>

  <div class="container">
  <div class="row align-center">
    <div class="col"><p><small>City Coverage</small></p>
      <div class="progress">
         <?php
        if( have_rows('hughesnet_body_content') ):

  while( have_rows('hughesnet_body_content') ): the_row();

  $per_city_coverage = get_sub_field('per_city_coverage');
        ?>
  <div class="progress-bar" role="progressbar" style="width: <?php echo $per_city_coverage;?>%;" aria-valuenow="<?php echo $per_city_coverage;?>" aria-valuemin="0" aria-valuemax="<?php echo $per_city_coverage;?>"><?php echo $per_city_coverage;?>%</div>
</div>
<?php endwhile; ?>
    <?php endif;  wp_reset_query(); ?>
    </div>
    <div class="col" data-toggle="tooltip" data-html="true" title="<strong><em>Fast enough for</em><br>* Stream HD and 4K video<br>* Appropriate for smart homes<br>* Large file downloads"><p><small> Fastest Speed</small></p>
      <div class="progress">
         <?php
        if( have_rows('hughesnet_body_content') ):

  while( have_rows('hughesnet_body_content') ): the_row();

  $fastest_speed = get_sub_field('fastest_speed');
        ?>
  <div class="progress-bar" role="progressbar" style="width:  <?php echo $fastest_speed;?>%" aria-valuenow=" <?php echo $fastest_speed;?>" aria-valuemin="0" aria-valuemax=" <?php echo $fastest_speed;?>"> <?php echo $fastest_speed;?>Mbps</div>
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
      <p>Plans may not be available in all areas or to all customers and can expire at any time. Verify terms and availability with HughesNet. </p><br>
      <div class="card ex">
  <h5 class="card-header">HUGHESNET ACCESS IN <?php echo $product->get_name(); ?></h5>
  <div class="card-body">
    <p class="card-text">HughesNet is a satellite internet provider with service available to <?php echo $product->get_name(); ?></p>
  </div>
</div>
  </div>
  <div class="col-sm-4"></div>
</div>
</div></div></div></div>
  
  <!-- end modal at&T -->    
      