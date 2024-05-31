<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$sasby_socials = SasbyTheme_Helper::socials();

$sasby_mobile_meta  = ( SasbyTheme::$options['mobile_date'] || SasbyTheme::$options['mobile_address'] || SasbyTheme::$options['mobile_opening'] || SasbyTheme::$options['mobile_phone'] || SasbyTheme::$options['mobile_email'] || SasbyTheme::$options['mobile_button'] || SasbyTheme::$options['mobile_social'] && $sasby_socials ) ? true : false;

?>
<?php if ( $sasby_mobile_meta ) { ?>
<div class="mobile-top-bar" id="mobile-top-fix">
	<div class="mobile-top">
		<ul class="mobile-address">
			<?php if ( SasbyTheme::$options['mobile_date'] ) { ?>
			<li><i class="icon-sasby-calendar"></i><?php echo date_i18n( get_option('date_format') ); ?></li>
			<?php } if ( SasbyTheme::$options['mobile_address'] ) { ?>
			<li><i class="icon-sasby-location"></i><?php echo wp_kses( SasbyTheme::$options['address'] , 'alltext_allow' );?></li>
			<?php } if ( SasbyTheme::$options['mobile_opening'] ) { ?>
			<li><i class="icon-sasby-time"></i><span class="opening-label"><?php echo wp_kses( SasbyTheme::$options['opening_label'] , 'alltext_allow' );?></span> <?php echo wp_kses( SasbyTheme::$options['opening'] , 'alltext_allow' );?></li>
			<?php } if ( SasbyTheme::$options['mobile_phone'] ) { ?>
			<li><i class="icon-sasby-phone"></i><a href="tel:<?php echo esc_attr( SasbyTheme::$options['phone'] );?>"><?php echo wp_kses( SasbyTheme::$options['phone'] , 'alltext_allow' );?></a></li>
			<?php } if ( SasbyTheme::$options['mobile_email'] ) { ?>
			<li><i class="icon-sasby-message"></i><a href="mailto:<?php echo esc_attr( SasbyTheme::$options['email'] );?>"><?php echo wp_kses( SasbyTheme::$options['email'] , 'alltext_allow' );?></a></li>
			<?php } ?>
		</ul>

		<?php if ( SasbyTheme::$options['mobile_social'] && $sasby_socials ) { ?>
			<ul class="mobile-social">
				<?php foreach ( $sasby_socials as $sasby_social ): ?>
					<li><a target="_blank" href="<?php echo esc_url( $sasby_social['url'] );?>"><i class="fab <?php echo esc_attr( $sasby_social['icon'] );?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
		<?php } ?>

		<?php if ( SasbyTheme::$options['mobile_button'] ) { ?>
			<?php get_template_part( 'template-parts/header/icon', 'button' );?>
		<?php } ?>

	</div>
</div>
<?php } ?>