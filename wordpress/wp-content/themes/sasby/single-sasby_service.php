<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Layout class
if ( SasbyTheme::$layout == 'full-width' ) {
	$sasby_layout_class = 'col-sm-12 col-12';
} else {
	$sasby_layout_class = SasbyTheme_Helper::has_active_widget();
}
$service_layout_ops = get_post_meta( get_the_ID() ,'sasby_service_style', true );
$f_layout = ( empty( $service_layout ) || ( $service_layout  == 'default' ) ) ? $service_layout_ops : $service_layout;

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<?php
			if ( SasbyTheme::$layout == 'left-sidebar' ) {
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('sasby_service');
				}else {
					get_sidebar();
				}
			}
			?>
			<div class="<?php echo esc_attr( $sasby_layout_class );?>">
				<main id="main" class="site-main <?php echo esc_attr( $f_layout );?>">
					<div class="rt-sidebar-sapcer">					
					<?php
						if ( $f_layout == 'style1' ) {								
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-single', 'service-1' );
							endwhile;
						} else if ( $f_layout == 'style2' ) {								
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-single', 'service-2' );
							endwhile;
						} 
						else {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-single', 'service-1' );
							endwhile;
						} ?>
					</div>
				</main>
			</div>
			<?php
			if ( SasbyTheme::$layout == 'right-sidebar' ) {				
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('sasby_service');
				}else {
					get_sidebar();
				}
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
