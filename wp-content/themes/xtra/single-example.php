<?php // Sample single file for custom post types

get_header();

//Codevz_Theme::before_content();

if ( have_posts() ) {
	the_post();

	// Post Title
	echo '<h1 class="section_title">' . get_the_title() . '</h1>';

	// Post Content
	echo '<div class="cz_post_content">';
	the_content();
	echo '</div><div class="clr"></div>';

	// Pagination
	wp_link_pages([
		'before'=>'<div class="pagination mt20 clr">', 
		'after'=>'</div>', 
		'link_after'=>'</b>', 
		'link_before'=>'<b>'
	]);
}

//Codevz_Theme::after_content();

get_footer();