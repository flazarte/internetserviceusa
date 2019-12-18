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
        </div>

      </div>

    </div>
    <!-- /.row -->
</div>
  </div>
  <!-- /.container -->
<?php
get_footer();
