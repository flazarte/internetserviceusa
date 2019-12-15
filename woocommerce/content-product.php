<?php
get_header();	
?>


<div id="primary" class="content-area">
       	<div class="container">
     	<?php if (is_product_category('more')) : ?> 
     		<section class="placeholder-con">
				<p><a href="<?php echo get_home_url(); ?>">Home</a><span>></span><?php woocommerce_breadcrumb(); ?></p>
			</section>
			<section class="popular-categories">
				<h1>All Categories</h1>
				<div class="six-col">
					<?php
					global $post;

					$terms = get_the_terms( $post->ID, 'product_cat','more' );
					$link = get_term_link( $terms[0]->term_id, 'product_cat' );
					foreach ( $terms as $term ) {
					$product_cat_id = $term->term_id;
						//do nothing here
						break;
					}

					//get the category id to be excluded by name
					//1.More category
					$cat_more = get_term_by( 'slug', 'More', 'product_cat' );
					$cat_id_more = $cat_more->term_id;

					//2. Featured category
					$cat_featured = get_term_by( 'slug', 'Featured', 'product_cat' );
					$cat_id_featured = $cat_featured->term_id;
					

					$taxonomy     = 'product_cat';
   					$orderby      = '';  
   					$show_count   = 0;     
    				$pad_counts   = 0;     
   				    $hierarchical = 1;     
    				$title        = '';  
    				$empty        = 1;
					$args = array(
						'taxonomy'     => $taxonomy,
						'orderby'      => $orderby,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title,
						'hide_empty'   => $empty,
						'parent'       => 0,
						'exclude'      => array($cat_id_more,$cat_id_featured),
					
					);
					
					$prod_categories = get_terms( $args);

					foreach( $prod_categories as $prod_cat ) :
						$cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
						$shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
						$term_link = get_term_link( $prod_cat, 'product_cat' );
					?>


					<div class="item">
						<div class="img-con"><a href="<?php echo $term_link; ?>">
							<img src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $prod_cat->name; ?>">
						</a>
							
						</div>
						<a href="<?php echo $term_link; ?>"><h2><?php echo $prod_cat->name; ?></h2></a>
					</div>
					<?php endforeach; wp_reset_query();?>
				
				</div>
			</section>
			
			<?php elseif (is_product_category()) : ?>
				<?php
					global $post;
					//get the quesried term id
					$term = get_queried_object();
					$cat_slug =  $term->slug;
					//another url link query

					$terms = get_the_terms( $post->ID, 'product_cat');
					$link = get_term_link( $terms[0]->term_id, 'product_cat' );
					foreach ( $terms as $term ) {
						$product_cat_id = $term->term_id;
					
						//do nothing here
						break;
					}
					$product_cat_link = get_term_link( $product_cat_id, 'product_cat' );
   		
    				//do nothing here
    	
					//get the product category url

					$link = '';
					$terms = get_the_terms( $post->ID, 'product_cat' );
					$link = get_term_link( $terms[0]->term_id, 'product_cat' );

					


				?>



			<section class="placeholder-con">
				<p><a href="<?php echo get_home_url(); ?>">Home</a><span>></span><?php woocommerce_breadcrumb(); ?></p>
			</section>
			<section class="shop-body">
				
				<div class="shop-menu">

					<ul>
						

						<?php   
					//get the category id to be excluded by name
					//1.More category
					$cat_more = get_term_by( 'slug', 'More', 'product_cat' );
					$cat_id_more = $cat_more->term_id;

					//2. Featured category
					$cat_featured = get_term_by( 'slug', 'Featured', 'product_cat' );
					$cat_id_featured = $cat_featured->term_id;
							$args = array(
						        'taxonomy' => 'product_cat',
						        'hide_empty' => false,
						        'parent'   => 0,
						        'exclude'  => array($cat_id_more,$cat_id_featured),
						    );
						  	$product_cat = get_terms( $args );

						 	foreach ($product_cat as $parent_product_cat){
						 		//getting the current category id
							  		$category= get_queried_object();
							  		$parent_cat_id = $category->term_id;

							  		

						?>

							<?php 

									$child_args = array(
							        'taxonomy' => 'product_cat',
							        'hide_empty' => true,
							        'parent'   => $parent_product_cat->term_id
							    );
							  	$child_product_cats = get_terms( $child_args );

								 ?>

									<?php
							  	foreach ($child_product_cats as $child_product_cat) {
							  		//getting the current category id
							  		$category= get_queried_object();
							  		$child_cat_id = $category->term_id;
										
							?>
							<?php } ?>

							<?php 
							// get the parent category by sub-category
							$parentcats = get_ancestors($child_cat_id, 'product_cat');
							foreach($parentcats as $parentcat){
   									  $parentcat;
							?>
							<?php } ?>

							<li <?php if($parentcat == $parent_product_cat->term_id ) :?>class="open" <?php else :?><?php endif ;?>>
							<div class="item-con">
								<a href="<?php echo get_term_link($parent_product_cat->term_id); ?>" <?php if($parent_product_cat->term_id == $parent_cat_id ) :?>class="item-name open" <?php else :?><?php endif ;?> class="item-name"><?php echo $parent_product_cat->name;?></a>
								<?php 

									$child_args = array(
							        'taxonomy' => 'product_cat',
							        'hide_empty' => true,
							        'parent'   => $parent_product_cat->term_id
							    );
							  	$child_product_cats = get_terms( $child_args );

								 ?>
								<?php if($child_product_cats == true) :?>
								<a href="#" rel="nofollow" class="accordion"><i class="fas fa-sort-down"></i></a>
								<?php else:?>
								<?php endif;?>
							</div>
								<ul>
							<?php
							 
							  	

							  	foreach ($child_product_cats as $child_product_cat) {
							  		//getting the current category id
							  		$category= get_queried_object();
							  		$child_cat_id = $category->term_id;
										
							?>

							
								<li>
									<a <?php if($child_product_cat->term_id == $child_cat_id ) :?>class="open" <?php else :?><?php endif ;?>href="<?php echo  get_term_link($child_product_cat->term_id);?>"><?php echo $child_product_cat->name?></a>
								</li>
							

							<?php } ?>
							</ul>
							</li>
  						<?php } ?>
						
					</ul>
				</div>
				<div class="shop-col">
					<h1><?php woocommerce_page_title(); ?></h1>
					<?php
						$query = new WC_Product_Query(array(
							'post_type' => 'product_cat',
							'product_cat'   =>  $cat_slug,						
							'order' => 'DESC'
						));

						$products = $query->get_products($term);

						if (!empty($products)) {
							foreach ($products as $product) {
					?>
					<div class="item on-sale">

						<?php if ($product->is_on_sale()) : ?>
						<div class="sale-banner">Item on Sale!</div>
						<?php else : ?>
							<?php endif;  ?>

						<div class="item-img"><a href="<?php echo get_permalink($product->get_id());?>"><img src="<?php echo wp_get_attachment_image_src( $product->get_image_id() ,'medium')[0]; ?>" alt="<?php echo $product->get_name(); ?>" ></a>
							
						</div>
						<div class="item-body">
							<?php $url_id =  $product->get_id();
									?>
							<a href="<?php echo get_permalink($product->get_id());?>" class="item-name"><?php echo $product->get_name(); ?></a>
							<p class="item-desc"><?php echo wp_trim_words( get_field('product_description',$url_id), $num_words = 30, $more = '...'); ?></p>

							<div class="price-con">
								<div class="left">
									<div class="item-no">Item# <span><?php echo $product->get_id(); ?></span></div>
									<?php if ($product->is_on_sale()) : ?>
									<div class="price"><?php echo $product->get_price_html(); ?></div>
									<?php else : ?>
										<div class="price" style="color: orange;"><?php echo $product->get_price_html(); ?></div>
									<?php endif;  ?>
								</div>
								<div class="right"> 
										<?php $url_id =  $product->get_id();
									?>
									<a href="<?php echo get_field('product_url',$url_id) ?>" class="shop-btn">
										<i class="fas fa-cart-plus"></i>
										<span>Shop Now</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } } ?> 
				</div>
			</section>
			
			<section class="popular-categories">
				<h3>Popular Categories</h3>
				<div class="six-col">
					<?php

					//get the category id to be excluded by name
					//1.More category
					$cat_more = get_term_by( 'slug', 'More', 'product_cat' );
					$cat_id_more = $cat_more->term_id;

					//2. Featured category
					$cat_featured = get_term_by( 'slug', 'Featured', 'product_cat' );
					$cat_id_featured = $cat_featured->term_id;
					

					$taxonomy     = 'product_cat';
   					$orderby      = '';  
   					$show_count   = 0;     
    				$pad_counts   = 0;     
   				    $hierarchical = 1;     
    				$title        = '';  
    				$empty        = 1;
					$args = array(
						'taxonomy'     => $taxonomy,
						'orderby'      => $orderby,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title,
						'hide_empty'   => $empty,
						'number'       => 6,
						'parent'       => 0,
						'exclude'      => array($cat_id_more,$cat_id_featured),
					
					);
					

					$prod_categories = get_terms( 'product_cat', $args);

					foreach( $prod_categories as $prod_cat ) :
						$cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
						$shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
						$term_link = get_term_link( $prod_cat, 'product_cat' );
					?>
					<div class="item">
						<div class="img-con"><a href="<?php echo $term_link; ?>">
							<img src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $prod_cat->name; ?>">
						</a>
						</div>
						<a href="<?php echo $term_link; ?>"><h2><?php echo $prod_cat->name; ?></h2></a>
					</div>
					<?php endforeach; wp_reset_query();?>
				
				</div>
			</section>
	 
			<?php else : ?>

			
				<section class="placeholder-con">
				<p><a href="<?php echo get_home_url(); ?>">Home</a><span>></span><a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" ><?php woocommerce_page_title(); ?></a></p>
			
			</section>
			<section class="shop-body">

				<div class="shop-menu">

					<ul>
						

						<?php    
					//get the category id to be excluded by name
					//1.More category
					$cat_more = get_term_by( 'slug', 'More', 'product_cat' );
					$cat_id_more = $cat_more->term_id;

					//2. Featured category
					$cat_featured = get_term_by( 'slug', 'Featured', 'product_cat' );
					$cat_id_featured = $cat_featured->term_id;
							$args = array(
						        'taxonomy' => 'product_cat',
						        'hide_empty' => false,
						        'parent'   => 0,
						        'exclude'  => array($cat_id_more,$cat_id_featured),
						    );
						  	$product_cat = get_terms( $args );

						 	foreach ($product_cat as $parent_product_cat){
						?>

							<li>
							<div class="item-con">
								<a href="<?php echo get_term_link($parent_product_cat->term_id); ?>" class="item-name"><?php echo $parent_product_cat->name;?></a>
								<?php 

									$child_args = array(
							        'taxonomy' => 'product_cat',
							        'hide_empty' => true,
							        'parent'   => $parent_product_cat->term_id
							    );
							  	$child_product_cats = get_terms( $child_args );

								 ?>
								<?php if($child_product_cats == true) :?>
								<a href="#" rel="nofollow" class="accordion"><i class="fas fa-sort-down"></i></a>
								<?php else:?>
								<?php endif;?>
							</div>
							<ul>
							<?php
							 
							  
							  	foreach ($child_product_cats as $child_product_cat) {
							?>

							
								<li>
									<a href="<?php echo  get_term_link($child_product_cat->term_id);?>"><?php echo $child_product_cat->name?></a>
								</li>
							

							<?php } ?>
							</ul>
							</li>
  						<?php } ?>
						
					</ul>
				</div>
							
						
						
				<div class="shop-col" style="flex-wrap: wrap;" id="product-container" >
					<h1><?php woocommerce_page_title(); ?></h1>
					<?php 
						$shop_id = woocommerce_get_page_id( 'shop' ) ;

					?>
					<p class="desc"><?php the_field('tagline_desc', $shop_id); ?></p>

					<?php	
					
					$query = new WC_Product_Query(array(
						'post_type' => 'product',						
						'limit' => 14,
						'order' => 'DESC'
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

						<div class="item-img"><a href="<?php echo get_permalink($product->get_id());?>"><img src="<?php echo wp_get_attachment_image_src( $product->get_image_id() ,'medium')[0]; ?>" alt="<?php echo $product->get_name(); ?>" ></a>
							
						</div>
						<div class="item-body">
							<?php $url_id =  $product->get_id();
									?>
							<a href="<?php echo get_permalink($product->get_id());?>" class="item-name"><?php echo $product->get_name(); ?></a>
							<p class="item-desc"><?php echo wp_trim_words( get_field('product_description',$url_id), $num_words = 30, $more = '...'); ?></p>
							<div class="price-con">
								<div class="left">
									<div class="item-no">Item# <span><?php echo $product->get_id(); ?></span></div>
									<?php if ($product->is_on_sale()) : ?>
									<div class="price"><?php echo $product->get_price_html(); ?></div>
									<?php else : ?>
										<div class="price" style="color: orange;"><?php echo $product->get_price_html(); ?></div>
									<?php endif;  ?>
								</div>
								<div class="right"> 
										<?php $url_id =  $product->get_id();
									?>
									<a href="<?php echo get_field('product_url',$url_id) ?>" class="shop-btn">
										<i class="fas fa-cart-plus"></i>
										<span>Shop Now</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } } ?> 
				
				</div>

			

				
				<button class="btn-shop-loadmore">Load more</button>	
				
			</section>


			<section class="popular-categories">
				<h3>Popular Categories</h3>
				<div class="six-col">
					<?php

					//get the category id to be excluded by name
					//1.More category
					$cat_more = get_term_by( 'slug', 'More', 'product_cat' );
					$cat_id_more = $cat_more->term_id;

					//2. Featured category
					$cat_featured = get_term_by( 'slug', 'Featured', 'product_cat' );
					$cat_id_featured = $cat_featured->term_id;
					

					$taxonomy     = 'product_cat';
   					$orderby      = '';  
   					$show_count   = 0;     
    				$pad_counts   = 0;     
   				    $hierarchical = 1;     
    				$title        = '';  
    				$empty        = 1;
					$args = array(
						'taxonomy'     => $taxonomy,
						'orderby'      => $orderby,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title,
						'hide_empty'   => $empty,
						'number'       => 6,
						'parent'       => 0,
						'exclude'      => array($cat_id_more,$cat_id_featured),
					
					);
					

					$prod_categories = get_terms( 'product_cat', $args);

					foreach( $prod_categories as $prod_cat ) :
						$cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
						$shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
						$term_link = get_term_link( $prod_cat, 'product_cat' );
					?>


					<div class="item">
						<div class="img-con"><a href="<?php echo $term_link; ?>">
							<img src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $prod_cat->name; ?>">
						</a>
							
						</div>
						<a href="<?php echo $term_link; ?>"><h2><?php echo $prod_cat->name; ?></h2></a>
					</div>
					<?php endforeach; wp_reset_query();?>
				
				</div>
			</section>

		<?php endif;  ?>
		</div>

</div><!-- #primary -->

<?php
get_footer();