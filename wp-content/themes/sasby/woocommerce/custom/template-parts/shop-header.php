<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( SasbyTheme::$layout == 'full-width' ) {
	$sasby_layout_class = 'col-sm-12 col-12';
}  else {
	$sasby_layout_class = SasbyTheme_Helper::has_active_widget();	
}
if( is_active_sidebar( 'shop-sidebar' )) {
	$fixedbar = 'fixed-bar-coloum';
}else {
	$fixedbar = '';
}
?>
<div id="primary" class="section content-area customize-content-selector">
	<div class="container">
		<div class="row">		
			<?php if ( SasbyTheme::$layout == 'left-sidebar' ) { ?>
				<div class="col-xl-4 <?php echo esc_attr( $fixedbar ); ?>">
					<aside class="sidebar-widget-area">
						<?php if ( is_active_sidebar( 'shop-sidebar' ) ) dynamic_sidebar( 'shop-sidebar' ); ?>
					</aside>
				</div>
			<?php } ?>
			
			<div class="<?php echo esc_attr( $sasby_layout_class );?>">		
				<main id="main" class="site-main page-content-main">