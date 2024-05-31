<?php
$sasby_footer_column = SasbyTheme::$options['footer_column_3'];
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

if( !empty( SasbyTheme::$options['fbgimg3'] ) ) {
	$f1_bg = wp_get_attachment_image_src( SasbyTheme::$options['fbgimg3'], 'full', true );
	$footer_bg_img = $f1_bg[0];
}else {
	$footer_bg_img = SASBY_ASSETS_URL . 'img/footer_bg.jpg';
}

if ( SasbyTheme::$options['footer_bgtype3'] == 'fbgcolor3' ) {
	$sasby_bg = SasbyTheme::$options['fbgcolor3'];
} else {
	$sasby_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}
$bgc = $menu_on = $copyright_on = '';
if ( SasbyTheme::$options['footer_bgtype3'] == 'fbgimg3' ) {
	$bgc = 'footer-bg-opacity';
}

$menu_on = ( SasbyTheme::$options['copyright_menu'] ) ? "menu-on" : "menu-off";
$copyright_on = ( SasbyTheme::$options['copyright_text'] ) ? "copyright-on" : "copyright-off";

?>
<div class="footer-top-area <?php echo esc_attr( $bgc ); ?>" style="background:<?php echo esc_html( $sasby_bg ); ?>">
    <div class="rt-footer-top-address3">
        <div class="container">
            <div class="row align-items-center justify-content-between">
	            <?php if ( SasbyTheme::$options['footer_logo3'] ) { ?>
                <div class=" col-lg-3 col-md-6 col-sm-6 mb-md-0 mb-4">
                    <div class="footer-logo">
                        <a href="<?php echo get_home_url(); ?>" class="logo mb-0">
                            <?php
                                $f3_logo = wp_get_attachment_image_src(SasbyTheme::$options['footer_logo3'], 'full', true);
                                $footer_logo = $f3_logo[0];
                            ?>
                            <img src="<?php echo esc_attr($footer_logo); ?>" width="181" height="46" alt="logo">
                        </a>
                    </div>
                </div>
                <?php } ?>

	            <?php if ( SasbyTheme::$options['footer_number'] ) { ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-md-0 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="footer-icon-box">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="contact-wrapper has-animation active-animation">
                            <div class="text"> <?php echo wp_kses( SasbyTheme::$options['footer_number_label'] , 'allow_link' );?></div>
                            <a href="tel:<?php echo esc_url( SasbyTheme::$options['footer_number'] , 'allow_link' );?>" class="phone">
	                            <?php echo wp_kses( SasbyTheme::$options['footer_number'] , 'allow_link' );?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>

	            <?php if ( SasbyTheme::$options['footer_address'] ) { ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-sm-0 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="footer-icon-box">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p class="footer-address mb-0"><?php echo wp_kses( SasbyTheme::$options['footer_address'] , 'allow_link' );?></p>
                    </div>
                </div>
                <?php } ?>

	            <?php if ( SasbyTheme::$options['footer_email'] ) { ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-0">
                    <div class="d-flex align-items-center justify-content-lg-end">
                        <div class="footer-icon-box">
                            <i class="fa-solid fa-envelope-open"></i>
                        </div>
                        <div class="contact-wrapper mail-wrap">
                            <div class="text"><?php echo wp_kses( SasbyTheme::$options['footer_email_label'] , 'allow_link' );?></div>
                            <a href="mailto:info@email.com" class="phone mail">
	                            <?php echo wp_kses( SasbyTheme::$options['footer_email'] , 'allow_link' );?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
	<?php if ( is_active_sidebar( 'footer-style-3-1' ) && SasbyTheme::$footer_area == 1 ) { ?>
	<div class="footer-content-area">
		<div class="container">			
			<div class="row">
				<?php
				for ( $i = 1; $i <= $sasby_footer_column; $i++ ) {
					echo '<div class="' . $sasby_footer_class . '">';
					dynamic_sidebar( 'footer-style-3-'. $i );
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

