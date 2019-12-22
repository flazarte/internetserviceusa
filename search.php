<?php
get_header();   
?>

<section class="engine"><a href=""></a></section><section class="cid-rtgokFkwN6" id="header2-5">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    Search Results For "<?php echo get_search_query(); ?>" </h1>
                
                
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="fas fa-arrow-down"></i>
        </a>
    </div>
</section>

<section class="section-table cid-rtgvspRekY" id="table1-6">

  
  
  <div class="container container-table">
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-1"><strong>

     <?php
                        // Get total posts
                        if ($wp_query->query['s']) {
                            $total = $wp_query->post_count;
                        } else {
                            $total = 0;
                        }
                        
                        if ($total > 0) {
                            if ($total == 1) {
                                echo '<span>'. $wp_query->post_count .' Match</span>';
                            } else {
                                echo '<span>'. $wp_query->post_count .' Matches</span>';
                            } 
                        }
                        else { ?>
                            
                               <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.' ); ?></p>
        
                            
                        <?php } ?>

      </strong></h2>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
            <div class="col-md-6">
            </div>
          </div>
        </div>

        <div class="container scroll">
          <table class="table isSearch" cellspacing="0">
            <thead class="align-center bold blue">
              <tr class="table-heads ">
                  
                  
                  
                  
              <th class="head-item mbr-fonts-style display-7">Title</th>
             <th class="head-item mbr-fonts-style display-7">Post Type</th>
            <th class="head-item mbr-fonts-style display-7">Action</th></tr>
            </thead>

            <tbody>
              
              
              
              
            
                
               <?php
                if ($wp_query->query['s']) {
                $i = 0;
                while( have_posts() ): the_post();
                if ( $i == 0 ) {
                    echo '<section class="search-result"><ul>';
                }
            ?> 
               <tr class="align-center">  
                
              <td class="body-item mbr-fonts-style display-7"><a target="_blank" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></td>
              <?php if(get_post_type()=='product') :?>
                <td class="body-item mbr-fonts-style display-7">City</td>
                <?php else :?>
              <td class="body-item mbr-fonts-style display-7"><?php echo get_post_type(); ?></td>
          <?php endif ;?>
              <td class="body-item mbr-fonts-style display-7 blue"><a target="_blank" href="<?php the_permalink(); ?>">VIEW</a></td>


              </tr>


                <?php
                    $i++;
                    // if we're at the end close the row
                    if ( $i == $total ) {
                        echo '</ul></section>';
                    } else {
                        if ( $i % 60 == 0 ) {
                            echo '</ul></section>';
                            
                        }
                    }
                endwhile;

                }
            ?>
                
                
                
        </tbody>
          </table>
        </div>
        <div class="container table-info-container">
          <div class="row info">
            <div class="col-md-6">
              <div class="dataTables_info mbr-fonts-style display-7">
                <span class="infoBefore">Showing</span>
                <span class="inactive infoRows"></span>
                <span class="infoAfter">entries</span>
                <span class="infoFilteredBefore">(filtered from</span>
                <span class="inactive infoRows"></span>
                <span class="infoFilteredAfter"> total entries)</span>
              </div>
            </div>
            <div class="col-md-6"></div>
          </div>
        </div>
      </div>
   


            
            </div>

        </section>
<?php
get_footer();