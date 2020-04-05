<?php

global  $agents ;
?>

<h3><?php 
echo  __( 'STEP', 'better-robots-txt' ) . " 1 - " . __( 'IDENTIFY WHICH SEARCH ENGINES SHOULD CRAWL (OR NOT) YOUR WEBSITE:', 'better-robots-txt' ) ;
?></h3>   
        
<?php 
// loop to display allow/disallow/disable on admin settings page
$last = count( $agents ) - 1;
foreach ( $agents as $i => $row ) {
    $isFirst = $i == 0;
    $isLast = $i == $last;
    ?>

<div class="rt-row">

	<div class="rt-column col-3">
		<?php 
    echo  "<span class='rt-label'>" . $row['name'] . "</span>" ;
    ?>
	</div>

	<div class="rt-column col-8">
		
		<div class="rt-switch-radio">

			<input type="radio" id="<?php 
    echo  $row['bot'] ;
    ?>-btn1" name="<?php 
    echo  $row['bot'] ;
    ?>" value="allow" <?php 
    if ( isset( $options[$row["bot"]] ) && !empty($options[$row["bot"]]) ) {
        checked( 'allow' == $options[$row["bot"]] );
    }
    ?> />

			<label for="<?php 
    echo  $row['bot'] ;
    ?>-btn1"><?php 
    echo  __( 'Allow', 'better-robots-txt' ) ;
    ?></label>
			
			<input type="radio" id="<?php 
    echo  $row['bot'] ;
    ?>-btn2" name="<?php 
    echo  $row['bot'] ;
    ?>" value="disallow" <?php 
    if ( isset( $options[$row["bot"]] ) && !empty($options[$row["bot"]]) ) {
        checked( 'disallow' == $options[$row["bot"]] );
    }
    ?> />

			<label for="<?php 
    echo  $row['bot'] ;
    ?>-btn2"><?php 
    echo  __( 'Disallow', 'better-robots-txt' ) ;
    ?></label>
			
			<input type="radio" id="<?php 
    echo  $row['bot'] ;
    ?>-btn3" name="<?php 
    echo  $row['bot'] ;
    ?>" value="disable" <?php 
    if ( empty($options[$row["bot"]]) || $options[$row["bot"]] == "disable" ) {
        echo  'checked="checked"' ;
    }
    ?> />

			<label for="<?php 
    echo  $row['bot'] ;
    ?>-btn3"><?php 
    echo  __( 'Disable', 'better-robots-txt' ) ;
    ?></label>

			<div class="rt-tooltip">

				<span class="dashicons dashicons-editor-help"></span>

				<span class="rt-tooltiptext"><?php 
    printf(
        __( 'Allows %1$s %2$s to index => %3$s', 'better-robots-txt' ),
        $row['name'],
        $row['define'],
        $row['path']
    );
    ?></span>

			</div>

		</div>
		
	</div>

</div>

<?php 
}
//end allow/disallow/disable loop
?>

<div class="rt-row">

    <div class="rt-column col-3">
        <span class="rt-label"><?php 
echo  __( 'Baidu/Sogou/Soso/Youdao - Chinese search engines', 'better-robots-txt' ) ;
?></span>
    </div>

    <div class="rt-column col-8">

        <?php 
// free only
?>
            
            <div class="rt-switch-radio dual-btns">
                <input type="radio" id="chinese_bot-btn1" name="chinese_bot" value="" disabled />
                <label for="chinese_bot-btn1"><?php 
echo  __( 'Allow', 'better-robots-txt' ) ;
?></label>

				<input type="radio" id="chinese_bot-btn2" name="chinese_bot" value="" disabled />
                <label for="chinese_bot-btn2"><?php 
echo  __( 'Disallow', 'better-robots-txt' ) ;
?></label>

                <input type="radio" id="chinese_bot-btn3" name="chinese_bot" value="" checked="checked" />
                <label for="chinese_bot-btn3"><?php 
echo  __( 'Disable', 'better-robots-txt' ) ;
?></label>

                <div class="rt-tooltip">
                    <span class="dashicons dashicons-editor-help"></span>
                    <span class="rt-tooltiptext"><?php 
echo  __( 'Baidu, Soso, Youdao, Sogou search engines', 'better-robots-txt' ) ;
?></span>
                </div>
            </div>
			<br />
			<div class="rt-alert rt-info">
				<span class="closebtn">&times;</span> 
				<?php 
echo  $get_pro . " " . __( 'Popular Chinese search engines feature', 'better-robots-txt' ) ;
?>
			</div>
        
        <?php 
// end free only
?>
        
    </div>

</div>

<hr>