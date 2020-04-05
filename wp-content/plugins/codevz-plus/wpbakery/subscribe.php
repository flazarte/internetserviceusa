<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Subscribe
 * 
 * @author Codevz
 * @link http://codevz.com/
 */

class Codevz_WPBakery_subscribe {

	public function __construct( $name ) {
		$this->name = $name;
	}

	/**
	 * Shortcode settings
	 */
	public function in() {
		add_shortcode( $this->name, [ $this, 'out' ] );

		vc_map( array(
			'category'		=> Codevz_Plus::$title,
			'base'			=> $this->name,
			'name'			=> esc_html__( 'Subscribe', 'codevz' ),
			'description'	=> esc_html__( 'Custom newsletter form', 'codevz' ),
			'icon'			=> 'czi',
			'params'		=> array(
				array(
					'type' 			=> 'cz_sc_id',
					'param_name' 	=> 'id',
					'save_always' 	=> true
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Form style', 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'param_name'	=> 'style',
					'value'		=> array(
						'Square'	=> '',
						'Round'		=> 'cz_subscribe_round',
						'Round 2'	=> 'cz_subscribe_round_2',
						'Square, Button next line'	=> 'cz_subscribe_relative ',
						'Round, Button next line'	=> 'cz_subscribe_relative cz_subscribe_round',
					),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Position', 'codevz'),
					'description'	=> esc_html__('According to form width', 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'param_name'	=> 'position',
					'value'		=> array(
						'Default'	=> '',
						'Center'	=> 'center',
						'Right'		=> 'right',
					),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Button Position', 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'param_name'	=> 'btn_position',
					'value'		=> array(
						'Default'	=> '',
						'Center'	=> 'cz_subscribe_btn_center',
						'Right'		=> 'cz_subscribe_btn_right',
					),
					'dependency'	=> array(
						'element' 		=> 'style',
						'value'			=> array( 'cz_subscribe_relative ', 'cz_subscribe_relative cz_subscribe_round' )
					),
				),
				array(
					"type"        	=> "textfield",
					"heading"     	=> esc_html__("Action URL", 'codevz'),
					'description'	=> esc_html__('Mailchimp action or Google feedburner url', 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'value' 		=> '#',
					"param_name"  	=> "action"
				),
				array(
					"type"        	=> "textfield",
					"heading"     	=> esc_html__("Form placeholder", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'value' 		=> 'Enter your email ...',
					"param_name"  	=> "placeholder"
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Input type', 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'param_name'	=> 'type_attr',
					'value'		=> array(
						'Email'		=> 'email',
						'Text'		=> 'text',
						'Number'	=> 'number',
						'Search'	=> 'search',
						'Tel'		=> 'tel',
						'Time'		=> 'time',
						'Date'		=> 'date',
						'URL'		=> 'url',
						'Password'	=> 'password',
					),
				),
				array(
					"type"        	=> "textfield",
					"heading"     	=> esc_html__("Input name attribute", 'codevz'),
					'description'	=> esc_html__('This is useful for mailchip, You can get your form input name from mailchip', 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'value' 		=> 'email',
					"param_name"  	=> "name_attr"
				),
				array(
					"type"        	=> "textfield",
					"heading"     	=> esc_html__("Button title", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'value' 		=> 'Join Now',
					"param_name"  	=> "btn_title"
				),
				array(
					"type"        	=> "cz_icon",
					"heading"     	=> esc_html__("Button icon", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					"param_name"  	=> "icon"
				),

				array(
					'type' 			=> 'cz_title',
					'param_name' 	=> 'cz_title',
					'class' 		=> '',
					'content' 		=> esc_html__( 'Styling', 'codevz' ),
				),
				array(
					'type' 			=> 'cz_sk',
					'param_name' 	=> 'sk_overall',
					"heading"     	=> esc_html__( "Container", 'codevz'),
					'button' 		=> esc_html__( "Container", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'settings' 		=> array( 'width', 'background', 'padding', 'border' )
				),
				array( 'type' => 'cz_hidden','param_name' => 'sk_overall_tablet' ),
				array( 'type' => 'cz_hidden','param_name' => 'sk_overall_mobile' ),
				array(
					'type' 			=> 'cz_sk',
					'param_name' 	=> 'sk_input',
					"heading"     	=> esc_html__( "Input", 'codevz'),
					'button' 		=> esc_html__( "Input", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'settings' 		=> array( 'color', 'text-align', 'font-size', 'background', 'border' )
				),
				array( 'type' => 'cz_hidden','param_name' => 'sk_input_tablet' ),
				array( 'type' => 'cz_hidden','param_name' => 'sk_input_mobile' ),

				array(
					'type' 			=> 'cz_sk',
					'param_name' 	=> 'sk_button',
					'hover_id'	 	=> 'sk_button_hover',
					"heading"     	=> esc_html__( "Button", 'codevz'),
					'button' 		=> esc_html__( "Button", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'settings' 		=> array( 'color', 'font-size', 'background' )
				),
				array( 'type' => 'cz_hidden','param_name' => 'sk_button_tablet' ),
				array( 'type' => 'cz_hidden','param_name' => 'sk_button_mobile' ),
				array( 'type' => 'cz_hidden','param_name' => 'sk_button_hover' ),

				array(
					'type' 			=> 'cz_sk',
					'param_name' 	=> 'sk_icon',
					"heading"     	=> esc_html__( "Icon", 'codevz'),
					'button' 		=> esc_html__( "Icon", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99',
					'settings' 		=> array( 'color', 'font-size', 'background' ),
					'dependency'	=> array(
						'element'		=> 'icon',
						'not_empty'		=> true
					),
				),
				array( 'type' => 'cz_hidden','param_name' => 'sk_icon_mobile' ),

				// Advanced
				array(
					'type' 			=> 'checkbox',
					'heading' 		=> esc_html__( 'Hide on Desktop?', 'codevz' ),
					'param_name' 	=> 'hide_on_d',
					'edit_field_class' => 'vc_col-xs-4',
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				), 
				array(
					'type' 			=> 'checkbox',
					'heading' 		=> esc_html__( 'Hide on Tablet?', 'codevz' ),
					'param_name' 	=> 'hide_on_t',
					'edit_field_class' => 'vc_col-xs-4',
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				), 
				array(
					'type' 			=> 'checkbox',
					'heading' 		=> esc_html__( 'Hide on Mobile?', 'codevz' ),
					'param_name' 	=> 'hide_on_m',
					'edit_field_class' => 'vc_col-xs-4',
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				),
				array(
					'type' 			=> 'cz_title',
					'param_name' 	=> 'cz_title',
					'class' 		=> '',
					'content' 		=> esc_html__( 'Parallax', 'codevz' ),
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				),
				array(
					"type"        	=> "dropdown",
					"heading"     	=> esc_html__( "Parallax", 'codevz' ),
					"param_name"  	=> "parallax_h",
					'edit_field_class' => 'vc_col-xs-99',
					'value'		=> array(
						esc_html__( 'Select', 'codevz' )					=> '',
						
						esc_html__( 'Vertical', 'codevz' )					=> 'v',
						esc_html__( 'Vertical + Mouse parallax', 'codevz' )		=> 'vmouse',
						esc_html__( 'Horizontal', 'codevz' )				=> 'true',
						esc_html__( 'Horizontal + Mouse parallax', 'codevz' )	=> 'truemouse',
						esc_html__( 'Mouse parallax', 'codevz' )				=> 'mouse',
					),
					"group"  		=> esc_html__( 'Advanced', 'codevz' )
				),
				array(
					"type"        	=> "cz_slider",
					"heading"     	=> esc_html__( "Parallax speed", 'codevz' ),
					"description"   => esc_html__( "Parallax is according to page scrolling", 'codevz' ),
					'edit_field_class' => 'vc_col-xs-99',
					"param_name"  	=> "parallax",
					"value"  		=> "0",
					'options' 		=> array( 'unit' => '', 'step' => 1, 'min' => -50, 'max' => 50 ),
					'dependency'	=> array(
						'element'		=> 'parallax_h',
						'value'			=> array( 'v', 'vmouse', 'true', 'truemouse' )
					),
					"group"  		=> esc_html__( 'Advanced', 'codevz' )
				),
				array(
					'type' 			=> 'checkbox',
					'heading' 		=> esc_html__( 'Stop when done', 'codevz' ),
					'param_name' 	=> 'parallax_stop',
					'edit_field_class' => 'vc_col-xs-99',
					'dependency'	=> array(
						'element'		=> 'parallax_h',
						'value'			=> array( 'v', 'vmouse', 'true', 'truemouse' )
					),
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				), 
				array(
					"type"        	=> "cz_slider",
					"heading"     	=> esc_html__("Mouse speed", 'codevz'),
					"description"   => esc_html__( "Mouse parallax is according to mouse move", 'codevz' ),
					'edit_field_class' => 'vc_col-xs-99',
					"param_name"  	=> "mparallax",
					"value"  		=> "0",
					'options' 		=> array( 'unit' => '', 'step' => 1, 'min' => -30, 'max' => 30 ),
					'dependency'	=> array(
						'element'		=> 'parallax_h',
						'value'			=> array( 'vmouse', 'truemouse', 'mouse' )
					),
					"group"  		=> esc_html__( 'Advanced', 'codevz' )
				),
				array(
					'type' 			=> 'cz_title',
					'param_name' 	=> 'cz_title',
					'class' 		=> '',
					'content' 		=> esc_html__( 'Animation & Class', 'codevz' ),
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				),
				vc_map_add_css_animation( false ),
				array(
					'type' 			=> 'cz_sk',
					'param_name' 	=> 'sk_brfx',
					"heading"     	=> esc_html__( "Block Reveal", 'codevz'),
					'button' 		=> esc_html__( "Block Reveal", 'codevz'),
					'edit_field_class' => 'vc_col-xs-99 hidden',
					'group' 	=> esc_html__( 'Advanced', 'codevz' ),
					'settings' 		=> array( 'background' )
				),
				array(
					"type"        	=> "cz_slider",
					"heading"     	=> esc_html__("Animation Delay", 'codevz'),
					"description" 	=> 'e.g. 500ms',
					"param_name"  	=> "anim_delay",
					'options' 		=> array( 'unit' => 'ms', 'step' => 100, 'min' => 0, 'max' => 5000 ),
					'edit_field_class' => 'vc_col-xs-6',
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				),
				array(
					"type"        	=> "textfield",
					"heading"     	=> esc_html__( "Extra Class", 'codevz' ),
					"param_name"  	=> "class",
					'edit_field_class' => 'vc_col-xs-6',
					'group' 		=> esc_html__( 'Advanced', 'codevz' )
				),
				
			)

		));
	}

	/**
	 *
	 * Shortcode output
	 * 
	 * @return string
	 * 
	 */
	public function out( $atts, $content = '' ) {
		$atts = vc_map_get_attributes( $this->name, $atts );

		// ID
		if ( ! $atts['id'] ) {
			$atts['id'] = Codevz_Plus::uniqid();
			$public = 1;
		}

		// Styles
		if ( isset( $public ) || Codevz_Plus::$vc_editable || Codevz_Plus::$is_admin ) {
			$css_id = '#' . $atts['id'];
			$custom = $atts['anim_delay'] ? 'animation-delay:' . $atts['anim_delay'] . ';' : '';

			$css_array = array(
				'sk_overall' 		=> array( $css_id, $custom ),
				'sk_brfx' 			=> $css_id . ':before',
				'sk_input' 			=> $css_id . ' input',
				'sk_button' 		=> $css_id . ' button',
				'sk_button_hover' 	=> $css_id . ' button:hover',
				'sk_icon' 			=> $css_id . ' button i',
			);

			$css 	= Codevz_Plus::sk_style( $atts, $css_array );
			$css_t 	= Codevz_Plus::sk_style( $atts, $css_array, '_tablet' );
			$css_m 	= Codevz_Plus::sk_style( $atts, $css_array, '_mobile' );
		} else {
			Codevz_Plus::load_font( $atts['sk_input'] );
			Codevz_Plus::load_font( $atts['sk_button'] );
		}

		// Button
		$btn_title = $atts['icon'] ? '<i class="' . $atts['icon'] . ( $atts['btn_title'] ? ' mr8' : '' ) . '"></i>' . $atts['btn_title'] : $atts['btn_title'];

		// Classes
		$classes = array();
		$classes[] = $atts['id'];
		$classes[] = 'cz_subscribe_elm clr';
		$classes[] = $atts['style'];
		$classes[] = $atts['btn_position'];
		$classes[] = ( $atts['position'] === 'center' ) ? 'cz_subscribe_elm_center' : ( ( $atts['position'] === 'right' ) ? 'cz_subscribe_elm_center' : '' );

		// Out
		$out = '<form id="' . $atts['id'] . '" action="' . $atts['action'] . '" method="post" name="mc-embedded-subscribe-form" target="_blank"' . Codevz_Plus::classes( $atts, $classes ) . Codevz_Plus::data_stlye( $css, $css_t, $css_m ) . '><input type="' . $atts['type_attr'] . '" name="' . $atts['name_attr'] . '" placeholder="' . $atts['placeholder'] . '" required="required"><button name="subscribe" type="submit">' . $btn_title . '</button></form><div class="clr"></div>';

		return Codevz_Plus::_out( $atts, $out );
	}

}