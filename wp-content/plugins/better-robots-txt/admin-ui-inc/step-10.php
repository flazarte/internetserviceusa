<h3><?php echo __( 'STEP', 'better-robots-txt' ) . " 10 - " . __( 'APP-ADS.TXT & ADS.TXT CRAWLABILITY (authorized sellers for ad revenue)', 'better-robots-txt' ); ?></h3>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php echo __( 'Allow Ads.txt', 'better-robots-txt' ); ?></span>
    </div>

    <div class="rt-column col-8">

        <div class="rt-switch-radio dual-btns">

            <input type="radio" id="ads-txt-btn1" name="ads-txt" value="allow" <?php if(isset($options['ads-txt']) && !empty($options['ads-txt'])) checked( 'allow' == $options['ads-txt'] ); ?> />
            <label for="ads-txt-btn1"><?php echo __( 'Allow', 'better-robots-txt' ); ?></label>

            <input type="radio" id="ads-txt-btn2" name="ads-txt" value="disallow" <?php if(isset($options['ads-txt']) && !empty($options['ads-txt'])) checked( 'disallow' == $options['ads-txt'] ); ?> />
            <label for="ads-txt-btn2"><?php echo __( 'Disallow', 'better-robots-txt' ); ?></label>

            <input type="radio" id="ads-txt-btn3" name="ads-txt" value="disable" <?php if ( empty($options['ads-txt']) || ($options['ads-txt'] == "disable") ) echo 'checked="checked"'; ?> />
            <label for="ads-txt-btn3"><?php echo __( 'Disable', 'better-robots-txt' ); ?></label>

            <div class="rt-tooltip">
                <span class="dashicons dashicons-editor-help"></span>
                <span class="rt-tooltiptext"><?php echo __( 'Authorized Digital Sellers for Web, or ads.txt, is an IAB initiative to improve transparency in programmatic advertising. You can create your own ads.txt files to identify who is authorized to sell your inventory. The files are publicly available and crawlable by exchanges, Supply-Side Platforms (SSP), and other buyers and third-party vendors.', 'better-robots-txt' ); ?></span>
            </div>

        </div>

    </div>

</div>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php echo __( 'Allow App-ads.txt', 'better-robots-txt' ); ?></span>
    </div>

    <div class="rt-column col-8">
        
        <div class="rt-switch-radio dual-btns">

            <input type="radio" id="app-ads-txt-btn1" name="app-ads-txt" value="allow" <?php if(isset($options['app-ads-txt']) && !empty($options['app-ads-txt'])) checked( 'allow' == $options['app-ads-txt'] ); ?> />
            <label for="app-ads-txt-btn1"><?php echo __( 'Allow', 'better-robots-txt' ); ?></label>

            <input type="radio" id="app-ads-txt-btn2" name="app-ads-txt" value="disallow" <?php if(isset($options['app-ads-txt']) && !empty($options['app-ads-txt'])) checked( 'disallow' == $options['app-ads-txt'] ); ?> />
            <label for="app-ads-txt-btn2"><?php echo __( 'Disallow', 'better-robots-txt' ); ?></label>

            <input type="radio" id="app-ads-txt-btn3" name="app-ads-txt" value="disable" <?php if ( empty($options['app-ads-txt']) || ($options['app-ads-txt'] == "disable") ) echo 'checked="checked"'; ?> />
            <label for="app-ads-txt-btn3"><?php echo __( 'Disable', 'better-robots-txt' ); ?></label>

            <div class="rt-tooltip">
                <span class="dashicons dashicons-editor-help"></span>
                <span class="rt-tooltiptext"><?php echo __( 'Authorized Sellers for Apps, or app-ads.txt, is an extension to the Authorized Digital Sellers standard. It expands compatibility to support ads shown in mobile apps.', 'better-robots-txt' ); ?></span>
            </div>

        </div>

    </div>

</div>

<div class="rt-alert rt-success" style="margin-top: 10px;">
    <?php echo sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">App-ads.txt & Ads.txt Manager</a> to capture more more ad revenue.', 'better-robots-txt' ), array( 
        'a' => array( 
            'href' => array(), 
            'target' => array(), 
        ), 
        'a' => array( 
            'href' => array(), 
            'target' => array(), 
        ),
) ), esc_url( "https://wordpress.org/plugins/app-ads-txt" ), esc_url( "https://wordpress.org/plugins/app-ads-txt" ) ); ?>
</div>

<hr>