<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$sasby_socials = SasbyTheme_Helper::socials();

// Logo
if( !empty( SasbyTheme::$options['logo'] ) ) {
	$logo_dark = wp_get_attachment_image( SasbyTheme::$options['logo'], 'full' );
	$sasby_dark_logo = $logo_dark;
}else {
	$sasby_dark_logo = get_bloginfo( 'name' ); 
}

if( !empty( SasbyTheme::$options['logo_light'] ) ) {
	$logo_lights = wp_get_attachment_image( SasbyTheme::$options['logo_light'], 'full' );
	$sasby_light_logo = $logo_lights;
}else {
	$sasby_light_logo = get_bloginfo( 'name' );
}

?>

<div class="additional-menu-area header-offcanvus">
	<div class="sidenav sidecanvas">
		<div class="canvas-content">
			<a href="#" class="closebtn" aria-label="Close btn"><i class="fas fa-times"></i></a>
			<div class="additional-logo">
				<a class="dark-logo" aria-label="Dark Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $sasby_dark_logo, 'allow_link' ); ?></a>
				<a class="light-logo" aria-label="Light Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $sasby_light_logo, 'allow_link' ); ?></a>
			</div>

			<div class="sidenav-address">
				<?php if ( !empty ( SasbyTheme::$options['sidetext_label'] ) ) { ?>
				<label><?php echo wp_kses( SasbyTheme::$options['sidetext_label'] , 'alltext_allow' );?></label>
				<?php } ?>
				<?php if ( !empty ( SasbyTheme::$options['sidetext'] ) ) { ?>
				<p><?php echo wp_kses( SasbyTheme::$options['sidetext'] , 'alltext_allow' );?></p>
				<?php } ?>
				<?php if( is_active_sidebar('offcanvas') ) { dynamic_sidebar('offcanvas'); } ?>

				<?php if ( !empty ( SasbyTheme::$options['address_label'] ) ) { ?>
				<label><?php echo wp_kses( SasbyTheme::$options['address_label'] , 'alltext_allow' );?></label>
				<?php } ?>
				<?php if ( SasbyTheme::$options['address'] ) { ?>
				<span><i class="icon-sasby-location"></i><?php echo wp_kses( SasbyTheme::$options['address'] , 'alltext_allow' );?></span>
				<?php } ?>
				<?php if ( SasbyTheme::$options['email'] ) { ?>
				<span><i class="icon-sasby-message"></i><a href="mailto:<?php echo esc_attr( SasbyTheme::$options['email'] );?>"><?php echo esc_html( SasbyTheme::$options['email'] );?></a></span>
				<?php } ?>			
				<?php if ( SasbyTheme::$options['phone'] ) { ?>
				<span><i class="icon-sasby-phone"></i><a href="tel:<?php echo esc_attr( SasbyTheme::$options['phone'] );?>"><?php echo esc_html( SasbyTheme::$options['phone'] );?></a></span>
				<?php } ?>

			<?php if ( !empty ( $sasby_socials ) ) { ?>
				<?php if ( !empty ( SasbyTheme::$options['social_label'] ) ) { ?>
				<label class="social-title"><?php echo wp_kses( SasbyTheme::$options['social_label'] , 'alltext_allow' );?></label>
			<?php } } ?>
				<?php if ( $sasby_socials ) { ?>
					<div class="sidenav-social">
						<?php foreach ( $sasby_socials as $sasby_social ): ?>
							<span><a target="_blank" aria-label="Social Link" href="<?php echo esc_url( $sasby_social['url'] );?>"><i class="fab <?php echo esc_attr( $sasby_social['icon'] );?>"></i></a></span>
						<?php endforeach; ?>
					</div>						
				<?php } ?>
			</div>
		</div>
	</div>
    <button type="button" aria-label="button" class="side-menu-open side-menu-trigger">
        <span class="menu-btn-icon">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </span>
      </button>
</div>