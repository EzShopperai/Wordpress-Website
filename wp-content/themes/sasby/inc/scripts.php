<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Rtrs\Models\Review; 

function sasby_get_maybe_rtl( $filename ){
	$file = get_template_directory_uri() . '/assets/';
	if ( is_rtl() ) {
		return $file . 'rtl-css/' . $filename;
	}
	else {
		return $file . 'css/' . $filename;
	}
}
function sasby_get_css( $filename ){
	$file = get_template_directory_uri() . '/assets/';
	return $file . 'css/' . $filename;
}
add_action( 'wp_enqueue_scripts','sasby_enqueue_high_priority_scripts', 1500 );
function sasby_enqueue_high_priority_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'rtlcss', SASBY_ASSETS_URL . 'css/rtl.css', array(), SASBY_VERSION );
	}
}
//elementor animation dequeue
add_action('elementor/frontend/after_enqueue_scripts', function(){
    wp_deregister_style( 'e-animations' );
    wp_dequeue_style( 'e-animations' );
});

add_action( 'wp_enqueue_scripts', 'sasby_register_scripts', 12 );
if ( !function_exists( 'sasby_register_scripts' ) ) {
	function sasby_register_scripts(){
		wp_deregister_style( 'font-awesome' );
        wp_deregister_style( 'layerslider-font-awesome' );
        wp_deregister_style( 'yith-wcwl-font-awesome' );

		/*CSS*/
		// animate CSS	
		wp_register_style( 'magnific-popup',     sasby_get_css('magnific-popup.css'), array(), SASBY_VERSION );		
		wp_register_style( 'animatedheadline',     sasby_get_css('animatedheadline.css'), array(), SASBY_VERSION );
		wp_register_style( 'animate',        	 sasby_get_css('animate.min.css'), array(), SASBY_VERSION );

		/*JS*/

		// Headline js
		wp_register_script( 'rt-animatedheadline',   	 SASBY_ASSETS_URL . 'js/animatedheadline.min.js', array( 'jquery' ), SASBY_VERSION, true );


		// magnific popup
		wp_register_script( 'magnific-popup',    SASBY_ASSETS_URL . 'js/jquery.magnific-popup.min.js', array( 'jquery' ), SASBY_VERSION, true );

		// theia sticky
		wp_register_script( 'theia-sticky',    	 SASBY_ASSETS_URL . 'js/theia-sticky-sidebar.min.js', array( 'jquery' ), SASBY_VERSION, true );
		
		// parallax scroll js
		wp_register_script( 'rt-parallax',   	 SASBY_ASSETS_URL . 'js/rt-parallax.js', array( 'jquery' ), SASBY_VERSION, true );


		
		// wow js
		wp_register_script( 'rt-wow',   		 SASBY_ASSETS_URL . 'js/wow.min.js', array( 'jquery' ), SASBY_VERSION, true );

		// isotope js
		wp_register_script( 'isotope-pkgd',      SASBY_ASSETS_URL . 'js/isotope.pkgd.min.js', array( 'jquery' ), SASBY_VERSION, true );		
		wp_register_script( 'swiper-min',        SASBY_ASSETS_URL . 'js/swiper.min.js', array( 'jquery' ), SASBY_VERSION, true );

		// counterup js
		wp_register_script( 'waypoints',        SASBY_ASSETS_URL . 'js/waypoints.min.js', array( 'jquery' ), SASBY_VERSION, true );
		wp_register_script( 'counterup',        SASBY_ASSETS_URL . 'js/jquery.counterup.min.js', array( 'jquery' ), SASBY_VERSION, true );

		
	}
}

add_action( 'wp_enqueue_scripts', 'sasby_enqueue_scripts', 15 );
if ( !function_exists( 'sasby_enqueue_scripts' ) ) {
	function sasby_enqueue_scripts() {
		$dep = array( 'jquery' );
		/*CSS*/
		// Google fonts
		wp_enqueue_style( 'sasby-gfonts', 	SasbyTheme_Helper::fonts_url(), array(), SASBY_VERSION );
		// Bootstrap CSS  //@rtl
		wp_enqueue_style( 'bootstrap', 				sasby_get_css('bootstrap.min.css'), array(), SASBY_VERSION );
		
		// Flaticon CSS
		wp_enqueue_style( 'flaticon-sasby',    SASBY_ASSETS_URL . 'fonts/flaticon-sasby/flaticon.css', array(), SASBY_VERSION );
		
		elementor_scripts();
		//Video popup
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'animatedheadline' );
		wp_enqueue_style( 'animate' );
		// font-awesome CSS
		wp_enqueue_style( 'font-awesome',       	SASBY_ASSETS_URL . 'css/font-awesome.min.css', array(), SASBY_VERSION );
		// main CSS // @rtl
		wp_enqueue_style( 'sasby-default',    	sasby_get_maybe_rtl('default.css'), array(), SASBY_VERSION );
		// vc modules css
		wp_enqueue_style( 'sasby-elementor',   sasby_get_maybe_rtl('elementor.css'), array(), SASBY_VERSION );
			
		// Style CSS
		wp_enqueue_style( 'sasby-style',     	sasby_get_maybe_rtl('style.css'), array(), SASBY_VERSION );
		
		// Template Style
		wp_add_inline_style( 'sasby-style',   	sasby_template_style() );

		/*JS*/
		// bootstrap js
		wp_enqueue_script( 'bootstrap',         	SASBY_ASSETS_URL . 'js/bootstrap.min.js', array( 'jquery' ), SASBY_VERSION, true );
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'theia-sticky' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'rt-wow' );
		wp_enqueue_script( 'rt-parallax' );
		wp_enqueue_script( 'rt-animatedheadline' );
		wp_enqueue_script( 'isotope-pkgd' );
		wp_enqueue_script( 'swiper-min' );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'sasby-main',    	SASBY_ASSETS_URL . 'js/main.js', $dep , SASBY_VERSION, true );
		
		// localize script
		$sasby_localize_data = array(
			'stickyMenu' 	=> SasbyTheme::$options['sticky_menu'],
			'siteLogo'   	=> '<a href="' . esc_url( home_url( '/' ) ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '">' . '</a>',
			'extraOffset' => SasbyTheme::$options['sticky_menu'] ? 70 : 0,
			'extraOffsetMobile' => SasbyTheme::$options['sticky_menu'] ? 52 : 0,
			'rtl' => is_rtl()?'rtl':'ltr',
			
			// Ajax
			'ajaxURL' => admin_url('admin-ajax.php'),
			'post_scroll_limit' => SasbyTheme::$options['post_scroll_limit'],
			'nonce' => wp_create_nonce( 'sasby-nonce' )
		);
		wp_localize_script( 'sasby-main', 'sasbyObj', $sasby_localize_data );
	}	
}

function elementor_scripts() {
	
	if ( !did_action( 'elementor/loaded' ) ) {
		return;
	}
	
	if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		// do stuff for preview		
		wp_enqueue_script( 'rt-wow' );
		wp_enqueue_script( 'counterup' );
		wp_enqueue_script( 'waypoints' );
	} 

	/*review rating*/
	if( class_exists( Review::class )){
		wp_enqueue_style( 'rtrs-app' );
		return true;
	}
	return false;

}

add_action( 'wp_enqueue_scripts', 'sasby_high_priority_scripts', 1500 );
if ( !function_exists( 'sasby_high_priority_scripts' ) ) {
	function sasby_high_priority_scripts() {
		// Dynamic style
		SasbyTheme_Helper::dynamic_internal_style();
	}
}

function sasby_template_style(){
	
	ob_start();
	?>
	
	.entry-banner {
		<?php if ( SasbyTheme::$bgtype == 'bgcolor' ): ?>
			<?php if( !empty( SasbyTheme::$bgcolor ) ) { ?>
				background-color: <?php echo SasbyTheme::$bgcolor; ?>;
			<?php } ?>
		<?php else: ?>
			background: url(<?php echo esc_url( SasbyTheme::$bgimg );?>) no-repeat scroll center center / cover;
		<?php endif; ?>
	}

	.content-area {
		padding-top: <?php echo esc_html( SasbyTheme::$padding_top );?>px; 
		padding-bottom: <?php echo esc_html( SasbyTheme::$padding_bottom );?>px;
	}

	<?php if( isset( SasbyTheme::$pagebgcolor ) || isset( SasbyTheme::$pagebgimg ) ) { ?>
	#page .content-area {
		background-image: url( <?php echo SasbyTheme::$pagebgimg; ?> );
		<?php if( !empty( SasbyTheme::$pagebgcolor ) ) { ?>
		background-color: <?php echo SasbyTheme::$pagebgcolor; ?>;
		<?php } ?>
	}
	<?php } ?>	
	
	<?php
	return ob_get_clean();
}

function load_custom_wp_admin_script_gutenberg() {
	wp_enqueue_style( 'sasby-gfonts', SasbyTheme_Helper::fonts_url(), array(), SASBY_VERSION );
	// font-awesome CSS
	wp_enqueue_style( 'font-awesome',       SASBY_ASSETS_URL . 'css/font-awesome.min.css', array(), SASBY_VERSION );
	// Flaticon CSS
	wp_enqueue_style( 'flaticon-sasby',    SASBY_ASSETS_URL . 'fonts/flaticon-sasby/flaticon.css', array(), SASBY_VERSION );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script_gutenberg', 1 );

function load_custom_wp_admin_script() {
	wp_enqueue_style( 'sasby-admin-style',  SASBY_ASSETS_URL . 'css/admin-style.css', false, SASBY_VERSION );
	wp_enqueue_script( 'sasby-admin-main',  SASBY_ASSETS_URL . 'js/admin.main.js', false, SASBY_VERSION, true );
	
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script' );

/*Topbar menu function*/
if ( !function_exists( 'sasby_top_menu' ) ) {
	function sasby_top_menu() {
	    $menus = wp_get_nav_menus();
	    if(!empty($menus)){
	      	$menu_links = array();
	      	foreach ($menus as $key => $value) {
	        	$menu_links[$value->slug] = $value->name;  
	      	}
	      	return $menu_links;
	    }
	}
}
