<?php
get_header();
?>
 <?php if (is_product_category( )) : ?>
  <!-- Page Content -->
  <div class="container-fluid" style="margin-top: 100px;">
    <section class="placeholder-con">
        <?php
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
?>
 </section>
 <section class="engine"></section><section class="cid-rtgokFkwN6" id="header2-5">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(3, 58, 129);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
               <!--Heading 1 and paragraph -->
               <?php

              $term = get_queried_object();
              $cat_slug =  $term->slug;

              $args = array( 'post_type' => 'product' );
                $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();
              global $product; 
                
              ?>
                <?php echo $term->description;?>

              <?php endwhile;wp_reset_query(); 
                ?>
               <!-- end of heading -->
                <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="#city_search" rel="nofollow"><span class="mbri-map-pin mbr-iconfont mbr-iconfont-btn"></span>Search Your City</a> 
                    <a class="btn btn-md btn-white-outline display-4" href="https://internetserviceusa.com/speedtest/" target="_blank"><span class="mbri-speed mbr-iconfont mbr-iconfont-btn"></span>Speedtest</a></div>
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next" rel="nofollow">
            <i class="fas fa-arrow-down"></i>
        </a>
    </div>
</section>


    
    <div class="row">
        
      <!-- Blog Entries Column -->
      <div class="col-md-8">

<section class="section-table cid-rtgvspRekY" id="table1-6">
  <div class="container container-table">
      <!--heADING TWO-->
      <?php
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;

        // load desc for this taxonomy term (term object)
        $sec_descrip = get_field('heading_two', $queried_object);

        // load desc for this taxonomy term (term string)
        $sec_descrip = get_field('heading_two', $taxonomy . '_' . $term_id);

?>

<div class='term-description'><?php the_field( 'heading_two', $queried_object ); ?></div>
      <!--END OF HEDING TWO-->
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
                      City</th><th class="head-item mbr-fonts-style display-7 blue">Coverage</th><th class="head-item mbr-fonts-style display-7 blue">No. of Providers</th><th class="head-item mbr-fonts-style display-7 blue"><strong>Option</strong>
                      </th></tr>
            </thead>

            <tbody>

             <?php

              $term = get_queried_object();
              $cat_slug =  $term->slug;

              $args = array( 'post_type' => 'product', 'product_cat' => $cat_slug,'posts_per_page' => 1000,'set_order' => 'ASC' );
                $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();
              global $product; 
                 $coverage = get_field('coverage');
                 $noproviders = get_field('no_of_providers');
              ?>
                <tr class="align-center">
  
                
              <td class="body-item mbr-fonts-style display-7">
                <a href="<?php echo get_permalink($product->get_id());?>"><?php echo $product->get_name(); ?>
                </a>
              </td>
              <td class="body-item mbr-fonts-style display-7"><?php echo $coverage;?></td>
              <td class="body-item mbr-fonts-style display-7"><?php echo $noproviders;?></td>
              <td class="body-item mbr-fonts-style display-7">
                <a href="<?php echo get_permalink($product->get_id());?>"><strong>View</strong>
                </a>
              </td>

            </tr> 

              <?php endwhile;wp_reset_query(); 
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

<div class="container">
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

</div>

       
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
          <h5 class="card-header pute">Post Categories</h5>
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
        </div>
        <!-- Side Widget -->
        <div class="card my-4">
          <div class="card-body">

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

    </div>
    <!-- /.row -->

    <!-- START THE FEATURETTES -->
     <?php
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;

        // load desc for this taxonomy term (term object)
        $sec_descrip = get_field('our_services', $queried_object);

        // load desc for this taxonomy term (term string)
        $sec_descrip = get_field('our_services', $taxonomy . '_' . $term_id);

?>

<div class='term-description'><?php the_field( 'our_services', $queried_object ); ?></div>

    <!-- /END THE FEATURETTES -->
</div>
  </div>
  <!-- /.container -->
  <!-- amazon ads recom -->
  <div class="container align-center">
      <script type="text/javascript">
amzn_assoc_placement = "adunit0";
amzn_assoc_tracking_id = "internetse023-20";
amzn_assoc_ad_mode = "manual";
amzn_assoc_ad_type = "smart";
amzn_assoc_marketplace = "amazon";
amzn_assoc_region = "US";
amzn_assoc_linkid = "2d8de3b02aef83857c4b0477c2c2263f";
amzn_assoc_design = "in_content";
amzn_assoc_asins = "B076D1YSD1,B07CY4P882,B07BFS3G7P,B075PZ12B2,B07MXZ8F6Z";
amzn_assoc_title = "Software Products Recommendations";
</script>
<script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>
  </div>
  <!-- amazon end -->

  
  <?php else : ?>
    <!-- Page Content -->
  <div class="container-fluid" style="margin-top: 100px;">
    <section class="placeholder-con">
        <?php
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
?>
 </section>
 <section class="engine"><a href=""></a></section><section class="cid-rtgokFkwN6" id="header2-5">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(3, 58, 129);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    Internet Service in Illinois USA</h1>
                
                <p class="mbr-text pb-3 mbr-fonts-style display-5">Internet Service USA connects you with the best internet service providers and we take time to study each of them.</p>
                <div class="mbr-section-btn"><a class="btn btn-md btn-primary display-4" href="https://internetserviceusa.com/usa/search.php" target="_blank"><span class="mbri-map-pin mbr-iconfont mbr-iconfont-btn"></span>Zip Code Search</a> 
                    <a class="btn btn-md btn-white-outline display-4" href="https://internetserviceusa.com/speedtest/" target="_blank"><span class="mbri-speed mbr-iconfont mbr-iconfont-btn"></span>Speedtest</a></div>
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next" rel="nofollow">
            <i class="fas fa-arrow-down"></i>
        </a>
    </div>
</section>


    
    <div class="row">
        
      <!-- Blog Entries Column -->
      <div class="col-md-8">

<section class="section-table cid-rtgvspRekY" id="table1-6">

  
  
  <div class="container container-table">
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-1"><strong>List of Cities in Illinois</strong></h2>
      <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-5"><strong>To ensure you get the best internet services, we’ll only recommend reputable internet service providers. Please select your location or city below.</strong></h3>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
          </div>
        </div>

        <div class="container scroll">
          <table class="table isSearch" cellspacing="0">
            <thead>
              <tr class="table-heads ">
                  
                  
                  
                  
              <th class="head-item mbr-fonts-style display-7 blue">
                      City</th><th class="head-item mbr-fonts-style display-7 blue">Coverage</th><th class="head-item mbr-fonts-style display-7 blue">No. of Providers</th><th class="head-item mbr-fonts-style display-7 blue">
                      Max Speed</th></tr>
            </thead>

            <tbody>
              
              
              
              
            <tr> 
                
                
                
                
              <td class="body-item mbr-fonts-style display-7">AT&amp;T Internet</td><td class="body-item mbr-fonts-style display-7">21</td><td class="body-item mbr-fonts-style display-7">121,996,008</td><td class="body-item mbr-fonts-style display-7">100 MBPS</td></tr><tr>
                
                
                
                
              <td class="body-item mbr-fonts-style display-7">XFINITY from Comcast</td><td class="body-item mbr-fonts-style display-7">40</td><td class="body-item mbr-fonts-style display-7">111,710,288</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

                <td class="body-item mbr-fonts-style display-7">CenturyLink</td><td class="body-item mbr-fonts-style display-7">53</td><td class="body-item mbr-fonts-style display-7">48,284,685</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

             <td class="body-item mbr-fonts-style display-7">Cox Communications</td><td class="body-item mbr-fonts-style display-7">19</td><td class="body-item mbr-fonts-style display-7">21,128,654</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

            <td class="body-item mbr-fonts-style display-7">Consolidated Communications</td><td class="body-item mbr-fonts-style display-7">19</td><td class="body-item mbr-fonts-style display-7">4,557,294</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

             <td class="body-item mbr-fonts-style display-7">Frontier Communications</td><td class="body-item mbr-fonts-style display-7">24</td><td class="body-item mbr-fonts-style display-7">33,486,953</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

            <td class="body-item mbr-fonts-style display-7">TDS Telecom</td><td class="body-item mbr-fonts-style display-7">27</td><td class="body-item mbr-fonts-style display-7">4,154,064</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>
                
                
                
                
              <td class="body-item mbr-fonts-style display-7">WOW!</td><td class="body-item mbr-fonts-style display-7">9</td><td class="body-item mbr-fonts-style display-7">7,174,627</td><td class="body-item mbr-fonts-style display-7">600 MBPS</td></tr><tr>

            <td class="body-item mbr-fonts-style display-7">Verizon</td><td class="body-item mbr-fonts-style display-7">51</td><td class="body-item mbr-fonts-style display-7">305,032,264</td><td class="body-item mbr-fonts-style display-7">10 MBPS</td></tr><tr>

                 <td class="body-item mbr-fonts-style display-7">Sprint</td><td class="body-item mbr-fonts-style display-7">51</td><td class="body-item mbr-fonts-style display-7">279,984,122</td><td class="body-item mbr-fonts-style display-7">10 MBPS</td></tr><tr>

            <td class="body-item mbr-fonts-style display-7">Suddenlink Communications</td><td class="body-item mbr-fonts-style display-7">19</td><td class="body-item mbr-fonts-style display-7">6,818,884</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

             <td class="body-item mbr-fonts-style display-7">Charter Spectrum</td><td class="body-item mbr-fonts-style display-7">43</td><td class="body-item mbr-fonts-style display-7">102,473,344</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

             <td class="body-item mbr-fonts-style display-7">Windstream</td><td class="body-item mbr-fonts-style display-7">50</td><td class="body-item mbr-fonts-style display-7">16,150,173</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>

             <td class="body-item mbr-fonts-style display-7">Optimum</td><td class="body-item mbr-fonts-style display-7">4</td><td class="body-item mbr-fonts-style display-7">112,437,931</td><td class="body-item mbr-fonts-style display-7">1000 MBPS</td></tr><tr>
                
                
                
                
                
              <td class="body-item mbr-fonts-style display-7">HughesNet</td><td class="body-item mbr-fonts-style display-7">53</td><td class="body-item mbr-fonts-style display-7">308,745,538</td><td class="body-item mbr-fonts-style display-7">25 MBPS</td></tr></tbody>
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
          <h5 class="card-header pute">Post Categories</h5>
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
        </div>

      </div>

    </div>
    <!-- /.row -->

</div>
  </div>
  <!-- /.container -->

  <?php endif ; ?>
  

<?php
get_footer();
