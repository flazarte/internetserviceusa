<?php 

	// Footer
	if ( is_404() ) {
		$footer = get_page_by_title( Codevz_Theme::option( '404' ) );
		$footer = isset( $footer->ID ) ? !Codevz_Theme::meta( $footer->ID, 0, 'hide_footer' ) : 1;
	} else if ( is_single() || is_page() ) {
		$footer = !Codevz_Theme::meta( 0, 0, 'hide_footer' );
	} else {
		$footer = 1;
	}

	// Footer content
	if ( $footer ) {
		echo '<footer class="page_footer' . esc_attr( Codevz_Theme::option( 'fixed_footer' ) ? ' cz_fixed_footer' : '' ) . '">';

		// Row before footer
		Codevz_Theme::row([
			'id'		=> 'footer_',
			'nums'		=> [ '1' ],
			'row'		=> 1,
			'left'		=> '_left',
			'right'		=> '_right',
			'center'	=> '_center'
		]);

		// Footer widgets
		$footer_layout = Codevz_Theme::option( 'footer_layout' );
		if ( $footer_layout ) {
			$layout = explode( ',', $footer_layout );
			$count = count( $layout );
			$is_widget = 0;
			foreach ( $layout as $num => $col ) {
				$num++;
				if ( is_active_sidebar( 'footer-' . $num ) ) {
					$is_widget = 1;
				}
			}
			foreach ( $layout as $num => $col ) {
				$num++;
				if ( $is_widget && $num === 1 ) {
					echo '<div class="cz_middle_footer"><div class="row clr">';
				}
				if ( is_active_sidebar( 'footer-' . $num ) ) {
					echo '<div class="col ' . esc_attr( $col ) . ' sidebar_footer-' . esc_attr( $num ) . ' clr">';
					dynamic_sidebar( 'footer-' . $num );  
					echo '</div>';
				} else {
					echo '<div class="col ' . esc_attr( $col ) . ' sidebar_footer-' . esc_attr( $num ) . ' clr">&nbsp;</div>';
				}
				if ( $is_widget && $num === $count ) {
					echo '</div></div>';
				}
			}
		}

		// Row after footer
		Codevz_Theme::row([
			'id'		=> 'footer_',
			'nums'		=> [ '2' ],
			'row'		=> 1,
			'left'		=> '_left',
			'right'		=> '_right',
			'center'	=> '_center'
		]);

		echo '</footer>';
	}

	echo '</div></div>'; // layout

	// Back to top
	echo Codevz_Theme::option( 'backtotop' ) ? '<i class="' . esc_attr( Codevz_Theme::option( 'backtotop' ) ) . ' backtotop"></i>' : '';
	
	// Quick contact
	$cf7 = Codevz_Theme::option( 'cf7_beside_backtotop' );
	if ( $cf7 ) {
		$cf7 = Codevz_Theme::get_page_as_element( esc_html( $cf7 ) );
		if ( $cf7 ) {
			echo '<i class="' . esc_attr( Codevz_Theme::option( 'cf7_beside_backtotop_icon', 'fa fa-envelope-o' ) ) . ' fixed_contact"></i>';
			echo '<div class="fixed_contact">' . $cf7 . '</div>';
		}
	}

	// Popup
	$popup = Codevz_Theme::get_page_as_element( esc_html( Codevz_Theme::option( 'popup' ) ) );
	if ( $popup ) {
		echo '<div class="cz-pages-popup hidden">' . $popup . '</div>';
	}

	// Ajax music player
	if ( Codevz_Theme::option( 'ajax' ) && Codevz_Theme::option( 'ajax_mp' ) ) {
		$ajax_tracks = urlencode( json_encode( Codevz_Theme::option( 'ajax_mp_tracks', [] ) ) );
		echo do_shortcode( '[cz_music_player id="cz_ajax_mp" fixed="true" dark_text="' . Codevz_Theme::option( 'ajax_mp_dark_text' ) . '" flat="' . Codevz_Theme::option( 'ajax_mp_flat' ) . '" autoplay="' . Codevz_Theme::option( 'ajax_mp_autoplay' ) . '" tracks="' . $ajax_tracks . '"]' );
	}
?>
<div class="cz_fixed_top_border"></div>
<div class="cz_fixed_bottom_border"></div>



<?php wp_footer(); ?>
</body>
</html>