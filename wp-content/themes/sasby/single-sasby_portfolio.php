<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// Layout class
if ( SasbyTheme::$layout == 'full-width' ) {
	$sasby_layout_class = 'col-sm-12 col-12';
}
else{
	$sasby_layout_class = SasbyTheme_Helper::has_active_widget();
}
?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<?php if ( SasbyTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
				<div class="<?php echo esc_attr( $sasby_layout_class );?>">
					<main id="main" class="site-main">
						<?php							
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-single', 'portfolio-'.SasbyTheme::$portfolio_single_style );
							endwhile;						
						?>
					</main>
				</div>
			<?php if ( SasbyTheme::$layout == 'right-sidebar' ) { get_sidebar(); }	?>
		</div>
	</div>	
</div>
<?php if( SasbyTheme::$options['show_related_portfolio'] == '1' ) { ?>
	<div class="portfolio-related">
		<div class="container"><?php sasby_related_portfolio(); ?></div>
	</div>
<?php } ?>
<?php get_footer(); ?>