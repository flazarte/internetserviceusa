<h3><?php echo __( 'STEP', 'better-robots-txt' ) . " 5 - " . __( 'PERSONALIZE YOUR ROBOTS.TXT:', 'better-robots-txt' ); ?></h3>
            
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php echo __( 'Be unique', 'better-robots-txt' ); ?></span>
    </div>
    
    <div class="rt-column col-8">
        <textarea name="personalize" rows="4" class="rt-area" id="personalize"><?php if(isset($options['personalize']) && !empty($options['personalize'])) echo stripslashes($options['personalize']); ?></textarea>
        <div class="rt-alert rt-warning">
            <span class="closebtn">&times;</span> 
            <?php echo __( 'Create a unique signature like:', 'better-robots-txt' ); ?> <a href="https://store.nike.com/robots.txt" target="_blank">NIKE</a>, <a href="https://www.tripadvisor.com/robots.txt" target="_blank">TRIPADVISOR</a>, <a href="https://www.youtube.com/robots.txt" target="_blank">YOUTUBE</a>, <a href="https://www.yelp.com/robots.txt" target="_blank">YELP</a>
        </div>
    </div>
    
</div>

<hr>