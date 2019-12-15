<?php
get_header();
?>

<section class="header13 cid-rtlCdSERoG" id="header13-u">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(3, 58, 129);">
    </div>
 <div class="container">
        <div class="mbr-media show-modal align-center pb-4 mb-4 pt-5" data-modal=".modalWindow">
            
        </div>
        <?php  $hometitle = get_field('title'); ?>
        <h1 class="mbr-section-title align-center pb-3 mbr-bold mbr-fonts-style display-1">
            <?php echo $hometitle;?></h1>

        <h2 class="mbr-section-subtitle mbr-fonts-style display-5 align-center">
          <?php  $homedesc = get_field('description'); ?>
          <strong><?php echo $homedesc;?></strong></h2>

      <!--  <div class="mbr-media show-modal align-center pb-4 mb-4 pt-5" data-modal=".modalWindow">
            <span class="mbr-icofont mbri-play" style="color: rgb(255, 255, 255); fill: rgb(255, 255, 255);"></span>
        </div> -->

        <div class="container mt-5 pt-5 pb-5">
           <div class="media-container-column" data-form-type="formoid">
             
                <form action="" method="GET" class="mbr-form form-with-styler">
                    <div class="row justify-content-center form-inline">
                        
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                        </div>
                    </div>
                    <div class="dragArea row justify-content-center form-inline">
                        
                        
                        <div data-for="phone" class="col-auto form-group ">
                             <form role="search" method="get" class="search-field" action="<?php echo esc_url( home_url( '/' ) ) ?>">
          <label>
            <span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
            <input type="search" class="zip" placeholder="<?php echo esc_attr_x( ' Enter Zip Code ', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
          </label>
              <!-- <button type="submit" class="search-submit"><i class="fa fa-search"></i></button> -->
          </form>
           <!-- <div class="col-auto buttons-wrap"><button type="submit" class="btn btn-primary display-4" name="searchButton"><span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>Search</button></div> -->
                        </div>
                       
                    </div>
                </form>
    </div>
        </div>
    </div>
  </section>
  <!-- Page Content -->
  <div class="container-fluid">
    <div class="row">
        
      <!-- Blog Entries Column -->
      <div class="col-md-8">


        <h1 class="my-4 blue">Internet Service USA
          <small>Blog Post</small>
        </h1>

        <?php
				    $args = array(
				        'post_type' => 'post',
				    	'posts_per_page' => 6,
              'post_status' => 'publish',
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

        

          <div class="card my-4" style="margin-bottom: 50px!important;">
          <h5 class="card-header pute">Popular Article</h5>
        </div>
                    <?php
                    $current_post = $post->ID;
               $args = array(
             'post_type' => 'post',
             'order'      => 'ASC',
             'posts_per_page' => 4,
             'post_status' => 'publish',
              );

              $post_query = new WP_Query($args);
            if($post_query->have_posts() ) {
              while($post_query->have_posts() ) {
              $post_query->the_post();
            ?>

    
    <div class="card my-4" style="margin-top: -50px!important;">
      <div class="card-body">
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

          <p class="card-text mb-auto"><?php echo  wp_trim_words( $description, $num_words = 10, $more = '...');?></p>

          <a  <?php if($exurl == True) :?>href="<?php echo $exurl; ?>" rel="nofollow" <?php else :?>href="<?php the_permalink(); ?>" <?php endif ;?>>Continue Reading....</a>
      
      </div>
    </div>
    </div>
    </div>
   <?php  } } ?> 
      </div>
    </div>
    <!-- /.row -->
</div>
  </div>
  <!-- /.container -->
<?php
get_footer();
