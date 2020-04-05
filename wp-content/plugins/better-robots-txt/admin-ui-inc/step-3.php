<h3><?php 
echo  __( 'STEP', 'better-robots-txt' ) . " 3 - " . __( 'LOADING PERFORMANCE FOR WOOCOMMERCE', 'better-robots-txt' ) ;
?></h3>
            
<div class="rt-row">

<div class="rt-column col-3">
    <span class="rt-label"><?php 
echo  __( 'Optimize store\'s crawlability', 'better-robots-txt' ) ;
?></span>
</div>

<div class="rt-column col-8">

    <?php 
// free only
?>

        <div class="rt-switch-radio dual-btns">
        <input type="radio" id="woocom_links-btn1" name="" value=""  disabled />
        <label for="woocom_links-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

        <input type="radio" id="woocom_links-btn2" name="" value="" checked ?>
        <label for="woocom_links-btn2"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

        <div class="rt-tooltip">
            <span class="dashicons dashicons-editor-help"></span>
            <span class="rt-tooltiptext"><?php 
echo  __( 'Enable this feature prevents crawlers from indexing "add-to-cart", "orderby", "fllter", ... links which require a lot of CPU, memory & bandwidth usage while they are useless for search engines. Optimizing your robots.txt file for WooCommerce allows to provide more processing power for pages that really matter and boost your loading performance.', 'better-robots-txt' ) ;
?></span>
        </div>
        <div class="rt-tooltip-after"><img src="<?php 
echo  plugin_dir_url( __FILE__ ) ;
?>../assets/imgs/star2.png" style="width: 490px; height: auto;" alt="" /></div>
        </div>
        <br />
        <div class="rt-alert rt-info">
            <span class="closebtn">&times;</span> 
            <?php 
echo  $get_pro . " " . __( 'Loading Performance for Woocommerce', 'better-robots-txt' ) ;
?>
        </div>

    <?php 
?>

</div>

</div>

<hr>