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

// Template
$iso					= 'g-4 no-equal-team';

if ( SasbyTheme::$options['service_archive_style'] == 'style1' ){
	$sercices_archive_layout = "rt-service-default rt-service-layout-1";
	$template 				 = 'services-1';
}elseif( SasbyTheme::$options['service_archive_style'] == 'style2' ){
	$sercices_archive_layout = "rt-service-default rt-service-layout-2";
	$template 				 = 'services-2';
}else{
	$sercices_archive_layout = "rt-service-default rt-service-layout-1";
	$template 				 = 'services-1';
}

$post_classes = "";
if (  SasbyTheme::$layout == 'right-sidebar' || SasbyTheme::$layout == 'left-sidebar' ){
	$post_classes = 'col-sm-6 col-lg-4';
} else {
	$post_classes = 'col-sm-6 col-xl-3 col-lg-4';
}

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<?php
			if ( SasbyTheme::$layout == 'left-sidebar' ) {
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('sasby_service');
				} else {
					get_sidebar();
				}
			}?>
			<div class="<?php echo esc_attr( $sercices_archive_layout );?> <?php echo esc_attr( $sasby_layout_class );?>">
				<main id="main" class="site-main">
					<div class="rt-sidebar-sapcer">
					<?php if ( have_posts() ) : ?>
						<div class="row <?php echo esc_attr( $iso ); ?>">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="<?php echo esc_attr( $post_classes );?>">
									<?php get_template_part( 'template-parts/content', $template ); ?>
								</div>
							<?php endwhile; ?>
						</div>
 
						<?php SasbyTheme_Helper::pagination(); ?>	
						<?php else:?>
							<?php get_template_part( 'template-parts/content', 'none' );?>
						<?php endif;?>
					</div>
				</main>
			</div>
			<?php
			if ( SasbyTheme::$layout == 'right-sidebar' ) {				
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('sasby_service');
				} else {
					get_sidebar();
				}
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
