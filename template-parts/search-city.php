<div class="card my-4">
          <h5 class="card-header pute">City Search</h5>
          <div class="card-body">
            <div class="input-group">
              <!-- <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span> -->
              <form role="search" method="get" class="search-field" action="<?php echo esc_url( home_url( '/' ) ) ?>">
          <label id="city_search">
            <span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
            <input type="search" class="zip" placeholder="<?php echo esc_attr_x( '   Ex: Detroit ', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
          </label>
              <!-- <button type="submit" class="search-submit"><i class="fa fa-search"></i></button> -->
          </form>
            </div>
          </div>
        </div>