<?php
get_header();
?>

 <!-- Page Content -->
  <div class="container-fluid">
    <section class="placeholder-con">
 </section>
 <section class="engine"><a href=""></a></section><section class="cid-rtgokFkwN6" id="header2-5">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(3, 58, 129);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    Internet Service Provider USA</h1>
                
                <p class="mbr-text pb-3 mbr-fonts-style display-5">Internet Service USA connects you with the best internet service providers and we take time to study each of them.</p>
                <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="https://internetserviceusa.com/usa/search.php" target="_blank"><span class="mbri-map-pin mbr-iconfont mbr-iconfont-btn"></span>Zip Code Search</a> 
                    <a class="btn btn-md btn-white-outline display-4" href="https://internetserviceusa.com/speedtest/" target="_blank"><span class="mbri-speed mbr-iconfont mbr-iconfont-btn"></span>Speedtest</a></div>
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="fas fa-arrow-down"></i>
        </a>
    </div>
</section>


    
    <div class="row">
        
      <!-- Blog Entries Column -->
      <div class="col-md-8">

<section class="section-table cid-rtgvspRekY" id="table1-6">

  
  
  <div class="container container-table">
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-1"><strong>Check Your Broadband Statistics in Each State</strong></h2>
      <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"><strong>To ensure you get the best internet services, we’ll only recommend reputable internet service providers. Please select your location or state below.</strong></h3>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
          </div>
        </div>

        <div class="container scroll">
          <table class="table isSearch" cellspacing="0">
            <thead>
              <tr class="table-heads align-center">       
              <th class="head-item mbr-fonts-style display-7 blue">
                      State</th><th class="head-item mbr-fonts-style display-7 blue"> Broadband Coverage</th><th class="head-item mbr-fonts-style display-7 blue">Average State Speed</th><th class="head-item mbr-fonts-style display-7 blue"><strong>Option</strong>
                      </th></tr>
            </thead>

            <tbody>

             <?php

             global $product;

              $term = get_queried_object();
              $cat_slug =  $term->slug;

             //2. Hide Uncategorized
          $cat_uncat = get_term_by( 'slug', 'Uncategorized', 'product_cat' );
          $cat_id_uncat = $cat_uncat->term_id;

            $taxonomy     = 'product_cat';
            $orderby      = '';  
            $show_count   = 0;     
            $pad_counts   = 0;     
            $hierarchical = 1;     
            $title        = '';  
            $empty        = 0;
          $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty,
            'parent'       => 0,
           'exclude'      => array($cat_id_uncat),
          
          );

          $prod_categories = get_terms( $args);

             
             
             
             foreach( $prod_categories as $prod_cat ) :
            global $product; 
            $queried_object = get_queried_object();
            $taxonomies = $queried_object->taxonomy;
            $term_id = $queried_object->term_id;  
            $state_coverage = get_field('broadband_coverage',$prod_cat);
            $state_average_speed = get_field('average_state_speed',$prod_cat);
            $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
            $term_link = get_term_link( $prod_cat, 'product_cat' );

              ?>
                <tr class="align-center">
  
                
              <td class="body-item mbr-fonts-style display-7">
                <a href="<?php echo $term_link; ?>"><?php echo $prod_cat->name; ?>
                </a>
              </td>
              <td class="body-item mbr-fonts-style display-7"><?php echo $state_coverage; ?> %</td>
              <td class="body-item mbr-fonts-style display-7"><?php echo $state_average_speed; ?> Mbps</td>
              <td class="body-item mbr-fonts-style display-7">
                <a href="<?php echo $term_link; ?>"><strong>View</strong>
                </a>
              </td>

            </tr> 

              <?php endforeach;wp_reset_query(); 
                ?>

             


            </tbody>
          </table>
        </div>
        <div class="container table-info-container">
          <div class="row info">
            <div class="col-md-6">
              <div class="dataTables_info mbr-fonts-style display-7">
                <span class="infoBefore">Showing</span>
                <span class="inactive infoRows"></span>
                <span class="infoAfter">entries</span>
                <span class="infoFilteredBefore">(filtered from</span>
                <span class="inactive infoRows"></span>
                <span class="infoFilteredAfter"> total entries)</span>
              </div>
            </div>
            <div class="col-md-6"></div>
          </div>
        </div>
      </div>
    </div>
</section>

       
       <!--  <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="page1.php">&larr; Older</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="page1.php">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="page2.php">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="page3.php">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="index.php">4</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="index.php">Newer &rarr;</a>
          </li>
        </ul> -->

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <?php get_template_part('template-parts/search-city');?>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header pute"> Post Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <?php
          $uncategorized = get_cat_ID('uncategorized');
          $categories = get_categories( array(
             'orderby' => 'name',
             'order'   => 'ASC',
             'hide_empty' => 1,
             'exclude' => $uncategorized
               ) );

           foreach( $categories as $category ) {
          echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';   
             } 
            ?> 
                </ul>
              </div>
              <!-- <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">All Providers</a>
                  </li>
                  <li>
                    <a href="#">Detroit</a>
                  </li>
                  <li>
                    <a href="#">Chicago</a>
                  </li>
                </ul>
              </div>
            </div> -->
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header pute">About Us</h5>
          <div class="card-body">
            Internet Service USA, is a nationwide <a href="https://internetserviceusa.com/usa/all-providers.php">internet service provider</a>. Our focus is on assisting you to find the best internet, cable, and phone service provider in your region. To us, it is not just providing you with a list of internet service providers in your area. Our agents have spent years analyzing and scrutinizing internet providers so that we can provide accurate results.
          </div>

          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Side Bard Ads -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4712491227153267"
     data-ad-slot="2898573386"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        </div>

      </div>

    </div>
    <!-- /.row -->

</div>
  </div>
  <!-- /.container -->
  <section class="header11 cid-rtsjkFBok4 mbr-fullscreen mbr-parallax-background" id="header11-17">

    <!-- Block parameters controls (Blue "Gear" panel) -->
    
    <!-- End block parameters -->

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);">
    </div>
    <div class="container align-left">
        <div class="media-container-column mbr-white col-md-12">
            
            <h2 class="mbr-section-title py-3 mbr-fonts-style display-1">Internet Service USA with <strong>Home Security&nbsp;</strong>bundles! Stay safe in <strong>Affordable Price&nbsp;</strong>.
            </h2>
            <p class="mbr-text py-3 mbr-fonts-style display-2">
                With the right security system, you’ll pay lower insurance premiums and be at peace knowing your family is safe. Get in touch with our agents today and we’ll help you to access a tamper-proof home security system.
            </p>
            <div class="mbr-section-btn py-4"><a class="btn btn-md btn-primary display-4" href="mailto:internetserviceusaseo@gmail.com"><span class="mbr-iconfont mbr-iconfont-btn"><i class="fa fa-envelope" aria-hidden="true"></i></span>REQUEST QUOTATION</a></div>
        </div>
    </div>

    
</section>

<section class="mbr-section content4 cid-rtst08nocj" id="content4-1b">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Banner Ads -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4712491227153267"
     data-ad-slot="5204833219"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

    <div class="container" id="homesecurity">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-1"><strong>PREMIUM HOME SECURITY BUNDLES</strong></h2>
                
                
            </div>
        </div>
    </div>
</section>



    

    

<!-- Home security plans-->

   <section class="testimonials4 cid-rtlbaceGut" id="testimonials4-p">

  

  
  <div class="container">
    
    <div class="col-md-10 testimonials-container"> 
      
<div class="testimonials-item" >
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image"><a href="https://www.adt.com/" target="_blank" rel="nofollow">
              <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-1-250x130.jpg" alt="internet service usa" title="" ></a>
              <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7">
                 ADT Home Security
</div>
                 
            <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7"></div>
            </div>

          </div>
          <div class="testimonials-caption col-lg-9 col-md-8">
            <div class="user_text ">
              <p class="mbr-fonts-style  display-7"><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span><span>&nbsp;
<i style="font-size:12px" class="fa" data-toggle="tooltip" data-placement="bottom" title="According to 80% user recommendation rating.">&#xf059;</i></span></br>ADT home security monitoring helps protect your home 24/7 with interconnected monitoring centers located nationwide.
<br><hr>
Basic ADT Monitoring starting at $27.99/mo.</p>
            </div>  

             <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:8445931734"><span class="mbri-mobile mbr-iconfont mbr-iconfont-btn"><i class="fa fa-phone" aria-hidden="true"></i></span>+1-844-593-1734</a>
                    <a class="btn btn-md btn-blue-outline display-4" data-toggle="collapse" href="#resi-info" role="button" aria-expanded="false" aria-controls="resi-info"><span style="font-size:20px" class="fa" data-toggle="tooltip" data-placement="bottom" title="Click for Plans & Pricing.">&#xf059;</span>&nbsp;Security Packages</a></div>
            
          </div>
        </div>
      </div>

  <!--modal at&T --> 
  <div class="collapse" id="resi-info">
     <div class="card">
  
  <div class="card-body ex">
    <div class="card-header">
    ADT Monitoring Packages
  </div>
    <div class="card card-body">
    <div class="row">
  <div class="col-sm-8">
Home Security Bundles
    <div class="card">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#at-resi" role="button" aria-expanded="false" aria-controls="resi-info">Basic:<strong>$27.99</strong>/mo </a> </div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse show" id="at-resi">
  <div class="card card-body ex">
   <ul><strong>Services</strong> 
        <li>Security Monitoring (Landline Required)</li> </ul>
   <ul><strong>Equipment</strong>
        <li>Wireless Control Panel</li>
        <li>3 Wireless Door/Window Sensor</li>
        <li>1 Wireless Motion Detector(Pet Immune)</li>
        <li>Window Decals and Yard Signs</li></ul>
   <ul>*<strong>$99.00 </strong> Installation</ul>
   <ul>*<strong>Free</strong>  Security System</ul>
   
  </div>
</div></li>
<li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#directv-resi" role="button" aria-expanded="false" aria-controls="resi-info">Basic Wireless:<strong> $48.00</strong>/mo</a></div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse" id="directv-resi">
  <div class="card card-body ex">
   <ul><strong>Services</strong> 
        <li>Wireless Security Monitoring</li> 
        <li>Cellular Alarm Transmission</li></ul>
   <ul><strong>Equipment</strong>
        <li>Wireless Control Panel</li>
        <li>3 Wireless Door/Window Sensor</li>
        <li>1 Wireless Motion Detector(Pet Immune)</li>
        <li>Window Decals and Yard Signs</li>
        <li>1 Key Fob</li>
        <li>Cellular Alarm Transmission</li></ul>
   <ul>*<strong>$99.00 </strong> Installation</ul>
   
 </div>
</div></li>


<li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#directv-resi3" role="button" aria-expanded="false" aria-controls="resi-info">ADT Pulse:<strong> $52.99</strong>/mo</a></div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse" id="directv-resi3">
  <div class="card card-body ex">
   <ul><strong>Services</strong> 
        <li>Wireless Security Monitoring</li> 
        <li>Cellular Alarm Transmission</li>
        <li>Mobile Access + Alerts</li></ul>
   <ul><strong>Equipment</strong>
        <li>Wireless Control Panel</li>
        <li>3 Wireless Door/Window Sensor</li>
        <li>1 Wireless Motion Detector(Pet Immune)</li>
        <li>Window Decals and Yard Signs</li>
        <li>1 Key Fob</li>
        <li>Cellular Alarm Transmission</li></ul>
   <ul>*<strong>$199.00 </strong> Installation</ul>



   <li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#directv-resi4" role="button" aria-expanded="false" aria-controls="resi-info">ADT Pulse + Video:<strong> $58.99</strong>/mo</a></div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse" id="directv-resi4">
  <div class="card card-body ex">
   <ul><strong>Services</strong> 
        <li>Wireless Security Monitoring</li> 
        <li>Cellular Alarm Transmission</li>
        <li>Mobile Access + Alerts</li>
        <li>Video Surveillance</li></ul>
   <ul><strong>Equipment</strong>
        <li>Wireless Control Panel</li>
        <li>3 Wireless Door/Window Sensor</li>
        <li>1 Wireless Motion Detector(Pet Immune)</li>
        <li>Window Decals and Yard Signs</li>
        <li>1 Key Fob</li>
        <li>Cellular Alarm Transmission</li>
        <li>Video Camera</li></ul>
   <ul>*<strong>$299.00 </strong> Installation</ul>
   
 </div>
</div></li>


  </ul>
</div>
      
  </div>
  <div class="col-sm-4"><br>
    <div class="card border-primary mb-3 ex" style="max-width: 18rem;">
  <div class="card-header"><small>SET UP ADT SERVICE</small></div>
  <div class="card-body text-primary">
    <p class="card-text">Average wait time to speak with our customer service support is less than 30 seconds.</p></div>
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:8445931734" role="button"><span class="mbri-mobile2 mbr-iconfont mbr-iconfont-btn"><i class="fa fa-phone" aria-hidden="true"></i></span>+1-844-593-1734</a>
</div>
 <div class="container">
  <div class="row align-center">
   <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-1-250x130.jpg" alt="internet service usa adt" title="">
  </div>
</div>

  </div>
</div><br>
<div class="row">
  <div class="col-sm-8">
      <p>Experience matters. ADT monitoring has helped keep families safe for over 140 years and now serves nearly 6 million homes.</p><br>
      <div class="card ex">
  <h5 class="card-header">Get a Custom ADT Monitored Home Security System</h5>
  <div class="card-body">
    <p class="card-text">We don’t believe in the phrase “one size fits all.” That’s why Protect Your Home, an ADT Authorized Premier Provider, customizes your entire experience–from your free quote to your quick and easy installation. The first thing you’ll need to do is research packages and pricing. Then call <a href="tel:8445931734">+1-844-593-1734</a> for more details.</p>
    <p class="card-text"><ul>
          <li>No drilling  into your walls</li>
          <li>Quick setup</li>
          <li>No phone line required</li>
    </ul></p>
    <p class="card-text">For about $1 a day, ADT monitoring offers you peace of mind from burglary and theft, so you can get back to living your life.</p>
  </div>
</div>
  </div>
  <div class="col-sm-4"></div>
</div>
</div></div></div></div>
  
  <!-- end modal at&T --> 
      
<div class="testimonials-item" >
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image"><a href="https://www.vivint.com/" target="_blank" rel="nofollow">
              <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-15-250x130.jpg" alt="internet service usa" title="" ></a>
              <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7">
                 VIVINT Smart Home
</div>
                 
            <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7"></div>
            </div>

          </div>
          <div class="testimonials-caption col-lg-9 col-md-8">
            <div class="user_text ">
              <p class="mbr-fonts-style  display-7"><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span><span>&nbsp;
<i style="font-size:12px" class="fa" data-toggle="tooltip" data-placement="bottom" title="According to 70% user recommendation rating.">&#xf059;</i></span></br>Vivint is best known for its well-designed equipment and easy-to-integrate home automation. Even its most basic equipment package includes professional installation, the Vivint Sky app, and plenty of sensors. Vivint also stands out for using cellular-based systems, catering to both homes and businesses, and making contract exceptions for military families.
<br><hr>
Vivint Monitoring starting at $29.99/mo.</p>
            </div>  

             <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:8445931734"><span class="mbri-mobile mbr-iconfont mbr-iconfont-btn"><i class="fa fa-phone" aria-hidden="true"></i></span>+1-844-593-1734</a>
                    <a class="btn btn-md btn-blue-outline display-4" data-toggle="collapse" href="#resi-info1" role="button" aria-expanded="false" aria-controls="resi-info"><span style="font-size:20px" class="fa" data-toggle="tooltip" data-placement="bottom" title="Click for Plans & Pricing.">&#xf059;</span>&nbsp;Security Packages</a></div>
            
          </div>
        </div>
      </div>

  <!--modal at&T --> 
  <div class="collapse" id="resi-info1">
     <div class="card">
  
  <div class="card-body ex">
    <div class="card-header">
    Vivint Packages and Cost
  </div>
    <div class="card card-body">
    <div class="row">
  <div class="col-sm-8">
Home Security Bundles
    <div class="card">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#at-resi2" role="button" aria-expanded="false" aria-controls="resi-info">Home Security System Bundle:<strong>$11.83</strong>/mo </a> </div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse show" id="at-resi2">
  <div class="card card-body ex">
   <ul><strong>Equipment</strong> 
        <li>SkyControl Starter Kit</li>
        <li>Smoke Detector</li> </ul>
   <ul>*<strong>$709.98 </strong> Total Cost</ul>
   <ul>*<strong>$11.83</strong>/mo Monthly Flex Pay Cost</ul>
   
   
  </div>
</div></li>
<li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#directv-resi" role="button" aria-expanded="false" aria-controls="resi-info">Smart Home Control Bundle:<strong> $17.50</strong>/mo</a></div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse" id="directv-resi">
  <div class="card card-body ex">
   <ul><strong>Equipment</strong> 
        <li>SkyControl Starter Kit</li> 
        <li>Element Thermostat</li>
        <li>Smart Door Lock</li>
        <li>Smart Garage Controller</li></ul>
   <ul>*<strong>$1049.95 </strong> Total Cost</ul>
   <ul>*<strong>$17.50 </strong>Monthly Flex Pay Cost</ul>
   
 </div>
</div></li>


<li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#directv-resi31" role="button" aria-expanded="false" aria-controls="resi-info">Video Security Bundle:<strong> $23.00</strong>/mo</a></div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse" id="directv-resi31">
  <div class="card card-body ex">
   <ul><strong>Equipment</strong> 
        <li>SkyControl Starter Kit</li> 
        <li>Doorbell Camera</li>
        <li>Outdoor Camera</li>
        <li>Ping Camera</li></ul>
   
   <ul>*<strong>$1379.95 </strong>Total Cost</ul>
   <ul>*<strong>$23.00 </strong>Total Cost</ul>

 </div>
</div></li>


   <li class="list-group-item"><div class="row">
  <div class="col-sm-5 col-md-6" data-toggle="tooltip" data-placement="bottom" title="Click for more info"><a data-toggle="collapse" href="#directv-resi41" role="button" aria-expanded="false" aria-controls="resi-info">Smart Complete Bundle:<strong> $29.83</strong>/mo</a></div>
  <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"></div>
</div><br>
<div class="collapse" id="directv-resi41">
  <div class="card card-body ex">
   <ul><strong>Equipment</strong> 
        <li>SkyControl Starter Kit</li> 
        <li>Doorbell Camera</li>
        <li>Outdoor Camera</li>
        <li>Ping Camera</li>
        <li>Element Thermostat</li>
        <li>Smart Door Lock</li>
        <li>Smart Garage Controller</li></ul>
    <ul>*<strong>$1789.92 </strong>Total Cost</ul>
    <ul>*<strong>$29.83 </strong>/mo Monthly Flex Pay Cost</ul>
   
 </div>
</div></li>


  </ul>
</div>
      
  </div>
  <div class="col-sm-4"><br>
    <div class="card border-primary mb-3 ex" style="max-width: 18rem;">
  <div class="card-header"><small>SET UP VIVINT SMART HOME</small></div>
  <div class="card-body text-primary">
    <p class="card-text">Average wait time to speak with our customer service support is less than 30 seconds.</p></div>
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:8445931734" role="button"><span class="mbri-mobile2 mbr-iconfont mbr-iconfont-btn"><i class="fa fa-phone" aria-hidden="true"></i></span>+1-844-593-1734</a>
</div>
 <div class="container">
  <div class="row align-center">
   <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/image-15-250x130.jpg" alt="internet service usa vivint" title="">
  </div>
</div>

  </div>
</div><br>
<div class="row">
  <div class="col-sm-8">
      <p>Vivint’s four equipment packages are listed above along with pricing. You can always add equipment to these bundles, though costs start to add up quickly. </p><br>
      <div class="card ex">
  <h5 class="card-header">Vivint Monthly Monitoring and Pricing</h5>
  <div class="card-body">
    <p class="card-text">Vivint offers three professional monitoring plans, all which offer 24/7 monitoring, app control, live service, and tech support.The Smart Protect plan costs $29.99 a month. The Smart Protect + Control plan costs $39.99 a month, while the Smart Complete plan adds video surveillance and local storage and costs $49.99 a month. Both require either a 4- or 5-year service agreement Then call <a href="tel:<?php include 'includes/phone/vivint.php';?>"><?php include 'includes/phone/vivint.php';?></a> for more details.</p>
    <p class="card-text"><ul>
          <li class="list-group-item col-sm-8"><div class="row">
<a data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="resi-info">&nbsp;Smart Protect:<strong> $29.99</strong>/mo</a></div></li>

          <li class="list-group-item col-sm-8"><div class="row">
<a data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="resi-info">&nbsp;Smart Protect + Control:<strong> $39.99</strong>/mo</a></div></li>
         <li class="list-group-item col-sm-8"><div class="row">
<a data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="resi-info">&nbsp;Smart Complete:<strong> $49.99</strong>/mo</a></div></li>
    </ul></p>
    <p class="card-text">Vivint Security systems use wireless technology for clean installation, which is always set up by a pro.</p>
  </div>
</div>
  </div>
  <div class="col-sm-4"></div>
</div>
</div></div></div></div>
  
  <!-- end modal at&T --> 
  



</div>
  </div>
</section>

<!--end of Home security plans-->

<section class="header15 cid-rtsDei77ag" id="header15-1c">

    

    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(249, 249, 249);"></div>

    <div class="container align-right">
        <div class="row">
            <div class="mbr-white col-lg-8 col-md-7 content-container">
                <h2 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br><br><br>CABLE TV</h2>
                <p class="mbr-text pb-3 mbr-fonts-style display-2"><strong>If you need a combined package where you’ll enjoy unlimited internet, cable, and phone service, talk to us. We promise to get you the best fit for your family at an affordable cost.</strong></p>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="form-container">
                    <div class="media-container-column" data-form-type="formoid">
                       
                        <form action="" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form"><input type="hidden" name="email" data-form-email="true" value="vH+I9L6LQ2lfdxWO8fH1iSkhpjUmiof1/Z/t42AtxUO3XnjuDVBrI/MHocUJVVUnroXR9UeqJqY/Tq40+go62vlY/eZ0EuDsVL8CXro+gVc7U6IxD8mphCYzlztJiWZH">
                            <div class="row">
                                <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
                                <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                                </div>
                            </div>
                            <div class="dragArea row">
                                <div class="col-md-12 form-group " data-for="name">
                                    <input type="text" name="name" placeholder="Name" data-form-field="Name" required="required" class="form-control px-3 display-7" id="name-header15-1c">
                                </div>
                                <div class="col-md-12 form-group " data-for="email">
                                    <input type="email" name="email" placeholder="Email" data-form-field="Email" required="required" class="form-control px-3 display-7" id="email-header15-1c">
                                </div>
                                <div data-for="phone" class="col-md-12 form-group ">
                                    <input type="tel" name="phone" placeholder="Phone" data-form-field="Phone" class="form-control px-3 display-7" id="phone-header15-1c">
                                </div>
                                <div data-for="message" class="col-md-12 form-group ">
                                    <textarea name="message" placeholder="Message" data-form-field="Message" class="form-control px-3 display-7" id="message-header15-1c"></textarea>
                                </div>
                                <div class="col-md-12 input-group-btn"><button type="submit" class="btn btn-secondary btn-form display-4"><span class="mbri-paper-plane mbr-iconfont mbr-iconfont-btn"></span>REQUEST QUOTATION</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

<section class="timeline2 cid-rth3jUxC0D" id="timeline2-8">

    

    

    <div class="container align-center">
        <h2 class="mbr-section-title pb-3 mbr-fonts-style display-1"><strong>
            Timeline
        </strong></h2>
        <h3 class="mbr-section-subtitle pb-5 mbr-fonts-style display-5"><strong>
            Internet Service Providers In &nbsp;America</strong><br>Source File:FCC-18-10A3.pdf</h3>

        <div class="container timelines-container" mbri-timelines="">
            <!--1-->
            <div class="row timeline-element reverse separline">
                <span class="iconsBackground">
                    <span class="mbr-iconfont mbri-growing-chart"> <i class="fas fa-arrow-down"></i></span>
                </span>          
                <div class="col-xs-12 col-md-6 align-left">
                    <div class="timeline-text-content">
                        <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">Broadband Access</h4>
                        <p class="mbr-timeline-text mbr-fonts-style display-7">Approximately 44 million Americans lacks access to both broadband and mobile LTE offering up to 25MBPS. 66.2% of Americans living in rural and tribal areas while, 2.1% of Americans living in urban areas.</p>
                     </div>
                </div>
            </div>
            <!--2-->
            <div class="row timeline-element  separline">
                <span class="iconsBackground">
                    <span class="mbr-iconfont mbri-cash"><i class="fas fa-arrow-down"></i></span>
                </span>
                <div class="col-xs-12 col-md-6 align-left ">
                    <div class="timeline-text-content">
                        <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">
                            Pricing</h4>
                        <p class="mbr-timeline-text mbr-fonts-style display-7">Price is the major factor and a well-known indicator for assessing broadband availability in the U.S. According from a previous study, 71% of those without broadband internet are identified by affordability factor.</p>
                    </div>
                </div>
            </div>
            <!--3-->
            <div class="row timeline-element reverse">
                <span class="iconsBackground">
                    <span class="mbr-iconfont mbri-globe-2"><i class="fas fa-arrow-down"></i></span>
                </span>
                <div class="col-xs-12 col-md-6 align-left">
                    <div class="timeline-text-content">
                        <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">Other Access</h4>      
                        <p class="mbr-timeline-text mbr-fonts-style display-7">10 millions of citizens who lack of access to broadband, and it is a severe disadvantage when it comes to robust oppurtunities in education, healtcare, government services, and civic participation.<br></p>
                    </div>
                </div>
            </div>
            <!--4-->
            
            <!--5-->
            
            <!--6-->
            
            <!--7-->
            
            <!--8-->
            
            <!--9-->
            
            <!--10-->
            
            <!--11-->
            
            <!--12-->
            
        </div>
    </div>
</section>

<section class="clients cid-rtlH3cbrtj" data-interval="false" id="clients-x">
      
 <?php get_template_part( 'template-parts/partners-providers'); ?>
    
        
</section>


<?php
get_footer();
