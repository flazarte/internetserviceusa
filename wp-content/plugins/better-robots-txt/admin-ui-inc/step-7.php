<h3><?php 
echo  __( 'STEP', 'better-robots-txt' ) . " 7 - " . __( 'REQUEST A BACKLINK:', 'better-robots-txt' ) ;
?></h3>
    
<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Request a backlink from BT partners', 'better-robots-txt' ) ;
?></span>
    </div>
    
    <div class="rt-column col-8">

        <?php 
// free only
?>

        <label class="rt-switch rt-backlinks-label">
            <input type="checkbox" id="ask-backlinks" name="ask-backlinks" disabled />
            <span class="rt-slider rt-round"></span>
        </label>

            &nbsp; <span><?php 
echo  __( 'Backlinks are part of your online success. Let us help you!', 'better-robots-txt' ) ;
?></span>

        <br /><br />
        <div class="rt-alert rt-info">
            <span class="closebtn">&times;</span> 
            <?php 
echo  $get_pro . " " . __( 'Request my backlinks', 'better-robots-txt' ) ;
?>
        </div>   
        
        <?php 
// end free only
?>


    </div>
    
</div>
<hr>