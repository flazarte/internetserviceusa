<h3><?php 
echo  __( 'STEP', 'better-robots-txt' ) . " 2 - " . __( 'PROTECT YOUR DATA:', 'better-robots-txt' ) ;
?></h3>
            
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Spam Backlink Blocker', 'better-robots-txt' ) ;
?></span>
    </div>
        
    <div class="rt-switch-radio dual-btns">
        <input type="radio" id="feed_protector-btn1" name="feed_protector" value="allow" <?php 
if ( isset( $options['feed_protector'] ) && !empty($options['feed_protector']) ) {
    checked( 'allow' == $options['feed_protector'] );
}
?> />
        <label for="feed_protector-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

        <input type="radio" id="feed_protector-btn2" name="feed_protector" value="disable" <?php 
if ( empty($options['feed_protector']) || $options['feed_protector'] == "disable" ) {
    echo  'checked="checked"' ;
}
?> />
        <label for="feed_protector-btn2"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

        <div class="rt-tooltip">
            <span class="dashicons dashicons-editor-help"></span>
            <span class="rt-tooltiptext"><?php 
echo  __( 'Avoid spammer robots from generating unwilling backlinks with your website', 'better-robots-txt' ) ;
?></span>
        </div>
    </div>

</div>
        
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Bad bot blocker', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">

        <?php 
// free only
?>
            
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="bad_bots-btn1" name="bad_bots" value="" disabled />
                <label for="bad_bots-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="bad_bots-btn2" name="bad_bots" value="" checked="checked" />
                <label for="bad_bots-btn2"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Activate to block top malicious web scrapers (bad bots). This is a pro version feature', 'better-robots-txt' ) ;
?></span>
                </div>
                <div class="rt-tooltip-after"><img src="<?php 
echo  plugin_dir_url( __FILE__ ) ;
?>../assets/imgs/star1.png" style="width: 490px; height: auto;" alt="" /></div>
            </div>
            <br /><br />
            <div class="rt-alert rt-info">
                <span class="closebtn">&times;</span> 
                <?php 
echo  $get_pro . " " . __( 'bad bot blocker', 'better-robots-txt' ) ;
?>
            </div>
        
        <?php 
// end free only
?>
        
    </div>

</div>  
    
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Backlink Protector', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">
        
        <?php 
// free only
?>
        
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="backlinks_pro-btn1" name="backlinks_pro" value="" disabled />
                <label for="backlinks_pro-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="backlinks_pro-btn2" name="backlinks_pro" value="" checked="checked" />
                <label for="backlinks_pro-btn2"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Hide your backlinks from your competitors. This is a pro version feature', 'better-robots-txt' ) ;
?></span>
                </div>
                <div class="rt-tooltip-after">(recommended by our users)</div>
            </div>
            <br />
            <div class="rt-alert rt-info">
                <span class="closebtn">&times;</span> 
                <?php 
echo  $get_pro . " " . __( 'backlink protector', 'better-robots-txt' ) ;
?>
            </div>
        
        <?php 
// end free only
?>
        
    </div>

</div>

<hr>