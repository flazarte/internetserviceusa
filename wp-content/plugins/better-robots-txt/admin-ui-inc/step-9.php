<h3><?php 
echo  __( 'STEP', 'better-robots-txt' ) . " 9 - " . __( 'IDENTIFY WHICH SOCIAL MEDIA SHOULD CRAWL (OR NOT) YOUR CONTENT:', 'better-robots-txt' ) ;
?></h3>
            
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Facebook, Instagram, Whatsapp', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">

        <?php 
// free only
?>
            
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="facebook_bot-btn1" name="facebook_bot" value="" disabled />
                <label for="facebook_bot-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

				<input type="radio" id="facebook_bot-btn2" name="facebook_bot" value="" disabled />
                <label for="facebook_bot-btn2"><?php 
echo  __( 'Disallow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="facebook_bot-btn3" name="facebook_bot" value="" checked="checked" />
                <label for="facebook_bot-btn3"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Allow/Disallow FACEBOOK/INSTAGRAM/WHATSAPP Social Media Crawling', 'better-robots-txt' ) ;
?></span>
                </div>
            </div>
        
        <?php 
// end free only
?>
        
    </div>

</div>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Twitter', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">

        <?php 
// free only
?>
            
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="twitter_bot-btn1" name="twitter_bot" value="" disabled />
                <label for="twitter_bot-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

				<input type="radio" id="twitter_bot-btn2" name="twitter_bot" value="" disabled />
                <label for="twitter_bot-btn2"><?php 
echo  __( 'Disallow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="twitter_bot-btn3" name="twitter_bot" value="" checked="checked" />
                <label for="twitter_bot-btn3"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Allow/Disallow Twitter Social Media Crawling', 'better-robots-txt' ) ;
?></span>
                </div>
            </div>
        
        <?php 
// end free only
?>
        
    </div>

</div>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Linkedin', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">

        <?php 
// free only
?>
            
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="linkedin_bot-btn1" name="linkedin_bot" value="" disabled />
                <label for="linkedin_bot-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

				<input type="radio" id="linkedin_bot-btn2" name="linkedin_bot" value="" disabled />
                <label for="linkedin_bot-btn2"><?php 
echo  __( 'Disallow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="linkedin_bot-btn3" name="linkedin_bot" value="" checked="checked" />
                <label for="linkedin_bot-btn3"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Allow/Disallow Linkedin Social Media Crawling', 'better-robots-txt' ) ;
?></span>
                </div>
            </div>
        
        <?php 
// end free only
?>
        
    </div>

</div>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Pinterest', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">

        <?php 
// free only
?>
            
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="pinterest_bot-btn1" name="pinterest_bot" value="" disabled />
                <label for="pinterest_bot-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

				<input type="radio" id="pinterest_bot-btn2" name="pinterest_bot" value="" disabled />
                <label for="pinterest_bot-btn2"><?php 
echo  __( 'Disallow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="pinterest_bot-btn3" name="pinterest_bot" value="" checked="checked" />
                <label for="pinterest_bot-btn3"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Allow/Disallow Pinterest Social Media Crawling', 'better-robots-txt' ) ;
?></span>
                </div>
            </div>
        
        <?php 
// end free only
?>
        
    </div>

</div>     

<?php 
// pro only
?>
	<div class="rt-alert rt-info">
		<span class="closebtn">&times;</span> 
		<?php 
echo  $get_pro . " " . __( 'Social Media Crawl Feature', 'better-robots-txt' ) ;
?>
	</div>
<?php 
?>

<hr>