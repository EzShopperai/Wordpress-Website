<?php
$sasby_footer_column = SasbyTheme::$options['footer_column_1'];
switch ( $sasby_footer_column ) {
	case '1':
	$sasby_footer_class = 'col-12';
	break;
	case '2':
	$sasby_footer_class = 'col-xl-6 col-md-6';
	break;
	case '3':
	$sasby_footer_class = 'col-xl-4 col-md-6';
	break;		
	default:
	$sasby_footer_class = 'col-xl-3 col-md-6';
	break;
}
$sasby_socials = SasbyTheme_Helper::socials();
if( !empty( SasbyTheme::$options['fbgimg'] ) ) {
	$f1_bg = wp_get_attachment_image_src( SasbyTheme::$options['fbgimg'], 'full', true );
	$footer_bg_img = $f1_bg[0];
}else {
	$footer_bg_img = SASBY_ASSETS_URL . 'img/footer_bg.jpg';
}

if ( SasbyTheme::$options['footer_bgtype'] == 'fbgcolor' ) {
	$sasby_bg = SasbyTheme::$options['fbgcolor'];
} else {
	$sasby_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}
$bgc = $menu_on = $copyright_on = '';
if ( SasbyTheme::$options['footer_bgtype'] == 'fbgimg' ) {
	$bgc = 'footer-bg-opacity';
}

$menu_on = ( SasbyTheme::$options['copyright_menu'] ) ? "menu-on" : "menu-off";
$copyright_on = ( SasbyTheme::$options['copyright_text'] && is_active_sidebar('copyright-menu')) ? "copyright-on" : "copyright-off";"rt_copyright_menu_no";
?>
<div class="footer-top-area <?php echo esc_attr( $bgc ); ?>" style="background:<?php echo esc_html( $sasby_bg ); ?>">
	<?php if ( is_active_sidebar( 'footer-style-1-1' ) && SasbyTheme::$footer_area == 1 ) { ?>
	<div class="footer-content-area">
		<div class="container">			
			<div class="row">
				<?php
				for ( $i = 1; $i <= $sasby_footer_column; $i++ ) {
					echo '<div class="' . $sasby_footer_class . '">';
					dynamic_sidebar( 'footer-style-1-'. $i );
					echo '</div>';
				}
				?>
			</div>			
		</div>
	</div>
	<?php } ?>
	<?php if ( SasbyTheme::$copyright_area == 1 ) { ?>
	<div class="footer-copyright-area">
		<div class="container">
			<div class="copyright-area <?php echo esc_attr( $copyright_on ); ?> <?php echo esc_attr( $menu_on ); ?>">
				<div class="copyright-menu-wrap">
					<?php if ( SasbyTheme::$options['copyright_text'] ) { ?>
					<div class="copyright"><?php echo wp_kses( SasbyTheme::$options['copyright_text'] , 'allow_link' );?></div>
					<?php } ?>
				</div>
				<?php if ( SasbyTheme::$options['copyright_menu'] ) { ?>	
					<div class="copyright-menu"><?php dynamic_sidebar('copyright-menu'); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

