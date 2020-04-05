<div class="rt-row">
		
    <div class="rt-column col-3">
        <span class="rt-label"><?php echo __( 'Delete Settings', 'better-robots-txt' ); ?></span>
    </div>
    
    <div class="rt-column col-8">
        <label class="rt-switch">
            <input type="checkbox" id="remove_settings" name="remove_settings" value="remove_settings" <?php if ( isset($options['remove_settings'] ) && !empty( $options['remove_settings'] ) ) { echo  'checked="checked"'; } ?> />
            <span class="rt-slider rt-round"></span>
        </label>
        &nbsp; <span><?php echo __( 'Checking this box will remove all settings when you deactivate Better Robots.txt plugin.', 'better-robots-txt' ); ?></span>
    </div>
    
</div>