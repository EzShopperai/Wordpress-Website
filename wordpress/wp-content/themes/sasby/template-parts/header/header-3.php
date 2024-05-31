<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = SasbyTheme_Helper::nav_menu_args();

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
<div id="sticky-placeholder"></div>
<div class="header-menu header-top" id="header-menu">
	<div class="container">
		<div class="menu-full-wrap">
			<div class="site-branding">
				<a class="dark-logo" aria-label="Dark Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $sasby_dark_logo, 'allow_link' ); ?></a>
				<a class="light-logo" aria-label="Light Logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $sasby_light_logo, 'allow_link' ); ?></a>
			</div>
			<div class="content-branding">
				<?php if ( SasbyTheme::$options['address_icon'] || SasbyTheme::$options['email_icon'] || SasbyTheme::$options['phone_icon'] ) { ?>
				<div class="content-top">
					<ul class="header-info">
						<?php if ( SasbyTheme::$options['address_icon'] ) { ?>
						<li><i class="icon-sasby-location"></i><?php echo wp_kses( SasbyTheme::$options['address'] , 'alltext_allow' );?></li>
						<?php } if ( SasbyTheme::$options['email_icon'] ) { ?>
						<li><i class="icon-sasby-message"></i><a href="mailto:<?php echo esc_attr( SasbyTheme::$options['email'] );?>"><?php echo wp_kses( SasbyTheme::$options['email'] , 'alltext_allow' );?></a></li>
						<?php } if ( SasbyTheme::$options['phone_icon'] ) { ?>
						<li><i class="icon-sasby-phone"></i><a href="tel:<?php echo esc_attr( SasbyTheme::$options['phone'] );?>"><?php echo wp_kses( SasbyTheme::$options['phone'] , 'alltext_allow' );?></a></li>
						<?php } ?>
					</ul>
					<?php if ( SasbyTheme::$options['online_button'] ) { ?>
					<?php get_template_part( 'template-parts/header/icon', 'button' );?>
					<?php } ?>
				</div>
				<?php } ?>
				<div class="content-bottom">
					<div class="menu-wrap">
						<div id="site-navigation" class="main-navigation">
							<?php wp_nav_menu( $nav_menu_args );?>
						</div>
						<?php if ( SasbyTheme::$options['search_icon'] || SasbyTheme::$options['cart_icon'] || SasbyTheme::$options['vertical_menu_icon'] ) { ?>
						<div class="header-icon-area">	
							<?php if ( SasbyTheme::$options['search_icon'] ) { ?>
								<?php get_template_part( 'template-parts/header/icon', 'search' );?>	
							<?php } if ( SasbyTheme::$options['cart_icon'] ) { ?>
								<?php get_template_part( 'template-parts/header/icon', 'cart' );?>
							<?php } if ( SasbyTheme::$options['vertical_menu_icon'] ) { ?>
								<?php get_template_part( 'template-parts/header/icon', 'offcanvas' );?>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
