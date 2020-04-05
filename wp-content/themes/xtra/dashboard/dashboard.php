<?php if ( ! defined( 'ABSPATH' ) ) {exit;} // Exit if accessed directly.

/**
 * Codevz dashboard activation
 * 
 * @author Codevz
 * @link http://codevz.com/
 */

class Codevz_Dashboard {

	private static $instance = null;
	public static $slug = 'codevz-dashboard';

	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	/**
	 * Trial version deactivation
	 */
	public static function init() {
		$a = get_option( 'codevz_theme_activation' );
		
		if ( ( isset( $a['type'] ) && $a['type'] === 'free' ) || isset( $a['item_id'] ) ) {
			delete_option( 'codevz_theme_activation' );
		}
	}
	
	/**
	 * Get admin menu URL
	 * @return string
	 */
	public static function admin_url( $slug ) {
		return admin_url( $slug );
	}

	/**
	 * Get theme info
	 * @return string
	 */
	public static function theme( $key ) {
		$theme = wp_get_theme();
		return strtoupper( $theme->get( $key ) );
	}
	
	/**
	 * Get Logo & Tabs HTML
	 * @return string
	 */
	public static function tabs( $page ) {
		?>
			<h1 class="cz_hide"></h1>
			<div class="cz_top_info">
				<div class="cz_logo"><img src="<?php echo get_template_directory_uri() ?>/dashboard/assets/logo.png" alt="XTRA Theme"/></div>
				<div class="cz_theme_name">
					<h2> Welcome to <?php esc_html_e( self::theme( 'Name' ) ); ?> WordPress Theme </h2>
					<h3 style="opacity:.5"> Current version <?php esc_html_e( self::theme( 'Version' ) ); ?></h3>
				</div>
			</div>

			<h2 class="nav-tab-wrapper">
				<a href="<?php echo esc_url( self::admin_url( 'admin.php?page=codevz-dashboard' ) ); ?>" class="nav-tab <?php echo ($page =='welcome' ? 'nav-tab-active' : '') ; ?>">
					<?php _e('Welcome', 'codevz'); ?>
				</a>
				<a href="<?php echo esc_url( self::admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="nav-tab">
					<?php _e('Install Plugins', 'codevz'); ?>
				</a>
				
				<?php if ( ! is_array( get_option( 'codevz_theme_activation' ) ) ) { ?>
					<a href="#" class="nav-tab cz_not_act">
					<img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDM3LjMzMywxOTJoLTMydi00Mi42NjdDNDA1LjMzMyw2Ni45OSwzMzguMzQ0LDAsMjU2LDBTMTA2LjY2Nyw2Ni45OSwxMDYuNjY3LDE0OS4zMzNWMTkyaC0zMiAgICBDNjguNzcxLDE5Miw2NCwxOTYuNzcxLDY0LDIwMi42Njd2MjY2LjY2N0M2NCw0OTIuODY1LDgzLjEzNSw1MTIsMTA2LjY2Nyw1MTJoMjk4LjY2N0M0MjguODY1LDUxMiw0NDgsNDkyLjg2NSw0NDgsNDY5LjMzMyAgICBWMjAyLjY2N0M0NDgsMTk2Ljc3MSw0NDMuMjI5LDE5Miw0MzcuMzMzLDE5MnogTTI4Ny45MzgsNDE0LjgyM2MwLjMzMywzLjAxLTAuNjM1LDYuMDMxLTIuNjU2LDguMjkyICAgIGMtMi4wMjEsMi4yNi00LjkxNywzLjU1Mi03Ljk0OCwzLjU1MmgtNDIuNjY3Yy0zLjAzMSwwLTUuOTI3LTEuMjkyLTcuOTQ4LTMuNTUyYy0yLjAyMS0yLjI2LTIuOTktNS4yODEtMi42NTYtOC4yOTJsNi43MjktNjAuNTEgICAgYy0xMC45MjctNy45NDgtMTcuNDU4LTIwLjUyMS0xNy40NTgtMzQuMzEzYzAtMjMuNTMxLDE5LjEzNS00Mi42NjcsNDIuNjY3LTQyLjY2N3M0Mi42NjcsMTkuMTM1LDQyLjY2Nyw0Mi42NjcgICAgYzAsMTMuNzkyLTYuNTMxLDI2LjM2NS0xNy40NTgsMzQuMzEzTDI4Ny45MzgsNDE0LjgyM3ogTTM0MS4zMzMsMTkySDE3MC42Njd2LTQyLjY2N0MxNzAuNjY3LDEwMi4yODEsMjA4Ljk0OCw2NCwyNTYsNjQgICAgczg1LjMzMywzOC4yODEsODUuMzMzLDg1LjMzM1YxOTJ6IiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
					<?php _e('Demo Importer', 'codevz'); ?>
					</a>
				<?php } else { ?>
					<a href="<?php echo esc_url( self::admin_url( 'customize.php?&autofocus[panel]=codevz_theme_options-demos' ) ); ?>" class="nav-tab">
					<?php _e('Demo Importer', 'codevz'); ?>
				</a>
				<?php } ?>
				
				<a href="<?php echo esc_url( self::admin_url( 'customize.php' ) ); ?>" class="nav-tab">
					<?php _e('Theme Options', 'codevz'); ?>
				</a>
				<a href="<?php echo esc_url( self::admin_url( 'admin.php?page=codevz-doc' ) ); ?>" class="nav-tab <?php echo ($page =='doc' ? 'nav-tab-active' : '') ; ?>">
					<?php _e('Documentation & Support', 'codevz'); ?>
				</a>
			</h2>
		<?php
	}

	/**
	 * Get theme styles
	 * @return string
	 */
	public static function styles() {
		?>
		<style>
	@import url('https://fonts.googleapis.com/css?family=Nunito:400,700');
	.wrap *{outline:none;}
	.wrap a{text-decoration: none}
	#message{display: none;}
	.wrap {
		font-family: "Nunito";
		margin: 20px 20px 0 2px;
		background: #f8f8f8;
		float: left;
		width: 98%;
		box-sizing: border-box;
		padding: 0 30px 30px;
		box-shadow: 0 1px 15px rgba(0,0,0,.04),0 1px 6px rgba(0,0,0,.04);
		border-radius: 2px;
	}
	.wrap h2{font-weight: 600}
	.wrap h3 {
	font-size: 16px;
	margin-bottom: 25px;
	}
	.wrap h4 {
	font-size: 14px;
	font-weight: 400;
	}
	.nav-tab-wrapper, .wrap h2.nav-tab-wrapper{
		background: #d8d8d8;
		margin: 0 -30px;
		padding: 15px 20px 0 20px;	
		border: none;
		box-shadow: inset 0 0 14px rgba(0,0,0,.1);
	}
	.nav-tab {
		line-height: 1;
		padding: 16px 16px 20px;
		font-size: 14px;
		color: #282828;
		background: none;
		border-radius: 2px 2px 0 0;
		border: none;
		margin-bottom: -4px
	}
	.nav-tab-active,.nav-tab:hover{
		background: #f8f8f8;
		color:#282828;
	}

	.cz_box{
		float: left;
		background: #fff;
		box-shadow: 0 1px 15px rgba(0,0,0,.04),0 1px 6px rgba(0,0,0,.04);
		width: 100%;
		box-sizing: border-box;
		border-radius: 2px;
		padding: 50px;
		margin-top: 30px;
		min-height: 350px;
	}

	.cz_box2{width:49%;margin-right: 2%;}
	.cz_box4{width:23.5%;margin-right: 2%;min-height: 445px;}

	.cz_box_end{margin-right:0}
	
	.cz_box h2{
		font-size: 24px;
		margin:10px 0 30px;
		border-bottom: solid 1px #ddd;
		padding-bottom: 20px;
		position: relative;
	}
	.cz_box h2::after {
		content: "";
		width: 50px;
		height: 4px;
		background: linear-gradient(135deg,#03e2ab, #093db5);
		position: absolute;
		left: 0;
		bottom: -2px;
	}

	.cz_box{font-size:18px;}

	#setting-error-tgmpa{
		display: none;
		margin: 25px 0 0;
		box-shadow: 0 1px 15px rgba(0,0,0,.04),0 1px 6px rgba(0,0,0,.04);
		border-radius: 3px;
		padding: 15px 45px;

	}

	.cz_button{
		line-height: 30px;
		padding: 4px 20px;
		border: none;
		background: linear-gradient(135deg,#03e2ab, #093db5);
		color: #fff;
		border-radius: 3px;
		font-size: 14px;
		cursor: pointer;
		text-decoration: none;
		text-shadow: 0 0 1px rgba(0,0,0,.4);
		float: left;
		position: relative;
	}
	.cz_button.cz_button2 {background: #aaa;}
	.cz_button:hover,.cz_button.cz_button2:hover{background: linear-gradient(45deg,#03e2ab, #093db5);}
	.cz_button_activation{
		position: absolute;
		right: 10px;
		top: 9px;
		height: 32px;
		line-height: 30px;
		padding: 0 20px;
	}
	.cz_button_a{padding: 9px 20px 9px 45px}
	.cz_button_a img{width: 22px;position: absolute;left: 15px;top: 14px;}
	.cz_button_a:hover{color:#fff;}
	input.cz_code{
		height: 50px;
		line-height: 50px;
		padding: 20px;
		width: 100%;
		border-radius: 3px;
		box-shadow: none;
	}
	input.cz_code::placeholder{color:#aaa;}
	.cz_top_info{
		margin: 0 -30px;
		padding: 25px 30px;
	}
	.cz_logo{
		float: left;
		margin-right: 30px;
		padding: 19px;
		background: #fff;
		box-shadow: 0 1px 15px rgba(0,0,0,.04),0 1px 6px rgba(0,0,0,.04);
		margin-left: -3px;
		border-radius: 2px;
	}
	.cz_logo img{width:50px;}
	.cz_theme_name{}
	.cz_theme_name h2{font-size: 24px;font-weight: 700;margin-bottom: 10px}
	.cz_theme_name h3{font-size: 14px;font-weight: 500;}
	.cz_hide{display: none;}

	.cz_grn{color:#00ca98;font-size: 20px !important;}

	.cz_good, .cz_error{
		color: #fff;
		background: #00ca98;
		padding: 2px 6px 2px;
		font-size: 12px;
		border-radius: 3px;
		margin: 0 10px;
	}
	.cz_error {
		background: rgba(215, 3, 3, 0.7);
	}
	.cz_rd{
	    color: rgba(215, 3, 3, 0.7);
	    background: rgba(215, 3, 3, 0.04);
	    border: 1px solid rgba(215, 3, 3, 0.13);
	    padding: 30px;
	}
	.cz_ul {
		font-size: 16px;
		list-style: circle;
		margin: 20px
	}
	.cz_ul li {
		margin-bottom: 16px
	}

	.cz_faq{
		border: solid 1px #e5e5e5;
		border-radius: 2px;
		margin-bottom: 20px;
		padding: 17px 25px;
		box-shadow: 0 0 10px rgba(0,0,0,.07);
	}
	.cz_q{}
	.cz_q b{cursor: pointer;font-size: 16px;color:#093db5;opacity: .7}
	.cz_q b:hover{opacity:1}
	.cz_a {color: #777;display: none}
	.cz_a p{margin-bottom: 0}

	.cz_ula{font-size: 14px;margin-bottom: 30px;}
	.cz_ula li{margin-bottom: 10px;}
	.cz_ula li a{color: #093db5;text-decoration: none;opacity: .7}
	.cz_ula li a:hover{opacity:1}

	a:focus{box-shadow: none}
	a.cz_button:focus{color:#fff}
	@media only screen and (max-width: 767px) {
		.cz_box,.cz_box2,.cz_box4{width:100%;margin-right: 0;padding: 30px}
		 h2 .nav-tab{width:100%;border-bottom: none;border-radius: 2px;box-sizing: border-box;}
	}
	.cz_85{width: 85%;position: relative;}
	.cz_fl{float: left;}
	.cz_fr{float: right;}

	.cz_not_act{cursor: not-allowed;opacity: .4}
	.cz_not_act img{width: 14px;opacity: .6;}

	.cz_ul_details {
	    font-size: 18px;
	    margin-bottom: 50px;
	}
	.cz_ul_details span {
	    font-size: 16px;
	    opacity: .7;
	    margin: 18px 0 10px;
	    display: inline-block;
	}
	</style>
	<?php
	}


	/**
	 * Add admin menus
	 * @return array
	 */
	public function admin_menu() {

		// Add welcome theme menu
		$theme = self::theme( 'Name' );
		add_menu_page( $theme, $theme, 'manage_options', self::$slug, [ $this, 'welcome' ], 'data:image/svg+xml;bas'.'e6'.'4,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMTEiIGhlaWdodD0iMjEzIiB2aWV3Qm94PSIwIDAgMjExIDIxMyI+IDxkZWZzPiA8c3R5bGU+IC5jbHMtMSB7IGZpbGw6ICNmZmY7IGZpbGwtcnVsZTogZXZlbm9kZDsgfSA8L3N0eWxlPiA8L2RlZnM+IDxwYXRoIGlkPSJDb2xvcl9GaWxsXzEiIGRhdGEtbmFtZT0iQ29sb3IgRmlsbCAxIiBjbGFzcz0iY2xzLTEiIGQ9Ik01Mi41MzMsMTYuMDI4Qzg2LjUyLDE1LjIxMSwxMTMuMDQ2LDQyLjYyLDk3LjgsNzcuMTM4Yy01LjcxNSwxMi45NDQtMTkuMDU0LDIwLjQ1LTMxLjk1NiwyMy45MTMtOS40NTIsMi41MzctMTkuMjY2LTEuNzQzLTIzLjk2Ny00LjQyOC0zLjM5NC0xLjkzOS02Ljk1LTIuMDI2LTkuNzY0LTQuNDI4LTguODQ0LTcuNTUtMjAuODIxLTI2Ljk1Ni0xNC4yLTQ2LjA1NGE0OC41NjEsNDguNTYxLDAsMCwxLDIzLjA4LTI2LjU3QzQ0Ljc1NywxNy42NTMsNDkuMTkzLDE4LjIxNyw1Mi41MzMsMTYuMDI4Wm05NC4wOTQsMGMxMS45MjItLjIxLDIyLjAyMS43MywyOS4yOTMsNS4zMTQsMTQuODkxLDkuMzg2LDI4LjYwNSwzNy45NDQsMTUuMDkxLDU5LjMzOS01Ljk2LDkuNDM2LTE3LjAxMiwxNy4yNjMtMjkuMjkzLDIwLjM3SDE0MS4zYy02LjYwOSwxLjYzOC0xNS40OTUsNC45NDktMjAuNDE3LDguODU3LTEwLjI0Niw4LjEzNi0xNi4wMjgsMjAuNS0xOS41MjgsMzUuNDI2djE5LjQ4NWMtNS4wMzYsMTguMDY4LTIzLjkxNywzOC45MTEtNDkuNzEsMzIuNzY5LTQuNzI0LTEuMTI0LTExLjA1Mi0yLjc3OC0xNS4wOS01LjMxMy01LjcxNC0zLjU4OC05LjU2LTkuMzgyLTEzLjMxNS0xNS4wNTdhNDUuMTUzLDQ1LjE1MywwLDAsMS02LjIxNC0xNC4xN2MtMS45LTcuODkzLjQ5NC0xNS4zNjgsMi42NjMtMjEuMjU2LDMuOTM5LTEwLjY5Myw5LjgyMi0yMC4yOTEsMTkuNTI5LTI0LjgsOC4zNTctMy44ODEsMTguMTcyLTIuNDgxLDI4LjQwNi01LjMxNCwxMi40NjYtMy40NTEsMjUuOTctMTAuMjYzLDMyLjg0NC0xOS40ODRBNjkuMTM5LDY5LjEzOSwwLDAsMCwxMTEuMTIsNjkuMTY3VjU0LjExMWMxLjQ2My02LjM1NywyLjk4NC0xMy42NzcsNi4yMTQtMTguNkMxMjIuMSwyOC4yNTYsMTMxLjEsMjEuMzE5LDEzOS41MjYsMTcuOCwxNDEuOTIsMTYuOCwxNDQuNzQ1LDE3LjI3MiwxNDYuNjI3LDE2LjAyOFptNTEuNDg1LDU0LjAyNWMwLjcxNCwwLjkuMzE1LDAuMjQzLDAuODg4LDEuNzcxaC0wLjg4OFY3MC4wNTNabS00Ni4xNTksNDIuNTEyYzI5LjMzMSwxLjM3OCw1Mi4xNjEsMjQuNjIsNDEuNzIxLDU1LjgtMS4zNTksNC4wNTgtMS4xMjIsOC40MzMtMy41NTEsMTEuNTEzLTYuNDI1LDguMTUyLTE4LjYsMTUuODM4LTMwLjE4MSwxOC42LTcuNzQ3LDEuODQ4LTE1LjE3LTEuNzM5LTE5LjUyOS0zLjU0My0zLjIzNi0xLjMzOS02LC4wNzktOC44NzYtMS43NzEtMTMuNC04LjYyNy0yNi4xMjktMzEuMTQ3LTE3Ljc1NC01My4xNCw0LjA4My0xMC43MjEsMTMuNzItMjAuMjY0LDIzLjk2Ny0yNC44QzE0MS43NDQsMTEzLjQ1NSwxNDguMiwxMTQuNzk0LDE1MS45NTMsMTEyLjU2NVoiLz4gPC9zdmc+', 2 );

		// Sub menus
		add_submenu_page( self::$slug, 'Welcome', 'Welcome', 'manage_options', self::$slug, [ $this, 'welcome' ] );
		add_submenu_page( self::$slug, 'Install Plugins', 'Install Plugins', 'edit_theme_options', 'themes.php?page=tgmpa-install-plugins' );
		add_submenu_page( self::$slug, 'Demo Importer', 'Demo Importer', 'edit_theme_options', 'customize.php?&autofocus[panel]=codevz_theme_options-demos' );
		add_submenu_page( self::$slug, 'Documentation & Support', 'Documentation & Support', 'manage_options', 'codevz-doc',[ $this, 'doc' ] );
		add_submenu_page( self::$slug, 'Theme Options', 'Theme Options', 'manage_options', 'customize.php' );
	}
	
	/**
	 * Documentation & Support page content
	 * @return string
	 */
	public function doc() {

		self::styles();

		?>

		<div class="wrap">
			
			<?php self::tabs('doc');?>

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('.cz_q').each(function() {
						$( this ).on('click' , function() {
							$(this).next('.cz_a').slideToggle();
						});
					});	

				});
			</script>

			<div class="cz_box cz_box2">
				<h2>FAQ</h2>

				<div class="cz_faq">
					<div class="cz_q">
						<b>How to update theme or plugins?</b>
					</div>
					<div class="cz_a">
						<p>Please read this: <a href="http://theme.support/doc/xtra#update" target="_blank">http://theme.support/doc/xtra#update</a></p>
					</div>
				</div>

				
				<div class="cz_faq">
					<div class="cz_q">
						<b>How to change site logo?</b>
					</div>
					<div class="cz_a">
						<p>Go to Theme Options > Header > Logo</p>
					</div>
				</div>



				<div class="cz_faq">
					<div class="cz_q">
						<b>How to change logo size?</b>
					</div>
					<div class="cz_a">
						<p>Go to Theme Options > Header > Header and find logo size fields</p>
					</div>
				</div>



				<div class="cz_faq">
					<div class="cz_q">
						<b>How to change copyright text? </b>
					</div>
					<div class="cz_a">
						<p>Go to Theme Options > Footer > Footer bottom bar and find Icon and Text element</p>
					</div>
				</div>


				<div class="cz_faq">
					<div class="cz_q">
						<b>How to disable quick contact form icon? </b>
					</div>
					<div class="cz_a">
						<p>Go to Theme Options > Footer > More and find quick contact form options</p>
					</div>
				</div>



				<div class="cz_faq">
					<div class="cz_q">
						<b>How to disable Back to top icon? </b>
					</div>
					<div class="cz_a">
						<p>Go to Theme Options > Footer > More and remove back top icon</p>
					</div>
				</div>



				<div class="cz_faq">
					<div class="cz_q">
						<b>How to re-import / replace new demo? </b>
					</div>
					<div class="cz_a">
						<p>First go to pages and delete all the pages also from trash, then you can import new demo</p>
					</div>
				</div>




				<div class="cz_faq">
					<div class="cz_q">
						<b>How to fix fatal error allowed memory size of xx bytes exhausted?</b>
					</div>
					<div class="cz_a">
						<p>Please read this: <a href="https://codevz.ticksy.com/article/13137/" target="_blank">https://codevz.ticksy.com/article/13137/</a></p>
					</div>
				</div>




				<div class="cz_faq">
					<div class="cz_q">
						<b>Do I need to activate WPBakery or Slider Plugins with license key?</b>
					</div>
					<div class="cz_a">
						<p>No, we have an extended license for this plugins and we can only use it in our theme(s), we will update our Plugins repository when this plugins updated, you can update them via our theme for lifetime.</p>
					</div>
				</div>




				<div class="cz_faq">
					<div class="cz_q">
						<b>How to fix Stylesheet is missing error?</b>
					</div>
					<div class="cz_a">
						<p>Please read this: <a href="https://codevz.ticksy.com/article/13119/" target="_blank">https://codevz.ticksy.com/article/13119/</a></p>
					</div>
				</div>




				<div class="cz_faq">
					<div class="cz_q">
						<b>Fix error: Destination folder already exists for installing plugins</b>
					</div>
					<div class="cz_a">
						<p>Please read this: <a href="https://codevz.ticksy.com/article/13873/" target="_blank">https://codevz.ticksy.com/article/13873/</a></p>
					</div>
				</div>



			</div>


			<div class="cz_box cz_box2 cz_box_end" style="min-height: auto;" >
				
				<h2 class="cz_fl" style="margin-bottom:0">Support Center</h2>

				<a class="cz_button cz_button_a cz_fr" target="_blank" href="https://codevz.ticksy.com"><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3NiA0NzYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ3NiA0NzY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Zz4KCTxwYXRoIGQ9Ik00MDAuODUsMTgxdi0xOC4zYzAtNDMuOC0xNS41LTg0LjUtNDMuNi0xMTQuN2MtMjguOC0zMS02OC40LTQ4LTExMS42LTQ4aC0xNS4xYy00My4yLDAtODIuOCwxNy0xMTEuNiw0OCAgIGMtMjguMSwzMC4yLTQzLjYsNzAuOS00My42LDExNC43VjE4MWMtMzQuMSwyLjMtNjEuMiwzMC43LTYxLjIsNjUuNFYyNzVjMCwzNi4xLDI5LjQsNjUuNSw2NS41LDY1LjVoMzYuOWM2LjYsMCwxMi01LjQsMTItMTIgICBWMTkyLjhjMC02LjYtNS40LTEyLTEyLTEyaC0xNy4ydi0xOC4xYzAtNzkuMSw1Ni40LTEzOC43LDEzMS4xLTEzOC43aDE1LjFjNzQuOCwwLDEzMS4xLDU5LjYsMTMxLjEsMTM4Ljd2MTguMWgtMTcuMiAgIGMtNi42LDAtMTIsNS40LTEyLDEydjEzNS42YzAsNi42LDUuNCwxMiwxMiwxMmgxNi44Yy00LjksNjIuNi00OCw3Ny4xLTY4LDgwLjRjLTUuNS0xNi45LTIxLjQtMjkuMS00MC4xLTI5LjFoLTMwICAgYy0yMy4yLDAtNDIuMSwxOC45LTQyLjEsNDIuMXMxOC45LDQyLjIsNDIuMSw0Mi4yaDMwLjFjMTkuNCwwLDM1LjctMTMuMiw0MC42LTMxYzkuOC0xLjQsMjUuMy00LjksNDAuNy0xMy45ICAgYzIxLjctMTIuNyw0Ny40LTM4LjYsNTAuOC05MC44YzM0LjMtMi4xLDYxLjUtMzAuNiw2MS41LTY1LjR2LTI4LjZDNDYxLjk1LDIxMS43LDQzNC45NSwxODMuMiw0MDAuODUsMTgxeiBNMTA0Ljc1LDMxNi40aC0yNC45ICAgYy0yMi45LDAtNDEuNS0xOC42LTQxLjUtNDEuNXYtMjguNmMwLTIyLjksMTguNi00MS41LDQxLjUtNDEuNWgyNC45VjMxNi40eiBNMjY4LjI1LDQ1MmgtMzAuMWMtMTAsMC0xOC4xLTguMS0xOC4xLTE4LjEgICBzOC4xLTE4LjEsMTguMS0xOC4xaDMwLjFjMTAsMCwxOC4xLDguMSwxOC4xLDE4LjFTMjc4LjI1LDQ1MiwyNjguMjUsNDUyeiBNNDM3Ljk1LDI3NC45YzAsMjIuOS0xOC42LDQxLjUtNDEuNSw0MS41aC0yNC45VjIwNC44ICAgaDI0LjljMjIuOSwwLDQxLjUsMTguNiw0MS41LDQxLjVWMjc0Ljl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />Technical Support</a>

			</div>


			<div class="cz_box cz_box4">
				<h2>Video Tutorial</h2>

				<ul class="cz_ula">
					<li><a href="https://www.youtube.com/watch?v=cpmkKF03Ucc" target="_blank">How to installing?</a></li>
					<li><a href="https://www.youtube.com/watch?v=L04htAGAdNc" target="_blank">Header Builder</a></li>
					<li><a href="https://www.youtube.com/watch?v=JujqGDhf5d4" target="_blank">Page Builder</a></li>
					<li><a href="https://www.youtube.com/watch?v=C5u02RGUVVs" target="_blank">Footer Builder</a></li>
					<li><a href="https://www.youtube.com/watch?v=98XwGq9SSxM" target="_blank">Mobile Header</a></li>
				</ul>

				<a class="cz_button cz_button_a" target="_blank" href="https://www.youtube.com/channel/UCrS1L4oeTRfU1hvIo1gJGjg/videos?view_as=subscriber"><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQ3Ny42MDYsMTI4LjA1NUM0NDMuNDMxLDY4Ljg2MywzODguMjUxLDI2LjUyLDMyMi4yMjksOC44M0MyNTYuMjA4LTguODYyLDE4Ny4yNSwwLjIxNywxMjguMDU1LDM0LjM5NCAgICBDNjguODYxLDY4LjU3LDI2LjUyLDEyMy43NSw4LjgzLDE4OS43NzJjLTE3LjY5LDY2LjAyMS04LjYxMSwxMzQuOTgxLDI1LjU2NCwxOTQuMTczICAgIEM2OC41NjgsNDQzLjEzNywxMjMuNzUsNDg1LjQ4LDE4OS43NzEsNTAzLjE3YzIyLjA0Niw1LjkwOCw0NC40MTcsOC44Myw2Ni42NDYsOC44M2M0NC4zMzksMCw4OC4xMDEtMTEuNjI5LDEyNy41MjktMzQuMzkzICAgIGM1OS4xOTItMzQuMTc1LDEwMS41MzUtODkuMzU1LDExOS4yMjUtMTU1LjM3N0M1MjAuODYyLDI1Ni4yMDcsNTExLjc4MSwxODcuMjQ5LDQ3Ny42MDYsMTI4LjA1NXogTTQ3Ny40MjksMzE1LjMzMyAgICBjLTE1Ljg0OCw1OS4xNDYtNTMuNzgsMTA4LjU4MS0xMDYuODEsMTM5LjE5N2MtNTMuMDI4LDMwLjYxNy0xMTQuODA2LDM4Ljc0OS0xNzMuOTUyLDIyLjkwMyAgICBjLTU5LjE0Ny0xNS44NDgtMTA4LjU4MS01My43OC0xMzkuMTk4LTEwNi44MWMtMzAuNjE2LTUzLjAyOC0zOC43NDktMTE0LjgwNy0yMi45LTE3My45NTQgICAgQzUwLjQxOCwxMzcuNTIzLDg4LjM1LDg4LjA5LDE0MS4zNzksNTcuNDcyYzM1LjMyNS0yMC4zOTUsNzQuNTI0LTMwLjgxMiwxMTQuMjQ5LTMwLjgxMmMxOS45MSwwLDM5Ljk1OSwyLjYxOCw1OS43MDIsNy45MDkgICAgYzU5LjE0NiwxNS44NDgsMTA4LjU4MSw1My43OCwxMzkuMTk3LDEwNi44MUM0ODUuMTQ0LDE5NC40MDgsNDkzLjI3OCwyNTYuMTg2LDQ3Ny40MjksMzE1LjMzM3oiIGZpbGw9IiNGRkZGRkYiLz4KCTwvZz4KPC9nPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zNzguNzc4LDIzMS44NTJsLTE2NC41MjYtOTQuOTljLTguNzMxLTUuMDQxLTE5LjE1NS01LjAzOS0yNy44ODYtMC4wMDFjLTguNzMxLDUuMDQtMTMuOTQ0LDE0LjA2OS0xMy45NDQsMjQuMTV2MTg5Ljk4ICAgIGMwLDEwLjA4MSw1LjIxMiwxOS4xMDksMTMuOTQ0LDI0LjE1YzQuMzY1LDIuNTIxLDkuMTUyLDMuNzgsMTMuOTQxLDMuNzhjNC43OSwwLDkuNTc5LTEuMjYyLDEzLjk0NC0zLjc4MWwxNjQuNTI4LTk0Ljk4OSAgICBjOC43My01LjA0MiwxMy45NDEtMTQuMDcsMTMuOTQxLTI0LjE1MUMzOTIuNzIsMjQ1LjkyLDM4Ny41MDgsMjM2Ljg5MiwzNzguNzc4LDIzMS44NTJ6IE0zNjUuNDUyLDI1Ny4wNzRsLTE2NC41MjcsOTQuOTg5ICAgIGMtMC4yMDEsMC4xMTctMC42MiwwLjM1OC0xLjIzNiwwYy0wLjYxOC0wLjM1Ny0wLjYxOC0wLjgzOS0wLjYxOC0xLjA3MXYtMTg5Ljk4YzAtMC4yMzIsMC0wLjcxNCwwLjYxOC0xLjA3MSAgICBjMC4yNDItMC4xNCwwLjQ1My0wLjE4OCwwLjYzMy0wLjE4OGMwLjI4LDAsMC40ODIsMC4xMTcsMC42MDUsMC4xODhsMTY0LjUyNiw5NC45OWMwLjIwMSwwLjExNiwwLjYxOCwwLjM1NywwLjYxOCwxLjA3MSAgICBDMzY2LjA3MSwyNTYuNzE2LDM2NS42NTIsMjU2Ljk1OCwzNjUuNDUyLDI1Ny4wNzR6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDEzLjMwMywxMzQuNDRjLTMxLjY4OS00MC45MzgtNzkuMzI2LTY4LjQ0Mi0xMzAuNjk4LTc1LjQ2MWMtNy4yODMtMC45OTctMTQuMDA5LDQuMTA2LTE1LjAwNiwxMS4zOTkgICAgYy0wLjk5NSw3LjI5MSw0LjEwOCwxNC4wMDksMTEuMzk5LDE1LjAwNmM0NC41MTIsNi4wODEsODUuNzgzLDI5LjkwOSwxMTMuMjMyLDY1LjM2OWMyLjYyNiwzLjM5Miw2LjU2NSw1LjE2OCwxMC41NDYsNS4xNjggICAgYzIuODQ5LDAsNS43Mi0wLjkwOSw4LjE0Ni0yLjc4OUM0MTYuNzQxLDE0OC42MjgsNDE3LjgwNywxNDAuMjU5LDQxMy4zMDMsMTM0LjQ0eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />View All Videos</a>

			</div>

			<div class="cz_box cz_box4 cz_box_end">
				<h2>Documentation</h2>

				<ul class="cz_ula">
					<li><a href="http://theme.support/doc/xtra#install" target="_blank">Installation</a></li>
					<li><a href="http://theme.support/doc/xtra#import" target="_blank">Demo Importer</a></li>
					<li><a href="http://theme.support/doc/xtra#troubleshooting" target="_blank">Installation Troubleshooting</a></li>
					<li><a href="http://theme.support/doc/xtra#update" target="_blank">Update Guide</a></li>
					<li><a href="http://theme.support/doc/xtra#edit" target="_blank">Demos Edit Guide</a></li>
					<li><a href="http://theme.support/doc/xtra#colors" target="_blank">Theme Color</a></li>
					<li><a href="http://theme.support/doc/xtra#faq" target="_blank">FAQ</a></li>
				</ul>

				<a class="cz_button cz_button_a" target="_blank" href="http://theme.support/doc/xtra"><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMjRweCIgaGVpZ2h0PSIyNHB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDk4Ljc5MSwxNjEuMTI3Yy0xNy41NDUtMTcuNTQ2LTQ2LjA5NC0xNy41NDUtNjMuNjQ1LDAuMDA0Yy01LjM5OCw1LjQwMy0zOS44NjMsMzkuODk2LTQ1LjEyOCw0NS4xNjZWODcuNDI2ICAgIGMwLTEyLjAyLTQuNjgxLTIzLjMyLTEzLjE4MS0zMS44MTlMMzM0LjQxMiwxMy4xOEMzMjUuOTEzLDQuNjgsMzE0LjYxMiwwLDMwMi41OTIsMEg0NS4wMThjLTI0LjgxMywwLTQ1LDIwLjE4Ny00NSw0NXY0MjIgICAgYzAsMjQuODEzLDIwLjE4Nyw0NSw0NSw0NWgzMDBjMjQuODEzLDAsNDUtMjAuMTg3LDQ1LTQ1VjMzMy42MzFMNDk4Ljc5LDIyNC43NjdDNTE2LjM3NywyMDcuMTgxLDUxNi4zODEsMTc4LjcxNSw0OTguNzkxLDE2MS4xMjcgICAgeiBNMzAwLjAxOSwzMGMyLjgzNCwwLDguMjk1LTAuNDkxLDEzLjE4LDQuMzkzbDQyLjQyNiw0Mi40MjdjNC43Niw0Ljc2MSw0LjM5NCw5Ljk3OCw0LjM5NCwxMy4xOGgtNjBWMzB6IE0zNjAuMDE4LDQ2NyAgICBjMCw4LjI3MS02LjcyOCwxNS0xNSwxNWgtMzAwYy04LjI3MSwwLTE1LTYuNzI5LTE1LTE1VjQ1YzAtOC4yNzEsNi43MjktMTUsMTUtMTVoMjI1djc1YzAsOC4yODQsNi43MTYsMTUsMTUsMTVoNzV2MTE2LjMyMyAgICBjMCwwLTQ0LjI1NCw0NC4yOTItNDQuMjU2LDQ0LjI5M2wtMjEuMjAzLDIxLjIwNGMtMS42NDYsMS42NDYtMi44ODgsMy42NTQtMy42MjQsNS44NjNsLTIxLjIxNCw2My42NCAgICBjLTEuNzk3LDUuMzktMC4zOTQsMTEuMzMzLDMuNjI0LDE1LjM1YzQuMDIzLDQuMDIzLDkuOTY4LDUuNDE5LDE1LjM1LDMuNjI0bDYzLjY0LTIxLjIxM2MyLjIwOS0wLjczNiw0LjIxNy0xLjk3Nyw1Ljg2My0zLjYyNCAgICBsMS44Mi0xLjgyVjQ2N3ogTTMyNi4zNzgsMzEyLjQyN2wyMS4yMTMsMjEuMjEzbC04LjEwMyw4LjEwM2wtMzEuODE5LDEwLjYwNmwxMC42MDYtMzEuODJMMzI2LjM3OCwzMTIuNDI3eiBNMzY4LjgsMzEyLjQyMiAgICBsLTIxLjIxMy0yMS4yMTNjMTEuMjk2LTExLjMwNSw2MS40NjUtNjEuNTE3LDcyLjEwNS03Mi4xNjZsMjEuMjEzLDIxLjIxM0wzNjguOCwzMTIuNDIyeiBNNDc3LjU3MywyMDMuNTU4bC0xNS40NjMsMTUuNDc2ICAgIGwtMjEuMjEzLTIxLjIxM2wxNS40NjgtMTUuNDgxYzUuODUyLTUuODQ5LDE1LjM2Ni01Ljg0OCwyMS4yMTQsMEM0ODMuNDI2LDE4OC4xOSw0ODMuNDU3LDE5Ny42NzMsNDc3LjU3MywyMDMuNTU4eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTI4NS4wMTgsMTUwaC0yMTBjLTguMjg0LDAtMTUsNi43MTYtMTUsMTVzNi43MTYsMTUsMTUsMTVoMjEwYzguMjg0LDAsMTUtNi43MTYsMTUtMTVTMjkzLjMwMiwxNTAsMjg1LjAxOCwxNTB6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjI1LjAxOCwyMTBoLTE1MGMtOC4yODQsMC0xNSw2LjcxNi0xNSwxNXM2LjcxNiwxNSwxNSwxNWgxNTBjOC4yODQsMCwxNS02LjcxNiwxNS0xNVMyMzMuMzAyLDIxMCwyMjUuMDE4LDIxMHoiIGZpbGw9IiNGRkZGRkYiLz4KCTwvZz4KPC9nPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0yMjUuMDE4LDI3MGgtMTUwYy04LjI4NCwwLTE1LDYuNzE2LTE1LDE1czYuNzE2LDE1LDE1LDE1aDE1MGM4LjI4NCwwLDE1LTYuNzE2LDE1LTE1UzIzMy4zMDIsMjcwLDIyNS4wMTgsMjcweiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTIyNS4wMTgsMzMwaC0xNTBjLTguMjg0LDAtMTUsNi43MTYtMTUsMTVzNi43MTYsMTUsMTUsMTVoMTUwYzguMjg0LDAsMTUtNi43MTYsMTUtMTVTMjMzLjMwMiwzMzAsMjI1LjAxOCwzMzB6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjg1LjAxOCw0MjJoLTkwYy04LjI4NCwwLTE1LDYuNzE2LTE1LDE1czYuNzE2LDE1LDE1LDE1aDkwYzguMjg0LDAsMTUtNi43MTYsMTUtMTVTMjkzLjMwMiw0MjIsMjg1LjAxOCw0MjJ6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />Documentation</a>

			</div>

			
   							
		</div>
		<?php

	}

	/**
	 * Welcome page content
	 * @return string
	 */
	public function welcome() {
		$active = null;

		// Deregister activation
		if ( isset( $_POST['deregister'] ) ) {
			$active = self::activation_process( 'deregister' );
		} else if ( isset( $_POST['code'] ) ) {
			$active = self::activation_process( 'register', $_POST['code'] );
		}

		self::styles();

		?>

			<div class="wrap">
			
			<?php self::tabs('welcome'); ?>

			<div class="cz_box cz_box2">
				<h2>Activation</h2>

				<?php

					// Activation
					if ( is_array( get_option( 'codevz_theme_activation' ) ) ) {
						echo '<h3 class="cz_grn">Congratulations your theme activated successfully.</h3>';
						if ( $active && $active !== 'register' ) {
							echo '<h3 class="cz_rd">' . esc_html( $active ) . '</h3>';
						}

						$details = (array) get_option( 'codevz_theme_activation' );

						if ( isset( $details['purchase_code'] ) ) {

							echo '<ul class="cz_ul_details">';
							echo '<li><span>Purchase code:</span> <br />' . $details['purchase_code'] . '</li>';
							echo '<li><span>Purchase date:</span> <br />' . date( 'd F Y', strtotime( $details['purchase_date'] ) ) . '</li>';
							echo '<li><span>Support until:</span> <br />' . date( 'd F Y', strtotime( $details['support_until'] ) ) . '</li>';
							echo '<li><span>Theme and Plugins updates:</span> <br />Lifetime</li>';
							echo '</ul>';

						}

						?>
							<form method="post">
								<input type="hidden" name="deregister" value="1">
								<input type="submit" class="cz_button cz_button2" value="Deregister license">
							</form>
						<?php

					} else if ( $active ) {

						if ( $active === 'register' ) {
							echo '<h3 class="cz_grn">Congratulations your theme activated successfully.</h3>';
							?>
								<form method="post">
									<input type="hidden" name="deregister" value="1">
									<input type="submit" class="cz_button cz_button2" value="Deregister license">
								</form>
							<?php 
						} else {
							echo '
				<p style="font-size: 18px">Please activate your theme via purchase code to access<br />theme features, updates and demo importer</p>
				<h3 class="cz_rd">' . esc_html( $active ) . '</h3>';
							?>
								<form class="cz_85" method="post">
									<input class="cz_code" type="text" name="code" placeholder="Please insert purchase code ...">
									<input type="submit" class="cz_button cz_button_activation" value="Activate">
								</form>
								<p class="cz_85">
									<a href="https://xtratheme.com/my-account" target="_blank">How to find purchase code?</a>
									<a href="https://xtratheme.com/" target="_blank" class="cz_fr">Buy new license</a>
								</p>

							<?php 
						}

					} else {
						?>
							<p style="font-size: 18px">Please activate your theme via purchase code to access<br />theme features, updates and demo importer</p>
							<form class="cz_85" method="post">
								<input class="cz_code" type="text" name="code" placeholder="Please insert purchase code ...">
								<input type="submit" class="cz_button cz_button_activation" value="Activate">
							</form>
							<p class="cz_85">
								<a href="https://xtratheme.com/my-account" target="_blank">How to find purchase code?</a>
								<a href="https://xtratheme.com/" target="_blank" class="cz_fr">Buy new license</a>
							</p>
						<?php 
					}
				?>

			</div>

			<div class="cz_box cz_box2 cz_box_end">

				<h2> System Status </h2>
				<ul class="cz_ul">
					<li>PHP version: <?php echo PHP_VERSION . ( ( version_compare( PHP_VERSION, '7.0.0') <= 0 ) ? '<span class="cz_error">' . esc_html__( 'PHP 7.2 recommended', 'codevz' ) . '</span>' : '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' ); ?></li>
					<li>Memory limit: <?php echo ini_get( 'memory_limit' ) . ( ( ini_get( 'memory_limit' ) < 128 ) ? '<span class="cz_error">' . esc_html__( '128M recommended', 'codevz' ) . '</span>' : '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' ); ?></li>
					<li>Max execution time: <?php echo ini_get( 'max_execution_time' ) . ( ( ini_get( 'memory_limit' ) < 60 ) ? '<span class="cz_error">' . esc_html__( '60 recommended', 'codevz' ) . '</span>' : '<span class="cz_good">' . esc_html__( 'Good', 'codevz' ) . '</span>' ); ?></li>
				</ul>
			</div>

		</div>
		<?php
	}

	/**
	 * Activation process
	 * @return string
	 */
	public static function activation_process( $type = 'register', $code = '' ) {

		if ( $type === 'deregister') {
			$code = (array) get_option( 'codevz_theme_activation' );
			if ( isset( $code['purchase_code'] ) ) {
				$code = $code['purchase_code'];
			} else {
				return 'Failed, Please try again ...';
			}
		}

		if ( ! $code ) {
			return 'Please insert valid purchase code.';
		}

		// Verify purchase
		$verify = wp_remote_get( 'https://xtratheme.com?type=' . $type . '&domain=' . $_SERVER['SERVER_NAME'] . '&code=' . $code );
		if ( is_wp_error( $verify ) ) {
			return $verify->get_error_message() ;
		} else if ( ! isset( $verify['body'] ) ) {
			return 'Something went wrong, Please try again in the next 10 seconds';
		} else {
			$verify = json_decode( $verify['body'], true );

			if ( isset( $verify['type'] ) && $verify['type'] === 'deregister' ) {
				
				if ( ! isset( $verify['limit'] ) ) {
					delete_option( 'codevz_theme_activation' );
				}

				return $verify['message'];
			}

			if ( isset( $verify['type'] ) && $verify['type'] === 'error' ) {
				return $verify['message'];
			}

			if ( ! isset( $verify['purchase_code'] ) ) {
				return 'Purchase code not found in our database, Please try again ...';
			}
		}

		// Update option
		if ( $type === 'register' ) {
			update_option( 'codevz_theme_activation', $verify );
			return 'register';
		}
	}

}

// Run
Codevz_Dashboard::instance();