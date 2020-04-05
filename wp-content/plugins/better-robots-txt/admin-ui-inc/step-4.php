<?php

// sitemap feature
$site_url = home_url();
$yoast_sitemap_url = $site_url . '/sitemap_index.xml';
$xml_sitemap_url = $site_url . '/sitemap.xml';
// cURL method to check site header response
$ch = curl_init( $yoast_sitemap_url );
curl_setopt( $ch, CURLOPT_HEADER, true );
// we want headers
curl_setopt( $ch, CURLOPT_NOBODY, true );
// we don't need body
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
$curl_output = curl_exec( $ch );
$yoast_sitemap_header = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
curl_close( $ch );
$ch2 = curl_init( $xml_sitemap_url );
curl_setopt( $ch2, CURLOPT_HEADER, true );
// we want headers
curl_setopt( $ch2, CURLOPT_NOBODY, true );
// we don't need body
curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch2, CURLOPT_TIMEOUT, 10 );
$curl_output = curl_exec( $ch2 );
$xml_sitemap_header = curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
curl_close( $ch2 );

if ( class_exists( 'WPSEO_Sitemaps' ) && $yoast_sitemap_header == "200" ) {
    // yoast is working, sitemap added
    $sitemap_output = '<div class="rt-alert rt-info"><span class="closebtn">&times;</span>' . sprintf( wp_kses( __( '<a href="%s">XML Sitemap</a> detected but not added.', 'better-robots-txt' ), array(
        'a' => array(
        'href' => array(),
    ),
    ) ), esc_url( $yoast_sitemap_url ) ) . " " . $get_pro . " " . __( 'sitemap feature', 'better-robots-txt' ) . '</div>';
} elseif ( class_exists( 'WPSEO_Sitemaps' ) && $yoast_sitemap_header == "404" ) {
    // yoast is enabled but sitemap is not
    $sitemap_output = '<div class="rt-alert rt-info"><span class="closebtn">&times;</span>' . __( 'Yoast SEO is installed.', 'better-robots-txt' ) . " " . $get_pro . " " . __( 'sitemap feature', 'better-robots-txt' ) . '</div>';
} elseif ( $xml_sitemap_header == "200" ) {
    $sitemap_output = '<div class="rt-alert rt-info"><span class="closebtn">&times;</span>' . sprintf( wp_kses( __( '<a href="%s">XML Sitemap</a> detected but not added.', 'better-robots-txt' ), array(
        'a' => array(
        'href' => array(),
    ),
    ) ), esc_url( $xml_sitemap_url ) ) . " " . $get_pro . " " . __( 'sitemap feature', 'better-robots-txt' ) . '</div>';
} else {
    //yoast is not installed/enabled
    $sitemap_output = '<div class="rt-alert rt-warning"><span class="closebtn">&times;</span>' . $get_pro . " " . __( 'sitemap option', 'better-robots-txt' ) . '</div>';
}

// end yoast sitemap checking
?>

<h3><?php 
echo  __( 'STEP', 'better-robots-txt' ) . " 4 - " . __( 'HELP SEARCH ENGINES BOTS EXPLORE, CRAWL & INDEX ALL YOUR WEBPAGES:', 'better-robots-txt' ) ;
?></h3>
		
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Boost your ranking with XML sitemap', 'better-robots-txt' ) ;
?></span>
        &nbsp;
        <div class="rt-tooltip">
        <span class="dashicons dashicons-editor-help"></span>
        <span class="rt-tooltiptext"><?php 
echo  __( 'Add your sitemap in the robots.txt file to boost your ranking', 'better-robots-txt' ) ;
?></span>
    </div>
    </div>
    
    <div class="rt-column col-8">
        
        <?php 
// free only
?>
        
            <input type="text" name="sitemap_file" id="sitemap_file" class="rt-field" value="" disabled>
            <?php 
echo  $sitemap_output ;
?>

        <?php 
// end free only
?>
        
    </div>
    
</div>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Custom rules (for experts)', 'better-robots-txt' ) ;
?></span>
    </div>
    
    <div class="rt-column col-8">
        <textarea name="user_agents" rows="4" class="rt-area" id="user_agents"><?php 
echo  stripslashes( $options['user_agents'] ) ;
?></textarea>
        <div class="rt-alert rt-warning">
            <span class="closebtn">&times;</span>
            <?php 
echo  __( 'Add more custom rules if you need them, otherwise, leave it with default rules.', 'better-robots-txt' ) ;
?>
        </div>
    </div>
    
</div>
    
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Crawl-delay', 'better-robots-txt' ) ;
?></span>
    </div>
    
    <div class="rt-column col-8">
        <input type="text" name="crawl_delay" id="crawl_delay" class="rt-field" value="<?php 
if ( isset( $options['crawl_delay'] ) && !empty($options['crawl_delay']) ) {
    echo  stripslashes( $options['crawl_delay'] ) ;
}
?>">
        <div class="rt-alert rt-warning">
            <span class="closebtn">&times;</span> 
            <?php 
echo  __( 'The crawl-rate defines the time between requests bots make to your website in seconds. e.g: 10', 'better-robots-txt' ) ;
?>
        </div>
    </div>
    
</div>

<hr>