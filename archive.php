<?php
get_header();
?>


  <!-- Page Content -->
  <div class="container-fluid" style="margin-top: 100px;">
    <section class="placeholder-con">
        <?php echo get_hansel_and_gretel_breadcrumbs();?>
 </section>
    
    <div class="row">
        
      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <?php

            $cur_cat = get_cat_ID( single_cat_title("",false) );
            ?>
             <h1 class="my-4 blue"><?php $cur_cat ?></h1>
            <?php
				    $args = array(
				        'post_type' => 'post',
              'post_status' => 'publish',
              'cat' => $cur_cat,
				    );

			    	$post_query = new WP_Query($args);
					if($post_query->have_posts() ) {
			  		while($post_query->have_posts() ) {
			    	$post_query->the_post();
			    ?>

        <!-- Blog Post -->
        <div class="card mb-4">
        	<?php 
							$size = 'featured-post-img'; 
							$imgURL = $imgHero['sizes'][$size];
              $description = get_field('description');
              $exurl = get_field('external_url');
							$featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'featured-post-img' );
						?>
            <a <?php if($exurl == True) :?>href="<?php echo $exurl; ?>" rel="nofollow" <?php else :?>href="<?php the_permalink(); ?>" <?php endif ;?>>
          <img class="card-img-top" src="<?= $featuredImg[0]; ?>"></a>
          <div class="card-body"><a <?php if($exurl == True) :?>href="<?php echo $exurl; ?>" rel="nofollow" <?php else :?>href="<?php the_permalink(); ?>" <?php endif ;?>>
            <h2 class="card-title"><?php the_title(); ?></h2></a>
            <p class="card-text"><?php echo  wp_trim_words( $description, $num_words = 30, $more = '...');?></p>
            <a <?php if($exurl == True) :?>href="<?php echo $exurl; ?>" rel="nofollow" <?php else :?>href="<?php the_permalink(); ?>" <?php endif ;?> class="btn btn-primary" target="_blank">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            <?php
                
                $author = get_the_author();
              ?>
            Category: <?php print_r(get_primary_category(get_the_ID()), true); ?> | <em class="author-italic">Posted by: <?php echo $author;?></em>           
          </div>
        </div>

        <?php  } } ?>

       
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
          <h5 class="card-header pute">Categories</h5>
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
<div style="display:none;">
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

<?php
get_footer();
