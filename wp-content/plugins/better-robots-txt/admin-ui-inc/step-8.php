<h3><?php 
    echo  __( 'STEP', 'better-robots-txt' ) . " 8 - " . __( 'BOOST SERPS VISIBILITY & RESPONSIVE DESIGN:', 'better-robots-txt' ) ;
    ?></h3>
    
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
    echo  __( 'Boost your Alt texts', 'better-robots-txt' ) ;
    ?></span>
    </div>

    <div class="rt-column col-8">

    <label class="rt-switch rt-boost-label">
        <input type="checkbox" id="boost-alt" name="boost-alt" value="boost" <?php if ( $options['boost-alt'] ) { echo  'checked="checked"'; } ?> />
        <span class="rt-slider rt-round"></span>
    </label>

        &nbsp; <span><?php 
    echo  __( 'Boost your ranking with optimized Alt tags', 'better-robots-txt' ) ;
    ?></span>

        <div class="rt-boost" <?php if (isset($options['boost-alt']) && !empty($options['boost-alt'])) { echo 'style="display: inline;"'; } else { echo 'style="display: none;"';} ?>>

            <div class="rt-alert rt-success" style="margin-top: 10px;"><?php echo sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">BIALTY Wordpress plugin</a> & auto-optimize all your alt texts for FREE', 'better-robots-txt' ), array( 
                    'a' => array( 
                        'href' => array(), 
                        'target' => array(), 
                    ), 
                    'a' => array( 
                        'href' => array(), 
                        'target' => array(), 
                    ),
                ) ), esc_url( "https://wordpress.org/plugins/bulk-image-alt-text-with-yoast/" ), esc_url( "https://wordpress.org/plugins/bulk-image-alt-text-with-yoast/" ) ); ?>
            </div>
        </div>
    </div>
    
</div>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
    echo  __( 'Mobile-Friendly & responsive design', 'better-robots-txt' ) ;
    ?></span>
    </div>
    
    <div class="rt-column col-8">

    <label class="rt-switch rt-mobi-label">
        <input type="checkbox" id="rt-mobilook" name="rt-mobilook" value="boost" <?php if ( $options['rt-mobilook'] ) { echo  'checked="checked"'; } ?> />
        <span class="rt-slider rt-round"></span>
    </label>

    &nbsp; <span><?php 
    echo  __( 'Get dynamic mobile previews of your pages/posts/products + Facebook debugger', 'better-robots-txt' ) ;
    ?></span>

        <div class="rt-mobi" <?php if (isset($options['rt-mobilook']) && !empty($options['rt-mobilook'])) { echo 'style="display: inline;"'; } else { echo 'style="display: none;"';} ?>>

            <div class="rt-alert rt-success" style="margin-top: 10px;"><?php echo sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">Mobilook</a> and test your website on Dualscreen format (Galaxy fold)', 'better-robots-txt' ), array( 
                    'a' => array( 
                        'href' => array(), 
                        'target' => array(), 
                    ), 
                    'a' => array( 
                        'href' => array(), 
                        'target' => array(), 
                    ),
                ) ), esc_url( "https://wordpress.org/plugins/mobilook/" ), esc_url( "https://wordpress.org/plugins/mobilook/" ) ); ?>
            </div>
        </div>
    </div>

</div>

<div class="rt-row">

<div class="rt-column col-3">
    <span class="rt-label"><?php 
echo  __( 'Boost your image title attribute', 'better-robots-txt' ) ;
?></span>
</div>

<div class="rt-column col-8">

<label class="rt-switch rt-bigta-label">
    <input type="checkbox" id="rt-bigta" name="rt-bigta" value="boost" <?php if ( $options['rt-bigta'] ) { echo  'checked="checked"'; } ?> />
    <span class="rt-slider rt-round"></span>
</label>

&nbsp; <span><?php 
echo  __( 'Optimize all your image title attributes for UX & search engines performance', 'better-robots-txt' ) ;
?></span>

    <div class="rt-bigta" <?php if (isset($options['rt-bigta']) && !empty($options['rt-bigta'])) { echo 'style="display: inline;"'; } else { echo 'style="display: none;"';} ?>>

        <div class="rt-alert rt-success" style="margin-top: 10px;"><?php echo sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">BIGTA</a> Wordpress plugin & auto-optimize all your image title attributes for FREE', 'better-robots-txt' ), array( 
                'a' => array( 
                    'href' => array(), 
                    'target' => array(), 
                ), 
                'a' => array( 
                    'href' => array(), 
                    'target' => array(), 
                ),
            ) ), esc_url( "https://wordpress.org/plugins/bulk-image-title-attribute/" ), esc_url( "https://wordpress.org/plugins/bulk-image-title-attribute/" ) ); ?>
        </div>
    </div>
</div>

</div>

<div class="rt-row">

<div class="rt-column col-3">
    <span class="rt-label"><?php 
echo  __( 'Looking for FREE unlimited content for SEO?', 'better-robots-txt' ) ;
?></span>
</div>

<div class="rt-column col-8">

<label class="rt-switch rt-vidseo-label">
    <input type="checkbox" id="rt-vidseo" name="rt-vidseo" value="boost" <?php if ( $options['rt-vidseo'] ) { echo  'checked="checked"'; } ?> />
    <span class="rt-slider rt-round"></span>
</label>

&nbsp; <span><?php 
echo  __( 'Get access to billions of non-indexed content with Video transcripts (Youtube)', 'better-robots-txt' );
?></span>

    <div class="rt-vidseo" <?php if (isset($options['rt-vidseo']) && !empty($options['rt-vidseo'])) { echo 'style="display: inline;"'; } else { echo 'style="display: none;"';} ?>>

        <div class="rt-alert rt-success" style="margin-top: 10px;"><?php echo sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to learn more about <a href="%2s" target="_blank">VidSEO</a> Wordpress plugin & how to skyrocket your SEO', 'better-robots-txt' ), array( 
                'a' => array( 
                    'href' => array(), 
                    'target' => array(), 
                ), 
                'a' => array( 
                    'href' => array(), 
                    'target' => array(), 
                ),
            ) ), esc_url( "https://wordpress.org/plugins/vidseo/" ), esc_url( "https://wordpress.org/plugins/vidseo/" ) ); ?>
        </div>
    </div>
</div>

</div>

<hr>