<?php
get_header();
?>

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>


	<?php 
	$size = 'large';
	$description = get_field('description');
	$maincontent = get_field('content'); 
	$imgURL = $imgHero['sizes'][$size];
	$featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );


	?>

 <div class="container-fluid" style="margin-top: 100px;">
 <section class="placeholder-con">
				<?php echo get_hansel_and_gretel_breadcrumbs();?>
 </section>
  <div class="p-4 p-md-5" >
  	<h3 class="pb-4 mb-4 font-italic border-bottom blue">
        <?php the_title(); ?>
      </h3>
      <p class="blog-post-meta"><?php echo get_the_date(); ?> by <a href="#" rel="nofollow"><?php echo get_the_author(); ?></a></p>

        <p><?php echo $description;?></p>
    <img class="card-img-top" src="<?= $featuredImg[0]; ?>">
  </div>

  
</div>

<main role="main" class="container-fluid">
  <div class="row">
    <div class="col-md-8 blog-main">
      

      <div class="blog-post">
        
        <hr>

        <?php echo $maincontent;?>
        
      </div><!-- /.blog-post -->


      <div class="blog-post">
        <?php comments_template(); ?>
      </div><!-- /.blog-post -->

      <!-- <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav> -->
      	<section class="next-previous">
				<span class="next-next">
		<?php next_post_link('%link', 'Next Post >>', FALSE); ?>
					</span>	
				
	         <span class="prev-prev">
		<?php previous_post_link('%link', '<< Previous Post', FALSE); ?>
			</span>			
				</section>
    </div><!-- /.blog-main -->
   

    <aside class="col-md-4 blog-sidebar">
    	<!-- Search Widget -->
        <!-- Search Widget -->
        <?php get_template_part('template-parts/search-city');?>


        <div class="card my-4">
          
      <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header pute">About Us</h5>
          <div class="card-body">
           Internet Service USA, is a nationwide <a href="https://internetserviceusa.com/usa/all-providers.php">internet service provider</a>. Our focus is on assisting you to find the best internet, cable, and phone service provider in your region. To us, it is not just providing you with a list of internet service providers in your area. Our agents have spent years analyzing and scrutinizing internet providers so that we can provide accurate results.
          </div>
        </div>

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
      </div>

       <div class="card my-4">
          <h5 class="card-header pute">Follow us</h5>
          <div class="card-body">
        <br>
        <ol class="list-unstyled">
          
                        <a href="https://twitter.com/internetSVUSA" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-twitter socicon"></span>
                        </a>
                   
                        <a href="https://www.facebook.com/internetserviceusa" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-facebook socicon"></span>
                        </a>
                   
                        <a href="https://www.pinterest.ph/internetserviceusa/" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-pinterest socicon"></span>
                        </a>
                   
                        <a href="https://www.instagram.com/internetserviceusa1/" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-instagram socicon"></span>
                        </a>
        </ol>
      </div>
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
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->
  <br>
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
  <h3 class="pb-4 mb-4 blue border-bottom">
        Related Articles
      </h3>
  <div class="row mb-2">

  	                <?php
  	                $current_post = $post->ID;
		           $args = array(
					   'post_type' => 'post',
					   'order'      => 'ASC',
					   'posts_per_page' => 4,
					   'post_status' => 'publish',
					   'post__not_in' => array($current_post),
					    );

				    	$post_query = new WP_Query($args);
						if($post_query->have_posts() ) {
				  		while($post_query->have_posts() ) {
				    	$post_query->the_post();
				    ?>

    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        	<?php 
								$size = 'featured-post-img';
								$description = get_field('description');
								$exurl = get_field('external_url');  
								$imgURL = $imgHero['sizes'][$size];
								$featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'featured-post-img' );
							?>						
          <strong class="d-inline-block mb-2 text-primary"><?php print_r(get_primary_category(get_the_ID()), true); ?></strong>
          <a <?php if($exurl == True) :?>href="<?php echo $exurl; ?>" rel="nofollow" <?php else :?>href="<?php the_permalink(); ?>" <?php endif ;?>><h3 class="mb-0"><?php the_title(); ?></h3></a>
          <div class="mb-1 text-muted"><?php echo get_the_date(); ?></div>

          <p class="card-text mb-auto"><?php echo  wp_trim_words( $description, $num_words = 30, $more = '...');?></p>
        </div>
        <div class="col-auto d-none d-lg-block"><a <?php if($exurl == True) :?>href="<?php echo $exurl; ?>" rel="nofollow"<?php else :?>href="<?php the_permalink(); ?>" <?php endif ;?>>
          <img src="<?= $featuredImg[0]; ?>" class="bd-placeholder-img" width="200" height="250">
      </a>
        </div>
      </div>
    </div>
   <?php  } } ?>
  </div>
</main>
<?php endwhile; else: ?>
<p>No matching entries found.</p>
<?php endif; ?>

<?php
get_footer();