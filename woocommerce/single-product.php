<?php
get_header();
?>

<section class="engine"><a href=""></a></section><section class="header13 cid-rtlCdSERoG" id="header13-u">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(3, 58, 129);">
    </div>

    <div class="container">
        <div class="mbr-media show-modal align-center pb-4 mb-4 pt-5" data-modal=".modalWindow">
            
        </div>

        <h1 class="mbr-section-title align-center pb-3 mbr-bold mbr-fonts-style display-1">
            Internet Service Providers in <?php echo $product->get_name(); ?></h1>

        <h2 class="mbr-section-subtitle mbr-fonts-style display-5 align-center"><strong>See Plans, Prices, &amp; Promos for every Internet Provider Near You.</strong></h2>

      <!--  <div class="mbr-media show-modal align-center pb-4 mb-4 pt-5" data-modal=".modalWindow">
            <span class="mbr-icofont mbri-play" style="color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
        </div> -->

        <div class="container mt-5 pt-5 pb-5 align-center">
           <div class="media-container-column" data-form-type="formoid">
             
                <form role="search" method="get" class="search-field" action="<?php echo esc_url( home_url( '/' ) ) ?>">
          <label>
            <span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
            <input type="search" class="zip" placeholder="<?php echo esc_attr_x( '   Ex: Detroit ', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
          </label>
              <!-- <button type="submit" class="search-submit"><i class="fa fa-search"></i></button> -->
          </form>
        
            </div>
        </div>
    </div>

    <div>
        <div class="modalWindow" style="display: none;">
            <div class="modalWindow-container">
                <div class="modalWindow-video-container">
                    <div class="modalWindow-video">
                        <iframe width="100%" height="100%" frameborder="0" allowfullscreen="1" data-src="https://youtu.be/Nmu8-FezY-g" rel="nofollow"></iframe>
                    </div>
                    <a class="close" role="button" data-dismiss="modal">
                        <span aria-hidden="true" class="mbri-close mbr-iconfont closeModal"></span>
                        <span class="sr-only">Close</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="fas fa-arrow-down"></i>
        </a>
    </div>
</section>

<section class="mbr-section content4 cid-rtkVxuI8UD" id="content4-g">

    

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2"><strong>Providers of Home Internet, Cable TV, Wireless &amp; Phone Services</strong></h2>
                <h2 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5">We've helped thousands of customers to find a convenient internet service provider through the years.</h2>
                
            </div>
        </div>
    </div>
</section>

<section class="clients cid-rtlH3cbrtj" data-interval="false" id="clients-x">
      

    
        <div class="container mb-5">
            <div class="media-container-row">
                <div class="col-12 align-center">
                    <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2"><em><strong>"<a href="tel:312-335-9100" class="text-primary">Call us:312-335-9100</a>"</strong></em></h2>
                    <br>
                     <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2"> <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/chart.png" alt="internet service usa" title=""></h2>
                     <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">Scan QR Code to Find Us on Social Media.</h2>
                    
                </div>
            </div>
        </div>

        <?php get_template_part( 'template-parts/partners-providers'); ?>

</section>

<section class="tabs2 cid-rtl6tVf4R5" id="tabs2-l">

    

    
    <div class="container">
        <h2 class="mbr-section-title align-center pb-5 mbr-fonts-style display-2"><strong>Our Top Internet Services in <?php echo $product->get_name(); ?></strong></h2>
        <div class="media-container-row">
            <div class="col-12 col-md-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link mbr-fonts-style show active display-7"  href="#tabs2-l_tab0" aria-selected="true" type="submit"><span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>&nbsp;Residential</a></li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style show active display-7"  href="#tabs2-l_tab1" aria-selected="true"><span class="mbri-briefcase mbr-iconfont mbr-iconfont-btn" type="submit"></span>&nbsp;Business</a></li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style show active display-7"  href="#tabs2-l_tab2" aria-selected="true"><span class="mbri-mobile2 mbr-iconfont mbr-iconfont-btn" type="submit"></span>
                            Mobile</a></li>
                    
                    
                    
                </ul>
                <br><br>
            </div>
        </div>
    </div>
</section>

<section class="testimonials4 cid-rtlbaceGut" id="testimonials4-p">

  <div class="container">
    <h2 class="pb-3 mbr-fonts-style mbr-white align-center display-2" id="tabs2-l_tab0"><strong>1. Residential Internet Service Provider in <?php echo $product->get_name(); ?></strong></h2>
    
    <div class="col-md-10 testimonials-container"> 


  <?php


                // Load field settings and values.
                $field = get_field_object('residential_internet_service_provider');
                $resi = $field['value'];


                // Display labels.
                if( $resi ): ?>
               
                    <?php foreach( $resi as $residential ): ?>
                         <?php if( $residential == 'resi_at_uverse') :?>
                            <!-- at&T -->  
                             <?php get_template_part( 'template-parts/resi-at&t'); ?>
                          <?php elseif( $residential == 'resi_at_fiber') :?>
                            <!-- at&T Fiber--> 
                            <?php get_template_part( 'template-parts/resi-at-fiber'); ?>
                           <?php elseif( $residential == 'resi_wow') :?>
                            <!-- WOW--> 

                                <?php get_template_part( 'template-parts/resi-wow'); ?>
                          <?php elseif( $residential == 'resi_xfinity') :?>
                           <!-- Xfinity-comcast --> 
                            <?php get_template_part( 'template-parts/resi-xfinity'); ?>
                            <?php elseif( $residential == 'resi_viasat') :?>
                            <!-- Satellite-->
                            <!-- VIASAT --> 
                                 <?php get_template_part( 'template-parts/resi-viasat'); ?>
                            <?php elseif( $residential == 'resi_hughesnet') :?>
                            <!-- hughesnet --> 
                            <?php get_template_part( 'template-parts/resi-hughesnet'); ?>
   
                         <?php endif ;?>
                    <?php endforeach; ?>
              
                <?php endif; wp_reset_query();
    ?>

      </div>
  </div>
</section>

<section class="mbr-section info1 cid-rtpkSKdIHF" id="info1-14">

    

    
    <div class="container">
        <div class="row justify-content-center content-row">
            <div class="media-container-column title col-12 col-lg-7 col-md-6">
                <h2 class="mbr-section-subtitle align-left mbr-light pb-3 mbr-fonts-style display-5"><strong>Compare your existing internet service provider?<br>Run a Speed Test!</strong></h2>
                <h2 class="align-left mbr-bold mbr-fonts-style display-1">
                    SPEED TEST</h2>
            </div>
            <div class="media-container-column col-12 col-lg-3 col-md-4">
                <div class="mbr-section-btn align-right py-4"><a class="btn btn-sm btn-primary display-4 " href="https://internetserviceusa.com/speedtest/" target="_blank"><span class="mbri-speed mbr-iconfont mbr-iconfont-btn"></span>Run Speed Test</a></div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials4 cid-rtlgSuX83j" id="testimonials4-q">


  <div class="container">
    <h2 class="pb-3 mbr-fonts-style mbr-white align-center display-2" id="tabs2-l_tab1"><strong>2. Business Internet Service Provider in <?php echo $product->get_name(); ?></strong></h2>
    
    <div class="col-md-10 testimonials-container"> 

    <?php


                // Load field settings and values.
                $field2 = get_field_object('business_internet_service_provider');
                $busi = $field2['value'];


                // Display labels.
                if( $busi ): ?>
               
                    <?php foreach( $busi as $business ): ?>
                         <?php if( $business == 'busi_at&t') :?>
                             <!-- At&T --> 
                            <?php get_template_part( 'template-parts/busi-at&t'); ?>
                          <?php elseif( $business == 'busi_at_fiber') :?>
                            <!-- AT&T Fiber --> 
                            <?php get_template_part( 'template-parts/busi-at-fiber'); ?>
                           <?php elseif( $business == 'busi_comcast') :?>
                            <!-- comcast --> 
                             <?php get_template_part( 'template-parts/busi-comcast'); ?>
                            <?php elseif( $business == 'busi_century') :?>
                            <!-- century link --> 
                            <?php get_template_part( 'template-parts/busi-century'); ?>
                            <?php elseif( $business == 'busi_wow') :?>
                            <!-- WOW --> 
                             <?php get_template_part( 'template-parts/busi-wow'); ?>
   
                         <?php endif ;?>
                    <?php endforeach; ?>
              
                <?php endif; wp_reset_query();
    ?>
  <!--Enterprise Header -->
  <br><br>
     <h5 class="card-header" style="background-color: #ffffff!important;">ENTERPRISE PROVIDERS&nbsp;<span style="font-size:20px" class="fa" data-toggle="tooltip" data-html="true" title="<p>The providers listed below market to enterprise level businesses and/or goverments and may be able to provide more complex services such as MPLS, transport, backhaul, wholesale bandwidth, and point-to-point among others. Since enterprise service pricing vary dramatically depending on client needs, pricing information is not available.</p>">&#xf059;</span></h5> 

     <?php
        //enterprise internet service provider
         // Load field settings and values.
                $field3 = get_field_object('enterprise_provider');
                $enter = $field3['value'];


                // Display labels.
                if( $enter ): ?>
               
                    <?php foreach( $enter as $enterprise ): ?>
                         <?php if( $enterprise == 'enter_comcast') :?>                   
                          <!-- Comcast --> 
                            <?php get_template_part( 'template-parts/enter-comcast'); ?>
                          <?php elseif( $enterprise == 'enter_windstream') :?>
                            <!-- Windstream --> 
                            <?php get_template_part( 'template-parts/enter-windstream'); ?>   
                         <?php endif ;?>
                    <?php endforeach; ?>
              
                <?php endif; wp_reset_query(); 
  ?>
     
  <!--End of Enterprise Header -->    
  </div>
</section>

<section class="testimonials4 cid-rtlj3NqEAd" id="testimonials4-r">
  <div class="container">
    <h2 class="pb-3 mbr-fonts-style mbr-white align-center display-2"  id="tabs2-l_tab2"><strong>
        3. Mobile Internet Providers in Chicago, IL</strong></h2>
    
    <div class="col-md-10 testimonials-container"> 

        <?php
        //mobile internet service provider
         // Load field settings and values.
                $field4 = get_field_object('mobile_internet_service_provider');
                $mob = $field4['value'];


                // Display labels.
                if( $mob ): ?>
               
                    <?php foreach( $mob as $mobile ): ?>
                         <?php if( $mobile == 'mob_at&t') :?>                   
                          <!-- Mobile AT&T --> 
                            <?php get_template_part( 'template-parts/mob-at&t'); ?>
                          <?php elseif( $mobile == 'mob_sprint') :?>
                            <!-- Mobile SPRINT --> 
                         <?php get_template_part( 'template-parts/mob-sprint'); ?>   
                         <?php endif ;?>
                    <?php endforeach; ?>
              
                <?php endif; wp_reset_query(); 
  ?>
      </div>
  </div>
</section>

<section class="mbr-section info2 cid-rtlmmVsLpF" id="info2-s">

    

    

    <div class="container">
        <div class="row main justify-content-center">
            <div class="media-container-column col-12 col-lg-3 col-md-4">
                <div class="mbr-section-btn align-left py-4"><a class="btn btn-primary display-4" href="tel:312-335-9100"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span>312-335-9100</a></div>
            </div>
            <div class="media-container-column title col-12 col-lg-7 col-md-6">
                <h2 class="align-right mbr-bold mbr-white pb-3 mbr-fonts-style display-2">Still undecided? Talk to us.</h2>
                <h2 class="mbr-section-subtitle align-right mbr-light mbr-white mbr-fonts-style display-5">Our agents will connect you with the right internet service provider that will meet your needs.</h2>
            </div>
        </div>
    </div>
</section>

<section class="accordion2 cid-rtkXZkJQiw" id="accordion2-i">

    


    
    <div class="container">
        <div class="media-container-row pt-5">
            <div class="accordion-content">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">Why Internet Service USA?</h2>
                
                <div id="bootstrap-accordion_18" class="panel-group accordionStyles accordion pt-5 mt-3" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-core="" href="#collapse1_18" aria-expanded="false" aria-controls="collapse1">
                                    <h4 class="mbr-fonts-style display-5">
                                        <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>We Take Time to Study Every Internet Service Provider.</h4>
                                </a>
                            </div>
                            <div id="collapse1_18" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#bootstrap-accordion_18">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">
                                       At Internet Service USA, we’ll not just list down the available internet service providers. We take time to study each of them, and then connect you with the best. The information we provide regarding an internet provider is true so that you can make an informed decision.</p>
                                </div>
                            </div>
                        </div>
                
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-core="" href="#collapse2_18" aria-expanded="false" aria-controls="collapse2">
                                    <h4 class="mbr-fonts-style mbr-fonts-style display-5">
                                        <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>We Only Work with Top-Rated Internet Service Providers.</h4>
                                </a>
                                
                            </div>
                            <div id="collapse2_18" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#bootstrap-accordion_18">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">To ensure you get the best internet services, we’ll only recommend reputable internet service providers. Some of these are Xfinity, Wow, Viasat, AT&amp;T U-verse Plus Internet &amp; Directv, and Charter Spectrum, among others.
<br>Whether you need a complete package that will cater for your internet, cable, and phone, we’ll recommend the best company. All you need is to talk to our agents and we’ll get you the best internet service for your home or office.</p>
                                </div>
                            </div>
                        </div>
                
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-core="" href="#collapse3_18" aria-expanded="false" aria-controls="collapse3">
                                    <h4 class="mbr-fonts-style display-5">
                                        <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>We'll Ensure You Don't Pay Any Hidden Fees.</h4>
                                </a>
                            </div>
                            <div id="collapse3_18" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#bootstrap-accordion_18">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">For the years we’ve been in business, our agents are able to notice hidden fees charged by internet service providers. Whether its early termination fee, monthly equipment cost, activation fee, data caps, among others, we’ll point them out to you.</p>
                                </div>
                            </div>
                        </div>

                         <div class="card">
                            <div class="card-header" role="tab" id="headingFour">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-core="" href="#collapse4_18" aria-expanded="false" aria-controls="collapse3">
                                    <h4 class="mbr-fonts-style display-5">
                                        <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>Friendly Support Team Always at Your Service.</h4>
                                </a>
                            </div>
                            <div id="collapse4_18" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#bootstrap-accordion_18">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">For the years When you contact us for internet service, our friendly agents will take time to listen to your needs. Then, we’ll help you to choose the right internet service provider and the best package for your home or office. If you are tired of struggling with a dashboard to search for internet service in your area, talk to us. We’ll do the difficult task of choosing an internet service for you as you take care of more important issues.</p>
                                </div>
                            </div>
                        </div>

                         <div class="card">
                            <div class="card-header" role="tab" id="headingFive">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-core="" href="#collapse5_18" aria-expanded="false" aria-controls="collapse3">
                                    <h4 class="mbr-fonts-style display-5">
                                        <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>Fast Services.</h4>
                                </a>
                            </div>
                            <div id="collapse5_18" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#bootstrap-accordion_18">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">Once you choose the internet, cable or phone service you prefer, we’ll ensure that it is installed without delays. You’ll not have to wait for too long to have internet service in your home! Do not settle for an internet service agent that will take ages to install your internet, cable or phone package.</p>
                                </div>
                            </div>
                        </div>


                        <br><br>


<section class="cid-rtlGGjWW6v" id="social-buttons3-w">
    
    

    

    <div class="container">
        <div class="media-container-row">
            <div class="col-md-9 align-center">
                <h2 class="pb-3 mbr-section-title mbr-fonts-style display-2">
                    SHARE THIS PAGE!
                </h2>
                <div>
                    <div class="mbr-social-likes">
                        <span class="btn btn-social socicon-bg-facebook facebook mx-2" title="Share link on Facebook">
                            <i class="socicon socicon-facebook"></i>
                        </span>
                        <span class="btn btn-social twitter socicon-bg-twitter mx-2" title="Share link on Twitter">
                            <i class="socicon socicon-twitter"></i>
                        </span>
                        <span class="btn btn-social plusone socicon-bg-googleplus mx-2" title="Share link on Reddit">
                            <i class="socicon socicon-reddit"></i>
                        </span>
                        
                        
                        <span class="btn btn-social pinterest socicon-bg-pinterest mx-2" title="Share link on Pinterest">
                            <i class="socicon socicon-pinterest"></i>
                        </span>
                        <span class="btn btn-social mailru socicon-bg-mail mx-2" title="Share link on Linkedin">
                            <i class="socicon socicon-linkedin"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

                
                        
                
                        
                
                        
                </div>
            </div>
            <div class="mbr-figure" style="width: 105%;">
                    <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/at-t-internet-service-image-550x633.jpg" alt="internet service usaMobirise" title="">
            </div>
        </div>
    </div>
</section>

<section class="header3 cid-rtpeCZzzxf mbr-parallax-background" id="header3-13">

    

    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(35, 35, 35);">
    </div>

    <div class="container">
        <div class="media-container-row">
            <div class="mbr-figure" style="width: 100%;">
                <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/smart-home-automation-1014x676.jpg" alt="internet service usaMobirise" title="">
            </div>
            <?php
                $adt = get_field('adt');
                $vivint = get_field('vivint');
                $citynumber = get_field('city_number');


            ?>
            <div class="media-content">
                <h2 class="mbr-section-title align-center pb-3 mbr-bold mbr-fonts-style display-1 mbr-white"><strong>
                    Home Security</strong></h2>
                
                <div class="mbr-section-text mbr-white pb-3 ">
                    <p class="mbr-text mbr-fonts-style display-5">In addition to providing you with affordable internet service, Internet Service USA will also help with your home security needs. Our agents will assist you to get an internet that will allow easy monitoring, simple to use, and affordable.
<br>
<br>With the right security system, you’ll pay lower insurance premiums and be at peace knowing your family is safe. Get in touch with our agents today and we’ll help you to access a tamper-proof home security system.</p>
                </div>
                <div class="mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="tel:<?php echo $citynumber;?>"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $citynumber;?></a>
                    <a class="btn btn-sm btn-white-outline display-4" href="#secbundles"><span class="mbri-protect mbr-iconfont mbr-iconfont-btn"></span>Security Bundles</a></div>
            </div>
        </div>
    </div>

</section>
<section class="mbr-section content4 cid-rtst08nocj" id="content4-1b" style="background-color: #55b4d4!important;"  >

    

    <div class="container" id="secbundles">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-1"  style="color: #ffffff!important;"><strong>PREMIUM HOME SECURITY BUNDLES</strong></h2>
                
                
            </div>
        </div>
    </div>
</section>



    

    

<!-- Home security plans-->

   <section class="testimonials4 cid-rtlbaceGut" id="testimonials4-p"  style="background-color:  #55b4d4!important;">

  

  
  <div class="container">
    
    <div class="col-md-10 testimonials-container"> 
      
<div class="testimonials-item"  >
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

             <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:<?php echo $adt;?>"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $adt;?></a>
                    <a class="btn btn-md btn-blue-outline display-4" data-toggle="collapse" href="#resi-infoadt" role="button" aria-expanded="false" aria-controls="resi-infoadt"><span style="font-size:20px" class="fa" data-toggle="tooltip" data-placement="bottom" title="Click for Plans & Pricing.">&#xf059;</span>&nbsp;Security Packages</a></div>
            
          </div>
        </div>
      </div>

  <!--modal at&T --> 
  <div class="collapse" id="resi-infoadt">
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
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:<?php echo $adt;?>" role="button"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $adt;?></a>
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
    <p class="card-text">We don’t believe in the phrase “one size fits all.” That’s why Protect Your Home, an ADT Authorized Premier Provider, customizes your entire experience–from your free quote to your quick and easy installation. The first thing you’ll need to do is research packages and pricing. Then call <a href="tel:<?php include '../includes/phone/adt.php';?>"><?php include '../includes/phone/adt.php';?></a> for more details.</p>
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

             <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="tel:<?php echo $vivint;?>"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $vivint;?></a>
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
        <a class="btn btn-primary cs btn-sm align-center"  href="tel:<?php echo $vivint;?>" role="button"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;</span><?php echo $vivint;?></a>
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
    <p class="card-text">Vivint offers three professional monitoring plans, all which offer 24/7 monitoring, app control, live service, and tech support.The Smart Protect plan costs $29.99 a month. The Smart Protect + Control plan costs $39.99 a month, while the Smart Complete plan adds video surveillance and local storage and costs $49.99 a month. Both require either a 4- or 5-year service agreement Then call <a href="tel:<?php include '../includes/phone/vivint.php';?>"><?php include '../includes/phone/vivint.php';?></a> for more details.</p>
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

<section>
<br>
<h3 class="mbr-section-title align-center pb-3 mbr-bold mbr-fonts-style display-1">Recent Google Reviews</h3>

<div id="google-reviews"></div>

<link rel="stylesheet" href="https://cdn.rawgit.com/stevenmonson/googleReviews/master/google-places.css" rel="nofollow">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/gh/stevenmonson/googleReviews@6e8f0d794393ec657dab69eb1421f3a60add23ef/google-places.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDS8_cZriNtzk5Ss-vaRsQ8lzu3D3oSXq8&signed_in=true&libraries=places"></script>

<script>
jQuery(document).ready(function( $ ) {
   $("#google-reviews").googlePlaces({
        placeId: 'ChIJr3wO8_w1O4gRphEHPtCaT8U' //Find placeID @: https://developers.google.com/places/place-id
      , render: ['reviews']
      , min_rating: 4
      , max_rows:4
   });
});
</script>
<br>
<div class="mbr-section-btn align-center"><a class="btn btn-sm btn-primary display-4" href="https://www.google.com.bd/search?q=Internet+Service+USA,+7263+Grandville+Ave,+Detroit,+MI+48228,+USA&ludocid=14217752767816470950&gws_rd=ssl#lrd=0x883b35fcf30e7caf:0xc54f9ad03e0711a6,1" rel="nofollow"></span>View All Reviews?</a>
</div><br>
</section>

<section class="map1 cid-rtlZ5Mznir" id="map1-10">

     

   <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d754923.1952866005!2d-83.229625!3d42.344256!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc54f9ad03e0711a6!2sInternet+Service+USA!5e0!3m2!1sen!2sbd!4v1560572187295!5m2!1sen!2sbd" allowfullscreen=""></iframe></div>
</section>



<?php
get_footer();