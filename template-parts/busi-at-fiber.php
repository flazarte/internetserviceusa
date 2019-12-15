  <?php
      global $product;
      //current number for city to call
      $citynumber = get_field('city_number');

 ?>

<div class="testimonials-item" >
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image"><a href="https://www.att.com/smallbusiness/explore/quickflow/small-business?source=IBQS2500C00080C4L" target="_blank" rel="nofollow">
              <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/at-fiber.jpg" alt="internet service usa" title=""></a>
              <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7">
                 AT&T Fiber </br>
                 <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star-half checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span><span>&nbsp;
<i style="font-size:12px" class="fa" data-toggle="tooltip" data-placement="bottom" title="According to 41% user recommendation rating.">&#xf059;</i></span>
  
</div>
                 
            <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7"></div>
            </div>

          </div>
          <div class="testimonials-caption col-lg-9 col-md-8">
            <div class="user_text ">
              <p class="mbr-fonts-style  display-7"><span><button class="btn btn-primary btn-xs"  data-toggle="collapse" href="#busi-fiber-info" role="button" aria-expanded="false" aria-controls="resi-info">FIBER</button></span></br>AT&T Fiber is an internet service provider offering Fiber coverage to 11.9% and a fastest speed 1,000 Mbps of <?php echo $product->get_name(); ?>. AT&T Business broadband packages start at $50/month.</p>
            </div>  

             <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:<?php echo $citynumber;?>"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
                    <a class="btn btn-md btn-blue-outline display-4" data-toggle="collapse" href="#busi-fiber-info" role="button" aria-expanded="false" aria-controls="resi-info"><span style="font-size:20px" class="fa" data-toggle="tooltip" data-placement="bottom" title="Click for Plans & Pricing.">&#xf059;</span>&nbsp;More Information</a></div>
            
          </div>
        </div>
      </div>

  <!--modal at&T --> 
  <div class="collapse" id="busi-fiber-info">
     <div class="card">
  
  <div class="card-body ex">
    <div class="card-header">
    AT&T INTERNET IN <?php echo $product->get_name(); ?>
  </div>
    <div class="card card-body">
    <div class="row">
  <div class="col-sm-8">
AT&T FIBER PLANS
    <div class="card">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#at-busi-fiber-resi" role="button" aria-expanded="false" aria-controls="resi-info">Business Fiber 50:</a> </br>$50.00/mo for 50Mbps</div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div>
<div class="collapse" id="at-busi-fiber-resi">
  <div class="card card-body ex">
   <ul>* Internet: 50Mbps with no data cap.</ul>
   <ul>* 2-years promo rate. Regular rates is $150.00.</ul>
   <ul>* Setup: $99.00 (Professional Installation)</ul>
   <ul>* Modem w/ WiFi included.</ul>
  </div>
</div></li><br>
<p>Plans may not be available in all areas or to all customers and can expire at any time.</p>


  </ul>
   <div class="card ex">
  <h5 class="card-header">AT&T FIBER IN <?php echo $product->get_name(); ?></h5>
  <div class="card-body">
    <p class="card-text">AT&T offers a small business internet plan for $50.00/mo with download speeds up to 50mbps. AT&T covers about 12% of <?php echo $product->get_name(); ?> with its fiber-based business internet services.</p>
   
  </div>
</div>
</div>
      
  </div>
  <div class="col-sm-4"><br>
    <div class="card border-primary mb-3 ex" style="max-width: 18rem;">
  <div class="card-header"><small>SET UP AT&T INTERNET SERVICE</small></div>
  <div class="card-body text-primary">
    <p class="card-text">Average wait time to speak with our customer service support is less than 30 seconds.</p></div>
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:<?php echo $citynumber;?>" role="button"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
</div>
<div class="container">
  <div class="row align-center">
    <div class="col"><p><small>City Coverage</small></p>
      <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 11%;" aria-valuenow="11" aria-valuemin="0" aria-valuemax="100">11.9%</div>
</div>
    </div>
    <div class="col" data-toggle="tooltip" data-html="true" title="<strong><em>Fast enough for</em><br>* Stream HD and 4K video<br>* Appropriate for smart homes<br>* Large file downloads"><p><small> Fastest Speed</small></p>
      <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">1000Mbps</div>
</div>
    </div>
  </div>
</div>
  </div>
</div><br>
<div class="row">
  <div class="col-sm-8">
     
  </div>
  <div class="col-sm-4"></div>
</div>
</div></div></div></div>
  
  <!-- end modal at&T -->  
  