<?php
get_header();	
?>

<div id="primary" class="content-area">
	
    <?php while(have_posts()) : the_post(); ?>

        

    <?php endwhile; // End of the loop. ?>

</div><!-- #primary -->

<?php
get_footer();