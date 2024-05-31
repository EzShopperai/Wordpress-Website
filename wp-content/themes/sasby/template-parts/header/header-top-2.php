<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$sasby_socials = SasbyTheme_Helper::socials();
$container = ( SasbyTheme::$header_style == 6 ) ? 'container-custom' : 'container';
?>
<div id="tophead" class="header-top-bar">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="top-bar-wrap">
			<div class="topbar-left">
				<ul class="top-address">
					<li><i class="icon-sasby-location"></i><?php echo wp_kses( SasbyTheme::$options['address'] , 'alltext_allow' );?></li>
				</ul>
			</div>
			<div class="tophead-right">							
				<?php if ( $sasby_socials ) { ?>					
					<ul class="tophead-social">
						<?php foreach ( $sasby_socials as $sasby_social ): ?>
							<li><a target="_blank" aria-label="Social Link" href="<?php echo esc_url( $sasby_social['url'] );?>"><i class="fab <?php echo esc_attr( $sasby_social['icon'] );?>"></i></a></li>
						<?php endforeach; ?>
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</div>