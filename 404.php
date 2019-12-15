



	      
	       
<?php

get_header();

?>

	<div id="primary" class="content-area">

        <section class="container page-not-found">
            <h1>
                <?php esc_attr_e('Error 404, Page Not Found !','textdomaintomodify'); ?>
            </h1>
            <a href="<?php echo get_home_url(); ?>">Go back to homepage <i class="fa fa-arrow-right"></i></a>
        </section>

        <div class="container">

        	<section class="featured-product">
			<div class="container">
				<h3>Featured Products</h3>
				<div class="slider-con owl-carousel">

					
			<?php 
			$query = new WC_Product_Query(array(
				'post_type' => 'product_cat',
				'product_cat'   => 'featured',					
   				'order' => 'ASC'
      		));

		
			$products = $query->get_products($product_id);


			if (!empty($products)) {
   			 foreach ($products as $product) {


 				?>


					<div class="item on-sale">
						<?php if ($product->is_on_sale()) : ?>
						<div class="sale-banner">Item on Sale!</div>
						<?php else : ?>
							<?php endif;  ?>
						<div class="item-img">
							<a href="<?php echo get_permalink($product->get_id());?>">
							<?php if($product->get_image_id()){  ?>
								<img src="<?php echo wp_get_attachment_image_src( $product->get_image_id() ,'medium')[0]; ?>" alt="<?php echo $product->get_name(); ?>" >
							<?php }else{?>
								<img src="<?php bloginfo('stylesheet_directory');?>/images/product-placeholder.jpg" alt="Product Image Placeholder">
							<?php } ?>
							</a>
						</div>
						<div class="item-body">	

							<div class="title"><a href="<?php echo get_permalink($product->get_id());?>"><?php echo $product->get_name(); ?></a></div></a>	
						</div>

					</div>
					<?php  } } ?>
				</div>
			</div>
		</section>
        	

	        <section class="three-col">
	            <h3>Latest Articles</h3>
	            <div class="owl-carousel" id="latest-articles">
	            <?php query_posts(array(
	                'post_type' => 'post',
	                'orderyby' => 'ASC',
	            ) ); ?>
	            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	            <div class="item">
					<div class="item-img">
                    	<?php 
							$size = 'featured-post-img';
							$imgHero = get_field('blog_hero'); 
							$imgURL = $imgHero['sizes'][$size];
							$featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'featured-post-img' );
						?>
						<a href="<?php the_permalink(); ?>"><img <?php if (get_the_post_thumbnail_url() == !'') :?>  src="<?= $featuredImg[0]; ?>" <?php else :?> src="<?php echo $imgURL; ?>" <?php endif; ?> alt="<?php the_title(); ?>"></a>
					</div>
	                <div class="item-body">
	                    <div class="tag-con">
	                        <?php
	                            $category = get_the_category();
	                            $author = get_the_author();
	                        ?>
	                        <p>By: <span><?php the_field('written_by'); ?></span>&nbsp;&#x2022;&nbsp;<span><?php print_r(get_primary_category(get_the_ID()), true); ?></span></p>
	                    </div>
	                    <p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
	                    <a href="<?php the_permalink(); ?>" class="btn-read-more">Read More</a>
	                    <div class="share-con">
	                        <div class="social-con">
	                            <p>Share:</p>
	                            <ul>
	                                <li>
	                                    <a href="https://www.facebook.com/sharer.php?s=100&u=<?php the_permalink(); ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" rel="nofollow"><i class="fab fa-twitter"></i></a>
	                                </li>
	                                <li>
	                                    <a href="https://pinterest.com/pin/create/bookmarklet/?url=<?php the_permalink(); ?>" rel="nofollow"><i class="fab fa-pinterest"></i></a>
	                                </li>
	                            </ul>
	                        </div>
	                        
	                    </div>
	                </div>
	            </div>
	            <?php  endwhile; endif; ?>
	            </div>

	        </section>
        </div>


	</div><!-- #primary -->

<?php
get_footer();
