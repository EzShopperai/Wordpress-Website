<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
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
				<i class="icon-sasby-time"></i><span class="opening-label"><?php echo wp_kses( SasbyTheme::$options['opening_label'] , 'alltext_allow' );?></span><?php echo wp_kses( SasbyTheme::$options['opening'] , 'alltext_allow' );?>
			</div>
		</div>
	</div>
</div>