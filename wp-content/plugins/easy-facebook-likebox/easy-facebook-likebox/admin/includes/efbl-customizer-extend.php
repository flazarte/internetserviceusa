<?php
/*
* Stop execution if someone tried to get file directly.
*/ 
if ( ! defined( 'ABSPATH' ) ) exit;



								//======================================================================

													// Custom Switches

								//======================================================================

//Input field
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WP_Customize_Switch_Control' ) ) :
class WP_Customize_Switch_Control extends WP_Customize_Control
{

    public $type = 'custom_switch';
    
    public function render_content()
    {
        ?>
             <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <div class="switch">
                 <label>
                    <input  type="checkbox" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
                    <span class="lever"></span>
                </label>
            </div>
           
        </label>
        <?php
    }
}
endif;


                                //======================================================================

                                                    // Custom Alpha color control

                                //======================================================================

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Customize_Alpha_Color_Control' ) ):
class Customize_Alpha_Color_Control extends WP_Customize_Control {

    /**
     * Official control name.
     */
    public $type = 'alpha-color';

    /**
     * Add support for palettes to be passed in.
     *
     * Supported palette values are true, false, or an array of RGBa and Hex colors.
     */
    public $palette;

    /**
     * Add support for showing the opacity value on the slider handle.
     */
    public $show_opacity;

    /**
     * Enqueue scripts and styles.
     *
     * Ideally these would get registered and given proper paths before this control object
     * gets initialized, then we could simply enqueue them here, but for completeness as a
     * stand alone class we'll register and enqueue them here.
     */
    public function enqueue() {
        wp_enqueue_script(
            'alpha-color-picker',
            EFBL_PLUGIN_URL . 'admin/assets/js/alpha-color-picker.js',
            array( 'jquery', 'wp-color-picker' ),
            '1.0.0',
            true
        );
        wp_enqueue_style(
            'alpha-color-picker',
             EFBL_PLUGIN_URL . 'assets/css/alpha-color-picker.css',
            array( 'wp-color-picker' ),
            '1.0.0'
        );
    }

    /**
     * Render the control.
     */
    public function render_content() {

        // Process the palette
        if ( is_array( $this->palette ) ) {
            $palette = implode( '|', $this->palette );
        } else {
            // Default to true.
            $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
        }

        // Support passing show_opacity as string or boolean. Default to true.
        $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
         if ( isset( $this->label ) && '' !== $this->label ) {
                echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
            }
        // Output the label and description if they were passed in.
           
            if ( isset( $this->description ) && '' !== $this->description ) {
                echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
            }    
        // Begin the output. ?>
        <label>
           
            <input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
        </label>
        <?php
    }
}
endif;


                                //======================================================================

                                                    // FTA  PopUP

                                //======================================================================

//Input field
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Customize_EFBL_PopUp' ) ) :
class Customize_EFBL_PopUp extends WP_Customize_Control
{

    public $type = 'popup';

    public $popup_id = null;

    public $icon = null;

    
    public function render_content()
    { 
        ?>
        <label class="customize-control-title">   <?php echo $this->label; ?></label>
        <p><?php echo $this->description; ?></p>

        <p><?php echo __('Upgrade today and get a 10% discount with coupon code <code>espf10</code>', 'easy-facebook-likebox') ?> </p>
        <a href="<?php echo efl_fs()->get_upgrade_url() ?>" class="fta-upgrade-btn"><?php echo __('Upgrade to pro', 'easy-facebook-likebox') ?></a>
    

        <?php
    }
}
endif;