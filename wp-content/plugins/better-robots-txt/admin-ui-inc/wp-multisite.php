<h3><?php 
echo  __( 'WP MULTI SITE:', 'better-robots-txt' ) ;
?></h3>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Enable Multisite Rules', 'better-robots-txt' ) ;
?></span>
    </div>
    
    <div class="rt-column col-8">
        
    <label class="rt-switch rt-multisite-label">
        <input type="checkbox" id="rt-multisite-on" name="rt-multisite-on" <?php 
if ( $options['rt-multisite-on'] ) {
    echo  'checked="checked"' ;
}
?> />
        <span class="rt-slider rt-round"></span>
    </label>

        &nbsp; <span><?php 
echo  __( 'Use this option if you have directory based network sites (MULTISITE)', 'better-robots-txt' ) ;
?></span>
    </div>
    
</div>

<div class="rt-multisite" <?php 

if ( isset( $options['rt-multisite-on'] ) && !empty($options['rt-multisite-on']) ) {
    echo  'style="display: block;"' ;
} else {
    echo  'style="display: none;"' ;
}

?>>

<div class="rt-alert rt-warning">
    <span class="closebtn">&times;</span> 
    <?php 
echo  sprintf( wp_kses( __( 'Use this option if you have directory based network sites (MULTISITE). <a href="%s" target="_blank">Read more about WP Multisite (Network)</a>', 'better-robots-txt' ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( "https://codex.wordpress.org/Create_A_Network" ) ) ;
?>
</div>
<div class="rt-note" style="margin: 5px 0;"><p><?php 
echo  __( "Note: This multisite feature would only work for directory based network sites. e.g: maindomain.com/networksite1 or maindomain.com/networksite2 etc. OR, if using a Wordpress directory, maindomain.com/wp, .... As search engine bots always look for robots.txt inside main domain root directory (maindomain.com/robots.txt). So a single robots.txt file will cover all your directory based network sites with this feature. Sub-domains based network sites are NOT supported.", 'better-robots-txt' ) ;
?></p></div>

<?php 
?>
    <div class="rt-alert rt-info">
        <span class="closebtn">&times;</span> 
        <?php 
echo  $get_pro . " " . __( 'all WP Multisite features, including yoast sitemap, woocommerce, bad bots, backlinks & pinterest protect', 'better-robots-txt' ) ;
?>
    </div>
<?php 
// end free only
?>

    <div class="rt-row">

        <div class="rt-column col-3">
            <span class="rt-label"><?php 
echo  __( 'Add network site on each line', 'better-robots-txt' ) ;
?></span>
        </div>
        
        <div class="rt-column col-8">

            <?php 
// free only
?>

                <textarea name="rt_multisite" rows="4" class="rt-area" id="rt_multisite" placeholder="e.g:&#10;shop&#10;blog&#10;members" disabled></textarea>
                
            <?php 
// end free only
?>

        </div>
        
    </div>

    <h4>YOAST SITEMAP</h4>

    <div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Sitemap for all network sites', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">
        
        <?php 
// free only
?>

            <div class="rt-switch-radio dual-btns">
                    <input type="radio" id="network_sitemap-btn1" name="network_sitemap" value=""  disabled />
                    <label for="network_sitemap-btn1"><?php 
echo  __( 'Yes', 'better-robots-txt' ) ;
?></label>

                    <input type="radio" id="network_sitemap-btn2" name="network_sitemap" value="" checked="checked" />
                    <label for="network_sitemap-btn2"><?php 
echo  __( 'No', 'better-robots-txt' ) ;
?></label>

                    <div class="rt-tooltip">
                        <span class="dashicons dashicons-editor-help"></span>
                        <span class="rt-tooltiptext"><?php 
echo  __( 'It will auto add Yoast Sitemap link for each network site', 'better-robots-txt' ) ;
?></span>
                    </div>
                </div>
            

        <?php 
// end free only
?>

        </div>

    </div>

    <h4>LOADING PERFORMANCE FOR WOOCOMMERCE</h4>

    <div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Stop Crawling Useless links', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">
        
        <?php 
// free only
?>

            <div class="rt-switch-radio dual-btns">
                    <input type="radio" id="network_woo-btn1" name="network_woo" value="" disabled />
                    <label for="network_woo-btn1"><?php 
echo  __( 'Yes', 'better-robots-txt' ) ;
?></label>

                    <input type="radio" id="network_woo-btn2" name="network_woo" value="" checked="checked" />
                    <label for="network_woo-btn2"><?php 
echo  __( 'No', 'better-robots-txt' ) ;
?></label>

                    <div class="rt-tooltip">
                        <span class="dashicons dashicons-editor-help"></span>
                        <span class="rt-tooltiptext"><?php 
echo  __( 'Stop crawling woocommerce useless links for each network site', 'better-robots-txt' ) ;
?></span>
                    </div>
                </div>
            

        <?php 
// end free only
?>

        </div>

    </div>

    <h4>PROTECT YOUR DATA</h4>

    <div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Bad Bots, Backlinks, Pinterest', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">
        
        <?php 
// free only
?>

            <div class="rt-switch-radio dual-btns">
                    <input type="radio" id="network_protect-btn1" name="network_protect" value="" disabled />
                    <label for="network_protect-btn1"><?php 
echo  __( 'Yes', 'better-robots-txt' ) ;
?></label>

                    <input type="radio" id="network_protect-btn2" name="network_protect" value="" checked="checked" />
                    <label for="network_protect-btn2"><?php 
echo  __( 'No', 'better-robots-txt' ) ;
?></label>

                    <div class="rt-tooltip">
                        <span class="dashicons dashicons-editor-help"></span>
                        <span class="rt-tooltiptext"><?php 
echo  __( 'It will add Step 4 - Data Protect Rules for each network site which inludes Bad Bots, Backlinks Protector, Backlink Blocker, Block Pinterest Bot and Backlink Protector', 'better-robots-txt' ) ;
?></span>
                    </div>
                </div>

        <?php 
// end free only
?>

        </div>

    </div>

    <?php 
?>
        <div class="rt-alert rt-info">
            <span class="closebtn">&times;</span> 
            <?php 
echo  $get_pro . " " . __( 'all WP Multisite features, including yoast sitemap, woocommerce, bad bots, backlinks & pinterest protect', 'better-robots-txt' ) ;
?>
        </div>
    <?php 
// end free only
?>

</div>

<hr>