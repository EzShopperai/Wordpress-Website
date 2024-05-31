<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
</div><!--#content-->

<!-- progress-wrap -->
<?php if (SasbyTheme::$options['back_to_top']) { ?>
	<div class="scroll-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
	</div>
<?php } ?>
<footer>
	<div id="footer-<?php echo esc_attr(SasbyTheme::$footer_style); ?>" class="footer-area <?php if(SasbyTheme::$footer_cta != 1){ echo esc_attr('rt-footer-cta-enable'); } ?>">
		<?php if(SasbyTheme::$footer_cta == 1){
			get_template_part('template-parts/footer/footer-banner-layout', SasbyTheme::$footer_style);
		}
			get_template_part('template-parts/footer/footer', SasbyTheme::$footer_style);
		?>
	</div>
</footer>

<?php if ((SasbyTheme::$options['scroll_indicator_enable'] == '1') && (SasbyTheme::$options['scroll_indicator_position'] == 'below')) { ?>
	<div class="sasby-progress-container bottom">
		<div class="sasby-progress-bar" id="sasbyBar"></div>
	</div>
<?php } ?>


</div>
<?php wp_footer(); ?>
</body>

</html>