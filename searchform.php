<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<label>
		<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Enter Keyword or Item # ', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>