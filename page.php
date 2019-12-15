<?php
get_header();	
?>

<div id="primary" class="content-area">
	
	<div class="container default-page">
    <?php while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>	

    <?php endwhile; // End of the loop. ?>
    </div>
   
</div><!-- #primary -->

<?php
get_footer();